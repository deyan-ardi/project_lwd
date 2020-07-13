 <!-- bradcam_area  -->
 <div class="bradcam_area bradcam_bg_1">
     <div class="container">
         <div class="row">
             <div class="col-xl-12">
                 <div class="bradcam_text">
                     <h3>Kumpulan Artikel</h3>
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
                     <h3>Artikel Pembelajaran</h3>
                     <p>Berikut merupakan beberapa artikel yang tersedia pada website ini</p>
                 </div>
             </div>
         </div>
         <div class="row no-gutters align-items-center justify-content-center">
             <?php foreach ($article as $data) : ?>
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
 <!--/ prising_area 