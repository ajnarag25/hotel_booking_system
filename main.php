<?php include 'connection.php';?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <link href="assets/images/users/logo.png" rel="icon">
    <title>Hotel Booking Database - Admin</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link href="assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="dist/css/style.min.css" rel="stylesheet">

</head>

<style>
    body{
        font-family: lato;
    }
</style>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full"
        data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header" data-logobg="skin5">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
                    <div class="navbar-brand text-center">
                        <a href="main.php" class="logo">
                            <b class="logo-icon">
                                <img src="assets/images/users/building.gif" width="25" alt="homepage" class="light-logo" />
                            </b>
                            <span class="logo-text">
                                <span style="color: white">Hotel Booking Database</span>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin6">
                    <ul class="navbar-nav float-start me-auto">
                        <li class="nav-item search-box">
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter">
                                <a class="srh-btn">
                                    <i class="ti-close"></i>
                                </a>
                            </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav float-end">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="assets/images/users/logo.png" alt="user" class="rounded-circle" width="40">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="account.php"><i class="ti-user me-1 ms-1"></i>
                                    Account Settings</a>
                                <a class="dropdown-item" href="logout.php"><i class="ti-shift-right me-1 ms-1"></i>
                                    Logout</a>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="main.php"
                                aria-expanded="false">
                                <i class="mdi mdi-av-timer"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="client_rec.php"
                                aria-expanded="false">
                                <i class="mdi mdi-account"></i>
                                <span class="hide-menu">Client Records</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="client_rec.php"
                                aria-expanded="false">
                                <i class="mdi mdi-book"></i>
                                <span class="hide-menu">Booking Records</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="account.php"
                                aria-expanded="false">
                                <i class="mdi mdi-account-box"></i>
                                <span class="hide-menu">Account Settings</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="logout.php"
                                aria-expanded="false">
                                <i class="mdi mdi-arrow-left"></i>
                                <span class="hide-menu">Logout</span>
                            </a>
                        </li>
                       
                    </ul>
                </nav>
            
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body" style="background-color: rgba(255, 255, 0, 0.534);">
                                <div class="text-center">
                                    <br>
                                    <img src="assets/images/alumni.png" width="100" alt="">
                                    <br><br>
                                    <h2 class="card-title">Registered Clients</h2>
                                    <p>Total number of Registered Clients</p>
                                    <?php 
                                       $sql = "SELECT * FROM clients ";
                                       $result=mysqli_query($conn, $sql);
                                       $row = mysqli_num_rows($result);
                                    ?>
                                    <h2><?php echo $row; ?></h2>    
                                </div>
                            </div>
                            <a href="client_rec.php" class="btn btn-warning w-100" >View Registered Clients</a>   
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body" style="background-color: rgba(116, 212, 72, 0.534);">
                                <div class="text-center">
                                    <br>
                                    <img src="assets/images/book.png" width="100" alt="">
                                    <br><br>
                                    <h2 class="card-title">Total Bookings</h2>
                                    <p>Total number of Hotel Bookings</p>
                                    <?php 
                                       $sql = "SELECT * FROM booking ";
                                       $result=mysqli_query($conn, $sql);
                                       $row = mysqli_num_rows($result);
                                    ?>
                                    <h2><?php echo $row; ?></h2>  
                                </div>
                            </div>
                            <a href="booking.php" class="btn btn-success w-100" style="color:white" >View Bookings </a>   
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body" style="background-color: rgba(44, 199, 211, 0.534);">
                                <div class="text-center">
                                    <br>
                                    <img src="assets/images/settings.png" width="100" alt="">
                                    <br><br>
                                    <h2 class="card-title">Account Settings</h2>
                                    <p>Manage your account settings</p>
                                </div>
                            </div>
                            <a href="account.php" class="btn btn-primary w-100" style="color:white" >Manage </a>   
                        </div>
                    </div>
                </div>
           
            </div>

            <footer class="footer text-center">
            Hotel Booking Database
            </footer>
        </div>
    </div>

    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="dist/js/waves.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <script src="dist/js/custom.min.js"></script>
    <script src="assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="dist/js/pages/dashboards/dashboard1.js"></script>

</body>

</html>