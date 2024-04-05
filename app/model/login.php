<?php
/**
 * valider() vérifie que le nom entré par l'utilisateur existe bien dans 
 * le fichier login.csv
 * @param string $input_user
 * @param string $input_pswd
 * nom entré par l'utilisateur
 * @return array	[0] : true si existe, false si n'existe pas
 * 								[1, 2] : details sur l'utilisateur
 */
function login_validate($input_user, $input_pswd)
{
	try
	{
		// lecture fichier
		$fh = fopen( '../asset/database/login2.csv', 'r' );
		while( ! feof($fh) )
		{
			$ligne = fgets($fh);
			$user_info = explode( ';', trim($ligne) );

			if( $user_info[0] == $input_user and $user_info[1] == $input_pswd )
			{
				// l'utilisateur a été identifié
				// $_SESSION['id'] = $user_info[0];
				// $_SESSION['role'] = $user_info[2];
				fclose($fh);
                $msg_login = '<script type="text/javascript">
                                    alert("vous vous êtes connecté")
                             </script>';
				return array( true,  $user_info[0],$user_info[1], $user_info[2],$msg_login );
			}
		}
		// l'utilisateur n'a pas été identifié
		fclose($fh);
		return array( false, null, null );
	}
	catch( Exception $e)
	{
		echo "Problem while reading file login2.csv : " . $e->getMessage();
		return array( false, null, null );
	}
}

?>