<?php
session_start();

include ("vendor/vendor.php");
$db = new \database\Database();

 $user = $_SESSION['user']['username'];
 $userId = $_SESSION['user']['id'];



 $cartQuery = "SELECT * FROM `cart` where `cart_user_id` = '$userId' and `cart_tovar_status` = 'новый' ";
$cartResult = $db->query($cartQuery);

$cartIds = [

];
$tovarIds = [

];

while($cartRow = $cartResult->fetch_array()){
    $cartIdold = $cartRow[0];
    $cartTovarCtn = $cartRow[3];
    $cartTovarID = $cartRow[1];
    array_push($cartIds,$cartIdold);
    array_push($tovarIds,$cartTovarID);

}
$date = date("d-m-y");

for($i = 0; $i < count($cartIds); $i++){
     $cartId = $cartIds[$i];
     $orderSuccessfulQuery = "INSERT INTO `orders` (`OrderCartId`,`OrderDate`,`OrderUserId`) values ('$cartId','$date','$userId')";
     $cartDisabledQuery = "UPDATE `cart` set `cart_tovar_status` = 'выполнен' where cart_user_id = '$userId'";
     $tovarQuery = "SELECT * FROM `tovar` where `tovar_id` = $tovarIds[$i]";
     for($j = 0; $j < count($tovarIds); $j++){
         $tovarInfo = $db->query($tovarQuery);
         while($tovarInfoRow= $tovarInfo->fetch_array()){
             $tovarColvo = $tovarInfoRow[2];
         }
     }
    $tovar_ctn = $tovarColvo - $cartTovarCtn;
     $tovarMinusQuery = "UPDATE `tovar` set `tovar_count` = '$tovar_ctn' where `tovar_id` = $tovarIds[$i]";
     $db->query($orderSuccessfulQuery);
    $db->query($cartDisabledQuery);
    $db->query($tovarMinusQuery);
}

?>