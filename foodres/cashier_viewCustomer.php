<?php
	include('frs_cashier.php');
	
	function viewCus($cusno){
		$castall_no=$_SESSION['castall_no'];
			$cus = "SELECT DISTINCT u.fname,u.mname,u.lname,u.gender,u.address,u.phone,u.email,i.category,i.item_name,t.quantity,i.price,t.date_time,t.type
							FROM user u, item i, transaction t, customer c, stall s
							WHERE u.user_id=c.user_id and i.item_no=t.item_no and t.cust_no=c.cust_no and i.stall_no=s.stall_no and s.stall_no='$castall_no'
							and c.cust_no='$cusno'";
			$ret_cus = mysql_query($cus);
				echo "<div id=cust_info>";
			
			$fname;
			$mname;
			$lname;
			$gender;
			$address;
			$phone;
			$email;
			while($row = mysql_fetch_array($ret_cus)){
				$fname=$row['fname'];
				$mname=$row['mname'];
				$lname=$row['lname'];
				$gender=$row['gender'];
				$address=$row['address'];
				$phone=$row['phone'];
				$email=$row['email'];
			}
    			echo "<div id=cusimg>
  				      	<img src='img/profpic.gif'/>
 			       	</div>
	 			  	<table id=ac border=0 cellpadding=2 cellspacing=2>
						<tr>
							<td>Name</td>
							<td>: ".$fname." ".$mname." ".$lname."</td>
						</tr>
						<tr>
						<td>Gender</td>
						<td>: ".$gender."</td>
						</tr>
						<tr>
							<td>Address</td>
							<td>: ".$address."</td>
						</tr>
						<tr>
							<td>Phone</td>
							<td>: ".$phone."</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>: ".$email."</td>
						</tr>
						</table>
						</div>";
			
			echo "<div id=trans_list>	
					<div id=trans_table>			
					<table cellpadding=2 cellspacing=1>
					<tr>
						<th>Category</th>
						<th>Item Name</th>
						<th>Quantity</th>
						<th>Total Price</th>
						<th>Date of Reservation</th>
						<th>Status of Transaction</th>
					</tr>";
			
			$tran_query = "SELECT i.category,i.item_name,t.quantity,i.price,t.date_time,t.type
							FROM  item i, transaction t, customer c, stall s
							WHERE i.item_no=t.item_no and t.cust_no=c.cust_no and i.stall_no=s.stall_no and 
							c.cust_no='$cusno' and s.stall_no='$castall_no'";
			$ret_items = mysql_query($tran_query);
			while($row = mysql_fetch_array($ret_items)){
			$p = $row['price'];
			$q = $row['quantity'];
			$totalp = $p * $q;

				echo "<tr>";
				echo "<td>".$row['category']."</td>";
				echo "<td>".$row['item_name']."</td>";
				echo "<td>".$row['quantity']."</td>";
				echo "<td>".$totalp." Php</td>";
				echo "<td>".$row['date_time']."</td>";
				echo "<td>".$row['type']."</td>";
				echo "</tr>";
			}
			
			echo "</table>               
        		  </div>
   				  </div>";
	}
	
	function dispCustomer(){
		$castall_no=$_SESSION['castall_no'];
		$c_query;
		if(isset($_POST['search'])){
			$csearch = $_POST['csearch'];
			$c_query = "SELECT DISTINCT u.fname, u.mname, u.lname, c.cust_no
						FROM transaction t, customer c, cashier x, item i, user u, admin a, owns o, stall s
						WHERE a.cashier_no = x.cashier_no
						AND o.admin_no = a.admin_no
						AND o.stall_no = s.stall_no
						AND s.stall_no = o.stall_no
						AND u.user_id = c.user_id
						AND c.cust_no = t.cust_no
						AND x.cashier_no = t.cashier_no
						AND i.item_no = t.item_no
						AND s.stall_no='$castall_no'
						AND (
						u.fname LIKE  '%$csearch%'
						OR u.mname LIKE  '%$csearch%'
						OR u.lname LIKE  '%$csearch%'
						)";
		}else{
			$c_query = "select distinct u.fname, u.mname, u.lname,c.cust_no
						from transaction t, customer c, cashier x, item i, user u, admin a, owns o, stall s
						where a.cashier_no=x.cashier_no and o.admin_no=a.admin_no and o.stall_no=s.stall_no and s.stall_no=o.stall_no and
						u.user_id=c.user_id and c.cust_no=t.cust_no and x.cashier_no=t.cashier_no and i.item_no=t.item_no and s.stall_no='$castall_no'";
		}
			$ret_items = mysql_query($c_query);
			while($row = mysql_fetch_array($ret_items)){
				$fname=$row['fname'];
				$mname=$row['mname'];
				$lname=$row['lname'];
				echo "<tr id=result onClick=location.href='cashier_viewCustomer.php?cust_no=".$row['cust_no']."'>";
				echo "<td>".$fname." ".$mname." ".$lname."</td>";

			   $cc = "select count(cust_no) as tor from transaction where cust_no=".$row['cust_no'];
					$ret_cc = mysql_query($cc);
					$ct;
					while($row = mysql_fetch_array($ret_cc)){
						$ct = $row['tor'];
					}
				echo "<td>".$ct."</td>";
				echo "</tr>";
			}
		
	}

