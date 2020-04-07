<?php
class AdminBackendController{
    function __construct(){
        
        $this->view = new View();
    }


    public function createNewUniversity($parameters){
        require 'models/UniversitiesModel.php';
        require 'models/CountriesModel.php';
        require 'models/DegreesModel.php';
        require 'models/TeachersModel.php';

        $countriesModel = new CountriesModel();
        $degreesModel = new DegreesModel();
        $teachersModel = new TeachersModel();

        $countries = $countriesModel->getCountry();
        $degrees = $degreesModel->getDegrees();
        $teachers = $teachersModel->getTeachers();

        $countriesModel->disconnect();
        $degreesModel->disconnect();
        $teachersModel->disconnect();

        $route = $this->view->show("CrearUniversitatAdmin.php");
        include($route);

    }

    public function addUniAndConvenis($parameters){
        $infoUni = json_decode($parameters[0]['infoUni'],true);
        $infoConvenis = $parameters[0]['infoConvenis'];

        require 'models/UniversitiesModel.php';
        require 'models/CountriesModel.php';
        require 'models/DegreesModel.php';
        require 'models/CentreEstudisModel.php';
        require 'models/ConvenisModel.php';
        require 'models/TeachersModel.php';

        $universitymodel = new UniversitiesModel();
        $countriesModel = new CountriesModel();
        $degreesModel = new DegreesModel();
        $centreEstudisModel = new CentreEstudisModel();
        $convenisModel = new ConvenisModel();
        $teachersModel = new TeachersModel();

        $country = $countriesModel->getCountryIdByName($infoUni['pais']);

        $idUni = $universitymodel->addUniversity(0,$infoUni['nom'],$infoUni['adreça'],$infoUni['latitud'], $infoUni['longitud'],$infoUni['url'],$infoUni['urlIn'],$infoUni['codi'], $infoUni['acreditacio'],$infoUni['observacions'],$infoUni['observacions'], $country->idPais);

        foreach ($infoConvenis as $infoConveni):
            $infoConveni = json_decode($infoConveni, true);
            if($infoConveni['actiu'] == 'Si'){
                $actiu = 1;
            }else{
                $actiu=0;
            }
            $degreeId = $degreesModel->getDegreeByName($infoConveni['estudis']);
            //$coordinadorId = $teachersModel->getIdTeacherByName($infoConveni['coordinador']);
            $idUniversitatEstudisUAB = $universitymodel->addUniversityWithDegree($idUni, $degreeId);
            $codiCentreEstudis = $centreEstudisModel->addInfoUniPlaces($actiu, $infoConveni['places'], $infoConveni['mesos'], $infoConveni['periode'], $idUniversitatEstudisUAB);
            //$teachersModel->insertCenterOnTeacher($coordinadorId->niuProfessor, $codiCentreEstudis);

            $convenisModel->addConveni($infoConveni['codi'], $codiCentreEstudis);
        endforeach;

        $universitymodel->disconnect();
        $countriesModel->disconnect();
        $degreesModel->disconnect();
        $centreEstudisModel->disconnect();
        $convenisModel->disconnect();
    }

    public function editaUniversitiesBackend($parameters){
        require 'models/UniversitiesModel.php';
        require 'models/CountriesModel.php';
        require 'models/DegreesModel.php';
        require 'models/TeachersModel.php';
        require 'models/ConvenisModel.php';
        require 'models/StayModel.php';
        require 'models/StudentsModel.php';

        $data = $parameters[0];
        $data = json_decode($data, true);
        $universityId = $data[0]['id'];

        $universitymodel = new UniversitiesModel();
        $countriesModel = new CountriesModel();
        $degreesModel = new DegreesModel();
        $teachersModel = new TeachersModel();
        $convenisModel = new ConvenisModel();
        $staysModel = new StayModel();
        $studentsModel = new StudentsModel();

        //Informacion de la universidad seleccionada
        $university = $universitymodel->getUniversityById($universityId);

        $uniCountry = $countriesModel->getCountryById($university->idPais);
        $uniConvenis = $convenisModel->getConvenisByIdUniversity($university->idUniversitat);
        $uniEstades = $staysModel->getUniStays($university->idUniversitat);


        //Informacion para la creacion/edicion de universidades y relacionados
        $allTeachers = $teachersModel->getTeachers();
        $allDegrees = $degreesModel->getDegrees();
        $allStudents = $studentsModel->getAllStudents();

        $countriesModel->disconnect();
        $degreesModel->disconnect();
        $teachersModel->disconnect();

        $route = $this->view->show("EditaUniversitatAdmin.php");
        include($route);
    }

    public function updateUniversity($parameters){
        require 'models/UniversitiesModel.php';

        $data = $parameters[0];
        $data = json_decode($data, true);
        $universityData = $data[0];

        $universitymodel = new UniversitiesModel();

        $universitymodel->updateUniversityById($universityData['id'], $universityData['nom'], $universityData['adr'],
            $universityData['lat'], $universityData['lng'], $universityData['urlUni'], $universityData['urlInt'],
            $universityData['codiUni'], $universityData['idioma'], $universityData['obs']);

        $universitymodel->disconnect();
    }

