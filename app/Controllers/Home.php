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
        $data['breaking_news'] = $news
            ->select('newsid, news.slug, title, content, cover_picture, news.created_at, profile.firstname, profile.surname, profile.othername')
            ->join('profile', 'profile.userid = news.posted_by')
            ->where('news.breaking_news', 'Yes')
            ->where('news.status', 'published')
            ->orderBy('news.created_at', 'DESC')
            ->limit(3)
            ->findAll();

        $data['latest_news'] = $news
            ->select('newsid, news.slug, title, content, cover_picture, news.created_at, profile.firstname, profile.surname, profile.othername, categories.category')
            ->join('profile', 'profile.userid = news.posted_by')
            ->join('categories', 'categories.categoryid = news.categoryid')
            ->where('news.breaking_news', 'No')
            ->where('news.status', 'published')
            ->orderBy('news.created_at', 'DESC')
            ->limit(20)
            ->findAll();

        //load the most recent disticnt categories 

        $sql = "SELECT category, categoryid, title, slug, created_at, cover_picture
FROM (
    SELECT 
        c.category,
        c.categoryid,
        n.title,
        n.slug,
        n.created_at,
        n.cover_picture,
        ROW_NUMBER() OVER (
            PARTITION BY c.categoryid 
            ORDER BY n.created_at DESC
        ) AS rn
    FROM news n
    JOIN categories c ON c.categoryid = n.categoryid
    JOIN profile p ON p.userid = n.posted_by
    WHERE n.breaking_news = 'No'
      AND n.status = 'published'
) x
WHERE rn = 1
ORDER BY created_at DESC
LIMIT 15;
";
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
    public function single_news($segment)
    {
        $news = new News_model();

        // Try to find by slug first, then fallback to newsid
        $data['news'] = $news
            ->select('newsid, news.slug, title, content, cover_picture, news.created_at, profile.firstname, profile.surname, profile.othername, categories.category')
            ->join('profile', 'profile.userid = news.posted_by')
            ->join('categories', 'categories.categoryid = news.categoryid')
            ->where('news.slug', $segment)
            ->first();

        if (!$data['news']) {
            $data['news'] = $news
                ->select('newsid, news.slug, title, content, cover_picture, news.created_at, profile.firstname, profile.surname, profile.othername, categories.category')
                ->join('profile', 'profile.userid = news.posted_by')
                ->join('categories', 'categories.categoryid = news.categoryid')
                ->where('news.newsid', $segment)
                ->first();
        }

        $data['latest_news'] = $news
            ->select('newsid, news.slug, title, cover_picture, news.created_at, profile.firstname, profile.surname, profile.othername, categories.category')
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
            ->select('newsid, news.slug, title, cover_picture, news.created_at, profile.firstname, profile.surname, profile.othername, categories.category')
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
            ->select('newsid, news.slug, title, cover_picture, news.created_at, profile.firstname, profile.surname, profile.othername, categories.category')
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
    public function read_news($slug)
    {
        $news = new News_model();
        $data['news'] = $news
            ->select('newsid, news.slug, title, content, status, cover_picture, news.created_at, email, role, profile.firstname, profile.surname, profile.othername, categories.category')
            ->join('profile', 'profile.userid = news.posted_by')
            ->join('categories', 'categories.categoryid = news.categoryid')
            ->where('news.slug', $slug)
            ->first();

        $comment = new Comment_model();
        $data['comments'] = $comment
            ->select('commentid, comment, newsid, created_at')
            ->where('newsid', $news->newsid)
            ->findAll();

        return view('news_admin_view', $data);
    }
    public function publish($slug)
    {

        $news = new News_model();
        $news
            ->set('status', 'Published')
            ->where('slug', $slug)
            ->update();


        session()->setFlashdata('success', 'News published successfully');
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
        session()->setFlashdata('success', 'Video published successfully');
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
        session()->setFlashdata('success', 'Video uploaded successfully');
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
        session()->setFlashdata('success', 'Video updated successfully');
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
        session()->setFlashdata('success', 'Comment saved successfully');
        return redirect()->to('dashboard');
    }
    public function edit_news($slug)
    {
        $news = new News_model();
        $data['news'] = $news
            ->select('newsid, news.slug, title, content, status, cover_picture, news.posted_by, news.categoryid, news.created_at, email, role, profile.firstname, profile.surname, profile.othername, categories.category')
            ->join('profile', 'profile.userid = news.posted_by')
            ->join('categories', 'categories.categoryid = news.categoryid')
            ->where('news.slug', $slug)
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
    ->select('
        news.newsid,
        news.deleted_at,
        news.slug,
        news.title,
        news.content,
        news.status,
        news.cover_picture,
        news.posted_by,
        news.categoryid,
        news.created_at,
        profile.firstname,
        profile.surname,
        profile.othername,
        categories.category
    ')
    ->join('profile', 'profile.userid = news.posted_by')
    ->join('categories', 'categories.categoryid = news.categoryid')
    ->where('news.posted_by', $this->session->get('userid'))
    ->where('news.deleted_at', null)
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
    public function delete_news($slug)
    {
        $news = new News_model();
        $news->where('slug', $slug)->delete();
        session()->setFlashdata('success', 'News deleted successfully');
        return redirect()->to('mystories');
    }
    public function delete_video($videoid)
    {
        $video = new Video_model();
        $video->delete($videoid);
        session()->setFlashdata('success', 'Video deleted successfully');
        return redirect()->to('mystories');
    }
    public function user()
    {

        $user = new Users_model();
        $profile = new Profile_model();
        $userid = Uuid::uuid4()->toString();
        $user->insert([
            'userid' => $userid,
            'username' => $this->request->getPost('email'),
            'password' => hash('SHA512', $this->request->getPost('password')),
        ]);
        $profile->insert([
            'profileid' => Uuid::uuid4()->toString(),
            'userid' => $userid,
            'firstname' => $this->request->getPost('firstname'),
            'surname' => $this->request->getPost('surname'),
            'othername' => $this->request->getPost('othername'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'state' => $this->request->getPost('state'),
            'role' => $this->request->getPost('role'),
            'dob' => $this->request->getPost('dob'),
            'gender' => $this->request->getPost('gender'),
            'passport' => null,
        ]);
        session()->setFlashdata('success', 'User created successfully');
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
            ->select('newsid, news.slug, title, cover_picture, news.created_at, profile.firstname, profile.surname, profile.othername, categories.category')
            ->join('profile', 'profile.userid = news.posted_by')
            ->join('categories', 'categories.categoryid = news.categoryid')
            ->where('news.categoryid', $categoryid)
            ->where('news.status', 'published')
            ->orderBy('news.created_at', 'DESC')
            ->findAll();
        $data['category_label'] = $category->where('categoryid', $categoryid)->first()->category;
        return view('category_news', $data);
    }
    public function archive()
    {
        // Move old published posts to Archived (older than 1 month)
        $news = new News_model();
        $news->query("UPDATE news SET status = 'Archived' WHERE status = 'published' AND created_at < DATE_SUB(NOW(), INTERVAL 1 MONTH)");

        // Load categories (if you need them in the header/nav)
        $category = new Category_model();
        $data['categories'] = $category->findAll();

        // Fetch archived news
        $data['news'] = (new News_model())
            ->select('newsid, title, cover_picture, news.created_at, profile.firstname, profile.surname, profile.othername, categories.category')
            ->join('profile', 'profile.userid = news.posted_by')
            ->join('categories', 'categories.categoryid = news.categoryid')
            ->where('news.status', 'Archived')
            ->orderBy('news.created_at', 'DESC')
            ->findAll();

        $data['page_title'] = 'Archived News';
        return view('archived', $data);
    }
    public function search()
    {
        $query = $this->request->getPost('q');
        $news = new News_model();
        $escaped = $news->escape($query);
        $data['news'] = $news
            ->select('newsid, news.slug, title, content, cover_picture, news.created_at, profile.firstname, profile.surname, profile.othername, categories.category')
            ->join('profile', 'profile.userid = news.posted_by')
            ->join('categories', 'categories.categoryid = news.categoryid')
            ->where("MATCH (title, content) AGAINST ($escaped IN NATURAL LANGUAGE MODE)")
            ->orderBy('news.created_at', 'DESC')
            ->findAll();
        $data['search_query'] = $query;

        return view('search_results', $data);
    }
}
