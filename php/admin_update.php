<?php
session_start();
require('../includes/con_wed.php');
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$id = $_GET['id'];

$query = "SELECT * FROM users WHERE UserEmail='$email' and UserPassword='$password'";

$result = mysql_query($query) or die(mysql_error());
$count = mysql_num_rows($result);
$row = mysql_fetch_assoc($result);
$access = $row['UserStatus'];


$sql = "SELECT * FROM wednesday WHERE productID = '$id'";

$results = mysql_query($sql) or die(mysql_error());
$counts = mysql_num_rows($results);
$rows = mysql_fetch_assoc($results);

if($count != 1){
    header("Location: login.php");
    
}

if($access != 3){
    header("Location: client.php");
    
}

$sales = "SELECT MAX(orderNumber) AS TotalSales FROM orders";
$reviews = "SELECT MAX(reviewID) AS TotalReviews FROM reviews";
$orders = "SELECT SUM(quantity) AS TotalOrders FROM orders";
$revenue = "SELECT SUM(price) AS TotalRevenue FROM orders";

$salesResult = mysql_query($sales) or die(mysql_error());
$reviewResult = mysql_query($reviews) or die(mysql_error());
$ordersResult = mysql_query($orders) or die(mysql_error());
$revenueResult = mysql_query($revenue) or die(mysql_error());

$rowSales = mysql_fetch_assoc($salesResult);
$rowReviews = mysql_fetch_assoc($reviewResult);
$rowOrders = mysql_fetch_assoc($ordersResult);
$rowRevenue = mysql_fetch_assoc($revenueResult);

