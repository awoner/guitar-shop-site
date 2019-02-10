
<section>
    <div class="col-sm-9 padding-right">
        <div class="features_items" align = 'center'>
            <h2 class="title" align='center'>Корзина</h2>

            <?php if ($productsInCart): ?>
                <p>Вы выбрали такие товары:</p>
                <table class="table1" cellspacing='20px' border-collapse = 'collapse'>

                    <tr>
                        <th>Код товара</th>
                        <th>Название</th>
                        <th>Стомость, грн</th>
                        <th>Количество, шт</th>
                        <th>Удалить</th>
                    </tr>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product['id'];?></td>
                            <td>
                                <a style="color: #000"  href="http://localhost/k/product/<?php echo $product['id'];?>">
                                    <?php echo $product['name'];?>
                                </a>
                            </td>
                            <td><?php echo $product['price'];?></td>
                            <td><?php echo $productsInCart[$product['id']];?></td>
                            <td>
                                <a  href="http://localhost/k/cart/delete/<?php echo $product['id'];?>">
                                    <span class="close"></span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="4">Общая стоимость, грн:</td>
                        <td><?php echo $totalPrice;?></td>
                    </tr>

                </table>
                <br><br>
                <a class="checkout1" style="color: #000" href="http://localhost/k/cart/checkout"> Оформить заказ</a>
            <?php else: ?>
                <p>Корзина пуста</p>

                <a class="checkout1" style="color: #000" href="http://localhost/k/"><i class="fa fa-shopping-cart"></i> Вернуться к покупкам</a>
            <?php endif; ?><br><br><br><br><br>
        </div>
    </div>
</section>