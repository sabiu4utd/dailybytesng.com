<!DOCTYPE html>
<html lang="en">



<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Profile | Daily Bytes</title>
  <link rel="icon" type="image/jpeg" href="<?= base_url('assets/images/logo.jpg') ?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --brand: #0d6efd;
      --muted: #6c757d
    }

    body {
      background: #f1f5f9;
      color: #212529;
      font-family: system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial
    }

    .topbar {
      background: #fff;
      box-shadow: 0 1px 0 rgba(0, 0, 0, 0.05);
      padding: 12px 20px
    }

    .wrap {
      max-width: 1100px;
      margin: 28px auto
    }

    .profile-card {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 6px 18px rgba(16, 24, 40, 0.06);
      overflow: hidden
    }

    .profile-side {
      background: linear-gradient(180deg, var(--brand), #0069d9);
      color: #fff;
      padding: 28px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 18px
    }

    .avatar {
      width: 140px;
      height: 140px;
      border-radius: 50%;
      object-fit: cover;
      border: 6px solid rgba(255, 255, 255, 0.12);
      background: #fff
    }

    .btn-outline-brand {
      color: var(--brand);
      border-color: rgba(13, 110, 253, 0.12)
    }

    .info-row {
      display: flex;
      gap: 18px;
      flex-wrap: wrap
    }

    .info-box {
      background: #f8fafc;
      border-radius: 8px;
      padding: 14px;
      flex: 1;
      min-width: 180px
    }

    .label {
      font-size: 13px;
      color: var(--muted);
      margin-bottom: 6px
    }

    .value {
      font-weight: 600
    }

    @media (max-width:768px) {
      .profile-side {
        padding: 20px
      }

      .avatar {
        width: 110px;
        height: 110px
      }
    }
  </style>
</head>

<body>
  <header class="topbar">
    <div class="container d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center gap-3">
        <img src="/assets/images/logo.png" alt="Daily Bytes" style="height:34px;object-fit:contain" onerror="this.style.display='none'">
        <h5 class="mb-0">Admin Profile</h5>
      </div>
      <nav>

        <a class="btn btn-sm btn-outline-brand" href="<?php echo site_url('logout') ?>">Signout</a>
      </nav>
    </div>
  </header>

  <main class="wrap">
    <section class="profile-card d-flex flex-column flex-md-row">
      <aside class="profile-side col-md-4 text-center">
        <div class="position-relative">
          <img class="avatar" src="<?php echo base_url() ?>/assets/passport/<?php echo $user->passport_url; ?>" alt="Passport Photo">
          <button class="btn btn-light btn-sm position-absolute bottom-0 start-50 translate-middle-x" data-bs-toggle="modal" data-bs-target="#uploadPassportModal">
            <small>Upload Passport</small>
          </button>
        </div>
        <div>
          <h4 class="mb-0"><?php echo $_SESSION['firstname'] . ' ' . $_SESSION['surname'] . ' ' . $_SESSION['othername']; ?></h4>
          <small><?php echo $_SESSION['role']; ?></small>
        </div>

      </aside>

      <div class="p-4 flex-1">

        <div class="d-flex justify-content-between align-items-start mb-3">
         
          <div>
             <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
              <?php echo session()->getFlashdata('error'); ?>
            </div>
          <?php endif; ?>
           <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
              <?php echo session()->getFlashdata('success'); ?>
            </div>
          <?php endif; ?>
            <h5 class="mb-1">Profile Overview</h5>
            <p class="mb-0 text-muted">Basic and contact information</p>
          </div>
          <div class="text-end">
            <small class="text-muted">Member since</small>
            <div class="fw-bold"><?php echo date('d-m-Y', strtotime($_SESSION['date_joined'])); ?></div>
          </div>
        </div>

        <div class="row g-3">
          <div class="col-md-8">
            <div class="mb-3">
              <h6 class="mb-2">Basic Information</h6>
              <div class="info-row">
                <div class="info-box">
                  <div class="label">Full name</div>
                  <div class="value"><?php echo $_SESSION['firstname'] . ' ' . $_SESSION['surname'] . ' ' . $_SESSION['othername']; ?></div>
                </div>
                <div class="info-box">
                  <div class="label">Username</div>
                  <div class="value"><?php echo $_SESSION['firstname']; ?></div>
                </div>
                <div class="info-box">
                  <div class="label">Gender</div>
                  <div class="value"><?php echo $_SESSION['gender']; ?></div>
                </div>
              </div>
            </div>

            <div class="mb-3">
              <h6 class="mb-2">Contact Information</h6>
              <div class="info-row">
                <div class="info-box">
                  <div class="label">Email</div>
                  <div class="value"><?php echo $_SESSION['email']; ?></div>
                </div>
                <div class="info-box">
                  <div class="label">Phone</div>
                  <div class="value"><?php echo $_SESSION['phone']; ?></div>
                </div>
                <div class="info-box">
                  <div class="label">Address</div>
                  <div class="value">Birnin Kebbi</div>
                </div>
              </div>
            </div>

            <!-- <div>
                <h6 class="mb-2">About</h6>
                <p class="text-muted">This is a static admin profile page used to display passport, contact details and basic information. Replace static values with dynamic data as needed in your application.</p>
              </div> -->
          </div>

          <div class="col-md-4">
            <div class="mb-3">
              <h6 class="mb-2">Security & Status</h6>
              <div class="info-box mb-2">
                <div class="label">Account status</div>
                <div class="value text-success">Active</div>
              </div>
              <div class="info-box">
                <div class="label">2FA</div>
                <div class="value">Not configured</div>
              </div>
            </div>

            <div>
              <?php echo view('links.php') ?>


            </div>
          </div>
        </div>
      </div>
      </div>
    </section>

    <!-- Manage Users (static) -->
    <section class="mt-4 profile-card p-3">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Manage Users</h5>

      </div>

      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="table-light">
            <tr>
              <th>Passport</th>
              <th>Full name</th>

              <th>Email</th>
              <th>Phone</th>
              <th>Role</th>
              <th>Status</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user) { ?>
              <tr>
                <td><img src="<?php echo base_url() ?>/assets/passport/<?php echo $user->passport_url; ?>" style="width:30px" class="rounded-circle" alt="passport"></td>
                <td><?php echo $user->firstname . " " . $user->surname . " " . $user->othername; ?></td>

                <td><?php echo $user->email; ?></td>
                <td><?php echo $user->phone; ?></td>
                <td><?php echo $user->role; ?></td>
                <td><span class="badge bg-success">Active</span></td>
                <td class="text-end">
                  <button class="btn btn-sm btn-outline-secondary">Edit</button>
                  <button class="btn btn-sm btn-outline-danger">Delete</button>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <footer class="text-center mt-4 mb-4 text-muted small">&copy; 2025 Daily Bytes. All rights reserved.</footer>



  <!-- Upload Passport Modal -->
  <div class="modal fade" id="uploadPassportModal" tabindex="-1" aria-labelledby="uploadPassportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="uploadPassportModalLabel">Upload Passport Photo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="upload_passport" enctype="multipart/form-data">

            <div class="mb-3">
              <div class="mb-3">
                <div class="mb-3">
                  <label class="form-label">Passport Preview</label>
                  <img id="preview-image" src="" class="img-fluid" alt="Preview" style="display: none;">
                  <div class="form-text">Preview of uploaded image</div>
                </div>
                <div class="mb-3">
                  <label class="form-label">Passport Photo</label>
                  <input type="file" name="passport_url" class="form-control" accept="image/*" onchange="previewImage(event)">
                  <div class="form-text">Recommended: Square image, max 2MB</div>
                </div>
                <button type="submit" class="btn btn-primary">Upload Photo</button>
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function previewImage(event) {
      const file = event.target.files[0];
      const preview = document.getElementById('preview-image');

      if (file) {
        const reader = new FileReader();
        reader.onload = function() {
          preview.src = reader.result;
          preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
      } else {
        preview.src = '';
        preview.style.display = 'none';
      }
    }
  </script>
</body>





</html>