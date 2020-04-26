<?php
session_start();
?>
<!DOCTYPE html>
<link rel="stylesheet" href="sty.css" type="text/css">
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>FOODSHALA</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">FOODSHALA</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
  <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="cart.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="registercater.php">Restaurant Registration</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Customer Registration</a>
      </li>
     <li class="nav-item">
        <a class="nav-link" href="logincustomer.php">Login Customer</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="login.php">Login Restaurant</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
      <div class="navbar-collapse collapse">
  <ul class="navbar-nav ml-auto">
  <li class="nav-item active">
        <a class="nav-link" href="#"> <img src="https://img.icons8.com/metro/26/000000/guest-male.png"> <?php echo "Welcome ". $_SESSION['username']?></a>
      </li>
  </ul>
  </div>

    </ul>
  </div>
</nav>

<html>
<head>
	<title></title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Dancing+Script" rel="stylesheet">
</head>
<body class="container ">
	<h1 class="sh text-center text-danger mb-5" 
	style="font-family: 'Georgia', Sherif;"> AVAILABLE FOOD ITEMS</h1>

	<div class="row">
<?php
require_once "config.php";
?>
	<?PHP
	
	// $conn = mysqli_connect('localhost','root');
	 mysqli_select_db($conn,'food');

	//  if($conn){
	//  	echo "connection succussful";
	// }else{
 // 		echo "no connection";
	// 	 }


	$query = " SELECT * FROM food";

	$queryfire = mysqli_query($conn, $query);

	$num = mysqli_num_rows($queryfire);

	if($num > 0){
		while($product = mysqli_fetch_array($queryfire)){
			?>
		<div class="col-lg-3 col-md-3 col-sm-12">
			
			<form>
				<div class="card bg-secondary">	
					 <h6 class="card-title bg-info text-white mb-0 p-2 text-uppercase text-center abc"> <?php echo
					 	$product['Resname'];  ?>   </h6>
					 <h6 class="card-title bg-info text-white  p-2 text-uppercase text-center abc"> <?php echo
					 $product['name'];  ?>   </h6>
					<div class="card-body">
						 <img src="<?php echo
					 $product['image']; ?>" alt="pizza" class="img-fluid mb-2" >

					 <h6> &#8377; <?php echo $product['price'];  ?><span> (<?php echo $product['discount'];  ?>% off) </span> </h6> 

					 <h6 class="badge badge-success"> <?php echo $product['rating'];  ?> <i class="fa fa-star"> </i> </h6>

					 <input type="number" name="" class="form-control" placeholder="Quantity">

					</div>
					<div class="btn-group d-flex">
						<input class="btn btn-primary btn-sm flex-fill" type="button" value="Add To Cart" class="homebutton" id="btnHome" 
											onClick="document.location.href='registercater.php'" />
						<input class="btn btn-secondary bg-success btn-sm flex-fill " type="button" value="Order Now" class="homebutton" id="btnHome" 
											onClick="document.location.href='order.php'" />
					</div>


				</div>
			</form>

		</div>


	<?php		
		}
	}
	?>
</div>
</body>
</html>

