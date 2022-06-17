<?php 
include('connection.php');
session_start();
error_reporting(0);

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/images/users/logo.png" rel="icon">
    <title>Hotel Booking Database - Client</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="dist/css/client.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<style>
    body{
        font-family: lato;
    }
</style>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container-fluid container">
    <div class="isu-title">
        <img src="assets/images/users/building.gif" width="25" alt="homepage" class="light-logo" />
        <h5 class="notif-title">Hotel Booking Database</h5>  
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php 
                        $setId = $_SESSION['id'];
                        $query = "SELECT * FROM clients where id='$setId'";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) {

                    ?>
                    <li class="nav-item">
                        <a class="nav-link" id="color-c"  href=""  data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id'] ?>" >Profile</a>
                    </li>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update your account credentials</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                    <img src="<?php echo $row['image'] ?>" width="120" alt="">
                                    <br><br>
                                    <form action="functions.php" enctype="multipart/form-data" method="POST">
                                        <input type="hidden" name="ids" value="<?php echo $row['id'] ?>">
                                        <input type="file" name="client_profile" class="form-control" accept="image/png, image/jpeg"  required>
                                        <br>
                                        <button type="submit" class="btn btn-primary" name="change_client_profile">Change Profile Picture</button>
                                    </form>
                                    </div>
                                    <form action="functions.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                    <hr>
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['name'] ?>">
                                    <label for="">Phone</label>
                                    <input type="text" class="form-control" name="phone" value="<?php echo $row['phone'] ?>">
                                    <label for="">Gender</label>
                                    <input type="text" class="form-control" name="gender" value="<?php echo $row['gender'] ?>">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control" name="username" value="<?php echo $row['username'] ?>">
                                    <br>
                                    <div class="text-center">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal<?php echo $row['id'] ?>">Update Account</button>
                                    </div>
                                    <!-- Modal Confirmation-->
                                    <div class="modal fade" id="confirmModal<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update account of : <?php echo $row['name'] ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4>Are you sure you want to update your account?</h4>
                                                    <p>You will be automatically logout and kindly login your new account credentials</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                                                    <button type="submit" class="btn btn-success" name="updateAccount">Yes</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <form action="functions.php" method="POST">
                                        <h5>Change Password:</h5>
                                        <label for="">New Password</label>
                                        <input type="password" class="form-control" name="pass1" value="" required>
                                        <label for="">Retype Password</label>
                                        <input type="password" class="form-control" name="pass2" value="" required>
                                        <br>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmpassModal<?php echo $row['id'] ?>">Change Password</button>
                                            <br><br>
                                        </div>
                                     <!-- Modal Confirmation Password-->
                                    <div class="modal fade" id="confirmpassModal<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update password account of : <?php echo $row['name'] ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                                    <h4>Are you sure you want to create your new password?</h4>
                                                    <p>You will be automatically logout and kindly login your new account credentials</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                                                    <button type="submit" class="btn btn-success" name="updatepassAccount">Yes</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" id="color-c"  href="index.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div style="background-image: linear-gradient(rgba(0,0,0,.7), rgba(0,0,0,.7)), url(assets/images/bg-hotel.jpg); height: 600px; background-size: cover; ">
        <div class="container custom-container "  data-aos="zoom-in" data-aos-duration="1000" data-aos-once="true">
            <p class="custom-title"> Welcome, <?php echo $_SESSION['name']; ?> </p>
            <h4 class="title-custom">Hotel Booking Database</h4> <br>
            <p class="first-p">" Nothing makes you feel better than when you get into a hotel bed, and the sheets feel so good. <br> Why shouldn't you wake up like that every day? Spend money on your mattress and bedding because these things <br> make a difference on your sleep and, ultimately, your happiness "</p> 
            <br>
            <form action="">
              <a href="#contact" class="btn btn-warning " >Book Now</a>
          </form>
        </div>
    </div>
    <br><br>
    <div class="container contact-form " id="contact"  data-aos="zoom-in" data-aos-duration="1000" data-aos-once="true">
        <h3 class="custom-h3">Book Hotel Now</h3>
        <br>
        <div class="row">
            <div class="col-sm-4">
            <br>
            <p>For hotel inquiries you may use this:</p>
            <br>
            <div class="content">
                <i class="fas fa-map-marker-alt logo-font fa-lg"></i>
                <p> 6XRW+3W9, Salazar St, Downtown, Tacloban City, Leyte</p>
            </div>
            <div class="content">
                <i class="fas fa-phone-alt logo-font fa-lg"></i>
                <p> (053) 321 1084</p>
            </div>
            <div class="content">
                <i class="fas fa-envelope logo-font fa-lg"></i>
                <?php
                   $query = "SELECT * FROM admin where id=1";
                   $result = mysqli_query($conn, $query);
                   while ($row = mysqli_fetch_array($result)) {
                ?>
                <p><?php echo $row['email'] ?></p>
                <?php } ?>
            </div>
            </div>
        <div class="col-sm-8">
            <br>
            <br>
            <div class="container">
                <div class="row">
                    <?php 
                        $setId = $_SESSION['id'];
                        $query = "SELECT * FROM clients where id='$setId'";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) {

                    ?>
                    <div class="col-md-6">
                    <form action="functions.php" method="POST">
                        <input type="hidden" name="images" value="<?php echo $row['image'] ?>">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $row['name'] ?>" readonly />
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="email" name="phone" class="form-control" placeholder="Phone Number" value="<?php echo $row['phone'] ?>" readonly/>
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="text" name="stay" class="form-control" placeholder="Enter Stay Duration" value="" required/>
                        </div>
                        <br>
                        <br>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="rnum" class="form-control" placeholder="Enter Room Number" value=""  required/>
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="text" name="rcat" class="form-control" placeholder="Enter Room Category" value=""  required/>
                        </div>
                        <br>
                        
                        <div class="form-group">
                            <textarea name="txtMsg" class="form-control" placeholder="Leave us a Message" style="width: 100%; height: 150px;"></textarea>
                        </div>
                        <br><br>
                    </div>
                    <div class="form-group text-center">
                        <button type="button" class="btn btn-success w-50" data-bs-toggle="modal" data-bs-target="#concernModal<?php echo $row['id'] ?>">Submit Now</button>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>


       <!-- Modal Confirmation Concern-->
       <div class="modal fade" id="concernModal<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Book Submission</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <h4>Are you sure you want to book now?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-success" name="booking">Yes</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <?php }; ?>

    <br><br>

    <footer class="footer-07">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <h2 class="footer-heading"  data-aos="zoom-out" data-aos-duration="1000" data-aos-once="true">Hotel Booking Database</h2>
                    <p class="copyright">
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | by <a href="#">Hotel Booking Database.com</a>
                        </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/445d09784c.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
	<script>
      AOS.init({
        duration: 3000,
        once: true,
      });
    </script>
</body>
</html>