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
            <input type="hidden" name="sub_id" id="subId">
            <div class="form-floating mb-3">
                <select id="category" name="category" class="form-select" aria-label="Default select example">
                    <option value="-1" selected>Select Category</option>
                    <?php
                    foreach ($categories as $category) {
                    ?>
                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>

                    <?php } ?>
                </select>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="name" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input id="description" type="text" name="description" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Description</label>
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
            <select style="width: 220px;" class="form-select mr-5" aria-label="Default select example">
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
    // Clear form
    function clearform() {
        $("#subId").val("");
        $("#name").val("");
        $("#description").val("");
        $("#addBtn").val('Add');
        $("#admin_form").hide(400);
        let icon = $("#icon");
        icon.toggleClass('fa-plus fa-minus');

    }

    // Show Subcategories
    function showCategories(data) {
        let html;
        $.each(data.subcategories, function(index, subcat) {
            html += `<tr>`;
            html += "<td></td>";
            html += `<td>${index + 1}</td>`;
            html += `<td id="cat_name">${subcat.name}</td>`;
            html += `<td id="cat_name">${subcat.catname}</td>`;
            html += `<td id="cat_des">${subcat.description}</td>`;
            html += `<td> <button data-id="${subcat.id}" id="editBtn" class="btn btn-outline-success">Edit</button> <button data-id="${subcat.id}" id="deleteBtn"  class="btn btn-outline-danger">Delete</button> </td>`;
            html += `</tr>`;
        })
        $("#tbody").html(html);
        $('#pagination-links').empty().append(data.pager);
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

    })
</script>
<?= $this->endSection() ?>