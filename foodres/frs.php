<?php
	mysql_connect("localhost","root","") or	 
		die ("Could not connct to database"); 
	mysql_select_db("csc181") or	 
		die ("Could not select database");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MSU-IIT Food Reservation System </title>
<link href="css/frs.css" rel="stylesheet" type="text/css" media="screen"/>
<script type="text/javascript">
<!-- Put the following code in your JS file or Head Tags ---->
<!-->

function DisplayTime(){
if (!document.all && !document.getElementById)
return
	timeElement=document.getElementById? document.getElementById("curTime"): document.all.tick2
	var CurrentDate=new Date()
	var hours=CurrentDate.getHours()
	var minutes=CurrentDate.getMinutes()
	var seconds=CurrentDate.getSeconds()
	if (minutes<=9) minutes="0"+minutes;
	if (seconds<=9) seconds="0"+seconds;
	var currentTime=hours+":"+minutes+":"+seconds;
	timeElement.innerHTML="<font style='font-size:12px;font-weight:bold;'>"+currentTime+"</b>"
	setTimeout("DisplayTime()",1000)
	}
	window.onload=DisplayTime
	
</script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  var currentPosition = 0;
  var slideWidth = 620;
  var slides = $('.slide');
  var numberOfSlides = slides.length;

  // Remove scrollbar in JS
  $('#slidesContainer').css('overflow', 'hidden');

  // Wrap all .slides with #slideInner div
  slides
    .wrapAll('<div id="slideInner"></div>')
    // Float left to display horizontally, readjust .slides width
	.css({
      'float' : 'left',
      'width' : slideWidth
    });

  // Set #slideInner width equal to total width of all slides
  $('#slideInner').css('width', slideWidth * numberOfSlides);

  // Insert controls in the DOM
  $('#slideshow')
    .prepend('<span class="control" id="leftControl">Clicking moves left</span>')
    .append('<span class="control" id="rightControl">Clicking moves right</span>');

  // Hide left arrow control on first load
  manageControls(currentPosition);

  // Create event listeners for .controls clicks
  $('.control')
    .bind('click', function(){
    // Determine new position
	currentPosition = ($(this).attr('id')=='rightControl') ? currentPosition+1 : currentPosition-1;
    
	// Hide / show controls
    manageControls(currentPosition);
    // Move slideInner using margin-left
    $('#slideInner').animate({
      'marginLeft' : slideWidth*(-currentPosition)
    });
  });

  // manageControls: Hides and Shows controls depending on currentPosition
  function manageControls(position){
    // Hide left arrow if position is first slide
	if(position==0){ $('#leftControl').hide() } else{ $('#leftControl').show() }
	// Hide right arrow if position is last slide
    if(position==numberOfSlides-1){ $('#rightControl').hide() } else{ $('#rightControl').show() }
  }	
});
</script>

</head>


<body>


<div id=header>	
	<div id=frslogo>
    	<img src="img/logo.png"/>
     </div>
</div>


<div id=container>   
    <div id=vnavwrapper>
        <div id=vnavbar>
            <div id=vnavlinks>
                <ul id=menu>
                    <li id=homelink onClick=location.href='index.php'><a href='index.php' ><img src="img/homeicon.png" width=45 height=45 /><p>HOME</p></a></li>
                    <li id=searchlink onClick=location.href='searchItem.php'><a href='searchItem.php'><img src="img/cupcake.png" width=45 height=45 /><p>SEARCH</p></a></li>
                    <li id=stalllink onClick=location.href='stalls.php'><a href='stalls.php'><img src="img/store.png" width=45 height=45 /><p>STALLS</p></a></li>
                    <!--<li id=aboutlink><a href='about.php'><img src="img/cupcake.png" width=45 height=45 /><p>ABOUT</p></a></li>-->
                   <!--<li id=contactlink><a href='contact.php'><img src="img/contacticon.png" width=45 height=45 /><p>CONTACT</p></a></li>-->
                </ul>
            </div>
        </div>
    </div>
    
    
   
    
			


<?php

	function footer(){
	echo '
			<div id=footer>
				<p>All Rights Reserved 2013 | Cupcake | Contact us |</p>
			</div>
			
			</body>
			</html>
	';}
?>