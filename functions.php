<?php 
include('connection.php');
session_start();


// Login
if (isset($_POST['login'])) {
    $usernames = $_POST['username'];
    $pass = $_POST['password'];

    $checkLogin="SELECT * FROM admin WHERE username='$usernames' AND password='$pass'";
    $querys = $conn->query($checkLogin);
    $checkRow = mysqli_num_rows($querys);
    $getAdmin = mysqli_fetch_array($querys);

    $login="SELECT * FROM clients WHERE username='$usernames'";
    $prompt = mysqli_query($conn, $login);
    $getData = mysqli_fetch_array($prompt);

    if ($checkRow == 1){
        $getName = $getAdmin['username'];
        $_SESSION['username'] = $getName;
        header('location:main.php');
    }elseif (password_verify($pass, $getData['password'])){
        $getName = $getData['name'];
        $getUser = $getData['username'];
        $getId = $getData['id'];
        $getEmail = $getData['email'];
        $_SESSION['name'] = $getName;
        $_SESSION['email'] = $getEmail;
        $_SESSION['user'] = $getUser;
        $_SESSION['id'] = $getId;
        header('location:client.php');
      
    }else{
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'error',
                title: 'Username and/or Password is incorrect',
                text: 'Something went wrong!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "index.php";
                    }else{
                        window.location.href = "index.php";
                    }
                })
                
            })
    
        </script>
        <?php
    }
}


// Registration
if (isset($_POST['registration'])) {
    $names = $_POST['name'];
    $phones = $_POST['phone'];
    $genders = $_POST['gender'];
    $usernames = $_POST['username'];
    $pass1 = $_POST['password1'];
    $pass2 = $_POST['password2'];

    $checking = "SELECT * FROM clients WHERE password='$pass1' OR name='$names' OR username='$usernames'";
    $prompt = $conn->query($checking);
    $row = mysqli_num_rows($prompt);

    $target_dir = "uploads/";
    $target_file = $target_dir . time(). basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

    if ($pass1 != $pass2){
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'error',
                title: 'Password Does not Match!',
                text: 'Please check your password',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "register.php";
                    }else{
                        window.location.href = "register.php";
                    }
                })
                
            })
    
        </script>
        <?php
    }else if ($row == 0){
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        if($check == false) {
            echo "<script>alert('File is not an image.');
            window.location = \"index.php\"</script>";
        }else{
            $conn->query("INSERT INTO clients (name, phone, gender, image, username, password) VALUES('$names','$phones','$genders', '$target_file','$usernames','".password_hash($pass1, PASSWORD_DEFAULT)."')") or die($conn->error);
            ?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <script>
                $(document).ready(function(){
                    Swal.fire({
                    icon: 'success',
                    title: 'Successfully Registered',
                    text: 'Please login your credentials now',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Okay'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "index.php";
                        }else{
                            window.location.href = "index.php";
                        }
                    })
                    
                })
        
            </script>
            <?php
        }

    }else{
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'warning',
                title: 'User is already registered',
                text: 'Please login your credentials now',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "index.php";
                    }else{
                        window.location.href = "index.php";
                    }
                })
                
            })
    
        </script>
        <?php
    }
}


// Change Profile Pic Admin
if (isset($_POST['change_profile'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);

    if($check !== false) {
    
        $uploadOk = 1;
        if ($uploadOk == 0) {
            echo "<script type=\"text/javascript\">
            alert(\"Sorry, your file was not uploaded.\");
            window.location = \"account.php\"
            </script>";
    } else {
      move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file);
    }
        $sql='UPDATE admin SET image="'.$target_file.'" WHERE id=1';
        $result = mysqli_query($conn, $sql);
        header('location: account.php');
        
      } else {
        echo "<script type=\"text/javascript\">
        alert(\"File is not an image!\");
        window.location = \"account.php\"
        </script>";
        $uploadOk = 0;
      }
}

// Update Account Settings Admin
if (isset($_POST['updateAdmin'])) {
    $username = $_POST['user'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $emails = $_POST['mail'];
    
    if ($pass1 != $pass2){
        ?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'error',
                title: 'Password does not match',
                text: 'Something went wrong!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "account.php";
                    }else{
                        window.location.href = "account.php";
                    }
                })
                
            })
    
        </script>
        <?php
    }else{
        $conn->query("UPDATE admin SET username='$username', password='$pass1', email='$emails' WHERE id=1") or die($conn->error);
        header("Location: index.php");
    }



}