    public function updateConvenis($parameters){
        require 'models/ConvenisModel.php';
        require 'models/CentreEstudisModel.php';
        require 'models/TeachersModel.php';

        $data = json_decode($parameters[0], true);
        $convenisModel = new ConvenisModel();
        $centreEstudisModel = new CentreEstudisModel();
        $teachersModel = new TeachersModel();

        foreach ($data as $conveni){
            $centreEstudisModel->updateInfoUniPlaces($conveni['actiu'], $conveni['places'], $conveni['mesos'], $conveni['periode'],
                $conveni['idCE']);
            $teachersModel->updateCenterOnTeacher($conveni['idProf'], $conveni['idCE']);
        }

        $convenisModel->disconnect();
        $centreEstudisModel->disconnect();
        $teachersModel->disconnect();
    }

    public function addConveni($parameters){
        require 'models/UniversitiesModel.php';
        require 'models/CountriesModel.php';
        require 'models/DegreesModel.php';
        require 'models/CentreEstudisModel.php';
        require 'models/ConvenisModel.php';
        require 'models/TeachersModel.php';

        $universitymodel = new UniversitiesModel();
        $degreesModel = new DegreesModel();
        $centreEstudisModel = new CentreEstudisModel();
        $convenisModel = new ConvenisModel();
        $teachersModel = new TeachersModel();

         $infoConveni = json_decode($parameters[0], true);

        if($infoConveni['agreementActive'] == 'Si'){
            $actiu = 1;
        }else{
            $actiu=0;
        }

        $coordinadorId = $teachersModel->getIdTeacherByName($infoConveni['agreementCoordinator']);
        $estudis = $degreesModel->getDegreeByName($infoConveni['agreementStudies']);

        $universitat_estudisId = $universitymodel->addUniversityWithDegree($infoConveni['agreementUniversity'], $estudis);
        $codiCentreEstudis = $centreEstudisModel->addInfoUniPlaces($actiu, $infoConveni['agreementPlaces'], $infoConveni['agreementMonths'], $infoConveni['agreementPeriod'], $universitat_estudisId);
        $teachersModel->insertCenterOnTeacher($coordinadorId[0]->niuProfessor, $codiCentreEstudis);

        $convenisModel->addConveni($infoConveni['agreementCode'], $codiCentreEstudis);

        echo "<tr><td><input type='hidden' value='". $infoConveni['agreementCode'] ."'><p>". $infoConveni['agreementCode'] ."</p></td>";
        echo "<td><input type='hidden' value='". $codiCentreEstudis ."'><p>". $infoConveni['agreementStudies'] ."</p></td>";
        echo "<td><input type='text' class='form-control' value='". $infoConveni['agreementPlaces'] ."'></td>";
        echo "<td><input type='text' class='form-control' value='". $infoConveni['agreementMonths'] ."'></td>";
        echo "<td><input type='text' class='form-control' value='". $infoConveni['agreementPeriod'] ."'></td>";
        echo "<td><input type='text' class='form-control' value='". $actiu ."'></td>";
        echo "<td><input type='hidden' value='". $coordinadorId[0]->niuProfessor ."'><p>". $infoConveni['agreementCoordinator'] ."</p></td></tr>";

        $universitymodel->disconnect();
        $degreesModel->disconnect();
        $centreEstudisModel->disconnect();
        $convenisModel->disconnect();
    }

    public function updateEstades($parameters){
        require 'models/StayModel.php';
        require 'models/StudentsModel.php';

        $data = json_decode($parameters[0], true);

        $staysModel = new StayModel();
        $studentsModel = new StudentsModel();

        foreach ($data as $estada){
            $niuEstudiant = $studentsModel->getStudentByName($estada['est']);
            $staysModel->updateStay($niuEstudiant[0]->niuEstudiant, $estada['idConveni'], $estada['curs'], $estada['semestre'],
                $estada['idEstada']);
        }

        $staysModel->disconnect();
        $studentsModel->disconnect();
    }

    public function addStay($parameters){
        require 'models/TeachersModel.php';
        require 'models/StayModel.php';
        require 'models/StudentsModel.php';

        $staysModel = new StayModel();
        $studentsModel = new StudentsModel();
        $teachersModel = new TeachersModel();


        $infoStay = json_decode($parameters[0], true);


        $stayId = $staysModel->addStay($infoStay['idStudent'], $infoStay['idConveni'], $infoStay['curs'], $infoStay['semestre'],
            $infoStay['idTeacher']);

        echo "<tr><td><input type='hidden' value='". $stayId ."'><input type='hidden' value='". $infoStay['student'] ."'><p id='nomEstudiantEstada'>". $infoStay['student'] ."</p></td>";
        echo "<td><input type='hidden' value='". $infoStay['idConveni'] ."'><p>". $infoStay['idConveni'] ."</p></td>";
        echo "<td><input type='text' class='form-control' value='". $infoStay['curs'] ."'></td>";
        echo "<td><input type='text' class='form-control' value='". $infoStay['semestre'] ."'></td>";
        echo "<td><input type='hidden' value='". $infoStay['teacher'] ."'><p>". $infoStay['teacher'] ."</p></td>";
        echo "<td><a href='' id='". $stayId ."'><img class=\"center-block\" id='". $stayId ."' src='./resources/images/list.png' height='25' width='25'></a></td></tr>";

        $staysModel->disconnect();
        $studentsModel->disconnect();
        $teachersModel->disconnect();
    }

