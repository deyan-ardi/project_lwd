<?php
$data['judul'] = 'Login Page - Forgot Password';
$this->load->view('user/templates/header', $data);
?>
<!-- forgot password_area  -->
<div class="prising_area login_area" style="height: 120vh;">
    <div class="container">
        <div class="row no-gutters align-items-center justify-content-center">
            <div class="col-xl-5 col-md-5 ml-4 mr-4 pl-3 pr-3 login wow fadeInUp mt-5" data-wow-duration=".7s"
                data-wow-delay=".8s">
                <div class="col-lg-12 table-responsive mt-4">
                    <h1><?php echo lang('reset_password_heading'); ?></h1>

                    <?php if ($message) : ?>
                    <div class="alert alert-danger" role="alert">
                        <p><?php echo $message; ?></p>
                    </div>
                    <?php endif ?>

                    <?php echo form_open('auth/reset_password/' . $code); ?>

                    <p>
                        <label
                            for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length); ?></label>
                        <br />
                        <?php echo form_input($new_password); ?>
                    </p>

                    <p>
                        <?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm'); ?> <br />
                        <?php echo form_input($new_password_confirm); ?>
                    </p>

                    <?php echo form_input($user_id); ?>
                    <?php echo form_hidden($csrf); ?>

                    <div class="form-group mb-5">
                        <button class="btn-primary btn form-control" id="loginbutton" type="submit">Ganti
                            Kata Sandi</button>
                    </div>
                    
                    
                    <h1><?php echo lang('reset_password_heading');?></h1>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open('auth/reset_password/' . $code);?>

	<p>
		<label for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length);?></label> <br />
		<?php echo form_input($new_password);?>
	</p>

	<p>
		<?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm');?> <br />
		<?php echo form_input($new_password_confirm);?>
	</p>

	<?php echo form_input($user_id);?>
	<?php echo form_hidden($csrf); ?>

	<p><?php echo form_submit('submit', lang('reset_password_submit_btn'));?></p>

<?php echo form_close();?>
                    
                    
                    
                    
                    

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ prising_area  -->
<?php
$this->load->view('user/templates/footer_login');
?>
