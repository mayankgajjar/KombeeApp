@extends('layouts.user')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            Users
            @if(in_array('add_user',$permission))
                <a calass="btn btn-info" href="{{ route('AddUser') }}">Add</a>
            @endif
            <div style="float: right;">
                <a href="<?= route('exportPDF') ?>">Export PDF</a>
                <a href="<?= route('exportCsv') ?>">Export CSV</a>
                <a href="<?= route('exportExcel') ?>">Export Excel</a>
            </div>
        </div>
        <div class="panel-body">
            <table id="userTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Gender</th>
                        @if(in_array('edit_user',$permission))
                            <th>Edit</th>
                        @endif
                        @if(in_array('delete_user',$permission))
                            <th>Delete</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <!-- Dynamic rows will be appended here -->
                </tbody>
            </table>
            <div class="row">
                
            </div>
        </div>
    </div>
</div>
@php
    $edit_user = in_array("edit_user",$permission) ? true : false;
    $delete_user = in_array("delete_user",$permission) ? true : false;
@endphp
@endsection

@section('script')
<script>
    var edit_user = "<?= $edit_user ?>"
    var delete_user = "<?= $delete_user ?>"

    function userList() {
        fetch(siteUrl + 'api/admin/users', {
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
        const tableBody = document.querySelector("#userTable tbody");

        data.forEach(user => {
            const row = document.createElement("tr");
            row.setAttribute("data-id", user.id);
            row.innerHTML = `
                <td>${user.id}</td>
                <td>${user.firstname}</td>
                <td>${user.lastname}</td>
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>${user.contact_number}</td>
                <td>${user.gender}</td>`;
                if(edit_user ){
                    row.innerHTML+= `<td><a href="/EditUser/${user.id}">Edit</a></td>`;
                }
                if(delete_user){
                    row.innerHTML+= `<td><span 
                    style="cursor: pointer; color: red;" onclick="confirmDelete(${user.id})">
                    Delete
                    </span></td>`
                };

            tableBody.appendChild(row);
        });
    }


    $(document).ready(function() {
        userList();
    });

    function confirmDelete(Id) {
        const isConfirmed = confirm("Are you sure you want to delete this?");
        if (isConfirmed) {
            deleteUser(Id);
        }
    }


    function deleteUser(Id) {
        const url = `${siteUrl}api/admin/users/${Id}`;

        fetch(url, {
            method: "DELETE",
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
        })
            .then(response => response.json()) // Convert response to JSON
            .then(data => {
                if (data.success) { // Assuming API returns { success: true } on success
                    alert("User deleted successfully.");
                    // Remove the corresponding row from the table
                    const rowToRemove = document.querySelector(`#userTable tr[data-id="${Id}"]`);
                    if (rowToRemove) rowToRemove.remove();
                } else {
                    alert(data.message || "Failed to delete the user.");
                }
            })
            .catch(error => {
                console.error("Error deleting role:", error);
                alert("An error occurred. Please try again.");
            });
    }
</script>
@endsection