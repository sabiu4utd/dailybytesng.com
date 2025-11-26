<!DOCTYPE html>
<?php //var_dump($latest_news); 
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daily Bytes | Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
  <!-- Logo Section -->
  <?php echo view('header'); ?>
  <section class="container py-4">
    <div class="row g-4">
      <!-- Column 1: Category News -->
      <aside class="col-lg-3">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-header bg-white border-0">
            <h5 class="mb-0 fw-bold text-primary">Category Updates</h5>
          </div>
          <div class="card-body p-0">
            <div class="list-group list-group-flush category-news">
              <!-- Sports News -->
              <?php foreach($categories as $row) {?>
              <a href="<?php echo site_url('category_news'); ?>/<?php echo $row->categoryid; ?>" class="list-group-item border-0 p-3">
                <div class="position-relative mb-2">
                  <img src="<?php echo base_url(); ?>assets/uploads/<?php echo $row->cover_picture; ?>" class="rounded w-100" style="height: 120px; object-fit: cover;" alt="Sports News">
                  <span class="badge bg-primary position-absolute top-0 end-0 m-2"><?php echo $row->category; ?></span>
                </div>
                <h6 class="mb-1 fw-semibold"><?php echo $row->title; ?></h6>
                <small class="text-muted"><?php echo $row->category; ?> •

                      <?php $created = $row->created_at ?? null;

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
              </a>
              <?php } ?>  
             
            </div>
          </div>
        </div>
      </aside>

      <!-- Column 2: Breaking News (featured) -->
      <?php if ($news) { ?>
        <main class="col-lg-6">
          <div class="card border-0 shadow-sm breaking-card mb-4">
            <img src="<?php echo base_url(); ?>assets/uploads/<?php echo $news->cover_picture; ?>" class="card-img-top object-fit-cover" alt="Breaking Image" style="max-height:360px;">
            <div class="card-body">
              <span class="badge bg-primary mb-2">Breaking</span>
              <h3 class="card-title">Breaking: <?php echo $news->title; ?></h3>
              <p class="text-muted">

                <?php echo $date = date('F j, Y', strtotime($news->created_at)); ?> | By <strong><?php echo $news->firstname; ?> <?php echo $news->surname; ?></strong>

              </p>
                <p class="card-text"><?php echo implode('</p><p class="card-text">', array_slice(explode('</p>', $news->content, 4), 0, 3)); ?></p>
              <a href="<?php echo base_url(); ?>single_news/<?php echo $news->newsid; ?>" class="btn btn-primary">Read Full Story</a>
            </div>
          </div>
<?php } ?>
          <!-- Additional breaking headlines -->
           <?php if (isset($videos) && !empty($videos)) { ?>
            <div class="row g-3">
            <?php foreach ($videos as $video) { ?>
              <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3">
                  <h6 class="mb-2"><?php echo $video->title; ?></h6>
                  <div class="ratio ratio-16x9 mb-2">
                    <?php echo $video->video_link; ?>
                  </div>
                  <p class="text-muted small mb-0">
                    <?php echo $video->description; ?>
                  </p>
                </div>
              </div>
            <?php } ?>
            </div>
           <?php } ?>
           
           
        </main>
      
      <!-- Column 3: Latest News -->
      <aside class="col-lg-3">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-header bg-white border-0">
            <h5 class="mb-0 fw-bold text-primary">Latest News</h5>
          </div>
          <div class="card-body latest-list p-0">
            <div class="list-group list-group-flush">

              <?php foreach ($latest_news as $news) { ?>
                <a href="<?php echo base_url(); ?>single_news/<?php echo $news->newsid; ?>" class="list-group-item d-flex align-items-start">
                  <img src="<?php echo base_url(); ?>assets/uploads/<?php echo $news->cover_picture; ?>" class="rounded me-3" style="width:72px;height:50px;object-fit:cover" alt="thumb">
                  <div>
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
      </aside>
    </div>
  </section>
  <?php echo view('footer'); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>