
<style>
    #back{
        background: rgba(255, 255, 255, 0.6);
        text-align: center;
        height: auto;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .cabinet{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        margin: 10px;
        width: 90%;
        height: auto;
    }

    .products{
        width: 90%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

    }

    .products > #cartTopLine{
        width: 100%;
        height: 30px;
        font-size: 1em;
        font-family: "Open Sans Extrabold";
        display: flex;
        flex-direction: row;
        background: #4a95c7;
        color: white;
        justify-content: space-around;
        align-items: center;
        line-height: 30px;
        text-decoration: none;
        padding: 0;
    }

    .products > #cartTopLine > li{
        height: 100%;
        width: 100%;
        margin: 0;
        padding: 0;
        background: #4a95c7;
        border-right: #1f7cba solid 2px;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
    }

    .products > #cartTopLine > li:last-child{
        border: none;
    }

    .products > #cartTopLine > #lineId,
    .products > #cartTopLine > #linePrice,
    .products > #cartTopLine > #lineDelete{
        width: 200px;
    }

    .products > .cartProd > .idProd,
    .products > .cartProd > .priceProd,
    .products > .cartProd > .deleteProd{
        justify-content: center;
        width: 200px;
    }

    .products > #cartTopLine > #linePhoto{
        flex-grow: 4;

    }

    .cartProd{
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }


    .products > .cartProd{
        width: 100%;
        height: 100px;
        font-size: 1em;
        font-family: "Open Sans";
        display: flex;
        flex-direction: row;
        background: darkgrey;
        color: white;
        justify-content: space-around;
        align-items: center;
        line-height: 30px;
        text-decoration: none;
        padding: 0;
        margin-top: 1px;
    }

    .products > .cartProd > li{
        height: 100%;
        width: 100%;
        margin: 0;
        padding: 0;
        background: #4a95c7;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
        border-right: #1f7cba solid 2px;
    }

    .products > .cartProd > li:last-child{
        border: none;
    }

    .products > .cartProd > .titleProd a{
        opacity: 0.7;
        transition: all 0.3s ease;
    }

    .products > .cartProd > .titleProd a:hover{
        opacity: 1;
    }


    .products > .cartProd > .deleteProd span{
        font-family: FontAwesome;
        font-size: 24pt;
        transition: all 0.8s ease;
    }

    .products > .cartProd  > .deleteProd span:hover{
        color: red;
    }

    .products > .cartProd > li img{
        width: 100%;
    }


    #totalPrice{
        font-family: 'Open Sans';
        width: 90%;
        display: flex;
        align-items: center;
        justify-content: space-around;
    }

    #totalPrice > #sum{
        color: red;
        font-family: "Open Sans Extrabold";
        text-decoration: underline;
    }
</style>


<div class="cabinet">
    <h3 class="title">CART</h3>
    {@ if (!empty($data)): @}
        {@ $sum = 0; @}
        <div class="products">
            <ul id="cartTopLine">
                <li id="lineId">id</li>
                <li id="linePhoto">Photo</li>
                <li id="lineName">Name</li>
                <li id="linePrice">Price</li>
                <li id="lineDelete">Delete</li>
            </ul>
            {@ foreach ($data as $product): @}
                <ul class="cartProd">
                    <li class="idProd">{{$product['id']}}</li>
                    <li class="photoProd"><a href="goods/{{$product['id']}}"><img src="{{$product['image']}}"></a></li>
                    <li class="titleProd"><a href="goods/{{$product['id']}}">{{$product['title']}}</a></li>
                    <li class="priceProd">{{$product['total_price']}}<span class="fa fa-usd"></span></li>
                    <li class="deleteProd">
                        {@
                            $prodId = $product['id'];
                        @}
                        <a href="{{(!isset($product['brand_id']))?"/cart/delete/accessories/$prodId":"/cart/delete/$prodId"; }}">
                            <span class="fas fa-times"></span>
                        </a>
                    </li>
                </ul>
                {@ $sum += $product['total_price']; @}
            {@ endforeach; @}
        </div>

    <span id="totalPrice">Total price: <span id="sum">{{$sum}}</span></span>
    <br>
    <a href="/cart/checkout" id="cartSubmit">Next</a>
    <br>
    {@ else: @}
        <p>Cart is empty</p>
        <br>
    {@ endif; @}


    <a href="/goods" class="return">
        <span class="fa-shopping-cart" style="color:white;font-family:FontAwesome;"></span>
        RETURN TO BUY
    </a>
</div>