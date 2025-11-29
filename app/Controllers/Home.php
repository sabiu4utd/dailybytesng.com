<?php

namespace App\Controllers;

use App\Models\News_model;
use App\Models\Video_model;
use App\Models\Category_model;
use App\Models\Comment_model;
use App\Models\Users_model;
use App\Models\Profile_model;
use Ramsey\Uuid\Uuid;

class Home extends BaseController
{
    public function index(): string
    {
        $news = new News_model();
        $video = new Video_model();
        $data['news'] = $news
            ->select('newsid, title, content, cover_picture, news.created_at, profile.firstname, profile.surname, profile.othername')
            ->join('profile', 'profile.userid = news.posted_by')
            ->where('news.breaking_news', 'Yes')
            ->where('news.status', 'published')
            ->orderBy('news.created_at', 'DESC')
            ->limit(1)
            ->first();

        $data['latest_news'] = $news
            ->select('newsid, title, cover_picture, news.created_at, profile.firstname, profile.surname, profile.othername, categories.category')
            ->join('profile', 'profile.userid = news.posted_by')
            ->join('categories', 'categories.categoryid = news.categoryid')
            ->where('news.breaking_news', 'No')
            ->where('news.status', 'published')
            ->orderBy('news.created_at', 'DESC')
            ->limit(10)
            ->findAll();

        //load the most recent disticnt categories 

        $sql = "SELECT categories.category, categories.categoryid, title, news.created_at, cover_picture
        FROM news
        JOIN categories ON categories.categoryid = news.categoryid
        JOIN profile ON profile.userid = news.posted_by
        WHERE news.breaking_news = 'No' AND news.status = 'published'
        GROUP BY categories.categoryid
        ORDER BY news.created_at DESC";
        $data['categories'] = $news->db->query($sql)->getResult();

        $data['videos'] = $video
            ->select('videoid, title, video_link, videos.created_at, videos.description, profile.firstname, profile.surname, profile.othername, categories.category')
            ->join('profile', 'profile.userid = videos.uploaded_by')
            ->join('categories', 'categories.categoryid = videos.categoryid')
            ->where('status', 'published')
            ->orderBy('created_at', 'DESC')
            ->limit(24)
            ->findAll();


        return view('index', $data);
    }
    public function single_news($newsid)
    {
        $news = new News_model();
        $data['news'] = $news
            ->select('newsid, title, content, cover_picture, news.created_at, profile.firstname, profile.surname, profile.othername, categories.category')
            ->join('profile', 'profile.userid = news.posted_by')
            ->join('categories', 'categories.categoryid = news.categoryid')
            ->where('newsid', $newsid)
            ->first();

        $data['latest_news'] = $news
            ->select('newsid, title, cover_picture, news.created_at, profile.firstname, profile.surname, profile.othername, categories.category')
            ->join('profile', 'profile.userid = news.posted_by')
            ->join('categories', 'categories.categoryid = news.categoryid')
            ->where('news.breaking_news', 'No')
            ->where('news.status', 'published')
            ->orderBy('news.created_at', 'DESC')
            ->limit(10)
            ->findAll();
        return view('single_news', $data);
    }

