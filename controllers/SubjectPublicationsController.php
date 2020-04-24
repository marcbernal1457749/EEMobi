<?php
class SubjectPublicationsController{

    function __construct(){

        $this->view = new View();
    }

    public function showSubjectPublications($parameters){

        require 'models/PublicationsSubjectModel.php';
        $publicationsSubjectModel = new PublicationsSubjectModel();
        $data  = $parameters[0];
        echo "<script>console.log('HOLA:');</script>";
        $subjectPublications = $publicationsSubjectModel->getPublicationOfSubject($data['codiAsignaturaDesti']);

        $route = $this->view->show("PublicacionsAssignatura.php");

        $publicationsSubjectModel->disconnect();

        include ($route);

    }

}