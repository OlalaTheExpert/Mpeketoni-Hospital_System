<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="../assets/css/bootstrap.css">
<title>Incoming Report</title>
</head>
<style type="text/css">
	@media print {
		
			#btnprint{
				display: none;
			}
			#btnprint1{
				display: none;
			}
			#footer1{
				display: none;
			}
			#th{
				display: none;
			}
 
 			#h4{
				display: none;
			}
			#p1{
				display: none;
			}
			#te{
				float: left;
				margin-left: 46rem;
				margin-top: 0.2rem;
				font-size: 25px !important;
			}
            </style>
<body>
    <div class="container pt-3">
        <p>Report Generated on <?php 
        date_default_timezone_set ('Africa/Nairobi');
        $tdate=date("j-n-Y");
        $ttime=date("G:i:s");
        echo $tdate ?> at <?php echo $ttime;?></p>
           
<table class="table table-striped">
  <thead class="thead-dark">
    
    <tr>
      <th scope="col">S/NO</th>
      <th scope="col">Full Name</th>
      <th scope="col">Gender</th>
      <th scope="col">Tag Number</th>
       <th scope="col">Serial Number</th>
       <th scope="col">Services</th>
       <th scope="col">Days/Prices</th>
       <th scope="col">Room No</th>
        <th scope="col">Bed</th>
        <th scope="col">Total</th>
      <th scope="col">Brought In Date</th>
       
    </tr>
  </thead>
  <tbody>
  <?php

$conn = mysqli_connect('localhost', 'root', '', 'mogue_db');

$query = $conn->query("SELECT * FROM  outgoing_deceased ORDER BY id DESC");
$count=1;
if($query->num_rows > 0){
    while($rows = $query->fetch_assoc()){
      $id = $rows['id'];
      $fname = $rows["fullname"];

    $query1 = $conn->query("SELECT * FROM  incoming_deceased WHERE id=$fname ORDER BY id DESC");

    while($row = $query1->fetch_assoc()){
      $fullname=$row["fullname"];
      $gender = $row["gender"];
      $tag_number = $row["tag_number"];
      $serial_number = $row["serial_number"];
      $room_no = $row["room"];
      $bed = $row["bed"];
      $date = $row["date"];
      $query = $conn->query("SELECT * FROM  invoices WHERE deceased=$fname");
$count=1;
if($query->num_rows > 0){
    while($rows = $query->fetch_assoc()){
      $id = $rows['id'];
      $services = $rows["services"];
      $days=$rows['day'];
      $total=$rows['total'];

//       $start_date = "2015/03/02";  
// $date_out = strtotime($date);
// $date_out = strtotime(" day", $date_out);
// echo date('Y/m/d', $date_out);
?>
    <tr>
      <th scope="row"><?php echo $count; ?></th>
      <td><?php echo $fullname?></td>
      <td><?php echo $gender?></td>
      <td><?php echo $tag_number?></td>
       <td><?php echo $serial_number?></td>
        <td><?php echo $services?></td>
        <td><?php echo $days?></td>
        
    <td><?php
    if($room_no==1){
      echo "A20";
    }else{
echo "A22";
    }
    ?></td>
     <td><?php echo $bed?></td>
     <td><?php echo $total?></td>
      <td><?php echo $date?></td>
      
      
       
      
     
    </tr>
   <?php 
$count++;
    }
}?>
</tbody>
</table>
<button type="submit" id="btnprint" class="btn btn-outline-primary" onclick="print()"><i class="fa fa-print"></i> Print Report</button>
</div>
<?php
}
    }
  }else{?>
  


 <div class="pt-4">
            <div class="alert alert-danger" role="alert">
               <strong>Oops!</strong> No Records found. <a href=" ../reports.php" name="delete" class="badge badge-info">Go Back</a>
            </div>
         </div>

       <?php 
    }
  ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>