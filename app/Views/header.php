<div class="bg-white border-bottom">
    <div class="container text-center">
      <a class="d-inline-block" href="index.html">
        <img src="<?php echo base_url(); ?>assets/images/logo.jpg" alt="Daily Bytes Logo" style="height: 200px;"> 
        <!-- <h4 class="mt-2 mb-0 fw-bold text-primary">Daily Bytes</h4> -->
      </a>
    </div>
  </div>

  <!-- Navigation Menu -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top" style="margin-top: -3%;">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>`
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a href="<?php echo site_url('/') ?>" class="nav-link active">Home</a></li>
          <li class="nav-item"><a href="<?php echo site_url('category/nws') ?>" class="nav-link">News</a></li>
          <li class="nav-item"><a href="<?php echo site_url('category/pol') ?>" class="nav-link">Politics</a></li>
          <li class="nav-item"><a href="<?php echo site_url('category/def') ?>" class="nav-link">Defence & Security</a></li>
          <li class="nav-item"><a href="<?php echo site_url('category/edu') ?>" class="nav-link">Education</a></li>
          <!-- <li class="nav-item"><a href="<?php echo site_url('category/hea') ?>" class="nav-link">Health</a></li> -->
          <li class="nav-item"><a href="<?php echo site_url('category/fea') ?>" class="nav-link">Features</a></li>
          <!-- <li class="nav-item"><a href="<?php echo site_url('category/eco') ?>" class="nav-link">Economy</a></li> -->
          <li class="nav-item"><a href="<?php echo site_url('category/opi') ?>" class="nav-link">Opinion</a></li>
           <li class="nav-item"><a href="<?php echo site_url('about'); ?>" class="nav-link">About us</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">More</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?php echo site_url('category/bus') ?>">Business</a></li>
              <li><a class="dropdown-item" href="<?php echo site_url('category/spo') ?>">Sports</a></li>
              <li><a class="dropdown-item" href="<?php echo site_url('category/agr') ?>">Agriculture</a></li>
              <li><a class="dropdown-item" href="<?php echo site_url('category/env') ?>">Environment</a></li>
              <li><a class="dropdown-item" href="<?php echo site_url('category/eco') ?>">Econony</a></li>
              <li><a class="dropdown-item" href="<?php echo site_url('category/hea') ?>">Health</a></li>
              <li><a class="dropdown-item" href="<?php echo site_url('category/sci') ?>">Science & Technology</a></li>
              <li><a class="dropdown-item" href="<?php echo site_url('category/ent') ?>">Entertainment</a></li>
              <li><a class="dropdown-item" href="<?php echo site_url('category/tou') ?>">Tourism</a></li>
              <li><a class="dropdown-item" href="<?php echo site_url('category/rel') ?>">Religion</a></li>
              <li><a class="dropdown-item" href="<?php echo site_url('category/int') ?>">International</a></li>
              <li><a class="dropdown-item" href="<?php echo site_url('category/ads') ?>">Adverts</a></li>
              <li><a class="dropdown-item" href="<?php echo site_url('category/edi') ?>">Editorial</a></li>
              <li><a class="dropdown-item" href="<?php echo site_url('category/let') ?>">Letters</a></li>
              <li><a class="dropdown-item" href="<?php echo site_url('archive') ?>">Archived</a></li>
              </ul>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item"><a href="<?php echo site_url('login'); ?>" class="nav-link text-primary">Sign In</a></li>
        </ul> 
        <form class="d-flex" action="<?php echo site_url('search'); ?>" method="post">
          <div class="input-group">
            <input type="text" size="15" class="form-control" placeholder="Search news articles" aria-label="Search news articles" aria-describedby="button-addon2" name="q">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
              <i class="bi bi-search"></i>Search</button>
          </div>
        </form>
 
        
      </div>
    </div>
  </nav>