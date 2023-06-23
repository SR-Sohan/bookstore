<?= $this->extend("layouts/adminlayout") ?>


<?= $this->section("admincontent") ?>

<div class="admin_content_area mt-4 ">
    <div class="admin_content_header d-flex align-items-center justify-content-between">
        <h1>Writers</h1>
        <div id="adminBtn" class="add_item">
            <i id="icon" class="fa-solid fa-plus"></i>
        </div>
    </div>
    <div id="admin_form" class="admin_content_form w-75  mx-auto ">
        <?= form_open_multipart(base_url("admin/writers/create"), ["id" => "writersForm", "class" => "p-5 shadow-lg mt-3 rounded", "method" => "post"]) ?>
        <input type="hidden" name="writer_id" id="writerId" value="">
        <div class="form-floating mb-3">
            <input type="text" name="name" class="form-control" id="name" placeholder="name@example.com">
            <label for="name">Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" name="bio" class="form-control" id="bio" placeholder="bio">
            <label for="bio">Bio</label>
        </div>
        <div class="form-floating mb-3">
            <select name="country" id="country" class="form-select" aria-label="Default select example">
                <option value="-1" selected>Select Country</option>
                <?php foreach ($countries as  $country) {  ?>

                    <option value="<?= $country['id'] ?>"><?= $country['nicename'] ?></option>

                <?php   } ?>

            </select>
        </div>
        <div class="form-floating mb-3">
            <input type="file" name="image" id="image">
            <img style="width: 150px;" id="form_img" src="" alt="">
        </div>
        <input id="addBtn" class="btn btn-outline-danger" type="submit" value="Add Writer">
        </form>
    </div>
    <div class="admin_content_table mt-5">

        <div class="data_manage_section my-4 d-flex align-items-center justify-content-between">
            <div class="search_form ">
                <input type="text" name="search" id="search" placeholder="Search subcategories...">
                <input id="searchBtn" class="btn btn-outline-danger" type="button" value="Search">
            </div>
            <select id="filterSubCategory" style="width: 220px;" class="form-select mr-5" aria-label="Default select example">
                <option value="-1">Filter By Country</option>
                <?php foreach ($countries as  $country) {  ?>

                    <option value="<?= $country['id'] ?>"><?= $country['nicename'] ?></option>

                <?php   } ?>
            </select>
            <div class="refresh_area">
                <button id="refresh" class="btn btn-outline-danger"><i class="fa-solid fa-rotate-right"></i> Refresh</button>
            </div>
        </div>
        <table class="table table-success table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>SL.</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Country</th>
                    <th>Bio</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>
        <div id="pagination-links" class="d-flex justify-content-center">
        </div>
    </div>

</div>
<?= $this->endSection() ?>

