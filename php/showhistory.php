
<?php
// Start the session
session_start();

$user = $_SESSION['user'];





?>









<!DOCTYPE html>
<html>
<html lang="en">
<head>
  <title>History</title>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="https://lh3.googleusercontent.com/-HtZivmahJYI/VUZKoVuFx3I/AAAAAAAAAcM/thmMtUUPjbA/Blue_square_A-3.PNG" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="forcompany.css">
  <link rel="stylesheet" href="homepage.css">
  <link rel="stylesheet" href="AdminSignin.css">
  <script src="login.js"> </script>
  <script src="jump.js"> </script>
  <style>
    #homepage {
	background-color: rgba(94, 229, 237,0.2);
	border-radius: 20px;
	width: 800px;
	font-size: 16px;
	height: 600px;
	position:absolute;
	top:100px;
	left:220px;

}
#cart{
	border-color: #1b3b6f;
}
#cart:hover{
	background-color: #9eb3c2!important;
	border-color: #21295c!important;
	color:#21295c!important;
}
.navbar-brand:hover{
	background-color: #9eb3c2!important;
	border-color: #21295c!important;
	color:#21295c!important;
}
#logo{
	height:200px;
	width:200px;
}
h4 {
	font-weight: bold;
}
nav{
	background-color: #1b3b6f;
}
.form-control{
	border-radius: 50px ;
	border-color: #21295c;
	border-width: 1px;

}
.col-sm-6{
	margin-bottom: 20px;
}
.jumbotron{
	background-color: #21295c;
	margin-bottom: 0;
}
.heropage{
	background-color: #9eb3c2;
	width:100vw;
	height:800px;
	position:relative;
	align-items: center;
}
.btn-groupc{
	display:inline;
	align-content: space-between;
	justify-content: space-evenly;
	
	
}

.btn-primary{
	border-color: #9eb3c2;
	background-color: #21295c;
	border-radius: 20px;
	margin-bottom: 20px;
	
}
.btn-primary:hover{
	border-color: #21295c;
	background-color: #9eb3c2;
	color:#21295c;
	font-weight: bold;
}

.btn{
	align-content: space-between;
	justify-content: space-evenly;
	border-color: #9eb3c2;
	background-color: #21295c;
	border-radius: 20px;

}
.btn:hover{
	border-color: #21295c;
	background-color: #9eb3c2;
	color:#21295c;
	font-weight: bold;
}

.bottom{
	background-color: #21295c;
}
#paeiment{
	position:relative;
	align-self: center;
}
#pay-head{
	position:absolute;
	left:20px;
}
  </style>
</head>
<body>
  <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #1b3b6f; color:#1c7293">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="homepage.html"><span class="glyphicon glyphicon-home"></span> Home</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
                    <li id = "cart">
                        <a class="navbar-brand" href="cartshow.php"><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</a>
                    </li>           
          <li class="dropdown" id = "new">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"> Sign in&nbsp;</span><span class="caret"></span>
            </a>
            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
              <li><a href="signup.html">Register</a></li>
              
              <li class="dropdown-submenu">
              <a tabindex="-1" href="#">Sign in</a>
              <ul class="dropdown-menu">
                <li><a tabindex="-1" href="Adminpage.html">Manager Sign in</a></li>
                <li><a href="customersignin.html">Customer Sign in</a></li>
                
            
          </li>
              </ul>
              </li>
            
            </ul>
          </li>
            <li class="dropdown" id = "old">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" ><span class="glyphicon glyphicon-user" id="wuser">Welcom!</span>
            <span class="caret"></span>
            </a>
            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
              <li><a href="showhistory.php">History</a></li>
              <li><a href="#" id="logout">Sign out</a></li>
            </ul>
            </li>
        </ul>
      </div>
    </div>
  </nav>
<div class="jumbotron text-center">
  <img id="logo" src = "aircrux.svg" alt="My Happy SVG"/> 
	<p>Best ticket prices on air!</p> 
</div>


<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">

    </div>
    <div class="col-sm-8 text-left"> 
      <h1>Show History</h1>





<?php

include_once 'dbconnect2.php';



$sql = "SELECT FL.number AS FLnumber, company, type, time, B.date,  departure, d_time, arrival, a_time, C.name AS classname, price, paid
            FROM flight FL,  class C, airplane AP , book B
            WHERE (FL.number = C.number) AND (B.flightno = c.number) AND (classtype = C.name) AND (FL.airplane_id = AP.ID) 
            AND  B.username = '$user' AND paid = '1'
            ORDER BY time";


$result = mysqli_query($con,$sql);
$rowcount = mysqli_num_rows($result);

    if($rowcount == 0){
        echo "<div class='alert alert-info'><strong>Nothing in the history.</strong></div>";
    }
    else{
    echo "<div class='alert alert-info'>History:</div>";


   
    echo "<table class='table table-bordered table-striped table-hover'>
          <thead>
          <tr>
            <th>Time</th>
            <th>Flight</th>
            <th>Aircraft</th>
            <th>Date</th>
            <th>Departure</th>
            <th>Departure Time</th>
            <th>Arrival</th>
            <th>Arrival Time</th>
            <th>Class</th>

            <th>Price</th>

            <th>Pay</th>
          </tr>
          </thead>";
    while($row = mysqli_fetch_array($result)) {
        echo "<tbody><tr>";
        echo "<td>" . $row['time'] . "</td>";
        echo "<td>" . $row['FLnumber'] . "</td>";
        echo "<td>" . $row['company']." ".$row['type']. "</td>";
        echo "<td>" . $row['date'] . "</td>";
        echo "<td>" . $row['departure'] . "</td>";
        echo "<td>" . $row['d_time'] . "</td>";
        echo "<td>" . $row['arrival'] . "</td>";
        echo "<td>" . $row['a_time'] . "</td>";
        echo "<td>" . $row['classname'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        if($row['paid'] == 1){
            echo "<td>YES</td>";
        }
       
        echo "</tr>";
    }
    echo " </tbody></table>";

   
   
  
    }













mysqli_close($con);
?>




    </div>
    
  </div>
</div>

<footer class="container-fluid text-center" style="background-color: #1b3b6f;">
        <a href="#signUpPage" title="To Top">
            <span class="glyphicon glyphicon-chevron-up"></span>
        </a>
        <p>AirCrux.com</p>     
</footer>


</body>
</html>