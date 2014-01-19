<?php
	include('frs_customer.php');
	
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
	background:rgba(255,255,102,0.3);
	width:800px;
	min-height:200px;
	max-height:450px;
	overflow:auto;	
	padding:10px;
	margin:5px;
}

#customer #cust_info{
	clear:both;
	padding:10px;
}

#customer #cust_info #cusimg{
	float:right;
}

#customer #cust_info #cusimg img{
	width:220px;
	height:250px;
}


#customer #cust_info table{
	margin:0;
	padding-bottom:10px;
}

#customer #cust_info table td{
	text-decoration: none;
	color: #900;
	font-family: 'Century Gothic';
	font-size:18px;
	margin:0;
	padding:5px;
}
#customer #cust_info table a{
	text-decoration: none;
	color: #FC3;
	font-family: 'Century Gothic';
	font-size:14px;
	margin:0;
	padding:5px;
}
#customer #cust_info table a:hover{
	color:#CCC;
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

input,select,option {   
    padding: 6px;  
    border: solid 1px #900;  
    outline: 0;  
    font: normal 13px/100% Verdana, Tahoma, sans-serif;  
    background: #FFFFFF;  
    box-shadow: #CCC 0px 0px 4px;  
    -moz-box-shadow: #CCC 0px 0px 4px;  
    -webkit-box-shadow: #CCC 0px 0px 4px;  
 }  
  
  
input:hover,input:focus{   
    border-color: #C9C9C9;   
    -webkit-box-shadow: rgba(0, 0, 0, 0.15) 0px 0px 4px;  
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
<div id=customer>
	<div id=cust_links>
		<ul>
        <li><a href=cust_account.php>Profile</a></li>
        <li><a href=cust_viewTransaction.php>View Transactions</a></li>
        </ul>    
    </div>
    <div id=cust_info> 
    	<div id=cusimg>
        	<img src="<?php echo "img/Customer/".$_SESSION['fname'].".jpg"?>"/>
        </div>
        <form action="custUp.php" method="post">
    	<table id=ac border=0 cellpadding="2" cellspacing="2">
        	<tr>
            	<td>First Name</td>
                <td>:<input type=text name=fname value="<?php echo $_SESSION['fname']?>"  onclick="" placeholder="<?php echo $_SESSION['fname']?>"size=30/></td>
            </tr>
            <tr>
            	<td>Middle Name</td>
                <td>:<input type=text name=mname placeholder="<?php echo $_SESSION['mname']?>" size=30/></td>
            </tr>
            <tr>
            	<td>Last Name</td>
                <td>:<input type=text name=lname placeholder="<?php echo $_SESSION['lname']?>" size=30/></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>:<select name=gender>
                  	<option value=female>Female</option>
                    <option value=male>Male</option>
                    </select>
                 </td>
            </tr>
            <tr>
            	<td>Address</td>
                <td>:<input type=text name=address placeholder="<?php echo $_SESSION['address']?>" size=35/></td>
            </tr>
            <tr>
            	<td>Phone</td>
                <td>:<input type=text name=phone placeholder="<?php echo $_SESSION['phone']?>" size=20/></td>
            </tr>
            <tr>
            	<td>Email</td>
                <td>:<input type=text name=email placeholder="<?php echo $_SESSION['email']?>" /></td>
            </tr>
            <tr><td></td>
                <td><input type=submit name=edit value='Edit Account'/></td>
            </tr>

        </table>
        </form>
        <form action="custUp.php" method="post">
         <table id=acs border=0 cellpadding="2" cellspacing="2">
        	<tr>
            	<td>Username</td>
                <td>: <?php echo $_SESSION['user_id']?></td>
            </tr>
            <tr>
            	<td>Old Password</td>
                <td>:<input type=password name=opass placeholder="**********" size=25/></td>
            </tr>
            <tr>
            	<td>New Password</td>
                <td>:<input type=password name=npass placeholder="**********" size=25/></td>
            </tr>
            <tr>
            	<td></td>
                <td>:<input type=password name=npass2 placeholder="**********" size=25/></td>
            </tr>

            <tr><td></td>
                <td><input type=submit name=cpass value='Change Password'/></td>
            </tr>
         </table>  
         </form>           
    </div>
</div>
</div>
</div>

