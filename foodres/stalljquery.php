<?php
	//include('frs.php');
	include('stall.php');
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
				echo "<li id=stallname>";
				echo "<a id=stall href=stalls2.php?sname=".$row['stall_name'].">".$row['stall_name']."</a>";
				echo "</li>";
		}
	}
?>
<link href="css/stall.css" rel="stylesheet" type="text/css" media="screen"/>
<style>
@font-face {
    font-family: 'icomoon';
    src:url('../fonts/icomoon.eot');
    src:url('../fonts/icomoon.eot?#iefix') format('embedded-opentype'),
        url('../fonts/icomoon.svg#icomoon') format('svg'),
        url('../fonts/icomoon.woff') format('woff'),
        url('../fonts/icomoon.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
}
 
/* Needed for a fluid height: */
html, body, .container, .main { height: 100%;}
 
/* main wrapper */
.can-contentslider {
    width: 700px;
	min-height:400px;
    margin: 1em auto;
    float:left;
    background:#FF9900;
	border-radius:20px;
}
 
.can-contentslider > ul {
    list-style: none;
    height: 100%;
    width: 100%;
    overflow: hidden;
    position: relative;
    padding: 0;
    margin: 0;
}
 
.can-contentslider > ul li {
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    padding: 1em;
    background: #fff;
}
 
/* Whithout JS, we use :target */
.can-contentslider > ul li:target {
    z-index: 100;
}
 
.can-contentslider nav {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 3.313em;
    z-index: 1000;
    border-top: 4px solid #47a3da;
    overflow: hidden;
}
 
.can-contentslider nav a {
    float: left;
    display: block;
    width: 20%;
    height: 100%;
    font-weight: 400;
    letter-spacing: 0.1em;
    overflow: hidden;
    color: #47a3da;
    background: #fff;
    outline: none;
    text-align: center;
    line-height: 3;
    position: relative;
    padding-left: 3.125em;
    text-transform: uppercase;
    border-right: 4px solid #47a3da;
    -webkit-transition: color 0.2s ease-in-out, background-color 0.2s ease-in-out;
    -moz-transition: color 0.2s ease-in-out, background-color 0.2s ease-in-out;
    transition: color 0.2s ease-in-out, background-color 0.2s ease-in-out;
}
 
.can-contentslider nav a span {
    display: block;
}
 
.can-contentslider nav a:last-child {
    border: none;
    box-shadow: 1px 0 #47a3da; /* fills gap caused by rounding */
}
 
.can-contentslider nav a:hover {
    background-color: #47a3da;
    color: #fff;
}
 
.can-contentslider nav a.rc-active {
    background-color: #47a3da;
    color: #fff;
}
 
/* Iconfont for navigation and headings */
.can-contentslider [class^="icon-"]:before, 
.can-contentslider [class*=" icon-"]:before {
    font-family: 'icomoon';
    font-style: normal;
    text-align: center;
    speak: none;
    font-weight: normal;
    line-height: 2.5;
    font-size: 2em;
    position: absolute;
    left: 10%;
    top: 50%;
    margin: -1.250em 0 0 0;
    height: 2.500em;
    width: 2.500em;
    color: rgba(0,0,0,0.1);
    -webkit-font-smoothing: antialiased;
}
 
.can-contentslider .icon-wolf:before {
    content: "\56";
}
 
.can-contentslider .icon-rabbit:before {
    content: "\52";
}
 
.can-contentslider .icon-turtle:before {
    content: "\54";
}
 
.can-contentslider .icon-platypus:before {
    content: "\42";
}
 
.can-contentslider .icon-aligator:before {
    content: "\41";
}
 
.can-contentslider [class^="icon-"].rc-active:before, 
.can-contentslider [class*=" icon-"].rc-active:before,
.can-contentslider nav a:hover:before {
    color: rgba(255,255,255,0.9);
}
 
.can-contentslider h3 {
    font-size: 4em;
    height: 2em;
    line-height: 1.7;
    font-weight: 300;
    margin: 0 0 0.3em;
    position: relative;
    color: #47a3da;
    text-transform: uppercase;
    text-align: right;
    letter-spacing: 0.3em;
    padding: 0 0.2em 0 0;
    border-bottom: 4px solid #47a3da;
}
 
.can-contentslider h3[class^="icon-"]:before, 
.can-contentslider h3[class*=" icon-"]:before {
    top: 0;
    left: 0;
    width: 2em;
    line-height: 1;
    height: 1.2em;
    margin: 0;
    color: #47a3da;
}
 
.can-contentslider li > div {
    position: absolute;
    top: 9em;
    bottom: 3.313em;
    width: 100%;
    left: 0;
    padding: 0 1em;
    overflow-x: hidden;
    overflow-y: auto;
}
 
.can-contentslider .can-content {
    -webkit-column-rule: 1px dashed #47a3da;
    -moz-column-rule: 1px dashed #47a3da;
    column-rule: 1px dashed #47a3da;
    -webkit-column-count: 2;
    -moz-column-count: 2;
    -o-column-count: 2;
    column-count: 2;
    -webkit-column-gap: 1em;
    -moz-column-gap: 1em;
    -o-column-gap: 1em;
    column-gap: 1em;
    vertical-align: top;    
    padding: 1em 0;
}
 
.can-contentslider p {
    color: #47a3da;
    padding: 0 0.5em 0.4em;
    margin: 0;
    font-size: 1.2em;
    font-weight: 300;
    text-align: justify;
    line-height: 1.6;
}
 
/* Media queries */
 
@media screen and (max-width: 70em) { 
    .can-contentslider p {
        font-size: 100%;
    }
}
 
@media screen and (max-width: 67.75em) {
 
    .can-contentslider { font-size: 85%; }
 
    .can-contentslider nav a[class^="icon-"]:before, 
    .can-contentslider nav a[class*=" icon-"]:before {
        left: 50%;
        margin-left: -1.250em;
    }
 
    .can-contentslider nav a span {
        display: none;
    }
}
 
@media screen and (max-width: 43em) {
 
    .can-contentslider h3 {
        font-size: 2em;
    }
 
    .can-contentslider .cbp-content {
        -webkit-column-count: 1;
        -moz-column-count: 1;
        -o-column-count: 1;
        column-count: 1;
    }
 
    .can-contentslider li > div {
        top: 5em;
    }
 
}
 
@media screen and (max-width: 25em) { 
    .cbp-contentslider nav a { padding: 0;}
    .cbp-contentslider h3[class^="icon-"]:before, 
    .cbp-contentslider h3[class*=" icon-"]:before { display: none;}
}
</style>

<div id="can-contentslider" class="can-contentslider">
    <ul>
        <li id="slide1">
            <h3 class="icon-wolf">Wolf</h3>
            <div>
                <div class="can-content">
                    <p><!-- ... --></p>
                </div>
            </div>
        </li>
        <li id="slide2">
            <h3 class="icon-rabbit">Rabbit</h3>
            <div>
                <div class="can-content">
                    <p>Chicory collard greens tatsoi cress bamboo shoot broccoli rabe lotus root earthnut pea arugula okra welsh onion leek shallot courgette. Chard garlic fava bean pea sprouts gram spinach plantain tomatillo. Chicory garlic black-eyed pea gourd chickpea cucumber lotus root.</p>
                    <p>Daikon artichoke gumbo azuki bean bok choy avocado winter purslane gram earthnut pea broccoli salsify squash plantain wattle seed wakame broccoli rabe bamboo shoot. Zucchini lotus root azuki bean epazote dulse pumpkin rutabaga spinach. Endive mung bean gumbo maize plantain rock melon.</p>
                </div>
            </div>
        </li>
        <li id="slide3">
            <!-- ... -->
        </li>
    </ul>
    <nav>
        <a href="#slide1" class="icon-wolf"><span>Wolf</span></a>
        <a href="#slide2" class="icon-rabbit"><span>Rabbit</span></a>
        <a href="#slide3" class="icon-aligator"><span>Aligator</span></a>
    </nav>
</div>