<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Daily Bytes</title>
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
      display: flex; 
      align-items: center; 
      justify-content: center; 
      min-height: 100vh; 
      background-color: var(--bg-light);
      font-family: 'Inter', sans-serif;
    }
    .login-box { 
      max-width: 400px; 
      width: 100%; 
      padding: 2.5rem; 
      background: #fff; 
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); 
      border-radius: 1rem;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .login-box:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    .form-control {
      border: 1px solid #e5e7eb;
      padding: 0.75rem 1rem;
      font-size: 0.95rem;
      border-radius: 0.5rem;
      transition: all 0.3s ease;
    }
    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      font-weight: 500;
      padding: 0.75rem 1.5rem;
      border-radius: 0.5rem;
      transition: all 0.3s ease;
    }
    .btn-primary:hover {
      background-color: var(--secondary-color);
      border-color: var(--secondary-color);
      transform: translateY(-1px);
    }
    .form-label {
      font-weight: 500;
      color: var(--text-primary);
      margin-bottom: 0.5rem;
    }
    h4 {
      font-weight: 600;
      color: var(--primary-color);
    }
  </style>
</head>
<body>
  <div class="login-box">
    <?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
      <?php echo session()->getFlashdata('error'); ?>
    </div>
    <?php endif; ?>
    <div class="text-center mb-3">
      <img src="<?php echo base_url(); ?>assets/images/logo.jpg" alt="Daily Bytes" height="150">
      <!-- <h4 class="mt-2 text-primary">D Login</h4> -->
    </div>
    <form action="<?php echo site_url('login'); ?>" method="post">
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="username" class="form-control" placeholder="Enter your email">
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Enter password">
      </div>
      <button class="btn btn-primary w-100">Login Securely</button>
    </form>
    <a href="<?php echo site_url('register'); ?>" class="text-center mt-3"><a href="<?php echo site_url('register'); ?>" class="text-primary">Back</a></a>
  </div>
</body>
</html>