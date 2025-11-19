<?php

namespace App\Controllers;

use App\Models\News_model;

class Home extends BaseController
{
    public function index(): string
    {
        $news = new News_model();
        $data['news'] = $news
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




        return view('index', $data);
    }
    public function single_news($newsid)
    {
        $news = new News_model();
        $data['news'] = $news
            ->join('profile', 'profile.userid = news.posted_by')
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
        $news = new News_model();
        $data['news'] = $news
            ->join('profile', 'profile.userid = news.posted_by')
            ->where('news.categoryid', $categoryid)
            ->where('news.status', 'published')
            ->orderBy('news.created_at', 'DESC')
            ->findAll();
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
        return view('news_admin_view', $data);
    }
    public function publish($newsid)
    {
       
        $news = new News_model();
        $news->update($newsid, ['status' => 'Published']);
        return redirect()->to('publish_news');
    }
}
