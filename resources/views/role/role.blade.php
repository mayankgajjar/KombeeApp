@extends('layouts.user')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            Role
            <a calass="btn btn-info" href="{{ route('AddRole') }}">Add</a>
        </div>

        <div class="panel-body">
            <table id="roleTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dynamic rows will be appended here -->
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    var siteUrl = "<?= getenv("APP_URL") ?>"
    var token = "<?= session('token') ?>"

    $(document).ready(function() {
        userList();
    });

    function userList() {
        fetch(siteUrl + 'api/admin/roles', {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token, // Bearer token in header
                    'Accept': 'application/json', // Accept JSON response
                }
            })
            .then(response => response.json()) // Parse the response as JSON
            .then(res => {
                if (res.success) {
                    populateTable(res.data);
                } else {
                    console.error("Failed to fetch user data");
                }
            })
            .catch(error => {
                console.error('Error:', error); // Handle error response
            });
    }

    function populateTable(data) {
        const tableBody = document.querySelector("#roleTable tbody");

        data.forEach(role => {
            const row = document.createElement("tr");
            row.setAttribute("data-id", role.id);
            row.innerHTML = `
                <td>${role.id}</td>
                <td>${role.name}</td>
                <td>
                    <a href="/EditRole/${role.id}">Edit</a> |
                    <a href="/RolePermission/${role.id}">Permission</a> |
                    <span 
                        style="cursor: pointer; color: red;" 
                        onclick="confirmDelete(${role.id})">
                        Delete
                    </span>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    function confirmDelete(Id) {
        const isConfirmed = confirm("Are you sure you want to delete this?");
        if (isConfirmed) {
            deleteUser(Id);
        }
    }


    function deleteUser(Id) {
        const url = `${siteUrl}api/admin/roles/${Id}`;

        fetch(url, {
            method: "DELETE",
            headers: {
                'Authorization': 'Bearer ' + token,
                "Content-Type": "application/json",
            },
        })
            .then(response => response.json()) // Convert response to JSON
            .then(data => {
                if (data.success) { // Assuming API returns { success: true } on success
                    alert("Role deleted successfully.");
                    // Remove the corresponding row from the table
                    const rowToRemove = document.querySelector(`#roleTable tr[data-id="${Id}"]`);
                    if (rowToRemove) rowToRemove.remove();
                } else {
                    alert(data.message || "Failed to delete the role.");
                }
            })
            .catch(error => {
                console.error("Error deleting role:", error);
                alert("An error occurred. Please try again.");
            });
    }
</script>
@endsection