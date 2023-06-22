<?= $this->extend("layouts/adminlayout") ?>


<?= $this->section("admincontent") ?>

<div class="admin_content_area mt-4 ">
    <div class="admin_content_header d-flex align-items-center justify-content-between">
        <h1>Sub Categories</h1>
        <div id="adminBtn" class="add_item">
            <i id="icon" class="fa-solid fa-plus"></i>
        </div>
    </div>
    <div id="admin_form" class="admin_content_form w-75  mx-auto ">
        <form class="p-5 shadow-lg mt-3 rounded" action="">
            <input type="hidden" name="sub_id" id="subId" value="">
            <div class="form-floating mb-3">
                <select id="category_id" name="category" class="form-select" aria-label="Default select example">
                    <option value="-1" selected>Select Category</option>
                    <?php
                    foreach ($categories as $category) {
                    ?>
                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>

                    <?php } ?>
                </select>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="name" class="form-control" id="name" placeholder="name@example.com">
                <label for="name">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input id="description" type="text" name="description" class="form-control" id="description" placeholder="description">
                <label for="description">Description</label>
            </div>
            <input id="addBtn" class="btn btn-outline-danger" type="button" value="Add SubCategory">
        </form>
    </div>
    <div class="admin_content_table mt-5">
        <div class="data_manage_section my-4 d-flex align-items-center justify-content-between">
            <div class="search_form ">
                <input type="text" name="search" id="search" placeholder="Search subcategories...">
                <input id="searchBtn" class="btn btn-outline-danger" type="button" value="Search">
            </div>
            <select id="filterSubCategory" style="width: 220px;" class="form-select mr-5" aria-label="Default select example">
                <option value="-1" selected>Filter By Category</option>
                <?php
                foreach ($categories as $category) {
                ?>
                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>

                <?php } ?>
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
                    <th>Category</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbody" >

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

        // Clear form
        function clearform() {
            $("#category_id").val("-1");
            $("#name").val("");
            $("#description").val("");
            $("#addBtn").val('Add');
            $("#admin_form").hide(400);
            let icon = $("#icon");
            icon.toggleClass('fa-plus fa-minus');

        }

        // Show Subcategories
        function showCategories(data) {
            if (data.subcategories.length < 1) {
                let html;
                html += `<tr>`;
                html += "<td></td>";
                html += "<td></td>";
                html += "<td></td>";
                html += "<td><h4 class=' text-center text-danger my-5 ps-5 ms-5'>Data Not Found!</h4></td>";
                html += "<td></td>";
                html += "<td></td>";
                html += `</tr>`;
                $("#tbody").html(html);
               
            }else{
                let html;
                $.each(data.subcategories, function(index, subcat) {
                    html += `<tr>`;
                    html += "<td></td>";
                    html += `<td>${index + 1}</td>`;
                    html += `<td id="scat_name">${subcat.name}</td>`;
                    html += `<td data-catid="${subcat.catid}" id="scat_id">${subcat.catname}</td>`;
                    html += `<td id="scat_des">${subcat.description}</td>`;
                    html += `<td> <button data-id="${subcat.id}" id="editBtn" class="btn btn-outline-success">Edit</button> <button data-id="${subcat.id}" id="deleteBtn"  class="btn btn-outline-danger">Delete</button> </td>`;
                    html += `</tr>`;
                })
                $("#tbody").html(html);
                $('#pagination-links').empty().append(data.pager);
            }

        }
        //Load SubCategories
        function loadData(pageNumber) {
            $.ajax({
                url: "<?= base_url('admin/subcategories/data') ?>",
                type: "GET",
                data: {
                    page: pageNumber
                },
                success: function(data) {
                    if (data.subcategories) {
                        showCategories(data)
                    }
                }
            })
        }
        loadData(1);

        // Categories pagination
        $('#pagination-links').on('click', 'a', function(e) {
            e.preventDefault();
            let pageNumber = $(this).attr('href').split('page=')[1];
            loadData(pageNumber);
        });

        // Add Subcategories 
        $("#addBtn").click(function() {
            let sub_id = $("#subId").val();
            let cat_id = $("#category_id").val();
            let name = $("#name").val();
            let description = $("#description").val();
            $.ajax({
                url: "<?= base_url("admin/subcategories/create") ?>",
                type: "POST",
                data: {
                    sub_id: sub_id,
                    cat_id: cat_id,
                    name: name,
                    description: description
                },
                success: function(data) {
                    if (data.status) {
                        Swal.fire(
                            'Good job!',
                            data.message,
                            'success'
                        ).then(() => {
                            loadData(1);
                            clearform();
                        })

                    } else {
                        alert(data.message);
                    }
                }
            })


        })

        // Delete SubCategories
        $("#tbody").on("click", "#deleteBtn", function() {
            let id = $(this).data('id');
            Swal.fire({
                    title: 'Do you want to delete the Categories??',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Delete',
                    denyButtonText: `Don't delete`,
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "<?= base_url("admin/subcategories/delete") ?>",
                            type: "POST",
                            data: {
                                id: id
                            },
                            success: function(data) {
                                if (data.status) {
                                    Swal.fire(
                                        'Good job!',
                                        data.message,
                                        'success'
                                    ).then(() => {
                                        loadData(1);
                                    })
                                }
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }

                })

        });

        // Edit Subcategories
        $("#tbody").on("click", "#editBtn", function() {
            $subid = $(this).data("id");
            $("#subId").val($subid);
            $("#category_id").val($(this).parent().parent().find("#scat_id").data("catid"));
            $("#name").val($(this).parent().parent().find("#scat_name").html());
            $("#description").val($(this).parent().parent().find("#scat_des").html());

            $("#admin_form").show(400);
            $("#addBtn").val("Update");
            let icon = $("#icon");
            icon.toggleClass('fa-plus fa-minus');
        });

        // Search AutoLoad
        $('#search').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?= base_url('admin/subcategories/autocomplete'); ?>",
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

        // Search Subcategories
        $("#searchBtn").click(function() {
            let text = $("#search").val();

            if (text == "") {
                alert("Please enter search keyword");
            } else {
                $.ajax({
                    url: "<?= base_url('admin/subcategories/search') ?>",
                    type: "GET",
                    data: {
                        text: text
                    },
                    success: function(data) {
                        showCategories(data)
                    }
                })
            }
        });

        // Filter Subcategory
        $("#filterSubCategory").change(function() {
            let val = $(this).val();
            if (val == "-1") {
                alert("Please select Category");
            } else {
                $.ajax({
                    url: "<?= base_url('admin/subcategories/filter') ?>",
                    type: "GET",
                    data: {
                        id: val
                    },
                    success: function(data) {
                        console.log(data);
                        showCategories(data)
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
            loadData(1);
        })

    })
</script>
<?= $this->endSection() ?>