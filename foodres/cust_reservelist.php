<?php
	include('frs_customer.php');
	include('transaction.php');
	include('customer.php');
	if(!empty($_SESSION['resmsg'])&&isset($_SESSION['resmsg'])){
		$mes = $_SESSION['resmsg'];
		echo "<script>alert('$mes')</script>";
		$_SESSION['resmsg']=null;
	}
	
	if(@$_REQUEST['action']=='cancel'){	
		$tno = @$_REQUEST['tno'];
		$customer = new Customer();
		$sql = $customer->cancelTransaction($tno);
		$result = mysql_query($sql);
		if (!$result) 
			die('Could not change status.' . mysql_error());
		
	}
	function dispTran(){
		$cust_no=$_SESSION['cust_no'];
		$trans = new Transaction();
		$tran_query = $trans->getCusTransaction($cust_no);
		$ret_trans = mysql_query($tran_query);
		while($row = mysql_fetch_array($ret_trans)){
			$tn = $row['transaction_no'];
			$p = $row['price'];
			$q = $row['quantity'];
			$totalp = $p * $q;
			$trans->setTransaction($row['transaction_no']);
			if($trans->getType()=='pending'){
				$cashier = new User();
				$cashier->setUser($row['cash_id']);
				
				echo "<tr>";
				echo "<td>".$row['transaction_no']."</td>";
				echo "<td>".$row['date_time']."</td>";
				echo "<td>".$row['stall_name']."</td>";
				echo "<td>".$cashier->getFname()." ".$cashier->getLname()."</td>";
				echo "<td>".$row['category']."</td>";
				echo "<td>".$row['item_name']."</td>";
				echo "<td>".$row['quantity']."</td>";
				echo "<td>".$totalp."Php</td>";
				echo "<td>".$row['end_time']."</td>";
				echo "<td>".$row['type']."</td>";
				echo "<td><a onclick=\"return confirm('Are you sure to cancel your reservation?');\" href='cust_reservelist.php?action=cancel&tno=".$tn."&qnty=".$q."'>Cancel</a></td>";
				echo "</tr>";
	
			}
		}
	}	
?>

<style>
li#listlink{
	background:#FC6;
}

#itemlist {
	width:800px;
}

#itemlist h3{
	font-family:"Century Gothic";
	font-weight:400;
	font-size:26px;
	color:#900;
	text-align:center;
}

#itemlist #list_table{
	background:#900;
	width:800px;
	margin: auto;
	/*height:450px;*/
	/*margin-left:20px;*/	
}

#itemlist #list_table table{
	background:#FFF;
	margin:auto;
}

#itemlist #list_table th{
	background:#900;
	font-family:"Century Gothic";
	font-weight:400;
	font-size:14px;
	color:#FFF;
	text-align:center;
	padding:5px;
}

#itemlist #list_table td{
	background:#FC3;
	font-family:"Century Gothic";
	font-weight:400;
	font-size:12px;
	color:#900;
	text-align:center;
	padding:3px;
}

#itemlist #list_table td a{
	text-decoration: none;
	text-align:center;
	color:#900;
}
#itemlist #list_table td a:hover{
	color:#606;
}
/****************/
</style>

<div id=reservelist>
<div id=itemlist>	        	
<h3><?php echo $_SESSION['lname']?>'s Reservation List</h3>					
		<div id=list_table>
			<table cellpadding=2 cellspacing=1>
				<tr>
                	<th width=100>Transaction No.</th>
                    <th width=150>Date and Time</th>
                	<th width=100>Stall</th>
                	<th width=100>Cashier</th>
					<th>Category</th>
					<th width=120>Item</th>
					<th>Quantity</th>
					<th>Total Price</th>
                    <th>Time</th>
					<th>Status of Transaction</th>
                    <th>Action</th>
			    </tr>
                <?php  
					dispTran();		
				 ?> 
             </table>               
        </div>
    </div>  


</div>