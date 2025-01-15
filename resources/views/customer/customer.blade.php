@extends('layouts.user')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            Customer
            @if(in_array('add_customer',$permission))
                <a calass="btn btn-info" href="{{ route('AddCustomer') }}">Add</a>
            @endif
            
        </div>
        <div class="panel-body">
            <table id="customerTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>State</th>
                        <th>City</th>
                        @if(in_array('edit_customer',$permission))
                            <th>Edit</th>
                        @endif
                        @if(in_array('delete_customer',$permission))
                            <th>Delete</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <!-- Dynamic rows will be appended here -->
                </tbody>
            </table>

        </div>
    </div>
</div>
@php
    $edit_customer = in_array("edit_customer",$permission) ? true : false;
    $delete_customer = in_array("delete_customer",$permission) ? true : false;
@endphp
@endsection

@section('script')
<script>
    var siteUrl = "<?= getenv("APP_URL") ?>"
    var token = "<?= session('token') ?>"
    var delete_customer = "<?= $delete_customer ?>"
    var edit_customer = "<?= $edit_customer ?>"

    function userList() {
        fetch(siteUrl + 'api/admin/customer', {
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
        const tableBody = document.querySelector("#customerTable tbody");

        data.forEach(user => {
            const row = document.createElement("tr");
            row.setAttribute("data-id", user.id);
            row.innerHTML = `
                <td>${user.id}</td>
                <td>${user.name}</td>
                <td>${user.address}</td>
                <td>${user.contact_number}</td>
                <td>${user.state.name}</td>
                <td>${user.city.name}</td>`;

                if(edit_customer ){
                    row.innerHTML+= `<td><a href="/EditCustomer/${user.id}">Edit</a></td>`;
                }
                if(delete_customer){
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
        const url = `${siteUrl}api/admin/customer/${Id}`;

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
                    alert("Customer deleted successfully.");
                    // Remove the corresponding row from the table
                    const rowToRemove = document.querySelector(`#customerTable tr[data-id="${Id}"]`);
                    if (rowToRemove) rowToRemove.remove();
                } else {
                    alert(data.message || "Failed to delete the customer.");
                }
            })
            .catch(error => {
                console.error("Error deleting role:", error);
                alert("An error occurred. Please try again.");
            });
    }
</script>
@endsection