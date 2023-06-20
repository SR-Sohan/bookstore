<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Stroe</title>
    <link href="<?= base_url('assets/css/styles.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
</head>

<body>

    <div class="form_area mt-5">
        <div class="container">
            <div class="form_wrap w-75 mx-auto mt-5 pt-5">
                <div class="row align-items-center ">
                    <div class="col-md-6">
                        <div class="singin_form ">
                            <form action="">
                                <h1 class="mb-5 text-danger">Login Form</h1>
                                <div class="form-floating mb-3">
                                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                    <label for="floatingInput">Email address</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <input class="btn btn-outline-danger" type="submit" value="Sign In">

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

</body>

</html>