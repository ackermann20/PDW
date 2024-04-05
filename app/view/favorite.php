<?php

function html_favorite($fav_a)
{
    $html = "<ul>";
    foreach($fav_a as $fav)
    {
        $html .= "<ol>$fav</ol>";
    }
    $html .= "</ul>";
    return $html;
}




