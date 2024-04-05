<?php

function html_image($id, $fn="")
{
    if( $id >= 0 )
    {
        // version CSV
        $image = "illustration".$id.".jpg";
    }
    else
    {
        // version MySQL
        $image = $fn;
    }
    $image_path = "./asset/media_article/$image";
    $image_html = "";
    if(file_exists($image_path))
    {
        $image_html = <<< HTML
            <img class="img-fluid rounded-start" alt="illustration" src="$image_path">
         HTML;
    }
    return $image_html;
}

function html_breaking_article($art)
{


    switch(DATABASE_TYPE) {
        case "csv":
            $image_html = html_image($art['id']);
            break;
        case "MySql":
            $image_html = html_image(-1, $art['image_art']);
            break;
    }

    return <<< HTML
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="asset/css/main.css" />
        
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9"> 
            <div class="card my-5" style="background-color: silver ">
                <div class="row g-0">
                    <a href="?page=article&id={$art['id']}">
                        <div class="row">
                            <div class="col-md-5">
                            $image_html
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                <h5 class="card-title">{$art['title']}</h5>
                                <p class="card-text ">{$art['hook']}</p>
                                
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
HTML;
}

function html_listing_article($art_a, $fav_a, $root_tag='aside', $next_page="home")
{
    $html_s = <<< HTML
        <$root_tag>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="asset/css/main.css" />
        
<div class="row" style="display: flex;place-content: center">
HTML;


    foreach( $art_a as $art)
    {
        if( in_array( $art['id'], $fav_a) )
        {
            // article déjà favori => fct "enlever"
            $button_html = <<< HTML
                    <button  type="submit" name="del_favorite" class="btn btn-outline-danger" style="display: flex;place-content: center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    </button>                    
            HTML;
        }
        else
        {
            // article non favori => fct "ajouter"
            $button_html = <<< HTML
                    <button type="submit" name="add_favorite" class="btn btn-outline-danger" style="display: flex;place-content: center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                          <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                        </svg>                  
                    </button>
            HTML;
        }
        switch(DATABASE_TYPE) {
            case "csv":
                $image_html = html_image($art['id']);
                break;
            case "MySql":
                $image_html = html_image(-1, $art['image_art']);
                break;
        }
        $html_s .= <<< HTML
    
        <div class="card col-2 " style="display: flex;min-width: 100px; border: none;" >
            $image_html
            <div class="card-body" style="min-width: 100px;">
                <a href="?page=article&id={$art['id']}">
                    <p class="card-title " >{$art['title']}</p>
                </a> 
                <form method="get">
                    <input type="hidden" name="page" value="$next_page">
                    <input type="hidden" name="art_id" value="{$art['id']}">
                    $button_html   
                </form>
            </div>
        </div>

HTML;
    }
    $html_s .= <<< HTML
        </div>
        </$root_tag>
HTML;
    return $html_s;
}
function html_listing2_article($art_a, $fav_a, $root_tag='aside', $next_page="home")
{
    $html_s = <<< HTML
        <$root_tag>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="asset/css/main.css" />
<div class="row" style="display: flex;justify-content: space-between">
<h3 class="ms-5">Stories for you</h3>
HTML;


    foreach( $art_a as $art)
    {
        if( in_array( $art['id'], $fav_a) )
        {
            // article déjà favori => fct "enlever"
            $button_html = <<< HTML
                    <button  type="submit" name="del_favorite" class="btn btn-outline-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    </button>                    
            HTML;
        }
        else
        {
            // article non favori => fct "ajouter"
            $button_html = <<< HTML
                    <button type="submit" name="add_favorite" class="btn btn-outline-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                          <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                        </svg>                   
                    </button>
            HTML;
        }
        switch(DATABASE_TYPE) {
            case "csv":
                $image_html = html_image($art['id']);
                break;
            case "MySql":
                $image_html = html_image(-1, $art['image_art']);
                break;
        }
        $html_s .= <<< HTML
    
        
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9"> 
            <div class="card my-5">
                <div class="row g-0">
                    <a href="?page=article&id={$art['id']}">
                        <div class="row">
                            <div class="col-md-5">
                            $image_html
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                 <p class="card-title " >{$art['category']}</p>
                                <h5 class="card-title">{$art['title']}</h5>
                                
                                <form method="get">
                    <input type="hidden" name="page" value="$next_page">
                    <input type="hidden" name="art_id" value="{$art['id']}">
                    $button_html   
                </form>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

HTML;
    }
    $html_s .= <<< HTML
        </div>
        </$root_tag>
HTML;
    return $html_s;
}

