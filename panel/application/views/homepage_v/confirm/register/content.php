<div class="lockscreen-logo">
    <a href="https://www.instagram.com/eemirhandogru/"><b>Chat</b>Book</a>
</div>
<!-- User name -->
<div class="lockscreen-name">Quickly Sign Up</div>



    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">

        <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo base_url("register/confirm/save"); ?>" method="post">
                <div class="box-body">
                    <!-- phone mask -->
                    <div class="form-group">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phone Number</label>
                            <input disabled type="text" class="form-control" data-inputmask='"mask": "(99) 9999-9999"' data-mask value="<?php echo $this->session->userdata("isphone"); ?>">
                            <small><a href="<?php echo base_url('go_register'); ?>">Change my phone number</a></small>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->

                    <div class="form-group">
                        <label for="exampleInputEmail1">Name Surname</label>
                        <input type="text" class="form-control" name="full_name" id="exampleInputEmail1" placeholder="Name Surname"
                       value="<?php echo isset($form_error) ? set_value('full_name') : ''; ?>">
                        <?php if(isset($form_error)) {  ?>
                            <span class="help-block"><?php echo form_error("full_name"); ?></span>
						<?php } ?>
                        
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Mail Address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Mail Address"
                        value="<?php echo isset($form_error) ? set_value('email') : ''; ?>">
                        <?php if(isset($form_error)) {  ?>
                            <span class="help-block"><?php echo form_error("email"); ?></span>
						<?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="Password"
                        value="<?php echo isset($form_error) ? set_value('password') : ''; ?>">
                        <?php if(isset($form_error)) {  ?>
                            <span class="help-block"><?php echo form_error("password"); ?></span>
						<?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Confirm Your Password</label>
                        <input type="password" class="form-control" name="re_password" id="exampleInputEmail1" placeholder="Confirm Your Password"
                        >
                        <?php if(isset($form_error)) {  ?>
                            <span class="help-block"><?php echo form_error("re_password"); ?></span>
						<?php } ?>
                    </div>




                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="accept_terms_checkbox">I have read and accept the terms
                            <?php if(isset($form_error)) {  ?>
                            <span class="help-block"><?php echo form_error("accept_terms_checkbox"); ?></span>
                            <?php } ?>
                        </label>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer text-right">
                    <button type="submit" class="btn btn-xs btn-primary">Create My Account</button>
                </div>
            </form>
        </div>

    </div>
    <!-- /.lockscreen-item -->

<div class="text-center">
<a href="<?php echo base_url('login'); ?>">Sign in with my existing account</a>
</div>
<div class="lockscreen-footer text-center ">
    Copyright &copy; 2021 <b><a href="https://www.instagram.com/eemirhandogru/" class="text-black">Emirhan Doğru</a></b>
</div>