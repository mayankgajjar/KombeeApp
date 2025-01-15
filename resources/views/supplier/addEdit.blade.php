@extends('layouts.user')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            Add Supplier
        </div>

        <div class="panel-body">
            <input type="hidden" name="id" id="supplier_id" value="{{ $id }}" />
            <form class="form-horizontal" method="post" id="AddEditForm">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="role">Name:<spna class="required">*</spna></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter role name">
                        <span id="name_error" class="error" style="color:red;display:none;"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="role">Contact Number:<spna class="required">*</spna></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Enter contact number">
                        <span id="contact_number_error" class="error" style="color:red;display:none;"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="role">Address: <spna class="required">*</spna></label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="address" name="address"></textarea>
                        <span id="address_error" class="error" style="color:red;display:none;"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="role">State:<spna class="required">*</spna></label>
                    <div class="col-sm-10">
                        <select class="form-control" id="state_id" name="state_id" onchange="getCityList(this.value)">

                        </select>
                        <span id="state_id_error" class="error" style="color:red;display:none;"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="role">City:<spna class="required">*</spna></label>
                    <div class="col-sm-10">
                        <select class="form-control" id="city_id" name="city_id">
                            
                        </select>
                        <span id="city_id_error" class="error" style="color:red;display:none;"></span>
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
    var id = $("#supplier_id").val();

    $(document).ready(function() {
        getStateList();
        if (id != 0) {
            editSupplier(id);
        }

        $("#AddEditForm").validate({
            rules: {
                name: {
                    required: true
                },
                contact_number: {
                    required: true
                },
                address: {
                    required: true
                },
                state_id: {
                    required: true
                },
                city_id: {
                    required: true
                }

            },
            messages: {
                name: {
                    required: "Please enter role name",
                },
                contact_number: {
                    required: "Please enter contact_number",
                },
                address: {
                    required: "Please enter address",
                },
                state_id: {
                    required: "Please select state",
                },
                city_id: {
                    required: "Please select city",
                },
            },
            submitHandler: function(form) {
                SaveCustomer();
            }
        });

    })

    function getStateList(){
        fetch(siteUrl + 'api/admin/getStateList', {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token, // Bearer token in header
                'Accept': 'application/json', // Accept JSON response
            }
        })
        .then(response => response.json()) // Parse the response as JSON
        .then(res => {
            if (res.success) {
                const stateDropdown = document.getElementById("state_id"); // Get the dropdown element
                stateDropdown.innerHTML = ""; // Clear existing options

                // Add a default "Select State" option
                const defaultOption = document.createElement("option");
                defaultOption.value = "";
                defaultOption.textContent = "Select State";
                stateDropdown.appendChild(defaultOption);

                // Populate dropdown with states
                res.data.forEach(state => {
                    const option = document.createElement("option");
                    option.value = state.id; // Assuming state.id is the unique identifier
                    option.textContent = state.name; // Assuming state.name contains the state name
                    stateDropdown.appendChild(option);
                });
            } else {
                console.error("Failed to fetch state data");
            }
        })
        .catch(error => {
            console.error('Error:', error); // Handle error response
        });
    }

    function getCityList(id){
        fetch(siteUrl + 'api/admin/getCityList/'+id, {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token, // Bearer token in header
                'Accept': 'application/json', // Accept JSON response
            }
        })
        .then(response => response.json()) // Parse the response as JSON
        .then(res => {
            if (res.success) {
                const stateDropdown = document.getElementById("city_id"); // Get the dropdown element
                stateDropdown.innerHTML = ""; // Clear existing options

                // Add a default "Select State" option
                const defaultOption = document.createElement("option");
                defaultOption.value = "";
                defaultOption.textContent = "Select City";
                stateDropdown.appendChild(defaultOption);

                // Populate dropdown with states
                res.data.forEach(city => {
                    const option = document.createElement("option");
                    option.value = city.id; // Assuming state.id is the unique identifier
                    option.textContent = city.name; // Assuming state.name contains the state name
                    stateDropdown.appendChild(option);
                });
            } else {
                console.error("Failed to fetch city data");
            }
        })
        .catch(error => {
            console.error('Error:', error); // Handle error response
        });
    }

    function editSupplier(id) {
        fetch(siteUrl + 'api/admin/supplier/' + id, {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token, // Bearer token in header
                'Accept': 'application/json', // Accept JSON response
            }
        })
        .then(response => response.json()) // Parse the response as JSON
        .then(res => {
            if (res.success) {
                getCityList(res.data.state_id);
                $(".panel-heading").html("Edit Supplier");
                setTimeout(function () {
                    $("#name").val(res.data.name)
                    $("#contact_number").val(res.data.contact_number)
                    $("#address").val(res.data.address)
                    $('#state_id option[value="'+res.data.state_id+'"]').attr("selected", "selected");
                    $('#city_id option[value="'+res.data.city_id+'"]').attr("selected", "selected");
                },1000)
                
            } else {
                console.error("Failed to fetch supplier data");
            }
        })
        .catch(error => {
            console.error('Error:', error); // Handle error response
        });
    }

    function SaveCustomer() {

        if (id == 0) {
            var url = siteUrl + 'api/admin/supplier';
            var method = "POST";
        } else {
            var url = siteUrl + 'api/admin/supplier/'+id;
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
                contact_number: $("#contact_number").val(),
                address: $("#address").val(),
                state_id: $("#state_id").val(),
                city_id: $("#city_id").val()
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