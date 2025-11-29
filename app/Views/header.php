<div class="bg-white border-bottom">
    <div class="container text-center">
      <a class="d-inline-block" href="index.html">
        <img src="<?php echo base_url(); ?>assets/images/logo.jpg" alt="Daily Bytes Logo" style="height: 200px;"> 
        <!-- <h4 class="mt-2 mb-0 fw-bold text-primary">Daily Bytes</h4> -->
      </a>
    </div>
  </div>

  <!-- Navigation Menu -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>`
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a href="<?php echo site_url('/') ?>" class="nav-link active">Home</a></li>
          <li class="nav-item"><a href="<?php echo site_url('category/bus') ?>" class="nav-link">Business</a></li>
          <li class="nav-item"><a href="<?php echo site_url('category/pol') ?>" class="nav-link">Politics</a></li>
          <li class="nav-item"><a href="<?php echo site_url('category/agr') ?>" class="nav-link">Agriculture</a></li>
          <li class="nav-item"><a href="<?php echo site_url('category/spo') ?>" class="nav-link">Sports</a></li>
          <li class="nav-item"><a href="<?php echo site_url('category/opi') ?>" class="nav-link">Opinion</a></li>
          <li class="nav-item"><a href="<?php echo site_url('category/edu') ?>" class="nav-link">Education</a></li>
          <li class="nav-item"><a href="<?php echo site_url('category/ent') ?>" class="nav-link">Entertainment</a></li>
          <li class="nav-item"><a href="<?php echo site_url('category/int') ?>" class="nav-link">International</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">More</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?php echo site_url('category/def') ?>">Defence & Security</a></li>
              <li><a class="dropdown-item" href="<?php echo site_url('category/hea') ?>">Health</a></li>
              <li><a class="dropdown-item" href="<?php echo site_url('category/sci') ?>">Science & Technology</a></li>
              <li><a class="dropdown-item" href="<?php echo site_url('category/tou') ?>">Tourism</a></li>
              <li><a class="dropdown-item" href="<?php echo site_url('category/rel') ?>">Religion</a></li>
              <li><a class="dropdown-item" href="<?php echo site_url('category/fea') ?>">Features</a></li>
              <li><a class="dropdown-item" href="<?php echo site_url('category/jud') ?>">Judiciary</a></li>
              <li><a class="dropdown-item" href="<?php echo site_url('category/env') ?>">Environment</a></li>
              
            </ul>
          </li>

         <li class="nav-item"><a href="<?php echo site_url('about'); ?>" class="nav-link">About us</a></li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item"><a href="<?php echo site_url('login'); ?>" class="nav-link text-primary">Sign In</a></li>
        </ul>
      </div>
    </div>
  </nav>