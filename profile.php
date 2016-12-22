<?php
error_reporting( ~E_NOTICE ); // avoid notice
include_once 'dbconfig.php';
if(!$user->is_loggedin())
{
 $user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM user_signup WHERE id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en" ng-app="myModule">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Animal-Zone: <?php echo $userRow['Name'];?></title>

<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/user_profile.css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body ng-controller="myCtrl as vm">
<!-- Starts of Navbar -->
<nav class="navbar navbar-default navbar-fixed-top" id="navbar-red" style="background:#2F4F4F;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">AnimalsZone</a>
    </div>
    <div class="navbar-collapse collapse" id="searchbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Checkout(0)</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $userRow['Name'];?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="profile.php">Profile</a></li>
            <li><a href="#">Messages</a></li>
            <li><a href="content.php">Your Content</a></li>
            <li><a href="#">Settings</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>

      <form class="navbar-form">
       <div class="form-group" style="display:inline;">
         <div class="input-group" style="display:table;">
           <span class="input-group-addon" style="width:50px;"><span class="glyphicon glyphicon-search"></span></span>
           <input class="form-control" name="search" placeholder="Search" autocomplete="off" autofocus="autofocus" type="text">
         </div>
       </div>
     </form>
 </div>
    </div><!-- /.navbar-collapse -->
</nav>
<!-- End of Navbar -->

<div class="container" id="row">
    <h1 id="name_u"><?php echo $userRow['Name'];?></h1>
    <div id="u_info">
        <p id="u_name">UserName: <?php echo $userRow['User_Name'];?></p>
        <p id="u_email">Email: <?php echo $userRow['Email'];?></p>
        <p id="u_addr">Address: <?php ?></p>
    </div>
</div>

<!-- AngularJS Files -->
<script src="libs/angular.js"></script>
<script src="scripts/script.js"></script>
<script src="scripts/script2.js"></script>
<script src="libs/angular-animate.min.js"></script>
<script src="libs/angular-messages.js"></script>
<script src="libs/angular-route.min.js"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