    public function openSubjectModal($parameters){
        require 'models/StayModel.php';
        require 'models/AcordEstudisModel.php';
        require 'models/AssignaturesModel.php';

        $idEstada = json_decode($parameters[0],true);
        $idEstada = $idEstada[0]['id'];

        $staysModel = new StayModel();
        $acordsModel = new AcordEstudisModel();
        $assignaturesUABModel = new AssignaturesModel();

        $infoEstada = $staysModel->getStaysById($idEstada);
        $assignatures = $acordsModel->getAcordByStay($idEstada);
        $assignaturasUAB = $assignaturesUABModel->getAllSubjects();

        $staysModel->disconnect();
        $acordsModel->disconnect();
        $assignaturesUABModel->disconnect();

        $route = $this->view->show("ModalAcordsAdmin.php");
        include($route);
    }

    public function editAcords($parameters){
        require 'models/AcordEstudisModel.php';

        $acordsModel = new AcordEstudisModel();

        $acords = json_decode($parameters[0], true);

        foreach ($acords as $acord){
            $acordsModel->updateAcord($acord['idEstada'], $acord['idAssUAB'], $acord['idAssExt'],
                $acord['nomAssExt'], $acord['credits'], $acord['idAcord'], $acord['linkAssExt']);
        }
    }

    public function addAcord($parameters){

        require 'models/AcordEstudisModel.php';

        $acordsModel = new AcordEstudisModel();


        $infoAcord = json_decode($parameters[0], true);


        $acordId = $acordsModel->addAcord($infoAcord['idEstada'], $infoAcord['idAssUAB'], $infoAcord['idAssExt'],
            $infoAcord['nomAssExt'], $infoAcord['credits'], $infoAcord['linkAssExt']);

        echo "<tr id='". $acordId ."'><td><input type='hidden' id='codiAcord' value='". $acordId ."'><input type='hidden' id='codiAssignaturaUAB' value='". $infoAcord['idAssUAB'] ."'><input type='hidden' id='nomAssignatura' value='". $infoAcord['nomAssUAB'] ."'><p>". $infoAcord['nomAssUAB'] ."</p></td>";
        echo "<td><input type='text' class='form-control' id='nomAssExt' value='". $infoAcord['nomAssExt'] ."'></td>";
        echo "<td><input type='text' class='form-control' id='credits' value='". $infoAcord['credits'] ."'></td>";
        echo "<td><input type='text' class='form-control' id='codiAssExt' value='". $infoAcord['idAssExt'] ."'></td>";
        echo "<td><input type='text' class='form-control' id='enllaçAssExt' value='". $infoAcord['linkAssExt'] ."'></td></tr>";

        $acordsModel->disconnect();
    }

    public function removeAcord($parameters){
        $idAcord = json_decode($parameters[0], true);
        require 'models/AcordEstudisModel.php';

        $acordsModel = new AcordEstudisModel();

        $acordsModel->deleteAcord($idAcord[0]['id']);

        $acordsModel->disconnect();
    }

    public function otherActions($parameters){
        $route = $this->view->show("AltresAccionsAdmin.php");
        include($route);
    }

    public function getFooterAdmin($parameters){
        require 'models/AdminManagmentModel.php';

        $adminManagmentModel = new AdminManagmentModel();

        $footerInfo = $adminManagmentModel->getFooterInfo();
        $footerSubSections = $adminManagmentModel->getSubSections();

        $adminManagmentModel->disconnect();

        $route = $this->view->show("GestioFooterAdmin.php");
        include($route);
    }

    public function updateSectionTitles($parameters){
        require 'models/AdminManagmentModel.php';

        $adminManagmentModel = new AdminManagmentModel();

        $data = $parameters[0];
        $data = json_decode($data, true);

        foreach ($data as $section){
            $adminManagmentModel->editFooterInfo($section['id'],$section['titol']);
        }

        $adminManagmentModel->disconnect();
    }

    public function updateSubSections($parameters){
        require 'models/AdminManagmentModel.php';

        $adminManagmentModel = new AdminManagmentModel();

        $data = $parameters[0];
        $data = json_decode($data, true);

        foreach ($data as $subSection){
            $adminManagmentModel->editSubSection($subSection['id'], $subSection['titol'], $subSection['url']);
        }

        $adminManagmentModel->disconnect();
    }

    public function addSubSection($parameters){
        require 'models/AdminManagmentModel.php';

        $adminManagmentModel = new AdminManagmentModel();

        $data = $parameters[0];
        $data = json_decode($data, true);

        $id = $adminManagmentModel->addSubSection($data[0]['titol'], $data[0]['url'], $data[0]['id']);

        $adminManagmentModel->disconnect();

        echo "<tr id='". $id ."'>";
        echo "<td><p>". $data[0]['titolSeccio'] ."</p>";
        echo "</td><td><input size='25' type='text' value='". $data[0]['titol'] ."'/></td>";
        echo "<td><input size='50' type='text' value='". $data[0]['url'] ."'/></td></tr>";
    }

