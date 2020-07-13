   <!-- bradcam_area  -->
   <div class="bradcam_area bradcam_bg_1">
       <div class="container">
           <div class="row">
               <div class="col-xl-12">
                   <div class="bradcam_text">
                       <h3>Tentang Saya</h3>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <!-- /bradcam_area  -->
   <!-- about  -->
   <div class="features_area">
       <div class="container">
           <div class="features_main_wrap">
               <div class="row align-items-center">
                   <div class="col-xl-3 col-lg-3 offset-xl-1 offset-lg-1
                            col-md-4">
                       <div class="about_draw wow fadeInUp" data-wow-duration=".7s" data-wow-delay=".5s">
                           <img src="<?= base_url() ?>assets/img/ilstrator_img/deyan.jpg" class="rounded-circle">
                       </div>
                   </div>
                   <div class="col-xl-8 col-lg-8 col-md-8">
                       <div class="features_info">
                           <h3 class="wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".3s">Siapa Saya?</h3>
                           <p class="wow fadeInUp" data-wow-duration=".6s" data-wow-delay=".4s">Hai, nama saya I Gede
                               Riyan Ardi Darmawan, saat ini saya sedang dalam masa studi di Universitas Pendidikan
                               Ganesha, Saya adalah seorang mahasiswa yang mempunyai mimpi menjadi
                               seorang Full Stack Developer, ini merupakan salah satu website karya saya dengan bantuan
                               template dari Colorlib. Semoga dengan website ini saya dapat berbagi ilmu-ilmu yang saya
                               miliki sekaligus memberikan pengalaman tersendiri bagi saya.
                           </p>
                       </div>
                   </div>
               </div>
           </div>
           <div class="features_main_wrap">
               <div class="row align-items-center">
                   <div class="col-xl-4 col-lg-4 col-md-5">
                       <div class="features_info">
                           <h3 class="wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".3s">Kemampuan Saya</h3>
                           <p class="wow fadeInUp" data-wow-duration=".6s" data-wow-delay=".4s">Saya memiliki beberapa
                               kemampuan, walaupun belum terlalu menguasai namun saya masih terus berusaha mengasah
                               kemampuan saya lebih dalam lagi, berikut merupakan kemampuan saya
                           </p>
                       </div>
                   </div>
                   <div class="col-xl-6 col-lg-6 offset-xl-1 offset-lg-1
                            col-md-7">
                       <div class="about_draw wow fadeInUp" data-wow-duration=".7s" data-wow-delay=".5s">

                           <div class="progress-table-wrap">
                               <div class="progress-table">
                                   <div class="table-head">
                                       <div class="visit">Skill</div>
                                       <div class="country">Persentase</div>
                                   </div>
                                   <div class="table-row">
                                       <div class="visit">C/C++ Programming</div>
                                       <div class="percentage">
                                           <div class="progress">
                                               <div class="progress-bar color-1" role="progressbar" style="width: 30%"
                                                   aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                               </div>
                                           </div>
                                           <p>30%</p>
                                       </div>
                                   </div>
                                   <div class="table-row">
                                       <div class="visit">Front End (HTML,CSS,Javascript)</div>
                                       <div class="percentage">
                                           <div class="progress">
                                               <div class="progress-bar color-2" role="progressbar" style="width: 30%"
                                                   aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                               </div>
                                           </div>
                                           <p>30%</p>
                                       </div>
                                   </div>
                                   <div class="table-row">
                                       <div class="visit">Back End (PHP,LINUX,MYSQL,SQL)</div>
                                       <div class="percentage">
                                           <div class="progress">
                                               <div class="progress-bar color-3" role="progressbar" style="width: 35%"
                                                   aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">
                                               </div>
                                           </div>
                                           <p>35%</p>
                                       </div>
                                   </div>
                                   <div class="table-row">
                                       <div class="visit">Java Programming</div>
                                       <div class="percentage">
                                           <div class="progress">
                                               <div class="progress-bar color-4" role="progressbar" style="width: 20%"
                                                   aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                               </div>
                                           </div>
                                           <p>20%</p>
                                       </div>
                                   </div>
                                   <div class="table-row">
                                       <div class="visit">Web Design</div>
                                       <div class="percentage">
                                           <div class="progress">
                                               <div class="progress-bar color-4" role="progressbar" style="width: 25%"
                                                   aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                               </div>
                                           </div>
                                           <p>25%</p>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
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
                       <h3>Project Saya</h3>
                       <p>Sebagai seorang Full Stack Developer,berikut merupakan kumpulan project-project website <br>
                           yang pernah saya buat sebelumnya</p>
                   </div>
               </div>
           </div>
           <div class="row no-gutters align-items-center justify-content-center">
               <?php foreach ($project as $data) : ?>
               <div class="col-xl-3 col-md-3 ml-4">
                   <div class="single_prising text-center wow fadeInUp" data-wow-duration=".7s" data-wow-delay=".8s">
                       <div class="prising_header d-flex justify-content-between green_header">
                           <h3><?= $data['project_name']; ?></h3>
                       </div>
                       <ul>
                           <li><?= $data['description']; ?></li>
                       </ul>
                       <div class="prising_bottom">
                           <a href="<?= $data['link']; ?>" target="blank" class="get_now prising_btn">Lihat
                               Website</a>
                       </div>
                   </div>
               </div>
               <?php endforeach; ?>
           </div>
       </div>
   </div>
   <!--/ prising_area  -->