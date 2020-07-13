<!-- forgot password_area  -->
<div class="prising_area login_area" style="height: 120vh;">
    <div class="container">
        <div class="row no-gutters align-items-center justify-content-center">
            <div class="col-xl-5 col-md-5 ml-4 mr-4 pl-3 pr-3 login wow fadeInUp mt-5" data-wow-duration=".7s"
                data-wow-delay=".8s">
                <div class="col-lg-12 table-responsive mt-4">
                    <p>
                        <?php echo $message; ?>
                    </p>
                    <div class="form-group">
                        <a href="<?= base_url() ?>login"><button class="btn-primary btn form-control" id="loginbutton"
                                type="submit">Oke, saya mengerti</button></a>
                    </div>
                    <p>Mengalami masalah? <a href="mailto:riyan.clsg11@gmail.com">Laporkan</a></p>

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