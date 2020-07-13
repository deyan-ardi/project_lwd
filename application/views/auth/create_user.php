<?php
$data['judul'] = 'Login Page - Register Account';
$this->load->view('user/templates/header', $data);
?>
<!-- prising_area  -->
<div class="prising_area login_area">
    <div class="container">
        <div class="row no-gutters align-items-center justify-content-center">
            <div class="col-xl-5 col-md-5 ml-4 mr-4 pl-3 pr-3 login wow fadeInUp" data-wow-duration=".7s"
                data-wow-delay=".8s">
                <div class="col-lg-12 table-responsive mt-4">

                    <h1 class="mt-3">Registrasi Akun</h1>
                    <p><?php echo lang('create_user_subheading'); ?></p>

                    <?php if ($message) : ?>
                    <div class="alert alert-danger" role="alert">
                        <p><?php echo $message; ?></p>
                    </div>
                    <?php endif ?>
                    <?php echo form_open("auth/create_user"); ?>

                    <h5>Informasi Personal</h5>
                    <p>
                        <?php echo lang('create_user_fname_label', 'first_name'); ?> <br />
                        <?php echo form_input($first_name); ?>
                    </p>

                    <p>
                        <?php echo lang('create_user_lname_label', 'last_name'); ?> <br />
                        <?php echo form_input($last_name); ?>
                    </p>

                    <?php
                    if ($identity_column !== 'email') {
                        echo '<p>';
                        echo lang('create_user_identity_label', 'identity');
                        echo '<br />';
                        echo form_error('identity');
                        echo form_input($identity);
                        echo '</p>';
                    }
                    ?>

                    <p>
                        <?php echo lang('create_user_company_label', 'company'); ?>
                        <br />
                        <?php echo form_input($company); ?>
                    </p>
                    <p>
                        <?php echo lang('create_user_phone_label', 'phone'); ?> <br />
                        <?php echo form_input($phone); ?>
                    </p>
                    <h5 class="pt-4">Informasi Login</h5>
                    <p>Pastikan email yang Anda masukkan valid, kami akan mengirimkan Kode Verifikasi melalui email Anda
                    </p>
                    <p>
                        <?php echo lang('create_user_email_label', 'email'); ?> <br />
                        <?php echo form_input($email); ?>
                    </p>
                    <p>
                        <?php echo lang('create_user_password_label', 'password'); ?> <br />
                        <?php echo form_input($password); ?>
                    </p>

                    <p>
                        <?php echo lang('create_user_password_confirm_label', 'password_confirm'); ?> <br />
                        <?php echo form_input($password_confirm); ?>
                    </p>
                    <div class="form-group">
                        <button class="btn-primary btn form-control" id="loginbutton" type="submit">Kirim Kode
                            Verifikasi Saya</button>
                    </div>
                    <p class="mb-5">
                        Sudah punya akun? <a href="<?php echo site_url('login'); ?>">Login Sekarang</a>
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