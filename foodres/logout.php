<?php
	session_start();
	session_destroy();
	include('index.php');
?>

<style>
#logout_wrap {
	float:left;
	width: 700px;
}

#logout_wrap #logout {
	padding-left:12px;
	padding-top: 20px;
}
#logout_wrap #logout p{
	font-size:20px;
	font-weight:500;
	font-family:'Tw Cen MT';
	color:#333;
	
	margin:0;
	padding-left:30px;
}


</style>

<div id=logout_wrap>
	<div id=logout>
	<p><b>You've logged out.</b><br />
       Please login again to make reservations.
    </p>
    </div>
</div>
</div>
</div>