    public function category_news($categoryid)
    {
        $category = new Category_model();
        $news = new News_model();
        $data['news'] = $news
         ->select('newsid, title, cover_picture, news.created_at, profile.firstname, profile.surname, profile.othername, categories.category')
            ->join('profile', 'profile.userid = news.posted_by')
            ->join('categories', 'categories.categoryid = news.categoryid')
            ->where('news.categoryid', $categoryid)
            ->where('news.status', 'published')
            ->orderBy('news.created_at', 'DESC')
            ->findAll();
        $data['category_label'] = $category->where('categoryid', $categoryid)->first()->category;
        //var_dump($data['news']); exit;

        return view('category_news', $data);
    }
    public function publish_news()
    {
        $news = new News_model();
        $data['news'] = $news
            ->select('newsid, title, cover_picture, news.created_at, profile.firstname, profile.surname, profile.othername, categories.category')
            ->join('profile', 'profile.userid = news.posted_by')
            ->join('categories', 'categories.categoryid = news.categoryid')
            ->where('news.status', 'Pending')
            ->orderBy('news.created_at', 'DESC')
            ->findAll();

        $vedio = new Video_model();
        $data['videos'] = $vedio
            ->select('videoid, title, video_link, videos.created_at, profile.firstname, profile.surname, profile.othername, categories.category')
            ->join('profile', 'profile.userid = videos.uploaded_by')
            ->join('categories', 'categories.categoryid = videos.categoryid')
            ->where('status', 'pending')
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('publisher-dashboards', $data);
    }
    public function read_news($newsid)
    {
        $news = new News_model();
        $data['news'] = $news
            ->select('newsid, title, content, status, cover_picture, news.created_at, email, role, profile.firstname, profile.surname, profile.othername, categories.category')
            ->join('profile', 'profile.userid = news.posted_by')
            ->join('categories', 'categories.categoryid = news.categoryid')
            ->where('newsid', $newsid)
            ->first();

        $comment = new Comment_model();
        $data['comments'] = $comment
            ->select('commentid, comment, newsid, created_at')
            ->where('newsid', $newsid)
            ->findAll();

        return view('news_admin_view', $data);
    }
    public function publish($newsid)
    {

        $news = new News_model();
        $news->update($newsid, ['status' => 'Published']);
        return redirect()->to('publish_news');
    }
    public function view_video($videoid)
    {
        $video = new Video_model();
        $data['video'] = $video
            ->select('videoid, title, video_link, videos.created_at, videos.description, profile.firstname, profile.surname, profile.othername, categories.category')
            ->join('profile', 'profile.userid = videos.uploaded_by')
            ->join('categories', 'categories.categoryid = videos.categoryid')
            ->where('videoid', $videoid)
            ->first();

            $comment = new Comment_model();
            $data['comments'] = $comment
                ->select('commentid, comment, newsid, created_at')
                ->where('newsid', $videoid)
                ->findAll();

        return view('view_video', $data);
    }
    public function publish_vid($videoid)
    {

        $video = new Video_model();
        $video->update($videoid, ['status' => 'Published']);
        return redirect()->to('publish_news');
    }
    public function edit_video($videoid)
    {
        $video = new Video_model();
        $data['video'] = $video
            ->select('videoid, title, video_link, videos.created_at, videos.uploaded_by, categories.categoryid, videos.description, profile.firstname, profile.surname, profile.othername, categories.category')
            ->join('profile', 'profile.userid = videos.uploaded_by')
            ->join('categories', 'categories.categoryid = videos.categoryid')
            ->where('videoid', $videoid)
            ->first();
        $category = new Category_model();
        $data['categories'] = $category->findAll();

        $cat = $category->where('categoryid', $data['video']->categoryid)->first();
        $data['category'] = $cat;
        // var_dump($data['video']); exit;
        return view('edit_video', $data);
    }
    public function upload_video()
    {
        $video = new Video_model();
        $video_link = $this->request->getPost('video_link');
        $title = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        $categoryid = $this->request->getPost('categoryid');
        $uploaded_by = $this->session->get('userid');
        $created_at = date('Y-m-d H:i:s');
        $status = 'pending';
        $video->insert([
            'videoid' => Uuid::uuid4()->toString(),
            'title' => $title,
            'video_link' => $video_link,
            'description' => $description,
            'categoryid' => $categoryid,
            'uploaded_by' => $uploaded_by,
            'created_at' => $created_at,
            'status' => $status,
        ]);
        return redirect()->to('publish_news');
    }
    public function update_video()
    {

        $video = new Video_model();
        $video_link = $this->request->getPost('video_link');
        $title = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        $categoryid = $this->request->getPost('categoryid');
        $uploaded_by = $this->request->getPost('uploaded_by');
        $status = 'pending';
        $video->set('title', $title);
        $video->set('video_link', $video_link);
        $video->set('description', $description);
        $video->set('categoryid', $categoryid);
        $video->set('uploaded_by', $uploaded_by);
        $video->set('status', $status);
        $video->update($this->request->getPost('videoid'));

        return redirect()->to('publish_news');
    }
    public function save_comment()
    {
        //var_dump($_POST); exit;
        $comment = $this->request->getPost('comment');
        $newsid = $this->request->getPost('newsid');
        $commentid = Uuid::uuid4()->toString();

        $commentmodel = new Comment_model();
        $commentmodel->insert([
            'commentid' => $commentid,
            'comment' => $comment,
            'newsid' => $newsid,

        ]);
        return redirect()->to('dashboard');
    }
    public function edit_news($newsid)
    {
        $news = new News_model();
        $data['news'] = $news
            ->select('newsid, title, content, status, cover_picture, news.posted_by, news.categoryid, news.created_at, email, role, profile.firstname, profile.surname, profile.othername, categories.category')
            ->join('profile', 'profile.userid = news.posted_by')
            ->join('categories', 'categories.categoryid = news.categoryid')
            ->where('newsid', $newsid)
            ->first();
        $category = new Category_model();
        $data['categories'] = $category->findAll();
        return view('edit_news', $data);
    }
    public function mystories()
    {
        $category = new Category_model();
        $data['categories'] = $category->findAll();
        $news = new News_model();
        $data['news'] = $news
            ->select('newsid, title, content, status, cover_picture, news.posted_by, news.categoryid, news.created_at, email, role, profile.firstname, profile.surname, profile.othername, categories.category')
            ->join('profile', 'profile.userid = news.posted_by')
            ->join('categories', 'categories.categoryid = news.categoryid')
            ->where('news.posted_by', $this->session->get('userid'))
            ->findAll();
            $videos = new Video_model();
            $data['videos'] = $videos
            ->select('videoid, title, video_link, videos.created_at, videos.uploaded_by, categories.categoryid, videos.description, profile.firstname, profile.surname, profile.othername, categories.category')
            ->join('profile', 'profile.userid = videos.uploaded_by')
            ->join('categories', 'categories.categoryid = videos.categoryid')
            ->where('videos.uploaded_by', $this->session->get('userid'))
            ->findAll();
            $data['categories'] = $category->findAll();

           
            //var_dump($data['videos']); exit;
        return view('mystories', $data);
    }
    public function delete_news($newsid)
    {
        $news = new News_model();
        $news->delete($newsid);
        return redirect()->to('mystories');
    }
    public function delete_video($videoid)
    {
        $video = new Video_model();
        $video->delete($videoid);
        return redirect()->to('mystories');
    }
    public function user()
    {
        
        $user = new Users_model();
        $profile = new Profile_model();
        $userid = Uuid::uuid4()->toString();
        $user->insert([
            'userid'=>$userid,
            'username'=>$this->request->getPost('email'),
            'password' => hash('SHA512', $this->request->getPost('password')),
        ]);
        $profile->insert([
            'profileid'=>Uuid::uuid4()->toString(),
            'userid'=>$userid,
            'firstname'=>$this->request->getPost('firstname'),
            'surname'=>$this->request->getPost('surname'),
            'othername'=>$this->request->getPost('othername'),
            'email'=>$this->request->getPost('email'),
            'phone'=>$this->request->getPost('phone'),
            'state'=>$this->request->getPost('state'),
            'role'=>$this->request->getPost('role'),
            'dob'=>$this->request->getPost('dob'),
            'gender'=>$this->request->getPost('gender'),
            'passport'=>null,
        ]);
        return redirect()->to('dashboard');
    }
    public function about()
    {
        return view('about');
    }
    public function category($slug)
    {
    $category = new Category_model();
    $categoryid = $category->where('slug', $slug)->first()->categoryid;
      $news = new News_model();
        $data['news'] = $news
        ->select('newsid, title, cover_picture, news.created_at, profile.firstname, profile.surname, profile.othername, categories.category')
            ->join('profile', 'profile.userid = news.posted_by')
            ->join('categories', 'categories.categoryid = news.categoryid')
            ->where('news.categoryid', $categoryid)
            ->where('news.status', 'published')
            ->orderBy('news.created_at', 'DESC')
            ->findAll();
        $data['category_label'] = $category->where('categoryid', $categoryid)->first()->category;
            return view('category_news', $data);
    }
    public function archive(){
        //archive news
        

    }
}
