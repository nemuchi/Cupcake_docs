<?php
	include('frs_cashier.php');
	include('transaction.php');
	include('cashier.php');
	
	$cashier = new Cashier();
	
	if(isset($_POST['update'])){
		$stat = $_POST['stat'];
		$tno = $_POST['tno'];
		$sql = $cashier->updateTransaction($stat,$tno);
		$result = mysql_query($sql);
		if (!$result){ 
			die('Could not change status.' . mysql_error());
		}else{
			echo "<script>alert('The transaction has been  $stat!')</script>";
		}
		unset($_POST['update']);
	}
	
		$stall_no=$_SESSION['castall_no'];
 		date_default_timezone_set('Asia/Manila');
		$curdate=urlEncode(date("Y-m-d"));
		$curtime=strftime("%H:%M:%S");
	
		$trans = new Transaction();
		$tq = $trans->getStallTransaction($stall_no);
		$retq = mysql_query($tq);
		while($row = mysql_fetch_array($retq)){
			$tno=$row['transaction_no'];
			if(strpos($row['date_time'],$curdate)!==false){
				if($row['type']=='pending'&&$curtime>$row['end_time']){
					$sql = $cashier->updateTransaction('canceled',$tno);
					$result = mysql_query($sql);
					echo "<script>alert('The transaction $tno has already expired! The status has been canceled.')</script>";
				}
			}
		}


	function dispTran(){
		$stall_no=$_SESSION['castall_no'];
		$curdate=urlEncode(date("Y-m-d"));
		$trans = new Transaction();
		if(isset($_POST['search'])){
			$transsearch = $_POST['transsearch'];
			$tran_query = mysql_query("SELECT *
								FROM user u, item i, transaction t, customer c, stall s
								WHERE u.user_id=c.user_id and i.item_no=t.item_no and t.cust_no=c.cust_no and i.stall_no=s.stall_no and s.stall_no='$stall_no'
								and transaction_no='$transsearch' LIMIT 0,30");
			unset($_POST['search']);
		}else{
			$transq = $trans->getStallTransaction($stall_no);
			$tran_query = mysql_query($transq);
		}
		while($row = mysql_fetch_array($tran_query)){
			if(strpos($row['date_time'],$curdate)!==false){
				$p = $row['price'];
				$q = $row['quantity'];
				$totalp = $p * $q;
				echo "<tr id='trtable' bgcolor=#CCC>";
				echo "<td>".$row['transaction_no']."</td>";
				echo "<td>".$row['fname'].' '.$row['mname'].' '.$row['lname']."</td>";
				echo "<td>".$row['category']."</td>";
				echo "<td>".$row['item_name']."</td>";
				echo "<td>".$row['quantity']."</td>";
				echo "<td>".$totalp."Php</td>";
				echo "<td>".$row['type']."</td>";
				echo "<td><a href='cashier_viewTransaction.php?action=update&tno=".$row['transaction_no']."'>Update</a></td>";
				echo "</tr>";
			}
		}
	}	
?>
<style>
li#translink{
	background:#FC6;
}

#transaction{
	width:800px;
	min-height:400px;
	border-left:thin solid #CCC;
	border-right:thin solid #CCC;
	margin:0;
	padding:10px;
	/*display:none;*/
}

#trans_info h1{
	text-align:center;
	font-family:"Century Gothic";
	font-weight:400;
	font-size:30px;
	color:#900;
	margin:5px;
	padding:0;
}
#trans_info h2{
	text-align:center;
	font-family:"Century Gothic";
	font-weight:400;
	font-size:20px;
	color:#900;
	margin:0;
	padding:0;
}

#trans_links {
	background:#FFF;
	margin-top:10px;;
	padding:10px 0;
}

#trans_links #search_form{
	font-family:"Century Gothic";
	font-weight:400;
	font-size:14px;
	color:#900;
}

/********************/
#transaction #trans_list{
	margin:0;
	padding-top:10px;
}

#transaction #trans_table{
	background:#900;
	/*width:800px;*/
}

#transaction #trans_table table{
	background:#FFF;
}

#transaction #trans_table th{
	background:#68020A;
	font-family:"Century Gothic";
	font-weight:400;
	font-size:14px;
	color:#FFF;
	text-align:center;
	padding:2px;
}

#transaction #trans_table td{
	font-family:"Century Gothic";
	font-weight:400;
	font-size:12px;
	color:#000;
	text-align:center;
	padding:5px;
}

#transaction #trans_table td a{
	text-decoration: none;
	text-align:center;
	color:#333;
}

#transaction #trans_table td a:hover{
	color:#930;
}

#transaction #trans_table table tr#trtable:hover{
	background:#FC6;
}
/****************/
#upform{
	padding:20px;
	text-align:center;
}
/****************/
#search_form{
	padding:5px;;
	margin:0 auto; 
}

input{   
    padding: 6px;  
    border: solid 1px #900;  
    outline: 0;  
    font-family: 'Century Gothic';  
    background: #FFFFFF;  
    box-shadow: #FC3 0px 0px 3px;  
    -moz-box-shadow: #FC3 0px 0px 3px;  
    -webkit-box-shadow: #FC3 0px 0px 3px;  
	
	border-radius:5px;
    -moz-border-radius: 5px;  
    -webkit-border-radius: 5px;  

}  
 
select,option {   
    padding: 1px;  
    border: solid 1px #900;  
    outline: 0;
	font-size:12px;  
    font-family: 'Century Gothic';  
    background: #FFFFFF;  
    box-shadow: #CCC 0px 0px 3px;  
    -moz-box-shadow: #CCC 0px 0px 3px;  
    -webkit-box-shadow: #CCC 0px 0px 3px;  
}  
  
input:hover,input:focus{   
    border: solid 1px #900;  
    -webkit-box-shadow: #900 0px 0px 4px;  
}  
   
.submit input {  
    width: auto;  
    background: #FFF;  
    font-size: 16px;  
    color: #FFFFFF;  
	border-radius:5px;
    -moz-border-radius: 5px;  
    -webkit-border-radius: 5px;  
}
</style>

<div id=transaction>
	<div id=trans_info><h1>Today Transactions</h1> <br /><h2>Date: <b><?php echo date("M d,Y");?></b> Time: <span id=curTime></span></h2></div>
    	<div id=search_form>
   		<form action=cashier_viewTransaction.php method=post>
            <input type=text name=transsearch placeholder='Enter Transaction No.' size=35/>
            <input type=submit name=search value=Search />
		</form> 
    	</div>
    <div id=trans_list>
		<div id=trans_table>			
			<table cellpadding=2 cellspacing=1>
				<tr>
                	<th width="200">Transaction No.</th>
                	<th width="200">Customer Name</th>
					<th width="100">Category</th>
					<th width="200">Item Name</th>
					<th width="50">Quantity</th>
					<th width="50">Total Price</th>
					<th width="120">Status of Transaction</th>
					<th width="50">Action</th>
			    </tr>
                <?php  
					dispTran();		
				 ?> 
             </table>               
        </div>
      <?php
	  	if(@$_REQUEST['action']=='update'){
			$tno=@$_REQUEST['tno'];
			echo "<div id=upform><form action=cashier_viewTransaction.php method=post>
				<select name=stat>
				<option value=completed>Completed</option>
				<option value=canceled>Canceled</option>
				<option value=pending>Pending</option>
				</select>
				<input name=tno type=hidden value=".$tno.">
				<input name=update type=submit value=Update>
			  </form></div>
		";
		}
	  ?>
    </div>      
                
                
          