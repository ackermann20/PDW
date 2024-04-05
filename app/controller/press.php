<?php


/**
 * traiter (GET...) et retourner la liste de favoris
 * @return array
 */
function ctrl_process_fav_form()
{
    $sep = '|';
    $fav_s = $_COOKIE['favorite'] ?? "";
    $fav_l = explode( $sep, $fav_s);
    //    if(empty($_SESSION['favorite'])) $_SESSION['favorite'] = array();
    if(isset($_GET['add_favorite']))
    {
        // on ajoute un article aux favoris
        //        $_SESSION['favorite'][] = $_GET["art_id"];
        $fav_l[] = $_GET["art_id"];
    }
    elseif (isset($_GET['del_favorite']))
    {
        // foreach( $_SESSION['favorite'] as $i =>  $fav )
        foreach( $fav_l as $i =>  $fav )
        {
            if( $fav == $_GET["art_id"] )
            {
                // unset($_SESSION['favorite'][$i]);
                unset($fav_l[$i]);
            }
        }
    }
    // $_SESSION['favorite'] = array_unique($_SESSION['favorite']);
    $fav_l = array_unique($fav_l);
    $fav_s = implode( $sep, $fav_l);
    setcookie('favorite', $fav_s, time()+3600*24*30 );
    return $fav_l;
}

function main_press()
{
    // traitement éventuel des favoris
    $fav_l = ctrl_process_fav_form();

    // traitement du thème
    // $_SESSION['theme'] = $_SESSION['theme'] ?? 'default';
    if(isset($_POST['b_select_theme']))
    {
        $_SESSION['theme'] = $_POST['theme'];
    }

    // étape 2 : breaking news
    $breaking_art = get_breaking_article();
    $breaking_art_html = html_breaking_article($breaking_art,$fav_l);

    // étape 3 : articles sur le côté
    $side_art = get_side_article();
    $side_art_html = html_listing_article($side_art, $fav_l);

    $side2_art = get_side2_article();
    $side2_art_html = html_listing2_article($side_art, $fav_l);

    return join( "\n", [
        ctrl_head(),
        $breaking_art_html,
        $side_art_html,
        html_foot(),
    ]);
}

