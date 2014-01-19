<?php
	include('frs_cashier.php');

	
$all = "SELECT i.item_name, t.type
		FROM cashier c, item i, transaction t
		WHERE c.cashier_no = t.cashier_no and
			  i.item_no = t.item_no and
			  i.date_time=curdate()			  
		LIMIT 0,10";


$ret_items = mysql_query($all);
$i=0;
while($row = mysql_fetch_array($ret_items)){
echo "<tr>";
echo "<td>".$row['item_name']."</td>";
echo "<td>".$row['type']."</td>";
echo "</tr>";
}

?>

<style>
#canteen_stall{
width:600px;
   /*border:2px solid red;*/
margin:auto;
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
margin:0;
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
display: inline;	
}

/********************/
#canteen_stall #stall_item{

}

#canteen_stall #stall_link{
float:left;
width:800px;
background:#FFF;
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
background:#FFCC66;
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
background:#900;
width:800px;
/*height:450px;*/
/*margin-left:20px;*/	
}

#canteen_stall #stall_table table{
background:#FFF;
}

#canteen_stall #stall_table th{
background:#900;
font-family:"Century Gothic";
font-weight:400;
font-size:14px;
color:#FFF;
text-align:center;

width:200px;
padding:2px;
}

#canteen_stall #stall_table td{
background:#900;
font-family:"Century Gothic";
font-weight:400;
font-size:12px;
color:#FFF;
text-align:center;

width:200px;
padding:3px;
}

#canteen_stall #stall_table td a{
text-decoration: none;
text-align:center;
color:#FFF;

color:#FC3;
}
/****************/
</style>

<div id=canteen_stall>
<div id=canteen_info><h1>Bells ViandMuna Food Corner</h1></div>
   <div id=stall_item>
<div id=stall_table>	
<table cellpadding=2 cellspacing=1>
<tr>
               	<th>Item Name</th>
				<th>Type</th>
</tr>
            </table>               
       </div>
   </div>      
             