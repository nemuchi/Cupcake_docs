<?php
	include('frs_customer.php');
	include('transaction.php');
	include('users.php');

	function viewTran(){
		$user_id = $_SESSION['user_id'];

		$cust = new Customer();
		$cust->setCustomer($user_id);

		$trans = new Transaction();
		$tran_query = $trans->getCusTransaction($cust->getCustNo());
		$ret_trans = mysql_query($tran_query) or die('Cannot query!');
		while($row = mysql_fetch_array($ret_trans)){
			$p = $row['price'];
			$q = $row['quantity'];
			$totalp = $p * $q;
			$cashier = new Cashier();
			$cashier->setUser($row['cash_id']);
				echo "<tr>";
				echo "<td>".$row['transaction_no']."</td>";
				echo "<td>".$row['stall_name']."</td>";
				echo "<td>".$cashier->getFname()." ".$cashier->getLname()."</td>";
				echo "<td>".$row['category']."</td>";
				echo "<td>".$row['item_name']."</td>";
				echo "<td>".$row['quantity']."</td>";
				echo "<td>".$totalp." Php</td>";
				echo "<td>".$row['date_time']."</td>";
				echo "<td>".$row['type']."</td>";
				echo "</tr>";
			}
		
	}
?>

<style>
li#accountlink{
	background:#FC6;
}

#welcome {
	width: 800px;
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
	font-size:35px;
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
/****************/
#customer{
	width:800px;
	padding:10px;
	margin:0px;
}

#customer #cust_info{
	clear:both;
	padding:10px;
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
#trans_list{
	margin:0;
	padding-top:10px;
}

#trans_table{
	background:#900;
	width:800px;
}

#trans_table table{
	background:#FFF;
}

#trans_table th{
	background:#68020A;
	font-family:"Century Gothic";
	font-weight:400;
	font-size:14px;
	color:#FFF;
	text-align:center;
	padding:5px;
}

#trans_table td{
	background:#CCC;
	font-family:"Century Gothic";
	font-weight:400;
	font-size:12px;
	color:#000;
	text-align:center;
	padding:3px;
}

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
        <li><a id=profile href=cust_account.php>Profile</a></li>
        <li><a id=viewtran href=cust_viewTransaction.php>View Transactions</a></li>
        </ul>    
    </div>
    <div id=cust_info> 
    <div id=trans_list>	
		<div id=trans_table>			
			<table cellpadding=2 cellspacing=1>
				<tr>
                	<th width=120>Transaction No.</th>
                	<th width=120>Stall</th>
                	<th width=120>Cashier</th>
					<th width=100>Category</th>
					<th width=100>Item</th>
					<th width=50>Quantity</th>
					<th width=50>Total Price</th>
					<th width=150>Date of Reservation</th>
					<th width=80>Status of Transaction</th>
			    </tr>
                <?php  
					viewTran();		
				 ?> 
             </table>               
        </div>
    </div>      
    </div>
</div>
</div>
</div>

