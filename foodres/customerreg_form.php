<?php
	session_start();
	include('frs.php');	
?>

<style>
#customer_reg{
	float:left;
	width: 500px;
	margin:auto;
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

#reg_form1{
	padding:10px;
}

#customer_reg #reg_form1 table td{

}
/****************/
input {   
    padding: 6px; 
	text-align: center; 
    outline: 0; 
    background: #FFFFFF;  
	border: solid 1px #F90;  
	font-family:'Century Gothic';
	font-size:16px;	
	border-radius: 8px;
	-moz-border-radius: 8px;
	-webkit-border-radius: 8px;
}  
  
  
input:hover,input:focus{
	background:#FF9;
    box-shadow: #900 0px 0px 4px;  
    -moz-box-shadow: #900 0px 0px 4px;  
    -webkit-box-shadow: #900 0px 0px 4px;  
}  
</style>
<div id=content_wrapper>
    	<div id=content>
            <div id=customer_reg>
                <div id=reg_desc>
                    <p>Not yet registered? <br/> Please create an account to make reservations or orders.</p>
                </div>
                <div id=reg_form1>
                    <form align="center" action="customerreg_form.php" method="post">
                        <table cellpadding=1 cellspacing=0>
                        <tr><td><input type="text" name="user_id" placeholder='Username' size=25/></td></tr>
                        <tr><td><input type="password" name="cust_password" placeholder='Password' size=25/></td></tr>	
                        <tr><td><input type="password" name="cust_password2" placeholder='Repeat Password' size=25/></td></tr>	 
                        <tr><td><input type="email" name="email" placeholder='sample@email.com'/ size=30></td></tr>	 
                        <tr><td><input type="submit" name="submit" value="Register"/></td></tr>
                        </table>
                    </form>
                </div>
                <?php
					include('user.php');
					if (isset($_POST['submit'])){	 
						if (empty($_POST['user_id'])||empty($_POST['cust_password'])||empty($_POST['cust_password2'])||empty($_POST['email'])){
							echo '<p><b>ERROR:</b> Please fill in all required fields!</p>';
						}else if(isset($_POST['user_id'])){
							$user_id=$_POST['user_id'];
							$user = new User();
							$countUser = $user->countUser($user_id);
							//echo $countUser;
							$result = mysql_query($countUser) or die(mysql_error()); 
							$count;
							while($row = mysql_fetch_array($result)){
								$count = $row['users'];
							}
							if ($count!=0){
								echo "<p><b>ERROR:</b> Username not available, already taken! Please enter again unique username.</p>";
							}else if($_POST['cust_password']!=$_POST['cust_password2']){
								echo '<p><b>ERROR:</b> Password does not match</p>';
							}else{	
								 $_SESSION['reguser_id']=$_POST['user_id'];
								 $_SESSION['regpassword']=$_POST['cust_password'];
								 $_SESSION['regemail']=$_POST['email'];
								 header('Location: /foodres/create_customer.php');
							}
						}else
							unset($_POST['submit']);
					}
				?>
            </div>

