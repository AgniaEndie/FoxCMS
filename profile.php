<?php
session_start();

include ('vendor/vendor.php');
//$tplloader = new \tpl\TemplateLoader();
//echo( $tplloader->sendSimpleTemplate("SimpleTemplate"));
$db = new \database\Database();
$tplLoader = new \tpl\TemplateLoader();
if(isset($_SESSION['user'])){
?>

<?php
include_once ("templates/Assets.php");
?>

<?php
include_once ("templates/view/header.php")
?>

<?php
    if($_GET['logout'] == 1){
        unset($_SESSION['user']);
        ?>
        <meta http-equiv="refresh" content="1">
            <?php
    }
?>


    <div class="w-100 d-flex justify-content-center mt-5">


        <h4 class="text-dark">Здравствуйте <?=$_SESSION['user']['username']?> мы рады вас видеть!</h4>
    </div>
    <div class="w-100 justify-content-center text-center">
        <span class="text-dark">Email: <?= $_SESSION['user']['email'] ?></span>
    </div>
    <?php
    if($_SESSION['user']['status'] == 1){
        ?>
            <div class="w-100 d-flex justify-content-center">
                <a href="admin.php" class="link-danger">Админ-панель</a>
            </div>
            <?php
    }
    ?>
    <div class="w-100 d-flex justify-content-center mt-5">


        <a href="profile.php?logout=1" class="btn btn-danger">Выйти из аккаунта</a>
    </div>



<?php
include_once ("templates/view/footer.php");
?>


<?php
include_once ("templates/Scripts.php");
}else{
    header('Location:index.php');
}
?>
