<!-- prising_area  -->
<div class="prising_area login_area">
    <div class="container">
        <div class="row no-gutters align-items-center justify-content-center">
            <div class="col-xl-5 col-md-5 ml-4 mr-4 pl-3 pr-3 login wow fadeInUp" data-wow-duration=".7s"
                data-wow-delay=".8s">
                <div class="col-lg-12 table-responsive mt-4">

                    <h1 class="mt-3">Upload File</h1>
                    <p>Input your project file information, make sure the file information is valid</p>

                    <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= validation_errors(); ?>
                    </div>
                    <?php endif ?>
                    <?php if ($this->session->flashdata('flash')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $this->session->flashdata('flash'); ?>
                    </div>
                    <?php endif ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" value="<?= $login[0]['first_name']; ?> " name="nama">
                        </div>
                        <div class="form-group">
                            <label for="file_name">File Name</label>
                            <input type="text" class="form-control" id="file_name" name="file_name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="protection">File Protection</label>
                            <select class="form-control" id="protection" name="protection">
                                <option value="">Select Information File Protection...</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Category">File Category</label>
                            <select class="form-control" id="Category" name="category">
                                <option value="">Select Information File Protection...</option>
                                <?php foreach ($kategori as $data) : ?>
                                <option value="<?= $data['id_category'] ?>"><?= $data['category_name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="file">Upload File</label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-primary btn form-control mb-3">Save
                                File</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ prising_area  -->