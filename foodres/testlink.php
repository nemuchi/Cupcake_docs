<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript">
<!-- Put the following code in your JS file or Head Tags ---->
<!-->
window.onload = function() {
  document.getElementById('mylink').onclick = function() {
    this.style.color = 'green';
  }
}
</script>
<style>

a.clicked {
    color: #f90;
}
</style>
</head>

<body>
<a href="#" id="mylink" style="color:blue;">My blue link</a>
<a href="#" id="mylink" style="color:green;">My green link</a>

</body>
</html>