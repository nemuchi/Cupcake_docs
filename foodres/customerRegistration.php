<?php
	session_start();
	include('customer.php');
	mysql_connect("localhost","root","") or	 
	die ("Could not connct to database"); 
	
	mysql_select_db("csc181") or	 
	die ("Could not select database");
	
	$user_id=$_SESSION['reguser_id'];
	$pass=$_SESSION['regpassword'];
	$email=$_SESSION['regemail'];
	$fname=$_SESSION['regfname'];
	$mname=$_SESSION['regmname'];
	$lname=$_SESSION['reglname'];
	$address=$_SESSION['regaddress'];
	$phone=$_SESSION['regphone'];
	$gender=$_SESSION['reggender'];
	//echo $phone;
	$customer = new Customer();
	$customer->setUserId($user_id);
	$customer->setCustPass($pass);
	$customer->setEmail($email);
	$customer->setFname($fname);
	$customer->setMname($mname);
	$customer->setLname($lname);
	$customer->setAddress($address);
	$customer->setPhone($phone);
	$customer->setGender($gender);
	//echo $customer->getPhone();
	$addCust=$customer->addCustomer();
	//echo $addCust;
	if (!mysql_query($addCust)) {
		die('Error: ' . mysql_error());} 
	
	$_SESSION['regmsg']="You have successfully registered. You can now log-in to your account and start making reservations";
	header('Location: /foodres/index.php');	
?>
