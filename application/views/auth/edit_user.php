<?php
$data['judul'] = 'Admin - Edit Group';
$this->load->view('user/templates/header', $data);
?>
<!-- forgot password_area  -->
<div class="prising_area login_area">
    <div class="container">
        <div class="row no-gutters align-items-center justify-content-center">
            <div class="col-xl-5 col-md-5 ml-4 mr-4 pl-3 pr-3 login wow fadeInUp" data-wow-duration=".7s"
                data-wow-delay=".8s">
                <div class="col-lg-12 table-responsive mt-4">

                    <h1><?php echo lang('edit_user_heading'); ?></h1>
                    <p><?php echo lang('edit_user_subheading'); ?></p>

                    <?php if ($message) : ?>
                    <div class="alert alert-danger" role="alert">
                        <p><?php echo $message; ?></p>
                    </div>
                    <?php endif ?>

                    <?php echo form_open(uri_string()); ?>

                    <p>
                        <?php echo lang('edit_user_fname_label', 'first_name'); ?> <br />
                        <?php echo form_input($first_name); ?>
                    </p>

                    <p>
                        <?php echo lang('edit_user_lname_label', 'last_name'); ?> <br />
                        <?php echo form_input($last_name); ?>
                    </p>

                    <p>
                        <?php echo lang('edit_user_company_label', 'company'); ?> <br />
                        <?php echo form_input($company); ?>
                    </p>

                    <p>
                        <?php echo lang('edit_user_phone_label', 'phone'); ?> <br />
                        <?php echo form_input($phone); ?>
                    </p>
                    <p>
                        <?php echo lang('edit_user_password_label', 'password'); ?> <br />
                        <?php echo form_input($password); ?>
                    </p>

                    <p>
                        <?php echo lang('edit_user_password_confirm_label', 'password_confirm'); ?><br />
                        <?php echo form_input($password_confirm); ?>
                    </p>

                    <?php if ($this->ion_auth->is_admin()) : ?>

                    <h3><?php echo lang('edit_user_groups_heading'); ?></h3>
                    <?php foreach ($groups as $group) : ?>
                    <label class="checkbox">
                        <?php
                                                            $gID = $group['id'];
                                                            $checked = null;
                                                            $item = null;
                                                            foreach ($currentGroups as $grp) {
                                                                  if ($gID == $grp->id) {
                                                                        $checked = ' checked="checked"';
                                                                        break;
                                                                  }
                                                            }
                                                            ?>
                        <input type="checkbox" name="groups[]" value="<?php echo $group['id']; ?>"
                            <?php echo $checked; ?>>
                        <?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?>
                    </label>
                    <?php endforeach ?>

                    <?php endif ?>


                    <?php echo form_hidden('id', $user->id); ?>
                    <?php echo form_hidden($csrf); ?>
                    <div class="form-group mb-5">
                        <button class="btn-primary btn form-control" id="submit" type="submit">Save Information
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