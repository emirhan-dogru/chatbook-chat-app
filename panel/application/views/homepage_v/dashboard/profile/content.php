<?php $user = get_status_user(); ?>
<?php $url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>
<?php if (empty($profil)) {
 redirect(base_url());
 die();
}

?>
<section class="content dm-content">
  <!-- Direct Chat -->
  <div class="row">
    <div class="col-md-12">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">

          <?php if (get_friends_img($profil->id)) { ?>
            <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('uploads'); ?>/<?php echo $imageFolder ?>/<?php echo $profil->img_url ?>" alt="<?php echo $profil->img_url ?>">
          <?php } else {  ?>
            <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('assets'); ?>/dist/img/img-user.png" alt="User profile picture">
          <?php }  ?>
          <h3 class="profile-username text-center"><?php echo $profil->full_name  ?></h3>

          <p class="text-muted text-center"><?php echo !empty($profil->bio) ? $profil->bio : 'No information was given.';  ?></p>


          <ul class="list-group list-group-unbordered">
            <div class="text-center">
              <?php if ($profil->isPhone === '1') { ?>
                <span class="label label-info"><b class="fa fa-phone"></b> <?php echo $profil->phone  ?></span>
              <?php } if (!empty($profil->user_name)) { ?>
                <span class="label label-warning"><b class="fa fa-user"></b> <?php echo $profil->user_name  ?></span>
              <?php } if ($profil->isMail === '1') { ?>
                <span class="label label-primary"><b class="fa fa-envelope-o"></b> <?php echo $profil->email  ?></span>
              <?php } ?>
            </div>
          </ul>
          <?php if ($user->id !== $profil->id) { ?>
            <?php 
            $isFriend = isFriend($profil->id);
            if ($isFriend === 'friend') {
              ?>
              <?php $isUsername = get_isUsername($profil->id); ?>
              <a href="<?php echo ($isUsername) ? base_url("chat/$isUsername") : base_url("chat/$profil->id"); ?>" class="btn btn-primary btn-block pull-right"><i class="fa fa-commenting"></i> Message</a>
              <?php
            }
            else if ($isFriend === 'sendFriend') {
              ?>
              <a href="<?php echo base_url("inviteToCancel?uid=$profil->id&redir=$url"); ?>" class="btn btn-primary btn-block pull-right">Cancel İnvite</a>
              <?php
            }
            else if ($isFriend === 'noFriend') {
              ?>
              <a href="<?php echo base_url("addFriend?uid=$profil->id&redir=$url"); ?>" class="btn btn-primary btn-block pull-right">Add As Friend</a>
              <?php
            }
            else if ($isFriend === 'doFriend') {
              ?>
              <a href="<?php echo base_url("disallowFriend?uid=$profil->id&redir=$url"); ?>" class="btn btn-danger btn-block pull-right">Decline</a>
              <a href="<?php echo base_url("acceptFriend?uid=$profil->id&redir=$url"); ?>" class="btn btn-primary btn-block pull-right">Accept Friend Request</a>

              <?php
            }
            ?>
          <?php } else if ($user->id === $profil->id) { ?>
            <div class="row">
              <div class="col-md-12">
                <a href="?edit" class="btn btn-primary btn-block"><small class="fa fa-pencil"></small><b> Edit Profile</b></a>
              </div>

            </div>

          <?php }  ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <?php if (isset($_GET['edit']) && $user->id === $profil->id or isset($form_error) && $user->id === $profil->id or isset($form_passwordchange_error) && $user->id === $profil->id) { ?>
      <div class="col-md-12">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="<?php echo isset($_GET['form_password_error']) ? '' : (isset($form_passwordchange_error) ? '' : 'active' ); ?>"><a href="#settings" data-toggle="tab" aria-expanded="true">General</a></li>
            <li class="<?php echo isset($_GET['form_password_error']) ? 'active' : (isset($form_passwordchange_error) ? 'active' : '' ); ?>"><a href="#changePassword" data-toggle="tab" aria-expanded="true">Change Password</a></li>
          </ul>
          <div class="tab-content">
            <!-- /.tab-pane -->

            <div class="tab-pane <?php echo isset($_GET['form_password_error']) ? '' : (isset($form_passwordchange_error) ? '' : 'active' ); ?>" id="settings">
             <?php $isUsername = get_isUsername($user->id); ?>
             <form class="form-horizontal" action="<?php echo ($isUsername) ? base_url("profil_update/$isUsername") : base_url("profil_update/$user->id"); ?>" method="post" enctype="multipart/form-data">

              <div class="form-group">
                <label for="inputSkills" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  <?php if (get_friends_img($profil->id)) { ?>
                    <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('uploads'); ?>/<?php echo $imageFolder ?>/<?php echo $user->img_url ?>" alt="<?php echo $profil->img_url ?>">
                  <?php } else {  ?>
                    <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('assets'); ?>/dist/img/img-user.png" alt="User profile picture">
                  <?php }  ?>
                </div>
              </div>

              <div class="form-group">

                <label for="inputName" class="col-sm-2 control-label">Upload Your Avatar</label>

                <div class="col-sm-10">
                  <input type="file" class="form-control" name="img_url">
                </div>
              </div>

              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Profile Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputName" name="full_name" placeholder="Profile Name" 
                  value="<?php echo isset($form_error) ? set_value('full_name') : $profil->full_name;; ?>">
                  
                  <?php if (isset($form_error)) {  ?>
                    <small class="input-form-error valid-error-message"><?php echo form_error("full_name"); ?></small>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">User Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail" name="user_name" placeholder="User Name" value="<?php echo isset($form_error) ? set_value("user_name") : $profil->user_name; ?>">
                  <?php if (isset($form_error)) {  ?>
                    <small class="input-form-error valid-error-message"><?php echo form_error("user_name"); ?></small>
                  <?php } ?>
                </div>
              </div>

              <div class="form-group">
                <label for="inputExperience" class="col-sm-2 control-label">Summary</label>

                <div class="col-sm-10">
                  <textarea class="form-control" name="bio" ><?php echo isset($form_error) ? set_value("bio") : $profil->bio; ?></textarea>
                  <?php if (isset($form_error)) {  ?>
                    <small class="input-form-error valid-error-message"><?php echo form_error("bio"); ?></small>
                  <?php } ?>
                </div>
              </div>

              <?php if ($profil->user_name !== '') { ?>

                <div class="form-group">
                  <label for="inputExperience" class="col-sm-2 control-label">Phone Number</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="isPhone">
                      <option value="1" <?php echo ($profil->isPhone === '1') ? 'selected' : ''; ?>>Public</option>
                      <option value="0" <?php echo ($profil->isPhone === '0') ? 'selected' : ''; ?>>Private</option>
                    </select>
                  </div>
                </div>
              <?php } else { ?>

                <div class="form-group">
                  <label for="inputExperience" class="col-sm-2 control-label">Phone Number</label>
                  <div class="col-sm-10">
                    <select class="form-control" disabled>
                      <option>Public</option>
                    </select>
                    <small class="isPhone_valid">Before changing the privacy settings of your phone number, you must set a username!</small>
                  </div>
                </div>
              <?php } ?>

              
              <div class="form-group">
                <label for="inputExperience" class="col-sm-2 control-label">Mail Address</label>
                <div class="col-sm-10">
                  <select class="form-control" name="isMail">
                    <option value="1" <?php echo ($profil->isMail === '1') ? 'selected' : ''; ?>>Public</option>
                    <option value="0" <?php echo ($profil->isMail === '0') ? 'selected' : ''; ?>>Private</option>
                  </select>
                </div>
              </div>



              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="alert alert-info alert-dismissible">
                    <h4><i class="icon fa fa-warning"></i> Warning!</h4>
                    Once your Profile Changes are saved you will need to log in again for security reasons...
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </div>

            </form>
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane <?php echo isset($_GET['form_password_error']) ? 'active' : (isset($form_passwordchange_error) ? 'active' : '' ); ?>" id="changePassword">
           <?php $isUsername = get_isUsername($user->id); ?>
           <form class="form-horizontal" action="<?php echo ($isUsername) ? base_url("change_password/$isUsername") : base_url("change_password/$user->id"); ?>" method="post">

            <div class="form-group">
              <label for="inputSkills" class="col-sm-2 control-label"></label>
              <div class="col-sm-10">
                <?php if (get_friends_img($profil->id)) { ?>
                  <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('uploads'); ?>/<?php echo $imageFolder ?>/<?php echo $user->img_url ?>" alt="<?php echo $profil->img_url ?>">
                <?php } else {  ?>
                  <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('assets'); ?>/dist/img/img-user.png" alt="User profile picture">
                <?php }  ?>
              </div>
            </div>

            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label">Current Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="inputName" name="current_password" placeholder="Current Password" 
                value="<?php echo isset($_GET['form_password_error']) ?  $_GET['text'] : (isset($form_passwordchange_error) ? $current_password : ''); ?>">
                
                <?php if (isset($_GET['form_password_error'])) {  ?>
                  <small class="input-form-error valid-error-message">Your current password is incorrect.</small>
                <?php } ?>
              </div>
            </div>

            <div class="form-group">
              <label for="inputEmail" class="col-sm-2 control-label">New Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="inputEmail" name="new_password" placeholder="New Password" value="<?php echo isset($form_passwordchange_error) ? set_value("new_password") : ''; ?>">
                <?php if (isset($form_passwordchange_error)) {  ?>
                  <small class="input-form-error valid-error-message"><?php echo form_error("new_password"); ?></small>
                <?php } ?>
              </div>
            </div>

            <div class="form-group">
              <label for="inputEmail" class="col-sm-2 control-label">Confirm Your New Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="inputEmail" name="confirm_paswword" placeholder="Confirm Your New Password" value="<?php echo isset($form_passwordchange_error) ? set_value("confirm_paswword") : ''; ?>">
                <?php if (isset($form_passwordchange_error)) {  ?>
                  <small class="input-form-error valid-error-message"><?php echo form_error("confirm_paswword"); ?></small>
                <?php } ?>
              </div>
            </div>


            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Change Password</button>
              </div>
            </div>

          </form>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
<?php }  ?>
</div>
<!-- /.row -->
</section>