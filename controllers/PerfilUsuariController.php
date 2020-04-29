<?php
class PerfilUsuariController
{
    function __construct(){
        
        $this->view = new View();
    }

    public function showProfile($parameters){

            $fail = false;
            $doneUpdateOrInsert=false;
            $type = null;
            $pathPhotos = "\EEmobi\\resources\img\post\\";
            $correu = "Sense especificar";
            $nomPublic = "Sense especificar";
            $correuPublic = "Sense especificar";
            $nomComplet = "Sense especificar";
            $stayed = false;
            $isTeacher  = false;
            $hasPublications=false;
            $hasPublicationsSubject=false;
            $hasSubject=false;
            $path = "\EEmobi\\resources\\img\profile.png";
            $contentStay = "NO TENS CAP ESTADA ASIGNADA";

            require_once 'models/StayModel.php';
            require_once 'models/StudentsModel.php';
            require_once 'models/TeachersModel.php';
            require_once 'models/PublicationsModel.php';
            require_once 'models/AcordEstudisModel.php';
            require_once 'models/RatingsModel.php';
            require_once 'models/PublicationsSubjectModel.php';

            $stayModel = new StayModel();
            $studentsModel = new StudentsModel();
            $teachersModel = new TeachersModel();
            $publicationsModel = new PublicationsModel();
            $acordEstudisModel = new AcordEstudisModel();
            $ratingsModel = new RatingsModel();
            $publicationsSubjectModel = new PublicationsSubjectModel();
            
            if($parameters){
                $doneUpdateOrInsert=true;
            }
         
            if(!isset($_SESSION['loggedin'])){
                 header('Location:http://deic-projectes.uab.cat/EEmobi/');        
            }else{
                if(isset($_SESSION['niu'])){
                    $niu = $_SESSION['niu'];
                }

                //unset($_SESSION['teacher']);
                //$_SESSION['teacher'] = true;
                if(isset($_SESSION['teacher'])){
                    $teacher = $teachersModel->isTeacher($niu);
                    $agree = $teachersModel->getAgreementsTeacher($niu);
                    $teachersModel->disconnect();
                    $nomComplet = $teacher->nom .' '. $teacher->cognoms;
                    $correu = $teacher->correuProfessor;
                    $src=$teacher->fotoProfessor;
                    $isTeacher  = true;
                    $publications = $publicationsModel -> getPublicationOfUser($niu);
                    $publicationSubject = $publicationsSubjectModel -> getPublicationSubjectOfUser($niu);
                    if(!empty($publicationSubject)){
                        $hasPublicationsSubject=true;
                    }
                    if(!empty($publications)){
                        $hasPublications=true;
                    }
                    $type = "Coordinador.";
                    if($teacher->nomPublic){
                        $nomPublic = "Sí";
                    }else{
                        $nomPublic = "No";
                    }
                    if($teacher->correuPublic){
                        $correuPublic = "Sí";
                    }else{
                        $correuPublic = "No";
                    }
                    if (isset($_SESSION['admin'])){
                        $isAdmin = true;
                    }else{
                        $isAdmin = false;
                    }

                }else{
                    $student =$studentsModel->getUser($niu);
                    $studentsModel->disconnect();
                    if(!empty($student)){
                        $stay = $stayModel->isStay($niu);
                        if(!empty($stay)){
                            $periode = $stay[0]->semestre;
                            $stayed = true;
                            $publications = $publicationsModel -> getPublicationOfUser($niu);
                            $publicationSubject = $publicationsSubjectModel -> getPublicationSubjectOfUser($niu);
                            $subjects = $acordEstudisModel->getAcordByNiu($niu);
                            $ratings =  $ratingsModel->getStudentRatings($stay[0]->codiEstada);
                            if(!empty($publications)){
                                $hasPublications=true;
                            }

                            if(!empty($publicationSubject)){
                                $hasPublicationsSubject=true;
                            }
                            if(!empty($subjects)){
                                $hasSubject = true;
                                $categories = $ratingsModel->getCategories();
                                $iteratorCategories = 0;
                            }
                            if(!empty($ratings)){
                                $hasRatings=true;

                            }else{
                                $hasRatings=false;
                            }

                        }
                        $src=$student->foto;
                        $type = "Estudiant UAB.";
                        $nomComplet = $student->nom .' '. $student->cognom;
                        $correu = $student->correu;
                        if($student->publicNom){
                            $nomPublic = "Sí";
                         }else{
                            $nomPublic = "No";
                         }
                         if($student->publicMail){
                            $correuPublic = "Sí";
                         }else{
                            $correuPublic = "No";
                         }
                        $stayModel->disconnect(); 
                        $studentsModel->disconnect();  
                        $teachersModel->disconnect();  
                        $publicationsModel->disconnect(); 
                        $acordEstudisModel->disconnect();
                        $ratingsModel->disconnect();
                     }
                }
                if(!empty($src)){
                    $path = "\EEmobi\\resources\\img\profiles\\".$src."?".rand(1245354, 13234555);
                }

                 $route = $this->view->show("perfil.php");
                 
            }
            header("Cache-Control: no-store, must-revalidate, max-age=0");
            include($route);  

    }
    public function editProfile($parameters){
        $route = $this->view->show("EditarPerfil.php");
        require_once 'models/StudentsModel.php';
        $studentsModel = new StudentsModel();
        $nom="";
        $cognom="";
        $correu="";
        $checkedNom=false;
        $checkedCorreu=false;
        $error = false;
        if($parameters){
            $error = true;
        }
        if(!isset($_SESSION['loggedin'])){
             header('Location:http://deic-projectes.uab.cat/EEmobi/');        
        }else{
            if(isset($_SESSION['niu'])){
                $niu = $_SESSION['niu'];
             }
            if(isset($_SESSION['teacher'])){
                require_once 'models/TeachersModel.php';
                $teachersModel = new TeachersModel();
                $teacher = $teachersModel->isTeacher($niu);
                $teachersModel->disconnect();
                $nom = $teacher->nom;
                $cognom =$teacher->cognoms;
                $correu = $teacher->correuProfessor;
                $checkedNom=true;
                $checkedCorreu=true;
                
            }else{
                $student =$studentsModel->getUser($niu);
                $studentsModel->disconnect();
                if(!empty($student)){
                     $nom = $student->nom;
                     $cognom =$student->cognom;
                     $correu = $student->correu;
                     if($student->publicNom){
                        $checkedNom=true;
                     }else{
                        $checkedNom=false;
                     }
                     if($student->publicMail){
                        $checkedCorreu=true;
                     }else{
                        $checkedCorreu=false;
                     }
                 }
            }
        }
        include($route);

    }
    public function verifyUpdate($parameters){
        //$route = $this->view->show("EditarPerfil.php");
        $data = $parameters[0];
        if(!$data['success']){
            $error = true;
            $response['answer']= false;
        }else{
            $niu = $_SESSION['niu'];
            $nom = $data['name'];
            $mail=$data['mail'];
            $cognom = $data['surname'];
            $nomPublic = $data['nompublic'];
            $correuPublic = $data['correupublic'];
            $nom = filter_var($nom,FILTER_SANITIZE_SPECIAL_CHARS,FILTER_SANITIZE_STRING);
            $surname = filter_var($nom,FILTER_SANITIZE_SPECIAL_CHARS,FILTER_SANITIZE_STRING);
            $mail = filter_var($mail,FILTER_SANITIZE_SPECIAL_CHARS,FILTER_SANITIZE_EMAIL);
            $nom = preg_replace("/[^A-Za-z?!]/",'',$nom);
            $cognom = preg_replace("/[^A-Za-z?![:space:]]/","",$cognom);
            if(strcmp($nomPublic, "Si")==0){
                $nomPublic = 1;
            }else{
                $nomPublic = 0;
            }

            if(strcmp($correuPublic, "Si")==0){
                $correuPublic = 1;
            }else{
                $correuPublic = 0;
            }
            require 'models/StudentsModel.php';
            $studentsModel = new StudentsModel();
            if(isset($_SESSION['teacher'])){
                require_once 'models/TeachersModel.php';
                $teachersModel = new TeachersModel();
                $teacher = $teachersModel->updateInfoTeacher($niu,$nom,$cognom,$mail,$nomPublic,$correuPublic);
                $teachersModel->disconnect();

            }
            $studentsModel->updateInfoByNiu($niu,$nom,$cognom,$mail,$nomPublic,$correuPublic);
            $studentsModel->disconnect(); 
            
            /*$student =$studentsModel->getUser($niu);
            if(!empty($student)){
                $studentsModel->updateInfoByNiu($niu,$nom,$cognom,$mail,$nomPublic,$correuPublic);
                $studentsModel->disconnect();
            }else{
                $studentsModel->insertNewUser($niu,$nom,$cognom,$mail,$nomPublic,$correuPublic);
                $studentsModel->disconnect();
            }*/
            $response['answer']= true;
        }
        echo json_encode($response);
    }
    public function editPhoto($parameters){
        $data = $parameters[0];
        if($data['succes']){

            $target_dir=$data['target_dir'];
            $target_file=$data['target_file']; 
            $imageFileType=$data['imageFileType']; 
            $check=$data['check']; 
            if($check == false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $error['msg'] = "El fitxer no es una imatge.";
                $error['succes']=false;
            }
            if (file_exists($target_file)) {
                //echo "Sorry, file already exists.";
                 $error['msg'] = "La imatge ja existeix.";
                 $error['succes']=false;
            }
            // Check file size
            if ($_FILES['file']['size'] > 500000) {
                //echo "Sorry, your file is too large.";
                 $error['msg'] = "La imatge es massa gran.";
                 $error['succes']=false;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType !="JPG"  && $imageFileType != "PNG" && $imageFileType != "JPEG") {
                //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
               $error['msg'] = "Nomes estan permesos les extensions png,jpeg,jpg.";
            }
            if (empty($error['msg'])) {

                if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                    require_once 'models/TeachersModel.php';
                    require_once 'models/StudentsModel.php';
                    $newName = $_SESSION['niu'].'.'.$imageFileType;
                    $nameFile= rename($target_file,$target_dir.$newName);
                    $niu = $_SESSION['niu'];
                    if(isset($_SESSION['teacher'])){
                        $uploadPhotoOn = new TeachersModel();
                        $uploadPhotoOn->insertPhotoOnUser($niu,$newName);

                    }
                    $uploadPhotoOn = new StudentsModel();
                    $uploadPhotoOn->insertPhotoOnUser($niu,$newName);
                    $error['src'] = "\EEmobi\\resources\\img\profiles\\".$newName."?".rand(5, 15);;
                    $error['msg'] = "\n Foto actualitzada.";
                    $error['succes']=true;
                } else {
                    //error_resporting();
                    $error['msg'] = "Hi ha hagut un problema al pujar la imatge.";
                    $error['succes']=false;
                }

            }
        }else{
            $error['msg'] = "Sisplau tria una imatge.";
            $error['succes']=false;
        }
        echo json_encode($error);
    }
    public function openFormPopup($parameters){
        require_once 'models/UniversitiesModel.php';
        require_once 'models/RatingsModel.php';

        $universitiesModel = new UniversitiesModel();
        $ratingsModel = new RatingsModel();

        $data = $parameters[0];
        $route = $this->view->show("modalForm.php");
        $niu = $_SESSION['niu'];
        $categories = $ratingsModel->getCategories();
        $idUniversitat = $data['idUniversitat'];
        $ratingsModel->disconnect();
        /*
        if(isset($_SESSION['teacher'])){
            $universitiesSelect = $universitiesModel->getUniversityById($data['idUniversitat']);

        }else{
            $universitiesSelect = $universitiesModel->getUniversitiesByUser($niu); 
        }*/


        include($route);

    }
    public function openFormSubject($parameters){

        $data = $parameters[0];
        $route = $this->view->show("modalFormSubject.php");
        $niu = $_SESSION['niu'];
        $codiAcord = $data[0]['codiAcord'];
        $codiAsignaturaDesti = $data[0]['codiAsignaturaDesti'];

        include($route);

    }

    public function openFormAcord($parameters){
        require_once 'models/StayModel.php';
        require_once 'models/AssignaturesModel.php';
        require_once 'models/AcordEstudisModel.php';
        $stayModel = new StayModel();
        $assignaturesModel = new AssignaturesModel();
        $acordEstudisModel = new AcordEstudisModel();
        $route = $this->view->show("ModalFormAcord.php");
        $niu = $_SESSION['niu'];
        $data = $parameters[0];
        $idConveni = $data['idConveni'];
        if(isset($_SESSION['teacher'])){
            $stays = $stayModel->getStayWithTeacher($niu,$idConveni);
            $subjects = $assignaturesModel->getSubjectByTeacher($niu);
            $agreements = $acordEstudisModel->getAcordsByStay($idConveni);
        }
        $stayModel->disconnect();
        $assignaturesModel->disconnect();
        $acordEstudisModel->disconnect();
        include($route);

    }
    public function addPublication($parameters){
        $data = $parameters[0];
        require_once 'models/PublicationsModel.php';
        $publicationsModel = new PublicationsModel();
        if($data['succes']){
            $date = date('Y-m-d');
            $text = strip_tags($data['text']);
            $text = filter_var($text,FILTER_SANITIZE_SPECIAL_CHARS,FILTER_SANITIZE_STRING);
            $error['succes']=true;
            $error['uploadFile']=false;
            if(isset($data['isFile'])){
                $target_dir=$data['target_dir'];
                $target_file=$data['target_file'];
                $imageFileType=$data['imageFileType'];
                $check=$data['check'];

                if($check == false) {
                    //echo "File is an image - " . $check["mime"] . ".";
                    $error['msg'] = "El fitxer no es una imatge.";
                    $error['succes']=false;
                }
                if (file_exists($target_file)) {
                    //echo "Sorry, file already exists.";
                    $error['msg'] = "La imatge ja existeix.";
                    $error['succes']=false;
                }
                // Check file size
                if ($_FILES['file']['size'] > 5000000) {
                    //echo "Sorry, your file is too large.";
                    $error['msg'] = "La imatge es massa gran.";
                    $error['succes']=false;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $error['msg'] = "Nomes estan permesos les extensions png,jpeg,jpg.";
                }
                if (empty($error['msg'])) {
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                        $error['uploadFile']=true;
                    } else {
                        $error['msg'] = "Hi ha hagut un problema al pujar la imatge.";
                        $error['succes']=false;
                    }

                }
            }
            if($error['uploadFile']){
                $publicationsModel->addPublicationWithPhoto($data['idUniversitat'],$_SESSION['niu'],$text,$date,$_FILES['file']['name'],$data['idCategoria']);
            }else{
                $publicationsModel->addPublication($data['idUniversitat'],$_SESSION['niu'],$text,$date,$data['idCategoria']);
            }

        }else{
            $error['msg'] = "No es permeten camps buits.";
            $error['succes']=false;
        }

        echo json_encode($error);

    }
    public function deletePublication($parameters){
        $data = $parameters[0];
        require_once 'models/PublicationsModel.php';
        $publicationsModel = new PublicationsModel();
        $publicationsModel->deletePublication($data['idPublicacio'],$_SESSION['niu']);
        $error['succes']=true;
        $publicationsModel->disconnect();
        echo json_encode($error);

    }

    public function deletePublicationSubject($parameters){
        $data = $parameters[0];
        require_once 'models/PublicationsSubjectModel.php';
        $publicationsModel = new PublicationsSubjectModel();
        $publicationsModel->deletePublicationSubject($data['idPublicacio'],$_SESSION['niu']);
        $error['succes']=true;
        $publicationsModel->disconnect();
        echo json_encode($error);

    }
    public function addPublicationSubject($parameters){
        $data = $parameters[0];
        require_once 'models/PublicationsSubjectModel.php';
        $publicationsModel = new PublicationsSubjectModel();


        if($data['success']){
            $date = date('Y-m-d');
            $text = strip_tags($data['text']);
            $text = filter_var($text,FILTER_SANITIZE_SPECIAL_CHARS,FILTER_SANITIZE_STRING);
            $error['success']=true;

            $publicationsModel->addPublicationSubject($data['codiAcord'],$_SESSION['niu'],$text,$date,$data['codiAsignaturaDesti']);

        }else{
            $error['msg'] = "No es permeten camps buits.";
            $error['success']=false;
        }

        echo json_encode($error);


    }

    public function addAgreement($parameters){
        $data = $parameters[0];
        if(empty($data['codiEstada'])||empty($data['nomDesti'])||empty($data['linkDesti'])||empty($data['codiDesti'])||empty($data['creditsDesti'])||empty($data['assignatura'])){
            $data['msg'] = "Hi han camps buits, sisplau introdueix tots els camps.";
            $data['succes'] = false;
        }else{
            require_once 'models/AcordEstudisModel.php';
            $acordEstudisModel = new AcordEstudisModel();
            $acordEstudisModel->addAcord($data['codiEstada'],$data['assignatura'],$data['codiDesti'],$data['nomDesti'],$data['creditsDesti'],$data['linkDesti']);
            $acordEstudisModel->disconnect();
            $data['msg'] = "Acord creat amb èxit.";
            $data['succes'] = true;
        }
       echo json_encode($data);
    }


    public function firstRatings($parameters){
        $data = json_decode($parameters[0]['idStay'], true);

        require_once 'models/RatingsModel.php';
        $ratingsModel = new RatingsModel();

        $categories = $ratingsModel->getCategories();

        foreach ($categories as $categoria){
            $ratingsModel->addRating($data['id'],$data['idUni'], $categoria['idCategoria'],3);
        }
        $ratings = $ratingsModel->getStudentRatings($data['id']);

        $ratingsModel->disconnect();

        $iteratorCategories = 0;

        $route = $this->view->show("newRatings.php");
        include($route);
    }

    public function editRating($parameters){
        $data = json_decode($parameters[0]['infoRating'], true);

        require_once 'models/RatingsModel.php';
        $ratingsModel = new RatingsModel();

        $ratingsModel->editRating($data['idVal'],$data['score']);

        $ratingsModel->disconnect();
    }

    public function filtrarAcordsAdmin($parameters){
        $data = json_decode($parameters[0]['data']);

        require_once 'models/TeachersModel.php';
        require_once 'models/ConvenisModel.php';
        $teachersModel = new TeachersModel();
        $convenisModel = new ConvenisModel();

        if($data->filtre == 'mineAdmin'){
            $agree = $teachersModel->getAgreementsTeacher($data->niu);
        }elseif ($data->filtre == 'allAdmin'){
            $agree = $convenisModel->getConvenis();
        }

        $teachersModel->disconnect();
        $convenisModel->disconnect();

        $route = $this->view->show("TaulaAcordsCoordinador.php");
        include($route);
    }
}

?>