    public function removeSubSection($parameters){
        require 'models/AdminManagmentModel.php';

        $adminManagmentModel = new AdminManagmentModel();

        $data = $parameters[0];
        $data = json_decode($data, true);

        $adminManagmentModel->deleteSubSection($data[0]['id']);
    }

    public function getUrlTesterAdmin($parameters){

        $route = $this->view->show("URLTesterAdmin.php");
        include($route);
    }

    //TEST URL UNIVERSITAT
    public function testUrlsUniversitat($parameters){
        require 'models/UniversitiesModel.php';
        require 'models/AcordEstudisModel.php';
        require 'models/AssignaturesModel.php';
        require 'models/FailURLModel.php';

        $universitiesModel = new UniversitiesModel();
        $failURLModel = new FailURLModel();

        $urlsUniversitat = $universitiesModel->getURLUniversities();

        //Eliminamos resultados de tests anteriores:
        $failURLModel -> deleteAllFailURL("URL Universitat");
        $failURLModel -> deleteAllFailURL("URL Intercanvi");

        //Obtenemos las URL que tienen un campo vacío
        $nullUniversitat = $universitiesModel->getNullURLUniversitat();
        $nullIntercanvi = $universitiesModel->getNullURLIntercanvi();

        //Guardamos las URL vacias en la nueva tabla de la BBDD:
        foreach ($nullUniversitat as $nullUni) {
            $urlPrincipal = $nullUni['urlUniversitat'];
            $failURLModel->addFailURL("URL Universitat", $urlPrincipal, $nullUni['nomUniversitat']);
        }
        foreach ($nullIntercanvi as $nullInt) {
            $urlPrincipal = $nullInt['urlIntercanvis'];
            $failURLModel->addFailURL("URL Intercanvi", $urlPrincipal, $nullInt['nomUniversitat']);
        }

        //Modificamos el time limit para que no pete
        set_time_limit(200000);

        $options = array(CURLOPT_RETURNTRANSFER => true, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_FOLLOWLOCATION => true);


        //URLS Unis
        foreach ($urlsUniversitat as $urlUni){
            $urlPrincipal = $urlUni['urlUniversitat'];
            $handleURLPrincipal = curl_init($urlPrincipal);
            curl_setopt($handleURLPrincipal,CURLOPT_TIMEOUT_MS,100);
            curl_setopt_array($handleURLPrincipal, $options);
            $responsePrincipal = curl_exec($handleURLPrincipal);
            $urlHeaderPrincipal = curl_getinfo($handleURLPrincipal, CURLINFO_HTTP_CODE);

            $urlIntercanvi = $urlUni['urlIntercanvis'];
            $handleURLIntercanvi = curl_init($urlIntercanvi);
            curl_setopt($handleURLIntercanvi,CURLOPT_TIMEOUT_MS,100);
            curl_setopt_array($handleURLIntercanvi, $options);
            $responseIntercanvi = curl_exec($handleURLIntercanvi);
            $urlHeaderIntercanvi = curl_getinfo($handleURLIntercanvi, CURLINFO_HTTP_CODE);

            if ($urlHeaderPrincipal >=400){
                //array_push($failedURLS, array('modul' => "URL Universitat",'redirect' => $urlUni['nomUniversitat'], 'url' => $urlPrincipal));
                $failURLModel -> addFailURL("URL Universitat", $urlPrincipal, $urlUni['nomUniversitat']);
            }

            if ($urlHeaderIntercanvi >=400){
               // array_push($failedURLS, array('modul' => "URL Intercanvi", 'redirect' => $urlUni['nomUniversitat'], 'url' => $urlIntercanvi));
                $failURLModel -> addFailURL("URL Intercanvi", $urlIntercanvi, $urlUni['nomUniversitat']);
            }

            curl_close($handleURLPrincipal);
            curl_close($handleURLIntercanvi);
        }


        #Obtenemos los datos de la BBDD por cada módulo para presentarlos en las vistas:
        $urlfallidesUni = $failURLModel->getFailURL("URL Universitat");
        $urlfallidesInt = $failURLModel->getFailURL("URL Intercanvi");

        $universitiesModel->disconnect();
        $failURLModel->disconnect();

        //Devolvemos el time limit al default
        set_time_limit(30);
        $route = $this->view->show("URLtestedTable.php");

        include($route);
    }

