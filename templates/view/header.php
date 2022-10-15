<?php

?>
<header class="p-3 text-bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" fill="currentColor"
                     class="bi bi-bag-heart" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5Zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0ZM14 14V5H2v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1ZM8 7.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z"/>
                </svg>
                <span class="fs-4">Eshop.ru</span>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/" class="nav-link px-2 text-secondary">Главная</a></li>
                <li><a href="#" class="nav-link px-2 text-white">Каталог</a></li>
                <li><a href="#" class="nav-link px-2 text-white">Коллекции</a></li>
                <li><a href="#" class="nav-link px-2 text-white">О нас</a></li>
            </ul>
            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                <!--<input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">-->
                <div class="input-group">
                    <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Поиск..."
                           aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-success" type="button" id="button-addon2">Поиск</button>
                </div>
            </form>
            <?php
            if (!isset($_SESSION['user'])) {

                ?>

                <div class="text-end">
                    <button type="button" class="btn btn-outline-light me-2" data-bs-toggle="modal"
                            data-bs-target="#auth">Войти
                    </button>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#register">
                        Регистрация
                    </button>
                </div>
                <?php
            } else {
                ?>
                <div class="text-end">
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <a href="profile.php" class="nav-link px-2 text-white"><?= $_SESSION['user']['username'] ?></a>
                        <a href="cart.php" class="nav-link px-2 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>Корзина
                        </a>
                    </ul>
                </div>
                <?php
            }
            ?>


        </div>
    </div>
</header>


<!--Modal Register-->


<div class="modal fade" id="register" tabindex="-1" aria-labelledby="RegModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-orange" id="RegModalLabel">Регистрация</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <form action="index.php" method="post">
                    <label for="floatingInput" class="text-orange">Логин</label>
                    <input name="regLogin" type="text" class="form-control" id="floatingInput" placeholder="Login">
                    <label for="floatingInput" class="text-orange">Email</label>
                    <input name="regEmail" type="email" class="form-control" id="floatingInput"
                           placeholder="email@example.com">
                    <label for="password1" class="text-orange">Пароль</label>
                    <input name="regPass" type="password" class="form-control" id="password1" placeholder="password">
                    <label for="password2" class="text-orange">Пароль (Повторно)</label>
                    <input name="regPassVerify" type="password" class="form-control" id="password2"
                           placeholder="password">
                    <label for="adress" class="text-orange">Адрес</label>
                    <textarea name="adress" id="adress" cols="30" rows="5" class="form-control"></textarea>
            </div>
            <div class="modal-footer">
                <input class="w-100 btn btn-success " type="submit" id="successbtn" name="reg" value="Регистрация">
                </form>
            </div>
        </div>
    </div>
</div>

<!--Modal Auth-->
<div class="modal fade" id="auth" tabindex="-1" aria-labelledby="AuthModalLabel" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-orange" id="AuthModalLabel">Вход</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <form action="index.php" method="post">
                    <label for="floatingInput" class="text-orange">Логин</label>
                    <input name="authLogin" type="text" class="form-control" id="floatingInput"
                           placeholder="vasya_pupkin">
                    <label for="floatingPassword" class="text-orange">Пароль</label>
                    <input name="authPass" type="password" class="form-control" id="floatingPassword"
                           placeholder="password">
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-success  w-100" value="Войти" name="auth">
                </form>
            </div>
        </div>
    </div>
</div>



