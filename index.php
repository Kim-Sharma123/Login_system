<?php
include 'db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Template</title>
    <!--== META TAGS ==-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600|Quicksand:300,400,500" rel="stylesheet">

    <!-- FONT-AWESOME ICON CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!--== ALL CSS FILES ==-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mob.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- <link rel="stylesheet" href="css/materialize.css" /> -->
    
    <style>
        @media screen and (max-width: 767px) {
            .table-responsive {
                /* border: 1px solid #ddd; */
                -webkit-overflow-scrolling: touch;
            }

            .table thead {
                display: none; /* Hide the table headers on small screens */
            }

            .table tr{
                display: block;
                margin-bottom: 30px;
            }

            .table td {
                display: block; /* Make each cell a block element */
                width: 100%;
                text-align: left;
                padding-left: 50%;
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
        }

    </style>

</head>

<body>
        

    <!--== BODY CONTNAINER ==-->
    <div class="container-fluid sb2">
        <div class="row">
            <div class="sb2-1">
                <!--== USER INFO ==-->
                <div class="sb2-12">
                    <ul>
                        <li><img src="images/placeholder.jpg" alt="">
                        </li>
                        <li>
                            <h5>Victoria Baker <span> Santa Ana, CA</span></h5>
                        </li>
                        <li></li>
                    </ul>
                </div>
                <!--== LEFT MENU ==-->
                <div class="sb2-13">
                    <ul class="" data-collapsible="accordion">
                        <li><a href="index.php" class="menu-active"><i class="fa fa-bar-chart" aria-hidden="true"></i> Dashboard</a>
                        </li>
                        <li><a href="add_user.php" class="menu"><i class="fa fa-bar-chart" aria-hidden="true"></i> Add User</a>
                        </li>
                        <li><a href="edit_user.php" class="menu"><i class="fa fa-bar-chart" aria-hidden="true"></i> Edit User</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!--== BODY INNER CONTAINER ==-->
            <div class="sb2-2">
                <!--== breadcrumbs ==-->
                <div class="sb2-2-2">
                    <ul>
                        <li><a href="index-2.html"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                        </li>
                        <li class="active-bre"><a href="#"> Dashboard</a>
                        </li>
                    </ul>
                </div>
                <!--== DASHBOARD INFO ==-->
                
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 main">
                    <h2 class="mb-5">User Management</h2>
        
                        <!-- User Table -->
                        <table class="table table-striped table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <th>S. No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th>City</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        </div>
        
                        <!-- Add User Modal -->
                        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <form id="addUserForm">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label> 
                                        <input type="text" class="form-control" id="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="mobile" class="form-label">Mobile Number</label> 
                                        <input type="text" class="form-control" id="mobile" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control" id="city" required>
                                    </div>
                                    <button type="button" class="btn btn-primary" onclick="addUser()">Save</button>
                                </form>
        
                                </div>
                            </div>
                        </div>
                    </main>
            </div>

        </div>
    </div>

    <!--======== SCRIPT FILES =========-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
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
            var name = $('#name_' + id).val();
            var role = $('#role_' + id).val();
            var status = $('#status_' + id).val();

            $.ajax({
                url: 'edit_user.php',
                type: 'POST',
                data: {
                    id: id,
                    name: name,
                    role: role,
                    status: status
                },
                success: function(response) {
                    alert(response);
                    loadUsers(); // Reload user list
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
                url: 'fetch_users.php',
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
</body>

</html>