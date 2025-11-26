              
              <?php 
    $categoryOptions = "";
    foreach ($categories as $category) {
        $categoryOptions .= "<option value='" . $category->categoryid . "'>" . $category->category . "</option>";
    }
?>

              
              <h6 class="mb-2">Quick Actions</h6>
              <div class="d-grid gap-2">
                <?php if($_SESSION['role'] == 'author') { ?>
                   <a href="<?php echo site_url('post_news') ?>" class="btn btn-primary">Post News Article</a>
                  <?php } ?>
                  <?php if($_SESSION['role'] == 'editor') { ?>
                   <a href="<?php echo site_url('edit_news') ?>" class="btn btn-primary">Edit News Article</a>
                  <?php } ?>
                  <?php if($_SESSION['role'] == 'publisher') { ?>
                    <a href="<?php echo site_url('publish_news') ?>" class="btn btn-primary">Publish News Article</a>
                  <?php } ?>
                  <?php if($_SESSION['role'] == 'admin') { ?>
                   <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">Manage Users</button>
                    <a href="<?php echo site_url('post_news') ?>" class="btn btn-primary">Post News Article</a>
                     <a href="<?php echo site_url('publish_news') ?>" class="btn btn-primary">Publish News Article</a>
                    <!-- <a href="<?php echo site_url('edit_news') ?>" class="btn btn-primary">Edit News Article</a> -->
                  <?php } ?>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadYoutubeModal">Upload YouTube Video</button>
                <a href="<?php echo site_url('change_password') ?>" class="btn btn-primary">Change Password</a>
                <a href="<?php echo site_url('view_activity_log') ?>" class="btn btn-primary">View Activity Log</a>

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

                <!-- Upload YouTube Video Modal -->
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
                            <input class="form-control" name="title" placeholder="Enter video title" >
                          </div>
                          <div class="mb-2">
                            <label class="form-label">YouTube Video URL</label>
                            <input class="form-control" name="video_link" placeholder="https://www.youtube.com/watch?v=..." >
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

              