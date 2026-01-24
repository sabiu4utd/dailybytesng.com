



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">





  <title>Daily Bytes | <?php echo $news->title; ?></title>
  <meta property="og:title" content="<?php echo $news->title; ?>">
  <meta property="og:description" content="<?php echo substr(strip_tags($news->content), 0, 160); ?>...">
  <meta property="og:image" content="<?php echo base_url() . 'assets/uploads/' . $news->cover_picture; ?>">
  <meta property="og:url" content="<?php echo base_url() . 'single_news/' . $news->newsid; ?>">
  <meta property="og:type" content="article">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?php echo $news->title; ?>">
  <meta name="twitter:description" content="<?php echo substr(strip_tags($news->content), 0, 160); ?>...">
  <meta name="twitter:image" content="<?php echo base_url() . 'assets/uploads/' . $news->cover_picture; ?>">
  <link rel="icon" type="image/jpeg" href="<?= base_url('assets/images/logo.jpg') ?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary-color: #2563eb;
      --secondary-color: #1e40af;
      --text-primary: #1f2937;
      --text-secondary: #4b5563;
      --bg-light: #f8fafc;
    }

    body {
      font-family: 'Inter', sans-serif;
      color: var(--text-primary);
      background-color: var(--bg-light);
    }

    .navbar {
      padding: 0.5rem 0;
      border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .bg-white img {
      transition: transform 0.3s ease;
    }

    .bg-white a:hover img {
      transform: scale(1.05);
    }

    .bg-white h4 {
      font-size: 1.5rem;
      letter-spacing: -0.5px;
    }

    .navbar-nav {
      gap: 0.5rem;
    }

    .nav-link {
      padding: 0.5rem 0.8rem !important;
      border-radius: 4px;
      font-size: 0.9rem;
    }

    .nav-link:hover {
      background-color: var(--bg-light);
    }

    .nav-link.active {
      background-color: var(--primary-color);
      color: white !important;
    }

    @media (max-width: 991.98px) {
      .navbar-collapse {
        max-height: 80vh;
        overflow-y: auto;
      }

      .navbar-nav {
        padding: 1rem 0;
      }
    }

    .nav-link {
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .nav-link:hover {
      color: var(--primary-color) !important;
    }

    .card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .card-title {
      color: var(--text-primary);
      font-weight: 600;
    }

    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      font-weight: 500;
      padding: 0.5rem 1.5rem;
    }

    .btn-primary:hover {
      background-color: var(--secondary-color);
      border-color: var(--secondary-color);
    }

    footer {
      background: var(--primary-color);
      color: #fff;
      padding: 20px 0;
    }

    .latest-news-link {
      display: block;
      padding: 0.75rem;
      border-radius: 0.5rem;
      transition: all 0.3s ease;
    }

    .latest-news-link:hover {
      background-color: #fff;
      transform: translateX(5px);
    }

    .news-item {
      transition: all 0.3s ease;
      cursor: pointer;
      text-decoration: none;
      color: var(--text-primary);
    }

    .news-item:hover {
      transform: translateX(5px);
    }

    .news-item h6 {
      font-weight: 600;
      transition: color 0.3s ease;
    }

    .news-item:hover h6 {
      color: var(--primary-color);
    }

    .card-header h5 {
      position: relative;
      display: inline-block;
      padding-bottom: 5px;
    }

    .card-header h5::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 50px;
      height: 3px;
      background-color: var(--primary-color);
      border-radius: 3px;
    }

    .object-fit-cover {
      object-fit: cover;
    }

    .recent-news-item {
      transition: all 0.3s ease;
      cursor: pointer;
      background-color: transparent;
    }

    .recent-news-item:hover {
      background-color: rgba(37, 99, 235, 0.05);
      transform: translateX(5px);
    }

    .recent-news-item h6 {
      color: var(--text-primary);
    }

    /* Social icons in footer */
    .social-icons a {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: #fff;
      color: var(--primary-color);
      border: 1px solid rgba(0, 0, 0, 0.06);
      margin-left: 0.5rem;
      transition: all 0.2s ease;
      text-decoration: none;
    }

    .social-icons a:hover {
      background: var(--primary-color);
      color: #fff;
      transform: translateY(-2px);
    }

    @media (max-width: 575.98px) {
      .social-icons a {
        width: 32px;
        height: 32px;
      }
    }

    .recent-news-item:hover h6 {
      color: var(--primary-color);
    }

    /* Layout-specific styles for 3-column design */
    .category-list .list-group-item {
      border: 0;
      padding: .6rem .75rem;
      border-radius: .5rem;
      transition: background .15s ease, transform .15s ease;
    }

    .category-list .list-group-item:hover {
      background: rgba(37, 99, 235, 0.06);
      transform: translateX(4px);
    }

    .latest-list .list-group-item {
      border: 0;
      padding: .75rem 1rem;
    }

    .breaking-card .card-body {
      padding: 1.25rem;
    }

    @media (max-width: 767.98px) {

      .category-list .list-group-item,
      .latest-list .list-group-item {
        padding: .5rem;
      }
    }
  </style>
