<?= $this->extend("layouts/layout") ?>
<?= $this->section("content") ?>

<!-- profile area start  -->
<div class="profile_area">
    <div class="container">
        <div class="profile_wrap shadow-lg rounded p-4 mb-5 mt-3 bg-white">
            <div class="profile_heading d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4>অ্যাকাউন্ট</h4>
                </div>
                <div>
                    <h4>Sohanur Rahman</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="profile_sidebar">
                        <ul>
                            <li><a href="<?= base_url("profile") ?>">My Profile</a></li>
                            <li><a href="<?= base_url("settings") ?>">MemberShip</a></li>
                            <li><a href="<?= base_url("settings") ?>">Favorite</a></li>
                            <li><a href="<?= base_url("settings") ?>">Settings</a></li>
                            <li><a href="<?= base_url("logout") ?>">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="profile_content">
                        <?= $this->renderSection("profilelayout") ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- profile area end -->

<?= $this->endSection(); ?>


<?= $this->section("cscript") ?>

<?= $this->renderSection("profilescript") ?>

<?= $this->endSection(); ?>