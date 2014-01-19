<?php
	include('frs_cashier.php');
	include('cashier.php');
	include('item.php');
	$casuser_id = $_SESSION['user_id'];
	$cashier = new Cashier();
	$cashier->setUser($casuser_id);
	$cashier->setCashier($casuser_id);
	$cas= "SELECT * FROM cashier c inner join stall s inner join admin a inner join owns o WHERE a.admin_no=o.admin_no AND s.stall_no=o.stall_no and c.cashier_no=a.cashier_no and c.user_id='$casuser_id'";
	$casquery = mysql_query($cas);
	while($row = mysql_fetch_array($casquery)){
		$_SESSION['castall_no']=$row['stall_no'];
		$_SESSION['castall_name']=$row['stall_name'];
	}
	
	function dispItems(){
		$castall_no=$_SESSION['castall_no'];
		$category = @$_REQUEST['cat'];
		$items = new Item();
	  	if(@$_REQUEST['cat']==''){ 
			$all_items=$items->getItemCustCashier('Breakfast',$castall_no);
		}else{
			$all_items=$items->getItemCustCashier($category,$castall_no);
		}
		$ret_items = mysql_query($all_items);
		
		while($row = mysql_fetch_array($ret_items)){
		echo "<tr id=result bgcolor=#FC6>";
		echo "<td>".$row['category']."</td>";
		echo "<td>".$row['item_name']."</td>";
		echo "<td>".$row['no_servings']."</td>";
		echo "<td>".$row['price']." Php </td>";
		echo "<td>".$row['slotsForRes']."</td>";
		echo "<td>".$row['statusForRes']."</td>";
		echo "</tr>";
		}
	}
?>

<style>
li#itemlink{
	background:#FC6;
}

#canteen_stall{
	width:800px;
	min-height:400px;
	border-left:thin solid #CCC;
	border-right:thin solid #CCC;
	margin:0;
	padding:8px;
	/*display:none;*/
}

#canteen_info h1{
	font-family:"Segoe Script";
	font-weight:400;
	font-size:50px;
	color:#900;
	margin:0;
	padding:0;
}

#canteen_info p{
	font-family:"Century Gothic";
	font-weight:400;
	font-size:20px;
	color:#900;
	margin:0;
	padding:0;
}


/********************/
#canteen_stall #stall_item{
	
}

#canteen_stall #stall_link{
	float:left;
	width:800px;
}

#canteen_stall #stall_link ul{
	list-style:none;
}

#canteen_stall #stall_link a{
	font-family:'Century Gothic';
	font-size:12px;
	text-decoration: none;
	color:#FFF;
}

#canteen_stall #stall_link li{
	background:#FC3;
	float:left;
	padding:3px 10px;
	border-left:1px solid #FFF;
	
	border-radius: 15px 15px 0px 0px;
	-moz-border-radius: 15px 15px 0px 0px;
	-webkit-border-radius: 15px 15px 0px 0px;

}
#canteen_stall #stall_link li:hover{
	background:#900;
}
#canteen_stall #stall_table{
	width:800px;
	magrin:auto;
	/*height:450px;*/
	/*margin-left:20px;*/	
}

#canteen_stall #stall_table table{
	background:#FFF;
	width:800px;
	margin:auto;
}

#canteen_stall #stall_table th{
	background:#68020A;
	font-family:"Century Gothic";
	font-weight:400;
	font-size:14px;
	color:#FFF;
	text-align:center;
	padding:5px;
}

#canteen_stall #stall_table td{
	font-family:"Century Gothic";
	font-weight:400;
	font-size:12px;
	color:#900;
	text-align:center;
	padding:5px;
}

#canteen_stall #stall_table td a{
	text-decoration: none;
	text-align:center;
	color:#333;
}

#canteen_stall #stall_table td a:hover{
	color:#930;
}

#canteen_stall #stall_table tr#result:hover{
	background:#FC3;
}
/****************/
</style>

<div id=canteen_stall>
<div id=canteen_info><h1><?php echo $_SESSION['castall_name'];?></h1>
<p>Cashier: 
	<?php
		echo $cashier->getFname()." ".$cashier->getLname();
	?>
</p>
</div>
   <div id=stall_item>
      <div id=stall_link>
		<ul>
           	<li id=clink><a href='cashier_viewItems.php?cat=breakfast'>Breakfast</a></li>
           	<li id=clink><a href='cashier_viewItems.php?cat=lunch'>Lunch</a></li>
           	<li id=clink><a href='cashier_viewItems.php?cat=snacks'>Snacks</a></li>
        </ul>
	</div>	
		<div id=stall_table>	
            <table cellpadding=2 cellspacing=1>
                <tr>
                <th>Category</th>
                <th>Item Name</th>
                <th>No. of Servings</th>
                <th>Price per Servings</th>
                <th>Reservation Slots</th>
                <th>Status of Reservation</th>
                </tr>
                <?php  
                dispItems();	
                ?> 
            </table>               
       </div>
   </div>      