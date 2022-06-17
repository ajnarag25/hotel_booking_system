<!doctype html>
<html lang="en">
  <head>
  	<title>Hotel Booking System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center" data-aos="zoom-in" data-aos-duration="1000" data-aos-once="true">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<div class="img" style="background-image: url(images/bg-2.jpg);"></div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Registration</h3>
			      		</div>
			      	</div>
					<form action="functions.php" method="POST" class="signin-form" enctype="multipart/form-data">
                        <p>Profile Information</p>
                        <div class="form-group mt-3">
			      			<input type="text" class="form-control" name="name" required>
			      			<label class="form-control-placeholder" for="name">Enter Name</label>
			      		</div>
                          <div class="form-group mt-3">
			      			<input type="number" class="form-control" name="phone" required>
			      			<label class="form-control-placeholder" for="contact no">Enter Phone no.</label>
			      		</div>
                          <div class="form-group mt-3">
                            <select name="gender" id="" class="form-control">
                                <option selected disabled value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
			      		</div>
                          <div class="form-group mt-3">
                            <label for="">Upload Image</label>
			      			<input type="file" name="fileToUpload" id="fileToUpload"  class="form-control" accept="image/png, image/jpeg" required>
			      		</div>
                        <p>Account Information</p>
                          <div class="form-group mt-3">
			      			<input type="text" class="form-control" name="username" required>
			      			<label class="form-control-placeholder" for="username">Enter Username</label>
			      		</div>
                        <div class="form-group">
                            <input id="password-field" type="password" name="password1" class="form-control" required>
                            <label class="form-control-placeholder" for="password">Enter Password</label>
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input id="password-field" type="password" name="password2" class="form-control" required>
                            <label class="form-control-placeholder" for="re-password">Confirm Password</label>
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary rounded submit px-3" name="registration">Register</button>
		            </div>
		          </form>
		          <p class="text-center">Already Registered? <a href="index.php">Login Here</a></p>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
	<script>
	AOS.init({
		duration: 3000,
		once: true,
	});
	</script>

	</body>
</html>

