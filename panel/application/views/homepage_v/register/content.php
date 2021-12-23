<div class="lockscreen-logo">
    <a href="https://www.instagram.com/eemirhandogru/"><b>Chat</b>Book</a>
</div>
<!-- User name -->
<div class="lockscreen-name">Quickly Sign Up</div>

<form action="<?php echo base_url('isRegister'); ?>" method="post">
    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">

        <!-- phone mask -->
        <div class="form-group">

            <div class="input-group">

                <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                </div>

                <input type="text" class="form-control" name="phone" data-inputmask='"mask": "(99) 9999-9999"' data-mask value="<?php echo isset($form_error) ? set_value('phone') : ''; ?>">

                <div class=" input-group-addon bg-blue">
                    <button type="submit" class="btn btn-xs bg-blue"><i class="fa fa-send-o"></i></button>
                </div>
            </div>
            <!-- /.input group -->
        </div>
        <!-- /.form group -->

    </div>
    <!-- /.lockscreen-item -->
</form>


<div class="text-center">
    <a href="<?php echo base_url('login'); ?>">Sign in with my existing account</a>
</div>
<div class="lockscreen-footer text-center ">
    Copyright &copy; 2021 <b><a href="https://www.instagram.com/eemirhandogru/" class="text-black">Emirhan Doğru</a></b>
</div>