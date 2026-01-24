<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Article | Daily Bytes</title>
    <link rel="icon" type="image/jpeg" href="<?= base_url('assets/images/logo.jpg') ?>">
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


    <div class="toolbar">
        <div class="container py-2 d-flex align-items-center justify-content-between">
            <div class="fw-semibold">Review Article</div>
            <div class="d-flex gap-2">
                <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Make Comment</a>
                <a href="<?php echo site_url('publish_vid') ?>/<?php echo $video->videoid; ?>" class="btn btn-primary">Publish</a>
            </div>
        </div>
    </div>

    <div class="container py-4">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card p-3 p-md-4">
                    <div class="article">
                        <h2 class="mb-2"><?php echo $video->title; ?></h2>
                        <div class="meta mb-3">
                            Submitted on
                            <?php

                            $date = new DateTime($video->created_at);
                            echo $date->format('F j, Y');

                            ?>
                            • By <?php echo $video->firstname . ' ' . $video->surname . ' ' . $video->othername; ?> • Category: <?php echo $video->category; ?>
                        </div>
                       <div class="ratio ratio-16x9 mb-2">

                            <?php echo $video->video_link; ?>
                        </div>
                        <div class="content" style="text-align: justify;">
                            <?php echo $video->description; ?>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <a href="#" class="btn btn-outline-danger">Decline</a>
                        <a href="<?php echo site_url('publish_vid') ?>/<?php echo $video->videoid; ?>" class="btn btn-primary">Publish</a>
                    </div>
                </div>
            </div>
             <div class="col-lg-4">
        <div class="card p-3 p-md-3">
          Comments
          <hr>
          <div>
              <?php foreach ($comments as $comment): ?>
                <div class="small mb-1"><span class="text-muted">Comment:</span> 
                  <?php echo $comment->comment; ?>
                </div>
                <div class="small mb-1"><span class="text-muted">Commented on:</span> 
                <?php 
                  $date = new DateTime($comment->created_at);
                  echo $date->format('d-m-Y - H:i:s'); 
                  echo "<br /><br />";
                ?>
              <?php endforeach; ?>
                
              </div>
          </div> 
        </div>

      </div>


        </div>
    </div>

    <?php echo view('footer'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Comments</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?php echo site_url('save_comment') ?>" method="POST">
            <textarea name="comment" class="form-control" rows='10'></textarea>
            <br />
            <input type="hidden" value="<?php echo $video->videoid; ?>" name="newsid">
            <input type="submit" value="POST" class="btn btn-primary">

          </form>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
      </div>
    </div>
  </div>
</body>

</html>