<?php
include "connect.php";
$name=$_POST["name"];
$imgurl=$_POST["imgurl"];
$prize=$_POST["prize"];
//设置此人状态为中奖
$sql="UPDATE lucky SET lucky = '$prize' WHERE name = '{$name}' AND imgurl = '{$imgurl}'";
mysqli_query($link, $sql);

?>	
