<?php
$data['judul'] = 'Admin - Create Group';
$this->load->view('user/templates/header', $data);
?>
<!-- forgot password_area  -->
<div class="prising_area login_area" style="height: 120vh;">
    <div class="container">
        <div class="row no-gutters align-items-center justify-content-center">
            <div class="col-xl-5 col-md-5 ml-4 mr-4 pl-3 pr-3 login wow fadeInUp mt-5" data-wow-duration=".7s"
                data-wow-delay=".8s">
                <div class="col-lg-12 table-responsive mt-4">

                    <h1><?php echo lang('create_group_heading'); ?></h1>
                    <p><?php echo lang('create_group_subheading'); ?></p>

                    <?php if ($message) : ?>
                    <div class="alert alert-danger" role="alert">
                        <p><?php echo $message; ?></p>
                    </div>
                    <?php endif ?>

                    <?php echo form_open("auth/create_group"); ?>

                    <p>
                        <?php echo lang('create_group_name_label', 'group_name'); ?> <br />
                        <?php echo form_input($group_name); ?>
                    </p>

                    <p>
                        <?php echo lang('create_group_desc_label', 'description'); ?> <br />
                        <?php echo form_input($description); ?>
                    </p>
                    <div class="form-group mb-5">
                        <button class="btn-primary btn form-control" id="submit" type="submit">Create Group
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