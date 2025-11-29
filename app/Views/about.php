<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us | Daily Bytes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root { --primary-color:#2563eb; --text-primary:#1f2937; --text-secondary:#4b5563; --bg-light:#f8fafc; }
    body { font-family:'Inter',sans-serif; color:var(--text-primary); background:var(--bg-light); }
    .section-title { color:var(--primary-color); }
    .card { border:0; box-shadow:0 4px 12px rgba(0,0,0,.06); }
  </style>
</head>
<body>
  <?php echo view('header'); ?>

  <main class="container py-5">
    <div class="row g-4">
      <div class="col-12">
        <h1 class="fw-bold mb-4">About Us</h1>
      </div>

      <div class="col-lg-4">
        <div class="card h-100">
          <div class="card-body">
            <h3 class="section-title h5 fw-bold mb-3">Our Mission</h3>
            <p class="mb-0">We deliver timely, accurate, and engaging news and stories that inform, educate, and inspire our audience across Nigeria and beyond.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card h-100">
          <div class="card-body">
            <h3 class="section-title h5 fw-bold mb-3">Who We Are</h3>
            <p class="mb-0">Daily Bytes is a modern digital news platform covering politics, business, sports, entertainment, and more, with a focus on integrity and clarity.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card h-100">
          <div class="card-body">
            <h3 class="section-title h5 fw-bold mb-3">Contact</h3>
            <ul class="list-unstyled mb-0">
              <li class="mb-2"><strong>Email:</strong> contact@dailybytesng.com</li>
              <li class="mb-2"><strong>Phone:</strong> +234 000 000 0000</li>
              <li class="mb-0"><strong>Address:</strong> Abuja, Nigeria</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php echo view('footer'); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>