<?php

function get_menu_contents()
{
    // paramètres
    $fileName = '../asset/database/menu.csv';
    $sep = "|";
    $menu_a = [];

    // lecture fichier
    $fh = fopen( $fileName, 'r' );

    while( ! feof($fh) )
    {
        $ligne = fgets($fh);
        $menu_a[] = explode( $sep, trim($ligne) );
    }
    fclose($fh);

    return $menu_a;
}

