<?php
$user = get_status_user();

onlineTimeUpdate($user->id);
$now = date("Y-m-d H:i:s");


foreach ($items as $item) {  ?>
  <?php $isUsername = get_isUsername($item->friend_id); ?>
	<li>
		<a href="<?php echo ($isUsername) ? base_url("chat/$isUsername") : base_url("chat/$item->friend_id"); ?>">
			<table>
				<tbody>
					<tr>
            <?php 

            if(isReaded_Messages($item->friend_id)) {  
              ?>
              <td>
               <i class='fa fa-circle is_notReaded_message_icon'></i>
             </td>
             <?php 
           }

           ?>

           <td>                  
            <?php 

            $friend_lastActive_date = get_lastOnlinedate($item->friend_id);
            $status = strtotime($now) - strtotime($friend_lastActive_date);

            if ($status <= 15) {
             echo "<i class='fa fa-circle text-success friends-status-icon'></i>";
           } else {
             echo "<i class='fa fa-circle text-danger friends-status-icon'></i>";
           }

           ?>
           <?php $img_url = get_friends_img($item->friend_id); ?>

           <?php if ($img_url) { ?>
            <img id="friends-image" src="<?php echo base_url('uploads'); ?>/<?php echo $this->imageFolder ?>/<?php echo $img_url; ?>" alt="<?php echo $img_url ?>">
          <?php } else {  ?>
            <img id="friends-image" src="<?php echo base_url('assets'); ?>/dist/img/img-user.png" alt="User profile picture">
          <?php }  ?>
        </td>
        <td width="1000">
         <span><?php echo get_friends_name($item->friend_id) ?></span>
       </td>
       <td width="30">
         <a href="<?php echo base_url("homepage/delete_ActiveChat/$user->id/$item->friend_id"); ?>">
          <span class="pull-right-container">
           <small class="pull-right fa fa-times"></small>
         </span>
       </a>
     </td>
   </tr>
 </tbody>
</table>
</a>
</li>
<?php } ?>