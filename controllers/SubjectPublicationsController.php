<?php class SubjectPublicationsController{
    function __construct(){

        $this->view = new View();
    }

    public function showSubjectPublications($parameters){

        require 'models/PublicationsSubjectModel.php';

        $publicationsSubjectModel = new PublicationsSubjectModel();
        $data  = $parameters[0];
        echo "<script>console.log('ENTROFINAL');</script>";
        echo "<script>console.log('. json_encode( $data ) .');</script>";
        $subjectPublications = $publicationsSubjectModel->getPublicationOfSubject($data);

        $route = $this->view->show("PublicationsSubject.php");

        $publicationsSubjectModel->disconnect();

        include ($route);

    }
}?>