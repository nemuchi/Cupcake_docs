<?php
	include('frs.php');
?>


<style>
#welcome {
	float:left;
	width:700px;
}

#welcome h1{
	font-size:100px;
	font-weight:500;
	font-family:'Segoe Script';
	color: #FC0;
	
	margin:0;
	padding:0;

}

#welcome p{
	font-size:24px;
	font-weight:500;
	font-family:'Tw Cen MT';
	color:#FFF;
	
	margin:0;
	padding-left:10px;

}

#welcome b{
	color: #900;
	font-size:24px;
}

</style>
<div id=content_wrapper>
    <div id=content>
        <div id=welcome>
            <h1>Welcome!</h1>
                <p>Through <b>FoodRes System</b>, <br/> Canteen Food Reservations in <i>MSU-Iligan Institute of Technology</i> is now possible!</p>      
        </div>
        <div id=login>
            <div id=login_form>
                <form action="login.php" method="POST" name="ContactForm">
                    <table cellpadding="3">
                        <tr><th></th></tr>
                        <tr><td><input type='name' name='user_id' placeholder="Username" size=25/></td></tr>
                        <tr><td><input type='password' name='password' placeholder="Password" size=25/></td></tr>
                        <tr><td><input class=submit type="submit" value="Log in" /></td></tr>
                        <tr><td><p>Not yet registered? Register <a href=customerreg_form.php>here</a>.</p></td></tr>
                     </table>
                </form>
            </div>
        </div>
 