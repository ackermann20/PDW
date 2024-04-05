<?php

function html_menu($data_a)
{
    //    ob_start();
    // var_dump($data_a);
    $html_theme_form = html_select_theme();
    $out = '<link rel="stylesheet" href="asset/css/main.css" /> ';
    $out .= '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">';
    $out .= '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>';
    $out .= <<< HTML
                
                <ul class="nav justify-content-center  mb-5">

    HTML;
    foreach( $data_a as $menu_item )
    {
        $title = $menu_item[0];
        $component = $menu_item[1];
        $subcomponent = $menu_item[2];
        $url = <<< HTML
            
                <li class="nav-item ">
                  <a  class="nav-link active" aria-current="page" href="?page=$component&subpage=$subcomponent">$title</a>
                </li>
HTML;
        $out .= $url;
    }
    list( $user, $role, $login_display ) = get_identification();
    if($login_display){
        $out.= html_login_button();
    }
    else{
        $out.= html_logout_button();
    }
    $out .= "</ul>
        $html_theme_form
";
    //    ob_get_clean();
    return $out;
}
