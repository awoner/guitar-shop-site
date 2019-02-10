<?php
require_once "core/router.php";

$router = new Router();

$router->addRoute("/main", "MainController@main");
$router->addRoute("/registration", "UserController@registration");
$router->addRoute("/activation/[activation]", "UserController@activation@(activation)");

$router->addRoute("/about_us", "MainController@aboutUs");
$router->addRoute("/contact", "MainController@contact");
$router->addRoute("/explore", "MainController@explore");
$router->addRoute("/how_to_buy", "MainController@howToBuy");
$router->addRoute("/return_policy", "MainController@returnPolicy");
$router->addRoute("/reviews", "MainController@reviews");
$router->addRoute("/secure_payment", "MainController@securePayment");
$router->addRoute("/terms_and_conditions", "MainController@termsAndConditions");

$router->addRoute("/signin", "UserController@signIn");
$router->addRoute("/signout", "UserController@signOut");
$router->addRoute("/forgot_pas", "UserController@forgotPas");

$router->addRoute("/cabinet", "UserController@cabinet");
$router->addRoute("/cabinet/edit", "UserController@editInfo");
$router->addRoute("/cabinet/admin", "AdminController@main");

$router->addRoute("/cabinet/admin/category", "AdminController@category");
$router->addRoute("/category/delete/{id}", "AdminController@categoryDelete@(id)");
$router->addRoute("/category/update/{id}", "AdminController@categoryUpdate@(id)");
$router->addRoute("/category/add", "AdminController@categoryAdd");

$router->addRoute("/cabinet/admin/goods", "AdminController@products");
$router->addRoute("/goods/delete/{id}", "AdminController@productDelete@(id)");
$router->addRoute("/goods/update/{id}", "AdminController@productUpdate@(id)");
$router->addRoute("/goods/add", "AdminController@productAdd");

$router->addRoute("/cart", "CartController@action");
$router->addRoute("/cart/add/{id}", "CartController@actionAdd@(id)");
$router->addRoute("/cart/delete/{id}", "CartController@actionDelete@(id)");
$router->addRoute("/cart/add/accessories/{id}", "CartController@actionAddAccess@(id)");
$router->addRoute("/cart/delete/accessories/{id}", "CartController@actionDeleteAccess@(id)");
$router->addRoute("/cart/checkout", "CartController@checkout");

$router->addRoute("/goods", "GoodsController@actionProduct");
$router->addRoute("/goods/{id}", "GoodsController@product@(id)");
$router->addRoute("/goods/filter", "GoodsController@filterProduct");
$router->addRoute("/goods/brand/[name]", "GoodsController@filterBrand@(name)");

$router->addRoute("/accessories", "GoodsController@actionAccessories");
$router->addRoute("/accessories/{id}", "GoodsController@accessories@(id)");
$router->addRoute("/accessories/filter", "GoodsController@filterAccessories");
$router->addRoute("/accessories/category/[name]", "GoodsController@filterCategory@(name)");
$router->addRoute("/bestbuy", "GoodsController@actionBest");

$router->run();