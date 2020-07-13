<!-- header-start -->
<header>
    <div class="header-area">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-2">
                        <div class="logo">
                            <a href="<?= base_url() ?>">
                                <img src="<?= base_url() ?>assets/img/LWD.png" width="50px">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-10">
                        <div class="main-menu d-none d-lg-block">
                            <nav>
                                <ul id="navigation">
                                    <li>
                                        <?php
                                        if ($id == '1') {
                                            echo '<a href="' . base_url() . 'adminlwd" class="' . $active . '">Beranda</a>';
                                        } else {
                                            echo '<a href="' . base_url() . 'adminlwd">Beranda</a>';
                                        }
                                        ?>
                                    </li>
                                    <li>
                                        <a href="#"><?= $login[0]['first_name']; ?> <i class="ti-angle-down"></i></a>
                                        <ul class="submenu">
                                            <li><a href="<?= base_url() ?>adminlwd/change_password">Setelan</a>
                                            </li>
                                            <li><a href="<?= base_url(); ?>auth/logout" class="log-out">Logout</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>
<!-- header-end -->