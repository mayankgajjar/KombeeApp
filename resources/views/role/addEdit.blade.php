@extends('layouts.user')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            Add Role
        </div>

        <div class="panel-body">
            <input type="hidden" name="id" id="role_id" value="{{ $id }}" />
            <form class="form-horizontal" method="post" id="AddEditForm">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="role">Role:<spna class="required">*</spna></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter role name">
                        <span id="name_error" class="error" style="color:red;display:none;"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    var siteUrl = "<?= getenv("APP_URL") ?>"
    var token = "<?= $token ?>"
    var id = $("#role_id").val();

    $(document).ready(function() {
        if (id != 0) {
            editRole(id);
        }
        $("#AddEditForm").validate({
            rules: {
                name: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "Please enter role name",
                },
            },
            submitHandler: function(form) {
                SaveRole();
            }
        });

    })

    function editRole(id) {
        fetch(siteUrl + 'api/admin/roles/' + id, {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token, // Bearer token in header
                    'Accept': 'application/json', // Accept JSON response
                }
            })
            .then(response => response.json()) // Parse the response as JSON
            .then(res => {
                if (res.success) {
                    $(".panel-heading").html("Edit Role");
                    $("#name").val(res.data.name)
                } else {
                    console.error("Failed to fetch role data");
                }
            })
            .catch(error => {
                console.error('Error:', error); // Handle error response
            });
    }

    function SaveRole() {
        if (id == 0) {
            var url = siteUrl + 'api/admin/roles';
            var method = "POST";
        } else {
            var url = siteUrl + 'api/admin/roles/'+id;
            var method = "PUT";
        }

        fetch(url, {
            method: method, // Changed from 'GET' to 'POST'
            headers: {
                'Authorization': 'Bearer ' + token, // Bearer token in header
                'Accept': 'application/json', // Accept JSON response
                'Content-Type': 'application/json', // Specify the content type
            },
            body: JSON.stringify({
                name: $("#name").val(),
            })
        })
        .then(response => response.json()) 
        .then(res => {
            if (res.success) {
                location.href = res.redirectUrl;
            } else {
                //console.error("Failed to create users:", res.message);
                if (res.errors) {
                    for (const [field, messages] of Object.entries(res.errors)) {
                        const errorMessage = messages.join(', '); // Combine messages if multiple
                        $(`#${field}_error`).text(errorMessage).show(); // Display error
                    }
                }
            }
        })
        .catch(error => {
            console.error('Error:', error); // Handle error response
        });
    }
</script>
@endsection