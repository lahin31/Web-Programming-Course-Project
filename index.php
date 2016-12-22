<?php
require_once 'dbconfig.php';



if(isset($_POST['signup']))
{
   $name = trim($_POST['name']);
   $uname = trim($_POST['uname']);
   $email = trim($_POST['email']);
   $upass = trim($_POST['upass']);
   $cpass = trim($_POST['cpass']);

      try
      {
         $stmt = $DB_con->prepare("SELECT User_Name, Email FROM user_signup WHERE User_Name=:uname OR Email=:email");
         $stmt->execute(array(':uname'=>$uname, ':email'=>$email));
         $row=$stmt->fetch(PDO::FETCH_ASSOC);

         if($row['User_Name']==$uname) {
            $error = '<div class="alert alert-danger">An account already exists with that username. Please choose another.!';
         }
         else if($row['Email']==$email) {
            $error = '<div class="alert alert-danger">An account already exists with that email address. Please choose another.!';
         }
         else
         {
            if($user->register($name,$uname,$email,$upass,$cpass))
            {
                $user->redirect('index.php');
            }
         }
     }
     catch(PDOException $e)
     {
        echo $e->getMessage();
     }
}

if($user->is_loggedin()!="")
{
    $user->redirect('home.php');
}

if(isset($_POST['login']))
{
     $uname = $_POST['username'];
     $upass = $_POST['password'];

 if($user->login($uname,$upass))
 {
      $user->redirect('home.php');
 }
 else
 {
      $error2 = '<div class="alert alert-danger">Wrong Username/password!</div>';
 }
}

?>


<!DOCTYPE html>
<html lang="en" ng-app="myModule">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AnimalsZone</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<!-- Custom CSS -->
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/album.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<!-- Starts of Navbar -->
<nav class="navbar navbar-default navbar-fixed-top" id="navbar-red" style="background:#2F4F4F;">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><i class="fa fa-bars" aria-hidden="true"></i> AnimalsZone</a>
        </div>
        <center>
            <div class="navbar-collapse collapse" id="navbar-main">
                <form action="" class="navbar-form navbar-right" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-default" name="login">Login</button>
                </form>
            </div>
        </center>
    </div>
</nav>
<!-- End of NavBar -->

<div class="container" ng-controller="myCtrl as vm" >
    <div class="main col-lg-9">
        <div class="col-lg-6">
            <div id="albumImage" class="col-md-5">
                <p>
                    <?php if(isset($error2)){echo $error2;}?>
                </p>
                <h2 style="margin-right:250px"><b>Some in our Collection</b>:</h2>
                <img ng-src="image/Bella.jpg" alt="" width="250px" class="img-responsive" ng-if="vm.show_im">
                <img ng-src="{{vm.currentImage.path}}" alt="" width="250px" class="img-responsive">
            </div>
            <div class="row" id="row_pic">
                <div id="thumbWrapper">
                    <div id="thumbList">
                        <li ng-repeat="image in vm.images">
                            <img ng-src="{{image.path}}" alt="" width="150px" ng-click="vm.pic_fun(image)">
                        </li>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="row" id="row_home">
                <div class="col-md-12 col-md-offset-7">
                    <h1 style="text-align: center;">Sign Up</h1>
                    <p>
                        <?php if(isset($error)){echo $error;}?>
                    </p>
                    <form name="signUpForm" action="index.php" method="post">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?php echo $name; ?>" ng-model="name" ng-required="true">
                            <div ng-show="signUpForm.name.$touched && signUpForm.name.$invalid">
                    			<small style="color:red; text-align:center;">Enter a user name</small>
                    		</div>
                        </div>
                        <div class="form-group">
                            <label for="uname">User Name:</label>
                            <input type="text" id="name" name="uname" class="form-control" ng-model="unamee" ng-required="true">
                            <div ng-show="signUpForm.uname.$touched && signUpForm.uname.$invalid">
                    			<small style="color:red; text-align:center;">Enter a name</small>
                    		</div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" ng-model="email" ng-required="true">
                            <div ng-show="signUpForm.email.$touched && signUpForm.email.$invalid">
                    			<small style="color:red; text-align:center;">ENTER A VALID EMAIL</small>
                    		</div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label><div role="alert">
                              <span class="error" ng-show="signUpForm.upass.$error.minlength">
                                Too short!</span>
                              <span class="error" ng-show="signUpForm.upass.$error.maxlength">
                                Please keep your password below 11 digits!</span>
                            </div>
                            <input type="password" id="password" name="upass" class="form-control" ng-model="upass" ng-minlength="3" ng-maxlength="11" ng-required="true">
                        </div>
                        <div class="form-group">
                            <label for="password">Confirm Password:</label>
                            <div class="form-errors" ng-messages="signUpForm.cpass.$error" ng-show="signUpForm.cpass.$touched">
                                <small class="form-error" ng-message="password" style="color:red; text-align:center;">Password different</small>
                             </div>
                            <input type="password" id="password" name="cpass" class="form-control" ng-model="cpass" ng-required="true" confirm-pwd="upass">
                        </div>
                        <button class="btn btn-block btn-primary" name="signup" ng-disabled="signUpForm.$invalid">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- AngularJS Files -->
<script src="libs/angular.js"></script>
<script src="scripts/script.js"></script>
<script src="scripts/script2.js"></script>
<script src="libs/angular-animate.min.js"></script>
<script src="libs/angular-messages.js"></script>
<script src="libs/angular-route.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
