<?php
session_start();
$conf = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . "/Config.ini");

if (isset($_SESSION['user']) and $_SESSION['user']['status'] == "1") {
    if ($conf['admin'] == "enabled") {
        include_once("templates/view/adminHeader.php");
        if ($_GET['logout'] == 1) {
            unset($_SESSION['user']);
            ?>
            <meta http-equiv="refresh" content="1">
            <?php
        }

        include("vendor/vendor.php");
        include("templates/Assets.php");
        $tplLoader = new \tpl\TemplateLoader();
        $db = new \database\Database();

        ?>

        <div class="container-fluid">
        <div class="row">
        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky pt-3 sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="admin.php?dashboard=1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-home align-text-bottom" aria-hidden="true">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                    Панель Управления
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin.php?orders=1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-file align-text-bottom" aria-hidden="true">
                                        <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="13 2 13 9 20 9"></polyline>
                                    </svg>
                                    Заказы
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin.php?products=1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-shopping-cart align-text-bottom"
                                         aria-hidden="true">
                                        <circle cx="9" cy="21" r="1"></circle>
                                        <circle cx="20" cy="21" r="1"></circle>
                                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                    </svg>
                                    Продукты
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin.php?users=1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-users align-text-bottom" aria-hidden="true">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    Пользователи
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin.php?api=1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-layers align-text-bottom" aria-hidden="true">
                                        <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                                        <polyline points="2 17 12 22 22 17"></polyline>
                                        <polyline points="2 12 12 17 22 12"></polyline>
                                    </svg>
                                    API
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main class="col-md-12 ms-sm-auto  px-md-4">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <?php
                    if ($_GET['dashboard'] == 1) {

                    $OrdersQuery = "SELECT * FROM `orders` RIGHT JOIN `cart` on OrderCartId = cart_id order by `OrderId` desc ";
                    $OrdersResult = $db->query($OrdersQuery);
                    $Table = '';


                    echo $tplLoader->sendAdminTemplate("Dashboard", "%s%", "%d%");
                    ?>
                    <h2>Последние проданные товары</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Наименование</th>
                                <th scope="col">Дата</th>
                                <th scope="col">Статус</th>
                                <th scope="col">Цена</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $ctn = 0;
                            while ($OrdersRow = $OrdersResult->fetch_array()) {
                                $ctn++;
                                $search = [
                                    "%OrderId%",
                                    "%OrderName%",
                                    "%OrderDate%",
                                    "%CartTovarStatus%",
                                    "%CartTovarCost%"
                                ];
                                $replace = [
                                    $OrdersRow[0],
                                    $OrdersRow[8],
                                    $OrdersRow[2],
                                    $OrdersRow[12],
                                    $OrdersRow[11],

                                ];
                                echo $tplLoader->sendSimpleTemplate("TableRow", $search, $replace);
                            }

                            ?>
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>

        <?php
        }
        if ($_GET['orders'] == 1) {
            echo $tplLoader->sendAdminTemplate("Orders", "%", "%");

            $OrdersQuery = "SELECT * FROM `orders` RIGHT JOIN `cart` on OrderCartId = cart_id order by `OrderId` desc ";
            $OrdersResult = $db->query($OrdersQuery);
            $Table = '';


            ?>
            <div class="container-fluid">
                <div class="row">
                    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                        <h2>Заказы</h2>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Наименование</th>
                                    <th scope="col">Дата</th>
                                    <th scope="col">Статус</th>
                                    <th scope="col">Цена</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $ctn = 0;
                                while ($OrdersRow = $OrdersResult->fetch_array()) {
                                    $ctn++;
                                    $search = [
                                        "%OrderId%",
                                        "%OrderName%",
                                        "%OrderDate%",
                                        "%CartTovarStatus%",
                                        "%CartTovarCost%"
                                    ];
                                    $replace = [
                                        $OrdersRow[0],
                                        $OrdersRow[8],
                                        $OrdersRow[2],
                                        $OrdersRow[12],
                                        $OrdersRow[11],

                                    ];
                                    echo $tplLoader->sendSimpleTemplate("TableRow", $search, $replace);
                                }

                                ?>
                                </tbody>
                            </table>
                        </div>
                    </main>
                </div>
            </div>
            <?php
        }

        if ($_GET['products'] == 1) {
            echo $tplLoader->sendAdminTemplate("Orders", "%", "%");

            $OrdersQuery = "SELECT * FROM `tovar`";
            $OrdersResult = $db->query($OrdersQuery);
            $Table = '';


            ?>
            <div class="container-fluid">
                <div class="row">
                    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                        <h2>Товары</h2>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Наименование</th>
                                    <th scope="col">Количество</th>
                                    <th scope="col">Цена</th>
                                    <th scope="col">Описание</th>
                                    <th scope="col">Страна</th>
                                    <th scope="col">Категория</th>
                                    <th scope="col">Редактировать</th>
                                    <th scope="col">Удалить</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $ctn = 0;
                                while ($OrdersRow = $OrdersResult->fetch_array()) {
                                    $ctn++;
                                    $search = [
                                        "%ID%",
                                        "%NAME%",
                                        "%COUNT%",
                                        "%PRICE%",
                                        "%ABOUT%",
                                        "%COUNTRY%",
                                        "%CATEGORY%",
                                        "%EDIT%",
                                        "%REMOVE%"
                                    ];
                                    $replace = [
                                        $OrdersRow[0],
                                        $OrdersRow[1],
                                        $OrdersRow[2],
                                        $OrdersRow[3],
                                        $OrdersRow[4],
                                        $OrdersRow[5],
                                        $OrdersRow[8],
                                        "<button class='btn btn-warning' name='edit' value='edit'>Изменить</button>",
                                        "<button class='btn btn-danger' name='remove' value='remove'>Удалить</button>"

                                    ];
                                    echo $tplLoader->sendAdminTemplate("TovarTableRow", $search, $replace);
                                }

                                ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Наименование</th>
                                    <th scope="col">Количество</th>
                                    <th scope="col">Цена</th>
                                    <th scope="col">Описание</th>
                                    <th scope="col">Страна</th>
                                    <th scope="col">Категория</th>
                                    <th scope="col">Редактировать</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php


                                    $search = [
                                        "%ID%",
                                        "%NAME%",
                                        "%COUNT%",
                                        "%PRICE%",
                                        "%ABOUT%",
                                        "%COUNTRY%",
                                        "%CATEGORY%",
                                        "%SEND%"
                                    ];
                                    $replace = [
                                        $OrdersRow[0],
                                        $OrdersRow[1],
                                        $OrdersRow[2],
                                        $OrdersRow[3],
                                        $OrdersRow[4],
                                        $OrdersRow[5],
                                        $OrdersRow[8],
                                        "<button class='btn btn-success' name='create' value='edit'>Добавить!</button>",
                                    ];
                                    echo $tplLoader->sendAdminTemplate("TovarTableCreate", $search, $replace);
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </main>
                </div>
            </div>
            <?php

        }
        if ($_GET['users'] == 1) {
            echo $tplLoader->sendAdminTemplate("Orders", "%", "%");

            $OrdersQuery = "SELECT * FROM `users`";
            $OrdersResult = $db->query($OrdersQuery);
            $Table = '';


            ?>
            <div class="container-fluid">
                <div class="row">
                    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                        <h2>Пользователи</h2>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Логин</th>
                                    <th scope="col">Почта</th>
                                    <th scope="col">Пароль</th>
                                    <th scope="col">API-токен</th>
                                    <th scope="col">Статус</th>
                                    <th scope="col">Адрес</th>
                                    <th scope="col">Редактировать</th>
                                    <th scope="col">Удалить</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $ctn = 0;
                                while ($OrdersRow = $OrdersResult->fetch_array()) {
                                    $ctn++;
                                    $search = [
                                        "%ID%",
                                        "%NAME%",
                                        "%COUNT%",
                                        "%PRICE%",
                                        "%ABOUT%",
                                        "%COUNTRY%",
                                        "%CATEGORY%",
                                        "%EDIT%",
                                        "%REMOVE%"
                                    ];
                                    $replace = [
                                        $OrdersRow[0],
                                        $OrdersRow[1],
                                        $OrdersRow[2],
                                        $OrdersRow[3],
                                        $OrdersRow[4],
                                        $OrdersRow[5],
                                        $OrdersRow[8],
                                        "<button class='btn btn-warning' name='edituser' value='edit'>Изменить</button>",
                                        "<button class='btn btn-danger' name='removeuser' value='remove'>Удалить</button>"

                                    ];
                                    echo $tplLoader->sendAdminTemplate("UserTableRow", $search, $replace);
                                }

                                ?>
                                </tbody>
                            </table>
                        </div>
                    </main>
                </div>
            </div>




<?php





















        }
        if ($_GET['api'] == 1) {
            echo "api";
        }






        if ($_POST['edituser'] == "edit") {
            echo $tplLoader->sendAdminTemplate("Orders", "%", "%");
            $user_id = $_POST['id'];
            $OrdersQuery = "SELECT * FROM `users` where id = '$user_id`'";
            $OrdersResult = $db->query($OrdersQuery);
            $Table = '';


            ?>
            <div class="container-fluid">
                <div class="row">
                    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                        <h2>Пользователи - изменить</h2>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Логин</th>
                                    <th scope="col">Почта</th>
                                    <th scope="col">Пароль</th>
                                    <th scope="col">API-токен</th>
                                    <th scope="col">Статус</th>
                                    <th scope="col">Адрес</th>
                                    <th scope="col">Редактировать</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $ctn = 0;
                                while ($OrdersRow = $OrdersResult->fetch_array()) {
                                    $ctn++;
                                    $search = [
                                        "%ID%",
                                        "%NAME%",
                                        "%MAIL%",
                                        "%PASSWORD%",
                                        "%APITOKEN%",
                                        "%STATUS%",
                                        "%ADRESS%",
                                        "%SEND%"
                                    ];
                                    $replace = [
                                        $OrdersRow[0],
                                        $OrdersRow[1],
                                        $OrdersRow[2],
                                        $OrdersRow[3],
                                        $OrdersRow[4],
                                        $OrdersRow[5],
                                        $OrdersRow[8],
                                        "<button class='btn btn-warning' name='editfinaluser' value='edit'>Изменить!</button>",
                                    ];
                                    echo $tplLoader->sendAdminTemplate("UserTableEdit", $search, $replace);
                                }


                                ?>
                                
                                </tbody>
                            </table>
                        </div>
                    </main>
                </div>
            </div>
            <?php

        }
        if ($_POST['editfinaluser'] == 'edit') {
            $userID = $_POST['userID'];
            $userNAME = $_POST['userNAME'];
            $userMAIL = $_POST['userMAIL'];
            $userPASSWORD = $_POST['userPASSWORD'];
            $userAPITOKEN = $_POST['userAPITOKEN'];
            $userSTATUS = $_POST['userSTATUS'];
            $userADRESS = $_POST['userADRESS'];


            $queryTovar = "UPDATE `users` set `username` = '$userNAME',`email` = '$userMAIL',`password`='$userPASSWORD',`auth_token`='$userAPITOKEN',`status`='$userSTATUS',`adress` = '$userADRESS' 
               where `id` = '$userID'";
            $db->query($queryTovar);
            $_GET['products'] = 1;
            ?>
            <meta http-equiv="refresh" content="1;/admin.php?users=1">
            <?

        }
        if ($_POST['removeuser'] == "remove") {
            $userID = $_POST['userID'];
            $tovarNAME = $_POST['tovarNAME'];
            $tovarCOUNT = $_POST['tovarCOUNT'];
            $tovarPRICE = $_POST['tovarPRICE'];
            $tovarABOUT = $_POST['tovarABOUT'];
            $tovarCOUNTRY = $_POST['tovarCOUNTRY'];
            $tovarCATEGORY = $_POST['tovarCATEGORY'];


            $queryTovarremove = "DELETE FROM `users` where `id` = '$userID'";
            $db->query($queryTovarremove);
            $_GET['products'] = 1;
            ?>
            <meta http-equiv="refresh" content="1;/admin.php?users=1">
            <?
        }









        if ($_POST['edit'] == "edit") {
            echo $tplLoader->sendAdminTemplate("Orders", "%", "%");
            $tovar_id = $_POST['id'];
            $OrdersQuery = "SELECT * FROM `tovar` where tovar_id = '$tovar_id'";
            $OrdersResult = $db->query($OrdersQuery);
            $Table = '';


            ?>
            <div class="container-fluid">
                <div class="row">
                    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                        <h2>Товары</h2>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Наименование</th>
                                    <th scope="col">Количество</th>
                                    <th scope="col">Цена</th>
                                    <th scope="col">Описание</th>
                                    <th scope="col">Страна</th>
                                    <th scope="col">Категория</th>
                                    <th scope="col">Редактировать</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $ctn = 0;
                                while ($OrdersRow = $OrdersResult->fetch_array()) {
                                    $ctn++;
                                    $search = [
                                        "%ID%",
                                        "%NAME%",
                                        "%COUNT%",
                                        "%PRICE%",
                                        "%ABOUT%",
                                        "%COUNTRY%",
                                        "%CATEGORY%",
                                        "%SEND%"
                                    ];
                                    $replace = [
                                        $OrdersRow[0],
                                        $OrdersRow[1],
                                        $OrdersRow[2],
                                        $OrdersRow[3],
                                        $OrdersRow[4],
                                        $OrdersRow[5],
                                        $OrdersRow[8],
                                        "<button class='btn btn-warning' name='editfinal' value='edit'>Изменить!</button>",
                                    ];
                                    echo $tplLoader->sendAdminTemplate("TovarTableEdit", $search, $replace);
                                }


                                ?>

                                </tbody>
                            </table>
                        </div>
                    </main>
                </div>
            </div>
            <?php

        }
        if ($_POST['create'] == 'edit') {
            $tovarID = $_POST['tovarID'];
            $tovarNAME = $_POST['tovarNAME'];
            $tovarCOUNT = $_POST['tovarCOUNT'];
            $tovarPRICE = $_POST['tovarPRICE'];
            $tovarABOUT = $_POST['tovarABOUT'];
            $tovarCOUNTRY = $_POST['tovarCOUNTRY'];
            $tovarCATEGORY = $_POST['tovarCATEGORY'];


            $queryTovar = "INSERT INTO `tovar` (`tovar_name`,`tovar_count`,`tovar_price`,`tovar_about`,`tovar_country`,`category`) VALUES ('$tovarNAME','$tovarCOUNT','$tovarPRICE','$tovarABOUT','$tovarCOUNTRY','$tovarCATEGORY')";
            $db->query($queryTovar);
            $_GET['products'] = 1;
            ?>
            <meta http-equiv="refresh" content="1;/admin.php?products=1">
            <?

        }
        if ($_POST['editfinal'] == 'edit') {
            $tovarID = $_POST['tovarID'];
            $tovarNAME = $_POST['tovarNAME'];
            $tovarCOUNT = $_POST['tovarCOUNT'];
            $tovarPRICE = $_POST['tovarPRICE'];
            $tovarABOUT = $_POST['tovarABOUT'];
            $tovarCOUNTRY = $_POST['tovarCOUNTRY'];
            $tovarCATEGORY = $_POST['tovarCATEGORY'];


            $queryTovar = "UPDATE `tovar` set `tovar_name` = '$tovarNAME',`tovar_count` = '$tovarCOUNT',`tovar_price`='$tovarPRICE',`tovar_about`='$tovarABOUT',`tovar_country`='$tovarCOUNTRY',`category` = '$tovarCATEGORY' where `tovar_id` = '$tovarID'";
            $db->query($queryTovar);
            $_GET['products'] = 1;
            ?>
            <meta http-equiv="refresh" content="1;/admin.php?products=1">
            <?

        }
        if ($_POST['remove'] == "remove") {
            $tovarID = $_POST['id'];
            $tovarNAME = $_POST['tovarNAME'];
            $tovarCOUNT = $_POST['tovarCOUNT'];
            $tovarPRICE = $_POST['tovarPRICE'];
            $tovarABOUT = $_POST['tovarABOUT'];
            $tovarCOUNTRY = $_POST['tovarCOUNTRY'];
            $tovarCATEGORY = $_POST['tovarCATEGORY'];


            $queryTovarremove = "DELETE FROM `tovar` where `tovar_id` = '$tovarID'";
            $db->query($queryTovarremove);
            $_GET['products'] = 1;
            ?>
            <meta http-equiv="refresh" content="1;/admin.php?products=1">
            <?
        }

        ?>

        <?php

        ?>

        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
                integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE"
                crossorigin="anonymous"></script>
        <script type="text/javascript" src="templates/assets/chart.js/dist/chart.min.js"></script>
        <script type="text/javascript" src="templates/assets/js/dashboard.js"></script>

        <?php
        include("templates/Scripts.php");
    } else {
        echo $tplLoader->sendSimpleTemplate("AdminDisabled", "%DisabledText%", "Вероятно Админ-панель отключена в настройках сайта (Config.ini)");
    }
} else {
    header("Location: index.php");
}


?>