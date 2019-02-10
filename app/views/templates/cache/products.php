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
$bm = new BrandModel();
$brands = $bm->getAll();
?>

<div class="container">
    <div class="left-col">
        <form action="/goods/filter" class="registration" method="post">
            <label>Price</label>
            <input type="number" name="price1" placeholder="from" class="input">
            <input type="number" name="price2" placeholder="to" class="input">
            <div class="span-check">
                <label style="margin-bottom: 5px">Brands</label>
                <?php foreach($brands as $brand): ?>
                    <span><input type="checkbox" name="manufacturers[]" value="<?=$brand['name']?>"><?=$brand['name']?></span>
                <?php endforeach; ?>
<!--                <span><input type="checkbox" name="manufacturers[]" value="Yamaha">Yamaha</span>-->
<!--                <span><input type="checkbox" name="manufacturers[]" value="Martin">Martin</span>-->
<!--                <span><input type="checkbox" name="manufacturers[]" value="Gibson">Gibson</span>-->
<!--                <span><input type="checkbox" name="manufacturers[]" value="Fender">Fender</span>-->
<!--                <span><input type="checkbox" name="manufacturers[]" value="Ibanez">Ibanez</span>-->
<!--                <span><input type="checkbox" name="manufacturers[]" value="Breedlove">Breedlove</span>-->
<!--                <span><input type="checkbox" name="manufacturers[]" value="Takamine">Takamine</span>-->
                <input type="submit" name="button" value="Submit" class="submit">
            </div>
        </form>
    </div>
    <div class="main">
        <?php foreach ($data as $product): ?>
        <div class="prod">
            <div class="photo">
                <a href="/goods/<?=$product['id']?>"><img src="../<?=$product['image']?>"></a>
            </div>
            <div class="info">
                <a href="/goods/brand/<?=$product['brand_id']?>" class="manufacturer"><i>by <?=$product['brand_id']?></i></a>
                <a href="/goods/<?=$product['id']?>" class="name"><?=$product['title']?></a>
                <span class="price"><?=$product['price']?><span class="fa fa-usd"></span></span>
                <a href="cart/add/<?=$product['id']?>" class="add"><span>ADD TO CART</span></a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>