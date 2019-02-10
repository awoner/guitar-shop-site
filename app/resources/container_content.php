
    <div class="content">
        <div class="tov-container">
           <?php
               include "configuration.php";
               $products = $db::table('products')->select()->get();
               echo $tpl->output('products', $products);
           ?>
        </div>

        <div class="filters">

        </div>
    </div>