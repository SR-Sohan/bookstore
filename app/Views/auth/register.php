<?= $this->extend("layouts/layout") ?>

<?= $this->section("content") ?>

<div class="container">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="form_area  my-5 ">
            <?= form_open_multipart('register',['method' => 'post']) ?>
                    <h1 class="mb-5">Register Form</h1>
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="name" placeholder="name">
                        <label for="name">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="phone" class="form-control" id="phone" placeholder="name@example.com">
                        <label for="phone">Phone</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="cpassword" name="password" class="form-control" id="cpassword" placeholder="Password">
                        <label for="cpassword">Confirm Password</label>
                    </div>
                    <input class="common_btn" type="submit" value="Sign Up">
                    <p class="my-3">Do have account? <a href="<?= base_url("login") ?>">Sign In</a></p>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <img class="img-fluid" src="<?= base_url("assets/image/icon/register.svg") ?>" alt="">
        </div>
    </div>
</div>

<?= $this->endSection() ?>