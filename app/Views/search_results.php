<?php // app/Views/search_results.php
/**
 * Expects:
 * - $news: array of news objects (newsid, slug, title, cover_picture, created_at, firstname, surname, category)
 * - $search_query: string
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Search results for "<?php echo esc($search_query); ?>"</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f8fafc; font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; color:#111827; }
    .result-card { transition: transform .15s ease, box-shadow .15s ease; }
    .result-card:hover { transform: translateY(-4px); box-shadow: 0 8px 20px rgba(0,0,0,.06); }
    .excerpt { color: #6b7280; }
  </style>
</head>
<body>
  <?php echo view('header'); ?>
  <main class="container py-5">
    <div class="row">
      <div class="col-12">
        <h2 class="fw-bold">Search results</h2>
        <p class="text-muted">Results for: <strong><?php echo esc($search_query); ?></strong></p>
      </div>
    </div>

    <?php if (empty($news)) : ?>
      <div class="row">
        <div class="col-12">
          <div class="alert alert-info">No results found for "<?php echo esc($search_query); ?>".</div>
        </div>
      </div>
    <?php else: ?>
      <div class="row g-4">
        <?php foreach ($news as $n): ?>
          <?php $identifier = !empty($n->slug) ? $n->slug : $n->newsid; ?>
          <?php $url = base_url('single_news/' . $identifier); ?>
          <div class="col-12">
            <a href="<?php echo esc($url); ?>" class="text-decoration-none text-reset">
              <div class="card result-card shadow-sm border-0">
                <div class="row g-0 align-items-center">
                  <div class="col-md-3">
                    <img src="<?php echo base_url('assets/uploads/' . ($n->cover_picture ?? '')); ?>" alt="<?php echo esc($n->title); ?>" class="img-fluid rounded-start object-fit-cover" style="height:120px; width:100%; object-fit:cover;">
                  </div>
                  <div class="col-md-9">
                    <div class="card-body">
                      <h5 class="card-title mb-1"><?php echo esc($n->title); ?></h5>
                      <small class="text-muted"><?php echo esc($n->category ?? ''); ?> • <?php echo date('F j, Y', strtotime(substr($n->created_at ?? '', 0, 19))) ?? ''; ?> • by <?php echo esc(trim(($n->firstname ?? '') . ' ' . ($n->surname ?? ''))); ?></small>
                      <p class="card-text mt-2 excerpt">
                        <?php echo esc(strlen(strip_tags($n->content ?? '')) > 220 ? substr(strip_tags($n->content), 0, 220) . '...' : strip_tags($n->content)); ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <div class="row mt-4">
      <div class="col-12">
        <a href="<?php echo base_url(); ?>" class="btn btn-outline-primary">Back to Home</a>
      </div>
    </div>
  </main>

  <?php echo view('footer'); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
