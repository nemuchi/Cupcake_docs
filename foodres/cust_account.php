<?php
	include('frs_customer.php');
	if(isset($_SESSION['message'])){
		$msg = $_SESSION['message'];
		echo "<script>alert('$msg')</script>";
		unset($_SESSION['message']);
	}

?>

<style>
li#accountlink{
	background:#FC6;
}

#welcome {
	background:rgba(255,255,255,0.3);
	max-width: 1000px;
	min-width:800px;
	float:left;
	margin-bottom:20px;
}

#welcome h1{
	font-size:60px;
	font-weight:200;
	font-family:'Segoe Script';
	color: #666;
	float:left;
	margin:0;
	padding:0;

}
#welcome h1 p{
	float:right;
	font-size:30px;
	font-family:'Segoe Script';
	color: #333;
	padding-top: 20px;
}

#welcome p{
	clear:both;
	font-size:20px;
	font-weight:500;
	font-family:'Tw Cen MT';
	color:#333;
	
	margin:0;
	padding-left:10px;

}

#welcome b{
	color: #900;
	font-size:24px;
}
/****************/
#customer{
	background:rgba(255,255,102,0.3);
	width:800px;
	min-height:200px;
	max-height:450px;

	padding:10px;
	margin:5px;
}

#customer #cust_info{
	clear:both;
	padding:10px;
}

#customer #cust_info #cusimg{
	float:right;
}

#customer #cust_info #cusimg img{
	border:3px solid #999;
	width:220px;
	height:250px;
}


#customer #cust_info table{
	margin:0;
	padding-bottom:10px;
}

#customer #cust_info table td{
	text-decoration: none;
	color: #900;
	font-family: 'Century Gothic';
	font-size:18px;
	margin:0;
	padding:5px;
}
#customer #cust_info table a{
	text-decoration: none;
	color: #FC3;
	font-family: 'Century Gothic';
	font-size:14px;
	margin:0;
	padding:5px;
}
#customer #cust_info table a:hover{
	color:#CCC;
}
#customer #cust_links {
	margin:0;
	padding:0px;
}

#customer #cust_links a{
	text-decoration: none;
	color: #900;
	font-weight:bold;
	font-family: 'Century Gothic';
	font-size:20px;
	margin:0;
	padding:0;
}
#customer #cust_links a:hover{
	color:#666;
	text-decoration:underline;
}

#customer #cust_links ul{
	list-style:none;	
	margin:0;
	padding:10px;
}

#customer #cust_links li{
	margin: 0px;
	padding:5px;
	display: inline;	
}

/********************/
</style>
<div id=customer>
    <div id=welcome>
        <div id=wc_cust>
        <h1>Welcome,<p><?php echo $_SESSION['fname']." ".$_SESSION['lname'];?>!</p></h1>
            <p>You can now start making reservations by browsing items in STALLS.</p>
        </div>        
    </div>
	<div id=cust_links>
		<ul>
        <li><a href=cust_account.php>Profile</a></li>
        <li><a href=cust_viewTransaction.php>View My Transactions</a></li>
        </ul>    
    </div>
    <div id=cust_info> 
    	<div id=cusimg>
        	<img src="<?php echo "img/Customer/".$_SESSION['fname'].".jpg"?>"/>
        </div>
    	<table id=ac border=0 cellpadding="2" cellspacing="2">
        	<tr>
            	<td>Name</td>
                <td>: <?php echo $_SESSION['fname']." ".$_SESSION['mname']." ".$_SESSION['lname'];?></td>
            </tr>
            <tr>
            	<td>Gender</td>
                <td>: <?php echo $_SESSION['gender']?></td>
            </tr>
            <tr>
            	<td>Address</td>
                <td>: <?php echo $_SESSION['address']?></td>
            </tr>
            <tr>
            	<td>Phone</td>
                <td>: <?php echo $_SESSION['phone']?></td>
            </tr>
            <tr>
            	<td>Email</td>
                <td>: <?php echo $_SESSION['email']?></td>
            </tr>
            <tr><td></td>
            	<td><a href=cust_updateAccount.php>Change Details</a></td>
            </tr>

        </table>
        <table id=acs border=0 cellpadding="2" cellspacing="2">
        	<tr>
            	<td>Username</td>
                <td>: <?php echo $_SESSION['user_id']?></td>
            </tr>
            <tr><td></td><td><a href=cust_updateAccount.php>Change Password</a></td></tr>

         </table>   
    </div>
</div>
</div>
</div>

