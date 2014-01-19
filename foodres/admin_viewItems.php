<?php
	include('frs_admin.php');
	include('admin.php');
	include('owns.php');
	include('stall.php');
	include('item.php');
	if(isset($_SESSION['message'])){
		$msg = $_SESSION['message'];
		echo "<script>alert('$msg')</script>";
		unset($_SESSION['message']);
	}
	
	$aduser_id = $_SESSION['user_id'];
	$admin = new Admin();
	$admin->setAdmin($aduser_id);
	$adno=$admin->getAdminNo();
	$owns = new Owns();
	$owns->setOwns($adno);
	$stall_no = $owns->getStallNo();
	$adstall = new Stall();
	$adstall->setStall($stall_no);
		
		$_SESSION['adstall_no']=$stall_no;
		$_SESSION['adstall_name']=$adstall->getStallName();
	
	if(@$_REQUEST['action']=='delete'){	
		$item_no = $_REQUEST['item_no'];
		$sql = $admin->deleteItem($item_no);
		$result = mysql_query($sql);
		if (!$result){ 
			echo "<script>alert('Cannot delete the item. There is something wrong in deleting the item.')</script>";
		}else{
			echo "<script>alert('The item was successfully deleted. It had been removed from the list.')</script>";
		}
	}
	
	function dispItems(){
		$adstall_no=$_SESSION['adstall_no'];
		$items = new Item();
		$category = @$_REQUEST['cat'];
		if(isset($_POST['search'])){
			$item_src = $_POST['item'];
			$item = new Item();
			$all_items = $item->srcItem($item_src);
		}else{
			$all_items=$items->getItems($adstall_no);
		}
			$ret_items = mysql_query($all_items) or die('Cannot query!');
		while($row = mysql_fetch_array($ret_items)){
			$_SESSION['adcategory']=$row['category'];
			$_SESSION['aditem_no']=$row['item_no'];
			$_SESSION['aditem_name']=$row['item_name'];
			$_SESSION['adno_servings']=$row['no_servings'];
			$_SESSION['adprice']=$row['price'];
			$_SESSION['adslotsForRes']=$row['slotsForRes'];
			$_SESSION['adstatusForRes']=$row['statusForRes'];

			if($category==$row['category'] and $row['stall_no']==$adstall_no){
				$items->setItem($row['item_no']);
				echo "<tr id=trhover bgcolor=#FC6>";
				echo "<td width=200>".$items->getCategory()."</td>";
				echo "<td width=200>".$items->getItemName()."</td>";
				echo "<td width=200>".$items->getNoServings()."</td>";
				echo "<td width=200>".$items->getPrice()." Php </td>";
				echo "<td width=200>".$items->getSlotsForRes()."</td>";
				echo "<td width=200>".$items->getStatusForRes()."</td>";
				echo "<td width=100><a onclick=\"return confirm('Are you sure to delete item ".$row['item_name']." and all its details?');\" href='admin_viewItems.php?cat=".@$_REQUEST['cat']."&action=delete&item_no=".$row['item_no']."'>Delete</a></td>
				 <td width=100><a href='admin_updateItem.php?action=update&item_no=".$row['item_no']."'>Update</a></td>";
				echo "</tr>";
			}else if($category=='all' or $category=='' and $row['stall_no']==$adstall_no){
				echo "<tr id=trhover bgcolor=#FC6>";
				echo "<td width=200>".$row['category']."</td>";
				echo "<td width=200>".$row['item_name']."</td>";
				echo "<td width=200>".$row['no_servings']."</td>";
				echo "<td width=200>".$row['price']." Php </td>";
				echo "<td width=200>".$row['slotsForRes']."</td>";
				echo "<td width=200>".$row['statusForRes']."</td>";
				echo "<td width=90><a onclick=\"return confirm('Are you sure to delete item ".$row['item_name']." and all its details?');\" href='admin_viewItems.php?cat=".@$_REQUEST['cat']."&action=delete&item_no=".$row['item_no']."'>Delete</a></td>
				 <td width=90><a href='admin_updateItem.php?action=update&item_no=".$row['item_no']."'>Update</a></td>";
				echo "</tr>";
			}
		}
		echo "</table>";
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
	padding:10px;
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

#canteen_stall #item_links {
	float:left;
	margin:0;
	padding:0;
}

