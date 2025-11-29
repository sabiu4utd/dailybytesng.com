<?php
  $categoryOptions = "";
  foreach ($categories as $category) {
    $categoryOptions .= "<option value='" . $category->categoryid . "'>" . $category->category . "</option>";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Publisher Dashboard | Daily Bytes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <style>
    body{font-family:'Inter',sans-serif}
    .ql-editor{min-height:300px}
    .editor-label{font-weight:600}
  </style>
</head>
<body class="bg-light">
  <nav class="navbar navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="#">Daily Bytes Publisher</a>
      <a href="<?php echo site_url('dashboard') ?>" class="btn btn-light btn-sm">Home</a>
    </div>
  </nav>
  <div class="bg-white border-bottom">
    <div class="container d-flex justify-content-between align-items-center py-2">
      <div class="fw-semibold text-secondary">Publisher Dashboard</div>
      <a href="<?php echo site_url('dashboard') ?>" class="btn btn-sm btn-outline-primary">Home</a>
    </div>
  </div>
  <div class="container py-4">
    <h4 class="mb-3">Publish New Article</h4>
    <form id="publishForm" method="POST" action="<?php echo site_url('post_news') ?>" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">News Title</label>
        <input id="title" name="title" type="text" class="form-control" placeholder="Enter headline">
      </div>
      <div class="mb-3">
        <label class="form-label">Category</label>
        <select id="category" name="categoryid" class="form-select">
          <?php echo $categoryOptions; ?>
         
        </select>
      </div>
      <div class="mb-3">
       
        <div class="form-check form-switch">
          <input class="form-check-input" name="breaking_news" value="Yes" type="checkbox" id="flexSwitchCheckDefault">
          <label class="form-check-label" for="flexSwitchCheckDefault">Breaking News?</label>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label">Upload Cover Picture</label>
        <input type="file" class="form-control" name="cover_picture" accept="image/*">
      </div>

      <div class="mb-3">
        <label class="form-label editor-label">Content</label>
        <!-- Quill editor container -->
        <div id="quillToolbar">
          <!-- Add toolbar options -->
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
            <!-- <button class="ql-video"></button> -->
            <button class="ql-clean"></button>
          </span>
          <span class="ql-formats">
            <button class="ql-list" value="ordered"></button>
            <button class="ql-list" value="bullet"></button>
            <button class="ql-blockquote"></button>
          </span>
        </div>
        <div id="editor"></div>
        <!-- Hidden field to submit HTML content -->
        <input type="hidden" name="content" id="contentInput">
      </div>
      <button type="submit" class="btn btn-primary">Publish News</button>
    </form>
  </div>
  <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
  <script>
    // Initialize Quill
    const quill = new Quill('#editor', {
      theme: 'snow',
      modules: {
        toolbar: '#quillToolbar'
      }
    });

    // On form submit, put editor HTML into hidden input
    document.getElementById('publishForm').addEventListener('submit', function(e){
      const html = quill.root.innerHTML;
      document.getElementById('contentInput').value = html;
      // For now prevent default and show preview in console
      // Remove the next line when hooking up to a backend
      // e.preventDefault();
      // console.log('Submitting content:', html);
    });
  </script>
</body>
</html>