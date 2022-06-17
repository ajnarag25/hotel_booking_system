<?php 
include('connection.php');

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
        echo "Welcome Admin";
        // header('location:admin.php');
    }elseif (password_verify($pass, $getData['password'])){
        // $getName = $getData['name'];
        // $getImage = $getData['image'];
        // $getEmail = $getData['email'];
        // $_SESSION['name'] = $getName;
        // $_SESSION['image'] = $getImage;
        // $_SESSION['email'] = $getEmail;
        // header('location:homepage.php');
        echo 'Successfully login';
      
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


?>