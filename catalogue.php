<?php
include_once ("vendor/vendor.php");
include_once("templates/Assets.php");
$db = new \database\Database();
$tplLoader = new \tpl\TemplateLoader();

?>
<div class="w-100 d-flex justify-content-center mt-5">
    <div class="row w-75">
        <!--categories-->
        <?php
            $categoryQuery = "SELECT * FROM `category`";
            $categoryResult = $db->query($categoryQuery);


        ?>
        <div class="col-3">
            <form action="index.php" method="post" class="mt-4">
                <?php
                while($categoryRow = $categoryResult->fetch_row()) {
                    //echo $categoryRow[1]."<br>";
                    ?>

                    <button name="categorybtn" class="w-50 text-white btn btn-dark mt-1" value="<?= $categoryRow[0];?>"><?= $categoryRow[1];?></button><br>

                    <?php


                ?>
                <?php
                }
                ?>
            </form>
        </div>
        <!--items-->
        <?php
            if($_POST['categorybtn'] == 3 OR $_POST['categorybtn'] == null ){
                 $itemsQuery = "SELECT * FROM `tovar`";
            }else{
                $cat = $_POST['categorybtn'];
                 $itemsQuery = "SELECT * FROM `tovar` where `category` = '$cat'";
            }
            $itemsResult = $db->query($itemsQuery);
        ?>
        <div class="col-9">
            <?php











            while($itemsRow = $itemsResult->fetch_row()) {
                $search = [
                    "%itemImage%",
                    "%itemImageName%",
                    "%ItemText%",
                    "%ItemTitle%",
                    "%ItemPrice%",
                    "%ItemId%",

                ];

                $replace = [
                    "uploads/items/".$itemsRow[6],
                    $itemsRow[1],
                    $itemsRow[4],
                    $itemsRow[1],
                    $itemsRow[3],
                    $itemsRow[0]
                ];

                echo $tpl = $tplLoader->sendSimpleTemplate("ItemSimple",$search,$replace);


                ?>
            <?php
            }
            ?>
        </div>

    </div>

</div>


<?php
include_once("templates/Scripts.php");
?>
