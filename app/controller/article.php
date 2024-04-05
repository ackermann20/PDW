<?php

function main_article()
{
    $id = $_GET['id'];

    $article_a = get_article($id);
    $html_article = html_article($article_a);

    return join( "\n", [
        ctrl_head( ),
        $html_article,
        html_foot(),
    ]);

}

