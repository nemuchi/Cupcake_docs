<?php
	
	include('frs_customer.php');
	include('stall.php');
	include('item.php');
	$stalls = new Stall();
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
				echo "<li id=stallname>";
				echo "<a id=stall href=cust_stalls2.php?sname=".$row['stall_name'].">".$sname."</a>";
				echo "</li>";
		}
	}
?>
<link href="css/cust_stall.css" rel="stylesheet" type="text/css" media="screen"/>
<style>
li#stalllink{
	background:#FC6;
}
#canteen_about{
	width:700px;
	min-height:300px;
	margin:0px auto;
	padding:50px 0px;
}
#canteen_about p{
	width:700px;
	margin:20px auto;
	padding:0;
	text-align:justify;
	
	font-family:"Century Gothic";
	font-size:18px;
	color:#900;
}
/***************************/
#slideshow {
	clear:both;
	margin:15px auto;
	width:700px;
	min-height:300px;
	position:relative;
	z-index:1;
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
	height:280px;  
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
	max-height:280px;
    -webkit-transition: all 800ms ease-out;  
    -moz-transition: all 800ms ease-out;  
    -o-transition: all 800ms ease-out;  
    -ms-transition: all 800ms ease-out;  
    transition: all 800ms ease-out;  
    left: 0;
	bottom:-130px;
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
	text-align:left;
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

<div id=canteen>
	<h1>Canteens</h1>
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
            
    <div id=canteen_about>
               <!-- Slideshow HTML -->
                <div id="slideshow">
                  <div id="slidesContainer">
                  	<?php
						if(isset($_POST['search'])){
							date_default_timezone_set('Asia/Manila');
							$curtime=strftime("%H:%M:%S");

							$item_src = $_POST['item'];
							$item = new Item();
							$i = $item->srcItem($item_src);
							$iquery = mysql_query($i) or die('Cannot query!');
							while($row = mysql_fetch_array($iquery)){
								$cat=$row['category'];
								$st=$row['start_time'];
								$et=$row['end_time'];
								$slots =$row['slotsForRes'];
								$status=$row['statusForRes'];
								
								$stall = new Stall();
								$stall->setStall($row['stall_no']);
								echo "<div class=slide>";
								echo "<div id=box-1 class=box>";
								if($row['category']=='Breakfast')
									echo "<p class=info> --Breakfast will open at 7:30am and ends at 10:00am</p>";
								else if($row['category']=='Lunch')
									echo "<p class=info> --Lunch will open at 10:00am and ends at 01:00pm</p>";
								else if($row['category']=='Snacks')
								echo "<p class=info>--Snacks will open at 8:00am and ends at 04:30pm</p>";
								
								
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
								echo "<table cellpadding=2 cellspacing=1>";
								echo "<tr><th>Category</th><th>Item</th><th>No of Servings</th><th>Price per Servings</th><th>Slots</th><th>Status</th><th>Stall</th></tr>";
								echo "<tr><td>".$row['category']."</td>";
								echo "<td>".$row['item_name']."</td>";
								echo "<td>".$row['no_servings']."</td>";
								echo "<td>".$row['price']." Php </td>";
								echo "<td>".$row['slotsForRes']."</td>";
								echo "<td>".$row['statusForRes']."</td>";
								echo "<td>".$stall->getStallName()."</td>";
								echo "</tr></table>";
								echo "</p>";
								echo "</span>";
								echo "</div></div>";		
							}
						}else{
							dispCanInfo();
						}
					?>
                  </div>
                </div>
                <!-- Slideshow HTML -->                    
    </div>
</div>
</div>
</div>