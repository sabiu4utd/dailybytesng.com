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
        return view('index', $data);
    }
}