function html_listing3_article($art_a, $fav_a, $root_tag='aside', $next_page="home")
{
    $html_s = <<< HTML
        <$root_tag>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="asset/css/main.css" />
<div class="row  mt-5"  style="display: flex;justify-content: space-between">
HTML;
    $html_s .= <<< HTML
                    <nav class="navbar bg-body-tertiary my-5">
                        <div class="container-fluid  ">
                            <h1 class="display-3">Mes articles favoris</h1>
                        </div>
                    </nav>
                    <ul class="list-group list-group-flush">
            HTML;

    foreach( $art_a as $art)
    {
        if( in_array( $art['id'], $fav_a) )
        {
            // article déjà favori => fct "enlever"
            $button_html = <<< HTML
                    <button  type="submit" name="del_favorite" class="btn btn-outline-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    </button>                    
            HTML;
        }
        else
        {
            // article non favori => fct "ajouter"
            $button_html = <<< HTML
                    <button type="submit" name="add_favorite" class="btn btn-outline-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                          <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                        </svg>                     
                    </button>
            HTML;
        }
        switch(DATABASE_TYPE) {
            case "csv":
                $image_html = html_image($art['id']);
                break;
            case "MySql":
                $image_html = html_image(-1, $art['image_art']);
                break;
        }

        $html_s .= <<< HTML
    
        
<li class="list-group-item ">





<div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
      $image_html
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <a href="?page=article&id={$art['id']}">
        <h5 class="card-title">{$art['title']}</h5>
        <p class="card-text">{$art['hook']}</p>
        </a>
                <form method="get">
                    <input type="hidden" name="page" value="$next_page">
                    <input type="hidden" name="art_id" value="{$art['id']}">
                    $button_html   
                </form>
      </div>
    </div>
  </div>
</div>

</li>
HTML;
    }
    $html_s .= <<< HTML
        </ul>
        </div>
        </$root_tag>
HTML;
    return $html_s;
}

function html_search_article($art_a, $fav_a, $root_tag='aside', $next_page="home")
{
    $html_s = <<< HTML
        <$root_tag>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="asset/css/main.css" />
<div class="row  mt-5 ms-5"  style="display: flex;place-content: center">
HTML;
    $html_s .= <<< HTML
                    <nav class="navbar bg-body-tertiary my-5">
                        <div class="container-fluid  ">
                            <h2 class="display-3">Résultats</h2>
                        </div>
                    </nav>
                    <ul class="list-group list-group-flush">
            HTML;

    foreach( $art_a as $art)
    {
        if( in_array( $art['id'], $fav_a) )
        {
            // article déjà favori => fct "enlever"
            $button_html = <<< HTML
                    <button  type="submit" name="del_favorite" class="btn btn-outline-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    </button>                    
            HTML;
        }
        else
        {
            // article non favori => fct "ajouter"
            $button_html = <<< HTML
                    <button type="submit" name="add_favorite" class="btn btn-outline-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                          <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                        </svg>                     
                    </button>
            HTML;
        }
        switch(DATABASE_TYPE) {
            case "csv":
                $image_html = html_image($art['id']);
                break;
            case "MySql":
                $image_html = html_image(-1, $art['image_art']);
                break;
        }

        $html_s .= <<< HTML
    
        
<li class="list-group-item ">





<div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
      $image_html
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <a href="?page=article&id={$art['id']}">
        <h5 class="card-title">{$art['title']}</h5>
        <p class="card-text">{$art['hook']}</p>
        </a>
                <form method="get">
                    <input type="hidden" name="page" value="$next_page">
                    <input type="hidden" name="art_id" value="{$art['id']}">
                    $button_html   
                </form>
      </div>
    </div>
  </div>
</div>

</li>
HTML;
    }
    $html_s .= <<< HTML
        </ul>
        </div>
        </$root_tag>
HTML;
    return $html_s;
}


function html_article($art)
{
    switch(DATABASE_TYPE) {
        case "csv":
            $image_html = html_image($art['id']);
            break;
        case "MySql":
            $image_html = html_image(-1, $art['image_art']);
            break;
    }

//    $image_html = html_image($art['id']);
    return <<< HTML
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="asset/css/main.css" />
    <main>
        <article class="main_article">
            <h1>{$art['title']}</h1>
            $image_html
            <h2>{$art['hook']}</h2>
            <section>{$art['contents']}</section>
        </article>
    </main>
HTML;

}