// Delete Client Admin
if (isset($_GET['deleteClient'])) {
    $id = $_GET['deleteClient'];
    $conn->query("DELETE FROM clients WHERE id=$id") or die($conn->error);
    header("Location: client_rec.php");
}

// Update Client Admin
if (isset($_POST['updateClient'])) {
    $id = $_POST['id'];
    $names = $_POST['name'];
    $phones = $_POST['phone'];
    $genders = $_POST['gender'];
    $usernames = $_POST['username'];
    $conn->query("UPDATE clients SET  name='$names' ,phone='$phones', gender='$genders', username='$usernames' WHERE id='$id'") or die($conn->error);
    header("Location: client_rec.php");
}


// Change Profile Pic Client
if (isset($_POST['change_client_profile'])) {
    $getId = $_POST['ids'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["client_profile"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["client_profile"]["tmp_name"]);

    if($check !== false) {
    
        $uploadOk = 1;
        if ($uploadOk == 0) {
            echo "<script type=\"text/javascript\">
            alert(\"Sorry, your file was not uploaded.\");
            window.location = \"client.php\"
            </script>";
    } else {
      move_uploaded_file($_FILES["client_profile"]["tmp_name"], $target_file);
    }
        $sql= "UPDATE clients SET image='".$target_file."' WHERE id='$getId'";
        $result = mysqli_query($conn, $sql);
        header('location: client.php');
        
      } else {
        echo "<script type=\"text/javascript\">
        alert(\"File is not an image!\");
        window.location = \"client.php\"
        </script>";
        $uploadOk = 0;
      }
}


// Update Account Settings Client
if (isset($_POST['updateAccount'])) {
    $id = $_POST['id'];
    $names = $_POST['name'];
    $phones = $_POST['phone'];
    $genders = $_POST['gender'];
    $usernames = $_POST['username'];

  
    $conn->query("UPDATE clients SET  name='$names' ,phone='$phones', gender='$genders', username='$usernames' WHERE id='$id'") or die($conn->error);
    ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            Swal.fire({
            icon: 'success',
            title: 'Successfully updated your account',
            text: 'Please login your credentials now',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Okay'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "index.php";
                }else{
                    window.location.href = "index.php";
                }
            })
            
        })

    </script>
    <?php
    
}


// Update Account Client Password
if (isset($_POST['updatepassAccount'])) {
    $id = $_POST['id'];
    $password1 = $_POST['pass1'];
    $password2 = $_POST['pass2'];

    if ($password1 != $password2){
        ?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'error',
                title: 'Password does not match',
                text: 'Something went wrong!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "client.php";
                    }else{
                        window.location.href = "client.php";
                    }
                })
                
            })
    
        </script>
        <?php
    }else{
        $conn->query("UPDATE clients SET password='".password_hash($password1, PASSWORD_DEFAULT)."' WHERE id='$id'") or die($conn->error);
        ?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'success',
                title: 'Successfully changed your password',
                text: 'Please login your credentials now',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "index.php";
                    }else{
                        window.location.href = "index.php";
                    }
                })
                
            })

        </script>
        <?php
    }
}

// Booking Submission Client
if (isset($_POST['booking'])) {
    $images = $_POST['images'];
    $names = $_POST['name'];
    $phones = $_POST['phone'];
    $stays = $_POST['stay'];
    $rnums = $_POST['rnum'];
    $rcats = $_POST['rcat'];
    $msg = $_POST['txtMsg'];

    $conn->query("INSERT INTO booking (name, phone, stay_duration, room_num, room_cat, image, message) VALUES('$names','$phones','$stays', '$rnums', '$rcats','$images', '$msg')") or die($conn->error);

    ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            Swal.fire({
            icon: 'success',
            title: 'Successfully submitted',
            text: 'Thank you and have a nice day',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Okay'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "client.php";
                }else{
                    window.location.href = "client.php";
                }
            })
            
        })

    </script>
    <?php
}


// Delete Booking Admin
if (isset($_GET['deleteBooking'])) {
    $id = $_GET['deleteBooking'];
    $conn->query("DELETE FROM booking WHERE id=$id") or die($conn->error);
    header("Location: booking.php");
}


?>