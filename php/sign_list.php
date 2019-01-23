<?php
include "connect.php";

$sql_sign = "SELECT imgurl FROM lucky";
$result = mysqli_query($link, $sql_sign);
$j = 0;
while ($row = mysqli_fetch_assoc($result)) {
    if($row["imgurl"]!=""){
    $signImgUrl[$j] = htmlspecialchars($row["imgurl"]);
    $j++;
    }
}
$sign_sum = $j;

//$sign_sum = 100; //测试用改数目

$i = intval($sign_sum / 10);

if ($i > 10) {
    $sign_length = 30;
} else {
    $sign_length = 150;
}

switch ($i) {
    case 10:
        $sign_length = 49;
        break;
    case 9:
        $sign_length = 53;
        break;
    case 8:
        $sign_length = 53;
        break;
    case 7:
        $sign_length = 60;
        break;
    case 6:
        $sign_length = 65;
        break;
    case 5:
        $sign_length = 65;
        break;
    case 4:
        $sign_length = 76;
        break;
    case 3:
        $sign_length = 85;
        break;
    case 2:
        $sign_length = 100;
        break;
    case 1:
        $sign_length = 110;
        break;
}

?>
	凌睿 年会 已有<?php echo $sign_sum; ?>人签到
	</div>
		<div >
<?php
for ($i = 0; $i < $sign_sum; $i++) {
    echo <<< EOT
			<div id="luckuser" class="slotMachine" style="width: {$sign_length}px;height: {$sign_length}px;">
				<div class="slot1" style="background-image:url('{$signImgUrl[$i]}');">
					<span class="name1"></span>
				</div>
			</div>

EOT;

}
?>

