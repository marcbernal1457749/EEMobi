function getUniversitiesByIdSubject(e) {
    $.ajax({type:"GET",url:"index.php",data:"/Map/mapBySubject/"+e}).done(function(e) {newMap(e)})
}

function getUniversitiesByIdProgram(e){
    $.ajax({type:"GET",url:"index.php",data:"/Map/mapByProgram/"+e}).done(function(e) {newMap(e)})
}

function getUniversitiesByIdCountry(e){
    $.ajax({type:"GET",url:"index.php",data:"/Map/mapByCountry/"+e}).done(function(e){newMap(e)})
}

function getUniversitiesByIdDegree(e){
    $.ajax({type:"GET",url:"index.php",data:"/Map/mapByDegree/"+e}).done(function(e){newMap(e)})
}

function getUniversitiesByIdDC(e,n){
    $.ajax({type:"GET",url:"index.php",data:"/Map/mapByDegreeAndCountry/"+e+"/"+n}).done(function(e){newMap(e)})
}

function getUniversitiesByProgramAndDegree(e,n){
    $.ajax({type:"GET",url:"index.php",data:"/Map/mapByProgramAndDegree/"+e+"/"+n}).done(function(e){newMap(e)})
}

function getCountrysByProgram(e){
    $.ajax({type:"GET",url:"index.php",data:"/OnChangeSelect/countriesByProgram/"+e,success:function(e,n,t){$(".co").html(e)},error:function(e,n,t){}})
}

function getDegreesByCountry(e){
    $.ajax({type:"GET",url:"index.php",data:"/OnChangeSelect/degreesByCountry/"+e,success:function(e,n,t){$(".de").html(e)},error:function(e,n,t){}})
}

function getCountryBySubject(e){
    $.ajax({type:"GET",url:"index.php",data:"/OnChangeSelect/countriesBySubject/"+e,success:function(e,n,t){$(".de").html(e)},error:function(e,n,t){}})
}

function getSubjectsByDegree(e){
    $.ajax({type:"GET",url:"index.php",data:"/OnChangeSelect/subjectsByDegree/"+e,success:function(e,n,t){$("#subjectsBuscador").html(e)},error:function(e,n,t){}})
}

function editProfile(){
    $.ajax({type:"GET",url:"perfil.php",data:"/editProfile",success:function(e,n,t){$(".contingut").html(e)},error:function(e,n,t){}})
}

function getUniversitiesByUser(e){
    $.ajax({type:"GET",url:"perfil.php",data:"/openFormPopup/"+e,success:function(e,n,t){$(".modal-dialog").html(e)},error:function(e,n,t){}})
}

function getAcordsById(e){
    $.ajax({type:"GET",url:"perfil.php",data:"/openFormAcord/"+e,success:function(e,n,t){$(".modal-dialog").html(e),$("#test").DataTable()},error:function(e,n,t){}})
}

function firstRatings(data){
    $.ajax({
        type: "POST",
        url: "perfil.php/" + "firstRatings",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
            $("#valoracionesPerfilUser").html(t)
        },
        error: function(t, e) {
            window.alert("Error al intentar inicialitzar les valoracions");
        }
    })
}

function editRating(data){
    $.ajax({
        type: "POST",
        url: "perfil.php/" + "editRating",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
        },
        error: function(t, e) {
            window.alert("Error al intentar actualitzar valoracions");
        }
    })
}

function filtrarAcordsAdmin(data){
    $.ajax({
        type: "POST",
        url: "perfil.php/" + "filtrarAcordsAdmin",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
            $("#taulaAcordsCoordinador").html(t);
        },
        error: function(t, e) {
        }
    })
}

//Funciones para ordenar una tabla
function comparer(index) {
    return function(a, b) {
        var valA = getCellValue(a, index), valB = getCellValue(b, index);
        return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB)
    }
}
function getCellValue(row, index){ return $(row).children('td').eq(index).text() }

function onEnterSearhUni(data) {

    $.ajax({
        type: 'POST',
        url:  "controllers/ResultatsCercadorUniController.php",
        data: {"nameUni":data},
        success: function(data){
            $('#resultsTable').empty();
            $('#resultsTable').html((data));
        },
        complete: function (xhr, status) {
            $('#resultsTable').slideDown('slow');
        }
    });
}