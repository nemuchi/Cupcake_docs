<?php
	include('frs.php');
	include('stall.php');
	$stalls = new Stall();
	function dispCanInfo(){
	  	if(@$_REQUEST['can']=='IDS' || @$_REQUEST['can']==''){ 
			echo "<p>
			 IDS Canteen is located in the IDS Building near in the Administration Building and one of the liveliest place in the campus. Students go there during break time or lunchtime, meeting friends and have fun while eating. IDS canteen offers table and chair to customers for a more comfortable atmosphere while consuming your meals. Come visit and have a good appetite.";
		
		}
		if(@$_REQUEST['can']=='CBAA'){
			echo "<p>
				CBAA Canteen is located besides the College of Business Administration and Accountancy. CBAA canteen is composed of several stores that sell different school stuffs, refreshing beverages, and energizing foods that will satisfy your craving stomachs. Stores offer easy to hand-in foods like breads, biscuits, junk foods, salads, and many more that a consumer can easily consume. Come and pick your food.";
		}
		if(@$_REQUEST['can']=='CED'){
			echo "<p>
				CED Canteen is located in the first floor inside the College of Education building. CED canteen like the other canteen is composed of different stores that mainly offer meals to the students. CED canteen provides table and chair for student who are eating there foods inside the area while having a good time with their friends. Come and have a good time while enjoying your food.";
		}
	}
	
	function getStalls($links){
		$clinks = mysql_query($links);
		while($row = mysql_fetch_array($clinks)){
				echo "<li id=stallname>";
				echo "<a id=stall href=stalls2.php?sname=".$row['stall_name'].">".$row['stall_name']."</a>";
				echo "</li>";
		}
	}
?>
<link href="css/stall.css" rel="stylesheet" type="text/css" media="screen"/>
<style>
li#stalllink{
	background:#FC6;
}
#canteen_about{
	float:left;	
	width:700px;
	min-height:300px;
	margin:20px 0;
	padding:0px;
}
#canteen_about p{
	width:600px;
	margin:20px auto;
	padding:0;
	text-align:justify;
	font-family:"Century Gothic";
	font-size:18px;
	color:#900;
}

</style>


<div id=content_wrapper>
    <div id=content>
		<div id=canteen>
            <h1>Canteens</h1>
            <div id=canteen_links>
                <ul>
            		<li class=canlink><a id=ids class=can href='stalls.php?can=IDS'>IDS</a>
                        <ul>
                        <?php 
                            $links = $stalls->getStallbyLoc('IDS');
                            getStalls($links);
                        ?>
                        </ul>
                    </li>
                    <li class=canlink><a id=cbaa class=can href='stalls.php?can=CBAA'>CBAA</a>
                        <ul>
                        <?php 
                            $links = $stalls->getStallbyLoc('CBAA');
                            getStalls($links);
                        ?>
                        </ul>
                    </li>
                    <li class=canlink><a id=ced class=can href='stalls.php?can=CED'>CED</a>
                        <ul>
                        <?php 
                            $links = $stalls->getStallbyLoc('CED');
                            getStalls($links);
                        ?>
                        </ul>
                    </li>
                 </ul>
            </div>
            <div id=canteen_about>
    			<?php dispCanInfo();?>
    		</div>       
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
        
    </div>
</div>

