<?php
include "php/connect.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>凌睿 年会 签到</title>
<link rel="stylesheet" href="css/style.css">
<script language="JavaScript">
function myrefresh(){
    //载入页面
    window.location.reload();
}
//这个就是定时器
setTimeout('myrefresh()',1000); 
</script>

</head>
<body>

<div class='luck-back'>
	<div class="luck-content ce-pack-end" style="padding-right: 0px;">
	<div style="text-align:center;margin-bottom:10px;font-size:50px;">

			<?php include"php/sign_list.php";?>		
		</div>
		
		<div class="luck-content-btn">
			<a id="start" class="start" href="prize_3.php">开始抽奖</a>
		</div>
		
	</div>
</div>

<script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
<script>
	<?php 
	include "php/prize_list.php";
	?>	
</script>


</div>
</body>
</html>
