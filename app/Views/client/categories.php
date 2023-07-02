<?= $this->extend("layouts/layout") ?>
<?= $this->section("content") ?>

<!-- banner section start  -->
<div class="banner_section">
    <div class="container">
        <div class="banner_img my-5">
            <img src="<?= base_url("assets/images/books/allcategory.png") ?>" alt="">
        </div>
        <div class="banner_content">
            <p>লক্ষাধিক বইয়ের সংগ্রহ রকমারি ডট কমে। বইয়ের এই বিশাল সমুদ্র-মন্থনে পাঠকের সুবিধার্থে প্রায় ৫০ টির মতো ক্যাটাগরি ও সহস্রাধিক বিষয়ভিত্তিক ক্যাটাগরি রয়েছে রকমারি ডট কমে। যার ফলে খুব সহজেই পাঠক তার পছন্দের ক্যাটাগরি বেছে নিয়ে নির্দিষ্ট বিষয়ভিত্তিক বইগুলো খুঁজে পাবে খুব সহজেই। রকমারি ডট কমের এই বিশাল বইয়ের সমুদ্রে জ্ঞানের জাহাজের নাবিক হতে আপনাকে নিমন্ত্রণ। মানচিত্রটা ধরা আছে নিচেই...</p>
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
                    foreach ($data as $key => $categories) {
                       
            ?>
            <div class="col-lg-3">
                <a href="<?= base_url("categories/") ?><?=$categories["id"] ?>" class="single_content">
                    <img src="<?= base_url("assets/images/books/content.webp")?>" alt="">
                    <p><?= $categories['name'] ?></p>
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
