<?php
$data['judul'] = 'Admin - Deactivate User';
$this->load->view('user/templates/header', $data);
?>
<!-- forgot password_area  -->
<div class="prising_area login_area" style="height: 120vh;">
    <div class="container">
        <div class="row no-gutters align-items-center justify-content-center">
            <div class="col-xl-5 col-md-5 ml-4 mr-4 pl-3 pr-3 login wow fadeInUp mt-5" data-wow-duration=".7s"
                data-wow-delay=".8s">
                <div class="col-lg-12 table-responsive mt-4">
                    <h1><?php echo lang('deactivate_heading'); ?></h1>
                    <p><?php echo sprintf(lang('deactivate_subheading'), $user->username); ?></p>

                    <?php echo form_open("auth/deactivate/" . $user->id); ?>

                    <p>
                        <?php echo lang('deactivate_confirm_y_label', 'confirm'); ?>
                        <input type="radio" name="confirm" value="yes" checked="checked" />
                        <?php echo lang('deactivate_confirm_n_label', 'confirm'); ?>
                        <input type="radio" name="confirm" value="no" />
                    </p>

                    <?php echo form_hidden($csrf); ?>
                    <?php echo form_hidden(['id' => $user->id]); ?>

                    <div class="form-group mb-5">
                        <button class="btn-primary btn form-control" id="submit" type="submit">Save
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