<?php

namespace App\Controllers;

use App\Models\Users_model;
use App\Models\Profile_model;
use App\Models\Category_model;
use App\Models\News_model;
use App\Models\Video_model;
use App\Helpers\SlugHelper;
use Ramsey\Uuid\Uuid;

class Auth extends BaseController
{
    public function index(): string
    {
        return view('login');
    }

    public function register(): string
    {
        return view('register');
    }

    public function login()
    {
        $users = new Users_model();
        $profile = new Profile_model();
        $session = session();

        $user = $users
            ->join('profile', 'profile.userid = users.userid')
            ->where('username', $this->request->getPost('username'))->first();
        if (!$user) {
            $session->setFlashdata('error', 'Invalid username or password');
            return redirect()->to('login');
        }
        $news = new News_model();
        $all =  $news
            ->where('posted_by', $user->userid)
            ->findAll();
        $mynews = count($all);

        $videos = new Video_model();
        $all_videos =  $videos
            ->where('uploaded_by', $user->userid)
            ->findAll();
        $myvids = count($all_videos);

        $_SESSION['mynews'] = $mynews;
        $_SESSION['myvids'] = $myvids;

        if ($user) {
            if (hash('SHA512', $this->request->getPost('password')) == $user->password) {
                $sessionData = [
                    'userid'        => $user->userid,
                    'username'      => $user->username,
                    'firstname'     => $user->firstname,
                    'surname'       => $user->surname,
                    'othername'     => $user->othername,
                    'email'         => $user->email,
                    'phone'         => $user->phone,
                    'role'          => $user->role,
                    'gender'        => $user->gender,
                    'date_joined'   => $user->created_at,
                    'isLoggedIn'    => true
                ];
                $session->set($sessionData);
                return redirect()->to('dashboard');
            } else {
                $session->setFlashdata('error', 'Invalid username or password');
                return redirect()->to('login');
            }
        } else {
            $session->setFlashdata('error', 'Invalid username or password');
            return redirect()->to('login');
        }
    }
    public function dashboard()
    {
        $profile = new Profile_model();
        $session = session();
        $user = $profile->where('userid', $session->get('userid'))->first();
        $category = new Category_model();
        $data['categories'] = $category->findAll();
        $data['user'] = $user;

        $data['users'] = $profile
            ->join('users', 'users.userid = profile.userid')
            ->findAll();
        // var_dump($users); exit;

        return view('admin', $data);
    }
    public function upload_passport()
    {
        $file = $this->request->getFile('passport_url');
        $fileName = $file->getRandomName();
        $file->move('assets/passport', $fileName);
        $profile = new Profile_model();
        $session = session();
        $profile->where('userid', $session->get('userid'))->set(['passport_url' => $fileName])->update();
        return redirect()->to('dashboard');
    }
    public function post_news()
    {
        $cat = new Category_model();

        $session = session();
        $data['user'] = $session->get('userid');
        $data['categories'] = $cat->findAll();
        return view('publisher-dashboard', $data);
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        session()->setFlashdata('success', 'Logout successfully, Bye');
        return redirect()->to('login');
    }
    public function save_news()
    {
        $news = new News_model();

        $file = $this->request->getFile('cover_picture');
        $session = session();
        $fileName = $file->getRandomName();
        $file->move('assets/uploads', $fileName);

        $title = $this->request->getPost('title');
        $slug = SlugHelper::generate($title);
        //var_dump($slug); exit;

        $news->insert([
            'newsid' => Uuid::uuid4()->toString(),
            'slug' => $slug,
            'title' => $title,
            'content' => $this->request->getPost('content'),
            'categoryid' => $this->request->getPost('categoryid'),
            'status' => 'pending',
            'breaking_news' => $this->request->getPost('breaking_news') ?? 'No',
            'posted_by' => $session->get('userid'),
            'cover_picture' => $fileName,
        ]);
        if ($news) {
            session()->setFlashdata('success', 'News added successfully');
            return redirect()->to('dashboard');
        }
        return redirect()->to('dashboard');
    }
    public function update_news()
    {
        $news = new News_model();

        // echo $this->request->getFile('cover_picture')->getError(); exit;
        //if file handle is empty ignore file upload
        if ($this->request->getFile('cover_picture')->getError() == 0) {
            //no file uploaded, update other fields only        
            $file = $this->request->getFile('cover_picture');
            $session = session();
            $fileName = $file->getRandomName();
            $file->move('assets/uploads', $fileName);
        }
        $title = $this->request->getPost('title');
        $slug = SlugHelper::generate($title);
        
        $news
            ->set('slug', $slug)
            ->set('title', $title)
            ->set('content', $this->request->getPost('content'))
            ->set('categoryid', $this->request->getPost('categoryid'))
            ->set('status', 'pending')
            ->set('breaking_news', $this->request->getPost('breaking') ?? 'No')
            ->set('posted_by', $this->request->getPost('posted_by'))
            ->set('cover_picture', $fileName ?? $this->request->getPost('cover_picture'))
            ->where('newsid', $this->request->getPost('newsid'))
            ->update();
        //return redirect()->to('dashboard');
        if ($news) {
            session()->setFlashdata('success', 'News updated successfully');
            return redirect()->to('dashboard');
        }
    }
    public function edit_news()
    {
        $news = new News_model();
        $news->set('title', $this->request->getPost('title'))
            ->set('content', $this->request->getPost('content'))
            ->set('categoryid', $this->request->getPost('categoryid'))
            ->set('status', 'pending')
            ->set('breaking_news', $this->request->getPost('breaking') ?? 'No')
            ->set('posted_by', $this->request->getPost('posted_by'))
            ->set('cover_picture', $fileName ?? $this->request->getPost('cover_picture'))
            ->where('newsid', $this->request->getPost('newsid'))
            ->update();
        if ($news) {
            session()->setFlashdata('success', 'News updated successfully');
            return redirect()->to('dashboard');
        }
        //return redirect()->to('dashboard');
    }
    public function changePassword()
    {
        $current_password = $this->request->getPost('current_password');
        $new_password = $this->request->getPost('new_password');
        $confirm_password = $this->request->getPost('confirm_password');

        if ($new_password != $confirm_password) {
            session()->setFlashdata('error', 'New password and confirm password do not match');
            return redirect()->to('dashboard');
        }

        $users = new Users_model();

        $session = session();

        $user = $users->where('userid', $session->get('userid'))
            ->where('password', hash('SHA512', $current_password))
            ->first();

        if (!$user) {
            session()->setFlashdata('error', 'Current password is incorrect');
            return redirect()->to('dashboard');
        }
        $update =  $users->where('userid', $session->get('userid'))->set(['password' => hash('SHA512', $this->request->getPost('new_password'))])->update();
        // return redirect()->to('dashboard');
        if ($update) {
            session()->setFlashdata('success', 'Password changed successfully');
            return redirect()->to('dashboard');
        }
    }
}