    //TEST URL ASSIGNATURES EXTERNES
    public function testUrlsAssigEXT($parameters){
        require 'models/UniversitiesModel.php';
        require 'models/AcordEstudisModel.php';
        require 'models/AssignaturesModel.php';
        require 'models/FailURLModel.php';

        $acordsModel = new AcordEstudisModel();
        $assignaturesModel = new AssignaturesModel();
        $failURLModel = new FailURLModel();

        $urlsAssignaturesExternes = $acordsModel->getURLsAcords();
        $failURLModel -> deleteAllFailURL("Assignatura Externa");

        //Modificamos el time limit para que no pete
        set_time_limit(200000);

        $options = array(CURLOPT_RETURNTRANSFER => true, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_FOLLOWLOCATION => true);



        //URLS Assignatures Externes
        foreach ($urlsAssignaturesExternes as $url){
            $urlPrincipal = $url->linkAssignaturaDesti;
            $handler = curl_init($urlPrincipal);
            curl_setopt($handler,CURLOPT_TIMEOUT_MS,100);
            curl_setopt_array($handler, $options);
            $response = curl_exec($handler);
            $urlHeader = curl_getinfo($handler, CURLINFO_HTTP_CODE);

            if ($urlHeader >=400){
                //array_push($failedURLS, array('modul' => "Assignatura Externa", 'redirect' => $url->nomAsignaturaDesti, 'url' => $urlPrincipal));
                $failURLModel -> addFailURL("Assignatura Externa", $urlPrincipal, $url->nomAsignaturaDesti);
            }

            curl_close($handler);
        }

        #Obtenemos los datos de la BBDD por cada módulo para presentarlos en las vistas:

        $urlfallidesAssignaturesEXT = $failURLModel->getFailURL("Assignatura Externa");

        $acordsModel->disconnect();
        $assignaturesModel->disconnect();
        $failURLModel->disconnect();



        //Devolvemos el time limit al default
        set_time_limit(30);
        $route = $this->view->show("URLtestedTable.php");

        include($route);
    }

    //TEST URL ASSIGNATURES UAB
    public function testUrlsAssigUAB($parameters){
        require 'models/UniversitiesModel.php';
        require 'models/AcordEstudisModel.php';
        require 'models/AssignaturesModel.php';
        require 'models/FailURLModel.php';

        $acordsModel = new AcordEstudisModel();
        $assignaturesModel = new AssignaturesModel();
        $failURLModel = new FailURLModel();

        $urlAssignaturesUAB = $assignaturesModel->getURLAssignatures();
        $failURLModel -> deleteAllFailURL("Assignatura UAB");

        //Modificamos el time limit para que no pete
        set_time_limit(200000);

        $options = array(CURLOPT_RETURNTRANSFER => true, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_FOLLOWLOCATION => true);

        //URLS Assignatures UAB
        foreach ($urlAssignaturesUAB as $url){
            $urlPrincipal = $url->url;
            $handler = curl_init($urlPrincipal);
            curl_setopt($handler,CURLOPT_TIMEOUT_MS,200);
            curl_setopt_array($handler, $options);
            $response = curl_exec($handler);
            $urlHeader = curl_getinfo($handler, CURLINFO_HTTP_CODE);

            if ($urlHeader >=400){
                //array_push($failedURLS, array('modul' => "Assignatura UAB", 'redirect' => $url->nomAssignatura, 'url' => $urlPrincipal));
                $failURLModel -> addFailURL("Assignatura UAB", $urlPrincipal, $url->nomAssignatura);
            }

            curl_close($handler);
        }

        #Obtenemos los datos de la BBDD por cada módulo para presentarlos en las vistas:
        $urlfallidesAssignaturesUAB = $failURLModel->getFailURL("Assignatura UAB");

        $acordsModel->disconnect();
        $assignaturesModel->disconnect();
        $failURLModel->disconnect();


        //Devolvemos el time limit al default
        set_time_limit(30);
        $route = $this->view->show("URLtestedTable.php");

        include($route);
    }

    public function getfailedURLUnis($parameters){
        require 'models/UniversitiesModel.php';
        require 'models/AcordEstudisModel.php';
        require 'models/AssignaturesModel.php';
        require 'models/FailURLModel.php';

        $universitiesModel = new UniversitiesModel();
        $failURLModel = new FailURLModel();

        $urlfallidesUni = $failURLModel->getFailURL("URL Universitat");
        $urlfallidesInt = $failURLModel->getFailURL("URL Intercanvi");

        $universitiesModel->disconnect();
        $failURLModel->disconnect();

        $route = $this->view->show("URLtestedTable.php");
        include($route);
    }



    public function getfailedURLAssigEXT($parameters){

        require 'models/UniversitiesModel.php';
        require 'models/AcordEstudisModel.php';
        require 'models/AssignaturesModel.php';
        require 'models/FailURLModel.php';

        $acordsModel = new AcordEstudisModel();
        $assignaturesModel = new AssignaturesModel();
        $failURLModel = new FailURLModel();

        $urlfallidesAssignaturesEXT = $failURLModel->getFailURL("Assignatura Externa");

        $acordsModel->disconnect();
        $assignaturesModel->disconnect();
        $failURLModel->disconnect();

        $route = $this->view->show("URLtestedTable.php");
        include($route);
    }

    public function getfailedURLAssigUAB($parameters){

        require 'models/AssignaturesModel.php';
        require 'models/FailURLModel.php';


        $assignaturesModel = new AssignaturesModel();
        $failURLModel = new FailURLModel();

        $urlfallidesAssignaturesUAB = $failURLModel->getFailURL("Assignatura UAB");


        $assignaturesModel->disconnect();
        $failURLModel->disconnect();

        $route = $this->view->show("URLtestedTable.php");
        include($route);
    }

    public function deletefailedURL($parameters){

        require 'models/FailURLModel.php';

        $failURLModel = new FailURLModel();
        $id = $_POST['dataSed'];

        $failURLModel->deleteFailURL($id);

        $failURLModel->disconnect();
    }

