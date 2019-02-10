<?php
class Tpl{
    public function output($template, $data = []){
        require "configuration.php";

        $filePath = $APP_NAME . '/app/views/templates/'.$template.'.php';

        if(!file_exists($filePath))
            exit("Template not found! Please add template in (.../app/views/)");

        $filePath = self::parser($template);
        extract($data, EXTR_SKIP);

        ob_start();
        require $filePath;
        return ob_get_clean();
    }

    private function parser($template){
        require "configuration.php";

        $special_symbols = [
            "{@" => "<?php",
            "@}" => "?>",
            "{{" => "<?=",
            "}}" => "?>"
        ];

        $content = file_get_contents($APP_NAME.'/app/views/templates/'.$template.'.php');

        $filePath = $APP_NAME.'/app/views/templates/cache/'.$template.'.php';
        foreach ($special_symbols as $template_symbol => $php_symbol)
            $content = str_replace($template_symbol, $php_symbol, $content);
        file_put_contents($filePath, $content);
        return $filePath;
    }
}

/*
Route::get('user/{id}', 'UCtrl @ user');

/////////////////////////////////////////////

class UserCtrl extends Controller{
    public function user($id){
        $u = User::find($id);
        return output('user', ['user' => $u]);
    }
}
spl_autoload_register();
*/

/*
.../NameOfSite/
            index.php
            .htaccess
            core/...(Framework){Routing, ORM, ..}
            .css
            .js
            app/
                views/
                controllers/
                web/routs.php
                dbconnect/..
                users/..
*/