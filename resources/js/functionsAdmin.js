function addAgreement(agreement) {
    var agreementHtml = "<tr>" +
        "<td class='agreementCode'>"+agreement.agreementCode+"</td>" +
        "<td class='agreementStudies'>"+agreement.agreementStudies+"</td>" +
        "<td class='agreementPlaces'>"+agreement.agreementPlaces+"</td>" +
        "<td class='agreementMonths'>"+agreement.agreementMonths+"</td>" +
        "<td class='agreementPeriod'>"+agreement.agreementPeriod+"</td>" +
        "<td class='agreementActive'>"+agreement.agreementActive+"</td>" +
        "<td class='agreementCoordinator'><button id='remAgreementFromUniCreate' type='button' class='close' aria-label='Close'><span aria-hidden='true'>&times;</span></button>"+agreement.agreementCoordinator+"</td></tr>"

    $("#agreements").append(agreementHtml);
}

function createUniversitiesBackend() {
    $.ajax({
        type: "GET",
        url: "admin.php",
        data: "/createNewUniversity",
        success: function(t, e, c) {
            $("#content").html(t)
        },
        error: function(t, e) {}
    })
}

function editaUniversitiesBackend(data) {
    $.ajax({
        type: "POST",
        url: "admin.php/" + "editaUniversitiesBackend",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
            $("#content").html(t)
        },
        error: function(t, e) {}
    })
}

function updateUniversity(data){
    $.ajax({
        type: "POST",
        url: "admin.php/" + "updateUniversity",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
            window.alert("Informació d'universitat actualitzada");
        },
        error: function(t, e) {
            window.alert("Hi ha hagut un problema al actualitzar les dades");
        }
    });
}

function updateConvenis(data){
    $.ajax({
        type: "POST",
        url: "admin.php/" + "updateConvenis",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
            window.alert("Convenis actualitzats");
        },
        error: function(t, e) {
            window.alert("Hi ha hagut un problema al actualitzar les dades");
        }
    });
}

function addConveni(data){
    $.ajax({
        type: "POST",
        url: "admin.php/" + "addConveni",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
            window.alert("Conveni afegit");
            $("#convenisBodyTable").append(t);

        },
        error: function(t, e) {
            window.alert("Hi ha hagut un problema al actualitzar les dades");
        }
    });
}

function updateEstades(data){
    $.ajax({
        type: "POST",
        url: "admin.php/" + "updateEstades",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
            window.alert("Estades actualitzades");
        },
        error: function(t, e) {
            window.alert("Hi ha hagut un problema al actualitzar les dades");
        }
    });
}

function addStay(data){
    $.ajax({
        type: "POST",
        url: "admin.php/" + "addStay",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
            window.alert("Estancia afegida");
            $("#staysBody").append(t);

        },
        error: function(t, e) {
            window.alert("Hi ha hagut un problema al actualitzar les dades");
        }
    });
}

function openSubjectModal(data){
    $.ajax({
        type: "POST",
        url: "admin.php/" + "openSubjectModal",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
            $("#dinamicModal").children().remove();
            $("#dinamicModal").append(t);
            $('#acordModal').modal('show');
        },
        error: function(t, e) {
            window.alert("Hi ha hagut un problema al actualitzar les dades");
        }
    });
}

function editAcords(data){
    $.ajax({
        type: "POST",
        url: "admin.php/" + "editAcords",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
            window.alert("Acord actualitzats");
        },
        error: function(t, e) {
            window.alert("Hi ha hagut un problema al actualitzar les dades");
        }
    });
}

function addAcord(data){
    $.ajax({
        type: "POST",
        url: "admin.php/" + "addAcord",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
            $("#subjectsModal").append(t);
            window.alert("Acord afegit");
        },
        error: function(t, e) {
            window.alert("Hi ha hagut un problema al actualitzar les dades");
        }
    });
}

function removeAcord(data){
    $.ajax({
        type: "POST",
        url: "admin.php/" + "removeAcord",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
        },
        error: function(t, e) {
            window.alert("Error al intentar eliminar l'acord");
        }
    })
}

function otherActionsBackend() {
    $.ajax({
        type: "GET",
        url: "admin.php",
        data: "/otherActions",
        success: function(t, e, c) {
            $("#content").html(t)
        },
        error: function(t, e) {}
    })
}

function getFooterBackend() {
    $.ajax({
        type: "GET",
        url: "admin.php",
        data: "/getFooterAdmin",
        success: function(t, e, c) {
            $("#content").html(t)
        },
        error: function(t, e) {}
    })
}

