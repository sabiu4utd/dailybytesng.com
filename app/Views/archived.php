<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daily Bytes — Archived News</title>
    <link rel="icon" type="image/jpeg" href="<?= base_url('assets/images/logo.jpg') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
      :root{--brand:#2563eb;--muted:#6b7280;--bg:#f6f9fc}
      body{font-family:'Inter',sans-serif;background:var(--bg);color:#0f172a}
      .container-xl{max-width:1200px}
      .hero{background:linear-gradient(90deg,rgba(37,99,235,0.06),rgba(99,102,241,0.03));border-radius:12px;padding:22px;margin-bottom:18px}
      .hero h1{font-size:1.5rem;margin:0}
      .hero .meta{color:var(--muted)}
      .filters{background:#fff;border-radius:10px;padding:14px;margin-bottom:18px;box-shadow:0 6px 18px rgba(2,6,23,0.06)}
      .archive-grid{display:grid;grid-template-columns:repeat(1,1fr);gap:18px}
      @media(min-width:576px){.archive-grid{grid-template-columns:repeat(2,1fr)}}
      @media(min-width:992px){.archive-grid{grid-template-columns:repeat(3,1fr)}}
      .archive-card{background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 6px 18px rgba(2,6,23,.06);display:flex;flex-direction:column;height:100%}
      .archive-card .cover{height:160px;width:100%;object-fit:cover}
      .badge-arch{position:absolute;left:10px;top:10px;background:rgba(15,23,42,.85);color:#fff;padding:.35rem .6rem;border-radius:6px;font-size:.8rem}
      .card-body{padding:14px;display:flex;flex-direction:column;gap:8px}
      .card-title{font-size:1rem;margin:0}
      .excerpt{color:var(--muted);font-size:.95rem}
      .meta-row{display:flex;justify-content:space-between;gap:10px;color:var(--muted);font-size:.85rem}
      .actions{display:flex;gap:8px}
      .actions .btn{padding:.35rem .6rem}
      .empty{padding:36px;background:#fff;border-radius:12px;text-align:center;color:var(--muted)}
    </style>
  </head>
  <body>
    <div class="container container-xl py-4">
      <div class="hero d-flex justify-content-between align-items-center">
        <div>
          <h1 class="mb-1">Archived News</h1>
          <div class="meta">A curated list of archived articles — safe to review and restore.</div>
        </div>
        <div class="text-end">
          <?php if(isset($_SESSION['role'])): ?>
            <a href="<?= site_url('dashboard') ?>" class="btn btn-sm btn-outline-primary">Back to dashboard</a>
          <?php endif; ?>
          <div class="small text-muted mt-1 text-end"><?= isset($news) ? count($news) : 0 ?> articles</div>
        </div>
      </div>

      <div class="filters d-flex flex-column flex-md-row gap-2 align-items-center">
        <input id="searchInput" class="form-control form-control-lg" placeholder="Search archived titles or authors" aria-label="Search archived news">
        <select id="categoryFilter" class="form-select w-auto">
          <option value="">All categories</option>
          <?php if(!empty($categories)): foreach($categories as $cat): ?>
            <option value="<?= esc($cat->category) ?>"><?= esc($cat->category) ?></option>
          <?php endforeach; endif; ?>
        </select>
        <div class="ms-auto d-flex gap-2">
          <button id="clearFilters" class="btn btn-outline-secondary btn-sm">Clear</button>
          <button id="exportBtn" class="btn btn-primary btn-sm">Export</button>
        </div>
      </div>

      <?php if (!empty($news)): ?>
        <div id="archiveGrid" class="archive-grid mt-3">
          <?php foreach ($news as $item): ?>
            <?php $img = $item->cover_picture ? base_url('assets/uploads/' . $item->cover_picture) : 'https://via.placeholder.com/800x480?text=No+Image'; ?>
            <?php $excerpt = isset($item->content) ? strip_tags($item->content) : ''; $excerpt = mb_substr($excerpt,0,140).'...'; ?>
            <article class="archive-card" data-title="<?= strtolower(esc($item->title)) ?>" data-author="<?= strtolower(esc(trim($item->firstname . ' ' . $item->surname))) ?>" data-category="<?= strtolower(esc($item->category)) ?>">
              <div style="position:relative">
                <img src="<?= $img ?>" alt="<?= esc($item->title) ?>" class="cover">
                <span class="badge-arch">Archived</span>
              </div>
              <div class="card-body">
                <h3 class="card-title"><a href="<?= base_url('single_news/' . $item->newsid) ?>" class="text-dark text-decoration-none"><?= esc($item->title) ?></a></h3>
                <div class="excerpt"><?= esc($excerpt) ?></div>
                <div class="meta-row">
                  <div>By <?= esc($item->firstname . ' ' . $item->surname) ?></div>
                  <div><?= date('d M Y', strtotime($item->created_at)) ?></div>
                </div>
                <div class="mt-2 actions">
                  <a class="btn btn-sm btn-outline-primary" href="<?= base_url('single_news/' . $item->newsid) ?>">Read</a>
                  <button class="btn btn-sm btn-outline-success" disabled title="Restore (server action)">Restore</button>
                </div>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <div class="mt-3 empty">No archived news found.</div>
      <?php endif; ?>

      <div class="mt-4 text-center small text-muted">End of archive</div>
    </div>

    <?php echo view('footer'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // Client-side search + filter (lightweight)
      (function(){
        const input = document.getElementById('searchInput');
        const cat = document.getElementById('categoryFilter');
        const clear = document.getElementById('clearFilters');
        const grid = document.getElementById('archiveGrid');
        if(!grid) return;
        const cards = Array.from(grid.querySelectorAll('.archive-card'));

        function applyFilter(){
          const q = input.value.trim().toLowerCase();
          const c = cat.value.trim().toLowerCase();
          cards.forEach(card => {
            const title = card.dataset.title || '';
            const author = card.dataset.author || '';
            const category = card.dataset.category || '';
            const matchQ = q === '' || title.includes(q) || author.includes(q);
            const matchC = c === '' || category === c;
            card.style.display = (matchQ && matchC) ? '' : 'none';
          });
        }

        input.addEventListener('input', applyFilter);
        cat.addEventListener('change', applyFilter);
        clear.addEventListener('click', function(){ input.value=''; cat.value=''; applyFilter(); });
        document.getElementById('exportBtn')?.addEventListener('click', function(){ alert('Export is a placeholder in this demo.'); });
      })();
    </script>
  </body>
</html>