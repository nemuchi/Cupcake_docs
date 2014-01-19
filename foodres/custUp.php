<?php
	session_start();
	mysql_connect("localhost","root","") or	 
		die ("Could not connct to database"); 
	mysql_select_db("csc181") or	 
		die ("Could not select database");
	
	include('customer.php');
	$upcust = new Customer();
	
	if(isset($_POST['cpass']))
	{
		if(empty($_POST['npass']))
				$_POST['npass']=$_SESSION['cpass'];
		else if($_POST['opass']!=$_POST['npass']&&$_POST['opass']==$_SESSION['cpass']&&$_POST['npass']==$_POST['npass2']){		
			$cust_no=$_SESSION['cust_no'];
			$pass = $_POST['npass'];
			
			$upcust->setCustNo($cust_no);
			$upcust->setCustPass($pass);
			
			$sql=$upcust->updateCustomer();
			$result = mysql_query($sql);
			if (!$result){	
				$_SESSION['message']='Changes of your account details has not been made.';
				die('Error: ' . mysql_error());
			}else{
				$_SESSION['pass']=$pass;
				$_SESSION['message']='Successfully edited your account details!';
				header('Location: /frs/cust_account.php');
			}
		}else{
				$_SESSION['message']='Cannot changed password!';
				header('Location: /frs/cust_account.php');
		}
		unset($_POST['cpass']);
	}
	
	if(isset($_POST['edit']))
	{
		if(empty($_POST['fname']))
				$_POST['fname']=$_SESSION['fname'];
		if(empty($_POST['mname']))
				$_POST['mname']=$_SESSION['mname'];
		if(empty($_POST['lname']))
				$_POST['lname']=$_SESSION['lname'];
		if(empty($_POST['gender']))
				$_POST['gender']=$_SESSION['gender'];
		if(empty($_POST['phone']))
				$_POST['phone']=$_SESSION['phone'];
		if(empty($_POST['email']))
				$_POST['email']=$_SESSION['email'];
		if(empty($_POST['address']))
				$_POST['address']=$_SESSION['address'];
				
		$user_id=$_SESSION['user_id'];
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$lname = $_POST['lname'];
		$gender = $_POST['gender'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$email = $_POST['email'];

		$upcust->setUserId($user_id);
		$upcust->setFname($fname);
		$upcust->setMname($mname);
		$upcust->setLname($lname);
		$upcust->setGender($gender);
		$upcust->setPhone($phone);
		$upcust->setAddress($address);
		$upcust->setEmail($email);
		
		$sql= $upcust->updateUser();
		$result = mysql_query($sql);
		if (!$result){	
			$_SESSION['message']='Changes of your account details has not been made.';
			die('Error: ' . mysql_error());
		}else{
				$_SESSION['fname']=$fname;
				$_SESSION['mname']=$mname;
				$_SESSION['lname']=$lname;
				$_SESSION['gender']=$gender;
				$_SESSION['phone']=$phone;
				$_SESSION['email']=$email;
				$_SESSION['address']=$address;
			$_SESSION['message']='Successfully edited your account details!';
			header('Location: /foodres/cust_account.php');
		}	
	}

?>
