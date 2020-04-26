<?php 
require_once "config.php";

$resname = $itemname = $image=$price=$discount=$cat="";
$resname_err = $itemname_err= "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){  
    $image=trim($_POST["image"]);
    $price=trim($_POST["price"]);
  $cat=trim($_POST["Foodcat"]);
    $discount=trim($_POST["discount"]);
    // Check if username is empty
    if(empty(trim($_POST["resname"]))){
        $itemname_err = "Restaurant Name cannot be blank";
    }
    else{
        $sql = "SELECT id FROM food WHERE Resname = ? AND name=? ";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
        	    
            mysqli_stmt_bind_param($stmt, "ss", $param_resname,$param_itemname);

            // Set the value of param username
            $param_resname = trim($_POST['resname']);
            $param_itemname = trim($_POST['itemname']);
            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
            	
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $resname_err = "Restaurant Present"; 
                    $itemname_err="Present";
                }
                else{
                   $resname = trim($_POST['resname']);
     	 			 $itemname=trim($_POST['itemname']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
        else
        {
        	echo "Issue";
        }
        mysqli_stmt_close($stmt);
    }


if(empty($resname_err) || empty($itemname_err))
{
    $sql = "INSERT INTO food (name,Resname, image, price,discount, Foodcat) VALUES (?,?,?,?,?,?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ssssss", $param_itemname, $param_resname,$param_image,$param_price,$param_discount,$param_foodcat);

        
        $param_resname = $resname;
        $param_itemname = $itemname;
        $param_image=$image;
        $param_price=$price;
        $param_foodcat=$cat;
        $param_discount=$discount;
      
        if (mysqli_stmt_execute($stmt))
        {
            header("location: itemadded.php");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}
?>



<!doctype html>
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

      
     
    </ul>
  </div>
</nav>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<div class="container mt-4">
<h3>Add Food</h3>
<hr>
<form action="" method="post">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Restaurant Name</label>
      <input type="text" class="form-control" name="resname" id="inputEmail4" placeholder="" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Food Item Name</label>
      <input type="text" class="form-control" name ="itemname" id="inputPassword4" placeholder="" required>
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress2">Upload Image</label>
    <input type="file" name="image" class="form-control" id="inputAddress2" placeholder="sda" required>
  </div>
   <label for="cat">Select Food Category</label>
  <select id="cat" name="Foodcat" class="form-control">
  <option></option>
  <option value="Veg">Veg</option>
  <option value="Non-veg">Non-Veg</option>
  </select>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Price</label>
      <input name="price" type="number" class="form-control" id="inputCity" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputCity">Discount</label>
      <input name="discount" type="number" class="form-control" id="inputCity" required>
    </div>
  </div>
  
  <button type="submit" class="btn btn-primary">Add Item</button>
</form>
</div>
