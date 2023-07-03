<?= $this->extend("layouts/profileLayout") ?>

<?= $this->section("profilelayout") ?>

<!-- publish book area strat -->
<div class="publish_book d-flex justify-content-end w-100">
    <button class="common_btn" data-bs-toggle="modal" data-bs-target="#publishbook">Publish a Book</button>
</div>

<!-- Modal -->
<div class="modal fade " id="publishbook" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div style="max-width: 960px;" class="modal-dialog modal-dialog-scrollable custom_modal">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Publish Book</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart(base_url("books/create"), ["id" => "booksForm", "method" => "post"]) ?>
                <input type="hidden" name="book_id" id="book_id">
                <input type="hidden" name="user_id" id="user_id" value="<?= session("id") ?>">
                <div class="mb-3">
                    <select class="form-select mb-3" name="division" id="division">
                        <option value="-1">Select Division</option>
                        <?php

                        if ($divisions) {
                            foreach ($divisions as $key => $divi) {
                        ?>
                                <option value="<?= $divi['id'] ?>"><?= $divi['name'] ?></option>
                        <?php
                            }
                        } ?>
                        ?>
                    </select>
                    <select class="form-select" name="districts" id="districts">
                        <option value="-1">Select District</option>
                    </select>
                </div>
                <div class="mb-3">
                    <select class="form-select mb-3" name="categories" id="categoriesselect">
                        <option value="-1">Select Category</option>
                        <?php

                        if ($categories) {
                            foreach ($categories as $key => $cat) {
                        ?>
                                <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                        <?php
                            }
                        } ?>
                        ?>
                    </select>
                    <select class="form-select" name="subcategories" id="subcategories">
                        <option value="-1">Select SubCategory</option>
                    </select>
                </div>
                <div class="mb-3">
                    <select class="form-select mb-3" name="writter" id="writter">
                        <option value="-1">Select Writter</option>
                        <?php

                        if ($writters) {
                            foreach ($writters as $key => $writter) {
                        ?>
                                <option value="<?= $writter['id'] ?>"><?= $writter['name'] ?></option>
                        <?php
                            }
                        } ?>
                        ?>
                    </select>
                    <select class="form-select" name="publisher" id="publisher">
                        <option value="-1">Select Publisher</option>
                        <?php

                        if ($publishers) {
                            foreach ($publishers as $key => $publisher) {
                        ?>
                                <option value="<?= $publisher['id'] ?>"><?= $publisher['name'] ?></option>
                        <?php
                            }
                        } ?>
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <select class="form-select mb-3" name="language" id="language">
                        <option value="-1">Select Language</option>
                        <option value="bangla">Bangla</option>
                        <option value="english">English</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input class="form-control" type="text" name="name" id="name" placeholder="Book Name">
                </div>
                <div class="mb-3">
                    <input class="form-control" type="number" name="price" id="price" placeholder="Book Price">
                </div>
                <div class="mb-3">
                    <input class="form-control" type="number" name="page" id="page" placeholder="Book Page No">
                </div>
                <div class="mb-3">
                    <input class="form-control" type="file" name="image" id="image">
                </div>
                <input class="common_btn" type="submit" value="Add Book">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->



<div class="publish_book_area mt-3">
    <div class="row">
        <div class="container">
            <div class="row g-3">
                <div class="col-lg-4">
                    <div class="single_item">
                        <div class="img_box">
                            <img src="<?= base_url("assets/images/books/book1.jpg") ?>" alt="">
                        </div>
                        <div class="content_box">
                            <h3><a href="#">Book Title</a></h3>
                            <h5>Authors</h5>
                            <p><i class="fa-solid fa-bangladeshi-taka-sign"></i>600</p>
                        </div>
                        <div class="content_btn d-flex justify-content-around pb-2">
                            <button class="btn btn-outline-success">View</button>
                            <button class="btn btn-outline-danger">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- publish book area end -->

<?= $this->endSection() ?>

<?= $this->section("profilescript") ?>
<script>
    $(document).ready(function() {

        // Display data
        function displayData(data, place) {
            let select = $(`#${place}`);
            let html = `  <option value="-1">Select ${place}</option>`;
            select.html("");
            $.each(data.data, function(index, res) {
                html += `<option value="${res.id}">${res.name}</option>`
            })

            select.html(html);
        }

        // Categories Change       
        $("#categoriesselect").change(function() {
            $id = $(this).val();

            $.ajax({
                url: "<?= base_url("profile/subcategories") ?>",
                type: "GET",
                data: {
                    id: $id
                },
                success: function(data) {

                    if (data.status) {
                        displayData(data, "subcategories");
                    }
                }
            })
        })

        // Change Divisions
        $("#division").change(function() {
            $id = $(this).val();

            $.ajax({
                url: "<?= base_url("profile/districts") ?>",
                type: "GET",
                data: {
                    id: $id
                },
                success: function(data) {
                    if (data.status) {
                        displayData(data, "districts");
                    }
                }
            })
        })

        // Create Books
        $("#booksForm").submit(function(e) {
            e.preventDefault();
            let formdata = new FormData(this);

            $.ajax({
                url: "<?= base_url('profile/books/create') ?>",
                type: "POST",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log(data);
                    // if (data.status) {
                    //     Swal.fire(
                    //         'Good job!',
                    //         data.message,
                    //         'success'
                    //     ).then(() => {
                    //         getWriters(1);
                    //         clearform();
                    //     })
                    // }
                }
            });

        })


    })
</script>
<?= $this->endSection() ?>