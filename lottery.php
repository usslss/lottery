<?php
/**
  * 抽奖
  * @param int $total
  */
  function getReward()
  {
      $servername = 'localhost'; //
      $username = 'root';   //用户名
      $password = ''; //密码自己填
      $database='test1';  //数据库名称
      
      // 创建连接
      $conn = new mysqli($servername, $username, $password, $database);
      // Check connection
      if ($conn->connect_error) {
          die("连接失败: " . $conn->connect_error);
      }
      
      $sql1 = "SELECT firstprize_available, secondprize_available, thirdprize_available, firstprize_obtained ,secondprize_obtained, thirdprize_obtained, treasure_sum FROM treasure";
      $result = $conn->query($sql1);
      
      if ($result->num_rows > 0) {
          // 输出数据
          while(($row = $result->fetch_assoc())!=false) {
              $firstprize_available = $row["firstprize_available"];
              $secondprize_available = $row["secondprize_available"];
              $thirdprize_available = $row["thirdprize_available"];
              $firstprize_obtained = $row["firstprize_obtained"];
              $secondprize_obtained = $row["secondprize_obtained"];
              $thirdprize_obtained = $row["thirdprize_obtained"];
              $treasure_sum = $row["treasure_sum"];
              
          }
      } else {
          echo "0 结果";
      }
      $conn->close();
      
      if ($treasure_sum<=0){
          $final="抱歉，抽奖已结束";
          return $final;
      }
 
      
      
  $total=$treasure_sum;
  $win1 = $firstprize_available;
  $win2 = $secondprize_available;
  $win3 = $thirdprize_available;
  $other = $total-$win1-$win2-$win3;
  $return = array();
  
  for ($i=0;$i<$win1;$i++)
  {
  $return[] = 1;
    }
  for ($j=0;$j<$win2;$j++)
  {
  $return[] = 2;
  }
  for ($m=0;$m<$win3;$m++)
  {
  $return[] = 3;
  }
  for ($n=0;$n<$other;$n++)
  {
  $return[] = '谢谢惠顾';
  }
    
  shuffle($return);
  $final=$return[array_rand($return)];
  
  if ($final == 1){
      $firstprize_available=$firstprize_available-1;
      $firstprize_obtained=$firstprize_obtained+1;
  } elseif ($final == 2){
      $secondprize_available=$secondprize_available-1;
      $secondprize_obtained=$secondprize_obtained+1;
  } elseif ($final == 3){
      $thirdprize_available=$thirdprize_available-1;
      $thirdprize_obtained=$thirdprize_obtained+1;
  } 
  $treasure_sum=$treasure_sum-1;
  
//数据库操作
  $conn = new mysqli($servername, $username, $password, $database);
  $sql2 = "UPDATE treasure SET firstprize_available = {$firstprize_available},secondprize_available = {$secondprize_available},thirdprize_available = {$thirdprize_available},
                               firstprize_obtained = {$firstprize_obtained},secondprize_obtained = {$secondprize_obtained},thirdprize_obtained = {$thirdprize_obtained},
                               treasure_sum = {$treasure_sum}";
  mysqli_multi_query($conn, $sql2);
  $conn->close();
  
  echo "现存一等奖数量: " . $firstprize_available. "现存二等奖数量: " . $secondprize_available. "现存三等奖数量: " . $thirdprize_available. "<br>";
  echo "<p>";
  echo "一等奖已中奖数: " . $firstprize_obtained. "二等奖已中奖数: " . $secondprize_obtained. "三等奖已中奖数: " . $thirdprize_obtained. "<br>";
  echo "<p>";
  echo "剩余抽奖次数：" .$treasure_sum;
  
  
  
  return $final;
  }
  
$data = getReward();
echo "<p>". "抽奖结果为：&nbsp&nbsp&nbsp&nbsp";
echo $data;

?>