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
    body {
      font-family: 'Inter', sans-serif
    }

    .ql-editor {
      min-height: 300px
    }

    .editor-label {
      font-weight: 600
    }
  </style>
</head>

<body class="bg-light">
  <nav class="navbar navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="#">Daily Bytes Publisher</a>
      <a href="<?php echo site_url('logout') ?>" class="btn btn-light btn-sm">Logout</a>
    </div>
  </nav>
  <div class="bg-white border-bottom">
    <div class="container d-flex justify-content-between align-items-center py-2">
      <div class="fw-semibold text-secondary">Publisher Dashboard</div>
      <a href="<?php echo site_url('logout') ?>" class="btn btn-sm btn-outline-primary">Logout</a>
    </div>
  </div>
  <div class="container py-4">
    <h4 class="mb-3">Update Video Content</h4>

    <form method="POST" action="<?php echo site_url('update_video') ?>">
      <div class="mb-2">
        <label class="form-label">Video Title</label>
        <input class="form-control" name="title" placeholder="Enter video title" value="<?php echo $video->title; ?>">
      </div>
      <div class="mb-2">
        <label class="form-label">YouTube Video URL [Insert new video url or ignore it]</label>
        <input class="form-control" name="video_link" placeholder="https://www.youtube.com/watch?v=..."  >
      </div>
      <div class="mb-2">
        <label class="form-label">Video Description</label>
        <textarea class="form-control" name="description" placeholder="Enter video description" rows="4"><?php echo $video->description; ?></textarea>
      </div>
      <div class="mb-2">
        <label class="form-label">Category</label>
        <select class="form-select" name="categoryid">
          <option value="<?php echo $category->categoryid; ?>"><?php echo $category->category; ?></option>
         
          <?php echo $categoryOptions; ?>
        </select>
      </div>
      <input type="hidden" name="videoid" value="<?php echo $video->videoid; ?>">
      <input type="hidden" name="uploaded_by" value="<?php echo $video->uploaded_by; ?>">

      <button type="submit" class="btn btn-primary">Update Video</button>
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
    document.getElementById('publishForm').addEventListener('submit', function(e) {
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