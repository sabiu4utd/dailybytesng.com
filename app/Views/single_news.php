<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daily Bytes | News Detail</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root{--primary-color:#2563eb;--text-primary:#1f2937;--bg-light:#f8fafc}
    body{font-family:'Inter',sans-serif;color:var(--text-primary);background-color:var(--bg-light)}
    .logo-top{padding:1rem 0;border-bottom:1px solid rgba(0,0,0,0.05);background:#fff}
    .logo-top img{height:80px;transition:transform .25s ease}
    .logo-top a:hover img{transform:scale(1.03)}
    .site-nav{padding:.5rem 0}
    .site-nav .nav-link{padding:.35rem .6rem;border-radius:4px;font-weight:500}
    .site-nav .nav-link.active{background:var(--primary-color);color:#fff!important}
    .news-image{width:100%;height:auto;max-height:450px;object-fit:cover}
    .recent-list .list-group-item{border:0;padding:.75rem 1rem}
    .recent-list .list-group-item:hover{background:rgba(37,99,235,0.04);transform:translateX(4px)}
    .recent-list img{width:90px;height:60px;object-fit:cover}
    .card-header h5{position:relative;display:inline-block;padding-bottom:6px}
    .card-header h5::after{content:'';position:absolute;bottom:0;left:0;width:50px;height:3px;background:var(--primary-color);border-radius:3px}
  </style>
</head>
<body>
  

  <!-- Navigation Menu -->
   <?php echo view('header'); ?>
  <div class="container py-4">
    <div class="row">
      <div class="col-lg-8">
        <h2 class="fw-bold"><?php echo $news->title; ?></h2>
        <p class="text-muted">Published on <?php echo $date = date('F j, Y', strtotime($news->created_at)); ?> | By <?php echo $news->firstname; ?> <?php echo $news->surname; ?></p>
        <img src="<?php echo base_url(); ?>assets/uploads/<?php echo $news->cover_picture; ?>" class="img-fluid rounded mb-3 news-image" alt="news">
        <div class="article-body">
         <?php echo $news->content; ?>
        </div>
      </div>
      <div class="col-lg-4">
        <h5 class="fw-bold border-bottom pb-2 mb-3">More Stories</h5>
        <div class="list-group">
          <?php foreach ($latest_news as $news) { ?>
          <a href="<?php echo base_url(); ?>single_news/<?php echo $news->newsid; ?>" class="list-group-item list-group-item-action d-flex align-items-center">
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
  <footer class="bg-primary text-white text-center py-3">
    <p class="mb-0">&copy; 2025 Daily Bytes. All Rights Reserved.</p>
  </footer>
</body>
</html>