<?php
	include('frs_customer.php');
?>

<style>
#welcome {
	width: 700px;
	float:left;
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
	font-size:40px;
	font-family:'Segoe Script';
	color: #900;
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

</style>

<div id=welcome>
	<div id=wc_cust>
	<h1>Welcome,<p><?php echo $_SESSION['fname']." ".$_SESSION['lname']?>!</p></h1>
	    <p>You can now start making reservations.</p>
    </div>        
</div>
</div>
</div>