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
                                            echo '<a href="' . base_url() . 'user" class="' . $active . '">Beranda</a>';
                                        } else {
                                            echo '<a href="' . base_url() . 'user">Beranda</a>';
                                        }
                                        ?>
                                    </li>
                                    <li>
                                        <?php
                                        if ($id == '4') {
                                            echo '<a href="' . base_url() . 'user/artikel" class="' . $active . '">Artikel</a>';
                                        } else {
                                            echo '<a href="' . base_url() . 'user/artikel">Artikel</a>';
                                        }
                                        ?>
                                    </li>
                                    <li><a href="#">Forum Diskusi <i class="ti-angle-down"></i></a>
                                        <ul class="submenu">
                                            <li><a href="http://cyberw0rm.000webhostapp.com/" target="blank">CyberwOrm
                                                    Forum</a>
                                            </li>
                                            <li><a href="https://discord.gg/AhQjTmF" target="blank">Discord Forum</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Repository <i class="ti-angle-down"></i></a>
                                        <ul class="submenu">
                                            <li><a href="https://www.youtube.com/channel/UCmFHKZEkMYymEkvp5yEZtcg?view_as=subscriber"
                                                    target="blank">Youtube</a>
                                            </li>
                                            <li><?php
                                                if ($id == '3') {
                                                    echo '<a href="' . base_url() . 'login" class="' . $active . '">Download Berkas</a>';
                                                } else {
                                                    echo '<a href="' . base_url() . 'login">Download Berkas</a>';
                                                } ?>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <?php
                                        if ($id == '2') {
                                            echo '<a href="' . base_url() . 'user/projectku" class="' . $active . '">Projectku</a>';
                                        } else {
                                            echo '<a href="' . base_url() . 'user/projectku">Projectku</a>';
                                        }
                                        ?>

                                    </li>
                                    <li>
                                        <a href="#"><?= $login[0]['first_name']; ?> <i class="ti-angle-down"></i></a>
                                        <ul class="submenu">
                                            <li><a href="<?= base_url(); ?>auth/edit_user/<?= $id_login ?>">Setelan</a>
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