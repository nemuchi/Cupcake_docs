<?php
	include('frs.php');
	include('stall.php');
	include('item.php');
	$stalls = new Stall();
	if(@$_REQUEST['sname']!=''){
		$sname = @$_REQUEST['sname'];
		$q = mysql_query("SELECT * FROM stall where stall_name like '%$sname%'");
		while($row = mysql_fetch_array($q)){
			$_SESSION['stall_no']=$row['stall_no'];
			$_SESSION['sname']=$row['stall_name'];
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
	
	function dispCanInfo(){
	  	if(@$_REQUEST['can']=='IDS' || @$_REQUEST['can']==''){ 
			echo "<p>
			 IDS Canteen is located in the IDS Building near in the Administration Building and one of the liveliest place in the campus. Students go there during break time or lunchtime, meeting friends and have fun while eating. IDS canteen offers table and chair to customers for a more comfortable atmosphere while consuming your meals. Come visit and have a good appetite
			";
		
		}
		if(@$_REQUEST['can']=='CBAA'){
			echo "<p>
				CBAA Canteen is located besides the College of Business Administration and Accountancy. CBAA canteen is composed of several stores that sell different school stuffs, refreshing beverages, and energizing foods that will satisfy your craving stomachs. Stores offer easy to hand-in foods like breads, biscuits, junk foods, salads, and many more that a consumer can easily consume. Come and pick your food.
			";
		}
		if(@$_REQUEST['can']=='CED'){
			echo "<p>
				CED Canteen is located in the first floor inside the College of Education building. CED canteen like the other canteen is composed of different stores that mainly offer meals to the students. CED canteen provides table and chair for student who are eating there foods inside the area while having a good time with their friends. Come and have a good time while enjoying your food.			";
		}
	}
	
	function dispItems(){
		$stall_no = $_SESSION['stall_no'];
		$cat = @$_REQUEST['cat'];
		$items = new Item();
	  	if(@$_REQUEST['cat']==''){ 
			$all_items=$items->getItemCustCashier('Breakfast',$stall_no);
		}else{
			$all_items=$items->getItemCustCashier($cat,$stall_no);
		}
		$ret_items = mysql_query($all_items);
		while($row = mysql_fetch_array($ret_items)){
			echo "<div class=slide>";
			if($row['category']=='Breakfast')
				echo "<p class=info>Current Time <span id=curTime></span> --Breakfast will open at 7:30am and ends at 10:00am</p>";
			else if($row['category']=='Lunch')
				echo "<p class=info>Current Time <span id=curTime></span> --Lunch will open at 10:00am and ends at 01:00pm</p>";
			else if($row['category']=='Snacks')
			echo "<p class=info>Current Time <span id=curTime></span> --Snacks will open at 8:00am and ends at 04:30pm</p>";
			
			echo "<div id=box-1 class=box>";
			echo "<img class=image src='img/".$row['stall_no']."/".$row['category']."/".$row['item_name'].".jpg'>";
			echo "<span class='caption simple-caption'>";
			echo "<p class=text>";
			echo "<table cellpadding=2 cellspacing=1>";
			echo "<tr><th>Item</th><th>No of Servings</th><th>Price per Servings</th><th>Reservation Slots</th><th>Status of Reservation</th></tr>";
			echo "<tr><td>".$row['item_name']."</td>";
			echo "<td>".$row['no_servings']."</td>";
			echo "<td>".$row['price']." Php </td>";
			echo "<td>".$row['slotsForRes']."</td>";
			echo "<td>".$row['statusForRes']."</td>";
			echo "</tr></table>";
			echo "</p>";
			echo "</span>";
			echo "</div></div>";
		}

	}

?>

<link href="css/stall.css" rel="stylesheet" type="text/css" media="screen"/>
<style>
li#stalllink{
	background:#FC6;
}
#slideshow {
	clear:both;
	margin:auto;
	margin-bottom:20px;	
	width:640px;
	min-height:300px;
	position:relative;
}

#slideshow #slidesContainer {
	/*background:#640000;*/
  	margin:0 auto;
  	width:580px;
  	min-height:300px;
  	overflow:auto; /* allow scrollbar */
  	position:relative;
}
#slideshow #slidesContainer .slide {
  	margin:0 auto;
	padding:0px;
  	width:560px; /* reduce by 20 pixels of #slidesContainer to avoid horizontal scroll */
  	min-height:300px;
}
.box { 
	position: relative;
	left:35px;   
    cursor: pointer;  
    overflow: hidden;  
    width: 500px;
	height:280px;  
}  
  
