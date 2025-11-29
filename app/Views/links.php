              <?php
              $categoryOptions = "";
              foreach ($categories as $category) {
                $categoryOptions .= "<option value='" . $category->categoryid . "'>" . $category->category . "</option>";
              }
              ?>


              <h6 class="mb-2">Quick Actions</h6>
              <div class="d-grid gap-2">
                <?php if ($_SESSION['role'] == 'author') { ?>
                  <a href="<?php echo site_url('post_news') ?>" class="btn btn-primary">Post News Article</a>
                   <a href="<?php echo site_url('mystories') ?>" class="btn btn-primary">My Stories (<?php echo $_SESSION['mynews'] + $_SESSION['myvids'] ?>)</a>
                <?php } ?>
                <?php if ($_SESSION['role'] == 'editor') { ?>
                  <a href="<?php echo site_url('edit_news') ?>" class="btn btn-primary">Edit News Article</a>
                <?php } ?>
                <?php if ($_SESSION['role'] == 'publisher') { ?>
                  <a href="<?php echo site_url('publish_news') ?>" class="btn btn-primary">Publish News Article</a>
                <?php } ?>
                <?php if ($_SESSION['role'] == 'admin') { ?>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">Manage Users</button>
                  <a href="<?php echo site_url('post_news') ?>" class="btn btn-primary">Post News Article</a>
                  <a href="<?php echo site_url('publish_news') ?>" class="btn btn-primary">Publish News Article</a>
                   <a href="<?php echo site_url('mystories') ?>" class="btn btn-primary">My Stories (<?php echo $_SESSION['mynews'] + $_SESSION['myvids'] ?>)</a>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadYoutubeModal">Upload YouTube Video</button>
                    <a href="<?php echo site_url('archive') ?>" class="btn btn-primary">Archive</a>
                  
                <?php } ?>
              
               
                

                <a href="<?php echo site_url('change_password') ?>" class="btn btn-primary">Change Password</a>
                <a href="<?php echo site_url('logout') ?>" class="btn btn-primary">Sign Out</a>

                <!-- Create User Modal (static) -->
                <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="createUserModalLabel">Create New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form class="row g-3 row-cols-lg-2" method="POST" action="<?php echo site_url('user') ?>">
                         
                          <div class="mb-2">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" name="firstname" placeholder="Enter Firstname" value="">
                          </div>
                          <div class="mb-2">
                            <label class="form-label">Surname</label>
                            <input type="text" class="form-control" name="surname" placeholder="Surname" value="">
                          </div>
                          <div class="mb-2">
                            <label class="form-label">Othername</label>
                            <input type="text" class="form-control" name="othername" placeholder="Othername" value="">
                          </div>
                          <div class="mb-2">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email" placeholder="Username" value="">
                          </div>
                          <div class="mb-2">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="0700000000000" value="">
                          </div>
                          <div class="mb-2">
                            <label class="form-label">State</label>
                           <select class="form-select" name="state">
                            <option>Abia</option>
                            <option>Adamawa</option>
                            <option>Akwa Ibom</option>
                            <option>Anambra</option>
                            <option>Bayelsa</option>
                            <option>Benue</option>
                            <option>Borno</option>
                            <option>Delta</option>
                            <option>Ebonyi</option>
                            <option>Enugu</option>
                            <option>Gombe</option>
                            <option>Imo</option>
                            <option>Jigawa</option>
                            <option>Kaduna</option>
                            <option>Kano</option>
                            <option>Katsina</option>
                            <option>Kebbi</option>
                            <option>Kogi</option>
                            <option>Kwara</option>
                            <option>Lagos</option>
                            <option>Nasarawa</option>
                            <option>Niger</option>
                            <option>Ogun</option>
                            <option>Ondo</option>
                            <option>Osun</option>
                            <option>Oyo</option>
                            <option>Plateau</option>
                            <option>Rivers</option>
                            <option>Sokoto</option>
                            <option>Taraba</option>
                            <option>Yobe</option>
                            <option>Zamfara</option>
                           </select>
                          </div>
                          <div class="mb-2">
                            <label class="form-label">Role</label>
                            <select class="form-select" name="role">
                              <option value="admin">Admin</option>
                              <option value="editor">Editor</option>
                              <option value="author">Author</option>
                              <option value="publisher">Publisher</option>
                            </select>
                          </div>
                          <div class="mb-2">
                            <label class="form-label">Gender</label>
                            <select class="form-select" name="gender">
                              <option>Male</option>
                              <option>Female</option>
                              <option>Other</option>
                            </select>
                          </div>
                          <div class="mb-2">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="dob" class="form-control">
                          </div>  
                          <div class="mb-2">
                            <label class="form-label">Default Password</label>
                            <input type="password" name="password" class="form-control">
                          </div>
                          <br />
                           <input type="submit" class="btn btn-primary" value="Save"> 
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                       
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