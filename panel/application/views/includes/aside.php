<?php $user = get_status_user(); ?>
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <?php $isUsername = get_isUsername($user->id); ?>
            <a href="<?php echo ($isUsername) ? base_url("profil/$isUsername") : base_url("profil/$user->id"); ?>">
                <?php if (get_friends_img($user->id)) { ?>
                    <img class="homepage-user-img img-s-user img-responsive img-circle" src="<?php echo base_url('uploads'); ?>/<?php echo $imageFolder ?>/<?php echo $user->img_url ?>" alt="<?php echo $user->img_url ?>">
                <?php } else {  ?>
                    <img class="homepage-user-img img-n-user img-responsive img-circle" src="<?php echo base_url('assets'); ?>/dist/img/img-user.png" alt="User profile picture">
                <?php }  ?>
            </a>
        </div>
        <div class="pull-left info">
            <p><a href="<?php echo ($isUsername) ? base_url("profil/$isUsername") : base_url("profil/$user->id"); ?>"><?php echo $user->full_name; ?></a></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- search form -->
    <!--
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Ara...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-user" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
            </span>
        </div>
    </form>
--> <br>
<!-- /.search form -->
<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">DİRECT MESSAGES</li>
</ul>

<ul class="sidebar-menu friends" data-widget="tree">

    
</ul>
<a href="<?php echo base_url("friends"); ?>">
    <span class="fa fa-plus friend_plus_btn"></span>
</a>
</section>
<!-- /.sidebar -->
