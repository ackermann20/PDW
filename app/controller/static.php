<?php

/**
 * traitement d'une page comme : http://4ipdwmvc/?page=static&subpage=about
 * @return string
 */
function main_static()
{
    $subpage = $_GET['subpage'];

    return join( "\n", [
        ctrl_head(),
        file_get_contents("../asset/static/$subpage.html"),
        html_foot(),
    ]);
}

