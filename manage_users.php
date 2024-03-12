<?php 

require 'connection.php';

session_start();

// Check if the user is not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}

// Pagination variables
$limit = 5; // Number of records to show per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page
$start = ($page - 1) * $limit; // Starting row number

$search = '';

// Handle search term
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

// Query to fetch total number of users
$totalQuery = "SELECT count(id) as total FROM mss_users WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR email LIKE '%$search%' OR username LIKE '%$search%'";
$totalResult = $conn->query($totalQuery);
$totalData = $totalResult->fetch_assoc();
$total = $totalData['total'];

// Calculate total pages
$pages = ceil($total / $limit);

// Query to fetch users for the current page
$sql = "SELECT * FROM mss_users WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR email LIKE '%$search%' OR username LIKE '%$search%' LIMIT $start, $limit";
$result = $conn->query($sql);

// Starting number for the row count
$rowNum = ($page - 1) * $limit + 1;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Lifesaver</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style2.css" />
    <link rel="stylesheet" href="css/style3.css" />

    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"/>

    <!-- <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> -->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>


</head>
<body>
    <div class="wrapper">
    <?php require 'sidebar.php' ?>
        <div class="main">
        <?php require 'navbar.php'; ?>
            <main class="content px-3 py-2">
                <div class="container-fluid mt-3">
                     <h4 class="mb-4">Manage Users</h4>
                     <div class="d-flex justify-content-end mb-3">
                        <form action="" method="get" class="input-group w-50">
                                <input type="text" class="form-control" placeholder="Search..." name="search" value="<?php echo $search; ?>">
                                <button type="submit" class="btn btn-outline-secondary">Search</button>
                        </form>
                        <a  href="users.php" class="btn btn-primary add-user-btn"><i class="fa-solid fa-plus m-1"></i>Add User</a>
                     </div>
                <table class="table table-striped table-hover table-bordered table-m">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email Address</th>
                            <th>Username</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        // Display users in the table
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $rowNum++ . "</td>";
                                echo "<td>" . $row["first_name"] . "</td>";
                                echo "<td>" . $row["last_name"] . "</td>";
                                echo "<td>" . $row["email"] . "</td>";
                                echo "<td>" . $row["username"] . "</td>";
                                echo '<td>
                                        <a href="#" class="btn btn-sm btn-primary edit-btn" data-id="' . $row["id"] . '"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="#" class="btn btn-sm btn-danger delete-btn" data-id="' . $row["id"] . '"><i class="fa-solid fa-trash-can"></i></a>
                                      </td>';
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No users found</td></tr>";
                        }
                        $conn->close();
                    ?>
                    </tbody>
                </table>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-end">
                        <?php for($i = 1; $i <= $pages; $i++) : ?>
                            <li class="page-item <?php if($page == $i) echo 'active'; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </main>
       
        </div>

    </div>

    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>

    <!-- Edit User Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm">
                <div class="modal-body">
                    <input type="hidden" name="editUserId" id="editUserId">
                    <div class="mb-3" >
                        <input type="text" class="form-control" id="editFirstName" name="editFirstName" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="editLastName" name="editLastName" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="editUsername" name="editUsername" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="editPassword" name="editPassword">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" id="editEmail" name="editEmail" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="editContactNumber" name="editContactNumber" required>
                    </div>
                    <!-- Error messages -->
                    <div id="editErrorMessages"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
        $('.delete-btn').click(function (e) {
            e.preventDefault();
            var userId = $(this).data('id');
            deleteUser(userId);
        });

        $('.edit-btn').click(function (e) {
            e.preventDefault();
            var userId = $(this).data('id');
            editUser(userId);
        });
    });

    function deleteUser(id) {
        if (confirm("Are you sure you want to delete this user?")) {
            $.ajax({
                url: 'delete_user.php',
                type: 'POST',
                data: {id: id},
                success: function (response) {
                    alert(response);
                    location.reload();
                },
                error: function (xhr, status, error) {
                    alert("An error occurred while deleting the user.");
                    console.log(xhr.responseText);
                }
            });
        }
    }

    function editUser(id) {
        $('#editForm input[type="text"]').prop('disabled', true);
        $('#editModal').modal('show');
        $('#editUserId').val(id);

        // Clear previous error messages
        $('#editErrorMessages').html('');

        // Fetch user data
        $.ajax({
            url: 'fetch_user.php',
            type: 'GET',
            data: {id: id},
            success: function (response) {
                var user = JSON.parse(response);
                $('#editFirstName').val(user.first_name);
                $('#editLastName').val(user.last_name);
                $('#editUsername').val(user.username);
                $('#editEmail').val(user.email);
                $('#editContactNumber').val(user.contact_number);
                $('#editUserId').val(user.id);
            },
            error: function (xhr, status, error) {
                alert("An error occurred while fetching user data.");
                console.log(xhr.responseText);
            }
        });

        // Enable form fields after fetching data
        $('#editForm input[type="text"]').prop('disabled', false);

        // Submit form
        $('#editForm').submit(function (e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: 'update_user.php',
                type: 'POST',
                data: formData,
                success: function (response) {
                    alert(response);
                    $('#editModal').modal('hide');
                    location.reload();
                },
                error: function (xhr, status, error) {
                    alert("An error occurred while updating user data.");
                    console.log(xhr.responseText);
                }
            });
        });
    }
</script>

</body>
</html>