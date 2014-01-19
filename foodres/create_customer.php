<?php
	session_start();
	include('frs.php');
					if (isset($_POST['submit'])){	 
						if (empty($_POST['fname'])||empty($_POST['mname'])||empty($_POST['lname'])||empty($_POST['gender'])||empty($_POST['address'])
						||empty($_POST['phone'])){
							echo '<p><b>ERROR:</b> Please fill in all required fields!</p>';
						}else{
							$_SESSION['regfname']=$_POST['fname'];
							$_SESSION['regmname']=$_POST['mname'];
							$_SESSION['reglname']=$_POST['lname'];
							$_SESSION['reggender']=$_POST['gender'];
							$_SESSION['regaddress']=$_POST['address'];
							$_SESSION['regphone']=$_POST['phone'];
							//echo $_SESSION['regphone'];
							header('Location: /foodres/customerRegistration.php');
						}
						unset($_POST['submit']);
					}


?>

<style>
#customer_reg{
	float:left;
	width: 500px;
	margin:auto;
}

#reg_form1{
	padding:10px;
}

#customer_reg #reg_desc p{
	font-family:'Century Gothic';
	font-size:16px;
	font-weight:bold;	
	color:#900;
}

#customer_reg  p{
	font-family:'Century Gothic';
	font-size:16px;
	color:#900;
	padding:5px;
}


#customer_reg #reg_form1 table td{
	text-align:left;
	font-family:'Century Gothic';
	color:#900;

}
/****************/
input {   
    padding: 6px; 
	text-align: center; 
    outline: 0; 
    background: #FFFFFF;  
	border: solid 1px #F90;  
	font-family:'Century Gothic';
	font-size:14px;	
	border-radius: 8px;
	-moz-border-radius: 8px;
	-webkit-border-radius: 8px;
}  
  
  
input:hover,input:focus{
    box-shadow: #900 0px 0px 4px;  
    -moz-box-shadow: #900 0px 0px 4px;  
    -webkit-box-shadow: #900 0px 0px 4px;  
}  
</style>
<div id=content_wrapper>
    	<div id=content>
            <div id=customer_reg>
                <div id=reg_desc>
                    <p>Please enter the necessary details for your registration to continue signing up.</p>
                </div>
                <div id=reg_form1>
                    <form align="center" action="create_customer.php" method="post">
                        <table cellpadding=1 cellspacing=0>
                        <tr><td>First Name</td><td><input type="text" name="fname" size=30/></td></tr>	 
                        <tr><td>Middle Name</td><td><input type="text" name="mname" size=30/></td></tr>	 
                        <tr><td>Last Name</td><td><input type="text" name="lname" size=30/></td></tr>	 
                        <tr><td>Gender</td><td><input type="radio" name="gender" value="male" /> Male	 
                               <input type="radio" name="gender" value="female" /> Female	
                        </td></tr>
                        <tr><td>Address</td><td><input type="text" name="address" size=35/></td></tr>	 
                        <tr><td>Phone No.</td><td><input type="text" name="phone" size=25/></td></tr>
                        <tr<td width=50>&nbsp;</td><td><input type="submit" name="submit" value="Create Account"/></td></tr>
                        </table>
                    </form>
                </div>

            </div>

