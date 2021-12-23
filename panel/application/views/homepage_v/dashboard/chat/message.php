<?php 
$user = get_status_user(); 
$messages = getMessage($friend_id);
$friend_message_say = 0;

if ($messages) {

   ?>
   <?php foreach ($messages as $message) { ?>

    <?php if ($message->user_id === $user->id) { ?>

        <!-- Message to the right -->
        <div class="direct-chat-msg right">
            <div class="direct-chat-info clearfix">
                <span class="direct-chat-name pull-right"><?php echo $user->full_name ?></span>
                <span class="direct-chat-timestamp pull-left"><?php echo $message->createdAt; ?></span>
            </div>
            <!-- /.direct-chat-info -->
            <?php if ($user->img_url != null or $user->img_url != '') { ?>
                <img class="direct-chat-img" src="<?php echo base_url('uploads'); ?>/<?php echo $imageFolder ?>/<?php echo $user->img_url; ?>" alt="<?php echo $user->img_url; ?>">
            <?php } else {  ?>
                <img class="direct-chat-img" src="<?php echo base_url('assets'); ?>/dist/img/img-user.png" alt="User profile picture">
            <?php }  ?>
            <!-- /.direct-chat-img -->
            <div class="direct-chat-text">
                <?php echo $message->message; ?>
            </div>
            <!-- /.direct-chat-text -->
        </div>
        <!-- /.direct-chat-msg -->

    <?php } else if ($message->user_id === $friend_id) { ?>
        <?php $friend_message_say ++; ?>

        <!-- Message. Default to the left -->
        <div class="direct-chat-msg">
            <div class="direct-chat-info clearfix">
                <span class="direct-chat-name pull-left"><?php echo get_friends_name($message->user_id); ?></span>
                <span class="direct-chat-timestamp pull-right"><?php echo $message->createdAt; ?></span>
            </div>
            <!-- /.direct-chat-info -->
            <?php if (get_friends_img($message->user_id)) { ?>
                <img class="direct-chat-img" src="<?php echo base_url('uploads'); ?>/<?php echo $imageFolder ?>/<?php echo get_friends_img($message->user_id); ?>" alt="<?php echo get_friends_img($message->user_id); ?>">
            <?php } else {  ?>
                <img class="direct-chat-img" src="<?php echo base_url('assets'); ?>/dist/img/img-user.png" alt="User profile picture">
            <?php }  ?>
            <!-- /.direct-chat-img -->
            <div class="direct-chat-text">
                <?php echo $message->message; ?>
            </div>
            <!-- /.direct-chat-text -->
        </div>
        <!-- /.direct-chat-msg -->

    <?php } ?>
<?php } ?>

<?php 

if(isReaded_Messages($friend_id)) {  
    ?>
    <script type="text/javascript">
        $("#scroll").animate({ scrollTop: "10000px" });
    </script>
    <?php 
    Readed_Message($friend_id);
}




?>
<?php } ?>
