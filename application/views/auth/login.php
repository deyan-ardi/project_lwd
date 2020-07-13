<?php
$data['judul'] = 'Login Page';
$this->load->view('user/templates/header', $data);
?>
<!-- prising_area  -->

<div class="prising_area login_area" style="height: 120vh;">
    <div class="container">
        <div class="row no-gutters align-items-center justify-content-center">
            <div class="col-xl-5 col-md-5 ml-4 mr-4 pl-3 pr-3 login wow fadeInUp" data-wow-duration=".7s"
                data-wow-delay=".8s">
                <div class="col-lg-12 table-responsive mt-4">

                    <h1 class="mt-3"><?php echo lang('login_heading'); ?></h1>
                    <p><?php echo lang('login_subheading'); ?></p>
                    <?php if ($message) : ?>
                    <div class="alert alert-primary" role="alert">
                        <p><?php echo $message; ?></p>
                    </div>
                    <?php endif ?>
                    <form action="<?php echo site_url('login'); ?>" method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="identity" name="identity"
                                placeholder="emailku@gmail.com">

                        </div>
                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="********">

                        </div>
                        <div class="form-group">
                            <label>
                                <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?> Ingat Saya
                            </label>
                        </div>
                        <div class="form-group">
                            <button class="btn-primary btn form-control" id="loginbutton">Login</button>
                        </div>
                        <p>
                            Tidak punya akun? <a href="<?php echo site_url('register'); ?>">Registrasi Akun
                            </a>
                        </p>
                        <p class="mb-5">
                            <a href="<?php echo site_url('forgot_password'); ?>">Lupa Kata Sandi? </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ prising_area  -->
<?php
$this->load->view('user/templates/footer_login');
?>