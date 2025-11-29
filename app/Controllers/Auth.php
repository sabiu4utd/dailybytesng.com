<?php

namespace App\Controllers;

use App\Models\Users_model;
use App\Models\Profile_model;
use App\Models\Category_model;
use App\Models\News_model;
use App\Models\Video_model;
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
                return redirect()->to('/');
            }
        } else {
            $session->setFlashdata('error', 'Invalid username or password');
            return redirect()->to('/');
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
        return redirect()->to('/');
    }
    public function save_news()
    {
        $news = new News_model();

        $file = $this->request->getFile('cover_picture');
        $session = session();
        $fileName = $file->getRandomName();
        $file->move('assets/uploads', $fileName);

        $news->insert([
            'newsid' => Uuid::uuid4()->toString(),
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'categoryid' => $this->request->getPost('categoryid'),
            'status' => 'pending',
            'breaking_news' => $this->request->getPost('breaking_news') ?? 'No',
            'posted_by' => $session->get('userid'),
            'cover_picture' => $fileName,
        ]);

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
        $news
            ->set('title', $this->request->getPost('title'))
            ->set('content', $this->request->getPost('content'))
            ->set('categoryid', $this->request->getPost('categoryid'))
            ->set('status', 'pending')
            ->set('breaking_news', $this->request->getPost('breaking') ?? 'No')
            ->set('posted_by', $this->request->getPost('posted_by'))
            ->set('cover_picture', $fileName ?? $this->request->getPost('cover_picture'))
            ->where('newsid', $this->request->getPost('newsid'))
            ->update();
        return redirect()->to('dashboard');
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
        return redirect()->to('dashboard');
    }
}
