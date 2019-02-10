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

</style>


<div class="product">
    <div class="row-group">
        <div class="photo"><img src="{{$data['image']}}"></div>
        <div class="information">
            <h2 class="name">{{$data['title']}}</h2>
            <h3 class="manufacturer"><i>{{$data['brand_id']}}</i></h3>
            <span class="price">{{$data['price']}}<span class="fa fa-usd"></span></span>
            <a href="cart/add/{{$data['id']}}" class="add"><span>ADD TO CART</span></a>
        </div>
    </div>
    <section><p>{{$data['description']}}
        </p>    <a href="/goods" class="toProds">Back</a></section>

</div>
