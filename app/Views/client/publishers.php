<?= $this->extend("layouts/layout") ?>
<?= $this->section("content") ?>

<!-- banner section start  -->
<div class="banner_section">
    <div class="container">
        <div class="banner_img my-5">
            <img src="<?= base_url("assets/images/books/allpublisher.png") ?>" alt="">
        </div>
        <div class="banner_content">
            <p>সাহিত্যের আঁতুড়ঘর। সাহিত্যের সঠিক মূল্যায়ন করে পাঠকের কাছে উন্মুক্ত করে দেয়ার গুরুদায়িত্ব এই প্রকাশকদের। কেবল বই প্রকাশ নয়,ভালো মানের সাহিত্য বই আকারে নিয়মিত প্রকাশ করে প্রকাশকরা সাহিত্যের ধারা সচলভাবে অব্যাহত রাখেন। পাণ্ডুলিপি,ছাপা,মুদ্রণপ্রমাদ,সব বাঁধা-ত্যাগ-তিতিক্ষা পার করে যখন একটি বাঁধাই করা বই,এক টুকরো সাহিত্য ফসল পাঠকের সাহিত্য রসের ক্ষুধা পূরণ করে তখনই প্রকাশক সার্থক। প্রকাশকদের এই সাহিত্যধারার ট্রেনের সহযাত্রী হয়ে তাই রয়েছে রকমারি ডট কম। রকমারি ডট কম প্রকাশকদের সুযোগ করে দিচ্ছে আধুনিক সাহিত্যের রেনেসাঁর,যেখানে সাধারণ পাঠক আর প্রকাশকের মাঝে সেতুবন্ধন হিসেবে কাজ করবে রকমারি।</p>
        </div>
    </div>
</div>
<!-- banner section end -->

<!-- content section start  -->
<div class="content_section_area my-5">
    <div class="container">
        <div class="row g-4">
            <?php 
                if($data){
                    foreach ($data as $key => $publisher) {
                        
                  
            ?>
            <div class="col-lg-3">
                <a href="<?= base_url("publishers/") ?><?= $publisher['id'] ?>" class="single_content">
                    <img src="<?= base_url("assets/images/books/content.webp")?>" alt="">
                    <p><?= $publisher['name'] ?></p>
                </a>
            </div>
            <?php }} ?>
        </div>
    </div>
</div>
<!-- content section end -->

<?= $this->endSection(); ?>


<?= $this->section("cscript") ?>

<script></script>

<?= $this->endSection(); ?>
