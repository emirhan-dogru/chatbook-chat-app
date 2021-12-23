<?php $user = get_status_user(); ?>
<section class="content dm-content">
    <!-- Direct Chat -->
    <div class="row">
        <div class="col-md-12">
           <div id="messagebar">
            <!-- DIRECT CHAT PRIMARY -->
            <div class="box box-primary direct-chat direct-chat-primary">
                <div class="box-header with-border">
                    <?php $isUsername = get_isUsername($friend_id); ?>
                    <a href="<?php echo ($isUsername) ? base_url("profil/$isUsername") : base_url("profil/$friend_id"); ?>">
                        <?php if (get_friends_img($friend_id)) { ?>
                            <img id="message-friends-image" class="img-circle" src="<?php echo base_url('uploads'); ?>/<?php echo $imageFolder ?>/<?php echo get_friends_img($friend_id); ?>" alt="<?php echo get_friends_img($friend_id); ?>">
                        <?php } else { ?>
                            <img id="message-friends-image" class="img-circle" src="<?php echo base_url('assets'); ?>/dist/img/img-user.png" alt="User profile picture">
                        <?php } ?>
                    </a>
                    <h3 class="box-title messsage-title"><a href="<?php echo ($isUsername) ? base_url("profil/$isUsername") : base_url("profil/$friend_id"); ?>"><?php echo get_friends_name($friend_id); ?></a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages" id="scroll">
                        <div id="message">

                        </div>
                    </div>
                    <!--/.direct-chat-messages-->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <?php $isUsername = get_isUsername($friend_id); ?>                  
                    <form action="<?php echo ($isUsername) ? base_url("message_send/$isUsername") : base_url("message_send/$friend_id"); ?>" method="post">
                        <div class="input-group">
                            <input type="text" name="message" placeholder="Type a message" class="form-control">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-send-o"></span></button>
                            </span>
                        </div>
                    </form>
                </div>
                <!-- /.box-footer-->
            </div>
            <!--/.direct-chat -->
        </div>
    </div>
    <!-- /.col -->
    <!-- /.col -->
</div>
<!-- /.row -->
</section>