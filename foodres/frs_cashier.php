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
<title>MSU-IIT Food Reservation System </title>
<link href="css/frs.css" rel="stylesheet" type="text/css" media="screen"/>
<script type="text/javascript">
<!-- Put the following code in your JS file or Head Tags ---->
<!-->


function DisplayTime(){
if (!document.all && !document.getElementById)
return
	timeElement=document.getElementById? document.getElementById("curTime"): document.all.tick2
	var CurrentDate=new Date()
	var hours=CurrentDate.getHours()
	var minutes=CurrentDate.getMinutes()
	var seconds=CurrentDate.getSeconds()
	if (minutes<=9) minutes="0"+minutes;
	if (seconds<=9) seconds="0"+seconds;
	var currentTime=hours+":"+minutes+":"+seconds;
	timeElement.innerHTML="<font style='font-size:18px;font-weight:bold;'>"+currentTime+"</b>"
	setTimeout("DisplayTime()",1000)
	}
	window.onload=DisplayTime
</script>

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
                   <li id=itemlink onClick=location.href='cashier_viewItems.php'><a href=cashier_viewItems.php><img src="img/homeicon.png" width=45 height=45 /><p>ITEM</p></a></li>
                   <li id=translink onClick=location.href='cashier_viewTransaction.php'><a href=cashier_viewTransaction.php><img src="img/transicon.png" width=33 height=35 /><p>TRANSACTION</p></a></li>
                   <li id=outlink onClick=location.href='logout.php'><a href='logout.php'><img src="img/cupcake.png" width=35 height=35 /><p>LOGOUT</p></a></li>
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