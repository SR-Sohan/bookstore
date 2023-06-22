<?= $this->extend("layouts/adminlayout") ?>


<?= $this->section("admincontent") ?>

<div class="admin_content_area mt-4 ">
    <div class="admin_content_header d-flex align-items-center justify-content-between">
        <h1>Categories</h1>
        <div id="adminBtn" class="add_item">
            <i id="icon" class="fa-solid fa-plus"></i>
        </div>
    </div>
    <div id="admin_form" class="admin_content_form w-75  mx-auto ">
        <form class="p-5 shadow-lg mt-3 rounded" action="">
            <?= csrf_field() ?>
            <p id="err_msg" class="text-center text-danger"></p>
            <input type="hidden" id="cat_id" name="cat_id" value="">
            <div class="form-floating mb-3">
                <input type="text" name="name" class="form-control" id="name" placeholder="name@example.com">
                <label for="name">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="description" class="form-control" id="description" placeholder="Password">
                <label for="description">Description</label>
            </div>
            <input id="addBtn" class="btn btn-outline-danger" type="button" value="Add Category">
        </form>
    </div>
    <div class="admin_content_table mt-5">
        <div class="data_manage_section my-4 d-flex align-items-center justify-content-between">
            <div class="search_form ">
                <input type="text" name="search" id="search" placeholder="Search categories...">
                <input id="searchBtn" class="btn btn-outline-danger" type="button" value="Search">
            </div>
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
                    <th>Description</th>
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


        // Show Categories 
        function showCategories(data) {
            if (data.categories.length < 1) {
                let html;
                html += `<tr>`;
                html += "<td></td>";
                html += "<td></td>";
                html += "<td><h4 class=' text-center text-danger my-5 ps-5 ms-5'>Data Not Found!</h4></td>";
                html += "<td></td>";
                html += "<td></td>";
                html += `</tr>`;
                $("#tbody").html(html);
               
            }else{

            let html;
            $.each(data.categories, function(index, category) {
                html += `<tr>`;
                html += "<td></td>";
                html += `<td>${index + 1}</td>`;
                html += `<td id="cat_name">${category.name}</td>`;
                html += `<td id="cat_des">${category.description}</td>`;
                html += `<td> <button data-id="${category.id}" id="editBtn" class="btn btn-outline-success">Edit</button> <button data-id="${category.id}" id="deleteBtn"  class="btn btn-outline-danger">Delete</button> </td>`;
                html += `</tr>`;
            })
            $("#tbody").html(html);
            $('#pagination-links').empty().append(data.pager);
        }
        }


        //clearform
        function clearform() {
            $("#cat_id").val("");
            $("#name").val("");
            $("#description").val("");
            $("#addBtn").val('Add');
            $("#admin_form").hide(400);
            let icon = $("#icon");
            icon.toggleClass('fa-plus fa-minus');
            
        }

        // Load categories
        function loadData(pageNumber) {
            $.ajax({
                url: "<?= base_url('admin/categories/data') ?>",
                type: "GET",
                data: {
                    page: pageNumber
                },
                success: function(data) {
                    if (data.categories) {
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


        //Categories add and update 
        $("#addBtn").click(function() {
            let errmsg = "";
            let err = false

            $cat_id = $("#cat_id").val();
            $name = $("#name").val();
            $description = $("#description").val();
            $("#cat_err_name").html("");
            $("#cat_err_des").html("");

            if ($name == '' || $description == '') {
                errmsg = "Please fill in all fields.";
                err = true;
            }
            if (err) {
                $("#err_msg").html(errmsg);

            } else {
                $("#err_msg").html('');
                $.ajax({
                    url: "<?= base_url('admin/categories/create') ?>",
                    type: "POST",
                    data: {
                        cat_id: $cat_id,
                        name: $name,
                        description: $description
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

                });
            }
        });

        // Delete a category
        $("#tbody").on("click", "#deleteBtn", function() {
            $id = $(this).data("id");
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
                            url: "<?= base_url('admin/categories/delete') ?>",
                            type: "POST",
                            data: {
                                cat_id: $id,
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

        // Edit category
        $("#tbody").on("click", "#editBtn", function() {
            let id = $(this).data("id");
            let catname = String($(this).parent().parent().find('#cat_name').html());
            let catdes = String($(this).parent().parent().find('#cat_des').html());


            $("#cat_id").val(id);
            $("#name").val(catname);
            $("#description").val(catdes);
            $("#addBtn").val("Update");
            $("#admin_form").show(400);
            let icon = $("#icon");
            icon.toggleClass('fa-plus fa-minus');
        })

        // Search Autocomplete
        $('#search').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?= base_url('admin/categories/autocomplete'); ?>",
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

        // Search section
        $("#searchBtn").click(function() {
            let text = $("#search").val();
            if (text == "") {
                alert("Please enter search keyword");
            } else {
                $.ajax({
                    url: "<?= base_url('admin/categories/search') ?>",
                    type: "GET",
                    data: {
                        text: text
                    },
                    success: function(data) {
                        showCategories(data)
                    }
                })
            }
        })



        // Refresh 
        $("#refresh").click(function() {
            var isFormVisible = $('#admin_form').is(":visible");
            if(isFormVisible){
                clearform();
            }
            $("#search").val("");     
            loadData(1);
        })
    })
</script>

<?= $this->endSection() ?>