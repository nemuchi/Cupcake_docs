<?php
	session_start();
	include('item.php');
	include('admin.php');
	mysql_connect("localhost","root","") or	 
		die ("Could not connct to database"); 
	mysql_select_db("csc181") or	 
		die ("Could not select database");

	if(isset($_POST['item_name']) && !is_null($_POST['item_name']) && isset($_POST['no_servings']) && !is_null($_POST['no_servings']) && isset($_POST['price']) && !is_null($_POST['price']) && isset($_POST['slotsForRes']) && !is_null($_POST['slotsForRes'])){
		$item=new Item();
		$item_name = $_POST['item_name'];
		$no_servings = $_POST['no_servings'];
		$price = $_POST['price'];
		$slotsForRes = $_POST['slotsForRes'];
		$category = $_POST['category'];
		$statusForRes = $_POST['statusForRes'];

		$iq = mysql_query($item->getItems($_SESSION['adstall_no']));
		while($row = mysql_fetch_array($iq)){
			if($row['item_name']==$item_name and $row['category']==$category)
			{
				$_SESSION['message']='The item was cannot be added! It already exist.';
				header('Location: /foodres/admin_addItem.php');
			}
		}
		
		if($category=='Breakfast'){
			$start_time = '08:00:00';
			$end_time = '10:00:00';
		}
		if($category=='Lunch'){
			$start_time = '10:00:00';
			$end_time = '13:00:00';
		}
		if($category=='Snacks'){
			$start_time = '08:00:00';
			$end_time = '16:00:00';
		}
		$adstall_no = $_SESSION['adstall_no'];
		$admin=new Admin();
		$add_item=$admin->addItem($item_name,$no_servings,$price,$slotsForRes,$category,$statusForRes,$start_time,$end_time,$adstall_no);
		$added = mysql_query($add_item);
	
	
		if (!$added){	
			$_SESSION['message']='The item was not added! It may already exist!';
			die('Error: ' . mysql_error());
		}else{
			$_SESSION['message']='Successfully added the item';
		}		 
		  
		header('Location: /foodres/admin_viewItems.php');

	}
    
?>