<?php
	include('frs_admin.php');
	include('transaction.php');
	function dispTran(){
		$adstall_no=$_SESSION['adstall_no'];
		$tran = new Transaction();
		$tran_query;
		if(isset($_POST['search'])){
			$transsearch = $_POST['transsearch'];
			$acsearch = $_POST['acsearch'];
			$statsearch = $_POST['statsearch'];
			$tran_query = $tran->getfilterTransaction($adstall_no,$acsearch,$transsearch,$statsearch);
			unset($_POST['search']);
		}else{
			$tran_query = $tran->getStallTransaction($adstall_no);
		}
			$ret_items = mysql_query($tran_query);
			while($row = mysql_fetch_array($ret_items)){
			$p = $row['price'];
			$q = $row['quantity'];
			$totalp = $p * $q;
				echo "<tr id=result bgcolor=#CCC>";
				echo "<td>".$row['transaction_no']."</td>";
				echo "<td>".$row['fname'].$row['mname'].$row['lname']."</td>";
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
	width:800px;
	margin:auto;
}

#transaction #trans_table table{
	background:#FFF;
	width:800px;
	margin:auto;
}

#transaction #trans_table th{
	background:#68020A;
	font-family:"Century Gothic";
	font-weight:400;
	font-size:14px;
	color:#FFF;
	text-align:center;
	padding:5px;
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

#transaction #trans_table tr#result:hover{
	background:#FC6;
}

/****************/
/****************/
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
	<div id=trans_info><h1>History of Transactions</h1></div>
    <div id=trans_links>
    	<div id=search_form>
   		<form action=admin_viewTransaction.php method=post>
 		    According to:
                <select name=acsearch>
                <option value=tall>All</option>
                <option value=tdate>Date of Transaction</option>
                <option value=tcat>Item Category</option>
                </select>
            <input type=text name=transsearch placeholder='Search Transactions' size=35/>
            <input type=submit name=search value=Search />
            Transaction Status:   
                <select name=statsearch>
                <option value=statall>All</option>
                <option value=completed>Completed</option>
                <option value=pending>Pending</option>
                <option value=canceled>Canceled</option>
                </select>
		</form> 
    	</div>
    </div>
    <div id=trans_list>	
		<div id=trans_table>			
			<table cellpadding=2 cellspacing=1>
				<tr>
                	<th>Transaction No.</th>
                	<th>Customer Name</th>
					<th>Category</th>
					<th>Item Name</th>
					<th>Quantity</th>
					<th>Total Price</th>
					<th>Date of Reservation</th>
					<th>Status of Transaction</th>
			    </tr>
                <?php  
					dispTran();		
				 ?> 
             </table>               
        </div>
    </div>      
                
                
          