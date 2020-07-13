<!-- prising_area  -->
<div class="prising_area login_area">
    <div class="container">
        <div class="row no-gutters align-items-center justify-content-center">
            <div class="col-xl-5 col-md-5 ml-4 mr-4 pl-3 pr-3 login wow fadeInUp" data-wow-duration=".7s"
                data-wow-delay=".8s">
                <div class="col-lg-12 table-responsive mt-4">

                    <h1 class="mt-3">Insert New Comment</h1>
                    <p>Input your comment for website here</p>

                    <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= validation_errors(); ?>
                    </div>
                    <?php endif ?>

                    <form action="" method="post">
                        <div class="form-group">
                            <input type="hidden" value="<?= $login[0]['first_name']; ?> " name="nama">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="komentar" class="form-control" rows="10"></textarea>

                        </div>
                        <div class="form-group">
                            <button class="btn-primary btn form-control mb-3" id="loginbutton">Save Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ prising_area  -->