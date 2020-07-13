<?php
$data['judul'] = 'Admin - Edit Group';
$this->load->view('user/templates/header', $data);
?>
<!-- forgot password_area  -->
<div class="prising_area login_area" style="height:100vh;">
    <div class="container">
        <div class="row no-gutters align-items-center justify-content-center">
            <div class="col-xl-5 col-md-5 ml-4 mr-4 pl-3 pr-3 login wow fadeInUp" data-wow-duration=".7s"
                data-wow-delay=".8s">
                <div class="col-lg-12 table-responsive mt-5">
                    <h1><?php echo lang('change_password_heading'); ?></h1>

                    <?php if ($message) : ?>
                    <div class="alert alert-danger" role="alert">
                        <p><?php echo $message; ?></p>
                    </div>
                    <?php endif ?>

                    <?php echo form_open("auth/change_password"); ?>

                    <p>
                        <?php echo lang('change_password_old_password_label', 'old_password'); ?> <br />
                        <?php echo form_input($old_password); ?>
                    </p>

                    <p>
                        <label
                            for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length); ?></label>
                        <br />
                        <?php echo form_input($new_password); ?>
                    </p>

                    <p>
                        <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm'); ?> <br />
                        <?php echo form_input($new_password_confirm); ?>
                    </p>

                    <?php echo form_input($user_id); ?>
                    <div class="form-group mb-5">
                        <button class="btn-primary btn form-control" id="submit" type="submit">Ubah Kata Sandi
                        </button>
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('user/templates/footer_login');
?>