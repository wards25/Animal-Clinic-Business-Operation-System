<!DOCTYPE html>
<html lang="en">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- cdn for sweetAlert -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css">
  <title>AnimalClinic</title>
  <link rel="stylesheet" href="../styles/theme.css">
  <link rel="stylesheet" href="https://unpkg.com/simplebar/dist/simplebar.min.css">

</head>
<style>
  .container-logo .logo {
    height: 50px;
  }

  .container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 30px;
  }
</style>

<body class="bg-light">

  <?php
  session_start();
  include("../connection.php");
  if (!isset($_SESSION['username'])) {
    header("location: ../login.php");
  } else {
    $userid = $_SESSION['userid'];
    $username = $_SESSION['username'];
  }
  ?>
  <main id="main-wrapper" class="main-wrapper">

    <div class="header">
      <!-- navbar -->
      <div class="navbar-custom navbar navbar-expand-lg">
        <div class="container-fluid px-0">
          <div class="container-logo">
            <?php
            if (isset($image)) {
              echo '<img id="selectedImage" src="data:image/jpg;charset=utf8;base64,' . base64_encode($image) . '" />';
            } else {
              echo '<img id="selectedImage" src="../img/pngwing.com.png" style="height:40px;" />';
            }
            ?>
            <!-- Echo the username beside the profile image -->
            <strong class="username"><?php echo $username; ?></strong>
          </div>
          <a href="log_out.php" type="button" class="btn btn-outline-danger" style="margin-left: 10px;">Log Out</a>
        </div>
      </div>
    </div>

    <!-- navbar vertical -->
    <div class="app-menu">
      <!-- Sidebar -->

      <div class="navbar-vertical navbar nav-dashboard">
        <div class="h-100" data-simplebar="init">
          <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-height-auto-observer-wrapper">
              <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
              <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                  <div class="simplebar-content" style="padding: 0px;">
                    <div class="container">
                      <img class="logo" src="../img/logo.png" alt="" style="background-color: #CDD5FF; height:100px; border-radius:50%;"><br>
                    </div>
                    <h4 style="text-align: center;">Business Operation System</h4>
                    <hr style="margin-left: 20px; margin-right:20px;">
                    <ul class="navbar-nav flex-column" id="sideNavbar">
                      <li class="nav-item">
                        <a class="nav-link has-arrow " href="dashboard.php">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home nav-icon me-2 icon-xxs">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                          </svg>
                          Dashboard
                        </a>
                      </li>


                      <!-- Nav item -->
                      <li class="nav-item">
                        <a class="nav-link has-arrow " href="calendar.php">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar nav-icon me-2 icon-xxs">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                          </svg> Calendar
                        </a>
                      </li>
                      <!-- Nav item -->
                      <li class="nav-item">
                        <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navinvoice" aria-expanded="false" aria-controls="navinvoice">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard nav-icon me-2 icon-xxs">
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                          </svg> Appointments
                        </a>

                        <div id="navinvoice" class="collapse " data-bs-parent="#sideNavbar">
                          <ul class="nav flex-column">
                            <li class="nav-item">
                              <a class="nav-link has-arrow " href="approvedAppointments.php">
                                Appointment List
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link has-arrow " href="appointmentHistory.php">
                                Appointment History
                              </a>
                            </li>
                          </ul>
                        </div>
                      </li>
                      <!-- Nav item -->
                      <li class="nav-item">
                        <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navrecords" aria-expanded="false" aria-controls="navinvoice">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart nav-icon me-2 icon-xxs">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                          </svg> Products
                        </a>

                        <div id="navrecords" class="collapse " data-bs-parent="#sideNavbar">
                          <ul class="nav flex-column">
                            <li class="nav-item">
                              <a class="nav-link has-arrow " href="inventory.php">
                                Inventory
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link has-arrow " href="order.php">
                                Orders
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link has-arrow " href="transaction.php">
                                Transaction
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link has-arrow " href="orderHistory.php">
                                Order History
                              </a>
                            </li>
                          </ul>
                        </div>
                      </li>
                      <!-- Nav item -->
                      <li class="nav-item">
                        <a class="nav-link   collapsed  " href="accounts.php" aria-controls="navprofilePages">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user nav-icon me-2 icon-xxs">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                          </svg> Users
                        </a>
                      </li>
                      <!-- Nav item -->
                      <li class="nav-item">
                        <a class="nav-link has-arrow  collapsed " href="pets.php">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paw nav-icon me-2 icon-xxs">
                            <path d="M2 9C2 4 4 2 8 2s8 2 8 7c0 4.1-2.2 7-3 7s-3-1.5-4-1.5S8 16 8 16s-1.7 0-2.5.5S3 15 2 13V9z"></path>
                            <circle cx="8.5" cy="10.5" r="1.5"></circle>
                            <circle cx="15.5" cy="10.5" r="1.5"></circle>
                            <path d="M4 14.5s1.5 1 4 1 4-1 4-1"></path>
                            <path d="M1 20a15.9 15.9 0 0 0 11 0"></path>
                          </svg> Pets
                        </a>
                      </li>
                      <!-- Nav item -->
                      <li class="nav-item ">
                        <a class="nav-link  " href="audittrail.php">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file nav-icon me-2 icon-xxs">
                            <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                            <polyline points="13 2 13 9 20 9"></polyline>
                          </svg> Audit Trail
                        </a>
                      </li>
                      <!-- Nav item -->
                      <li class="nav-item">
                        <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navCRM" aria-expanded="false" aria-controls="navCRM">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pie-chart nav-icon me-2 icon-xxs">
                            <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
                            <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                          </svg>
                          Reports
                        </a>

                        <div id="navCRM" class="collapse " data-bs-parent="#sideNavbar">
                          <ul class="nav flex-column">


                            <li class="nav-item">
                              <a class="nav-link has-arrow " href="./reports/userReports.php">
                                User Reports
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link has-arrow " href="./reports/petReports.php">
                                pet Reports
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link has-arrow " href="./reports/appointmentReports.php">
                                appointment Reports
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link has-arrow " href="./reports/productReports.php">
                                product Reports
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link has-arrow " href="./reports/orderReports.php">
                                order Reports
                              </a>
                            </li>
                          </ul>
                        </div>
                      </li>
                      <!-- Nav item -->
                      <li class="nav-item">
                        <a class="nav-link has-arrow " href="chatroom.php">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square nav-icon me-2 icon-xxs">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                          </svg> Chat
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link has-arrow " href="log_out.php">
                          <i class="fa-solid fa-arrow-right-from-bracket"></i> logout
                        </a>
                      </li>
                  </div>
                </div>
              </div>
            </div>
            <div class="simplebar-placeholder" style="width: auto; height: 1531px;"></div>
          </div>
          <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
          </div>
          <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
            <div class="simplebar-scrollbar" style="height: 315px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
          </div>
        </div>
      </div>
    </div>


    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      if ($_FILES['image']['error'] != UPLOAD_ERR_OK) {
        echo '<script> alert("Error uploading file. Please try again"); window.location.href = "inventory.php";</script>';
      } else {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['image']['type'], $allowedTypes)) {
          echo '<script>alert("Please upload a JPEG, PNG, or GIF."); window.location.href = "inventory.php";</script>';
        } else {
          $maxFileSize = 5 * 1024 * 1024;
          if ($_FILES['image']['size'] > $maxFileSize) {
            echo "File size exceeds 5MB. Please upload a smaller file.";
          } else {
            $imageData = file_get_contents($_FILES['image']['tmp_name']);

            $name = $_POST['name'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $expiration = $_POST['expiration'];
            $description = $_POST['description'];
            $category = $_POST['category'];


            $stmt = $con->prepare("INSERT INTO producttb(name, category, quantity, price, expiration, description, imageData) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssiisss", $name, $category, $quantity, $price, $expiration, $description, $imageData);

            // for audit trail
            $usertype = $_SESSION['usertype'];
            $auditSql = mysqli_query($con, "INSERT INTO audittrailtb (username, userid, usertype, actionmode) VALUES ('$username', '$userid', '$usertype', 'Insert a prooduct to Inventory')");

            // Execute the statement
            if ($stmt->execute()) {
              echo '<script>alert("Product Added Successfullly."); window.location.href = "inventory.php";</script>';
            } else {
              echo '<script>alert("Failed to add pet: ' . $stmt->error . '"); window.location.href = "inventory.php";</script>';
            }

            // Close the statement
            $stmt->close();
          }
        }
      }
    }

    ?>
    <div id="app-content">
      <!-- Container fluid -->
      <div class="app-content-area">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
              <!-- Page header -->
              <div class="mb-5">
                <h3 class="mb-0">Products</h3>
              </div>
            </div>
          </div>

          <div>
            <!-- row -->
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header d-md-flex border-bottom-0">
                    <div class="flex-grow-1">
                      <a href="#!" class="btn btn-primary" style="margin-top: 25px;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">+ Add Product</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="productTable" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>Product Code</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Critical level</th>
                            <th>Price</th>
                            <th>Expiration</th>
                            <th>Image</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php

                          // Fetch product data
                          $sql = "SELECT * FROM producttb";
                          $result = $con->query($sql);

                          // Output data rows
                          if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                              $quantity = $row['quantity'];
                              $criticalLevel = '';

                              // Determine critical level based on quantity
                              if ($quantity >= 11) {
                                $criticalLevel = '<span class="badge badge-success-soft">High stock</span>';
                              } elseif ($quantity <= 10) {
                                $criticalLevel = '<span class="badge badge-warning-soft">Low Stock</span>';
                              }

                              echo "<tr>
            <td>{$row['productcode']}</td>
            <td>{$row['name']}</td>
            <td>{$row['category']}</td>
            <td>{$row['description']}</td>
            <td>{$quantity}</td>
            <td>{$criticalLevel}</td>
            <td>{$row['price']}</td>
            <td>{$row['expiration']}</td>
            <td><img src='data:image/jpeg;base64," . base64_encode($row['imageData']) . "' alt='Product Image' style='max-width:50px;max-height:50px;'></td>
            <td><button class='btn btn-primary' data-toggle='modal' data-target='#addStockModal{$row['productcode']}'>Add stock</button></td>
        </tr>";

                              // Add modal for adding stock as before
                              echo "<div class='modal fade' id='addStockModal{$row['productcode']}' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Add Stock for {$row['name']}</h5>
                        <button type='button' class='btn-close' data-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <form class='addStockForm' data-product-code='{$row['productcode']}'>
                            <div class='form-group'>
                                <label for='quantity'>Quantity:</label>
                                <input type='number' class='form-control' id='quantity_{$row['productcode']}' name='quantity'>
                            </div>
                            <button type='submit' class='btn btn-primary'>Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>";
                            }
                          } else {
                            echo "<tr><td colspan='10'>No products found</td></tr>";
                          }

                          // Close connection
                          $con->close();
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal -->
            <form method="post" enctype="multipart/form-data">
              <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Products</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="image-container" style=" display:flex; justify-content:center; ">
                        <div class="image-container-inner" style="background-color:white; height:150px; border-radius: 20px; width:200px; margin-bottom:10px; ">
                          <img id="selectedImage" style="height: 150px; width: 200px; border-radius:20px; object-fit: cover; border-style:solid;">
                        </div>
                      </div>
                      <div class="input-group mb-3">
                        <input class="form-control" id="fileInput" type="file" onchange="displayImage()" name="image" accept="image/*">
                      </div>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="name of product" name="proudctname" required>
                      </div>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="category" name="category" required>
                      </div>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="quantity" name="quantity" required>
                      </div>
                      <div class="input-group mb-3">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control" placeholder="price" name="price" required>
                      </div>
                      <div class="input-group mb-3">
                        <span class="input-group-text">expiration</span>
                        <input type="date" class="form-control" placeholder="expiration" name="expiration" required>
                      </div>
                      <div class="input-group">
                        <span class="input-group-text">description</span>
                        <textarea class="form-control" aria-label="With textarea" name="description" required></textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success" name="submit">Add Product</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/simplebar/dist/simplebar.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<!-- sweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
