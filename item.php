<?php
session_start();


include ('vendor/vendor.php');
//$tplloader = new \tpl\TemplateLoader();
//echo( $tplloader->sendSimpleTemplate("SimpleTemplate"));
$db = new \database\Database();
$tplLoader = new \tpl\TemplateLoader();

?>

<?php
include_once ("templates/Assets.php");
?>

<?php
include_once ("templates/view/header.php")
?>

<?php
if(isset($_POST['id'])){
    $user = $_SESSION['user']['username'];
    $itemId = $_POST['id'];
    $itemQuery = "SELECT * FROM `tovar` WHERE `tovar_id` = '$itemId'";
    $itemResult = $db->query($itemQuery);



    while($itemRow = $itemResult->fetch_array()){
        $form = '<form action="cart.php" method="post"><input type="submit" class="btn btn-success" value="В корзину!" name="toCart"><input type="hidden" value="'.$itemRow[0].'" name="tovarId"></form>';
        $form_dis = '<button class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#auth">Вам Необходимо Войти в аккаунт!</button>';
        $search = [
            "%ItemID%",
            "%ItemName%",
            "%ItemImageLink%",
            "%ItemImagName%",
            "%ItemCount%",
            "%ItemPrice%",
            "%ItemAbout%",
            "%ItemCountry%",
            "%ItemImages%",
            "%ItemCategory%",
            "%BTN%"
        ];
        if(isset($_SESSION['user'])){
            $replace = [
                $itemRow[0],
                $itemRow[1],
                "uploads/items/".$itemRow[6],
                $itemRow[1],
                $itemRow[2],
                $itemRow[3],
                $itemRow[4],
                $itemRow[5],
                $itemRow[7],
                $itemRow[8],
                $form
            ];
        }else{
            $replace = [
                $itemRow[0],
                $itemRow[1],
                "uploads/items/".$itemRow[6],
                $itemRow[1],
                $itemRow[2],
                $itemRow[3],
                $itemRow[4],
                $itemRow[5],
                $itemRow[7],
                $itemRow[8],
                $form_dis
            ];
        }



        $imagePath = "uploads/items/".$itemRow[6];
    }



    echo $tplLoader->sendSimpleTemplate("AboutItem",$search,$replace);

}else{

}

?>

<?php
include_once ("templates/view/footer.php");
?>


<?php
include_once ("templates/Scripts.php");
?>
