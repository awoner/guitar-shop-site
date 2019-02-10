
    <div class="banner-container">
        <div class="myPictures" style="background: url('/app/resources/images/guitar.jpg');">
        </div>

        <div class="myPictures"
             style="background: url('/app/resources/images/guitar1.jpg');  display: none;">
        </div>

        <div class="myPictures" style="background: url('/app/resources/images/guitar2.jpg'); display: none;">
        </div>

        <div id="miniPics">
            <a class="miniPic" onclick="currentPic(1)" style="background-image:url('/app/resources/images/guitar.jpg');"></a>
            <a class="miniPic" onclick="currentPic(2)" style="background-image:url('/app/resources/images/guitar1.jpg');"></a>
            <a class="miniPic" onclick="currentPic(3)" style="background-image:url('/app/resources/images/guitar2.jpg');"></a>
        </div>
        <a class="prev" onclick="prevPic()"><span id="left" class="fas fa-chevron-left"></span></a>
        <a class="next" onclick="nextPic()"><span id="right" class="fas fa-chevron-right"></span></a>
    </div>

    <div class="bestSeller-container">
         <div id="bestSeller">
             <div id="photo">
                 <div id="topText">
                     <span class="fas fa-star"></span>
                     BEST SELLER
                 </div>
                 <a href="#"><img src="/app/resources/images/bestSellerGuitar.png"></a>
             </div>
             <div class="info">
                 <a href="#" class="name">Yamaha FG700S</a>
                 <a href="#" class="manufacturer"><i>by Yamaha Guitar</i></a>
                 <span class="price">2000<span class="fa fa-usd"></span></span>
                 <a href="#" class="add"><span>ADD TO CART</span></a>
                 <div id="rating">
                     <ul>
                         <li class="current"><a href="#" id="star_1" class="fas fa-star"></a></li>
                         <li><a href="#" id="star_2" class="fas fa-star"></a></li>
                         <li><a href="#" id="star_3" class="fas fa-star"></a></li>
                         <li><a href="#" id="star_4" class="fas fa-star"></a></li>
                         <li><a href="#" id="star_5" class="fas fa-star"></a></li>
                     </ul>
                 </div>
                 <a href="#" id="comment">Give Customer review</a>
<!--                 <span id="backWord">SALE</span>-->
             </div>
         </div>
        <div id="slider">
            <div id="sliderbox">
                <ul>
                    <li><div id="prod_1">

                            <div class="photo">
                                <div class="sale-line">SALE</div>
                                <a href="#"><img src="/app/resources/images/bestSellerGuitar.png"></a>
                            </div>
                            <div class="info">
                                <a href="#" class="name">Yamaha FG375S</a>
                                <a href="#" class="manufacturer"><i>by Yamaha Guitar</i></a>
                                <span class="price">1650<span class="fa fa-usd"></span></span>
                                <a href="#" class="add"><span>ADD TO CART</span></a>
                            </div>
                        </div></li>
                    <li><div id="prod_2"></div></li>
                    <li><div id="prod_3"></div></li>
                    <li><div id="prod_4"></div></li>
                    <li><div id="prod_5"></div></li>
                </ul>
            </div>
            <div id="nav_slider">
                <div id="left_nav"><span class="fas fa-chevron-left"></div>
                <div id="right_nav"><span class="fas fa-chevron-right"></div>
            </div>
        </div>
    </div>

    <div class="explore-guitar">
        <a href="#"><span>EXPLORE GUITAR</span></a>
    </div>