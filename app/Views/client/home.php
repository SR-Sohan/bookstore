<?= $this->extend("layouts/layout") ?>


<?= $this->section("content") ?>

<!-- carousel area start  -->
<div class="carousel_area">
    <div class="container">
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="2000">
                    <img src="<?= base_url("assets/images/books/book1.jpg") ?>" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="<?= base_url("assets/images/books/book2.jpg") ?>" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="<?= base_url("assets/images/books/book3.jpg") ?>" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>
<!-- carousel area end -->

<!-- book by categories area start  -->
<div class="book_by_categories_area my-5">
    <div class="container">

        <!-- single Category book start  -->
        <div class="single_category_book">
            <h2>Latest Books</h2>
            <div class="responsive-slider">

                <?php
                if ($newbook) {
                    foreach ($newbook as $key => $book) {


                ?>
                        <div style="height: 350px;" class="single_item d-flex align-items justify-content-between flex-column align-self-stretch">
                            <div class="img_box">
                                <img style="height: 150px" src="<?= base_url("uploads/books/") ?><?= $book["image"] ?>" alt="">
                            </div>
                            <div class="content_box ">
                                <h3><a href="#"><?= $book["name"] ?></a></h3>
                                <h5><a href="#"><?= $book["wname"] ?></a></h5>
                                <p><i class="fa-solid fa-bangladeshi-taka-sign"></i>600</p>
                            </div>
                        </div>

                <?php }
                } ?>

            </div>
        </div>
        <!-- single Category book end  -->

        <!-- single Category book start  -->
        <div class="single_category_book">
            <h2>ইসলামি বই</h2>
            <div class="responsive-slider">

                <?php
                if ($islamicbook) {
                    foreach ($islamicbook as $key => $book) {


                ?>
                        <div style="height: 350px;" class="single_item d-flex align-items justify-content-between flex-column align-self-stretch">
                            <div class="img_box">
                                <img style="height: 150px" src="<?= base_url("uploads/books/") ?><?= $book["image"] ?>" alt="">
                            </div>
                            <div class="content_box ">
                                <h3><a href="#"><?= $book["name"] ?></a></h3>
                                <h5><a href="#"><?= $book["wname"] ?></a></h5>
                                <p><i class="fa-solid fa-bangladeshi-taka-sign"></i>600</p>
                            </div>
                        </div>

                <?php }
                } ?>



            </div>
        </div>
        <!-- single Category book end  -->

        <!-- single Category book start  -->
        <div class="single_category_book">
            <h2>গল্প</h2>
            <div class="responsive-slider">
            <?php
                if ($story) {
                    foreach ($story as $key => $book) {


                ?>
                        <div style="height: 350px;" class="single_item d-flex align-items justify-content-between flex-column align-self-stretch">
                            <div class="img_box">
                                <img style="height: 150px" src="<?= base_url("uploads/books/") ?><?= $book["image"] ?>" alt="">
                            </div>
                            <div class="content_box ">
                                <h3><a href="#"><?= $book["name"] ?></a></h3>
                                <h5><a href="#"><?= $book["wname"] ?></a></h5>
                                <p><i class="fa-solid fa-bangladeshi-taka-sign"></i>600</p>
                            </div>
                        </div>

                <?php }
                } ?>
            </div>
        </div>
        <!-- single Category book end  -->
    </div>
</div>
<!-- book by categories area end -->

<?= $this->endSection() ?>

<?= $this->section("cscript") ?>

<?= $this->endSection() ?>