<?php
	session_start();
	include('admin.php');
	mysql_connect("localhost","root","") or	 
		die ("Could not connct to database"); 
	mysql_select_db("csc181") or	 
		die ("Could not select database");
	
	if(isset($_POST['update']))
	{
		if(empty($_POST['item_name']))
				$_POST['item_name']=$_SESSION['upaditem_name'];
		if(empty($_POST['price']))
				$_POST['price']=$_SESSION['upadprice'];
		if(empty($_POST['no_servings']))
				$_POST['no_servings']=$_SESSION['upadno_servings'];
		if(empty($_POST['slotsForRes']))
				$_POST['slotsForRes']=$_SESSION['upadslotsForRes'];
				
		$upaditem_no=$_SESSION['upaditem_no'];
		$adstall_no=$_SESSION['adstall_no'];
		
		$price = $_POST['price'];
		$item_name = $_POST['item_name'];
		$no_servings = $_POST['no_servings'];
		$slotsForRes = $_POST['slotsForRes'];
		$statusForRes = $_POST['statusForRes'];
		
		$admin = new Admin();
		$sql=$admin->updateItem($upaditem_no,$adstall_no,$item_name,$no_servings,$price,$slotsForRes,$statusForRes); 
		
		//"UPDATE item SET item_name='$item_name',price='$price',no_servings='$no_servings',slotsForRes='$slotsForRes',statusForRes='$statusForRes' 
		//		WHERE item_no='$upaditem_no' and stall_no='$adstall_no'" ;
				   
		
		$result = mysql_query($sql);
		if (!$result){	
			$_SESSION['message']='The item was not updated';
			die('Error: ' . mysql_error());
		}else{
			$_SESSION['message']='Successfully updated the item';
			header('Location: /foodres/admin_viewItems.php');
		}		 
			  
		
	}

?>