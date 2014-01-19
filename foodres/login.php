<?php
	session_start();
	include('users.php');
	$user_id = trim($_POST['user_id'], " ");
	$password = $_POST['password'];
	

	
	if($user_id and $password){
		$connect = mysql_connect("localhost","root","") or die("Couldn't connect");
		mysql_select_db("csc181") or die("Couldn't find db");
		
		$user = new User();
		$q1= $user->getUser($user_id);
		$query = mysql_query($q1);
		$numrows = mysql_num_rows($query);
		
		if($numrows!=0){
			while($row=mysql_fetch_assoc($query)){
				$dbuser_id=$row['user_id'];
				$dbfname=$row['fname'];
				$dbmname=$row['mname'];
				$dblname=$row['lname'];
				$dbgender=$row['gender'];
				$dbaddress=$row['address'];
				$dbphone=$row['phone'];
				$dbemail=$row['email'];
				$dbuserType=$row['userType'];
				
				//echo $dbphone;
				
				$_SESSION['user_id']=$dbuser_id;
				$_SESSION['fname']=$dbfname;
				$_SESSION['mname']=$dbmname;
				$_SESSION['lname']=$dblname;
				$_SESSION['gender']=$dbgender;
				$_SESSION['address']=$dbaddress;
				$_SESSION['phone']=$dbphone;
				$_SESSION['email']=$dbemail;

				
				if($dbuserType=='customer'){
					$customer = new Customer();
					$cq = $customer->getCustomer($user_id);
					//echo $cq;
					$cust_query = mysql_query($cq);
					$rows = mysql_num_rows($cust_query);
		
					if($rows!=0){
						while($row=mysql_fetch_assoc($cust_query)){
							//echo " ".$row['cust_password'];
							$dbpassword = $row['cust_password'];
							$_SESSION['cust_no']=$row['cust_no'];
							$_SESSION['cpass']=$dbpassword;

						}
					}
				}
				
				if($dbuserType=='admin'){
					$admin = new Admin();
					$aq = $admin->getAdmin($user_id);
					$admin_query = mysql_query($aq);
					$rows = mysql_num_rows($admin_query);
		
					if($rows!=0){
						while($row=mysql_fetch_assoc($admin_query)){
							$dbpassword = $row['admin_password'];
							$_SESSION['admin_no']=$row['admin_no'];
						}
					}
				}
				
				if($dbuserType=='cashier'){
					$cashier = new Cashier();
					$cashq = $cashier->getCashier($user_id);

					$c_query = mysql_query($cashq);
					$rows = mysql_num_rows($c_query);
		
					if($rows!=0){
						while($row=mysql_fetch_assoc($c_query)){
							$dbpassword = $row['cashier_password'];
							$_SESSION['cashier_no']=$row['cashier_no'];

						}
					}
			  	}
				
			}
				
			if($dbuser_id==$user_id and $dbpassword==$password){
				
				if($dbuserType=='customer')
					header("Location: http://".$_SERVER['SERVER_NAME']."/foodres/cust_account.php");
				if($dbuserType=='cashier')
					header("Location: http://".$_SERVER['SERVER_NAME']."/foodres/cashier_viewItems.php");
				if($dbuserType=='admin')
					header("Location: http://".$_SERVER['SERVER_NAME']."/foodres/admin_viewItems.php");
				
			}else{
				//echo 'flag';
				header("Location: http://localhost/frs/loginfail.php");
			}
		}else{
			die("The user deosn't exist.");
		}
	}else{
		die("Please enter your username and password.");
	}
	
?>