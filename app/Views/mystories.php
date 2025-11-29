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
  <title>My Stories | Daily Bytes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">My Stories</h3>
    <div>
      <a href="<?php echo site_url('dashboard'); ?>" class="btn btn-primary btn-sm">Home</a>
      <a href="<?php echo site_url('post_news'); ?>" class="btn btn-primary btn-sm">Post News</a>
      <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadYoutubeModal">Upload Video</button>
    </div>
  </div>

  <div class="row g-4">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">My News (<?php echo isset($news) ? count($news) : 0; ?>)</h5>
        </div>
        <div class="card-body">
          <?php if (!empty($news)): ?>
            <div class="row g-3">
              <?php foreach ($news as $n): ?>
                <div class="col-md-6 col-lg-4">
                  <div class="card h-100">
                    <img src="<?php echo base_url('assets/uploads/' . $n->cover_picture); ?>" class="card-img-top" alt="cover" style="height: 160px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                      <h6 class="card-title mb-1"><?php echo esc($n->title); ?></h6>
                      <div class="small text-muted mb-2">
                        <?php
                          $date = $n->created_at ? new DateTime($n->created_at) : null;
                          echo $date ? $date->format('M j, Y') : '';
                        ?>
                        - <?php echo esc($n->category); ?>
                        - Status: <?php echo esc($n->status); ?>
                      </div>
                      <div class="mt-auto d-flex gap-2">
                        <a href="<?php echo site_url('read_news/' . $n->newsid); ?>" class="btn btn-outline-primary btn-sm">View</a>
                        <a href="<?php echo site_url('edit_news/' . $n->newsid); ?>" class="btn btn-outline-secondary btn-sm">Edit</a>
                        <a href="<?php echo site_url('delete_news/' . $n->newsid); ?>" class="btn btn-outline-danger btn-sm">Delete</a>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <div class="text-muted">You have not posted any news yet.</div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">My Videos (<?php echo isset($videos) ? count($videos) : 0; ?>)</h5>
        </div>
        <div class="card-body">
          <?php if (!empty($videos)): ?>
            <div class="row g-3">
              <?php foreach ($videos as $v): ?>
                <div class="col-md-6 col-lg-4">
                  <div class="card h-100">
                    <div class="ratio ratio-16x9">
                      <?php
                        // If $v->video_link is a full YouTube URL, embed via iframe
                        $link = trim($v->video_link);
                        // naive YouTube ID extraction for watch?v= or youtu.be formats
                        $ytId = '';
                        if (preg_match('/v=([^&]+)/', $link, $m)) {
                          $ytId = $m[1];
                        } elseif (preg_match('#youtu\.be/([^?&/]+)#', $link, $m)) {
                          $ytId = $m[1];
                        }
                      ?>
                      <?php if ($ytId): ?>
                       <?php echo esc($link); ?>
                      <?php else: ?>
                       <?php echo $link; ?>
                      <?php endif; ?>`
                    </div>
                    <div class="card-body d-flex flex-column">
                      <h6 class="card-title mb-1"><?php echo esc($v->title); ?></h6>
                      <div class="small text-muted mb-2">
                        <?php
                          $date = $v->created_at ? new DateTime($v->created_at) : null;
                          echo $date ? $date->format('M j, Y') : '';
                        ?>
                        - <?php echo esc($v->category); ?>
                      </div>
                      <p class="small text-truncate-3 mb-2" style="-webkit-line-clamp:3; display:-webkit-box; -webkit-box-orient:vertical; overflow:hidden;"><?php echo esc($v->description); ?></p>
                      <div class="mt-auto d-flex gap-2">
                        <a href="<?php echo site_url('view_video/' . $v->videoid); ?>" class="btn btn-outline-primary btn-sm">View</a>
                        <a href="<?php echo site_url('edit_video/' . $v->videoid); ?>" class="btn btn-outline-secondary btn-sm">Edit</a>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <div class="text-muted">You have not uploaded any videos yet.</div>
          <?php endif; ?>
        </div>
      </div>
    </div>

  </div>
</div>

<?php echo view('footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>


  <div class="modal fade" id="uploadYoutubeModal" tabindex="-1" aria-labelledby="uploadYoutubeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="uploadYoutubeModalLabel">Upload YouTube Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="<?php echo site_url('upload_video') ?>">
                          <div class="mb-2">
                            <label class="form-label">Video Title</label>
                            <input class="form-control" name="title" placeholder="Enter video title">
                          </div>
                          <div class="mb-2">
                            <label class="form-label">YouTube Video URL</label>
                            <input class="form-control" name="video_link" placeholder="https://www.youtube.com/watch?v=...">
                          </div>
                          <div class="mb-2">
                            <label class="form-label">Video Description</label>
                            <textarea class="form-control" name="description" placeholder="Enter video description" rows="4"></textarea>
                          </div>
                          <div class="mb-2">
                            <label class="form-label">Category</label>
                            <select class="form-select" name="categoryid">
                              <option selected disabled>Select a category</option>
                              <?php echo $categoryOptions; ?>
                            </select>
                          </div>
                          <button type="submit" class="btn btn-primary">Upload Video</button>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Upload Video</button>
                      </div>
                    </div>
                  </div>
                </div>




</html>