$(document).ready(function() {


    $(".CUV").click(function(e){
        e.preventDefault(), createUniversitiesBackend();
    }),

        $(document).on("click", "#submitSections", (function(e){
        e.preventDefault();
        var data = [];
        $('#sectionsBodyTable > tr > td > input').each(function(e){
           data.push({"id":$(this).attr("id"),"titol":$(this).val()});
        });

        updateSectionTitles(data);
    })),

        $(document).on("click", "#submitSubSections", function (e){
           e.preventDefault();
           var data = [];
           var id = -1;
           var title = "";
           var url = "";
           var i = 0;

           $('#subSectionsBodyTable> tr').each(function(e){
               i = 0;
               id = $(this).attr("id");
               $(this).find('td > input').each(function (e) {
                    if (i == 0){
                        title = $(this).val();
                        i = 1;
                    }else{
                        url = $(this).val();
                    }

               });
               data.push({"id":id,"titol":title,"url":url});
           });

            updateSubSections(data);
        }),

        $(document).on("click", "#addSubSectionButton", function(e){
           e.preventDefault();
           var data = [];
           var idSeccio = $("#modalSection option:selected").attr("id");
           var titolSeccio = $("#modalSection option:selected").text();
           var titolSubSeccio = $("#modalTitleSubSection").val();
           var urlSubSeccio = $("#modalUrl").val();

           data.push({"id":idSeccio, "titolSeccio":titolSeccio, "titol":titolSubSeccio,"url":urlSubSeccio});
           addSubSection(data);
        }),

        $(document).on("click", "#remSubSection", function(e) {
            e.preventDefault();

            if(confirm('Realment vols eliminar aquest Apartat?')){
                var data = [];
                var id = $(this).closest('tr').attr("id");

                data.push({"id":id});
                removeSubSection(data);
                $(this).closest('tr').remove();
            }else{}

            return false;
        }),

    $(".AA").click(function(e){
       e.preventDefault(), otherActionsBackend();
    }),

        $(document).on("click", "#addAgreementBox",function(){
        var agreement = {};
        agreement.agreementCode = $("#agreementCode ").val();
        agreement.agreementStudies = $("#agreementStudies option:selected").text();
        agreement.agreementPlaces = $("#agreementPlaces ").val();
        agreement.agreementMonths = $("#agreementMonths ").val();
        agreement.agreementPeriod = $("#agreementPeriod ").val();
        agreement.agreementActive = $("#agreementActive option:selected").text();
        agreement.agreementCoordinator = $("#agreementCoordinator option:selected").text();
        addAgreement(agreement);

    }),

        $(document).on("click", "#remAgreementFromUniCreate", function(e){
        e.preventDefault();
        $(this).closest('tr').remove();

        return false;
    }),

    $(document).on("click", "#desaUniversitatConvenis", function(e){
        e.preventDefault();

        var infoUni = JSON.stringify({
            nom: $("#Nom").val(),
            pais: $("#País option:selected").text(),
            "adreça": $("#Adreça").val(),
            url: $("#URLUniversitat").val(),
            urlIn: $("#URLIntercanvis").val(),
            codi: $("#CodiUniversitat").val(),
            latitud: $("#Latitud").val(),
            longitud: $("#Longitud").val(),
            acreditacio: $("#Acreditacióidioma").val(),
            observacions: $("#Observacions").val()
        });

        var infoConvenis = [];

        $('#agreements tr').each( function(e){
            infoConvenis.push(JSON.stringify({
                codi: $(this).find(".agreementCode").html(),
                estudis: $(this).find(".agreementStudies").html(),
                places: $(this).find(".agreementPlaces").html(),
                mesos: $(this).find(".agreementMonths").html(),
                periode: $(this).find(".agreementPeriod").html(),
                actiu: $(this).find(".agreementActive").html(),
                coordinador: $(this).find(".agreementCoordinator").html()
            }));
        });

        $.ajax({
            type: "POST",
            url: "admin.php/" + "addUniAndConvenis",
            data: {'infoUni' : infoUni, 'infoConvenis' : infoConvenis},
            encode: !0,
            success: function(data) {
                //$('#desaUniversitatConvenis').html((data));
                $(".UV").trigger('click');
            },
            error: function() {
                console.log("error")
            }
        })
    }),

    $(document).on("click", "#uniTableBody > tr > td > a > img", function(e){
        e.preventDefault();
        var id = $(this).attr("id");
        var data = [];
        data.push({"id":id});

        editaUniversitiesBackend(data);
    }),

    $(document).on("click", "#updateUniversity", function(e){
        e.preventDefault();
        var id= $("#idUni").attr("value");
        var idPais = $("#idCountry").attr("value");
        var Nom =$("#Nom").val();
        var Adreça =$("#Adreça").val();
        var URLUniversitat =$("#URLUniversitat").val();
        var URLIntercanvis =$("#URLIntercanvis").val();
        var CodiUniversitat =$("#CodiUniversitat").val();
        var Latitud =$("#Latitud").val();
        var Longitud =$("#Longitud").val();
        var Acreditacióidioma =$("#Acreditacióidioma").val();
        var Observacions =$("#Observacions").val();
        var Foto = $("#foto").attr("value");

        var data = []
        data.push({"id":id, "idPais":idPais, "nom":Nom, "adr":Adreça, "urlUni":URLUniversitat, "urlInt":URLIntercanvis,
            "codiUni":CodiUniversitat, "lat":Latitud, "lng":Longitud, "idioma":Acreditacióidioma, "obs":Observacions, "foto":Foto});

        updateUniversity(data);
    }),

    $(document).on("click", "#updateConvenis", function(e){
        e.preventDefault();

        var data = [];
        var info = [];

        $("#convenisBodyTable > tr").each(function (e) {

            $(this).find('td > input').each(function (e){
                info.push($(this).val());
            });
            $(this).find('td > select option:selected').each(function (e) {
                info.push($(this).attr("id"));
            });

            data.push({"codi":info[0], "idCE":info[1], "places":info[2], "mesos":info[3], "periode":info[4],
                "actiu":info[5], "idProf":info[6]});
            info = [];
        });

        updateConvenis(data);
    }),

    $(document).on("click", "#addConveni", function(e){
        e.preventDefault();

        var agreement = {};
        agreement.agreementCode = $("#agreementCode ").val();
        agreement.agreementStudies = $("#agreementStudies option:selected").val();
        agreement.agreementPlaces = $("#agreementPlaces ").val();
        agreement.agreementMonths = $("#agreementMonths ").val();
        agreement.agreementPeriod = $("#agreementPeriod ").val();
        agreement.agreementActive = $("#agreementActive option:selected").text();
        agreement.agreementCoordinator = $("#agreementCoordinator option:selected").val();
        agreement.agreementUniversity = $("#idUni").val();

        addConveni(agreement);
    }),

    $(document).on("click", "#updateEstades", function(e){
        e.preventDefault();

        var data = [];
        var info = [];

        $("#staysBody > tr").each(function (e) {

            $(this).find('td > input').each(function (e){
                info.push($(this).val());
            });
            $(this).find('td > select option:selected').each(function (e) {
                info.push($(this).attr("id"));
            });

            data.push({"idEstada":info[0], "est":info[1], "idConveni":info[2], "curs":info[3], "semestre":info[4],
                "professor":info[5]});
            info = [];
        });

        updateEstades(data);
    }),

    $(document).on("click", "#addStay", function(e) {
        e.preventDefault();

        var stay = {};
        stay.idStudent = $("#studentStay option:selected").attr("id");
        stay.student = $("#studentStay option:selected").val();
        stay.curs = $("#cursStay ").val();
        stay.semestre = $("#semestreStay ").val();
        stay.idConveni = $("#convenisUni option:selected").val();
        stay.idTeacher = $("#profesorStay option:selected").attr("id");
        stay.teacher = $("#profesorStay option:selected").val();

        addStay(stay);
    }),

    $(document).on("click", "#staysBody > tr > td > a > img", function(e){
        e.preventDefault();
        var id = $(this).attr("id");
        var data = [];
        data.push({"id":id});

        openSubjectModal(data);
    }),

    $(document).on("click", "#updateAcords", function(e){
        e.preventDefault();
        var agreements = [];
        var eachAgreement = {};

        $("#subjectsModal > tr").each(function (e){
            eachAgreement.idEstada = $("#idEstada").val();
            eachAgreement.idAcord = $(this).find("#codiAcord").val();
            eachAgreement.idAssUAB = $(this).find("#codiAssignaturaUAB").val();
            eachAgreement.nomAssUAB = $(this).find("#nomAssignatura").val();
            eachAgreement.nomAssExt = $(this).find("#nomAssExt").val();
            eachAgreement.credits = $(this).find("#credits").val();
            eachAgreement.idAssExt = $(this).find("#codiAssExt").val();
            eachAgreement.linkAssExt = $(this).find("#enllaçAssExt").val();

            agreements.push(eachAgreement);
            eachAgreement = {};
        });

        editAcords(agreements);
    }),

    $(document).on("click", "#addAcordRow", function(e){
       e.preventDefault();

        var newRow = $("#newRow > table > tbody").children();
       $("#subjectsModal").append(newRow);
    }),

    $(document).on("click", "#subjectsModal > tr > td > a > img", function(e){
       e.preventDefault();
       var agreement = {};

       agreement.idEstada = $("#idEstada").val();
       agreement.idAssUAB = $("#subjectsModal").find("#newRowAssUAB option:selected").attr("id");
       agreement.nomAssUAB = $("#subjectsModal").find("#newRowAssUAB option:selected").val();
       agreement.nomAssExt = $("#subjectsModal").find("#newRowNomAssExt").val();
       agreement.credits = $("#subjectsModal").find("#newRowCredits").val();
       agreement.idAssExt = $("#subjectsModal").find("#newRowCodiAssExt").val();
       agreement.linkAssExt = $("#subjectsModal").find("#newRowEnllaçAssExt").val();

       $("#subjectsModal").find("#newRowTr").remove();
       $("#subjectsModal").find("#saveNewRow").remove();

       addAcord(agreement);
    }),

    $(document).on("click", "#remAcord", function(e) {
        e.preventDefault();

        if(confirm('Realment vols eliminar aquest acord?')){
            var data = [];
            var id = $(this).closest('tr').attr("id");

            data.push({"id":id});
            removeAcord(data);
            $(this).closest('tr').remove();
        }else{}

        return false;
    }),

    $(".UV").click(function(e) {
        e.preventDefault(), getUniversitiesBackend(function() {
            $.fn.dataTable.ext.errMode = "none", $("#tableUV").DataTable({
                sPaginationType: "full_numbers",
                dom: "Bfrtip",
                select: "single",
                responsive: !0,
                altEditor: !0,
                buttons: []
            }), $(".selectpicker").selectpicker()
        })
    }), $(".ES").click(function(e) {
        e.preventDefault(), $.fn.dataTable.ext.errMode = "none", getStudentsBackend(function() {
            $("#tableES").DataTable({
                sPaginationType: "full_numbers",
                dom: "Bfrtip",
                select: "single",
                responsive: !0,
                altEditor: !0,
                buttons: [{
                    text: "Afegir",
                    name: "add"
                }, {
                    extend: "selected",
                    text: "Editar",
                    name: "edit"
                }, {
                    extend: "selected",
                    text: "Borrar",
                    name: "delete"
                }]
            })
        })
    }), $(".MO").click(function(e) {
        e.preventDefault(), $.fn.dataTable.ext.errMode = "none", getProgramsBackend(function() {
            $("#tableMO").DataTable({
                sPaginationType: "full_numbers",
                dom: "Bfrtip",
                select: "single",
                responsive: !0,
                altEditor: !0,
                columnDefs: [{
                    targets: [0],
                    className: "control",
                    orderable: !1
                }],
                buttons: [{
                    text: "Afegir",
                    name: "add"
                }, {
                    extend: "selected",
                    text: "Editar",
                    name: "edit"
                }, {
                    extend: "selected",
                    text: "Borrar",
                    name: "delete"
                }]
            })
        })
    }), $(".UE").click(function(e) {
        e.preventDefault(), getUniversitiesAndDegreesBackend(function() {
            $("#myTable").pageMe({
                pagerSelector: "#myPager",
                showPrevNext: !0,
                hidePageNumbers: !1,
                perPage: 7
            }), $(".selectpicker").selectpicker()
        })
    }), $(".UP").click(function(e) {
        e.preventDefault(), getUniversitiesPlacesBackend(function() {
            $("#myTable").pageMe({
                pagerSelector: "#myPager",
                showPrevNext: !0,
                hidePageNumbers: !1,
                perPage: 7
            }), $(".selectpicker").selectpicker()
        })
    }), $(".CO").click(function(e) {
        e.preventDefault(), getConvenis(function() {
            $("#myTable").pageMe({
                pagerSelector: "#myPager",
                showPrevNext: !0,
                hidePageNumbers: !1,
                perPage: 7
            }), $(".selectpicker").selectpicker()
        })
    }), $(".ST").click(function(e) {
        e.preventDefault(), getEstades(function() {
            $("#myTable").pageMe({
                pagerSelector: "#myPager",
                showPrevNext: !0,
                hidePageNumbers: !1,
                perPage: 7
            }), $(".selectpicker").selectpicker()
        })
    }), $(".AE").click(function(e) {
        e.preventDefault(), getAcordsEstudis(function() {
            $("#myTable").pageMe({
                pagerSelector: "#myPager",
                showPrevNext: !0,
                hidePageNumbers: !1,
                perPage: 7
            }), $(".selectpicker").selectpicker()
        })
    }), $(document).on("click", "#nou", function() {
        $("#show").show()
    }), $(document).on("click", "#editar", function() {
        $("#show").show()
    }), $(document).on("click", "#editRowBtn", function() {
        var e, a, t = $(".type").val();
        switch (callback = function() {}, t) {
            case "student":
                e = {
                    niu: $("input[name=Niu]").val(),
                    nom: $("input[name=Nom]").val(),
                    cognom: $("input[name=Cognom]").val(),
                    correu: $("input[name=Correu]").val(),
                    nompublic: $("input[name='Nom pùblic']").val(),
                    correupublic: $("input[name='Correu pùblic']").val(),
                    ad: 0
                }, a = "addOrupdateInfoStudent";
                break;
            case "university":
                e = {
                    id: $("input[name=id]").val(),
                    nom: $("input[name=Nom]").val(),
                    pais: $("input[name=País]").val(),
                    "adreça": $("input[name=Adreça]").val(),
                    url: $("input[name='URL Universitat']").val(),
                    urlIn: $("input[name='URL Intercanvis']").val(),
                    codi: $("input[name='Codi Universitat']").val(),
                    latitud: $("input[name='Latitud']").val(),
                    longitud: $("input[name='Longitud']").val(),
                    acreditacio: $("input[name='Acreditació idioma']").val(),
                    observacions: $("input[name='Observacions']").val(),
                    ad: 0
                }, a = "addOrupdateInfoUniversity", callback = function() {
                    getUniversitiesBackend(function() {
                        $.fn.dataTable.ext.errMode = "none", $("#tableUV").DataTable({
                            sPaginationType: "full_numbers",
                            dom: "Bfrtip",
                            select: "single",
                            responsive: !0,
                            altEditor: !0,
                            buttons: [{
                                text: "Afegir",
                                name: "add"
                            }, {
                                extend: "selected",
                                text: "Editar",
                                name: "edit"
                            }, {
                                extend: "selected",
                                text: "Borrar",
                                name: "delete"
                            }]
                        }), $(".selectpicker").selectpicker()
                    })
                }, console.log(e);
                break;
            case "program":
                e = {
                    codi: $("input[name=Codi]").val(),
                    nom: $("input[name=Nom]").val(),
                    descripcio: $("input[name=Descripció]").val(),
                    ad: 0
                }, a = "addOrupdateInfoProgram";
                break;
            case "UniStudy":
                e = {
                    codiUniGrau: $("#idtot").val(),
                    codiUni: $("#dropuni").val(),
                    codiGrau: $("#dropgrau").val(),
                    ad: 0
                }, a = "addOrupdateInfoUniDegree", callback = function() {
                    getUniversitiesAndDegreesBackend(function() {
                        $("#myTable").pageMe({
                            pagerSelector: "#myPager",
                            showPrevNext: !0,
                            hidePageNumbers: !1,
                            perPage: 7
                        }), $(".selectpicker").selectpicker()
                    })
                };
                break;
            case "UniPlace":
                e = {
                    id: $("#idtot").val(),
                    places: $("#places").val(),
                    mesos: $("#mesos").val(),
                    periode: $("#periode").val(),
                    professor: $("#teacher").val(),
                    actiu: $("input[name='actiu']:checked").val(),
                    ad: 0
                }, a = "addOrupdateInfoUniPlaces", callback = function() {
                    getUniversitiesPlacesBackend(function() {
                        $("#myTable").pageMe({
                            pagerSelector: "#myPager",
                            showPrevNext: !0,
                            hidePageNumbers: !1,
                            perPage: 7
                        }), $(".selectpicker").selectpicker()
                    })
                };
                break;
            case "Conveni":
                e = {
                    id: $("#idtot").val(),
                    codiConveni: $("#conveni").val(),
                    ad: 0
                }, a = "addOrupdateInfoConvenis", callback = function() {
                    getConvenis(function() {
                        $("#myTable").pageMe({
                            pagerSelector: "#myPager",
                            showPrevNext: !0,
                            hidePageNumbers: !1,
                            perPage: 7
                        }), $(".selectpicker").selectpicker()
                    })
                };
                break;
            case "Estada":
                e = {
                    id: $("#idtot").val(),
                    niu: $("#niu").val(),
                    codiConveni: $("#dropuni").val(),
                    curs: $("#curs").val(),
                    semestre: $("#semestre").val(),
                    ad: 0
                }, a = "addOrupdateInfoEstades", callback = function() {
                    getEstades(function() {
                        $("#myTable").pageMe({
                            pagerSelector: "#myPager",
                            showPrevNext: !0,
                            hidePageNumbers: !1,
                            perPage: 7
                        }), $(".selectpicker").selectpicker()
                    })
                };
                break;
            case "Acord":
                e = {
                    id: $("#idtot").val(),
                    estada: $("#dropestada").val(),
                    nomDesti: $("#nomDesti").val(),
                    codiDesti: $("#codiDesti").val(),
                    creditsDesti: $("#creditsDesti").val(),
                    assignatura: $("#dropuni").val(),
                    linkDesti: $("#linkDesti").val(),
                    ad: 0
                }, a = "addOrupdateInfoAcord", callback = function() {
                    getAcordsEstudis(function() {
                        $("#myTable").pageMe({
                            pagerSelector: "#myPager",
                            showPrevNext: !0,
                            hidePageNumbers: !1,
                            perPage: 7
                        }), $(".selectpicker").selectpicker()
                    })
                };
                break;
            default:
                console.log("default")
        }
        $.ajax({
            type: "POST",
            url: "admin.php/" + a,
            data: e,
            dataType: "json",
            encode: !0,
            success: function(e, a, t) {
                callback()
            },
            error: function(e, a, t) {
                console.log("error")
            }
        })
    }), $(document).on("click", "#addRowBtn", function() {
        var e, a, t = function() {};
        switch ($(".type").val()) {
            case "student":
                e = {
                    niu: $("input[name=Niu]").val(),
                    nom: $("input[name=Nom]").val(),
                    cognom: $("input[name=Cognom]").val(),
                    correu: $("input[name=Correu]").val(),
                    nompublic: $("input[name='Nom pùblic']").val(),
                    correupublic: $("input[name='Correu pùblic']").val(),
                    ad: 1
                }, a = "addOrupdateInfoStudent";
                break;
            case "university":
                e = {
                    id: $("input[name=id]").val(),
                    nom: $("input[name=Nom]").val(),
                    pais: $("input[name=País]").val(),
                    "adreça": $("input[name=Adreça]").val(),
                    url: $("input[name='URL Universitat']").val(),
                    urlIn: $("input[name='URL Intercanvis']").val(),
                    codi: $("input[name='Codi Universitat']").val(),
                    latitud: $("input[name='Latitud']").val(),
                    longitud: $("input[name='Longitud']").val(),
                    acreditacio: $("input[name='Acreditació idioma']").val(),
                    observacions: $("input[name='Observacions']").val(),
                    ad: 1
                }, a = "addOrupdateInfoUniversity", t = function() {
                    getUniversitiesBackend(function() {
                        $.fn.dataTable.ext.errMode = "none", $("#tableUV").DataTable({
                            sPaginationType: "full_numbers",
                            dom: "Bfrtip",
                            select: "single",
                            responsive: !0,
                            altEditor: !0,
                            buttons: [{
                                text: "Afegir",
                                name: "add"
                            }, {
                                extend: "selected",
                                text: "Editar",
                                name: "edit"
                            }, {
                                extend: "selected",
                                text: "Borrar",
                                name: "delete"
                            }]
                        }), $(".selectpicker").selectpicker()
                    })
                };
                break;
            case "program":
                e = {
                    codi: $("input[name=Codi]").val(),
                    nom: $("input[name=Nom]").val(),
                    descripcio: $("input[name=Descripció]").val(),
                    ad: 1
                }, a = "addOrupdateInfoProgram";
                break;
            case "UniStudy":
                e = {
                    codiUni: $("#dropuni").val(),
                    codiGrau: $("#dropgrau").val(),
                    ad: 1
                }, a = "addOrupdateInfoUniDegree", t = function() {
                    getUniversitiesAndDegreesBackend(function() {
                        $("#myTable").pageMe({
                            pagerSelector: "#myPager",
                            showPrevNext: !0,
                            hidePageNumbers: !1,
                            perPage: 7
                        }), $(".selectpicker").selectpicker()
                    })
                };
                break;
            case "UniPlace":
                e = {
                    id: $("#dropuni").val(),
                    places: $("#places").val(),
                    mesos: $("#mesos").val(),
                    periode: $("#periode").val(),
                    professor: $("#teacher").val(),
                    actiu: $("input[name='actiu']").val(),
                    ad: 1
                }, a = "addOrupdateInfoUniPlaces", t = function() {
                    getUniversitiesPlacesBackend(function() {
                        $("#myTable").pageMe({
                            pagerSelector: "#myPager",
                            showPrevNext: !0,
                            hidePageNumbers: !1,
                            perPage: 7
                        }), $(".selectpicker").selectpicker()
                    })
                }, console.log(e);
                break;
            case "Conveni":
                e = {
                    id: $("#dropuni").val(),
                    codiConveni: $("#conveni").val(),
                    ad: 1
                }, a = "addOrupdateInfoConvenis", t = function() {
                    getConvenis(function() {
                        $("#myTable").pageMe({
                            pagerSelector: "#myPager",
                            showPrevNext: !0,
                            hidePageNumbers: !1,
                            perPage: 7
                        }), $(".selectpicker").selectpicker()
                    })
                };
                break;
            case "Estada":
                e = {
                    niu: $("#niu").val(),
                    codiConveni: $("#dropuni").val(),
                    curs: $("#curs").val(),
                    semestre: $("#semestre").val(),
                    ad: 1
                }, a = "addOrupdateInfoEstades", t = function() {
                    getEstades(function() {
                        $("#myTable").pageMe({
                            pagerSelector: "#myPager",
                            showPrevNext: !0,
                            hidePageNumbers: !1,
                            perPage: 7
                        }), $(".selectpicker").selectpicker()
                    })
                };
                break;
            case "Acord":
                e = {
                    id: $("#idtot").val(),
                    estada: $("#dropestada").val(),
                    nomDesti: $("#nomDesti").val(),
                    codiDesti: $("#codiDesti").val(),
                    creditsDesti: $("#creditsDesti").val(),
                    assignatura: $("#dropuni").val(),
                    linkDesti: $("#linkDesti").val(),
                    ad: 1
                }, a = "addOrupdateInfoAcord", t = function() {
                    getAcordsEstudis(function() {
                        $("#myTable").pageMe({
                            pagerSelector: "#myPager",
                            showPrevNext: !0,
                            hidePageNumbers: !1,
                            perPage: 7
                        }), $(".selectpicker").selectpicker()
                    })
                };
                break;
            default:
                console.log("default")
        }
        $.ajax({
            type: "POST",
            url: "admin.php/" + a,
            data: e,
            dataType: "json",
            encode: !0,
            success: function(e, a, n) {
                t(), "KO" == e.msg && $("#debug").append('<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error</strong> <i class="fa fa-exclamation"></i>  ' + e.error + "</div>")
            },
            error: function(e, a, t) {}
        })
    }), $(document).on("click", "#deleteRowBtn", function() {
        var e, a;
        switch ($(".type").val()) {
            case "student":
                e = {
                    niu: $("input[name=Niu]").val()
                }, a = "deleteStudent";
                break;
            case "university":
                e = {
                    id: $("input[name=id]").val()
                }, a = "deleteUniversity";
                break;
            case "program":
                e = {
                    codi: $("input[name=Codi]").val()
                }, a = "deleteProgram";
                break;
            case "UniStudy":
                e = {
                    codiUniGrau: $(this).attr("at")
                }, a = "deleteInfoUniDegree", callback = function() {
                    getUniversitiesAndDegreesBackend(function() {
                        $("#myTable").pageMe({
                            pagerSelector: "#myPager",
                            showPrevNext: !0,
                            hidePageNumbers: !1,
                            perPage: 7
                        }), $(".selectpicker").selectpicker()
                    })
                };
                break;
            case "UniPlace":
                e = {
                    id: $(this).attr("at")
                }, a = "deleteInfoUniPlaces", callback = function() {
                    getUniversitiesPlacesBackend(function() {
                        $("#myTable").pageMe({
                            pagerSelector: "#myPager",
                            showPrevNext: !0,
                            hidePageNumbers: !1,
                            perPage: 7
                        }), $(".selectpicker").selectpicker()
                    })
                };
                break;
            case "Conveni":
                e = {
                    id: $(this).attr("at")
                }, a = "deleteConveni", callback = function() {
                    getConvenis(function() {
                        $("#myTable").pageMe({
                            pagerSelector: "#myPager",
                            showPrevNext: !0,
                            hidePageNumbers: !1,
                            perPage: 7
                        }), $(".selectpicker").selectpicker()
                    })
                };
                break;
            case "Estada":
                e = {
                    id: $(this).attr("at")
                }, a = "deleteStay", callback = function() {
                    getEstades(function() {
                        $("#myTable").pageMe({
                            pagerSelector: "#myPager",
                            showPrevNext: !0,
                            hidePageNumbers: !1,
                            perPage: 7
                        }), $(".selectpicker").selectpicker()
                    })
                };
                break;
            case "Acord":
                e = {
                    id: $(this).attr("at")
                }, a = "deleteAcord", callback = function() {
                    getAcordsEstudis(function() {
                        $("#myTable").pageMe({
                            pagerSelector: "#myPager",
                            showPrevNext: !0,
                            hidePageNumbers: !1,
                            perPage: 7
                        }), $(".selectpicker").selectpicker()
                    })
                };
                break;
            default:
                console.log("default")
        }
        $.ajax({
            type: "POST",
            url: "admin.php/" + a,
            data: e,
            dataType: "json",
            encode: !0,
            success: function(e, a, t) {
                callback()
            },
            error: function(e, a, t) {}
        })
    }), $(document).on("submit", "#formall", function() {
        return !1
    }), $(document).on("click", "#nou", function() {
        $(".btn.btn-info").val("Afegir"), $(".btn.btn-info").attr("id", "addRowBtn")
    }), $(document).on("click", "#editar", function() {
        var e = Array(),
            a = $(this).attr("at");
        $("input#idtot").attr("value", a), $(".btn.btn-info").val("Desar"), $(".btn.btn-info").attr("id", "editRowBtn");
        var t = $(this).closest("tr").find("td");
        switch ($.each(t, function() {
            e.push($(this).text())
        }), $(".type").val()) {
            case "UniStudy":
                $("select[name=university]").val(e[3]), $("select[name=degree]").val(e[4]), $(".selectpicker").selectpicker("refresh");
                break;
            case "UniPlace":
                $("#dropunidiv").hide(), $("#unigdiv").show(), $("input#unig").attr("value", e[1]), $("input#places").attr("value", e[2]), $("input#mesos").attr("value", e[3]), $("input#periode").attr("value", e[4]), "Sí" == e[6] ? ($("input[value='Sí']").attr("checked", !0), $("input[value='No']").attr("checked", !1)) : $("input[value='No']").attr("checked", !0);
                break;
            case "Conveni":
                $("#dropunidiv").hide(), $("input#conveni").attr("value", e[1]), $("#selected").show();
                break;
            case "Estada":
                $("input#niu").attr("value", e[2]), $("input#curs").attr("value", e[4]), $("input#semestre").attr("value", e[5]), $("select[name=idconveni]").val(e[3]), $(".selectpicker").selectpicker("refresh");
                break;
            case "Acord":
                $("select[name=estada]").val(e[1]), $("select[name=assignatura]").val(e[8]), $(".selectpicker").selectpicker("refresh"), $("input#nomDesti").attr("value", e[3]), $("input#linkDesti").attr("value", e[4]), $("input#nomDesti").attr("value", e[3]), $("input#codiDesti").attr("value", e[5]), $("input#creditsDesti").attr("value", e[6])
        }
    }), $(document).on("click", "#nouphoto", function() {
        $("#show").show()
    }), $(document).on("click", "#uploadphoto", function(e) {

        var formData = new FormData;
        formData.append("file", $("#photoFile").prop("files")[0]);
        formData.append("university", $("#idUni").val());

        $.ajax({
            type: "POST",
            url: "admin.php/updatePhoto",
            data: formData,
            contentType: !1,
            cache: !1,
            processData: !1,
            success:function(t,e,c){
                alert("Foto pujada correctament!");
                $("#show").hide();
            }
        });

        e.preventDefault();
    }), $(document).on("click", "input[type=reset]", function() {
        $("#show").hide()
    }), $(document).on("keyup", "#myInput", function() {
        var e = $("#myTable tr"),
            a = $.trim($(this).val()).replace(/ +/g, " ").toLowerCase();
        e.show().filter(function() {
            return !~$(this).text().replace(/\s+/g, " ").toLowerCase().indexOf(a)
        }).hide()
    })



        , $(document).on("click",".sortTables", function(e){
        e.preventDefault();
        var table = $(this).parents('#FullTable').eq(0);
        var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()));
        this.asc = !this.asc;
        if (!this.asc){rows = rows.reverse()}
        for (var i = 0; i < rows.length; i++){table.append(rows[i])}
    })
    , $(document).on("submit", "#formCountry", function(e) {
       e.preventDefault();
        var formData = new FormData;
        formData.append("programaPais", $("#programaPais").val());
        formData.append("nomPais", $("#nomPais").val());

        $.ajax({
            type: "POST",
            url: "admin.php/addTableCountries",
            data: formData,
            processData: false,
            contentType: false,
            success:function(t,e,c){
                alert("Pais creat correctament!");
                $("#addPaisModal").modal('hide');

            },
            error: function(e, a, t) {alert("Error al crear el pais!");}
        });
    }), $(document).on("submit", "#formSubjects", function(e) {
        e.preventDefault();
        var formData = new FormData;
        formData.append("codiSubject", parseInt($("#codiSubject").val()));
        formData.append("nom", $("#nomSubject").val());
        formData.append("credits", parseInt($("#creditsSubject").val()));
        formData.append("url", $("#urlSubject").val());
        formData.append("codiEstudis", parseInt($("#codiEstudisSubject").children(":selected").attr("id")));

        $.ajax({
            type: "POST",
            url: "admin.php/addTableSubjects",
            data: formData,
            processData: false,
            contentType: false,
            success:function(t,e,c){
                alert("Assignatura creada correctament!");
                $("#addSubjectModal").modal('hide');

            },
            error: function(e, a, t) {alert("Error al crear l'assignatura!");}
        });
    }), $(document).on("submit", "#formDegrees", function(e) {
        e.preventDefault();
        var formData = new FormData;
        formData.append("nom", $("#nomGrau").val());
        formData.append("cicle", $("#cicleGrau").val());
        formData.append("descripcio", $("#descripcioGrau").val());

        $.ajax({
            type: "POST",
            url: "admin.php/addTableDegrees",
            data: formData,
            processData: false,
            contentType: false,
            success:function(t,e,c){
                alert("Grau creat correctament!");
                $("#addDegreeModal").modal('hide');

            },
            error: function(e, a, t) {alert("Error al crear el grau!");}
        });
    }), $(document).on("submit", "#formTeachers", function(e) {
        e.preventDefault();
        var formData = new FormData;
        formData.append("niu", parseInt($("#niu").val()));
        formData.append("nom", $("#nomProfessor").val());
        formData.append("cognoms", $("#cognomsProfessor").val());
        formData.append("correu", $("#correuProfessor").val());
        formData.append("codiEstudis", parseInt($("#codiEstudisProfessor").children(":selected").attr("id")));
        $.ajax({
            type: "POST",
            url: "admin.php/addTableTeachers",
            data: formData,
            processData: false,
            contentType: false,
            success:function(t,e,c){
                alert("Professor/a creat/da correctament!");
                $("#addTeacherModal").modal('hide');

            },
            error: function(e, a, t) {alert("Error al crear el/la professor/a!");}
        });

    }), $(document).on("submit", "#formAdmins", function(e) {
        e.preventDefault();
        var formData = new FormData;
        formData.append("niuAdmin", parseInt($("#teacherAdmin").children(":selected").attr("id")));
        formData.append("nomAdmin", $("#teacherAdmin").children(":selected").val());
        $.ajax({
            type: "POST",
            url: "admin.php/addTableAdmins",
            data: formData,
            processData: false,
            contentType: false,
            success:function(t,e,c){
                alert("Admin creat correctament!");
                $("#addAdminModal").modal('hide');

            },
            error: function(e, a, t) {alert("Error al crear l'admin!");}
        });
    })
        ,$(document).on("click", "#remCountry", function(e) {
        e.preventDefault();

        if(confirm('Realment vols eliminar aquest pais?')){
            var data = [];
            var id = $(this).closest('tr').attr("id");

            data.push({"id":id});
            removeTableCountries(data);
            $(this).closest('tr').remove();
        }else{}

        return false;
    })
        ,$(document).on("click", "#remSubject", function(e) {
        e.preventDefault();

        if(confirm('Realment vols eliminar aquesta assignatura?')){
            var data = [];
            var id = $(this).closest('tr').attr("id");

            data.push({"id":id});
            removeTableSubjects(data);
            $(this).closest('tr').remove();
        }else{}

        return false;
    })
        ,$(document).on("click", "#remDegree", function(e) {
        e.preventDefault();

        if(confirm('Realment vols eliminar aquest grau?')){
            var data = [];
            var id = $(this).closest('tr').attr("id");

            data.push({"id":id});
            removeTableDegree(data);
            $(this).closest('tr').remove();
        }else{}

        return false;
    })
        ,$(document).on("click", "#remTeacher", function(e) {
        e.preventDefault();

        if(confirm('Realment vols eliminar aquest/a professor/a?')){
            var data = [];
            var id = $(this).closest('tr').attr("id");

            data.push({"id":id});
            removeTableTeachers(data);
            $(this).closest('tr').remove();
        }else{}

        return false;
    })
        ,$(document).on("click", "#remAdmin", function(e) {
        e.preventDefault();

        if(confirm('Realment vols eliminar aquest admin?')){
            var data = [];
            var id = $(this).closest('tr').attr("id");

            data.push({"id":id});
            removeTableAdmins(data);
            $(this).closest('tr').remove();
        }else{}

        return false;
    })
        , $(document).on("click", "#submitCountriesTable", (function(e){
            e.preventDefault();
            var data = [];
            $('#countriesBodyTable > tr > td > input').each(function(e){
                data.push({"id":parseInt($(this).attr("id")),"pais":$(this).val()});
            });

            updateTableCountries(data);
        }))
        , $(document).on("click", "#submitSubjectsTable", (function(e){

        e.preventDefault();
        var data = [];
        var id = -1;
        var title = "";
        var url = "";
        var i = 0;

        $('#subjectsBodyTable> tr').each(function(e){
            i = 0;
            id = $(this).attr("id");
            $(this).find('td > input').each(function (e) {
                if (i == 0){
                    title = $(this).val();
                    i = 1;
                }else{
                    url = $(this).val();
                }

            });
            data.push({"id":id,"nom":title,"url":url});
        });

        updateTableSubjects(data);
    }))
        , $(document).on("click", "#submitDegreesTable", (function(e){
        e.preventDefault();
        var data = [];
        $('#degreesBodyTable > tr > td > input').each(function(e){
            data.push({"id":parseInt($(this).attr("id")),"grau":$(this).val()});
        });

        updateTableDegrees(data);
    }))
        , $(document).on("click", "#submitTeachersTable", (function(e){
        e.preventDefault();
        var data = [];
        $('#teachersBodyTable > tr > td > input').each(function(e){
            data.push({"id":parseInt($(this).attr("id")),"professor":$(this).val()});
        });

        updateTableTeachers(data);
    }))
        , $(document).on("click", "#cargar", (function(e){
        e.preventDefault();
        getAuxTablesBackend();
    }))
        ,$(document).on("click", "#remURL", function(e) {
        e.preventDefault();

        if(confirm('Realment vols eliminar aquest camp?')){
            var data = [];
            var id = $(this).closest('tr').attr("id");

            data.push({"id":id});
            removefailURL(data);
            $(this).closest('tr').remove();
        }else{}

        return false;
    })
});