#canteen_stall #item_links a{
	text-decoration: none;
	color: #900;
	font-family: 'Century Gothic';
	font-size:18px;
	margin:0;
	padding:0;
}
#canteen_stall #item_links a:hover{
	color:#666;
	text-decoration:underline;
}

#canteen_stall #item_links ul{
	list-style:none;	
	
	margin:0;
	padding:0;
}

#canteen_stall #item_links li{
	margin: 0px;
	padding:5px;
	display: inline;	
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
	width:784px;
	/*height:450px;*/
	/*margin-left:20px;*/	
}

#canteen_stall #stall_table table{
	background:#500;
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
	
tbody {
	width:800px;
    max-height: 300px;
    overflow: auto;
}

thead > tr, tbody{
    display:block;}

#canteen_stall #stall_table td{
	font-family:"Century Gothic";
	font-weight:400;
	font-size:12px;
	color:#900;
	text-align:center;
	padding-left:3px;
}

#canteen_stall #stall_table td a{
	text-decoration: none;
	text-align:center;
	color:#333;
}

#canteen_stall #stall_table td a:hover{
	color:#930;
}

#canteen_stall #stall_table tr#trhover:hover{
	background:#FC3;
}
/****************/

#search_form{
	float:right;
	padding:5px;;
	margin:0; 
}

input{  
	margin:0; 
    padding: 4px;  
    font-family: 'Century Gothic';  
    background: #FFFFFF;  
    box-shadow: #FC3 0px 0px 3px;  
    -moz-box-shadow: #FC3 0px 0px 3px;  
    -webkit-box-shadow: #FC3 0px 0px 3px;  
	
	border-radius:5px;
    -moz-border-radius: 5px;  
    -webkit-border-radius: 5px;  

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

<div id=canteen_stall>
	<div id=canteen_info><h1><?php echo $_SESSION['adstall_name'];?></h1></div>
    <div id=item_links>
    	<ul>
        <li><a href=admin_addItem.php>Add Item</a></li>
        <li><a href=admin_viewItems.php>View Items</a></li>
        </ul>
    </div>
    <div id=search_form>
    	<form action='admin_viewItems.php' method=post>
         		<input type=text name=item placeholder='Enter Item' size=25/>
           		<input type=submit name=search value=Search />
    	</form> 
    </div>
   

    <div id=stall_item>
       	<div id=stall_link>
		 	<ul>
            	<li id=clink><a href='admin_viewItems.php?cat=all'>All Items</a></li>
            	<li id=clink><a href='admin_viewItems.php?cat=Breakfast'>Breakfast</a></li>
            	<li id=clink><a href='admin_viewItems.php?cat=Lunch'>Lunch</a></li>
            	<li id=clink><a href='admin_viewItems.php?cat=Snacks'>Snacks</a></li>
         	</ul>
		</div>	
		<div id=stall_table>			
			<div id=tbhead>
            <table class=sieve cellpadding=2 cellspacing=1>
            <thead>
				<tr>
                	<th width=110 >Category</th>
					<th width=120>Item Name</th>
					<th >No. of Servings</th>
					<th width=100>Price per Servings</th>
					<th >Reservation Slots</th>
					<th width=100>Status of Reservation</th>
                    <th width=200 colspan=2>Action</th>
			    </tr>
             </thead>
             <tbody>
                <?php  
					dispItems();		
				 ?> 
             </tbody>
             </table>
            </div>
                            
        </div>
    </div>      
</div>

</div>
</div>            
                
          