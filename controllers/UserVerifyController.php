<?php

class UserVerifyController
{
    function __construct(){

        $this->view = new View();
    }

    public function verifyUser($parameters){

        require_once 'suport/FilterFields.php';
        require 'models/StudentsModel.php';
        //$passParameter = 1;
        //$userParameter = 0;
        //$studentsModel = new StudentsModel();
        //$niu = cleanInfo($parameters[$userParameter]);
        //$password = cleanInfo($parameters[$passParameter]);
        //$userName = $studentsModel->getUser($niu);
        //$route = "";

        /**TODO DESCOMENTAR ESTO CUANDO HAYA QUE PONERLO EN EL SERVER**/
        // Load the settings from the central config file
        /* require_once '../../CAS/config.php'; //'/var/www/CAS/config.php'
         // Load the CAS lib
         require_once '../../' . $phpcas_path . '/CAS.php';  //'../' . $phpcas_path . '/CAS.php'

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
*/
        // Identificar alumno
        // Comprueba que phpCAS::getUser() es un usuario del sistema
        $niu = '1457749'; //1001691 1000001 1001210
        if((/*phpCAS::getUser()*/ $niu == "1457749" )) //!=null
        {
            //$_SESSION["niu"] = phpCAS::getUser(); // Guardar el niu en variable de sesión
            $_SESSION['loggedin'] = true;
            //$niu = phpCAS::getUser();
            require_once 'models/AdminModel.php';
            require_once 'models/StayModel.php';
            require_once 'models/StudentsModel.php';
            require_once 'models/TeachersModel.php';
            $adminModel = new AdminModel();
            $stayModel = new StayModel();
            $studentsModel = new StudentsModel();
            $teachersModel = new TeachersModel();
            $type = $adminModel->getNiuAdmin($niu);
            $student =$studentsModel->getUser($niu);
            $teacher = $teachersModel->isTeacher($niu);
            $studentsModel->disconnect();
            $teachersModel->disconnect();
            $adminModel->disconnect();
            if(!empty($student)){
                $name = $student->nom.' '.$student->cognom;
            }
            $stay = $stayModel->isStay($niu);
            //HOTFIX RESOLVER EN EL FUTURO
            if(true){
                $_SESSION['stay']=true;
            }
            if(!empty($type)){
                $_SESSION['admin']=true;
            }else{
                $_SESSION['user']=true;
            }
            if(!empty($teacher)){
                $_SESSION['teacher']=true;
                $_SESSION['stay']=true;
                $name = $teacher->nom.' '.$teacher->cognoms;
            }


            $_SESSION['nom'] = $name;
            $_SESSION['niu'] = $niu;
            $_SESSION['start'] = time();
            //$_SESSION['niu'] = "1457749";
            //  header('Location: http://deic-projectes.uab.cat/EEmobi/');
            //$_SESSION['name']= $userName->nom;

        } else
        {
            // Si llega hasta aqui, aunque se haya autenticado bien, no esta en el sistema, lo deslogueamos y le denegamos el acceso
            phpCAS::logout();
        }

    }
}


?>