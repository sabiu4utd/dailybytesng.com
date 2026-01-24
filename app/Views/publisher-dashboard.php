<?php
  $categoryOptions = "";
  foreach ($categories as $category) {
    $categoryOptions .= "<option value='" . $category->categoryid . "'>" . htmlspecialchars($category->category) . "</option>";
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Publisher Dashboard | Daily Bytes</title>
    <link rel="icon" type="image/jpeg" href="<?= base_url('assets/images/logo.jpg') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
      :root{--brand:#0d6efd;--muted:#6c757d}
      body{font-family:'Inter',sans-serif;background:#f6f8fb;color:#222}
      .app-shell{min-height:100vh;display:flex}
      .sidebar{width:260px;background:#0b5ed7;color:#fff;padding:20px}
      .sidebar .brand{font-weight:700;font-size:18px}
      .sidebar a{color:#eaf2ff;text-decoration:none}
      .content-area{flex:1;padding:24px}
      .card-ghost{background:#fff;border-radius:10px;padding:18px;box-shadow:0 6px 18px rgba(16,24,40,0.06)}
      .ql-editor{min-height:320px}
      .muted{color:var(--muted)}
      .stats .stat{background:linear-gradient(180deg,#fff,#f8fbff);border-radius:8px;padding:12px}
      @media (max-width:768px){.sidebar{display:none}.content-area{padding:12px}}
    </style>
  </head>
  <body>
    <div class="app-shell">
      <aside class="sidebar">
        <div class="mb-4">
          <div class="brand">Daily Bytes</div>
          <div class="small muted">Publisher Console</div>
        </div>
        <nav class="mt-4">
          <div class="mb-2"><a href="<?= site_url('dashboard') ?>">🏠 Dashboard</a></div>
          <!-- <div class="mb-2"><a href="#publish">✍️ Publish</a></div>
          <div class="mb-2"><a href="#manage">📋 Manage Posts</a></div>
          <div class="mb-2"><a href="#drafts">📝 Drafts</a></div> -->
          <div class="mt-4"><a href="<?= site_url('logout') ?>" class="btn btn-sm btn-dark">Logout</a></div>
        </nav>
      </aside>

      <main class="content-area">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <div>
            <h3 class="mb-0">Publisher Dashboard</h3>
            <div class="text-muted small">Create and manage your articles</div>
          </div>
          <div class="d-flex gap-2 align-items-center">
            <a href="<?= site_url('dashboard') ?>" class="btn btn-outline-secondary btn-sm">Home</a>
            <!-- <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#previewModal">Preview Last</button> -->
          </div>
        </div>

        <div class="row g-4">
          <div class="col-lg-8">
            <section id="publish" class="card-ghost">
              <h5 class="mb-3">Publish New Article</h5>
              <form id="publishForm" method="POST" action="<?php echo site_url('post_news') ?>" enctype="multipart/form-data">
                <div class="row g-3">
                  <div class="col-md-8">
                    <label class="form-label">Headline</label>
                    <input id="title" name="title" type="text" class="form-control" placeholder="Enter a compelling headline" required>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">Category</label>
                    <select id="category" name="categoryid" class="form-select" required>
                      <option value="">Select category</option>
                      <?php echo $categoryOptions; ?>
                    </select>
                  </div>
                </div>

                <div class="row g-3 mt-2">
                  <div class="col-md-6">
                    <div class="form-check form-switch">
                      <input class="form-check-input" name="breaking_news" value="Yes" type="checkbox" id="breakingSwitch">
                      <label class="form-check-label" for="breakingSwitch">Mark as Breaking</label>
                    </div>
                  </div>
                  <div class="col-md-6 text-md-end">
                    <label class="form-label d-block">Cover Image</label>
                    <input type="file" class="form-control" name="cover_picture" accept="image/*">
                  </div>
                </div>

                <div class="mt-3">
                  <label class="form-label">Content</label>
                  <div id="quillToolbar">
                    <span class="ql-formats">
                      <select class="ql-header">
                        <option selected></option>
                        <option value="1"></option>
                        <option value="2"></option>
                      </select>
                      <button class="ql-bold"></button>
                      <button class="ql-italic"></button>
                      <button class="ql-underline"></button>
                      <button class="ql-link"></button>
                      <button class="ql-image"></button>
                      <button class="ql-clean"></button>
                    </span>
                    <span class="ql-formats">
                      <button class="ql-list" value="ordered"></button>
                      <button class="ql-list" value="bullet"></button>
                      <button class="ql-blockquote"></button>
                    </span>
                  </div>
                  <div id="editor" class="mt-2"></div>
                  <input type="hidden" name="content" id="contentInput">
                </div>

                <div class="d-flex gap-2 mt-3">
                  <button type="submit" class="btn btn-success">Publish</button>
                  <button type="button" class="btn btn-outline-secondary" id="saveDraftBtn">Save Draft</button>
                  <button type="button" class="btn btn-outline-secondary" id="clearBtn">Clear</button>
                </div>
              </form>
            </section>

            <!-- <section id="manage" class="mt-4 card-ghost">
              <h5 class="mb-3">Recent Posts</h5>
              <div class="table-responsive">
                <table class="table table-hover small">
                  <thead class="table-light">
                    <tr>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Date</th>
                      <th>Status</th>
                      <th class="text-end">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Sample breaking news headline</td>
                      <td>World</td>
                      <td>2025-11-30</td>
                      <td><span class="badge bg-success">Published</span></td>
                      <td class="text-end"><button class="btn btn-sm btn-outline-secondary">Edit</button> <button class="btn btn-sm btn-outline-danger">Delete</button></td>
                    </tr>
                    <tr>
                      <td>Feature: Tech trends</td>
                      <td>Technology</td>
                      <td>2025-11-28</td>
                      <td><span class="badge bg-warning text-dark">Draft</span></td>
                      <td class="text-end"><button class="btn btn-sm btn-outline-secondary">Edit</button> <button class="btn btn-sm btn-outline-danger">Delete</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </section> -->
          </div>

          <div class="col-lg-4">
            <aside class="card-ghost">
              <h6 class="mb-3">Quick Stats</h6>
              <div class="row g-2 stats">
                <div class="col-6"><div class="stat text-center"><div class="fw-bold">124</div><div class="muted">Articles</div></div></div>
                <div class="col-6"><div class="stat text-center"><div class="fw-bold">8</div><div class="muted">Published</div></div></div>
                <div class="col-6 mt-2"><div class="stat text-center"><div class="fw-bold">52k</div><div class="muted">Pending</div></div></div>
                <div class="col-6 mt-2"><div class="stat text-center"><div class="fw-bold">3</div><div class="muted">Breaking</div></div></div>
              </div>

              <!-- <hr class="my-3">
              <h6 class="mb-2">Drafts</h6>
              <ul class="list-unstyled small">
                <li>— Local elections overview <span class="text-muted">(edit)</span></li>
                <li>— Upcoming startup funding <span class="text-muted">(edit)</span></li>
              </ul> -->

              <hr class="my-3">
              <h6 class="mb-2">Help & Tips</h6>
              <p class="small muted">Use the editor toolbar to format text. Click Publish when ready. Cover images should be at least 1200px wide.</p>
            </aside>
          </div>
        </div>
      </main>
    </div>

    <!-- Preview modal (static) -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Preview</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <article>
              <h2 id="previewTitle">Preview Title</h2>
              <div id="previewContent">Preview content will appear here.</div>
            </article>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
      const quill = new Quill('#editor', { theme: 'snow', modules: { toolbar: '#quillToolbar' } });

      // On form submit, copy content
      document.getElementById('publishForm').addEventListener('submit', function(e){
        const html = quill.root.innerHTML;
        document.getElementById('contentInput').value = html;
      });

      // Preview last content in modal
      document.querySelector('[data-bs-target="#previewModal"]').addEventListener('click', function(){
        const title = document.getElementById('title').value || 'Untitled';
        document.getElementById('previewTitle').textContent = title;
        document.getElementById('previewContent').innerHTML = quill.root.innerHTML;
      });

      // Save Draft (static behaviour: show alert)
      document.getElementById('saveDraftBtn').addEventListener('click', function(){
        alert('Draft saved (static demo).');
      });

      // Clear editor
      document.getElementById('clearBtn').addEventListener('click', function(){
        if(confirm('Clear the editor and fields?')){
          document.getElementById('title').value = '';
          quill.setText('');
        }
      });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>