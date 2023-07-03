<?= $this->extend("layouts/layout") ?>

<?= $this->section("content") ?>

    <div class="form_area mt-5">
        <div class="container">
            <div class="form_wrap w-75 mx-auto my-5 ">
                <div class="row align-items-center ">
                    <div class="col-md-6">
                        <div class="singin_form ">
                        <?= form_open_multipart('login',['method' => 'post']) ?>
                                <h1 class="mb-5 text-danger">Login Form</h1>
                                <div class="form-floating mb-3">
                                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                    <label for="floatingInput">Email address</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <input class="common_btn" type="submit" value="Sign In">
                                <p class="my-3">Don't have account? <a href="<?= base_url("register") ?>">Register</a></p>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="singin_img">
                            <img class="img-fluid" src="<?= base_url("assets/image/icon/login.svg") ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->endSection() ?>