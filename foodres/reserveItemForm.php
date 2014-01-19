<?php
	session_start();
	include('transaction.php');
	include('customer.php');
	include('item.php');
	mysql_connect("localhost","root","") or	 
		die ("Could not connct to database"); 
	mysql_select_db("csc181") or	 
		die ("Could not select database");
	
	if(is_null($_POST['quantity'])||$_POST['quantity']==0){
		$_POST['quantity']=1;
	}
		
	if(isset($_POST['reserve'])){
		$cust = new Customer();
		$item_no=$_SESSION['resitem_no'];
		$cust_no=$_SESSION['cust_no'];
		$stall_no=$_SESSION['stall_no'];
		$no_servings=$_SESSION['resno_servings'];	
		$slotsForRes=$_SESSION['resslotsForRes'];
		$statusForRes=$_SESSION['resstatusForRes'];	
		$quantity = $_POST['quantity'];
		
		$cust = new Customer();
		$trans = new Transaction();
		$curdate = urlEncode(date("ymd"));
		if($_SESSION['rescategory']=='Breakfast')
				$c='B';
		if($_SESSION['rescategory']=='Lunch')
				$c='L';
		if($_SESSION['rescategory']=='Snacks')
				$c='S';
			
		$count = $trans->countTransaction($stall_no);
		$trno = $stall_no.$c.$curdate.$count;
		if($quantity<=$slotsForRes){
			$res = $cust->createTransaction($trno,$cust_no,$stall_no,$item_no,$quantity);
			$reserve = mysql_query($res);
		}
		
		$newservings=$no_servings-$quantity;
		$newslots=$slotsForRes-$quantity;
		$newstatus='Available';
		if($newslots==0){
			$newstatus='Sold Out';
		}
		
		echo $newservings;
		
		$upitem = new Item();
		$upitem->setItem($item_no);
		$upitem->setNoServings($newservings);
		$upitem->setSlotsForRes($newslots);
		$upitem->setStatusForRes($newstatus);
		echo $upitem->getNoServings();
		echo $upitem->getSlotsForRes();

		$updated = mysql_query($upitem->upItem($item_no));
		
		if (!$reserve && !$updated){	
			$_SESSION['message']='No Reservations made!';
			die('Error: ' . mysql_error());
		}else{
			if($_SESSION['rescategory']=='Breakfast')
				$_SESSION['resmsg']="Successfully made a reservation. You need to get your item before 8:00am-10:00am or your reservation will expire. Please present the transaction number.";
			if($_SESSION['rescategory']=='Lunch')
				$_SESSION['resmsg']="Successfully made a reservation. You need to get your item before 10:00am-01:00pm or your reservation will expire. Please present the transaction number.";
			if($_SESSION['rescategory']=='Snacks')
				$_SESSION['resmsg']="Successfully made a reservation. You need to get your item before 8:00am-04:00pm or your reservation will expire. Please present the transaction number.";
			
			//echo $_SESSION['resmsg'];
			header('Location: /foodres/cust_reservelist.php');
		}		 
			
	}

?>

