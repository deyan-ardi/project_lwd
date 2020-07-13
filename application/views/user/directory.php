   <!-- bradcam_area  -->
   <div class="bradcam_area bradcam_bg_1">
       <div class="container">
           <div class="row">
               <div class="col-xl-12">
                   <div class="bradcam_text">
                       <h3>Download Berkas</h3>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <!-- /bradcam_area  -->
   <!-- prising_area  -->
   <div class="prising_area">
       <div class="container">
           <div class="row">
               <div class="col-xl-12">
                   <div class="section_title text-center wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".5s">
                       <h3>Kategori Berkas</h3>
                       <p>Berikut merupakan beberapa kategori berkas yang tersedia dan bisa Anda Download, jika Kategori
                           yang Anda inginkan tidak tersedia, silahkan request ke kami</p>
                   </div>
               </div>
           </div>
           <div class="row no-gutters align-items-center justify-content-center">
               <?php foreach ($category as $data) : ?>
               <div class="col-xl-3 col-md-3 ml-4 mr-4">
                   <div class="single_prising text-center wow fadeInUp" data-wow-duration=".7s" data-wow-delay=".8s">
                       <div class="prising_header d-flex justify-content-between green_header">
                           <h3><?= $data['category_name'] ?></h3>
                       </div>
                       <ul>
                           <li><?= $data['category_description'] ?></li>
                       </ul>
                       <div class="prising_bottom">
                           <a href="<?= base_url() ?>user/detail_berkas/<?= $data['id_category'] ?>"
                               class="get_now prising_btn">Lihat
                               Berkas</a>
                       </div>
                   </div>
               </div>
               <?php endforeach ?>
           </div>
       </div>
   </div>
   <!--/ prising_area  -->

   <!-- komentar  -->
   <div class="prising_area">
       <div class="container">
           <div class="row">
               <div class="col-xl-12">
                   <div class="section_title text-center wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".5s">
                       <h3>Komentar</h3>
                       <p>Silahkan berkomentar dengan bahasa yang sopan dan tidak mengandung SARA, komentar yang
                           menyalahi aturan akan langsung dihapus</p>
                   </div>
                   <div class="row no-gutters align-items-center justify-content-center">
                       <div class="col-xl-4 col-md-4 ml-4 mr-4 wow fadeInUp" data-wow-duration=".7s"
                           data-wow-delay=".8s">
                           <?php if (validation_errors()) : ?>
                           <div class="alert alert-danger" role="alert">
                               <?= validation_errors(); ?>
                           </div>
                           <?php endif ?>
                           <?php if ($this->session->flashdata('flash')) : ?>
                           <div class="alert alert-success" role="alert">
                               <?= $this->session->flashdata('flash'); ?>
                           </div>
                           <?php endif ?>
                           <form action="" method="post" class="mb-5">
                               <div class="form-group">
                                   <input type="hidden" value="<?= $login[0]['first_name']; ?> " name="nama">
                               </div>
                               <div class="form-group">
                                   <textarea class="form-control" id="textarea" name="komentar" rows="7"
                                       placeholder="Tulis Komentar Disini..."></textarea>
                               </div>
                               <div class="form-group">
                                   <button class="btn-primary btn form-control" id="loginbutton">Kirim Komentar</button>
                               </div>
                           </form>
                       </div>
                   </div>
                   <hr class="wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".9s">
                   <div class="row no-gutters align-items-center justify-content-center">
                       <div class="col-xl-12 col-md-12 mb-3 ml-4 pt-4 pl-4 pr-4 mr-4 wow fadeInUp"
                           data-wow-duration=".7s" data-wow-delay=".8s">
                           <div class="table-responsive">
                               <table id="dataTables">
                                   <thead>
                                       <th>
                                           <h3>Seluruh Komentar</h3>
                                       </th>
                                   </thead>
                                   <tbody>
                                       <?php foreach ($komentar as $data) : ?>
                                       <tr>
                                           <td>
                                               <div class="komentar pt-4 pl-4 pr-4 pb-1 mb-2 wow fadeInUp"
                                                   data-wow-duration=".7s" data-wow-delay=".8s">
                                                   <p><?= $data['date']; ?></p>
                                                   <h5><?= $data['user']; ?></h5>
                                                   <hr width="8%" Align="left">
                                                   <pre><?= htmlentities($data['isi'], ENT_QUOTES, 'UTF-8'); ?>
                                                   </pre>
                                               </div>
                                           </td>
                                       </tr>
                                       <?php endforeach; ?>
                                   </tbody>
                               </table>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>