@extends('layouts.user')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            Permission
        </div>

        <div class="panel-body">
            <form class="form-horizontal" method="post" id="AddEditForm">
                <input type="hidden" name="id" id="role_id" value="{{ $id }}" />
                <div class="form-group">
                    <label class="control-label col-sm-2" for="role">Supplier:</label>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="permission" name="permission[]" id="show_supplier" value="show_supplier">Show Supplier
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="permission" name="permission[]" id="add_supplier" value="add_supplier">Add Supplier
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="permission" name="permission[]" id="edit_supplier" value="edit_supplier">Edit Supplier
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="permission" name="permission[]" id="delete_supplier" value="delete_supplier">Delete Supplier
                    </label>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="role">Customer:</label>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="permission" name="permission[]" id="show_customer" value="show_customer">Show Customer
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="permission" name="permission[]" id="add_customer" value="add_customer">Add Customer
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="permission" name="permission[]" id="edit_customer" value="edit_customer">Edit Customer
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="permission" name="permission[]" id="delete_customer" value="delete_customer">Delete Customer
                    </label>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-default" onclick="SavePermission()">Submit</button>
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
    var role_id = $("#role_id").val();

    $(document).ready(function() {
        ShowPermission(role_id);
    });
        
    function ShowPermission(role_id){
        fetch(siteUrl + 'api/admin/getRolePermission/' + role_id, {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token, // Bearer token in header
                'Accept': 'application/json', // Accept JSON response
            }
        })
        .then(response => response.json()) // Parse the response as JSON
        .then(res => {
            if (res.success) {
                var permission = res.data;
                permission.forEach(row => {
                    $('#'+row.permission).prop('checked', true);
                });
            } else {
                console.error("Failed to fetch role data");
            }
        })
        .catch(error => {
            console.error('Error:', error); // Handle error response
        });
    }

    function SavePermission() {
        var url = siteUrl + 'api/admin/SavePermission';
        var method = "POST";

        // Gather selected permissions
        const selectedPermissions = [];
        $(".permission:checked").each(function () {
            selectedPermissions.push($(this).val());
        });

        // Create the request payload
        const payload = {
            role_id: $("#role_id").val(), // Get role ID
            permission: selectedPermissions // Pass array of selected permissions
        };

        fetch(url, {
            method: method, // Changed from 'GET' to 'POST'
            headers: {
                'Authorization': 'Bearer ' + token, // Bearer token in header
                'Accept': 'application/json', // Accept JSON response
                'Content-Type': 'application/json', // Specify the content type
            },
            body: JSON.stringify(payload) // Stringify payload
        })
        .then(response => response.json()) 
        .then(res => {
            if (res.success) {
                location.href = res.redirectUrl;
            } else {
                console.error("Failed to create role:", res.message);
            }
        })
        .catch(error => {
            console.error('Error:', error); // Handle error response
        });
    }

</script>
@endsection