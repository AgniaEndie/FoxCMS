<div class="w-100 d-flex justify-content-center rounded mt-3">
    <div class="w-75 row col-12 rounded bg-dark text-white">
        <div class="col-2 d-flex align-items-center"><img class="rounded mx-auto d-block" src="%CartItemLink%" alt="" height="110" width="83">
        </div>
        <div class="col-2 d-flex align-items-center">%CartItemName%</div>
        <div class="col-2 row justify-content-center d-flex">
            <form action="cart.php" class="row d-flex align-items-center" method="post">
                <div class="col-4">
                    <button type="submit" class="btn btn-outline-light" name="plus" value="+">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-bag-plus" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z"/>
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                        </svg>
                    </button>
                </div>
                <div class="col-4">%CartItemCount% Шт</div>
                <div class="col-4">
                    <button type="submit" class="btn btn-outline-light" name="minus" value="-">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-bag-dash" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M5.5 10a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                        </svg>
                    </button>
                </div>
                <input type="hidden" name="CartItemCountControl" value="%CartItemCount%">
                <input type="hidden" name="CartItemIdControl" value="%CartItemIdControl%">
            </form>
        </div>

        <div class="col-4 d-flex align-items-center">%CartItemAbout%</div>
        <div class="col-2 d-flex align-items-center">%CartItemPrice%</div>
    </div>
</div>