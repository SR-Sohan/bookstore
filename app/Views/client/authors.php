<?= $this->extend("layouts/layout") ?>
<?= $this->section("content") ?>

<!-- banner section start  -->
<div class="banner_section">
    <div class="container">
        <div class="banner_img my-5">
            <img src="<?= base_url("assets/images/books/author_list.jpg") ?>" alt="">
        </div>
        <div class="banner_content">
            <p>লেখক! আক্ষরিক ভাবে বলতে গেলে সৃজনশীল কোনকিছু লেখেন যিনি তাকেই লেখক বলা যায়। কিন্তু ‘লেখক’ শব্দটির ব্যাপ্তি আসলে এতোটুকুতেই সীমাবদ্ধ নয়। লেখক এই বাস্তবিক জগতের সমান্তরালে একটি কাল্পনিক পৃথিবী তৈরির ক্ষমতা রাখেন। কাল্পনিক চরিত্রগুলো তার লেখনী ও কলমের প্রাণখোঁচায় জীবন্ত হয়ে ওঠে। একজন লেখক তাঁর লেখার মাধ্যমে একটি প্রজন্মের চিন্তাধারা গড়ে দিতে পারেন। তাই লেখকদের কিংবদন্তী হবার পথ করে দিতে রকমারি ডট কম বদ্ধ পরিকর।</p>
        </div>
    </div>
</div>
<!-- banner section end -->

<!-- content section start  -->
<div class="content_section_area my-5">
    <div class="container">
        <h1 class="text-center my-5">লেখকগণ</h1>
        <div class="row">
            <?php 

                if($data){
                    foreach ($data as $key => $author) {
                        
                 
            ?>
            <div class="col-lg-3">
                <a href="<?= base_url("authors/") ?><?= $author["id"] ?>" class="single_author">
                    <div class="single_author_img">
                        <?php 
                            if($author["image"]){
                        ?>
                            <img src="<?= base_url("uploads/writers/")  ?><?= $author["image"] ?>" alt="">
                        <?php }else{ ?>
                            <img src="<?= base_url("assets/images/books/author.png") ?>" alt="">
                        <?php } ?>
                    </div>
                    <h4><?= $author["name"] ?></h4>
                </a>
            </div>
            <?php }}?>
        </div>
    </div>
</div>
<!-- content section end -->

<?= $this->endSection(); ?>


<?= $this->section("cscript") ?>

<script></script>

<?= $this->endSection(); ?>
