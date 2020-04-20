
<?php
class UniversitiesModel{
	protected $db;
 
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::getInstance();
    }
    public function getUniversityById($idUniversity){
        $consulta = $this->db->prepare('SELECT * FROM universitats WHERE idUniversitat = ?');
        $consulta->execute(array($idUniversity));
        $obj = $consulta->fetch(PDO::FETCH_OBJ);
        //devolvemos la colección para que la vista la presente.
        return $obj;

    }

    public function getAllUniversites(){
        $consulta = $this->db->prepare('SELECT un.idUniversitat,un.nomUniversitat,un.adreça,un.lat,un.lng,un.urlUniversitat,un.urlIntercanvis,un.codiUniversitat,un.acreditacióIdioma,un.observacions,un.fotoPath, pa.nomPais
            FROM universitats un,pais pa
            WHERE un.idPais = pa.idPais');
        $consulta->execute();
        $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
        //devolvemos la colección para que la vista la presente.
        return $obj;

    }

	public function getUniversityByIdCountry($idCountry){

        $consulta = $this->db->prepare('SELECT universitats.nomUniversitat,universitats.idUniversitat,universitats.adreça,universitats.lat,universitats.lng,pais.nomPais,universitats.urlUniversitat,universitats.urlIntercanvis,pais.codiPrograma
                                        FROM pais
                                        INNER JOIN universitats ON universitats.idPais = pais.idPais
                                        WHERE pais.idPais = ?');
        $consulta->execute(array($idCountry));
        $rows = array();
        $rows = $consulta->fetchAll();
        return json_encode($rows);
    }
    public function getUniversityByDegree($idDegree){
        $consulta = $this->db->prepare('SELECT universitats.nomUniversitat,universitats.idUniversitat,universitats.adreça,universitats.lat,universitats.lng,pais.nomPais,universitats.urlUniversitat,universitats.urlIntercanvis,pais.codiPrograma
                                        FROM pais,universitats,universitat_estudisuab
                                        WHERE universitat_estudisuab.idUniversitat = universitats.idUniversitat
                                        and universitats.idPais = pais.idPais
                                        AND universitat_estudisuab.codiEstudis = ?');
        $consulta->execute(array($idDegree));
        $rows = array();
        $rows = $consulta->fetchAll();
        return json_encode($rows);


    }

    //Alfred code
    public function getUniversitiesBySubjectIdAndTypeOfSearch($typeOfSearch, $subjectIds){
        $stringConsulta = 'SELECT universitats.nomUniversitat,universitats.idUniversitat,universitats.adreça,pais.nomPais,universitats.urlUniversitat,universitats.urlIntercanvis
                                        FROM acordestudis
                                        INNER JOIN estada ON estada.codiEstada = acordestudis.codiEstada
                                        INNER JOIN conveni ON conveni.codiConveni = estada.codiConveni
                                        INNER JOIN centreestudis ON centreestudis.codiCentreEstudis = conveni.codiCentreEstudis
                                        INNER JOIN universitat_estudisuab ON universitat_estudisuab.codiUniEstudis = centreestudis.codiUniEstudis
                                        INNER JOIN universitats ON universitats.idUniversitat = universitat_estudisuab.idUniversitat
                                        INNER JOIN pais ON pais.idPais = universitats.idPais
                                        WHERE acordestudis.codiAssignaturaUAB = ?';
        error_reporting(0);
        $finalResults = array();
        foreach ($subjectIds as $subject){
            $consulta =  $consulta = $this->db->prepare($stringConsulta);
            $consulta->execute(array($subject));
            $actualResult = $consulta->fetchAll();

            if(empty($finalResults)){
                $finalResults = $actualResult;

            }else{
                if($typeOfSearch == "And"){
                    function compareDeepValue($val1, $val2) { return strcmp($val1['idUniversitat'], $val2['idUniversitat']); }
                    $finalResults = array_uintersect($finalResults, $actualResult, 'compareDeepValue');

                }else{
                    $finalResults = array_merge($finalResults, $actualResult);
                }
            }

        }

        $finalResults = array_map("unserialize", array_unique(array_map("serialize", $finalResults)));

        error_reporting(1);
        return $finalResults;
    }

    public function getUniversitiesBySubjectIdTypeOfSearchAndProgram($typeOfSearch, $program, $subjectIds){
        $stringConsulta = 'SELECT universitats.nomUniversitat,universitats.idUniversitat,universitats.adreça,pais.nomPais,universitats.urlUniversitat,universitats.urlIntercanvis
                                        FROM acordestudis
                                        INNER JOIN estada ON estada.codiEstada = acordestudis.codiEstada
                                        INNER JOIN conveni ON conveni.codiConveni = estada.codiConveni
                                        INNER JOIN centreestudis ON centreestudis.codiCentreEstudis = conveni.codiCentreEstudis
                                        INNER JOIN universitat_estudisuab ON universitat_estudisuab.codiUniEstudis = centreestudis.codiUniEstudis
                                        INNER JOIN universitats ON universitats.idUniversitat = universitat_estudisuab.idUniversitat
                                        INNER JOIN pais ON pais.idPais = universitats.idPais
                                        INNER JOIN tipusprogramamobilitat ON tipusprogramamobilitat.codiPrograma = pais.codiPrograma
                                        WHERE acordestudis.codiAssignaturaUAB = ?
                                        AND tipusprogramamobilitat.codiPrograma = ?';
        error_reporting(0);
        $finalResults = array();
        foreach ($subjectIds as $subject){
            $consulta =  $consulta = $this->db->prepare($stringConsulta);
            $consulta->execute(array($subject, $program));
            $actualResult = $consulta->fetchAll();

            if(empty($finalResults)){
                $finalResults = $actualResult;

            }else{
                if($typeOfSearch == "And"){
                    function compareDeepValue($val1, $val2) { return strcmp($val1['idUniversitat'], $val2['idUniversitat']); }
                    $finalResults = array_uintersect($finalResults, $actualResult, 'compareDeepValue');

                }else{
                    $finalResults = array_merge($finalResults, $actualResult);
                }
            }

        }

        $finalResults = array_map("unserialize", array_unique(array_map("serialize", $finalResults)));

        error_reporting(1);
        return $finalResults;
    }

    public function getUniversitiesByAproxName($search){
        if($search!=""){
            try {

            $consulta = $this->db->prepare("SELECT uni.nomUniversitat,uni.idUniversitat,uni.adreça,pais.nomPais,uni.urlUniversitat,uni.urlIntercanvis
                                            FROM universitats uni
                                            INNER JOIN pais ON pais.idPais = uni.idPais
                                            WHERE uni.nomUniversitat LIKE '%$search%' ORDER BY uni.nomUniversitat");
            $consulta->execute();
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);

            } catch (Exception $e) {
                $obj = $e;
            }
        }else{
            $consulta = $this->db->prepare('SELECT un.idUniversitat,un.nomUniversitat,un.urlUniversitat,un.urlIntercanvis,un.codiUniversitat
                                            FROM universitats un,pais pa
                                            WHERE un.idPais = pa.idPais ORDER BY un.nomUniversitat');
            $consulta->execute();
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
        }

        return $obj;

    }
    public function getUniversitiesByAproxNameAndDegree($search,$grau,$pais){
        //SI NO SE HA SELECCIONADO NI PAIS NI GRADO:
        if(($pais=="-1") && ($grau=="-1")) {

                try {

                    $consulta = $this->db->prepare("SELECT uni.nomUniversitat,uni.idUniversitat,uni.adreça,pais.nomPais,uni.urlUniversitat,uni.urlIntercanvis
                                                        FROM universitats uni
                                                        INNER JOIN pais ON pais.idPais = uni.idPais
                                                        WHERE uni.nomUniversitat LIKE '%$search%' ORDER BY uni.nomUniversitat");
                    $consulta->execute();
                    $obj = $consulta->fetchAll(PDO::FETCH_OBJ);

                } catch (Exception $e) {
                    $obj = $e;
                }

            //SI SOLO SE HA SELECCIONADO GRADO:
        }else if(($pais=="-1") && ($grau!="-1")){

                try {
                    $consulta = $this->db->prepare("SELECT uni.nomUniversitat,uni.idUniversitat,uni.adreça,pais.nomPais,uni.urlUniversitat,uni.urlIntercanvis
                                                FROM universitats uni
                                                INNER JOIN pais ON pais.idPais = uni.idPais
                                                INNER JOIN universitat_estudisuab ON universitat_estudisuab.idUniversitat = uni.idUniversitat
                                                WHERE uni.nomUniversitat LIKE '%$search%' AND universitat_estudisuab.codiEstudis=? ORDER BY uni.nomUniversitat");
                    $consulta->execute(array($grau));
                    $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
                } catch (Exception $e) {
                    $obj = $e;
                }

            //SI SOLO SE HA SELECCIONADO PAIS:
        }else if(($pais!="-1") && ($grau=="-1")) {

                try {
                    $consulta = $this->db->prepare("SELECT universitats.nomUniversitat,universitats.idUniversitat,universitats.adreça,pais.nomPais,universitats.urlUniversitat,universitats.urlIntercanvis
                                        FROM pais
                                        INNER JOIN universitats ON universitats.idPais = pais.idPais
                                        WHERE pais.idPais = ? AND universitats.nomUniversitat LIKE '%$search%' ORDER BY universitats.nomUniversitat");
                    $consulta->execute(array($pais));
                    $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
                } catch (Exception $e) {
                    $obj = $e;
                }

        }
        //SI SE HA SELECCIONADO TODO
        else {
            
                try {
                    $consulta = $this->db->prepare("SELECT universitats.nomUniversitat,universitats.idUniversitat,pais.nomPais,universitats.urlUniversitat,universitats.urlIntercanvis,universitat_estudisuab.codiEstudis
                                        FROM pais,universitat_estudisuab,universitats,estudisuab
                                        WHERE universitats.idPais = pais.idPais
                                        AND universitats.idPais = ?
                                        AND universitat_estudisuab.idUniversitat = universitats.idUniversitat
                                        AND universitat_estudisuab.codiEstudis= ? AND universitats.nomUniversitat LIKE '%$search%' 
                                        GROUP BY universitats.nomUniversitat,universitats.idUniversitat,pais.nomPais,universitats.urlUniversitat,universitats.urlIntercanvis,universitat_estudisuab.codiEstudis
                                        ORDER BY universitats.nomUniversitat");
                    $consulta->execute(array($pais, $grau));
                    $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
                } catch (Exception $e) {
                    $obj = $e;
                }
        }

        return $obj;

    }

    public function getUniversitiesByAproxNameAndDegreeSearchBlank($grau,$pais){
        //SI NO SE HA SELECCIONADO NI PAIS NI GRADO:
        if(($pais=="-1") && ($grau=="-1")) {

           try{

                $consulta = $this->db->prepare('SELECT un.idUniversitat,un.nomUniversitat,un.urlUniversitat,un.urlIntercanvis,un.codiUniversitat, pa.nomPais
                                                            FROM universitats un,pais pa
                                                            WHERE un.idPais = pa.idPais ORDER BY un.nomUniversitat');
                $consulta->execute();
                $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
            }catch (Exception $e) {
               $obj = $e;
           }
            return $obj;
            //SI SOLO SE HA SELECCIONADO GRADO:
        }else if(($pais=="-1") && ($grau!="-1")){

                try {
                    $consulta = $this->db->prepare('SELECT universitats.nomUniversitat,universitats.idUniversitat,pais.nomPais,universitats.urlUniversitat,universitats.urlIntercanvis
                                        FROM pais,universitats,universitat_estudisuab
                                        WHERE universitat_estudisuab.idUniversitat = universitats.idUniversitat
                                        and universitats.idPais = pais.idPais
                                        AND universitat_estudisuab.codiEstudis = ? ORDER BY universitats.nomUniversitat');
                    $consulta->execute(array($grau));
                    $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
                } catch (Exception $e) {
                    $obj = $e;
                }
            return $obj;

            //SI SOLO SE HA SELECCIONADO PAIS:
        }else if(($pais!="-1") && ($grau=="-1")) {

                try {
                    $consulta = $this->db->prepare('SELECT universitats.nomUniversitat,universitats.idUniversitat,pais.nomPais,universitats.urlUniversitat,universitats.urlIntercanvis
                                        FROM pais
                                        INNER JOIN universitats ON universitats.idPais = pais.idPais
                                        WHERE pais.idPais = ? ORDER BY universitats.nomUniversitat');
                    $consulta->execute(array($pais));
                    $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
                } catch (Exception $e) {
                    $obj = $e;
                }
            return $obj;
            }
        //SI SE HA SELECCIONADO TODO
        else {

                try {
                    $consulta = $this->db->prepare('SELECT universitats.nomUniversitat,universitats.idUniversitat,pais.nomPais,universitats.urlUniversitat,universitats.urlIntercanvis,universitat_estudisuab.codiEstudis
                                        FROM pais,universitat_estudisuab,universitats,estudisuab
                                        WHERE universitats.idPais = pais.idPais
                                        AND universitats.idPais = ?
                                        AND universitat_estudisuab.idUniversitat = universitats.idUniversitat
                                        AND universitat_estudisuab.codiEstudis= ? 
                                        GROUP BY universitats.nomUniversitat,universitats.idUniversitat,pais.nomPais,universitats.urlUniversitat,universitats.urlIntercanvis,universitat_estudisuab.codiEstudis
                                        ORDER BY universitats.nomUniversitat ');
                    $consulta->execute(array($pais, $grau));
                    $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
                } catch (Exception $e) {
                    $obj = $e;
                }
            return $obj;
            }

    }



    public function getUniversityByProgram($idProgram){

        $consulta = $this->db->prepare('SELECT universitats.nomUniversitat,universitats.idUniversitat,universitats.adreça,universitats.lat,universitats.lng,pais.nomPais,universitats.urlUniversitat,universitats.urlIntercanvis,pais.codiPrograma
                                        FROM pais
                                        INNER JOIN tipusprogramamobilitat ON tipusprogramamobilitat.codiPrograma = pais.codiPrograma
                                        INNER JOIN universitats ON universitats.idPais= pais.idPais
                                        WHERE tipusprogramamobilitat.codiPrograma = ?');



        $consulta->execute(array($idProgram));
        $rows = array();
        $rows = $consulta->fetchAll();
        return json_encode($rows);


    }
    public function getUniversityByCountryandDegree($idCountry,$idDegree){
        $consulta = $this->db->prepare('SELECT universitats.nomUniversitat,universitats.idUniversitat,universitats.adreça,universitats.lat,universitats.lng,pais.nomPais,universitats.urlUniversitat,universitats.urlIntercanvis,universitat_estudisuab.codiEstudis,estudisuab.nomGrau,pais.codiPrograma
                                        FROM pais,universitat_estudisuab,universitats,estudisuab
                                        WHERE universitats.idPais = pais.idPais
                                        AND universitats.idPais = ?
                                        AND universitat_estudisuab.idUniversitat = universitats.idUniversitat
                                        AND universitat_estudisuab.codiEstudis= ?');



        $consulta->execute(array($idCountry,$idDegree));
        $rows = array();
        $rows = $consulta->fetchAll();
        return json_encode($rows);

    }

    public function getUniversityByProgramAndDegree($idProgram,$idDegree){
        $consulta = $this->db->prepare('SELECT universitats.nomUniversitat,universitats.idUniversitat,universitats.adreça,universitats.lat,universitats.lng,pais.nomPais,universitats.urlUniversitat,universitats.urlIntercanvis,universitat_estudisuab.codiEstudis,estudisuab.nomGrau,pais.codiPrograma
                                        FROM pais,universitat_estudisuab,universitats,estudisuab, tipusprogramamobilitat
                                        WHERE tipusprogramamobilitat.codiPrograma =  ?
                                        AND pais.codiPrograma = tipusprogramamobilitat.codiPrograma
                                        AND universitat_estudisuab.codiEstudis= ?
                                        AND estudisuab.codiEstudis = universitat_estudisuab.codiEstudis
                                        AND universitats.idPais = pais.idPais
                                        AND universitat_estudisuab.idUniversitat = universitats.idUniversitat ');



        $consulta->execute(array($idProgram,$idDegree));
        $rows = array();
        $rows = $consulta->fetchAll();
        return json_encode($rows);

    }
    public function getUniversitiesByDegreesAssigned(){
        try {
            $consulta = $this->db->prepare('SELECT un.nomUniversitat,un.idUniversitat, es.nomGrau, es.codiEstudis,ue.codiUniEstudis
                                        FROM universitats un, universitat_estudisuab ue, estudisuab es
                                        WHERE ue.idUniversitat = un.idUniversitat
                                        AND es.codiEstudis = ue.codiEstudis
                                        ORDER BY es.nomGrau,un.nomUniversitat');
            $consulta->execute();
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $e) {
            $obj = $e;
        }

        return $obj;

    }
    public function getUniversitiesByDegreesAssignedOut(){
        try {
            $consulta = $this->db->prepare('SELECT un.nomUniversitat,un.idUniversitat, es.nomGrau, es.codiEstudis,ue.codiUniEstudis
                                        FROM universitats un, universitat_estudisuab ue, estudisuab es, centreestudis ce
                                        WHERE ue.idUniversitat = un.idUniversitat
                                        AND es.codiEstudis = ue.codiEstudis
                                        AND ue.codiUniEstudis not in(
                                        SELECT codiUniEstudis FROM centreestudis
                                        )
                                        GROUP by un.nomUniversitat,un.idUniversitat, es.nomGrau, es.codiEstudis,ue.codiUniEstudis
                                        ORDER BY es.nomGrau,un.nomUniversitat');
            $consulta->execute();
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $e) {
            $obj = $e;
        }

        return $obj;

    }


    public function addUniversityWithDegree($idUniversitat,$idGrau){
        try {
            $consulta = $this->db->prepare("INSERT INTO universitat_estudisuab(codiEstudis,idUniversitat) VALUES (?,?)");
            $consulta->execute(array($idGrau,$idUniversitat));

            $id = $this->db->lastInsertId();
            return $id;
        } catch (Exception $e) {
            $obj = $e;            
        }

    }
    public function ifExistUniversityWithDegree($idUniversitat,$idGrau){
        try {
            $consulta = $this->db->prepare("SELECT * FROM universitat_estudisuab WHERE codiEstudis=? AND idUniversitat=?");
            $consulta->execute(array($idGrau,$idUniversitat));
            $obj = $consulta->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            $obj = $e;            
        }
        return $obj;

    }
    public function updateUniversityWithDegree($idUniversitat,$idGrau,$codiUniGrau){
        try {
            $consulta = $this->db->prepare("UPDATE universitat_estudisuab SET codiEstudis=?,idUniversitat=? WHERE codiUniEstudis=?");
            $consulta->execute(array($idGrau,$idUniversitat,$codiUniGrau));
            
        } catch (Exception $e) {
            $obj = $e;            
        }
    }
    public function getUniversitiesByUser($niuUsuari){
        try {
            $consulta = $this->db->prepare('SELECT  un.nomUniversitat,un.idUniversitat
                FROM conveni co, estada es, universitats un,centreestudis ce, universitat_estudisuab ue
                WHERE co.codiCentreEstudis = ce.codiCentreEstudis
                AND ce.codiUniEstudis = ue.codiUniEstudis
                AND un.idUniversitat = ue.idUniversitat
                AND co.codiConveni = es.codiConveni
                AND es.niuEstudiant = ?
                GROUP BY un.idUniversitat');
            $consulta->execute(array($niuUsuari));
            $obj = $consulta->fetch(PDO::FETCH_OBJ);
            
        } catch (Exception $e) {
            $obj = $e;            
        }
        return $obj;
    }
    public function deleteUniversityWithDegree($codiUniGrau){
        try {
            $consulta = $this->db->prepare("DELETE FROM universitat_estudisuab WHERE codiUniEstudis=?");
            $consulta->execute(array($codiUniGrau));
        } catch (Exception $e) {
            
        }

    }
    public function getUniversitiesPlaces(){
        try {
            $consulta = $this->db->prepare('SELECT ce.codiCentreEstudis,ce.actiu,ce.plaçes,ce.mesos,ce.període,ce.codiUniEstudis,uni.nomUniversitat,es.nomGrau,pr.nom,pr.cognoms,pr.niuProfessor
                                            FROM centreestudis ce, universitat_estudisuab un,universitats uni,estudisuab es,professorscentre pc, professors pr
                                            WHERE ce.codiUniEstudis = un.codiUniEstudis
                                            AND uni.idUniversitat = un.idUniversitat
                                            AND un.codiEstudis = es.codiEstudis
                                            AND ce.codiCentreEstudis = pc.codiCentreEstudis
                                            AND pc.niuProfessor = pr.niuProfessor
                                            ORDER BY uni.nomUniversitat');
            $consulta->execute();
            $obj = $consulta->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $e) {
            $obj = $e;
        }

        return $obj;

    }
    public function updateUniversityById($idUniversitat,$nomUniversitat,$adreça,$lat,$lng,$urlUniversitat,$urlIntercanvis,$codiUniversitat,$acreditacióIdioma,$observacions){
        $consulta = $this->db->prepare('UPDATE universitats SET nomUniversitat =?, adreça =?, lat=?, lng =?, urlUniversitat =?, urlIntercanvis=?, codiUniversitat =?, acreditacióIdioma =?, observacions =? WHERE idUniversitat=?');
        $consulta -> bindValue(1, $nomUniversitat);
        $consulta -> bindValue(2, $adreça);
        $consulta -> bindValue(3, $lat);
        $consulta -> bindValue(4, $lng);
        $consulta -> bindValue(5, $urlUniversitat);
        $consulta -> bindValue(6, $urlIntercanvis);
        $consulta -> bindValue(7, $codiUniversitat);
        $consulta -> bindValue(8, $acreditacióIdioma);
        $consulta -> bindValue(9, $observacions);
        $consulta -> bindValue(10, $idUniversitat);
        $consulta->execute();
        //$consulta->execute(array($nomUniversitat,$adreça,$lat,$lng,$urlUniversitat,$urlIntercanvis,$codiUniversitat,$acreditacióIdioma,$observacions,$idUniversitat));
    }

    //Alfred Code
    public function addUniversity($idUniversitat,$nomUniversitat,$adreça,$lat,$lng,$urlUniversitat,$urlIntercanvis,$codiUniversitat,$acreditacióIdioma,$observacions,$fotoPath, $idPais){
        $consulta = $this->db->prepare("INSERT INTO universitats(nomUniversitat,idPais,adreça,lat,lng,urlUniversitat,urlIntercanvis, codiUniversitat,acreditacióIdioma,observacions,fotoPath) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $consulta->execute(array($nomUniversitat,$idPais,$adreça,$lat,$lng,$urlUniversitat,$urlIntercanvis,$codiUniversitat,$acreditacióIdioma,$observacions,$fotoPath));

        $id = $this->db->lastInsertId();
        return $id;
    }
    public function deleteUniversityById($idUniversitat){
        $consulta = $this->db->prepare("DELETE FROM universitats WHERE idUniversitat=?");
        $consulta->execute(array($idUniversitat));

    }
    public function insertPhotoOnUniversity($idUniversitat,$photo){
        try {
            $consulta = $this->db->prepare("UPDATE universitats SET fotoPath=? WHERE idUniversitat=?");
        $consulta->execute(array($photo,$idUniversitat));
        } catch (Exception $e) {
            
        }

    }

    public function getURLUniversities(){
        $consulta = $this->db->prepare('SELECT idUniversitat, nomUniversitat, urlUniversitat, urlIntercanvis FROM universitats');
        $consulta->execute();
        $rows = $consulta->fetchAll();

        return $rows;
    }

    public function getNullURLUniversitat(){
        $consulta = $this->db->prepare('SELECT idUniversitat, nomUniversitat, urlUniversitat, urlIntercanvis FROM universitats WHERE urlUniversitat=" " ');
        $consulta->execute();
        $rows = $consulta->fetchAll();

        return $rows;
    }
    public function getNullURLIntercanvi(){
        $consulta = $this->db->prepare('SELECT idUniversitat, nomUniversitat, urlUniversitat, urlIntercanvis FROM universitats WHERE urlIntercanvis=" "');
        $consulta->execute();
        $rows = $consulta->fetchAll();

        return $rows;
    }

    public function disconnect(){
        $this->db =null;
    }
	

}

?>