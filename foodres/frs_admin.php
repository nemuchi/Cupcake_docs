<?php
	session_start();
	if (!isset($_SESSION['user_id'])) {
		header('Location: '.$SERVER["SERVER_NAME"].'/frs/index.php');
	}	
	mysql_connect("localhost","root","") or	 
		die ("Could not connct to database"); 
	mysql_select_db("csc181") or	 
		die ("Could not select database");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_SESSION['adstall_name'];?> STALL</title>
<link href="css/frs.css" rel="stylesheet" type="text/css" media="screen"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript">
/*!
 * jQuery Sieve v0.3.0 (2013-04-04)
 * http://rmm5t.github.com/jquery-sieve/
 * Copyright (c) 2013 Ryan McGeary; Licensed MIT
 */
</script>




<style>
#content_wrapper{

}

#content{

}
</style>

</head>


<body>


<div id=header>	
	<div id=frslogo>
    	<img src="img/logo.png"/>
     </div>
</div>


<div id=container>   
    <div id=vnavwrapper>
        <div id=vnavbar>
            <div id=vnavlinks>
                <ul id=menu>
                    <li id=itemlink onClick=location.href='admin_viewItems.php'><a href=admin_viewItems.php><img src="img/homeicon.png" width=45 height=45 /><p>ITEM</p></a></li>
                   <li id=translink onClick=location.href='admin_viewTransaction.php'><a href=admin_viewTransaction.php><img src="img/transicon.png" width=33 height=35 /><p>TRANSACTION</p></a></li>
				   <li id=custlink onClick=location.href='admin_viewCustomer.php'><a href=admin_viewCustomer.php><img src="img/custicon.png" width=55 height=40 /><p>CUSTOMERS</p></a></li>
				   <li id=replink onClick=location.href='admin_report.php'><a href=admin_report.php><img src="img/listicon.png" width=45 height=40 /><p>REPORT</p></a></li>
                    <li id=outlink onClick=location.href='logout.php' ><a href='logout.php'><img src="img/cupcake.png" width=35 height=35 /><p>LOGOUT</p></a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <div id=content_wrapper>
    	<div id=content>
    
			


<?php

	function footer(){
	echo '
			<div id=footer>
				<p>All Rights Reserved 2013 | Cupcake | Contact us |</p>
			</div>
			
			</body>
			</html>
	';}
?>