?>
<style>
li#translink{
	background:#FC6;
}

#customer{
	width:800px;
	min-height:400px;
	border-left:thin solid #CCC;
	border-right:thin solid #CCC;
	margin:0;
	padding:10px;
	/*display:none;*/
}
#cust_info h1{
	text-align:center;
	font-family:"Century Gothic";
	font-weight:400;
	font-size:30px;
	color:#900;
	margin:5px;
	padding:0;
}
#cust_info{
	clear:both;
	width:500px;
	margin:auto;
	padding:10px;
}

#cust_info #cusimg{
	float:right;
}

#cust_info #cusimg img{
	width:120px;
	height:150px;
}


#cust_info table{
	margin:0;
	padding-bottom:10px;
}

#cust_info table td{
	text-decoration: none;
	color: #900;
	font-family: 'Century Gothic';
	font-size:14px;
	margin:0;
	padding:5px;
}

#cust_links {
	background:#FFF;
	margin-top:10px;;
	padding:10px 0;
}

#cust_links #search_form{
	font-family:"Century Gothic";
	font-weight:400;
	font-size:14px;
	color:#900;
	text-align:center;
}

/********************/
#customer #cust_list{
	margin:0;
	padding-top:10px;
}

#customer #cust_list #cust_table{
	margin:auto;
}

#customer #cust_list #cust_table table{
	background:#FFF;
	margin:auto;
}

#customer #cust_list #cust_table th{
	background:#68020A;
	font-family:"Century Gothic";
	font-weight:400;
	font-size:14px;
	color:#FFF;
	text-align:center;
	
	width:200px;
	padding:2px;
}

#customer #cust_list #cust_table td{
	background:#CCC;
	font-family:"Century Gothic";
	font-weight:400;
	font-size:12px;
	color:#000;
	text-align:center;
	
	width:200px;
	padding:3px;
}

#customer #cust_list #cust_table td a{
	text-decoration: none;
	text-align:center;
	color:#333;
}

#customer #cust_list #cust_table td a:hover{
	color:#930;
}

#cust_table  tr#result:hover{
	background: #FC6 !important;	
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
/****************/
/********************/
#trans_list{
	margin:0;
	padding-top:10px;
}

#trans_table{
	width:700px;
	margin:auto;

}

#trans_table table{
	margin:auto;
	background:#FFF;
}

#trans_table th{
	background:#68020A;
	font-family:"Century Gothic";
	font-weight:400;
	font-size:12px;
	color:#FFF;
	text-align:center;
	padding:3px;
}

#trans_table td{
	background:#FC3;
	font-family:"Century Gothic";
	font-weight:400;
	font-size:10px;
	color:#000;
	text-align:center;
	padding:3px;
}

</style>

<div id=customer>
	<div id=cust_info><h1><?php echo $_SESSION['castall_name'];?>' Customers</h1></div>
    <div id=cust_links>
    	<div id=search_form>
   		<form action=admin_viewCustomer.php method=post>
            <input type=text name=csearch placeholder='Enter Customer Name' size=40/>
            <input type=submit name=search value=Search />
		</form> 
    	</div>
   <div id=cust_list>	
		<div id=cust_table>			
			<table cellpadding=2 cellspacing=1>
				<tr>
                	<th>Customer Name</th>
					<th>No. of Transactions Made</th>
			    </tr>
                <?php dispCustomer(); ?>
             </table>               
        </div>
    </div> 
    <div id=cusProfile>
    	<?php
			if(@$_REQUEST['cust_no']){
				$cusno = $_REQUEST['cust_no'];
				viewCus($cusno);
			}
		?>
    </div>