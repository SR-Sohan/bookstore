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
        </div>
        <input id="addBtn" class="btn btn-outline-danger" type="submit" value="Add Writer">
        </form>
    </div>
    <div class="admin_content_table mt-5">
        <table class="table table-success table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>SL.</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Country</th>
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
                html += `</tr>`;
                $("#tbody").html(html);

            } else {
                let html;
                $.each(data.writers, function(index, writer) {
                    html += `<tr>`;
                    html += "<td></td>";
                    html += `<td>${index + 1}</td>`;
                    html += `<td id="writer_name">${writer.name}</td>`;
                    html += `<td  id="writer_image"><img  src="${writer.image}" /></td>`;
                    html += `<td data-id="${writer.countryId}" id="writer_country">${writer.nicename}</td>`;
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
                            // loadData(1);
                            // clearform();
                        })
                    }
                }
            });


        })

    });
</script>
<?= $this->endSection(); ?>