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
        ->first();

         $data['latest_news'] = $news
        ->select('newsid, title, cover_picture, news.created_at, profile.firstname, profile.surname, profile.othername, categories.category')
        ->join('profile', 'profile.userid = news.posted_by')
        ->join('categories', 'categories.categoryid = news.categoryid')
        ->where('news.breaking_news', 'No')
        ->where('news.status', 'Pending')
        ->orderBy('news.created_at', 'DESC')
        ->limit(10)
        ->findAll();
       

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
        ->where('news.status', 'Pending')
        ->orderBy('news.created_at', 'DESC')
        ->limit(10)
        ->findAll();
        return view('single_news', $data);
    }
}
