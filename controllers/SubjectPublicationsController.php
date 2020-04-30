<?php class SubjectPublicationsController{
    function __construct(){

        $this->view = new View();
    }

    public function showSubjectPublications($parameters){

        require 'models/PublicationsSubjectModel.php';

        $hasPublicationsSubject=true;
        $pathPhotoProfile = "\EEmobi\\resources\img\profiles\\";

        $publicationsSubjectModel = new PublicationsSubjectModel();
        $data  = $parameters[0];
        $nomSubject = $data[0]['nom'];
        $subjectPublications = $publicationsSubjectModel->getPublicationOfSubject($data[0]['codi']);
        if(!empty($subjectPublications)){
            $hasPublicationsSubject=true;
        }

        $route = $this->view->show("PublicationsSubject.php");

        $publicationsSubjectModel->disconnect();

        include ($route);

    }
}?>