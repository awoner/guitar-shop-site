<style>
    #back{
        background: rgba(255, 255, 255, 0.6);
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
</style>

<?php
$cm = new CategoryModel();
$categories = $cm->getAllAccess();
?>

<div class="container">
    <div class="left-col">
        <form action="/accessories/filter" class="registration" method="post">
            <label>Price</label>
            <input type="number" name="price1" placeholder="from" class="input">
            <input type="number" name="price2" placeholder="to" class="input">
            <div class="span-check">
                <label style="margin-bottom: 5px">Categories</label>
                <?php foreach($categories as $category): ?>
                <span><input type="checkbox" name="categories[]" value="<?=$category['name']?>"><?=$category['name']?></span>
                <?php endforeach; ?>
                <input type="submit" name="button" value="Submit" class="submit">
            </div>
        </form>
    </div>
    <div class="main">
        <?php foreach ($data as $access): ?>
        <div class="prod">
            <div class="photo">
                <a href="/accessories/<?=$access['id']?>"><img src="../<?=$access['image']?>"></a>
            </div>
            <div class="info">
                <a href="/accessories/category/<?=$access['category_id']?>" class="manufacturer"><i><?=$access['category_id']?></i></a>
                <a href="/accessories/<?=$access['id']?>" class="name"><?=$access['title']?></a>

                <span class="price"><?=$access['price']?><span class="fa fa-usd"></span></span>

                <a href="cart/add/accessories/<?=$access['id']?>" class="add"><span>ADD TO CART</span></a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>