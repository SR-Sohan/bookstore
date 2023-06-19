<?= $this->extend("layouts/adminlayout") ?>


<?= $this->section("admincontent") ?>

<div class="admin_content_area mt-4 ">
    <div  class="admin_content_header d-flex align-items-center justify-content-between">
        <h1>Writers</h1>
        <div id="adminBtn" class="add_item">
            <i id="icon" class="fa-solid fa-plus"></i>
        </div>
    </div>
    <div id="admin_form" class="admin_content_form w-75  mx-auto ">
        <form class="p-5 shadow-lg mt-3 rounded" action="">
            <div class="form-floating mb-3">
                <input type="text" name="name" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="description" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Description</label>
            </div>
            <div class="form-floating mb-3">
            <select class="form-select" aria-label="Default select example">
                <option value="-1" selected>Select Country</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            </div>
            <div class="form-floating mb-3">
                <input type="file" name="image" id="">
            </div>
            <input class="btn btn-outline-danger" type="submit" value="Add Writer">
        </form>
    </div>
    <div class="admin_content_table mt-5">
        <table class="table table-success table-striped">
            <thead>
                <tr>
                    <th>SL.</th>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody >
                <tr>
                    <td>1</td>
                    <td>Golpo</td>
                    <td>Golpo</td>
                    <td>Golpo</td>
                    <td> <button class="btn btn-outline-success">Edit</button> <button  class="btn btn-outline-danger">Delete</button></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>







<?= $this->endSection() ?>