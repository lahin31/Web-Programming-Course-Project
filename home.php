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
if(isset($_GET['addItem'])){
    $animal_name = $_GET['animalName'];
    $animal_type = $_GET['animalType'];
    $imgFile = $_FILES['animal_image']['name'];
    $tmp_dir = $_FILES['animal_image']['tmp_name'];
    $imgSize = $_FILES['animal_image']['size'];
    $animal_details = $_GET['animal_details'];
    $animal_price = $_GET['animal_price'];
    if (empty($animal_name) || empty($animal_type) || empty($animal_details) || empty($animal_price)) {
        $errMSG='<div class="alert alert-danger">Please fill up all form!</div>';
    }else{
    $upload_dir = 'animal_images/'; // upload directory

   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

   // valid image extensions
   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

   // rename uploading image
   $animal_pic = rand(1000,1000000).".".$imgExt;

   // allow valid image file formats
   if(in_array($imgExt, $valid_extensions)){
    // Check file size '5MB'
    if($imgSize < 5000000)    {
     move_uploaded_file($tmp_dir,$upload_dir.$animal_pic);
    }
    else{
     $errMSG = '<div class="alert alert-danger">Sorry, your file is too large.</div>';
    }
   }
   // if no error occured, continue ....
  if(!isset($errMSG))
  {
   $stmt = $DB_con->prepare('INSERT INTO animals_table(Animal_Name,Animal_Type,Animal_Image,Animal_Details,Animal_Price) VALUES(:a_name, :a_type, :a_img, :a_details, :a_price)');
   $stmt->bindParam(':a_name',$animal_name);
   $stmt->bindParam(':a_type',$animal_type);
   $stmt->bindParam(':a_img',$animal_pic);
   $stmt->bindParam(':a_details',$animal_details);
   $stmt->bindParam(':a_price',$animal_price);

   if($stmt->execute())
   {
    $successMSG = '<div class="alert alert-danger">new record succesfully inserted ...</div>';
   }
   else
   {
    $errMSG = '<div class="alert alert-danger">error while inserting....</div>';
   }
  }
}
}

?>

<!DOCTYPE html>
<html lang="en" ng-app="myModule">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Animal-Zone</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/angular-material/1.1.0/angular-material.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/global.css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body ng-cloak>
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

      <form class="navbar-form" action="home.php" method="get">
       <div class="form-group" style="display:inline;">
         <div class="input-group" style="display:table;">
           <input class="form-control input-mysize" name="search" id="users" placeholder="Search" autofocus="autofocus" type="text">
         </div>
       </div>
     </form>
 </div>
    </div><!-- /.navbar-collapse -->
</nav>
<!-- End of Navbar -->
<div class="container" ng-controller="myCtrl as vm" ng-cloak>
    <button class="btn btn-primary pull-right" style="margin-top: 60px;" ng-click="addListing=!addListing" ng-show="!addListing">Add your animal</button>
    <div class="col-sm-12 addAni" ng-hide="!addListing" style="margin-top:80px;">
            <form action="" method="GET">
                <h1 style="font-family: tahoma;">Add your Animal info to sell</h1>
                <input type="text" placeholder="Name of your animal" class="form-control" name="animalName"><br />
                <select class="form-control" name="animalType">
                    <option>Cow</option>
                    <option>Goat</option>
                    <option>Cat</option>
                </select><br />
                <div class="form-group">
                      <textarea class="form-control" rows="5" id="comment" placeholder="Details" name="animal_details"></textarea><br />
                  </div>
                <div class="form-group">
                      <input type="text" class="form-control" placeholder="Price" name="animal_price"><br />
                  </div>
                <button class="btn btn-danger" name="addItem">Add</button>
                <md-button class="md-raised md-warn pull-right" ng-click="addListing=!addListing" ng-show="addListing">Close</md-button>
            </form>
    </div>
    <div class="row" id="row" style="margin-top:40px;">
        <div class="col-sm-12">
            <p>
                <?php if(isset($errMSG)){echo $errMSG;}?>
            </p>
            <p>
                <?php if(isset($successMSG)){echo $successMSG;}?>
            </p>
        </div>
        <div ng-repeat="x in vm.myData | filter:s" class="repeat-animation">
            <div class="col-md-12 col-md-4">
                <div class="thumbnail">
                <img ng-src="image/Herman.jpg" alt=".." class="img-responsive">
                <div class="caption">
                    <h3><a><i class="fa fa-heart pull-right" aria-hidden="true"></i></a></h3>
                        <h3>{{x.Animal_Name}}</h3>
                        <p>{{x.Animal_Details}}</p>
                        <div class="clearfix">
                            <div class="price pull-left">{{x.Animal_Price}}/- Taka</div>
                            <p class="tpbutton btn-toolbar text-center">
                                <a href="#" class="btn btn-danger pull-right" role="button" ng-click="vm.showSimpleToast()">Add</a>
                                <a href="#" class="btn btn-info pull-right" role="button" data-toggle="modal" data-target="#animalDetails" ng-click="vm.activeAnimal(x)">Details</a>
                            </p>
                        </div>
                    </div>
                </div>
                </div>
        </div>
    </div>

<!-- Modal for showing Animal -->
<div class="modal fade" id="animalDetails">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button  type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>{{vm.animalArray.Animal_Name}}</h2>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-5 col-xs-offset-3">
                        <img ng-src="image/Bella.jpg" alt=".." class="img-rounded img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div>
                        <div class="col-md-12">
                            <p><strong>Name:</strong> {{vm.animalArray.Animal_Name}}</p>
                            <p><strong>Animal Type:</strong> {{vm.animalArray.Animal_Type}}</p>
                            <p><strong>Animal Description: </strong><br>{{vm.animalArray.Animal_Details}}</p>
                            <p><strong>Animal Price: </strong>{{vm.animalArray.Animal_Price}}</p>
                            <div layout="row" flex>
                                <md-button class="md-raised">Add</md-button>
                              <div>
                                <md-button class="md-raised" data-dismiss="modal">Cancel</md-button>
                              </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- AngularJS Files -->
<script src="libs/angular.js"></script>
<script src="scripts/script.js"></script>
<script src="libs/angular-animate.min.js"></script>
<script src="libs/angular-messages.js"></script>
<script src="libs/angular-route.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="scripts/typeahead.js"></script>
<script src="scripts/global.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
