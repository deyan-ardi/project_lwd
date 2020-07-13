<?php
$data['judul'] = 'Admin - Dashboard';
$data['id'] = '1';
$data['active'] = 'active';
$id = $_SESSION['user_id'];
$data['login'] = $this->LWD_model->getLogin($id);
$this->load->view('user/templates/header', $data);
$this->load->view('user/templates/navbar_admin');
?>

<section id="home">
    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>Dashboard Admin LWD</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /bradcam_area  -->
    <?php if ($data['login'][0]['first_name'] === "Admin") : ?>
    <div class="container mt-5">
        <?php if ($this->session->flashdata('flash')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('flash'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif ?>
        <?php if ($message) : ?>
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <?= $message; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif ?>
        <div class="jumbotron">
            <h1 class="display-4"><?php echo lang('index_heading'); ?></h1>
            <p class="lead">Berikut merupakan pengaturan untuk daftar user yang ada</p>
            <hr class="my-4">
            <div class="row col-lg-12 ">
                <a href="<?= base_url() ?>register"><button type="button"
                        class="btn btn-primary mb-4 btn-sm mr-2">Tambah
                        User</button></a>
                <a href="<?= base_url() ?>auth/create_group"><button type="button"
                        class="btn btn-success mb-4 btn-sm">Tambah
                        Group</button></a>
            </div>
            <div class="table-responsive">
                <table class="col-lg-12 display table table-striped table-bordered" id="dataTables" cellspacing="3px">
                    <thead class="table-primary">
                        <tr>
                            <th><?php echo lang('index_fname_th'); ?></th>
                            <th><?php echo lang('index_lname_th'); ?></th>
                            <th><?php echo lang('index_email_th'); ?></th>
                            <th><?php echo lang('index_groups_th'); ?></th>
                            <th><?php echo lang('index_status_th'); ?></th>
                            <th><?php echo lang('index_action_th'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <?php foreach ($user->groups as $group) : ?>
                                <?php echo anchor("auth/edit_group/" . $group->id, htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8')); ?><br />
                                <?php endforeach ?>
                            </td>
                            <td><?php echo ($user->active) ? anchor("auth/deactivate/" . $user->id, lang('index_active_link')) : anchor("auth/activate/" . $user->id, lang('index_inactive_link')); ?>
                            </td>
                            <td>
                                <a href="auth/edit_user/<?= $user->id ?>"><button type="submit"
                                        class="btn btn-primary btn-sm">Edit
                                        User</button></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="jumbotron">
            <h1 class="display-4">Project Saya</h1>
            <p class="lead">Berikut merupakan pengaturan untuk bagian project saya</p>
            <hr class="my-4">
            <a href="<?= base_url() ?>upload_project"><button type="button"
                    class="btn btn-primary mb-4 btn-sm mr-2">Upload
                    Project</button></a>
            <!-- Button trigger modal -->
            <div class="table-responsive">
                <table class="col-lg-12 display table table-striped table-bordered" id="tableProject" cellspacing="3px">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Nama Project</th>
                            <th>Deskripsi</th>
                            <th>Link</th>
                            <th>Edit</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                                $id = 1;
                                foreach ($project as $data) : ?>
                        <tr>
                            <td><?= $id++ ?></td>
                            <td><?= $data['project_name']; ?></td>
                            <td>
                                <?= $data['description']; ?>
                            </td>
                            <td><a href="<?= $data['link']; ?>" target="blank"><?= $data['link']; ?></a>
                            </td>
                            <td>
                                <a href="<?= base_url() ?>auth/edit_project/<?= $data['id'] ?>"><button type="submit"
                                        class="btn btn-success btn-sm">Edit Project</button></a>
                            </td>
                            <td>
                                <a href="<?= base_url() ?>auth/hapus_project/<?= $data['id'] ?>"
                                    class="tombol-hapus"><button type="submit" class="btn btn-danger btn-sm">Hapus
                                        Project</button></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif ?>
    <div class="container mt-5">
        <div class="jumbotron">
            <h1 class="display-4">Berkas</h1>
            <p class="lead">Berikut merupakan pengaturan untuk bagian berkas</p>
            <hr class="my-4">
            <h4 class="mb-4">Kategori Berkas</h4>
            <a href="<?= base_url() ?>upload_category"><button type="button"
                    class="btn btn-primary mb-4 btn-sm mr-2">Tambah
                    Kategori</button></a>
            <div class="table-responsive">
                <table class="col-lg-12 display table table-striped table-bordered" id="tableBerkas" cellspacing="3px">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th>Modifikasi Terakhir</th>
                            <th>Pengupload</th>
                            <th>Edit</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $id = 1;
                        foreach ($category as $data) : ?>
                        <tr>
                            <td><?= $id++ ?></td>
                            <td><?= $data['category_name']; ?></td>
                            <td><?= $data['category_description']; ?></td>
                            <td>
                                <?= $data['category_date']; ?>
                            </td>
                            <td>
                                <?= $data['category_by']; ?>
                            </td>
                            <td>
                                <a href="<?= base_url() ?>auth/edit_category/<?= $data['id_category']; ?>"><button
                                        type="button" class="btn btn-success btn-sm">Edit
                                        Kategori</button></a>
                            </td>
                            <td>
                                <a href="<?= base_url() ?>auth/hapus_category/<?= $data['id_category']; ?>"
                                    class="tombol-hapus"><button type="submit" class="btn btn-danger btn-sm">Hapus
                                        Kategori</button></a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <hr class="my-4">
            <h4 class="mb-4">File Terupload</h4>
            <a href="<?= base_url() ?>upload_file"><button type="button" class="btn btn-primary mb-4 btn-sm mr-2">Upload
                    File</button></a>
            <div class="table-responsive">
                <table class="col-lg-12 display table table-striped table-bordered" id="tableFile" cellspacing="3px">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Nama File</th>
                            <th>Deskripsi</th>
                            <th>Kategori File</th>
                            <th>Modifikasi Terakhir</th>
                            <th>Proteksi</th>
                            <th>Pengupload</th>
                            <th>Link File</th>
                            <th>Ukuran File</th>
                            <th>Edit</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($detail_category as $data) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $data['name'] ?></td>
                            <td><?= $data['description'] ?></td>
                            <td>
                                <?= $data['category_name'] ?>
                            </td>
                            <td>
                                <?= $data['date'] ?>
                            </td>
                            <td>
                                <?= $data['file_protection'] ?>
                            </td>
                            <td>
                                <?= $data['created_by'] ?>
                            </td>
                            <td><a
                                    href="<?= base_url() ?>upload/file/<?= $data['file_name'] ?>"><?= $data['date'] ?>_<?= $data['created_by'] ?>.zip</a>
                            </td>
                            <td>
                                <?= $data['size'] ?> kB
                            </td>
                            <td>
                                <a href="auth/edit_file/<?= $data['id'] ?>"><button type="button"
                                        class="btn btn-success btn-sm">Edit
                                        File</button></a>
                            </td>
                            <td>
                                <a href="auth/delete_file/<?= $data['id'] ?>" class="tombol-hapus"><button type="submit"
                                        class="btn btn-danger btn-sm">Hapus
                                        File</button></a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="jumbotron">
            <h1 class="display-4">Komentar</h1>
            <p class="lead">Berikut merupakan daftar komentar pada website</p>
            <hr class="my-4">
            <a href="<?= base_url() ?>upload_comment"><button type="button"
                    class="btn btn-primary mb-4 btn-sm mr-2">Upload
                    Comment</button></a>
            <div class="table-responsive">
                <table class="col-lg-12 display table table-striped table-bordered" id="tableKomentar"
                    cellspacing="3px">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Nama User</th>
                            <th>Tanggal Upload</th>
                            <th>Komentar</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $id = 1;
                        foreach ($komentar as $data) : ?>
                        <tr>
                            <td><?= $id++ ?></td>
                            <td><?= $data['user']; ?></td>
                            <td>
                                <?= $data['date']; ?>
                            </td>
                            <td>
                                <pre><?= htmlentities($data['isi']); ?></pre>
                            </td>
                            <td>
                                <a href="<?= base_url() ?>auth/hapus_komentar/<?= $data['id'] ?>"
                                    class="tombol-hapus"><button type="submit" class="btn btn-danger btn-sm">Hapus
                                        Komentar</button></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="jumbotron">
            <h1 class="display-4">Artikel</h1>
            <p class="lead">Berikut merupakan pengaturan untuk bagian artikel</p>
            <hr class="my-4">
            <h4 class="mb-4">Kategori Artikel</h4>
            <a href="<?= base_url() ?>upload_category_article"><button type="button"
                    class="btn btn-primary mb-4 btn-sm mr-2">Tambah Kategori
                    Artikel</button></a>
            <div class="table-responsive">
                <table class="col-lg-12 display table table-striped table-bordered" id="tableCategoryArticle"
                    cellspacing="3px">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th>Modifikasi Terakhir</th>
                            <th>Pengupload</th>
                            <th>Edit</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $id = 1;
                        foreach ($category as $data) : ?>
                        <tr>
                            <td><?= $id++ ?></td>
                            <td><?= $data['category_name']; ?></td>
                            <td><?= $data['category_description']; ?></td>
                            <td>
                                <?= $data['category_date']; ?>
                            </td>
                            <td>
                                <?= $data['category_by']; ?>
                            </td>
                            <td>
                                <a href="<?= base_url() ?>auth/edit_category/<?= $data['id_category']; ?>"><button
                                        type="button" class="btn btn-success btn-sm">Edit
                                        Kategori</button></a>
                            </td>
                            <td>
                                <a href="<?= base_url() ?>auth/hapus_category/<?= $data['id_category']; ?>"
                                    class="tombol-hapus"><button type="submit" class="btn btn-danger btn-sm">Hapus
                                        Kategori</button></a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <hr class="my-4">
            <h4 class="mb-4">Artikel Terupload</h4>
            <a href="<?= base_url() ?>upload_article"><button type="button"
                    class="btn btn-primary mb-4 btn-sm mr-2">Upload
                    Artikel</button></a>
            <div class="table-responsive">
                <table class="col-lg-12 display table table-striped table-bordered" id="tableArticle" cellspacing="3px">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Judul Artikel</th>
                            <th>Penulis</th>
                            <th>Kategori Artikel</th>
                            <th>Modifikasi Terakhir</th>
                            <th>Edit</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($detail_category as $data) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $data['name'] ?></td>
                            <td>
                                <?= $data['created_by'] ?>
                            </td>
                            <td>
                                <?= $data['category_name'] ?>
                            </td>
                            <td>
                                <?= $data['date'] ?>
                            </td>
                            <td>
                                <a href="auth/edit_file/<?= $data['id'] ?>"><button type="button"
                                        class="btn btn-success btn-sm">Edit
                                        File</button></a>
                            </td>
                            <td>
                                <a href="auth/delete_file/<?= $data['id'] ?>" class="tombol-hapus"><button type="submit"
                                        class="btn btn-danger btn-sm">Hapus
                                        File</button></a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php
$this->load->view('user/templates/footer');
?>