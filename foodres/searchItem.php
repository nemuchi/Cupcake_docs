<?php
	include('frs.php');
	include('stall.php');
	include('item.php');
?>

<link href="css/stall.css" rel="stylesheet" type="text/css" media="screen"/>
<style>
li#searchlink{
	background:#FC6;
}
#canteen h2{
	color:#900;
	font-family:'Century Gothic';
	font-size:20px;
	font-weight:300;
	text-align:center;
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
	bottom:-120px;
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

#search_form{
	width:280px;
	padding-bottom:8px;
	margin:0 auto; 
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
    <div id=content>
        <div id=canteen>
        	<h2>Search Available Items in the Canteen</h2>
            <div id=search_form>
            <form action='searchItem.php' method=post>
                <input type=text name=item placeholder='Enter Item' size=30/>
                <input type=submit name=search value=Search />
            </form> 
            </div>
               <!-- Slideshow HTML -->
                <div id="slideshow">
                  <div id="slidesContainer">
                  	<?php
						if(isset($_POST['search'])){
							$item_src = $_POST['item'];
							$item = new Item();
							$i = $item->srcItem($item_src);
							$iquery = mysql_query($i) or die('Cannot query!');
							while($row = mysql_fetch_array($iquery)){
								$stall = new Stall();
								$stall->setStall($row['stall_no']);
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
						}
					?>
                  </div>
                </div>
                <!-- Slideshow HTML -->                    

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