function updateSectionTitles(data){
    $.ajax({
        type: "POST",
        url: "admin.php/" + "updateSectionTitles",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
            window.alert("Títols de secció actualitzats correctament");
        },
        error: function(t, e) {
            window.alert("Error al realitzar l'actualització");
        }
    })
}

function updateSubSections(data){
    $.ajax({
        type: "POST",
        url: "admin.php/" + "updateSubSections",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
            window.alert("Informació dels apartats actualitzada correctament");
        },
        error: function(t, e) {
            window.alert("Error al realitzar l'actualització");
        }
    })
}

function addSubSection(data){
    $.ajax({
        type: "POST",
        url: "admin.php/" + "addSubSection",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
            window.alert("Apartat afegit correctament");
            $("#subSectionsBodyTable").append(t);
        },
        error: function(t, e) {
            window.alert("Error al inserir l'apartat");
        }
    })
}

function removeSubSection(data){
    $.ajax({
        type: "POST",
        url: "admin.php/" + "removeSubSection",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
        },
        error: function(t, e) {
            window.alert("Error al intentar eliminar l'apartat");
        }
    })
}

function getUrlTesterBackend() {
    $.ajax({
        type: "GET",
        url: "admin.php",
        data: "/getUrlTesterAdmin",
        success: function(t, e, c) {
            $("#content").html(t)
        },
        error: function(t, e) {}
    })
}

function testUrlsUniversitat(){
   window.alert("Atenció! Aquest és un procés lent, si us plau tingues paciència. Rebràs un altre missatge d'alerta quan el procés hagi acabat! Gràcies");
    $.ajax({
        type: "GET",
        url: "admin.php",
        data: "/testUrlsUniversitat",
        beforeSend: function() {  $('#loader').css("display", "block"); },
        success: function(t, e, c) {
            $("#result").html(t);
        },
        complete: function(){
            $('#loader').css("display", "none");
            },
        error: function(t, e) {
            window.alert("Error al intentar testejar les URL!");
        }
    })
}

function testUrlsAssigUAB(){
    window.alert("Atenció! Aquest és un procés lent, si us plau tingues paciència. Rebràs un altre missatge d'alerta quan el procés hagi acabat! Gràcies");
    $.ajax({
        type: "GET",
        url: "admin.php",
        data: "/testUrlsAssigUAB",
        beforeSend: function() {  $('#loader1').css("display", "block"); },
        success: function(t, e, c) {
            $("#result1").html(t);
        },
        complete: function(){
            $('#loader1').css("display", "none");
        },
        error: function(t, e) {
            window.alert("Error al intentar testejar les URL!");
        }
    })
}


function testUrlsAssigEXT(){
    window.alert("Atenció! Aquest és un procés lent, si us plau tingues paciència. Rebràs un altre missatge d'alerta quan el procés hagi acabat! Gràcies");

    $.ajax({
        type: "GET",
        url: "admin.php",
        data: "/testUrlsAssigEXT",
        beforeSend: function() {  $('#loader2').css("display", "block"); },
        success: function(t, e, c) {
            $("#result2").html(t);
        },
        complete: function(){
            $('#loader2').css("display", "none");
        },
        error: function(t, e) {
            window.alert("Error al intentar testejar les URL!");
        }
    })
}

function removefailURL(data){
    $.ajax({
        type: "POST",
        url: "admin.php/" + "deletefailedURL",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
        },
        error: function(t, e) {
            window.alert("Error al intentar eliminar la URL");
        }
    })
}

function viewUrlsUnis(){
    $.ajax({
        type: "GET",
        url: "admin.php",
        data: "/getfailedURLUnis",
        success: function(t, e, c) {
            $("#result").html(t)
        },
        error: function(t, e) {}
    })
}

function viewUrlsAssigUAB(){
    $.ajax({
        type: "GET",
        url: "admin.php",
        data: "/getfailedURLAssigUAB",
        success: function(t, e, c) {
            $("#result1").html(t)
        },
        error: function(t, e) {}
    })
}

function viewUrlsAssigEXT(){
    $.ajax({
        type: "GET",
        url: "admin.php",
        data: "/getfailedURLAssigEXT",
        success: function(t, e, c) {
            $("#result2").html(t)
        },
        error: function(t, e) {}
    })
}

function getAuxTablesBackend(){
    $.ajax({
        type: "GET",
        url: "admin.php",
        data: "/getAuxTablesAdmin",
        success: function(t, e, c) {
            $("#content").html(t)
        },
        error: function(t, e) {}
    })
}


function removeTableCountries(data){
    $.ajax({
        type: "POST",
        url: "admin.php/" + "removeTableCountries",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
        },
        error: function(t, e) {
            window.alert("Error al intentar eliminar el pais");
        }
    })
}

