<?php
	include('frs_customer.php');
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
	
	function getStalls($links){
		$clinks = mysql_query($links);
		while($row = mysql_fetch_array($clinks)){
				$sname = $row['stall_name'];
				echo "<li id=stallname >";
				echo "<a id=stall href=cust_stalls2.php?sname=".$row['stall_name'].">".$sname."</a>";
				echo "</li>";
		}
	}
	
	function dispslideshow(){
 		date_default_timezone_set('Asia/Manila');
		$curtime=strftime("%H:%M:%S");
		//echo $curtime;
		$stall_no = $_SESSION['stall_no'];
		$category = @$_REQUEST['cat'];
		$items = new Item();
	  	if(@$_REQUEST['cat']==''){ 
			$all_items=$items->getItemCustCashier('Breakfast',$stall_no);
		}else{
			$all_items=$items->getItemCustCashier($category,$stall_no);
		}
		$ret_items = mysql_query($all_items);

		while($row = mysql_fetch_array($ret_items)){
			$cat=$row['category'];
			$st=$row['start_time'];
			$et=$row['end_time'];
			$slots =$row['slotsForRes'];
			$status=$row['statusForRes'];
			
			echo "<div class=slide>";
			if($row['category']=='Breakfast')
				echo "<p class=info>--Breakfast will open at 7:30am and ends at 10:00am</p>";
			else if($row['category']=='Lunch')
				echo "<p class=info> --Lunch will open at 10:00am and ends at 01:00pm</p>";
			else if($row['category']=='Snacks')
			echo "<p class=info> --Snacks will open at 8:00am and ends at 04:30pm</p>";
			
			echo "<div id=box-1 class=box>";
			if(($curtime<=$st&&$curtime<=$et)||($curtime>=$st&&$curtime>=$et)){
				echo "<img class=image src='img/".$row['stall_no']."/".$row['category']."/".$row['item_name'].".jpg'>";
			}else{
				if($slots!=0 && $status!='Sold Out')
					echo "<a href='cust_reserve.php?action=res&itemid=".$row['item_no']."'>
							<img class=image src='img/".$row['stall_no']."/".$row['category']."/".$row['item_name'].".jpg'>
					</a>";
			}

		
			echo "<span class='caption simple-caption'>";
			echo "<p class=text>";
			echo "<ul>";
			echo "<li><h3>Item:</h3> ".$row['item_name']."</li>";
			echo "<li><h3>No of Servings:</h3> ".$row['no_servings']."</li>";
			echo "<li><h3>Price per Servings:</h3> ".$row['price']." Php </li>";
			echo "<li><h3>Reservation Slots:</h3> ".$row['slotsForRes']."</li>";
			echo "<li><h3>Status of Reservation:</h3> ".$row['statusForRes']."</li>";
			if((($curtime<=$st&&$curtime<=$et)||($curtime>=$st&&$curtime>=$et)) or ($slots==0 && $status=='Sold Out')){
				echo "<li>--Close--</li>";
			}			
			echo "<p class=info>--Click on the image to reserve--</p>";
			echo "</ul>";
			echo "</p>";
			echo "</span>";
			echo "</div>";
			
			echo "</div>";
			
		}
	}

?>
<style>
li#stalllink{
	background:#FC6;
}
#canteen_info p{
	float:right;
	margin:2px;
	color:#900;
	font-family:'Century Gothic';
	font-size:16px;
}

#slideshow {
	clear:both;
	margin:auto;
	margin-bottom:20px;	
	width:700px;
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
	min-height:300px;
    -webkit-transition: all 800ms ease-out;  
    -moz-transition: all 800ms ease-out;  
    -o-transition: all 800ms ease-out;  
    -ms-transition: all 800ms ease-out;  
    transition: all 800ms ease-out;  
    left: 0;
	top:-25px;
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

#slideshow #slidesContainer .slide  a{
	color:#FFF;
}
#slideshow #slidesContainer .slide  a:hover{
	background:#FF6;
	color:#FFF;
}


#slideshow #slidesContainer .slide p.info{
	background:#700722;
	margin:2px;
	padding:5px;
	color:#FFF;
	font-family:'Century Gothic';
	font-size:12px;
	text-align:center;
}
#slideshow #slidesContainer .slide ul{
	list-style:none;
	float:right;
	margin-right:20px;
	padding:0;
}
#slideshow #slidesContainer .slide li{
	margin:0;
	padding:0;
	color:#FFF;
	font-family:'Century Gothic';
	font-size:15px;
	width:200px;
}
#slideshow #slidesContainer .slide h3{
	margin:0;
	padding:0;
	color:#FC0;
	font-family:'Century Gothic';
	font-size:18px;
	font-weight:300;
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
</style>
<link href="css/cust_stall.css" rel="stylesheet" type="text/css" media="screen"/>


<div id=canteen>
	<!--<h1>Canteens</h1>-->
    <div id=canteen_links>
    	<ul>
            <li id=canlink><a href='cust_stalls.php?can=IDS'>IDS</a>
            	<ul>
                <?php 
                     $links = $stalls->getStallbyLoc('IDS');
                     getStalls($links);
				?>
                </ul>
            </li>
            <li id=canlink><a href='cust_stalls.php?can=CBAA'>CBAA</a>
            	<ul>
                <?php 
                    $links = $stalls->getStallbyLoc('CBAA');
                 	getStalls($links);
				?>
                </ul>
            </li>
            <li id=canlink><a href='cust_stalls.php?can=CED'>CED</a>
            	<ul>
                <?php 
                	$links = $stalls->getStallbyLoc('CED');
                    getStalls($links);
				?>
                </ul>
            </li>
         </ul>
         <div id=search_form>
            		<form action='cust_stalls.php' method=post>
                		<input type=text name=item placeholder='Enter Item' size=25/>
                		<input type=submit name=search value=Search />
            		</form> 
         </div>
    </div>
    <div id=canteen_stall>
    	<div id=canteen_info><h1><?php echo $_SESSION['sname'] ?></h1><p>Date: <?php echo "<b>".date("M d, Y")."</b>";?> Current Time <span id=curTime></span></p></div>
        <div id=stall_item>
            <div id=stall_link>
                <ul>
                    <li id=clink><a href='cust_stalls2.php?sname=<?php echo $_SESSION['sname']?>&cat=breakfast'>Breakfast</a></li>
                    <li id=clink><a href='cust_stalls2.php?sname=<?php echo $_SESSION['sname']?>&cat=lunch'>Lunch</a></li>
                    <li id=clink><a href='cust_stalls2.php?sname=<?php echo $_SESSION['sname']?>&cat=snacks'>Snacks</a></li>
                </ul>
            </div>	
                <!-- Slideshow HTML -->
                <div id="slideshow">
                  <div id="slidesContainer">
                  	<?php
						dispslideshow();
					?>
                  </div>
                </div>
                <!-- Slideshow HTML -->  
        </div>    
    </div>
    
    
</div>