<?php
	include('frs_admin.php');
	include('admin.php');
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
			 date_default_timezone_set('Asia/Manila');
			$curdate=urlEncode(date("Y-m-d"));

			$ret_items = mysql_query($tran_query);
			while($row = mysql_fetch_array($ret_items)){
			$p = $row['price'];
			$q = $row['quantity'];
			$totalp = $p * $q;
			if(strpos($row['date_time'],$curdate)!==false){
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
			$admin = new Admin();
			$income = $admin->report($adstall_no,$curdate);
			echo "<p class=in> Income generated for the day:".$income."</p>";
		
	}
?>
<style>
li#replink{
	background:#FC6;
}
p.in{
	text-align:center;
	font-family:"Century Gothic";
	font-weight:400;
	font-size:20px;
	color:#FFF;
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
	<div id=trans_info><h1>Today's Report</h1></div>
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
                
                
          