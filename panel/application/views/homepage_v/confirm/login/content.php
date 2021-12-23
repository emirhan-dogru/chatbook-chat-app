<div class="lockscreen-logo">
    <a href="https://www.instagram.com/eemirhandogru/"><b>Chat</b>Book</a>
</div>
<!-- User name -->
<div class="lockscreen-name">Login by entering your password</div>

<form action="<?php echo base_url('login/confirm/isPassword'); ?>" method="post">
    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">

        <!-- phone mask -->
        <div class="form-group">
            <div class="input-group">

                <input type="password" class="form-control " name="password" placeholder="Your password">

                <div  class=" input-group-addon bg-blue">
                   <button type="submit" class="btn btn-xs bg-blue"><i class="fa fa-send-o"></i></button> 
                </div>
            </div>
            <!-- /.input group -->
        </div>
        <!-- /.form group -->

    </div>
    <!-- /.lockscreen-item -->
</form>

<div class="help-block text-center">
    <?php if (isset($form_error)) {  ?>
        <small class="input-form-error"><?php echo form_error("password"); ?></small>
    <?php } ?>
    
</div>
<div class="lockscreen-footer text-center ">
    Copyright &copy; 2021 <b><a href="https://www.instagram.com/eemirhandogru/" class="text-black">Emirhan Doğru</a></b>
</div>