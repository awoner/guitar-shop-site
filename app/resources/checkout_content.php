

<style>
    #back{
        background: rgba(255, 255, 255, 0.6);
        text-align: center;
        height: 800px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
</style>

<form action="/cart/checkout" class="registration" method="post">
    <?php if(!isset($_SESSION['user'])){?>
    <input type="text" pattern="([A-Z][a-z]{1,20})|([А-Я][а-я]{1,20})" name="name" placeholder="Name" class="input">
    <?php } ?>
    <input type="text" name="number" pattern="([\+]?38)?(([\(]0[1-9]{2}[\)])|(0[1-9]{2}))[\d]{7}" placeholder="Phone" class="input">
    <input type="submit" name="button" value="Checkout" class="submit">
</form>