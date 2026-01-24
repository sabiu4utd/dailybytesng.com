<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\News_model;
use App\Models\Category_model;
use App\Models\Video_model;

class Sitemap extends BaseController
{
    public function index()
    {
        $newsModel = new News_model();
        $categoryModel = new Category_model();

        // Get published news
        $newsItems = $newsModel->where('status', 'published')->orderBy('created_at', 'DESC')->findAll();

        // Get categories
        $categories = $categoryModel->findAll();

        $base = rtrim(base_url(), '/');
        $now = date('c');

        $xml = [];
        $xml[] = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Add homepage
        $xml[] = '  <url>';
        $xml[] = '    <loc>' . $base . '</loc>';
        $xml[] = '    <lastmod>' . $now . '</lastmod>';
        $xml[] = '    <changefreq>daily</changefreq>';
        $xml[] = '    <priority>1.0</priority>';
        $xml[] = '  </url>';

        // Add categories
        foreach ($categories as $cat) {
            $loc = $base . '/category_news/' . $cat->categoryid;
            $xml[] = '  <url>';
            $xml[] = '    <loc>' . esc($loc) . '</loc>';
            $xml[] = '    <lastmod>' . $now . '</lastmod>';
            $xml[] = '    <changefreq>weekly</changefreq>';
            $xml[] = '    <priority>0.7</priority>';
            $xml[] = '  </url>';
        }

        // Add news items (use slug when available)
        foreach ($newsItems as $item) {
            $identifier = !empty($item->slug) ? $item->slug : $item->newsid;
            $loc = $base . '/single_news/' . $identifier;
            $lastmod = $item->created_at ? date('c', strtotime(substr($item->created_at,0,19))) : $now;
            $xml[] = '  <url>';
            $xml[] = '    <loc>' . esc($loc) . '</loc>';
            $xml[] = '    <lastmod>' . $lastmod . '</lastmod>';
            $xml[] = '    <changefreq>monthly</changefreq>';
            $xml[] = '    <priority>0.8</priority>';
            $xml[] = '  </url>';
        }

        // Add video items
        $videoModel = new Video_model();
        $videos = $videoModel->where('status', 'published')->orderBy('created_at', 'DESC')->findAll();
        foreach ($videos as $v) {
            $vloc = $base . '/view_video/' . $v->videoid;
            $vlastmod = $v->created_at ? date('c', strtotime(substr($v->created_at,0,19))) : $now;
            $xml[] = '  <url>';
            $xml[] = '    <loc>' . esc($vloc) . '</loc>';
            $xml[] = '    <lastmod>' . $vlastmod . '</lastmod>';
            $xml[] = '    <changefreq>monthly</changefreq>';
            $xml[] = '    <priority>0.6</priority>';
            $xml[] = '  </url>';
        }

        $xml[] = '</urlset>';

        $body = implode("\n", $xml);

        // Attempt to write static sitemap to public folder so crawlers can fetch it directly
        try {
            if (defined('FCPATH')) {
                @file_put_contents(FCPATH . 'sitemap.xml', $body);
            } else {
                // fallback to public/ directory relative to project root
                @file_put_contents(ROOTPATH . 'public' . DIRECTORY_SEPARATOR . 'sitemap.xml', $body);
            }
        } catch (\Exception $e) {
            // ignore write errors but continue to serve dynamic sitemap
        }

        // Send XML headers and output
        return $this->response->setHeader('Content-Type', 'application/xml; charset=utf-8')->setBody($body);
    }
}
