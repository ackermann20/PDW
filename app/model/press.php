<?php
require_once "../asset/config/model.php";

/**
 * create and return PDO object
 * @return mixed|PDO
 */
function get_pdo()
{
    static $pdo;

    if( ! isset($pdo))
    {
        $pdo = new PDO( DSN, DATABASE_USERNAME, DATABASE_PASSWORD );
        $pdo->query("set names UTF8");
    }

    return $pdo;
}

function get_breaking_article()
{
    switch(DATABASE_TYPE) {
        case "csv":
            require "../asset/database/news.php";
            foreach( $news_a as $news )
            {
                if( $news['breaking'] )
                {
                    return $news;
                }
            }
            break;

        case "MySql":
            // Establishing Connection with Database
            $pdo = get_pdo();
            // on choisit un article au hasard
            $ident = rand(0,2924);
            $sql = <<< SQL
                SELECT 
                    ident_art AS id,
                    title_art AS title,
                    hook_art AS hook,
                    breaking_art AS breaking,
                    category_art AS category,
                    image_art
                FROM `t_article` 
                WHERE breaking_art=1;
SQL;
            $stmt = $pdo->query($sql);
            $row = $stmt->fetch();
            return $row;
            break;
    }

}


/**
 * retourne tous les données des articles favoris
 * @return array
 */
function get_fav_article($fav_l)
{
    switch(DATABASE_TYPE) {
        case "csv":
            require "../asset/database/news.php";
            $outart_a = [];
            foreach ($news_a as $news) {
                if (in_array($news['id'], $fav_l)) {
                    echo "news id : " . $news['id'] . "<br>";
                    var_dump($fav_l);
                    $outart_a[] = $news;
                }
            }
            return $outart_a;
            break;
        case "MySql":
            // Establishing Connection with Database
            $pdo = get_pdo();
            unset($fav_l[0]);
            $fav_l = array_values($fav_l);
            $place_holders = implode(',', array_fill(0, count($fav_l), '?'));
            $sql = <<< SQL
                SELECT 
                    ident_art AS id,
                    title_art AS title,
                    hook_art AS hook,
                    category_art AS category,	
                    image_art AS image_art
                FROM `t_article` 
                WHERE ident_art IN ($place_holders)
SQL;
            $stmt = $pdo->prepare($sql);
            $stmt->execute($fav_l);
            $outart_a = $stmt->fetchAll();
            return $outart_a;
    }
}


function get_side_article()
{
    switch(DATABASE_TYPE) {
        case "csv":
            require "../asset/database/news.php";
            $outart_a = [];
            foreach ($news_a as $news) {
                if ($news['is_on_home'] and !$news['breaking']) {
                    $outart_a[] = $news;
                }
            }
            return $outart_a;
            break;
        case "MySql":
            // Establishing Connection with Database
            $pdo = get_pdo();
            $sql = <<< SQL
                SELECT 
                    ident_art AS id,
                    title_art AS title,
                    hook_art AS hook,
                    category_art AS category,
                    image_art
                FROM `t_article` 
                WHERE `breaking_art` = '0'
                ;
SQL;
            $stmt = $pdo->query($sql);
            $outart_a = $stmt->fetchAll();
            return $outart_a;
            break;
    }
}
function get_side2_article()
{
    switch(DATABASE_TYPE) {
        case "csv":
            require "../asset/database/news.php";
            $outart_a = [];
            foreach ($news_a as $news) {
                if ($news['is_on_home'] and !$news['breaking']) {
                    $outart_a[] = $news;
                }
            }
            return $outart_a;
            break;
        case "MySql":
            // Establishing Connection with Database
            $pdo = get_pdo();
            $sql = <<< SQL
                SELECT 
                    ident_art AS id,
                    title_art AS title,
                    hook_art AS hook,
                    hook_art AS hook,
                    category_art AS category,
                    image_art
                FROM `t_article` 
                WHERE `breaking_art` = '3'
                ;
SQL;
            $stmt = $pdo->query($sql);
            $outart_a = $stmt->fetchAll();
            return $outart_a;
            break;
    }
}
/**
 * @param $id l'if de l'article cherché
 * @return array|bool les données de l'article
 */
function get_article($ident_art)
{
    switch(DATABASE_TYPE) {
        case "csv":
            require "../asset/database/news.php";
            foreach ($news_a as $news) {
                if ($ident_art == $news['id']) {
                    return $news;
                }
            }
            return false;
            break;
        case "MySql":
            // Establishing Connection with Database
            $pdo = get_pdo();
            $sql = <<< SQL
                SELECT 
                    *,
                    ident_art AS id,
                    title_art AS title,
                    hook_art AS hook,
                    content_art AS contents,
                    category_art AS category,	
                    image_art AS image_art
                FROM `t_article` 
                WHERE ident_art= :ident_art
SQL;
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'ident_art' => $ident_art
            ]);
            $outart_a = $stmt->fetch();
            return $outart_a;
            break;
        }
    }

    function get_searched_article($search_kw)
    {
        switch(DATABASE_TYPE) {
            case "MySql":
                // Establishing Connection with Database
                $pdo = get_pdo();
                $sql = <<< SQL
                    SELECT 
                        ident_art AS id,
                        title_art AS title,
                        hook_art AS hook,
                    content_art AS contents,
                    category_art AS category,
                        image_art AS image_art
                    FROM `t_article` 
                    WHERE 
                        title_art LIKE :kw OR hook_art LIKE :kw
                    ;
SQL;
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    'kw' => "%$search_kw%"
                ]);
                $outart_a = $stmt->fetchAll();
                return $outart_a;
        }
    }

