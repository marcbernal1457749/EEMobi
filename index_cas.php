<?php
	// Requerim autenticacio al CAS
	// Load the settings from the central config file
	require_once '../CAS/config.php';
	// Load the CAS lib
	require_once '../' . $phpcas_path . '/CAS.php';

	// Enable debugging
	phpCAS::setDebug();

	// Initialize phpCAS
	phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_context);

	// For production use set the CA certificate that is the issuer of the cert
	// on the CAS server and uncomment the line below
	// phpCAS::setCasServerCACert($cas_server_ca_cert_path);

	// For quick testing you can disable SSL validation of the CAS server.
	// THIS SETTING IS NOT RECOMMENDED FOR PRODUCTION.
	// VALIDATING THE CAS SERVER IS CRUCIAL TO THE SECURITY OF THE CAS PROTOCOL!
	phpCAS::setNoCasServerValidation();

	// force CAS authentication
	phpCAS::forceAuthentication();

	// at this step, the user has been authenticated by the CAS server
	// and the user's login name can be read with phpCAS::getUser().

	// Identificar alumno
	// Comprueba que phpCAS::getUser() es un usuario del sistema 
	//if((phpCAS::getUser() == "1014671"))
	//{
		//$_SESSION["niu"] = phpCAS::getUser(); // Guardar el niu en variable de sesión

	//} else
	//{
		// Si llega hasta aqui, aunque se haya autenticado bien, no esta en el sistema, lo deslogueamos y le denegamos el acceso
		//phpCAS::logout();
	//}

	// Hace logout if si lo solicita
	if (isset($_REQUEST['logout'])) {
		phpCAS::logout();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Pagina web</title>
  
</head>

<body>
    <p>the user's login is <b><?php echo phpCAS::getUser(); ?></b>.</p>
</body>
</html>
