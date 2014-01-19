<?php
	include('frs_customer.php');
	include('item.php');
	include('stall.php');
	if(@$_REQUEST['action']=="res"){
		$_SESSION['resitem_no']=@$_REQUEST['itemid'];
		$itemid =@$_REQUEST['itemid'];
		$stall_no=$_SESSION['stall_no'];
		
		$item = new Item();
		$item->setItem($itemid);
		$i_stallno = $item->getStallNo();	
		$stall = new Stall();
		$stall->setStall($stall_no);
		if($i_stallno==$stall_no){
			$_SESSION['resstall_name']=$stall->getStallName();
			$_SESSION['rescategory']=$item->getCategory();	
			$_SESSION['resitem_name']=$item->getItemName();
			$_SESSION['resno_servings']=$item->getNoServings();	
			$_SESSION['resprice']=$item->getPrice();	
			$_SESSION['resslotsForRes']=$item->getSlotsForRes();
			$_SESSION['resstatusForRes']=$item->getStatusForRes();	
			$_SESSION['resstart_time']=$item->getStartTime();	
			$_SESSION['resend_time']=$item->getEndTime();	
		}
	}
	
?>
<style>
li#stalllink{
	background:#FC6;
}

#reserve{
}

#reserve h1{
	font-family:"Segoe Script";
	font-weight:400;
	font-size:50px;
	color:#900;
	margin:0;
	padding:0;
}

#reserve #form{
	padding:5px;
}
#reserve #form th{
	font-family:"Century Gothic";
	font-size:18px;
	color:#900;
	padding:3px;
	text-align:left;
}
#reserve #form td{
	font-family:"Century Gothic";
	font-weight:400;
	font-size:16px;
	color:#900;
	padding:3px;
}

#reserve #form p{
	margin:0;
	padding-left:5px;
}
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
	
	border-radius:10px;
    -moz-border-radius: 10px;  
    -webkit-border-radius: 10px;  

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
    -moz-border-radius: 10px;  
    -webkit-border-radius: 10px;  
}
/****************/
</style>


<div id="reserve">
	<h1>Make a Reservation</h1>
    <div id="form">
        <form action="reserveItemForm.php" method="post">
        <table cellpadding=3 cellspacing=0>
        <tr>
        	<th>Stall Name</th>
            <td><p>:  <?php echo $_SESSION['resstall_name'];?></p></td>
        </tr>

        <tr>
        	<th>Category</th>
            <td><p>:  <?php echo $_SESSION['rescategory'];?></p></td>
        </tr>
        <tr>
            <th>Item Name</th>
            <td><p>:  <?php echo $_SESSION['resitem_name'];?></p></td>
        </tr>
        <tr>
            <th>No. of Servings</th>
            <td><p>:  <?php echo $_SESSION['resno_servings'];?></p></td>
        </tr>
        <tr>    
            <th>Price</th>
            <td><p>: <?php echo $_SESSION['resprice'];?></p></td>
         </tr>
        <tr>   
            <th>Slots for Reservation</th>
            <td><p>:  <?php echo $_SESSION['resslotsForRes'];?></p></td>
         </tr>
        <tr>   
            <th>Status for Reservation</th>
            <td><p>:  <?php echo $_SESSION['resstatusForRes'];?></p></td>
         </tr>
        <tr>   
            <th>Time before Reservation expires</th>
			<td>: <?php 
					$st = ($_SESSION['resstart_time']);
					$et = ($_SESSION['resend_time']);
					echo $st."-".$et;
					?></td>
        </tr>
        <tr>
        <th>Quantity/No. of Servings to Reserve</th>
        <td>: <input type="text" name="quantity"  value=1 placeholder="1" size=5/></td>
        </tr>
        <tr>
            <td><input type="submit" name="reserve" value="Reserve Item"/></td>
        </tr>
        </table>
        </form>
    </div> 
</div>



