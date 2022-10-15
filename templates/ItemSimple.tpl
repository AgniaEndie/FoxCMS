<div class="w-100 bg-dark d-flex justify-content-center rounded mt-4">
    <div class="row w-75">
        <div class="col-6">
            <img src="%itemImage%" class="text-white" alt="%itemImageName%" height="330" width="250">
        </div>
        <div class="col-6">
            <!--%ItemTitle%-->
            <h4 class="text-white mt-5"><a class="text-white nav-link itemLink" href="">%ItemTitle%</a></h4>
            <span class="text-white">%ItemText%</span>
            <h5 class="text-white">Цена : %ItemPrice%</h5>
            <form action="item.php" method="post">
                <input type="submit" class="btn btn-success" value="Подробнее">
                <input type="hidden" value="%ItemId%" name="id">
            </form>
        </div>
    </div>
</div>