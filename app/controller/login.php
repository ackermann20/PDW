<?php
//session_start();
//include "model/db_helper.php";
//include "view/html_helper.php";

function main_login()
{
	$action = @$_GET['action'] ?: "";
	$msg = '';

	//	if(isset($_POST['logout'] ))
	if( $action == 'logout' )
	{
		// l'utilisateur est en train de se délogguer
		// logout_print();
		session_unset();
		$msg ='<script type="text/javascript">
        alert("vous vous êtes déconnecté")

    </script>';
	}

    if (!empty($_POST['user']) && !empty($_POST['pswd'])) {
        // Faire quelque chose si les deux conditions sont vraies


            // l'utilisateur est en train de s'identifier
            list($valide, $_SESSION['id'], $_SESSION['pswd']) = login_validate($_POST['user'], $_POST['pswd']);
            // si identification ratée
            if ($valide){
                       echo '<script type="text/javascript">
                            alert("bienvenue")
                            </script>';
            }

            elseif (!$valide) {
                // unknown_user_print();
                session_unset();
                $msg = "Vous n'êtes pas identifié.";
                }
        }


	else
	{
		// l'utilisateur n'est pas identifié
		$msg .= html_unidentified_user();
	}

    return join( "\n", [
		ctrl_head(),
		html_open_form(),
		$msg,
		html_link_home(),
		html_close_form(),
		html_foot()
	]);

}

?>