<?= $this->section("script") ?>
<script>
    $(document).ready(function() {
        //clearform
        function clearform() {
            $("#writerId").val("");
            $("#name").val("");
            $("#bio").val("");
            $('#image').val('');
            $("#country").val("-1");
            $("#form_img").attr("src", '');
            $("#addBtn").val('Add');
            $("#admin_form").hide(400);
            let icon = $("#icon");
            icon.toggleClass('fa-plus fa-minus');

        }

        // Show Data 
        function showData(data) {
            if (data.writers.length < 1) {
                let html;
                html += `<tr>`;
                html += "<td></td>";
                html += "<td></td>";
                html += "<td></td>";
                html += "<td><h4 class=' text-center text-danger my-5 ps-5 ms-5'>Data Not Found!</h4></td>";
                html += "<td></td>";
                html += "<td></td>";
                html += "<td></td>";
                html += `</tr>`;
                $("#tbody").html(html);

            } else {
                let html;
                $.each(data.writers, function(index, writer) {
                    html += `<tr>`;
                    html += "<td></td>";
                    html += `<td>${index + 1}</td>`;
                    html += `<td id="writer_name">${writer.name}</td>`;
                    html += `<td  id="writer_image"><img  src="<?= base_url("uploads/writers/") ?>${writer.image}" /></td>`;
                    html += `<td data-id="${writer.countryId}" id="writer_country">${writer.nicename}</td>`;
                    html += `<td   id="writer_bio">${writer.bio}</td>`;
                    html += `<td> <button data-id="${writer.id}" id="editBtn" class="btn btn-outline-success">Edit</button> <button data-id="${writer.id}" id="deleteBtn"  class="btn btn-outline-danger">Delete</button> </td>`;
                    html += `</tr>`;
                })
                $("#tbody").html(html);
                $('#pagination-links').empty().append(data.pager);
            }

        }
        // Get Writers
        function getWriters(pager) {
            $.ajax({
                url: "<?= base_url("admin/writers/get") ?>",
                type: "GET",
                data: {
                    page: pager
                },
                success: function(data) {
                    showData(data);
                }
            });
        }
        getWriters(1);

        // writers pagination
        $('#pagination-links').on('click', 'a', function(e) {
            e.preventDefault();
            let pageNumber = $(this).attr('href').split('page=')[1];
            loadData(pageNumber);
        });

        // Add Writers
        $("#writersForm").submit(function(e) {
            e.preventDefault();
            let formdata = new FormData(this);

            $.ajax({
                url: "<?= base_url('admin/writers/create') ?>",
                type: "POST",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status) {
                        Swal.fire(
                            'Good job!',
                            data.message,
                            'success'
                        ).then(() => {
                            getWriters(1);
                            clearform();
                        })
                    }
                }
            });


        })

        //Delete Writers
        $("#tbody").on("click", "#deleteBtn", function() {
            let id = $(this).data("id");
            Swal.fire({
                title: 'Do you want to delete the Writers??',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Delete',
                denyButtonText: `Don't delete`,
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('admin/writers/delete') ?>",
                        type: "POST",
                        data: {
                            writer_id: id,
                        },
                        success: function(data) {
                            if (data.status) {
                                Swal.fire(
                                    'Good job!',
                                    data.message,
                                    'success'
                                ).then(() => {
                                    getWriters(1);
                                })
                            }
                        }
                    });
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })
        })

        // Edit Writers
        $("#tbody").on("click", "#editBtn", function() {
            let id = $(this).data('id');
            let name = $(this).parent().parent().find("#writer_name").html();
            let bio = $(this).parent().parent().find("#writer_bio").html();
            let country = $(this).parent().parent().find("#writer_country").data("id");
            let image = $(this).parent().parent().find("#writer_image").find("img").attr("src");

            $("#writerId").val(id);
            $("#name").val(name);
            $("#country").val(country);
            $("#bio").val(bio);
            $("#addBtn").val("Update");
            $("#form_img").attr("src", image);
            $("#admin_form").show(400);

            let icon = $("#icon");
            icon.toggleClass('fa-plus fa-minus');
        });

        // Search Writers 
        $("#searchBtn").click(function() {
            let text = $("#search").val();

            if (text == "") {
                alert("Please enter search keyword");
            } else {
                $.ajax({
                    url: "<?= base_url('admin/writers/search') ?>",
                    type: "GET",
                    data: {
                        text: text
                    },
                    success: function(data) {
                        showData(data)
                    }
                })
            }
        });


        // Search Autocomplete
        $('#search').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?= base_url('admin/writers/autocomplete'); ?>",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        term: request.term
                    },
                    success: function(data) {

                        var suggestions = [];
                        $.each(data, function(index, item) {
                            suggestions.push(item.name);
                        });
                        response(suggestions);
                    }
                });
            },
            minLength: 1
        });
        // Filter Writers by Country
        $("#filterSubCategory").change(function() {
            let val = $(this).val();
            if (val == "-1") {
                alert("Please select Country");
            } else {
                $.ajax({
                    url: "<?= base_url('admin/writers/filter') ?>",
                    type: "GET",
                    data: {
                        id: val
                    },
                    success: function(data) {
                        showData(data)
                    }
                })
            }
        })

        // Refresh 
        $("#refresh").click(function() {
            var isFormVisible = $('#admin_form').is(":visible");
            if (isFormVisible) {
                clearform();
            }
            $("#search").val("");
            $("#filterSubCategory").val("-1");
            getWriters(1);
        })
    });
</script>
<?= $this->endSection(); ?>