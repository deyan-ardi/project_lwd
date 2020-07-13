<!-- bradcam_area  -->
<div class="bradcam_area bradcam_bg_1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>Detail Berkas <?= $category[0]['category_name'] ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- prising_area  -->
<div class="prising_area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".5s">
                    <h3>Daftar Berkas</h3>

                    <p>Berikut merupakan daftar berkas yang tersedia dari kategori <?= $category[0]['category_name'] ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="row no-gutters align-items-center justify-content-center">
            <div class="col-lg-12 table-responsive mt-4 wow fadeInUp" data-wow-duration=".7s" data-wow-delay=".8s">
                <a href="<?= base_url() ?>user/directory"><button type="submit"
                        class="btn btn-warning btn-sm mb-4">Kembali
                    </button></a>
                <table id="dataTables" class="display table table-striped table-bordered">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th scope="col">#</th>
                            <th scope="col">Judul Berkas</th>
                            <th scope="col">Deskripsi Berkas</th>
                            <th scope="col">Proteksi File</th>
                            <th scope="col">Tanggal Uploud</th>
                            <th scope="col">Pengupload</th>
                            <th scope="col">Unduh</th>
                            <th scope="col">Ukuran</th>
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
                            <td><?= $data['file_protection'] ?></td>
                            <td><?= $data['date'] ?></td>
                            <td><?= $data['created_by'] ?></td>
                            <td><a
                                    href="<?= base_url() ?>upload/file/<?= $data['file_name'] ?>"><?= $data['date'] ?>_<?= $data['created_by'] ?>.zip</a>
                            </td>
                            <td><?= $data['size'] ?> kB</td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--/ prising_area  -->