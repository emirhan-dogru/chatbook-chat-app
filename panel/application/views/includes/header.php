<?php 
$session_user = get_status_user(); 
$url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; 
$isİnvited = isİnvite($session_user->id);

if ($isİnvited) {

	?>
	
	
	<!-- Notifications: style can be found in dropdown.less -->
	<li class="dropdown notifications-menu">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<i class="fa fa-bell-o"></i>
			<span class="label label-info"><?php echo isİnviteRow($session_user->id); ?></span>
		</a>
		<ul class="dropdown-menu">
			<li class="header"><?php echo isİnviteRow($session_user->id); ?> Friendship Request</li>
			<li>
				<!-- inner menu: contains the actual data -->
				<ul class="menu">
					<?php foreach ($isİnvited as $isİnvite) { ?>
						<li>
							<a href="http://localhost/wp-web/panel/profil/<?php echo $isİnvite->user_id ?>">
								<table>
									<tbody>
										<tr>
											<td>

												<!-- <img id="friends-image" src="http://localhost/wp-web/panel/assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
												<?php if (get_friends_img($isİnvite->user_id)) { ?>
													<img id="friends-image" src="<?php echo base_url('uploads'); ?>/<?php echo $imageFolder ?>/<?php echo get_friends_img($isİnvite->user_id); ?>" alt="<?php echo get_friends_img($isİnvite->user_id); ?>">
												<?php } else {  ?>
													<img id="friends-image" src="<?php echo base_url('assets'); ?>/dist/img/img-user.png" alt="User profile picture">
												<?php }  ?>
											</td>
											<td width="1000">
												<span><?php echo get_friends_name($isİnvite->user_id); ?></span>
											</td>
											<td>
												<a href="<?php echo base_url("acceptFriend?uid=$isİnvite->user_id&redir=$url"); ?>">
													<span class="pull-right-container btn do-invite-btn">
														<small class="pull-right fa fa-user-plus"></small>
													</span>
												</a>
											</td>
											<td width="100">
												<a href="<?php echo base_url("disallowFriend?uid=$isİnvite->user_id&redir=$url"); ?>">
													<span class="pull-right-container btn btn do-invite-btn">
														<small class="pull-right fa fa-user-times"></small>
													</span>
												</a>
											</td>
										</tr>
									</tbody>
								</table>
							</a>
						</li>
					<?php } ?>
				</ul>
			</li>
		</ul>
	</li>

	<?php
}
?>

<!-- User Account: style can be found in dropdown.less -->
<li class="dropdown user user-menu">
	<a href="<?php echo base_url("logout"); ?>">
		<i class="fa fa-sign-out"> <span class="hidden-xs">Log Out</span></i>
	</a>

</li>