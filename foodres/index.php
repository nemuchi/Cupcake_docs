<?php
	include('frs_home.php');
	if(isset($_SESSION['regmsg'])){
		$regmsg = $_SESSION['regmsg'];
		echo "<script>alert('$regmsg')</script>";
		unset($_SESSION['regmsg']);
		empty($_SESSION['regmsg']);
	}
?>

<style>
li#homelink{
	background:#FC6;
}
</style>