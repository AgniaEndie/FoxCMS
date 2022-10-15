<?php
session_start();

include ('vendor/vendor.php');
//$tplloader = new \tpl\TemplateLoader();
//echo( $tplloader->sendSimpleTemplate("SimpleTemplate"));

$tplLoader = new \tpl\TemplateLoader();
$authProvider = new \auth\AuthProvider();
$db = new \database\Database();
?>

<?php
include_once ("templates/Assets.php");
?>

<?php
include_once ("templates/view/header.php")
?>

<?php
if(isset($_GET)){
    include_once ("templates/view/main.php");

    include_once("catalogue.php");

}

?>

<?php
include_once ("templates/view/footer.php");
?>


<?php
include_once ("templates/Scripts.php");


if($_POST['reg'] == "Регистрация"){
    $username = $_POST['regLogin'];
    $email = $_POST['regEmail'];
    $password = $_POST['regPass'];
    $adress = $_POST['adress'];

    $regResult = $authProvider->Registry($username,$email,$password,$adress);

}


if($_POST['auth'] == "Войти"){
    $username = $_POST['authLogin'];
    $password = $_POST['authPass'];

    $authResult = $authProvider->Auth($username,$password);
}
?>