.box img {  
    margin:0 auto;
	overflow:hidden; 
    width:500px;
	height:300px;  
    -webkit-transition: all 800ms ease-out;  
    -moz-transition: all 800ms ease-out;  
    -o-transition: all 800ms ease-out;  
    -ms-transition: all 800ms ease-out;  
    transition: all 800ms ease-out;  
}  

.box .caption {  
    background-color: rgba(0,0,0,0.6);  
    position: absolute;  
    z-index: 100;  
	width:500px;
    -webkit-transition: all 800ms ease-out;  
    -moz-transition: all 800ms ease-out;  
    -o-transition: all 800ms ease-out;  
    -ms-transition: all 800ms ease-out;  
    transition: all 800ms ease-out;  
    left: 0;
	bottom:-100px;
}  

.box .caption table{  
	border:thin solid #FF6;
}

.box .caption th{
	border:thin solid #FF6;  
	color:#FC3;
	font-family:'Century Gothic';
	font-weight:300px;
	font-size:14px;
	width:200px;
}

.box .caption td{  
	border:thin solid #FF6;
	color:#FFF;
	text-align:center;
	font-family:'Century Gothic';
	font-weight:300px;
	font-size:12px;
	width:100px;
}


.box .simple-caption {  
    min-height: 30px;  
    bottombottom: -200px;  
    /*line-height: 25pt; */ 
}  

.box:hover .simple-caption {  
    -moz-transform: translateY(-100%);  
    -o-transform: translateY(-100%);  
    -webkit-transform: translateY(-100%);  
    transform: translateY(-100%);  
} 

#slideshow #slidesContainer .slide p.info{
	background:#700722;
	margin:0px auto;
	padding:5px;
	color:#FC3;
	font-family:'Century Gothic';
	font-size:12px;
	text-align:center;
	z-index:-999999;
}


/** 
 * Slideshow controls style rules.
 */
.control {
  display:block;
  width:42px;
  height:300px;
  text-indent:-10000px;
  position:absolute;
  cursor: pointer;
}
#leftControl {
  top:0;
  left:0;
  background:transparent url(img/control_left.png) no-repeat 0 0;
}
#rightControl {
  top:0;
  right:0;
  background:transparent url(img/control_right.png) no-repeat 0 0;
}

/****************/
#search_form{
	float:right;
	padding:0;
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
/****************/
</style>
<div id=content_wrapper>
<!--img src="img/1/Breakfast/daing.jpg" /-->
    <div id=content>
        <div id=canteen>
            <!--<h1>Canteens</h1>-->
            <div id=canteen_links>
                <ul>
                    <li class=canlink><a href='stalls.php?can=IDS'>IDS</a>
                        <ul>
                        <?php 
                            $links = $stalls->getStallbyLoc('IDS');
                            getStalls($links);
                        ?>
                        </ul>
                    </li>
                    <li class=canlink><a href='stalls.php?can=CBAA'>CBAA</a>
                        <ul>
                        <?php 
                            $links = $stalls->getStallbyLoc('CBAA');
                            getStalls($links);
                        ?>
                        </ul>
                    </li>
                    <li class=canlink><a href='stalls.php?can=CED'>CED</a>
                        <ul>
                        <?php 
                            $links = $stalls->getStallbyLoc('CED');
                            getStalls($links);
                        ?>
                        </ul>
                    </li>
                 </ul>
            </div>
            <div id=search_form>
            		<form action='searchItem.php' method=post>
                		<input type=text name=item placeholder='Enter Item' size=25/>
                		<input type=submit name=search value=Search />
            		</form> 
          	</div>

            <div id=canteen_stall>
                <div id=canteen_info>
                <h1><?php echo $_SESSION['sname']?></h1>           
                 
				</div>
                <div id=stall_item>
                    <div id=stall_link>
                        <ul>
                            <li id=clink><a href="stalls2.php?sname=<?php echo $_SESSION['sname']?>&cat=breakfast">Breakfast</a></li>
                            <li id=clink><a href='stalls2.php?sname=<?php echo $_SESSION['sname']?>&cat=lunch'>Lunch</a></li>
                            <li id=clink><a href='stalls2.php?sname=<?php echo $_SESSION['sname']?>&cat=snacks'>Snacks</a></li>
                        </ul>
                    </div>
                 </div>	
                <!-- Slideshow HTML -->
                <div id="slideshow">
                  <div id="slidesContainer">
                  	<?php
						dispItems();
					?>
                  </div>
                </div>
                <!-- Slideshow HTML -->                    
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