function removeTableSubjects(data){
    $.ajax({
        type: "POST",
        url: "admin.php/" + "removeTableSubjects",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
        },
        error: function(t, e) {
            window.alert("Error al intentar eliminar la assignatura");
        }
    })
}

function removeTableDegree(data){
    $.ajax({
        type: "POST",
        url: "admin.php/" + "removeTableDegree",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
        },
        error: function(t, e) {
            window.alert("Error al intentar eliminar el grau");
        }
    })
}

function removeTableTeachers(data){
    $.ajax({
        type: "POST",
        url: "admin.php/" + "removeTableTeachers",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
        },
        error: function(t, e) {
            window.alert("Error al intentar eliminar el professor");
        }
    })
}

function removeTableAdmins(data){
    $.ajax({
        type: "POST",
        url: "admin.php/" + "removeTableAdmins",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
        },
        error: function(t, e) {
            window.alert("Error al intentar eliminar l'admin");
        }
    })
}

function updateTableCountries(data){
    $.ajax({
        type: "POST",
        url: "admin.php/" + "updateTableCountries",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
            window.alert("Noms actualitzats correctament");
        },
        error: function(t, e) {
            window.alert("Error al realitzar l'actualització");
        }
    })
}

function updateTableSubjects(data){
    $.ajax({
        type: "POST",
        url: "admin.php/" + "updateTableSubjects",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
            window.alert("Noms actualitzats correctament");
        },
        error: function(t, e) {
            window.alert("Error al realitzar l'actualització");
        }
    })
}

function updateTableDegrees(data){
    $.ajax({
        type: "POST",
        url: "admin.php/" + "updateTableDegrees",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
            window.alert("Noms actualitzats correctament");
        },
        error: function(t, e) {
            window.alert("Error al realitzar l'actualització");
        }
    })
}

function updateTableTeachers(data){
    $.ajax({
        type: "POST",
        url: "admin.php/" + "updateTableTeachers",
        data: {"data":JSON.stringify(data)},
        success: function(t, e, c) {
            window.alert("Noms actualitzats correctament");
        },
        error: function(t, e) {
            window.alert("Error al realitzar l'actualització");
        }
    })
}

function getUniversitiesBackend(n) {
    $.ajax({
        type: "GET",
        url: "admin.php",
        data: "/getInformationUniversities",
        success: function(t, e, c) {
            $("#content").html(t)
        },
    })
}


function getStudentsBackend(n) {
    $.ajax({
        type: "GET",
        url: "admin.php",
        data: "/getInformationStudents",
        success: function(t, e, c) {
            $("#content").html(t), n()
        },
        error: function(n, t, e) {}
    })
}

function getProgramsBackend(n) {
    $.ajax({
        type: "GET",
        url: "admin.php",
        data: "/getInformationPrograms",
        success: function(t, e, c) {
            $("#content").html(t), n()
        },
        error: function(n, t, e) {}
    })
}

function getUniversitiesAndDegreesBackend(n) {
    $.ajax({
        type: "GET",
        url: "admin.php",
        data: "/getInformationUniAndDegrees",
        success: function(t, e, c) {
            $("#content").html(t), n()
        },
        error: function(n, t, e) {}
    })
}

function getUniversitiesPlacesBackend(n) {
    $.ajax({
        type: "GET",
        url: "admin.php",
        data: "/getUniversitiesPlaces",
        success: function(t, e, c) {
            $("#content").html(t), n()
        },
        error: function(n, t, e) {}
    })
}

function getConvenis(n) {
    $.ajax({
        type: "GET",
        url: "admin.php",
        data: "/getConvenis",
        success: function(t, e, c) {
            $("#content").html(t), n()
        },
        error: function(n, t, e) {}
    })
}

function getEstades(n) {
    $.ajax({
        type: "GET",
        url: "admin.php",
        data: "/getEstades",
        success: function(t, e, c) {
            $("#content").html(t), n()
        },
        error: function(n, t, e) {}
    })
}

function getAcordsEstudis(n) {
    $.ajax({
        type: "GET",
        url: "admin.php",
        data: "/getAcordsEstudis",
        success: function(t, e, c) {
            $("#content").html(t), n()
        },
        error: function(n, t, e) {}
    })
}


//Funciones para ordenar una tabla
function comparer(index) {
    return function(a, b) {
        var valA = getCellValue(a, index), valB = getCellValue(b, index)
        return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB)
    }
}
function getCellValue(row, index){ return $(row).children('td').eq(index).text() }

function filterTableUnis() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("inputFilteringUni");
    filter = input.value.toUpperCase();
    table = document.getElementById("FullTable");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
