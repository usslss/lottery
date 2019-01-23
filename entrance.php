<?php 
include_once("php/connect.php");
$insertStation=1;
if (isset($_GET['code'])){

    $code=$_GET['code'];
}else{

    $code="NO CODE";
}

$appid="wx044944f56c296eab";
$appsecret="2b32b11a737a13e6557bc0d4986ee7bc";

//操作数据库    
//注意第二次点击进来会返回 errmsg code beenxxx errcode 40163
    $url1="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$appsecret."&code=".$code."&grant_type=authorization_code";
    
    $json= file_get_contents($url1);
    $json1="[".$json."]";
    $json1_output=json_decode($json1);
    
    foreach($json1_output as $obj){
        $access_token=$obj->access_token;
        $openid=$obj->openid;
    }
    
    
    $url2="https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid;
    
    $json= file_get_contents($url2);
    $json2="[".$json."]";
    $json2_output=json_decode($json2);
    

    foreach($json2_output as $obj){
        $nickname=$obj->nickname;
        $sex=$obj->sex;
        $language=$obj->language;
        $city=$obj->city;
        $province=$obj->province;
        $country=$obj->country;
        $headimgurl=$obj->headimgurl;
        $privilege=$obj->privilege;
    }


//校验登录重复性
//按照时间顺序搜索 前 $news_shownum 条新闻


$sql_verify="SELECT * FROM lucky ";

$result_verify=mysqli_query($link, $sql_verify);



while ($row=mysqli_fetch_assoc($result_verify)){
    
    if($nickname==$row["name"]&$headimgurl==$row["imgurl"]){       
        $page_title="重复登录";
        $page_content="已经录入";
        $page_img="img/error.png";
        $insertStation=0;
        break;
    }else{
        $page_title="扫码成功,进入抽奖";
        $page_content="扫码成功";
        $page_img="img/success.png";
    }

    
}

if($insertStation==1){
$sql=mysqli_query($link,"insert into lucky(name,imgurl,lucky) values ('$nickname','$headimgurl','0')");
mysqli_close($link);
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no" />

<title><?php echo $page_title;?></title>

<link rel="stylesheet" href="css/style.css">

</head>
<body>
  <div style="position:fixed;top:50%;margin-top:-58px;left:50%;margin-left:-50px;text-align:center;">
      <img src="<?php echo $page_img;?>" style="width:100px;height:100px">
      <p style="font-size:16px;height:16px;"><?php echo $page_content;?></p>
  </div>


</div>
</body>
</html>
