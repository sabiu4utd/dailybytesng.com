<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daily Bytes | Archived News</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root { --primary-color:#2563eb; --secondary-color:#1e40af; --text-primary:#1f2937; --text-secondary:#4b5563; --bg-light:#f8fafc; }
    body { font-family:'Inter',sans-serif; color:var(--text-primary); background-color:var(--bg-light); }
    .card { transition: transform .3s ease, box-shadow .3s ease; }
    .card:hover { transform: translateY(-2px); box-shadow:0 10px 20px rgba(0,0,0,.1)!important; }
    .object-fit-cover{ object-fit:cover; }
  </style>
</head>
<body>
 

  <div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h3 class="mb-0 fw-bold">Archived News</h3>
      <span class="text-muted">
      <div>
    <?php if(isset($_SESSION['role'])) { ?>
      <a href="<?php echo site_url('dashboard'); ?>" class="btn btn-primary btn-sm">Home</a>
    <?php } ?>
     
    </div>  
      <?php echo isset($news) ? count($news) : 0; ?> articles</span>
    </div>

    
<hr>
    <?php if (!empty($news)) { ?>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
        <?php foreach ($news as $item) { ?>
          <div class="col">
            <div class="card border-0 shadow-sm h-100">
              <div class="position-relative">
                <img
                  src="<?php echo base_url(); ?>assets/uploads/<?php echo esc($item->cover_picture); ?>"
                  class="card-img-top object-fit-cover"
                  alt="cover"
                  style="height:180px;">
                <span class="badge bg-secondary position-absolute top-0 start-0 m-2">Archived</span>
              </div>
              <div class="card-body d-flex flex-column">
                <h5 class="card-title mb-2">
                  <a href="<?php echo base_url(); ?>single_news/<?php echo $item->newsid; ?>" class="text-decoration-none text-dark">
                    <?php echo esc($item->title); ?>
                  </a>
                </h5>
                <div class="small text-muted mb-2">
                  By <?php echo esc($item->firstname ?? ''); ?> <?php echo esc($item->surname ?? ''); ?> •
                  <?php
                    $created = $item->created_at ?? null;
                    $timeAgo = '';
                    if ($created) {
                      $ts = strtotime(substr($created, 0, 19));
                      $diff = max(0, time() - ($ts ?: 0));
                      $days = intdiv($diff, 86400);
                      if ($days < 1) { $timeAgo = 'today'; }
                      elseif ($days === 1) { $timeAgo = '1 day ago'; }
                      elseif ($days < 30) { $timeAgo = $days . ' days ago'; }
                      else { $months = intdiv($diff, 2592000); $timeAgo = ($months <= 1) ? '1 month ago' : ($months . ' months ago'); }
                    } else { $timeAgo = 'unknown'; }
                    echo esc($timeAgo);
                  ?>
                </div>
                <div class="mt-auto">
                  <a href="<?php echo base_url(); ?>single_news/<?php echo $item->newsid; ?>" class="btn btn-sm btn-primary">Read more</a>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    <?php } else { ?>
      <div class="alert alert-info">No archived news found.</div>
    <?php } ?>
  </div>

  <?php echo view('footer'); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>