?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" />
<title>Wednesday Admin</title>
<style>
@import url('../css/bootstrap.css');
@import url('../css/bootstrap.min.css');
@import url('../css/full-width-pics.css');
@import url('../css/shop-homepage.css');
@import url('../css/styles.css');
@import url(https://fonts.googleapis.com/css?family=Montserrat);

.wed_color {
    color: #d824c9;
}

</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body>
<?php include_once("../analyticstracking.php") ?>
<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
           	<div class="mobilelogo">
            		<a href="home.php"><img src="../img/wednesday_logo1.png" alt=""></a>
            	</div>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
               <!-- <a class="navbar-brand" href="#">Start Bootstrap</a>-->
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="logo">
            <div class="col-lg-4"><a href="../home.php"><img src="../img/wednesday_logo1.png" alt="Wednesday"></a></div>
            </div>
            <div class="col-lg-8">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="../home.php">Home</a>
                        	
                    </li>
                    <li>
                        <a href="../womenscatalog.php">Women</a>
                    </li>
                    <li>
                        <a href="../menscatalog.php">Men</a>
                    </li>
                    <li>
                        <a href="../about.php">About</a>
                    </li>
                    <li>
                        <a href="../logout.php">Log Out</a>
                    </li>
                 <li>
                         <a href="../cart.php"><img src="../img/shoppingbag.png" alt=""></a>
                    </li>
                </ul>
                      <form class="navbar-form" role="search" action="womenscatalog.php" enctype="multipart/form-data" method="POST">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="search">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
            </form>
           
           <!-- <a href="#"><img src="img/shoppingbag.png"></a>-->
            </div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <div class="container">
    <div class="row">
    <div class="col-md-12">
    <h2><span class="wed_color">Welcome</span> <i><?php echo $row['UserFirstName'];?> <?php echo $row['UserLastName'];?></i></h2>
    </div>
    </div>
    </div>
    
    <div class="container">
        <div class="row">
            
            <div class="col-md-4">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Status</h3>
                        <div class="pull-right">
                        
                        </div>
                    </div>
                        <div class="row">
                        <div class="col-md-10">
                            <h4><strong>Total Sales:</strong></h4>
                        </div>
                        <div class="col-md-2">
                            <h4><?php echo $rowSales['TotalSales'];?></h4>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-10">
                            <h4><strong>Total Orders Placed:</strong></h4>
                        </div>
                        <div class="col-md-2">
                            <h4><?php echo $rowOrders['TotalOrders'];?></h4>
                        </div>
                      </div>
                        <div class="row">
                        <div class="col-md-10">
                            <h4><strong>Total Revenue:</strong></h4>
                        </div>
                        <div class="col-md-2">
                            <h4><?php echo $rowRevenue['TotalRevenue'];?></h4>
                        </div>
                      </div>
                        <div class="row">
                        <div class="col-md-10">
                            <h4><strong>Total Reviews/Comments:</strong></h4>
                        </div>
                        <div class="col-md-2">
                            <h4><?php echo $rowReviews['TotalReviews'];?></h4>
                        </div>
                      </div>
                      <br>
                      <br>
                      <br>
                </div>
            </div>
	
    
   <!-- <div class="container">
    
   
    	<div class="row">-->
			
			<div class="col-md-8">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">Revenue</h3>
						<div class="pull-right">
						
						</div>
					</div>
					
					<img src="../img/chart.gif" class="img-responsive img-center roundcorners" alt="chart">
				</div>
			</div>
		</div>
	</div>
    	
   <div class="container">
    <!--<h1>Click the filter icon <small>(<i class="glyphicon glyphicon-filter"></i>)</small></h1>-->
    	<div class="row">
			
			<div class="col-md-12">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">Update Product</h3>
						<div class="pull-right">
							<!--<span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
								<i class="glyphicon glyphicon-filter"></i>
							</span>-->
						</div>
					</div>
					<!--<div class="panel-body">
						<input type="text" class="form-control" id="task-table-filter" data-action="filter" data-filters="#task-table" placeholder="Filter Tasks" />
					</div>-->
                    <div id="myForm">
                        <form method="post" action="admin_update_check.php">
                            <fieldset class="clearfix">
                                
                                <br />

                                <div class="form-group col-md-4">
                                    <label>Product ID</label>
                                    <input name='product_id' type="tel" class="form-control" onFocus="if(this.value == '<?php echo $rows['productID'];?>') this.value = ''" onBlur="if(this.value == '') this.value = '<?php echo $rows['productID'];?>'" value="<?php echo $rows['productID'];?>" required="required">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Product Name</label>
                                    <input name='product_name' type="text" class="form-control" onFocus="if(this.value == '<?php echo $rows['productName'];?>') this.value = ''" onBlur="if(this.value == '') this.value = '<?php echo $rows['productName'];?>'" value="<?php echo $rows['productName'];?>" required="required">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Description</label>
                                    <input name='description' type="text" class="form-control" onFocus="if(this.value == '<?php echo $rows['description'];?>') this.value = ''" onBlur="if(this.value == '') this.value = '<?php echo $rows['description'];?>'" value="<?php echo $rows['description'];?>" required="required">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Gender</label>
                                    <input name='gender' type="text" class="form-control" onFocus="if(this.value == '<?php echo $rows['gender'];?>') this.value = ''" onBlur="if(this.value == '') this.value = '<?php echo $rows['gender'];?>'" value="<?php echo $rows['gender'];?>" required="required">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Category</label>
                                    <input name='category' type="text" class="form-control" onFocus="if(this.value == '<?php echo $rows['category'];?>') this.value = ''" onBlur="if(this.value == '') this.value = '<?php echo $rows['category'];?>'" value="<?php echo $rows['category'];?>" required="required">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>SKU</label>
                                    <input name='stock' type="tel" class="form-control" onFocus="if(this.value == '<?php echo $rows['SKU'];?>') this.value = ''" onBlur="if(this.value == '') this.value = '<?php echo $rows['SKU'];?>'" value="<?php echo $rows['SKU'];?>" required="required">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Stock</label>
                                    <input name='sku' type="tel" class="form-control" onFocus="if(this.value == '<?php echo $rows['stock'];?>') this.value = ''" onBlur="if(this.value == '') this.value = '<?php echo $rows['stock'];?>'" value="<?php echo $rows['stock'];?>" required="required">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Cost</label>
                                    <input name='cost' type="tel" class="form-control" onFocus="if(this.value == '<?php echo $rows['cost'];?>') this.value = ''" onBlur="if(this.value == '') this.value = '<?php echo $rows['cost'];?>'" value="<?php echo $rows['cost'];?>" required="required">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Price</label>
                                    <input name='price' type="tel" class="form-control" onFocus="if(this.value == '<?php echo $rows['price'];?>') this.value = ''" onBlur="if(this.value == '') this.value = '<?php echo $rows['price'];?>'" value="<?php echo $rows['price'];?>" required="required">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Product Weight</label>
                                    <input name='weight' type="tel" class="form-control" onFocus="if(this.value == '<?php echo $rows['weight'];?>') this.value = ''" onBlur="if(this.value == '') this.value = '<?php echo $rows['weight'];?>'" value="<?php echo $rows['weight'];?>" required="required">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Image Thumbnail</label>
                                    <input name='img_thumb' type="text" class="form-control" onFocus="if(this.value == '<?php echo $rows['productThumb'];?>') this.value = 'img/items/thumbs/'" onBlur="if(this.value == 'img/items/thumbs/') this.value = '<?php echo $rows['productThumb'];?>'" value="<?php echo $rows['productThumb'];?>" required="required">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Image URL</label>
                                    <input name='img_url' type="text" class="form-control" onFocus="if(this.value == '<?php echo $rows['productImage'];?>') this.value = 'img/items/'" onBlur="if(this.value == 'img/items/') this.value = '<?php echo $rows['productImage'];?>'" value="<?php echo $rows['productImage'];?>" required="required">
                                </div>

                                <div class="col-md-12 pull-right" style="padding-bottom: 10px;">
                                    <input type="submit" style="background-color: #d824c9" value="Update Product" class="btn btn-primary pull-right" id="submit"/>
                                </div>

                                <br />

                            </fieldset>
                        </form>
                    </div>
				</div>
			</div>
		</div>
	</div>
     
  <!-- Footer -->
    <footer class="col-lg-12">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <p>This site is not official and is an assignment for a UCF Digital Media course</p>
                    <p>designed by Wednesday</p>
                <!--    <button type="button" class="btn btn-success pull-left">
                            <a href="admin.php" style="color:white;">Admin </a><span class="glyphicon glyphicon-user"></span>
                        </button>-->
                </div>
                <div class="col-lg-3">
                	<p><strong>Contact</strong></p>
                    <p>1-800-2468</p>
                    <p>4000 Central Florida Blvd</p>
                    <p>Orlando, FL 32816</p>
                </div>
                  <div class="col-lg-3">
                	<i class="fa fa-facebook fa-2x"></i>
                    <i class="fa fa-twitter fa-2x"></i>
                    <i class="fa fa-google-plus fa-2x"></i>
                    <i class="fa fa-pinterest-p fa-2x"></i>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>