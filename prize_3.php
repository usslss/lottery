<?php
include "php/connect.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>抽三等奖</title>

<link rel="stylesheet" href="css/style.css">

</head>
<body>

<div class='luck-back'>
	<div class="luck-content ce-pack-end">
	<div style="text-align:center;margin-bottom:10px;font-size:50px;">
	凌睿 年会抽奖 三等奖
	</div>
		<div >
			<div id="luckuser" class="slotMachine">
				<div class="slot1" style="background-image:url('img/prize3.png');">
					<span class="name1">三等奖</span>
				</div>
			</div>

			<div id="luckuser" class="slotMachine">
				<div class="slot2" style="background-image:url('img/prize3.png');">
					<span class="name2">三等奖</span>
				</div>
			</div>

			<div id="luckuser" class="slotMachine">
				<div class="slot3" style="background-image:url('img/prize3.png');">
					<span class="name3">三等奖</span>
				</div>
			</div>

			<div id="luckuser" class="slotMachine">
				<div class="slot4" style="background-image:url('img/prize3.png');">
					<span class="name4">三等奖</span>
				</div>
			</div>

			<div id="luckuser" class="slotMachine">
				<div class="slot5" style="background-image:url('img/prize3.png');">
					<span class="name5">三等奖</span>
				</div>
			</div>	

			<div id="luckuser" class="slotMachine">
				<div class="slot6" style="background-image:url('img/prize3.png');">
					<span class="name6">三等奖</span>
				</div>
			</div>

			<div id="luckuser" class="slotMachine">
				<div class="slot7" style="background-image:url('img/prize3.png');">
					<span class="name7">三等奖</span>
				</div>
			</div>

			<div id="luckuser" class="slotMachine">
				<div class="slot8" style="background-image:url('img/prize3.png');">
					<span class="name8">三等奖</span>
				</div>
			</div>

			<div id="luckuser" class="slotMachine">
				<div class="slot9" style="background-image:url('img/prize3.png');">
					<span class="name9">三等奖</span>
				</div>
			</div>

			<div id="luckuser" class="slotMachine">
				<div class="slot10" style="background-image:url('img/prize3.png');">
					<span class="name10">三等奖</span>
				</div>
			</div>				
		

		</div>
		
		<div class="luck-content-btn">
			<a id="start" class="start" onclick="start()">开始</a>
		</div>
		<div class="luck-user">
			<div class="luck-user-title">
				<span>中奖名单</span>
			</div>
			<ul class="luck-user-list"></ul>
			<div class="luck-user-btn">
			<!-- <a href="#">中奖人</a> -->
			</div>
		</div>
	</div>
</div>

<script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
<script>
	<?php 
	include "php/prize_list.php";
	?>	
</script>
<script type="text/javascript">

j=1;
phonetxt = $('.name'+j);
nametxt = $('.slot'+j);


var pcount = xinm.length-1;//参加人数
var runing = true;
var trigger = true;
var inUser = (Math.floor(Math.random() * 10000)) % 5 + 1;
var num = 0;
var Lotterynumber = 10; //设置单次抽奖人数

$(function () {
	nametxt.css('background-image','url('+'img/prize3.png'+')');
	phonetxt.html('三等奖');
});

// 开始停止
function start() {

	if (runing) {

		if ( pcount <= Lotterynumber ) {
			alert("抽奖人数不足10人");
		}else{
			runing = false;
			$('#start').text('停止');		
			num = Math.floor(Math.random() * pcount);			
			phonetxt = $('.name'+j);
			//phonetxt.html(phone[num]);
			t = setTimeout(startNum, 0);


		}

	} else {
		$('#start').text('自动抽取中('+ Lotterynumber+')');
		
phonetxt = $('.name'+j);
		zd();
console.log(j)
		
	}
	
}

// 开始抽奖

function startLuck() {
	runing = false;
	$('#btntxt').removeClass('start').addClass('stop');
	//startNum()
}

// 循环参加名单
function startNum() {
	num = Math.floor(Math.random() * pcount);
	nametxt.css('background-image','url('+xinm[num]+')');
	phonetxt.html(phone[num]);
	t = setTimeout(startNum, 0);
}

// 停止跳动
function stop() {
	pcount = xinm.length-1;
	clearInterval(t);
	t = 0;
}

// 打印中奖人

function zd() {
	
	if (trigger) {

		trigger = false;
		var i = 0;

		if ( pcount >= Lotterynumber ) {
			stopTime = window.setInterval(function () {
				if (runing) {
					runing = false;
					$('#btntxt').removeClass('start').addClass('stop');
					// 循环参加名单

	num = Math.floor(Math.random() * pcount);
			j=j+1
			phonetxt = $('.name'+j);
			nametxt = $('.slot'+j);
	phonetxt.html(phone[num]);
	t = setTimeout(startNum, 0);

				} else {
					runing = true;
					$('#btntxt').removeClass('stop').addClass('start');
					stop();

					i++;
					Lotterynumber--;

					$('#start').text('自动抽取中('+ Lotterynumber+')');

					if ( i == 10 ) {
						console.log("抽奖结束");
						window.clearInterval(stopTime);
						//按钮变化
						$('#start').text("抽取二等奖");
						//javascript:window.location.href='URL'
						$("#start").removeAttr("onclick");
						$("#start").attr("onclick","window.location.href='prize_2.php'");
						Lotterynumber = 10;
						trigger = true;
					};

					if ( 1 == 2) {

					}else{
						//前台打印中奖者名单
						$('.luck-user-list').prepend("<li><div class='portrait' style='background-image:url("+xinm[num]+")'></div><div class='luckuserName'>"+phone[num]+"</div></li>");
						$('.modality-list ul').append("<li><div class='luck-img' style='background-image:url("+xinm[num]+")'></div><p>"+phone[num]+"</p></li>");
						//三等奖中奖者名单传递至后台
						var cont1 = $("#msgform").serialize();
 						$.ajax({
							 url:'php/lucky.php',
							 type:'post',
							 dataType:'text',
							 data:{name:phone[num],imgurl:xinm[num],prize:3}
							 });
						//将已中奖者从数组中"删除",防止二次中奖
						xinm.splice($.inArray(xinm[num], xinm), 1);
						phone.splice($.inArray(phone[num], phone), 1);
					};
				}
			},1000);
		};
	}
}
</script>

</div>
</body>
</html>
