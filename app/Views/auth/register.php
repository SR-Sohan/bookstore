<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Stroe</title>
    <link href="<?= base_url('assets/css/styles.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
</head>

<body style="background-color: #f1f0f0;">

    <div class="form_area w-50 mx-auto my-5  shadow-lg p-5 bg-white rounded">
        <form action="">
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
            <input class="btn btn-outline-danger" type="submit" value="Sign Up">
        </form>
    </div>

</body>

</html>