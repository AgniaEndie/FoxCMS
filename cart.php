<?php

use database\Database;
use tpl\TemplateLoader;

session_start();

//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
} else {
    $user = $_SESSION['user']['id'];

    include('vendor/vendor.php');
    $db = new Database();
    $tplLoader = new  TemplateLoader();

    ?>

    <?php
    include_once("templates/Assets.php");
    ?>

    <?php
    include_once("templates/view/header.php")
    ?>
    <h5 class="text-dark text-center mt-4">Корзина - <?= $_SESSION['user']['username']; ?></h5>
    <div class="w-100 col-12">
        <div class="w-100 d-flex justify-content-center rounded mt-3">
            <div class="w-75 row col-12 rounded text-dark">
                <div class="col-2">Изображение</div>
                <div class="col-2">Наименование</div>
                <div class="col-2">Количество</div>
                <div class="col-4">Информация</div>
                <div class="col-2">Цена</div>
            </div>
        </div>
    </div>
    <div class="w-100 col-12">


        <?php
        $cartQuery = "SELECT * FROM `cart` where `cart_user_id` = '$user' and `cart_tovar_status` = 'новый'";
        $cartResult = $db->query($cartQuery);
        while ($cartRow = $cartResult->fetch_array()) {
            /*<?= $cartRow['0']; ?>
            <?= $cartRow['1']; ?>
            <?= $cartRow['2']; ?>
            <?= $cartRow['3']; ?>
            <?= $cartRow['4']; ?>

            <?= $cartRow['6']; ?>
            <?= $cartRow['7']; ?>
            <?= $cartRow['8']; ?>*/
            $count = $cartRow[3];
            $price = $cartRow[7];

            $search = [
                "%CartItemLink%",
                "%CartItemCount%",
                "%CartItemName%",
                "%CartItemAbout%",
                "%CartItemPrice%",
                "%CartItemIdControl%"
            ];
            $replace = [
                $cartRow['5'],
                $cartRow['3'],
                $cartRow['4'],
                $cartRow['6'],
                $cartRow[7],
                $cartRow[0]
            ];
            $check = $cartRow[0];
            $sum = $count * $price;
            $TotalCost +=$sum;
            if($check != null){
                echo $tplLoader->sendSimpleTemplate("ItemCart",$search,$replace);
            }
        }
        if($check == null){
            echo $tplLoader->sendSimpleTemplate("ItemCartNullable",$search,$replace);
        }

        $itemId = $_POST['tovarId'];

        $itemQuery = "SELECT * FROM `tovar` WHERE `tovar_id` = '$itemId'";
        $itemResult = $db->query($itemQuery);

        while ($itemRow = $itemResult->fetch_array()) {

            $cartTovarId = $itemRow[0];
            $cartTovarName = $itemRow[1];
            $imagePath = "uploads/items/" . $itemRow[6];
            $cartTovarAbout = $itemRow[4];
            $cartTovarCost = $itemRow[3];

        }
        if($_POST['minus'] == "-"){
            $getId = $_POST['CartItemIdControl'];
            if($count == 1){
                $queryrem = "DELETE FROM  `cart` WHERE  `cart_id` = '$getId'";
            }else{
                $count = (int)$count-1;
                $queryrem = "UPDATE `cart` set `cart_count` = '$count' where `cart_id` = '$getId'";
            }
            //$db->query($queryrem);
            $db->query($queryrem);
            ?>
           <meta http-equiv="refresh" content="1">
            <?
        }

        if($_POST['plus'] == "+"){
            $getId = $_POST['CartItemIdControl'];
            $count = $count+1;
            $query = "UPDATE `cart` set `cart_count` = '$count' where `cart_id` = '$getId'";
            $db->query($query);
            ?>
             <meta http-equiv="refresh" content="1">
        <?php
        }
        if ($_POST['toCart']) {
            $toCartQuery = "INSERT INTO `cart` (`cart_tovar_id`,`cart_user_id`,`cart_count`,`cart_tovar_name`,`cart_tovar_img`,`cart_tovar_about`,`cart_tovar_cost`) 
    VALUES ('$cartTovarId','$user',1,'$cartTovarName','$imagePath','$cartTovarAbout','$cartTovarCost') ";
            $toCartResult = $db->query($toCartQuery);
        }
        ?>
    </div>
    <div class="w-100 col-12 mt-4">
        <div class="col-12 w-100">
            <div class="w-100 rounded text-dark d-flex justify-content-center">
                <div class="col-3"><h6>Цена всего: <?= $TotalCost;?></h6></div>
                <div class="col-3"></div>
                <div class="col-3">
                    <form action="cart.php" method="post">
                        <input type="submit" value="Оформить заказ" name="proceed" class="btn btn-outline-success">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
        if($_POST['proceed']){
            ?>
            <div class="w-100 col-12 mt-4">
                <div class="col-12 w-100">
                    <div class="col-12 text-center"><h5>Оформление заказа</h5></div>
                    <div class="w-100 rounded text-dark d-flex justify-content-center">
                        <div class="row g-5">
                            <div class="my-3">
                                <div class="form-check">
                                    <input id="credit" name="paymentMethod" type="radio" class="form-check-input text-dark" checked="" required="">
                                    <label class="form-check-label" for="credit">Credit card</label>
                                </div>
                                <div class="form-check">
                                    <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required="">
                                    <label class="form-check-label" for="debit">Debit card</label>
                                </div>
                                <div class="form-check">
                                    <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required="">
                                    <label class="form-check-label" for="paypal">PayPal</label>
                                </div>
                            </div>

                            <div class="row gy-3">
                                <form action="proceed.php" method="post">
                                    <div class="col-md-6">
                                        <label for="cc-name" class="form-label">Держатель карты</label>
                                        <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                                        <small class="text-muted">Полное имя написанное на карте</small>
                                        <div class="invalid-feedback">
                                            Необходимо ввести имя держателя карты
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="cc-number" class="form-label">Номер карты</label>
                                        <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                                        <div class="invalid-feedback">
                                            Необходимо ввести номер карты
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="cc-expiration" class="form-label"> Срок истечения карты</label>
                                        <input type="month" class="form-control" id="cc-expiration" placeholder="" required="">
                                        <div class="invalid-feedback">
                                            Срок истечения карты обязателен к вводу
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="cc-cvv" class="form-label">CVV</label>
                                        <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                                        <div class="invalid-feedback">
                                            Security code required
                                        </div>
                                    </div>
                            </div>

                            <hr class="my-4">

                            <button class="w-100 btn btn-success btn-lg" type="submit">Оплатить</button>
                                </form>

                        </div>
                    </div>
                </div>
            </div>
            <?php
        }

    ?>

    <?php
    include_once("templates/view/footer.php");
    ?>


    <?php
    include_once("templates/Scripts.php");
}
?>
