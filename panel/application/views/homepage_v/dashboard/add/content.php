<?php $session_user = get_status_user(); ?>
<?php $url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>
<!-- Main content -->
<section class="invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <form action="<?php echo base_url("isUser"); ?>" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search for friend number or username">
            <span class="input-group-btn">
              <button type="submit"  id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </form>
      </h2>
    </div>
    <!-- /.col -->
  </div>

  <!-- Table row -->
  <div class="row" >
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <div class="tab-content">
          <div class="active tab-pane" id="activity">

            <?php if (isset($_GET['search'])) { ?>
              <?php if (empty($users) or $_GET['search'] === null or $_GET['search'] === '') {
                ?>
                <div align="center">
                  <b>No user matching the information you searched for was found.</b>
                </div>
                <?php
              }
              else {

               ?>
               <?php foreach ($users as $user) { ?>
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                   <?php $isUsername = get_isUsername($user->id); ?>         
                   <a href="<?php echo ($isUsername) ? base_url("profil/$isUsername") : base_url("profil/$user->id"); ?>">
                    <?php if (get_friends_img($user->id)) { ?>
                      <img class="img-circle img-bordered-sm" src="<?php echo base_url('uploads'); ?>/<?php echo $imageFolder ?>/<?php echo $user->img_url ?>" alt="<?php echo $user->img_url ?>">
                    <?php } else {  ?>
                      <img class="img-circle img-bordered-sm" src="<?php echo base_url('assets'); ?>/dist/img/img-user.png" alt="User profile picture">
                    <?php }  ?>
                  </a>
                  <span class="username">
                    <a href="<?php echo ($isUsername) ? base_url("profil/$isUsername") : base_url("profil/$user->id"); ?>"><?php echo $user->full_name; ?></a>
                    <?php if ($user->id !== $session_user->id) { ?>
                      <?php 
                      $isFriend = isFriend($user->id);
                      if ($isFriend === 'friend') {
                        ?>
                        <?php $isUsername = get_isUsername($user->id); ?>
                        <a href="<?php echo ($isUsername) ? base_url("chat/$isUsername") : base_url("chat/$user->id"); ?>" class="btn btn-primary btn-xs pull-right">Message</a>
                        <?php
                      }
                      else if ($isFriend === 'sendFriend') {
                        ?>
                        <a href="<?php echo base_url("inviteToCancel?uid=$user->id&redir=$url"); ?>" class="btn btn-primary btn-xs pull-right">Cancel İnvite</a>
                        <?php
                      }
                      else if ($isFriend === 'noFriend') {
                        ?>
                        <a href="<?php echo base_url("addFriend?uid=$user->id&redir=$url"); ?>" class="btn btn-primary btn-xs pull-right">Add As Friend</a>
                        <?php
                      }
                      else if ($isFriend === 'doFriend') {
                        ?>
                        <a href="<?php echo base_url("disallowFriend?uid=$user->id&redir=$url"); ?>" class="btn btn-danger btn-xs pull-right">Decline </a>
                        <a href="<?php echo base_url("acceptFriend?uid=$user->id&redir=$url"); ?>" class="btn btn-primary do-friend-accept-btn  btn-xs pull-right">Accept Friend Request</a>

                        <?php
                      }
                      ?>

                    <?php } ?>
                  </span>
                  <span class="description">
                    <?php 
                    if ($user->isPhone === '1') {
                      echo '0' . $user->phone;
                    }
                    else if ($user->isPhone === '0') {
                      echo $user->user_name;
                    }

                    ?>
                  </span>
                </div>
                <!-- /.user-block -->
                <p><?php 
                if ($user->bio === '' or $user->bio === null) { ?>
                  <small>No information was given.</small>
                <?php  }
                else {
                  echo $user->bio;
                }
                ?></p>
              </div>
              <!-- /.post -->
            <?php } ?>
          <?php } ?>
        <?php } ?>

      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

</section>
    <!-- /.content -->