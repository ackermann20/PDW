<?php

function html_select_theme()
{
    ob_start();
    ?>

    <form method="post">
        <label>Choisissez votre theme</label>
            <select name="theme">
                <option value="default" selected>Sable</option>
                <option value="sky">Ciel</option>
            </select>
        <button name="b_select_theme">Envoyer</button>
    </form>
    <?php
    return ob_get_clean();
}


function html_head($menu_a=[], $theme="default")
{
    $debug = false;
    $theme_fn = "theme_{$theme}.css";
	ob_start();
	?>
	<html lang="fr">
	<head>
		<title>Yahoo | Mail, Weather, Search, Politics, News, Finance, Sports ...</title>
        <link rel="stylesheet" href="asset/css/main.css" />
        <link rel="stylesheet" href="asset/css/<?=$theme_fn?>">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="icon" type="media/png" href="./asset/media_general/iconyahoo.png">

	</head>
	<body>
    <div class="container" >
        <div class="row">
            <div class="col-my-9 mt-3 text-center mx-auto">
                <div class="d-inline-block me-5"> <!-- Ajout de 'd-inline-block' pour rendre les éléments en ligne -->
                    <a  class="nav-link active" aria-current="page" href="?page=home&subpage=">
                        <img src="./asset/media_general/icone.png">
                    </a>
                </div>

                <div class="d-inline-block align-items-center"> <!-- Ajout de 'align-items-center' pour centrer verticalement les éléments -->




                    <form method="get" class="d-flex align-items-center" role="search">
                    <div class="searchBox">
                        <input class="form-control me-2" type="hidden" name="page" value="search" placeholder="Search" aria-label="Search" style="height: 38px;">
                        <input class="searchInput" type="text" name="search_kw" >
                        <button class="searchButton" type="submit" >



                            <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
                                <g clip-path="url(#clip0_2_17)">
                                    <g filter="url(#filter0_d_2_17)">
                                        <path d="M23.7953 23.9182L19.0585 19.1814M19.0585 19.1814C19.8188 18.4211 20.4219 17.5185 20.8333 16.5251C21.2448 15.5318 21.4566 14.4671 21.4566 13.3919C21.4566 12.3167 21.2448 11.252 20.8333 10.2587C20.4219 9.2653 19.8188 8.36271 19.0585 7.60242C18.2982 6.84214 17.3956 6.23905 16.4022 5.82759C15.4089 5.41612 14.3442 5.20435 13.269 5.20435C12.1938 5.20435 11.1291 5.41612 10.1358 5.82759C9.1424 6.23905 8.23981 6.84214 7.47953 7.60242C5.94407 9.13789 5.08145 11.2204 5.08145 13.3919C5.08145 15.5634 5.94407 17.6459 7.47953 19.1814C9.01499 20.7168 11.0975 21.5794 13.269 21.5794C15.4405 21.5794 17.523 20.7168 19.0585 19.1814Z" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" shape-rendering="crispEdges"></path>
                                    </g>
                                </g>
                                <defs>
                                    <filter id="filter0_d_2_17" x="-0.418549" y="3.70435" width="29.7139" height="29.7139" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"></feColorMatrix>
                                        <feOffset dy="4"></feOffset>
                                        <feGaussianBlur stdDeviation="2"></feGaussianBlur>
                                        <feComposite in2="hardAlpha" operator="out"></feComposite>
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"></feColorMatrix>
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2_17"></feBlend>
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2_17" result="shape"></feBlend>
                                    </filter>
                                    <clipPath id="clip0_2_17">
                                        <rect width="28.0702" height="28.0702" fill="white" transform="translate(0.403503 0.526367)"></rect>
                                    </clipPath>
                                </defs>
                            </svg>


                        </button>
                    </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

    <?php
    echo html_menu($menu_a);

	if($debug)
	{
        var_dump($_COOKIE);
		// var_dump($_SESSION);
        var_dump($_GET);
        //        var_dump($_POST);
	}
	return ob_get_clean();
}

function html_foot()
{
	ob_start();
	?>
    <hr />

    <div style="display: flex;place-content: center">

        <div>
            <ul>
                <il style="font-weight: bold;padding-bottom: 20px;color: blueviolet">Thèmes</il>
                <li>My Europe</li>
                <li>Monde</li>
                <li>Business</li>
                <li>Sport</li>
                <li>Voyage</li>
                <li>Culture</li>

            </ul>
        </div>
        <div>
            <ul>
                <il style="font-weight: bold;padding-bottom: 5px;color: blueviolet">Services</il>
                <li>Live</li>
                <li>Météo</li>
                <li>Apps</li>
                <li>Widgets & Services</li>
                <li>Jeux</li>
                <li>Suivez-nous</li>

            </ul>
        </div>

        <div>
            <ul>
                <il style="font-weight: bold;padding-bottom: 5px;color: blueviolet">Plus</il>
                <li>Commercial Services</li>
                <li>Services UE</li>
                <li>Termes et Conditions</li>
                <li>Politique des Cookies</li>
                <li>Politique de confidentialité</li>
                <li>Contact</li>

            </ul>
        </div>
    </div>
    <div  style="display: flex;place-content: center">
        <p>Copyright &copy; 2023 Mon site web. Tous droits réservés.</p>
    </div>
    </body>
    </html>
	<?php
	return ob_get_clean();
}