</head>
<body>
  

  <!-- Navigation Menu -->
   <div style="margin-top: -40px; ">
  <?php echo view('header'); ?>
    </div>
  <div class="container py-4">
    <div class="row">
      <div class="col-lg-8">
        <h2 class="fw-bold"><?php echo $news->title; ?></h2>
        
        <p class="text-muted">Published on <?php echo $date = date('F j, Y', strtotime($news->created_at)); ?> | By <?php echo $news->firstname; ?> <?php echo $news->surname; ?></p>
        <div class="d-flex justify-content-between align-items-center mt-3">
          <p class="card-text">Share with friends:</p>
          <div class="btn-group">
            <a href="https://www.facebook.com/sharer.php?u=<?php echo base_url(); ?>single_news/<?php echo $news->newsid; ?>&picture=<?php echo urlencode(base_url() . 'assets/uploads/' . $news->cover_picture); ?>" target="_blank" class="btn btn-primary"><i class="fab fa-facebook"></i></a>
            <a href="https://wa.me/?text=📰 *<?php echo urlencode($news->title); ?>*%0A%0A<?php echo urlencode(substr(strip_tags($news->content), 0, 100)); ?>...%0A%0A<?php echo base_url(); ?>single_news/<?php echo $news->newsid; ?>" target="_blank" class="btn btn-primary"><i class="fab fa-whatsapp-square"></i></a>
            <a href="https://twitter.com/intent/tweet?text=<?php echo $news->title; ?>&url=<?php echo base_url(); ?>single_news/<?php echo $news->newsid; ?>" target="_blank" class="btn btn-primary"><i class="fab fa-twitter-square"></i></a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url(); ?>single_news/<?php echo $news->newsid; ?>&title=<?php echo $news->title; ?>&source=<?php echo urlencode(base_url() . 'assets/uploads/' . $news->cover_picture); ?>" target="_blank" class="btn btn-primary"><i class="fab fa-linkedin"></i></a>
            <a href="https://www.instagram.com/sharer.php?u=<?php echo base_url(); ?>single_news/<?php echo $news->newsid; ?>" target="_blank" class="btn btn-primary"><i class="fab fa-instagram-square"></i></a>
          </div>
        </div>
        <img src="<?php echo base_url(); ?>assets/uploads/<?php echo $news->cover_picture; ?>" class="img-fluid rounded mb-3 news-image" alt="news">
        <h6 class="text-muted">dailybytesng.com</h6>
        <h3 class="fw-bold"><?php echo $news->title; ?> - <span class="text-muted">Dailybytes NG</span> </h3>
        <div class="article-body" style="text-align: justify;">
         <?php echo preg_replace('/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/i', '', $news->content); ?>
         

        </div>
        <div class="d-flex justify-content-between align-items-center mt-3">
          <p class="card-text">Share with friends:</p>
          <div class="btn-group">
            <a href="https://www.facebook.com/sharer.php?u=<?php echo base_url(); ?>single_news/<?php echo $news->newsid; ?>&picture=<?php echo urlencode(base_url() . 'assets/uploads/' . $news->cover_picture); ?>" target="_blank" class="btn btn-primary"><i class="fab fa-facebook"></i></a>
            <a href="https://wa.me/?text=📰 *<?php echo urlencode($news->title); ?>*%0A%0A<?php echo urlencode(substr(strip_tags($news->content), 0, 100)); ?>...%0A%0A<?php echo base_url(); ?>single_news/<?php echo $news->newsid; ?>" target="_blank" class="btn btn-primary"><i class="fab fa-whatsapp-square"></i></a>
            <a href="https://twitter.com/intent/tweet?text=<?php echo $news->title; ?>&url=<?php echo base_url(); ?>single_news/<?php echo $news->newsid; ?>" target="_blank" class="btn btn-primary"><i class="fab fa-twitter-square"></i></a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url(); ?>single_news/<?php echo $news->newsid; ?>&title=<?php echo $news->title; ?>&source=<?php echo urlencode(base_url() . 'assets/uploads/' . $news->cover_picture); ?>" target="_blank" class="btn btn-primary"><i class="fab fa-linkedin"></i></a>
            <a href="https://www.instagram.com/sharer.php?u=<?php echo base_url(); ?>single_news/<?php echo $news->newsid; ?>" target="_blank" class="btn btn-primary"><i class="fab fa-instagram-square"></i></a>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <h5 class="fw-bold border-bottom pb-2 mb-3">More Stories</h5>
        <div class="list-group">
          <?php foreach ($latest_news as $news) { ?>
          <a href="<?php echo base_url(); ?>single_news/<?php echo $news->slug; ?>" class="list-group-item list-group-item-action d-flex align-items-center">
            <img src="<?php echo base_url(); ?>assets/uploads/<?php echo $news->cover_picture; ?>" alt="thumb" class="rounded" style="width:72px;height:50px;object-fit:cover">
            <div class="ms-3">
              <!-- <div class="small text-uppercase text-muted"><?php echo $news->category; ?></div> -->
              <div class="fw-semibold"><?php echo $news->title; ?></div>
              <small class="text-muted"><?php echo $news->category; ?> •

                      <?php $created = $news->created_at ?? null;

                      $timeAgo = '';

                      // if no timestamp, avoid errors
                      if ($created) {
                        // Parse "2025-11-11 16:54:13.798164" (strip microseconds safely)
                        $ts = strtotime(substr($created, 0, 19));
                        $diff = max(0, time() - ($ts ?: 0));

                        $minutes = intdiv($diff, 60);
                        if ($minutes < 1) {
                          $timeAgo = '0 minutes';
                        } elseif ($minutes === 1) {
                          $timeAgo = '1m';
                        } elseif ($minutes < 60) {
                          $timeAgo = $minutes . 'm';
                        } else {
                          $hours = intdiv($diff, 3600);
                          if ($hours === 1) {
                            $timeAgo = '1 hour ago';
                          } elseif ($hours < 24) {
                            $timeAgo = $hours . ' hours ago';
                          } else {
                            $days = intdiv($diff, 86400);
                            if ($days === 1) {
                              $timeAgo = '1 day ago';
                            } elseif ($days < 30) {
                              $timeAgo = $days . ' days ago';
                            } else {
                              $months = intdiv($diff, 2592000); // 30 days approx
                              if ($months <= 1) {
                                $timeAgo = '1 month ago';
                              } else {
                                $timeAgo = $months . ' months ago';
                              }
                            }
                          }
                        }
                      } else {
                        $timeAgo = 'unknown';
                      }
                      ?>

                      <?php echo esc($timeAgo) ?>


                    </small>
            </div>
          </a>
          <?php } ?>
          
      </div>
    </div>
    </div>

    <!-- Ten Most Recent -->
    
  </div>
  <?php echo view('footer'); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>