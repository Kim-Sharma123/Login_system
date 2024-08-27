<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
          .sidebar {
            min-height: 100vh;
            background-color: #fff;
        }
        .main{
            margin-top: 50px;
        }
        .sidebar .nav-link {
            color: #000;
        }
        .sidebar .nav-link.active {
            background-color: #007bff;
            color: #fff;
        }
        .profile {
            text-align: center;
            padding: 20px;
        }
        .profile img {
            width: 80px;
            border-radius: 50%;
        }
        .profile h6 {
            margin-top: 10px;
            color: #000;
        }
        .breadcrumb {
            background-color: transparent;
            margin-bottom: 0;
        }
        .content-wrapper {
            padding: 20px;
        }
        .table-responsive {
            margin-top: 20px;
        }
        .table{
            width: 100%;
            overflow-x: hidden;
        }
        @media screen and (max-width: 767px) {
            .table-responsive {
                /* border: 1px solid #ddd; */
                -webkit-overflow-scrolling: touch;
            }

            .table thead {
                display: none; /* Hide the table headers on small screens */
            }

            .table tr{
                border: 1px solid #ddd;
                display: block;
                margin-bottom: 30px;
            }

            .table td {
                display: block; /* Make each cell a block element */
                width: 100%;
                text-align: left;
                /* padding-left: 50%; */
                position: relative;
                border: none; /* Hide the table cell borders */
            }

            .table td::before {
                content: attr(data-label); 
                position: absolute;
                left: 15px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: bold;
            }
            .main{
                margin-top: 0px;
            }
        }

    </style>
</head>
<body>
<div class="container-fluid sb2">
    <div class="row">
    <div class="col-md-3 sidebar">
            <div class="profile">
                <img src="images/placeholder.jpg" alt="Profile Picture">
                <h6>Victoria Baker</h6>
                <p>Santa Ana, CA</p>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link" href="index.php">Dashboard</a>
                <a class="nav-link" href="add_user.php">Add User</a>
                <a class="nav-link active" href="edit_user.php">Edit User</a>
            </nav>
        </div>
            <main role="main" class="col-md-9 main">
            <h2>User Management</h2>
            <table class="table" id="userTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                
                </tbody>
            </table>
            </div>
    </div>
</div>

<!-- Modal for Editing User -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                    <input type="hidden" id="editUserId">
                    <div class="form-group">
                        <label for="editName">Name</label>
                        <input type="text" class="form-control" id="editName">
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email</label>
                        <input type="email" class="form-control" id="editEmail">
                    </div>
                    <div class="form-group">
                        <label for="editPhone">Phone</label>
                        <input type="text" class="form-control" id="editPhone">
                    </div>
                    <div class="form-group">
                        <label for="editCity">City</label>
                        <input type="text" class="form-control" id="editCity">
                    </div>
                    <button type="button" class="btn btn-primary" id="updateUserBtn">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>
        function addUser() {
            var name = $('#name').val();
            var email = $('#email').val();
            var mobile = $('#mobile').val();
            var city = $('#city').val();

            $.ajax({
                url: 'add_user.php',
                type: 'POST',
                data: {
                    name: name,
                    email: email,
                    mobile: mobile,
                    city: city
                },
                success: function(response) {
                    alert(response);
                    loadUsers(); 
                }
            });
        }

        // Edit User
        function editUser(id) {
            $.ajax({
                url: 'edit_user_1.php',
                type: 'POST',
                data: { id: id },
                dataType: 'json', // Expect a JSON response
                success: function(response) {
                    if (response.error) {
                        alert(response.error); // Handle any errors from the server
                    } else {
                        // Populate the modal with the data from the server
                        $('#editUserId').val(response.id);
                        $('#editName').val(response.username);
                        $('#editEmail').val(response.email);
                        $('#editPhone').val(response.mobile);
                        $('#editCity').val(response.city);
                        $('#editUserModal').modal('show');
                    }
                },
                error: function(xhr, status, error) {
                    console.log("AJAX Error: " + status + error);
                }
            });
        }


        // Delete User
        function deleteUser(id) {
            if (confirm("Are you sure you want to delete this user?")) {
                $.ajax({
                    url: 'delete_user.php',
                    type: 'POST',
                    data: { id: id },
                    success: function(response) {
                        alert(response);
                        loadUsers(); // Reload user list
                    }
                });
            }
        }

        // Load Users
        function loadUsers() {
            $.ajax({
                url: 'fetch_user_1.php',
                type: 'GET',
                success: function(data) {
                    $('tbody').html(data);
                }
            });
        }

        $(document).ready(function() {
            loadUsers(); // Load users on page load
        });
    </script>

    <script>
        $(document).ready(function() {
    // Update button click event
    $('#updateUserBtn').on('click', function() {
        // Get values from the modal input fields
        var id = $('#editUserId').val();
        var name = $('#editName').val();
        var email = $('#editEmail').val();
        var phone = $('#editPhone').val();
        var city =$('#editCity').val();

        // Debug: Log the values being sent to the server
        console.log('ID: ' + id);
        console.log('Name: ' + name);
        console.log('Email: ' + email);
        console.log('Phone: ' + phone);

        // Send an AJAX request to update the user in the database
        $.ajax({
            url: 'update_user.php', // The PHP file to handle the update
            type: 'POST',
            data: {
                id: id,
                name: name,
                email: email,
                phone: phone,
                city: city
            },
            success: function(response) {
                console.log('Server Response: ' + response); // Debug: Log the server's response

                if (response.trim() === 'success') {
                    // If the update was successful, close the modal and reload the user table
                    $('#editUserModal').modal('hide');
                    loadUsers(); // Refresh the user list
                } else {
                    // Handle any errors
                    alert('Failed to update user: ' + response);
                }
            },
            error: function(xhr, status, error) {
                console.log("AJAX Error: " + status + " " + error);
            }
        });
    });
});

    </script>
</body>
</html>
