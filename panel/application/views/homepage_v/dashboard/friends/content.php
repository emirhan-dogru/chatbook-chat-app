<!-- Main content -->
<section class="invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-users"></i> Friends
        <small class="pull-right"><a href="<?php echo base_url('search'); ?>" class="btn btn-xs bg-purple btn-flat">Add Friend <i class="fa fa-search"></i></a></small>
      </h2>
    </div>
    <!-- /.col -->
  </div>

  <?php if (empty($friends)) { ?>
    <div align="center">
      <b>Kayıtlı Arkadaşınız Bulunamadı!</b>
    </div>
  <?php } else {  ?>

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Full Name</th>
              <th>Phone Number</th>
              <th width="40"></th>
              <th width="40"></th>
            </tr>
          </thead>
          <tbody>
            <?php $num = 0; ?>
            <?php foreach ($friends as $friend) { $num++; ?>
              <tr>
                <td><?php echo $num; ?></td>
                <td><?php echo get_friends_name($friend->friend_id); ?></td>
                <td><?php echo get_friends_phone($friend->friend_id); ?></td>
                <?php $isUsername = get_isUsername($friend->friend_id); ?>
                <td><a href="<?php echo ($isUsername) ? base_url("chat/$isUsername") : base_url("chat/$friend->friend_id"); ?>"><i class="fa fa-paper-plane"></i></a></td>
                <td><a class="remove-btn" data-url="<?php echo base_url("removeFriend/$friend->friend_id"); ?>"><i class="fa fa-close"></i></a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  <?php } ?>

</section>
    <!-- /.content -->