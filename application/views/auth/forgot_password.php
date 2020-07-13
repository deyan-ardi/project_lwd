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

                    <h1 class="mt-3"><?php echo lang('forgot_password_heading'); ?></h1>
                    <p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label); ?></p>

                    <?php if ($message) : ?>
                    <div class="alert alert-danger" role="alert">
                        <p><?php echo $message; ?></p>
                    </div>
                    <?php endif ?>
                    <?php echo form_open("auth/forgot_password"); ?>

                    <p>
                        <label
                            for="identity"><?php echo (($type == 'email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label)); ?></label>
                        <br />
                        <?php echo form_input($identity); ?>
                    </p>

                    <div class="form-group">
                        <button class="btn-primary btn form-control" id="loginbutton" type="submit">Kirim Kode Aktivasi
                            Saya</button>
                    </div>
                    <p class="mb-5">
                        <a href="<?php echo site_url('login'); ?>">Kembali ke Login</a>
                    </p>
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