<script>
  $(document).ready(function() {
    $('#productTable').DataTable();
  });
</script>
<script>
  function displayImage() {
    var fileInput = document.getElementById('fileInput');
    var selectedImage = document.getElementById('selectedImage');

    // Check if a file is selected
    if (fileInput.files && fileInput.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        // Set the source of the image to the data URL
        selectedImage.src = e.target.result;
      };

      // Read the selected file as a data URL
      reader.readAsDataURL(fileInput.files[0]);
    }
  }
</script>

<script>
  $(document).ready(function() {
    // Handle form submission for each product
    $('.addStockForm').submit(function(event) {
      event.preventDefault(); // Prevent default form submission

      // Get product code and quantity value
      var productCode = $(this).data('product-code');
      var quantity = $('#quantity_' + productCode).val();

      // Display confirmation dialog
      Swal.fire({
        title: 'Confirm',
        text: 'Are you sure you want to update the quantity?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Save',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          // User clicked Save, perform AJAX request to update quantity
          $.ajax({
            url: 'update_quantity.php',
            method: 'POST',
            data: {
              productCode: productCode,
              quantity: quantity
            },
            success: function(response) {
              // Handle success (e.g., show success message)
              Swal.fire('Success', 'Stock added successfully for product code ' + productCode, 'success').then(() => {
                // Redirect to a new page after successful update
                window.location.href = 'inventory.php';
              });
            },
            error: function(xhr, status, error) {
              // Handle error (e.g., show error message)
              Swal.fire('Error', 'Error adding stock: ' + error, 'error');
            }
          });
        }
      });
    });
  });
</script>

</html>