    public function getAuxTablesAdmin($parameters){
        require 'models/CountriesModel.php';
        require 'models/AssignaturesModel.php';
        require 'models/DegreesModel.php';
        require 'models/TeachersModel.php';
        require 'models/ProgramsModel.php';

        $countriesModel = new CountriesModel();
        $assignaturesModel = new AssignaturesModel();
        $degreesModel = new DegreesModel();
        $teachersModel = new TeachersModel();
        $programsModel = new ProgramsModel();

        $countries = $countriesModel->getCountry();
        $assignaturesUAB = $assignaturesModel->getAllSubjects();
        $degreesUAB = $degreesModel->getDegrees();
        $teachers = $teachersModel->getTeachers();
        $programs = $programsModel->getPrograms();

        $countriesModel->disconnect();
        $assignaturesModel->disconnect();
        $degreesModel->disconnect();
        $teachersModel->disconnect();
        $programsModel->disconnect();

        $route = $this->view->show("AuxTablesAdmin.php");
        include($route);
    }

    public function addTableCountries($parameters){
        require 'models/CountriesModel.php';
        $countriesModel = new CountriesModel();

        $data = $parameters[0];
        $codi = $data['programaPais'];
        $nom = $data['nomPais'];

        $countriesModel->addCountry($codi,$nom);

        $countriesModel->disconnect();
    }
    public function addTableSubjects($parameters){
        require 'models/AssignaturesModel.php';
        $assignaturesModel = new AssignaturesModel();

        $data = $parameters[0];
        $codiSubject = $data['codiSubject'];
        $nom = $data['nom'];
        $credits = $data['credits'];
        $url=$data['url'];
        $codiEstudis=$data['codiEstudis'];

        $assignaturesModel->addAssignaturesUAB($codiSubject,$nom,$credits,$url,$codiEstudis);

        $assignaturesModel->disconnect();
    }
    public function addTableDegrees($parameters){
        require 'models/DegreesModel.php';
        $degreesModel = new DegreesModel();

        $data = $parameters[0];
        $nom = $data['nom'];
        $cicle = $data['cicle'];
        $descripcio = $data['descripcio'];

        $degreesModel->addDegree($nom,$cicle,$descripcio);

        $degreesModel->disconnect();
    }
    public function addTableTeachers($parameters){
        require 'models/TeachersModel.php';
        $teachersModel = new TeachersModel();

        $data = $parameters[0];

        $niu = $data['niu'];
        $nom = $data['nom'];
        $cognoms = $data['cognoms'];
        $codiEstudis = $data['codiEstudis'];
        $correu = $data['correu'];

        $teachersModel->addTeacher($niu,$nom,$cognoms,$codiEstudis,$correu);

        $teachersModel->disconnect();
    }

    public function getInformationUniversities($parameters){
        require 'models/UniversitiesModel.php';
        $universitymodel = new UniversitiesModel();
        $universities = $universitymodel -> getAllUniversites();
        $universitymodel->disconnect();
        $route = $this->view->show("UniversitiesAdmin.php");
        include($route);
    }
 
    public function getInformationPrograms($parameters){
        require 'models/ProgramsModel.php';
        $programsModel = new ProgramsModel();
        $programs = $programsModel -> getPrograms();
        $route = $this->view->show("ProgramsAdmin.php");
        include($route);
    }
    public function getInformationStudents($parameters){
        require 'models/StudentsModel.php';
        $studentsModel = new StudentsModel();
        $students = $studentsModel -> getAllStudents();
        $route = $this->view->show("StudentsAdmin.php");
        include($route);
    }

   public function getInformationUniAndDegrees($parameters){
        require 'models/UniversitiesModel.php';
        require 'models/DegreesModel.php';
        $universitymodel = new UniversitiesModel();
        $degreesModel = new DegreesModel();
        $universities = $universitymodel->getUniversitiesByDegreesAssigned();
        $allUniversities = $universitymodel -> getAllUniversites();
        $degrees = $degreesModel -> getDegrees();
        $route = $this->view->show("UniversitiesAndDegreesAdmin.php");
        include($route);
    }
    public function getUniversitiesPlaces($parameters){
        require 'models/UniversitiesModel.php';
        require 'models/TeachersModel.php';
        $universitymodel = new UniversitiesModel();
        $teachersModel = new TeachersModel();
        $teachers = $teachersModel->getTeachers();
        $teachersModel->disconnect(); 
        $universities = $universitymodel->getUniversitiesPlaces();
        $allUniversities = $universitymodel->getUniversitiesByDegreesAssignedOut();
        $route = $this->view->show("UniversitiesPlacesAdmin.php");
        include($route);

    }
    public function getConvenis($parameters){
        require 'models/ConvenisModel.php';
        require 'models/UniversitiesModel.php';
        $convenisModel = new ConvenisModel();
        $universitymodel = new UniversitiesModel();
        $universities = $universitymodel->getUniversitiesPlaces(); 
        $convenis = $convenisModel->getConvenis();
        $route = $this->view->show("ConvenisAdmin.php");
        include($route);
    }

