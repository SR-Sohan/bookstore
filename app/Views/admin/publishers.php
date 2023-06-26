<?= $this->extend("layouts/adminlayout") ?>


<?= $this->section("admincontent") ?>

<div class="admin_content_area mt-4 ">
    <div class="admin_content_header d-flex align-items-center justify-content-between">
        <h1>Publishers</h1>
        <div id="adminBtn" class="add_item">
            <i id="icon" class="fa-solid fa-plus"></i>
        </div>
    </div>
    <div id="admin_form" class="admin_content_form w-75  mx-auto ">
        <form class="p-5 shadow-lg mt-3 rounded" action="">
            <input type="hidden" id="publisher_id" name="publisher_id">
            <div class="form-floating mb-3">
                <input type="text" name="name" class="form-control" id="name" placeholder="name@example.com">
                <label for="name">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="address" class="form-control" id="address" placeholder="address">
                <label for="address">Address</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="address" class="form-control" id="phone" placeholder="phone" value="+880">
                <label for="phone">Phone</label>
            </div>

            <input id="addBtn" class="btn btn-outline-danger" type="button" value="Add Publisher">
        </form>
    </div>
    <div class="admin_content_table mt-5">
        <div class="data_manage_section my-4 d-flex align-items-center justify-content-between">
            <div class="search_form ">
                <input type="text" name="search" id="search" placeholder="Search publlisher...">
                <input id="searchBtn" class="btn btn-outline-danger" type="button" value="Search">
            </div>
            <div class="refresh_area">
                <button id="refresh" class="btn btn-outline-danger"><i class="fa-solid fa-rotate-right"></i> Refresh</button>
            </div>
        </div>
        <table class="table table-success table-striped">
            <thead>
                <tr>
                    <th>SL.</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
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

        // Clear Publisher 
        //clearform
        function clearform() {
            $("#publisher_id").val('');
            $("#name").val('');
            $("#address").val('');
            $("#phone").val('');
            $("#addBtn").val('Add');
            $("#admin_form").hide(400);
            let icon = $("#icon");
            icon.toggleClass('fa-plus fa-minus');

        }

        // Show Publisher
        function loadData(data) {
            if (data.publishers.length < 1) {
                let html;
                html += `<tr>`;
                html += "<td></td>";
                html += "<td></td>";
                html += "<td><h4 class=' text-center text-danger my-5 ps-5 ms-5'>Data Not Found!</h4></td>";
                html += "<td></td>";
                html += "<td></td>";
                html += `</tr>`;
                $("#tbody").html(html);

            } else {

                let html;
                $.each(data.publishers, function(index, publisher) {
                    html += `<tr>`;
                    html += `<td>${index + 1}</td>`;
                    html += `<td id="publisher_name">${publisher.name}</td>`;
                    html += `<td id="publisher_address">${publisher.address}</td>`;
                    html += `<td id="publisher_phone">${publisher.phone}</td>`;
                    html += `<td> <button data-id="${publisher.id}" id="editBtn" class="btn btn-outline-success">Edit</button> <button data-id="${publisher.id}" id="deleteBtn"  class="btn btn-outline-danger">Delete</button> </td>`;
                    html += `</tr>`;
                })
                $("#tbody").html(html);
                $('#pagination-links').empty().append(data.pager);
            }
        }


        // Get Publisher 
        function getPublisher(pager) {
            $.ajax({
                url: "<?= base_url('admin/publishers/get') ?>",
                type: "GET",
                data: {
                    page: pager
                },
                success: function(data) {
                    loadData(data)
                }
            })
        }
        getPublisher(1);


        // Publisher pagination
        $('#pagination-links').on('click', 'a', function(e) {
            e.preventDefault();
            let pageNumber = $(this).attr('href').split('page=')[1];
            loadData(pageNumber);
        });


        // Add Publisher
        $("#addBtn").click(function() {
            let publisherId = $("#publisher_id").val();
            let name = $("#name").val();
            let address = $("#address").val();
            let phone = $("#phone").val();

            $.ajax({
                url: "<?= base_url('admin/publishers/create') ?>",
                type: "POST",
                data: {
                    publ_id: publisherId,
                    name: name,
                    address: address,
                    phone: phone
                },
                success: function(data) {
                    if (data.status) {
                        Swal.fire(
                            'Good job!',
                            data.message,
                            'success'
                        ).then(() => {
                            getPublisher(1);
                            clearform();
                        })

                    } else {
                        alert(data.message);
                    }
                }
            });

        })


        //Edit Publisher 
        $("#tbody").on("click", "#editBtn", function() {
            $id = $(this).data("id");
            $name = $(this).parent().parent().find("#publisher_name").html();
            $address = $(this).parent().parent().find("#publisher_address").html();
            $phone = $(this).parent().parent().find("#publisher_phone").html();

            $("#publisher_id").val($id);
            $("#name").val($name);
            $("#address").val($address);
            $("#phone").val($phone);
            $("#addBtn").val("Update");
            $("#admin_form").show(400);
            let icon = $("#icon");
            icon.toggleClass('fa-plus fa-minus');

        })

        // Delete Publisher
        $("#tbody").on("click", "#deleteBtn", function() {
            $id = $(this).data("id");
            Swal.fire({
                title: 'Do you want to delete??',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Delete',
                denyButtonText: `Don't delete`,
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url("admin/publishers/delete") ?>",
                        type: "POST",
                        data: {
                            id: $id
                        },
                        success: function(data) {
                            if (data.status) {
                                Swal.fire(
                                    'Good job!',
                                    data.message,
                                    'success'
                                ).then(() => {
                                    getPublisher(1);
                                })
                            }
                        }
                    })
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })

        })


        // Search Publishers
        $("#searchBtn").click(function() {
            $text = $("#search").val();
            $.ajax({
                url: "<?= base_url('admin/publishers/search') ?>",
                type: "GET",
                data: {
                    text: $text
                },
                success: function(data) {
                    loadData(data);
                }
            });

        })


        // Search Autocomplete
        $('#search').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?= base_url('admin/publishers/autocomplete'); ?>",
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


        // Refresh 
        $("#refresh").click(function() {
            var isFormVisible = $('#admin_form').is(":visible");
            if (isFormVisible) {
                clearform();
            }
            $("#search").val("");
            getPublisher(1);
        })


    });
</script>
<?= $this->endSection() ?>