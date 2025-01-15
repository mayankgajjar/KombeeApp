@extends('layouts.user')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            Add User
        </div>

        <div class="panel-body">
            <input type="hidden" name="id" id="user_id" value="{{ $id }}" />
            <form class="form-horizontal" method="post" id="AddEditForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="role">Firstname:<spna class="required">*</spna></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter Firstname">
                        <span id="firstname_error" class="error" style="color:red;display:none;"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="role">Lastname:<spna class="required">*</spna></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Lastname">
                        <span id="lastname_error" class="error" style="color:red;display:none;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="role">Email:<spna class="required">*</spna></label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" <?= $id != 0 ? 'readonly' : '' ?>>
                        <span id="email_error" class="error" style="color:red;display:none;"></span>
                    </div>                    
                </div>
                @if($id == 0)
                <div class="form-group">
                    <label class="control-label col-sm-2" for="role">Password:<spna class="required">*</spna></label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                        <span id="password_error" class="error" style="color:red;display:none;"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="role">Confirm Password:<spna class="required">*</spna></label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter password">
                        <span id="confirm_password_error" class="error" style="color:red;display:none;"></span>
                    </div>
                </div>
                @endif
                <div class="form-group">
                    <label class="control-label col-sm-2" for="role">Contact Number:<spna class="required">*</spna></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Enter contact number">
                        <span id="contact_number_error" class="error" style="color:red;display:none;"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="role">Postcode:<spna class="required">*</spna></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Enter postcode">
                        <span id="postcode_error" class="error" style="color:red;display:none;"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="role">Gender: <spna class="required">*</spna></label>
                    <div class="col-sm-10">
                        <label class="radio-inline">
                            <input type="radio" name="gender" class="gender" value="male" <?= $id == 0 ? 'checked' : '' ?> >Male
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="gender" class="gender" value="female">Female
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="gender" class="gender" value="other">Other
                        </label>
                        <span id="gender_error" class="error" style="color:red;display:none;"></span>
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
                    <label class="control-label col-sm-2" for="role">Hobbies:</label>
                    <div class="col-sm-10">
                        <label class="checkbox-inline">
                            <input type="checkbox" class="hobbie" name="hobbie[]" id="Learning" value="Learning">Learning
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" class="hobbie" name="hobbie[]" id="Dance" value="Dance">Dance
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" class="hobbie" name="hobbie[]" id="Photography" value="Photography">Photography
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" class="hobbie" name="hobbie[]" id="Acting" value="Acting">Acting
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" class="hobbie" name="hobbie[]" id="Cycling" value="Cycling">Cycling
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" class="hobbie" name="hobbie[]" id="Cricket" value="Cricket">Cricket
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" class="hobbie" name="hobbie[]" id="Guitar" value="Guitar">Guitar
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" class="hobbie" name="hobbie[]" id="Chess" value="Chess">Chess
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" class="hobbie" name="hobbie[]" id="Football" value="Football">Football
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" class="hobbie" name="hobbie[]" id="Shopping" value="Shopping">Shopping
                        </label>
                        <span id="hobbie_error" class="error" style="color:red;display:none;"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="role">Role:</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="role" name="role[]">

                        </select>
                        <span id="role_error" class="error" style="color:red;display:none;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="role">Image:</label>
                    <div class="col-sm-10">
                        <input type='file' class="form-control" id="files" name='image[]' multiple>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">&nbsp;</div>
                    <div class="col-sm-10">
                        <div id="fileListContainer" style="display: flex; gap: 10px; flex-wrap: wrap;"></div>
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
    var id = $("#user_id").val();

    $(document).ready(function() {

        getStateList();
        getRoleList();

        $("#role").select2({
            placeholder: "Select roles",
            multiple: true,
            allowClear: true // Allow clearing of the selection
        });

        if (id != 0) {
            editUser(id);
        }

        $("#AddEditForm").validate({
            rules: {
                firstname: {
                    required: true,
                    minlength: 2,
                },
                lastname: {
                    required: true,
                    minlength: 2,
                },
                email: {
                    required: true,
                    email: true,
                },
                contact_number: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 15,
                },
                postcode: {
                    required: true,
                    digits: true,
                    minlength: 5,
                    maxlength: 6,
                },
                "files[]": {
                    extension: "jpg|jpeg|png|pdf|doc|docx",
                },
                "hobbie[]": {
                    required: true,
                    minlength: 1,
                },
                gender: {
                    required: true,
                },
                state_id: {
                    required: true,
                },
                city_id: {
                    required: true,
                },
                "role[]": {
                    required: true,
                },

            },
            messages: {
                firstname: {
                    required: "First name is required.",
                    minlength: "First name must be at least 2 characters long.",
                },
                lastname: {
                    required: "Last name is required.",
                    minlength: "Last name must be at least 2 characters long.",
                },
                email: {
                    required: "Email is required.",
                    email: "Please enter a valid email address.",
                },
                contact_number: {
                    required: "Contact number is required.",
                    digits: "Please enter only digits.",
                    minlength: "Contact number must be at least 10 digits long.",
                    maxlength: "Contact number must not exceed 15 digits.",
                },
                postcode: {
                    required: "Postcode is required.",
                    digits: "Please enter a valid postcode.",
                    minlength: "Postcode must be at least 5 characters.",
                    maxlength: "Postcode must not exceed 6 characters.",
                },
                "files[]": {
                    extension: "Only JPG, JPEG, PNG, PDF, DOC, or DOCX files are allowed.",
                },
                "hobbie[]": {
                    required: "Please select at least one hobby.",
                },
                gender: {
                    required: "Please select your gender.",
                },
                "role[]": {
                    required: "Please select at least one role.",
                },
                state_id: {
                    required: "Please select state",
                },
                city_id: {
                    required: "Please select city",
                },
            },
            submitHandler: function(form) {
                SaveUser();
            }
        });

        if (id == 0) {
            $("#password").rules("add", {
                required: true,
                minlength: 6,
                messages: {
                    required: "Password is required.",
                    minlength: "Password must be at least 6 characters long.",
                }
            });

            $("#confirm_password").rules("add", {
                required: true,
                equalTo: "#password",
                messages: {
                    required: "Please confirm your password.",
                    equalTo: "Passwords do not match.",
                }
            });
        } else {
            $("#password").rules("remove");
            $("#confirm_password").rules("remove");
        }

    })

    function getRoleList() {
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
                    const stateDropdown = document.getElementById("role"); // Get the dropdown element
                    stateDropdown.innerHTML = ""; // Clear existing options

                    // Add a default "Select State" option
                    const defaultOption = document.createElement("option");
                    defaultOption.value = "";
                    defaultOption.textContent = "Select Role";
                    stateDropdown.appendChild(defaultOption);

                    // Populate dropdown with states
                    res.data.forEach(state => {
                        const option = document.createElement("option");
                        option.value = state.id; // Assuming state.id is the unique identifier
                        option.textContent = state.name; // Assuming state.name contains the state name
                        stateDropdown.appendChild(option);
                    });
                } else {
                    console.error("Failed to fetch role data");
                }
            })
            .catch(error => {
                console.error('Error:', error); // Handle error response
            });
    }

    function getStateList() {
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

    function getCityList(id) {
        fetch(siteUrl + 'api/admin/getCityList/' + id, {
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

    function editUser(id) {
        fetch(siteUrl + 'api/admin/users/' + id, {
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
                    $(".panel-heading").html("Edit User");
                    setTimeout(function() {
                        $("#firstname").val(res.data.firstname)
                        $("#lastname").val(res.data.lastname)
                        $("#email").val(res.data.email)
                        $("#postcode").val(res.data.postcode)
                        $("#contact_number").val(res.data.contact_number)
                        $(`input[name="gender"][value="${res.data.gender}"]`).prop("checked", true);
                        $('#state_id option[value="' + res.data.state_id + '"]').attr("selected", "selected");
                        $('#city_id option[value="' + res.data.city_id + '"]').attr("selected", "selected");
                        
                        var hobbies = res.data.hobbie;
                        hobbies.forEach(row => {
                            $('#'+row.hobbie).prop('checked', true);
                        });

                        const selectedRole = [];
                        var role_array = res.data.role;
                        role_array.forEach(row => {
                            selectedRole.push(row.role_id);
                        });
                        $("#role").val(selectedRole).trigger("change");


                        var image_array = res.data.file;
                        const publicPath = siteUrl + 'images/';
                        image_array.forEach(file => {
                            const fileUrl = publicPath + file.file_name;
                            $('#fileListContainer').append(`
                            <div style="text-align: center;">
                                <img src="${fileUrl}" alt="${file.file_name}" style="width: 100px; height: 100px; object-fit: cover; border: 1px solid #ccc; padding: 5px;"/>
                                <p><span 
                    style="cursor: pointer; color: red;" onclick="DeleteImage(${file.id})">
                    Delete
                    </span></p>
                            </div>
                        `);
                        });

                    }, 1000)

                } else {
                    console.error("Failed to fetch users data");
                }
            })
            .catch(error => {
                console.error('Error:', error); // Handle error response
            });
    }

    function SaveUser() {
        const id = $("#user_id").val(); // Assuming there's an input to hold the user ID

        const url = id == 0 ?
            siteUrl + 'api/admin/users' :
            siteUrl + 'api/admin/UpdateUser/' + id;

        const method = id == 0 ? "POST" : "POST";

        const selectedHobbie = [];
        $(".hobbie:checked").each(function() {
            selectedHobbie.push($(this).val());
        });
        const selectedRoles = $("#role").val(); // Assuming a multi-select dropdown for roles

        const formData = new FormData();

        // Add regular form data
        formData.append('firstname', $("#firstname").val());
        formData.append('lastname', $("#lastname").val());
        formData.append('email', $("#email").val());
        if(id == 0){
            formData.append('password', $("#password").val());
        }
        formData.append('gender', $(".gender:checked").val());
        formData.append('postcode', $("#postcode").val());
        formData.append('state_id', $("#state_id").val());
        formData.append('contact_number', $("#contact_number").val());
        formData.append('city_id', $("#city_id").val());
        
        // Add arrays (hobbies and roles)
        selectedHobbie.forEach(hobbie => formData.append('hobbie[]', hobbie)); // Add hobbies as an array
        selectedRoles.forEach(role => formData.append('role[]', role)); // Add roles as an array

        const files = $("#files")[0].files;
        if(files.length > 0){
            for (let i = 0; i < files.length; i++) {
                formData.append('image[]', files[i]);
            }
        }
        
        fetch(url, {
                method: "POST",
                headers: {'Authorization': 'Bearer ' + token},
                body: formData,
            })
            .then(response => response.json())
            .then(res => {
                if (res.success) {
                    location.href = res.redirectUrl;
                } else {
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

    function DeleteImage(id){
        const isConfirmed = confirm("Are you sure you want to delete this?");
        if (isConfirmed) {
            deleteFile(id);
        }
    }

    function deleteFile(Id){
        const url = `${siteUrl}api/admin/DeleteImage/${Id}`;

        fetch(url, {
            method: "get",
            headers: {
                'Authorization': 'Bearer ' + token,
                "Content-Type": "application/json",
            },
        })
            .then(response => response.json()) // Convert response to JSON
            .then(data => {
                if (data.success) { // Assuming API returns { success: true } on success
                    alert("Image deleted successfully.");
                    location.reload();
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