    public function getEstades($parameters){
        require 'models/StayModel.php';
        require 'models/ConvenisModel.php';
        require 'models/StudentsModel.php';
        $stayModel = new StayModel();
        $convenisModel = new ConvenisModel();
        //$studentsModel = new StudentsModel();
        $stays = $stayModel->getStays();
        $convenis = $convenisModel->getConvenis();
        //$students = $studentsModel->getAllStudents();
        $route = $this->view->show("StaysAdmin.php");
        include($route);
    }

    public function getAcordsEstudis($parameters){
        require 'models/AcordEstudisModel.php';
        require 'models/AssignaturesModel.php';
        require 'models/StayModel.php';
        $acordEstudisModel = new AcordEstudisModel();
        $assignaturesModel = new AssignaturesModel();
        $stayModel = new StayModel();
        $acords = $acordEstudisModel->getAcordsEstudis();
        $subjects = $assignaturesModel->getAllSubjects();
        $stays = $stayModel->getStays();
        $route = $this->view->show("AcordEstudisAdmin.php");
        include($route);
    }

    public function addOrupdateInfoUniversity($parameters){
        require 'models/UniversitiesModel.php';
        require 'models/CountriesModel.php';
        $universitymodel = new UniversitiesModel();
        $countriesModel = new CountriesModel();
        $data = $parameters[0];
        $country = $countriesModel->getCountryIdByName($data['pais']);
        $countriesModel->disconnect();
        $adOrUpdate=$data['ad'];
        if(!empty($country)){
            if($adOrUpdate){
                $universitymodel->addUniversity($data['id'],$data['nom'],$data['adreça'],$data['latitud'],$data['longitud'],$data['url'],$data['urlIn'],$data['codi'],$data['acreditacio'],$data['observacions'],$country->idPais);

            }else{
              
                $universitymodel->updateUniversityById($data['id'],$data['nom'],$data['adreça'],$data['latitud'],$data['longitud'],$data['url'],$data['urlIn'],$data['codi'],$data['acreditacio'],$data['observacions'],$country->idPais);
            }
        }
        $universitymodel->disconnect();
        echo json_encode($data);
        
    }
    public function deleteUniversity($parameters){
        $data = $parameters[0];
        require 'models/UniversitiesModel.php';
        $universitymodel = new UniversitiesModel();
        $universitymodel->deleteUniversityById($data['id']);
        $universitymodel->disconnect();
        echo json_encode($data['success']);
        

    }
    public function addOrupdateInfoStudent($parameters){
        $data = $parameters[0];
        require 'models/StudentsModel.php';
        $studentsModel = new StudentsModel();
        if(strcmp($data['nompublic'],"Si")==0){
            $nompublic = 1;
        }else{
            $nompublic = 0;
        }
        if(strcmp($data['correupublic'],"Si")==0){
            $correupublic = 1;
        }else{
            $correupublic = 0;
        }
        $adOrUpdate=$data['ad'];
        if ($adOrUpdate) {
            $msg ="ESTOY EN EL INSERT";
           $studentsModel->insertNewUser($data['niu'],$data['nom'],$data['cognom'],$data['correu'],$nompublic,$correupublic);
        }else{
            $msg ="ESTOY EN EL UPDATE";
           $studentsModel->updateInfoByNiu($data['niu'],$data['nom'],$data['cognom'],$data['correu'],$nompublic,$correupublic); 
        }
        $studentsModel->disconnect();
       
    }
    public function deleteStudent($parameters){
        $data = $parameters[0];
        require 'models/StudentsModel.php';
        $studentsModel = new StudentsModel();
        $studentsModel->deleteStudent($data['niu']);
        $studentsModel->disconnect();
    }
    public function addOrupdateInfoProgram($parameters){
        $data = $parameters[0];
        require 'models/ProgramsModel.php';
        $programsModel = new ProgramsModel();
        $adOrUpdate=$data['ad'];
        if ($adOrUpdate) {
           $programsModel->insertNewProgram($data['codi'],$data['nom'],$data['descripcio']);
        }else{
           $programsModel->updateInfoByCode($data['codi'],$data['nom'],$data['descripcio']); 
        }
        $programsModel->disconnect();
       
    }
    public function deleteProgram($parameters){
        $data = $parameters[0];
        require 'models/ProgramsModel.php';
        $programsModel = new ProgramsModel();
        $programsModel->deleteProgramByCode($data['codi']);
        $programsModel->disconnect();
    }
    public function addOrupdateInfoUniDegree($parameters){

        $data = $parameters[0];
        require 'models/UniversitiesModel.php';
        $universitymodel = new UniversitiesModel();
        $data = $parameters[0];
        $adOrUpdate=$data['ad'];
        if ($adOrUpdate) {
            $ifExist = $universitymodel->ifExistUniversityWithDegree($data['codiUni'],$data['codiGrau']);
            if (empty($ifExist)) {
                $universitymodel->addUniversityWithDegree($data['codiUni'],$data['codiGrau']);
                $data['msg'] = "OK";
            }else{
                $data['msg'] = "KO";
                $data['error'] = "Ja existeix el grau per aquesta universitat.";
            }
        }else{
           $universitymodel->updateUniversityWithDegree($data['codiUni'],$data['codiGrau'],$data['codiUniGrau']); 
        }
        echo json_encode($data);

    }
    public function deleteInfoUniDegree($parameters){
        $data = $parameters[0];
        require 'models/UniversitiesModel.php';
        $universitymodel = new UniversitiesModel();
        $universitymodel->deleteUniversityWithDegree($data['codiUniGrau']);
        echo json_encode($data);
    }
    public function addOrupdateInfoUniPlaces($parameters){
        $data = $parameters[0];
        require 'models/CentreEstudisModel.php';
        require_once 'models/TeachersModel.php';
        $centreEstudisModel = new CentreEstudisModel();
        $teachersModel = new TeachersModel();
        $data = $parameters[0];
        $adOrUpdate=$data['ad'];
        if(strcmp($data['actiu'],"Sí")==0){
            $actiu = 1;
        }else{
            $actiu = 0;
        }
        if ($adOrUpdate) {
           $centre = $centreEstudisModel->addInfoUniPlaces($actiu,$data['places'],$data['mesos'],$data['periode'],$data['id']);
           $teachersModel->insertCenterOnTeacher($data['teacher'],$centre);

        }else{
           $centreEstudisModel->updateInfoUniPlaces($actiu,$data['places'],$data['mesos'],$data['periode'],$data['id']);
           $teachersModel->updateCenterOnTeacher($data['teacher'],$data['id']);
        }
        $teachersModel->disconnect();
        $centreEstudisModel->disconnect();
        echo json_encode($centre);
    }
    public function deleteInfoUniPlaces($parameters){
        $data = $parameters[0];
        require 'models/CentreEstudisModel.php';
        $centreEstudisModel = new CentreEstudisModel();
        $centreEstudisModel->deleteInfoUniPlaces($data['id']);
        echo json_encode($data);

    }
    public function addOrupdateInfoConvenis($parameters){
        $data = $parameters[0];
        require 'models/ConvenisModel.php';
        $convenisModel = new ConvenisModel();
        $adOrUpdate=$data['ad'];
        if ($adOrUpdate) {
            $convenisModel->addConveni($data['codiConveni'],$data['id']);
        }else{
            $convenisModel->updateConveni($data['codiConveni'],$data['id']); 
        }
        echo json_encode($data);
    }   
    public function deleteConveni($parameters){
        $data = $parameters[0];
        require 'models/ConvenisModel.php';
        $convenisModel = new ConvenisModel();
        $convenisModel->deleteConveni($data['id']);
        echo json_encode($data);

    }
    public function addOrupdateInfoEstades($parameters){
        $data = $parameters[0];
        require 'models/StayModel.php';
        $stayModel = new StayModel();
        $adOrUpdate=$data['ad'];
        if ($adOrUpdate) {
            $stayModel->addStay($data['niu'],$data['codiConveni'],$data['curs'],$data['semestre']);
        }else{
            $stayModel->updateStay($data['niu'],$data['codiConveni'],$data['curs'],$data['semestre'],$data['id']); 
        }
        echo json_encode($data);
    }
    public function deleteStay($parameters){
        $data = $parameters[0];
        require 'models/StayModel.php';
        $stayModel = new StayModel();
        $stayModel->deleteStay($data['id']);
        echo json_encode($data);

    }
    public function addOrupdateInfoAcord($parameters){
        $data = $parameters[0];
        require 'models/AcordEstudisModel.php';
        $acordEstudisModel = new AcordEstudisModel();
        $adOrUpdate=$data['ad'];
        if ($adOrUpdate) {

            $acordEstudisModel->addAcord($data['estada'],$data['assignatura'],$data['codiDesti'],$data['nomDesti'],$data['creditsDesti'],$data['linkDesti']);
        }else{
            $acordEstudisModel->updateAcord($data['estada'],$data['assignatura'],$data['codiDesti'],$data['nomDesti'],$data['creditsDesti'],$data['id'],$data['linkDesti']);
        }
        echo json_encode($data);


    }
    public function deleteAcord($parameters){
        $data = $parameters[0];
        require 'models/AcordEstudisModel.php';
        $acordEstudisModel = new AcordEstudisModel();
        $acordEstudisModel->deleteAcord($data['id']);
        echo json_encode($data);

    }
    public function updatePhoto($parameters){
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
            if ($_FILES['file']['size'] > 50000000) {
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
                    require_once 'models/UniversitiesModel.php';
                    //$studentsModel = new StudentsModel();
                    $universitymodel = new UniversitiesModel();
                    $newName = $data['university'].'.'.$imageFileType;
                    $nameFile= rename($target_file,$target_dir.$newName);
                    
                    $universitymodel->insertPhotoOnUniversity($data['university'],$newName);
                    //$error['src'] = "\UAB\\resources\\img\universities\\".$newName."?".rand(5, 15);;
                    $error['msg'] = $newName;
                    $error['succes']=true;
                } else {
                    $error['msg'] = "Hi ha hagut un problema al pujar la imatge.";
                    $error['succes']=false;
                }

            }
        }else{
            $error['msg'] = "Sisplau tria una imatge.";
            //$error['tst'] =  $data['target_dir'];
            $error['succes']=false;
        }
        echo json_encode($error);
    }


}


?>