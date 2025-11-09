<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Profile | Daily Bytes</title>
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
        <a class="btn btn-sm btn-outline-brand me-2" href="#">Dashboard</a>
        <a class="btn btn-sm btn-outline-brand" href="#">Logout</a>
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
            <h5 class="mb-1">Profile Overview</h5>
            <p class="mb-0 text-muted">Basic and contact information</p>
          </div>
          <div class="text-end">
            <small class="text-muted">Member since</small>
            <div class="fw-bold"><?php echo $_SESSION['date_joined']; ?></div>
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
              <h6 class="mb-2">Quick Actions</h6>
              <div class="d-grid gap-2">
                <?php if($_SESSION['role'] == 'author') { ?>
                   <a href="<?php echo site_url('post_news') ?>" class="btn btn-primary">Post News Article</a>
                  <?php } ?>
                  <?php if($_SESSION['role'] == 'editor') { ?>
                   <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">Edit News Article</button>
                  <?php } ?>
                  <?php if($_SESSION['role'] == 'publisher') { ?>
                   <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">Publish News Article</button>
                  <?php } ?>
                  <?php if($_SESSION['role'] == 'admin') { ?>
                   <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">Manage Users</button>
                  <?php } ?>
                <button class="btn btn-outline-primary">Change Password</button>
                <button class="btn btn-outline-secondary">View Activity Log</button>
                
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
        <small class="text-muted">Static demo table — replace with dynamic data</small>
      </div>

      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="table-light">
            <tr>
              <th>Passport</th>
              <th>Full name</th>
              <th>Username</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Role</th>
              <th>Status</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><img src="https://via.placeholder.com/48" class="rounded-circle" alt="p"></td>
              <td>John Doe</td>
              <td>johndoe</td>
              <td>admin@dailybytesng.com</td>
              <td>+234 800 000 0000</td>
              <td>Administrator</td>
              <td><span class="badge bg-success">Active</span></td>
              <td class="text-end">
                <button class="btn btn-sm btn-outline-secondary">Edit</button>
                <button class="btn btn-sm btn-outline-danger">Delete</button>
              </td>
            </tr>
            <tr>
              <td><img src="https://via.placeholder.com/48" class="rounded-circle" alt="p"></td>
              <td>Jane Smith</td>
              <td>janesmith</td>
              <td>jane@dailybytesng.com</td>
              <td>+234 800 000 0001</td>
              <td>Editor</td>
              <td><span class="badge bg-warning text-dark">Pending</span></td>
              <td class="text-end">
                <button class="btn btn-sm btn-outline-secondary">Edit</button>
                <button class="btn btn-sm btn-outline-danger">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <footer class="text-center mt-4 mb-4 text-muted small">&copy; 2025 Daily Bytes. All rights reserved.</footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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

  <!-- Create User Modal (static) -->
  <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createUserModalLabel">Create New User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-2">
              <label class="form-label">Full name</label>
              <input class="form-control" placeholder="Enter full name" value="">
            </div>
            <div class="mb-2">
              <label class="form-label">Username</label>
              <input class="form-control" placeholder="Username" value="">
            </div>
            <div class="mb-2">
              <label class="form-label">Email</label>
              <input class="form-control" placeholder="email@example.com" value="">
            </div>
            <div class="mb-2">
              <label class="form-label">Phone</label>
              <input class="form-control" placeholder="Phone number" value="">
            </div>
            <div class="mb-2">
              <label class="form-label">Role</label>
              <select class="form-select">
                <option>Administrator</option>
                <option>Editor</option>
                <option>Author</option>
              </select>
            </div>
            <div class="mb-2">
              <label class="form-label">Passport (static)</label>
              <input class="form-control" type="file" disabled>
              <small class="text-muted">File input is disabled in this static demo.</small>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Create user</button>
        </div>
      </div>
    </div>
  </div>
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