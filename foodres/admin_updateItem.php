<?php
	include('frs_admin.php');
	include('item.php');
	
	if(@$_REQUEST['action']=='update'){	
		$_SESSION['upaditem_no'] = @$_REQUEST['item_no'];
		$adstall_no=$_SESSION['adstall_no'];
		$item = new Item();
		$item->setItem($_REQUEST['item_no']);
		//"SELECT * FROM item WHERE stall_no='$adstall_no' and item_no =".$_REQUEST['item_no'];
			$_SESSION['upaditem_name']=$item->getItemName();
			$_SESSION['upadno_servings']=$item->getNoServings();
			$_SESSION['upadprice']=$item->getPrice();
			$_SESSION['upadslotsForRes']=$item->getSlotsForRes();
	}

?>

<style>
li#itemlink{
	background:#FC6;
}

#canteen_stall{
	width:600px;
    /*border:2px solid red;*/
	padding: 10px;
	/*display:none;*/
}

#canteen_info h1{
	margin:0;
	padding:0;
	
	font-family: "Century Gothic";
	font-size:26px;
	color: #900;
}

#canteen_stall #item_links {
	background:#FFF;
	padding:0;
}

#canteen_stall #item_links a{
	text-decoration: none;
	color: #900;
	font-family: 'Century Gothic';
	font-size:16px;
	
	margin:0;
	padding:0;
}

#canteen_stall #item_links ul{
	list-style:none;	
	margin:0;
	padding:0;
}

#canteen_stall #item_links li{
	margin: 0px;
	padding:5px;
	display:inline;
	
}

/********************/

#canteen_stall #item_add{
	background:#FFF;
	width:600px;
	margin:auto;
	padding:0;
}

#canteen_stall #item_add #add_form{
	background:#FFF;
	margin:0;
	padding:20px;
}

#canteen_stall #item_add th{
	background:;
	font-family:"Century Gothic";
	font-weight:400;
	font-size:14px;
	color:#900;
	text-align:left;
	
	width:200px;
	padding:2px;
}

#canteen_stall #item_add td{
	background:;
	font-family:"Century Gothic";
	font-weight:400;
	font-size:12px;
	color:#900;
	text-align:center;
	
	width:200px;
	padding:3px;
}

/****************/
input {   
    padding: 9px;  
    border: solid 1px #900;  
    outline: 0;  
    font: normal 13px/100% Verdana, Tahoma, sans-serif;  
    background: #FFFFFF;  
    box-shadow: #900 0px 0px 4px;  
    -moz-box-shadow: #900 0px 0px 4px;  
    -webkit-box-shadow: #900 0px 0px 4px;  
    }  
  
  
input:hover,input:focus{   
    border-color: #C9C9C9;   
    -webkit-box-shadow: rgba(0, 0, 0, 0.15) 0px 0px 4px;  
    }  
  
.form label {   
    margin-left: 10px;   
    color: #999999;   
    }  
  
.submit input {  
    width: auto;  
    background: #FFF;  
    border: 0;  
    font-size: 14px;  
    color: #FFFFFF;  
    -moz-border-radius: 5px;  
    -webkit-border-radius: 5px;  
    }  

</style>

<div id=canteen_stall>
	<div id=canteen_info><h1><?php echo $_SESSION['adstall_name'];?></h1></div>
    <div id=item_add>
		<div id=add_form>
        	<form action="updateItemForm.php" method="post">
            	<table cellpadding=3 cellspacing=0>
	 				<tr>
                    	<th>Item Name</th>
                        <td>: <input type="text" name="item_name" value="<?php echo $_SESSION['upaditem_name']; ?>" placeholder="<?php echo $_SESSION['upaditem_name']; ?>"/></td>
                    </tr>
                    <tr>
                    	<th>Number of Servings</th>
                        <td>: <input type="text" name="no_servings" value="<?php $_SESSION['upadno_servings'];?>" placeholder="<?php echo $_SESSION['upadno_servings']; ?>"/></td>
                    </tr>
                    <tr>
                    	<th>Price per Servings</th>
                        <td>: <input type="text" name="price"  value="<?php echo $_SESSION['upadprice']; ?>" placeholder="<?php echo $_SESSION['upadprice']; ?>"/></td>
                    </tr>
                    <tr>
                    	<th>Slots for Reservation</th>
                        <td>: <input type="text" name="slotsForRes"  value="<?php echo $_SESSION['upadslotsForRes']; ?>" placeholder="<?php echo $_SESSION['upadslotsForRes']; ?>" /></td>
                    </tr>
                    <tr>
                    	<th><label>Availability of Reservation</label></th>
                        <td><select name=statusForRes>
                        	<option value=Available>Available</option>
                            <option value='Not Available'>Not Available</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                    	<td></td>
                        <td><input type="submit" name="update" value="Update Item"/></td>
                    </tr>                        
            </form>	
        </div>
   </div>
    
</div> 
</div>
</div>