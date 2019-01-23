<?php
include "connect.php";

//获取未获奖人员名单
$sql_list="SELECT * FROM lucky WHERE lucky = 0";
$result=mysqli_query($link, $sql_list);
$i=0;
while ($row=mysqli_fetch_assoc($result)){
    if(($row["name"]!="")&($row["imgurl"]!="")){
    $listArr[$i]["name"] = $row["name"];
    $listArr[$i]["imgurl"] = htmlspecialchars($row["imgurl"]);  
    $i++; 
    }
}
$list_sum=$i;
?>

	var xinm = new Array();
<?php    
	for ($i=0;($i<($list_sum));$i++){
    echo <<< EOT
xinm[{$i}] = "{$listArr[$i]["imgurl"]}"

EOT;

}
?>	
	var phone = new Array();
<?php    
	for ($i=0;($i<($list_sum));$i++){
    echo <<< EOT
phone[{$i}] = "{$listArr[$i]["name"]}"

EOT;

}
?>	
