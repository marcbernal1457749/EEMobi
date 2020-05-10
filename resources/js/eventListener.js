$(document).ready(function() {
    $(document).on("change", "#selectCountry", function(e) {
        e.preventDefault();
        var t = $(this).val();
        -1 != t && (getDegreesByCountry(t), getUniversitiesByIdCountry(t))
    })

        , $(document).on("change", "#selectDegree", function(e) {
        e.preventDefault();
        var t = $("#selectCountry").val(),
            n = $("#selectProgram").val();
        a = $(this).val(), -1 == t && -1 == n ? getUniversitiesByIdDegree(a) : -1 != t ? getUniversitiesByIdDC(t, a) : getUniversitiesByProgramAndDegree(n, a)
    })

        , $(document).on("change", "#selectProgram", function(e) {
        e.preventDefault();
        var t = $(this).val();
        -1 != t && (getCountrysByProgram(t), getUniversitiesByIdProgram(t))
    })

        , $(document).on("change", "#selectSubject", function(e) {
        e.preventDefault();
        var t = $(this).val();
        -1 != t && (getUniversitiesByIdSubject(t));
    })

        , $(document).on("change", "#selectSubjectsDegree", function(e){
        e.preventDefault();
        var t = $(this).val();
        -1 != t && (getSubjectsByDegree(t));
    })

        ,$(document).on("change", "#selectIfAdmin", function(e){
            e.preventDefault();

            var data = {};
            data.niu = $("#niuProfessor").val();
            data.filtre = $(this).val();

            filtrarAcordsAdmin(data);
    })

        , $(document).on("click", "#addSubject", function(e) {

            $("#defaultrow").remove();
            var id = $("#subjectSelector").val();
            var opt = $("#subjectSelector option:selected").text();
            var bodyTable = $("#subjectBodyTable");

            if(id != -1) {
                bodyTable.append("<tr><td><button id='remSubject' type='button' class='text close' aria-label='Close'>" +
                    "<span aria-hidden='true'>&times;</span>" +
                    "</button><p id='"+id+"'>"+opt+"</p></td></tr>");
            }

            return false;
    })

        , $(document).on("click", "#remSubject", function(e){
            e.preventDefault();
            $(this).closest('tr').remove();

            return;
    })

        , $(document).on("click", "#searchDestinationBySubjects", function(e){
        e.preventDefault();
        var subjectIDs = '{"search":';
        subjectIDs = subjectIDs.concat('"'+ $("#logicOperator option:selected").text()+ '","program":"'+
            $("#selectDegreesProgram option:selected").val()+ '","ids":[');

        $('#subjectBodyTable > tr > td > p').each( function(e){
            subjectIDs = subjectIDs.concat('"'+ $(this).attr('id')+ '",');
        });

        if(subjectIDs.substring(subjectIDs.length - 1, subjectIDs.length)==","){
            subjectIDs = subjectIDs.substring(0, subjectIDs.length - 1);
        }

        subjectIDs = subjectIDs.concat(']}');

        console.log(subjectIDs);
        var dataToSend = JSON.parse(subjectIDs);
        dataToSend = JSON.stringify(dataToSend);


        $.ajax({
            url: "controllers/DestinacionsTaulaController.php",
            data: {'dataSent' : dataToSend},
            type: 'POST',
            success : function (data){
                $('#destinationsTable').empty();
                $('#destinationsTable').html((data));
            },
            complete: function (xhr, status) {
                $('#destinationsTable').slideDown('slow');
            }
        });
    })

        , $(document).on("click",".sortTables", function(e){
            e.preventDefault();
            var table = $(this).parents('#FullTable').eq(0);
            var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()));
            console.log(rows);
            this.asc = !this.asc;
            if (!this.asc){rows = rows.reverse()}
            for (var i = 0; i < rows.length; i++){table.append(rows[i])}
    })

        , $(".nav-scroll").find("a").click(function() {
        var e = $(this).attr("href");
            t = $(e).offset();
        return window.scrollTo(t.left, t.top), !1
    })

        , $(document).on("mouseover", ".button-custom", function(e) {
        e.preventDefault();
        var t = $("#selectDegree").val();
            a = $("option[value='" + t + "']").text();
        a = a.replace(/ /g, "-"), -1 == t ? $("#degreeselect").val("Tots-els-graus") : $("#degreeselect").val(a)
    })

        , $(document).on("click", ".btn-o", function(e) {
        e.preventDefault(), editProfile()
    })

        , $(document).on("click", "#firstRatingsButton", function(e){
            e.preventDefault();

            var stayCode = {};
            stayCode.id = $("#stayIdButton").val();
            stayCode.idUni = $("#uniIdButton").val();

            firstRatings(stayCode);
        })

        , $(document).on("click", ".btn-person", function(e) {
        if ($("#debug .alert").remove(), $("#formulari")[0].checkValidity()) {
            var t = {
                name: $("input[name=nom]").val(),
                surname: $("input[name=cognom]").val(),
                mail: $("input[name=correu]").val(),
                nompublic: $("input[name=opcioNom]:checked").val(),
                correupublic: $("input[name=opcioCorreu]:checked").val()
            };
            $.ajax({
                type: "POST",
                url: "/EEmobi/perfil.php/updateInfo",
                data: t,
                dataType: "json",
                encode: !0
            }).done(
                function(e) {
                    e.answer ? window.location.replace("http://deic-projectes.uab.cat/EEmobi/Perfil") : $("#debug").append('<div class="alert alert-danger col-md-8"><i class="fa fa-exclamation"></i>    <strong>Error</strong> en els camps del formulari.</div>')
                })
        } else $("#debug").append('<div class="alert alert-danger col-md-8"><strong>Error</strong> <i class="fa fa-exclamation"></i>  Camps del formulari incorrectes.</div>');
        e.preventDefault()
    }), $(document).on("change", "input:file", function() {
        $(this).val() && $("input:submit").attr("disabled", !1)
    }), $(document).on("submit", "#fileUpload", function(e) {
        $("#debugimg .alert").remove(), $.ajax({
            url: "/EEmobi/perfil.php/updatePhoto",
            type: "POST",
            data: new FormData(this),
            contentType: !1,
            cache: !1,
            dataType: "json",
            processData: !1
        }).done(function(e) {
            if (e.succes) {
                $(".avatar").attr("src", " "), $("#debugimg").append('<div class="alert alert-success">' + e.msg + "</div>");
                var t = e.src;
                $(".avatar").attr("src", t)
            } else $("#debugimg").append('<div class="alert alert-danger"><strong>Error</strong> <i class="fa fa-exclamation"></i>  ' + e.msg + "</div>")
        }), e.preventDefault()
    }), $(document).on("click", "#myBtn", function() {
        document.body.scrollTop = 0, document.documentElement.scrollTop = 0
    }), $(document).on("click", "#floating-button", function() {
        getUniversitiesByUser($("#uniEstanciaAlumne").val());
    }), $(document).on("click", "#publicarp", function() {
        getUniversitiesByUser($(this).attr("at")), $("#myModal").modal("toggle")

    }), $(document).on("click", "#opinarsubject", function() {
        var data = [];

        var cadena = $(this).attr("at");
        var codiAcord = cadena.split(',')[0];
        var codiAsignaturaDesti = cadena.split(',')[1];


        console.log(codiAcord,codiAsignaturaDesti);

        data.push({"codiAcord":codiAcord,"codiAsignaturaDesti":codiAsignaturaDesti});

        getSubjectsByUser(data), $("#myModal").modal("toggle")

    }), $(document).on("click", "#acordp", function() {
        getAcordsById($(this).attr("at")), $("#myModal").modal("toggle")

    }), $(document).on("click", "#assignaturesp", function() {
        getSubjectsByAcord($(this).attr("at")), $("#myModal").modal("toggle")

    }), $(document).on("click", "#crearAcord", function() {
        $("#debugimg .alert").remove(), $.ajax({
            url: "/EEmobi/perfil.php/addAgreement",
            type: "POST",
            data: $("#formAcord").serialize(),
            cache: !1,
            dataType: "json",
            processData: !1
        }).done(function(e) {
            e.succes ? ($("#myModal").modal("toggle"), $("#debug").append('<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + e.msg + "</div>")) : $("#debugimg").append('<div class="alert alert-danger">' + e.msg + "</div>")
        }), console.log($("#formAcord").serialize())
    }), $(document).on("click", "#deletePubli", function() {
        alert("Segur que vols eliminar aquesta publicació?");
        var e = new FormData;
        e.append("idToDelete", $(this).attr("at")), $.ajax({
            type: "POST",
            url: "perfil.php/deletePublication",
            data: e,
            contentType: !1,
            cache: !1,
            dataType: "json",
            processData: !1
        }).done(function(e) {
            e.succes ? window.location.replace("http://deic-projectes.uab.cat/EEmobi/Perfil") : alert("Error al borrar la publicació")
        })
    }), $(document).on("click", "#deletePubliSub", function() {

        alert("Segur que vols eliminar aquesta publicació?");
        var e = new FormData;
        e.append("idToDelete", $(this).attr("at")), $.ajax({
            type: "POST",
            url: "perfil.php/deletePublicationSubject",
            data: e,
            contentType: !1,
            cache: !1,
            dataType: "json",
            processData: !1
        }).done(function(e) {
            e.succes ? window.location.replace("http://deic-projectes.uab.cat/EEmobi/Perfil") : alert("Error al borrar la publicació")
        })
    }), $(document).on("keyup", "#text-publi", function() {
        var e = $("#text-publi").val().length;
        if (e >= 500) $("#emailHelp").text("Has arribat al limit");
        else {
            var t = 500 - e;
            $("#emailHelp").text(t + " caràcters restants")
        }
    }), $(document).on("click", "#publicar", function(e) {
        $("#debugimg .alert").remove(), e.preventDefault();
        var t = new FormData;
        t.append("file", $("input[type=file]")[0].files[0]);
        t.append("text", $("#text-publi").val());
        t.append("idUni", $("#idUniversitat").val());
        t.append("idCat", $("#categoriaPublicacio").val());

        $.ajax({
            type: "POST",
            url: "perfil.php/addPublication",
            data: t,
            contentType: !1,
            cache: !1,
            dataType: "json",
            processData: !1,
        }).done(function(e) {
            e.succes ? ($("#myModal").modal("toggle"), window.location.replace("http://deic-projectes.uab.cat/EEmobi/Perfil")) : $("#debugimg").append('<div class="alert alert-danger"><strong>Error</strong> <i class="fa fa-exclamation"></i>  ' + e.msg + "</div>");
        });

    }), $(document).on("click", "#publicarOpSubject", function(e) {
        $("#debugimg .alert").remove(), e.preventDefault();
        var t = new FormData;

        t.append("text", $("#text-publi").val());
        t.append("codiAcord", $("#codiAcord").val());
        t.append("codiAsignaturaDesti", $("#codiAsignaturaDesti").val());

        $.ajax({
            type: "POST",
            url: "perfil.php/addPublicationSubject",
            data: t,
            cache: !1,
            dataType: "json",
            processData: !1,
            contentType: !1,
            success:function(t,e,c){
                $("#myModal").modal("toggle");
                window.location.replace("http://deic-projectes.uab.cat/EEmobi/Perfil");
            },
            error:function(e,a,t){
                $("#debugimg").append('<div class="alert alert-danger"><strong>Error</strong> <i class="fa fa-exclamation"></i>  ' + e.msg + "</div>");
            }
        })
    })
        , $(document).on("click", "#publicarTeacherOpSubject", function(e) {
        $("#debugimg .alert").remove(), e.preventDefault();
        var t = new FormData;

        var cadena = $("#codiAsignatura").children("option:selected").attr("id");
        var codiAcord = cadena.split(',')[1];
        var codiAsignaturaDesti = cadena.split(',')[0];

        t.append("text", $("#text-publi").val());
        t.append("codiAcord", codiAcord);
        t.append("codiAsignaturaDesti", codiAsignaturaDesti);
        console.log($("#text-publi").val());
        console.log( codiAcord);
        console.log( codiAsignaturaDesti);
        $.ajax({
            type: "POST",
            url: "perfil.php/addPublicationSubject",
            data: t,
            cache: !1,
            dataType: "json",
            processData: !1,
            contentType: !1,
            success:function(t,e,c){
                $("#myModal").modal("toggle");
                window.location.replace("http://deic-projectes.uab.cat/EEmobi/Perfil");
            },
            error:function(e,a,t){
                $("#debugimg").append('<div class="alert alert-danger"><strong>Error</strong> <i class="fa fa-exclamation"></i>  ' + e.msg + "</div>");
            }
        })
    })
        , $(document).on("click", "#advancedOptions", function(e){
        e.preventDefault();
        var sw = document.getElementById("advancedOptionsShow");
        if (sw.style.display === "block") {
            sw.style.display = "none";
        } else {
            sw.style.display = "block";
        }

    }), $(document).on("click", "#advancedOptionsAssignatures", function(e){
        e.preventDefault();
        var sw = document.getElementById("advancedOptionsSubjectShow");
        if (sw.style.display === "block") {
            sw.style.display = "none";
        } else {
            sw.style.display = "block";
        }

    })

        , $(document).on("click", "#searchDestinationAdvanced", function(e){
        e.preventDefault();
        var data = [];
        var nom = $("#searcherUni").val();
        var grau = $("#selectSubjectsDegree").children(":selected").val();
        var pais = $("#selectSubjectsCountry").children(":selected").val();


        data.push({"nom":nom,"grau":grau,"pais":pais});

        $.ajax({
            url: "controllers/ResultatsCercadorUniController.php",
            data: {'dataSent' : data},
            type: 'POST',
            success : function (data){
                $('#resultsTable').empty();
                $('#resultsTable').html((data));
            },
            complete: function (xhr, status) {
                $('#resultsTable').slideDown('slow');
            }
        });
    })
        ,$("#searcherUni").keypress(function(e) {

            var code = (e.keyCode ? e.keyCode : e.which);
            if(code==13){
                var data = $("#searcherUni").val();
                e.preventDefault();
                onEnterSearhUni(data);
            }
        })

        ,$(document).on("submit", "#searchUniForm", function(e){

        var data = $("#searcherUni").val();
        e.preventDefault();
        onEnterSearhUni(data);

    })
        ,$(document).on("click", "#deleteDestinationAdvanced", function(e){

        $("#searchUniForm")[0].reset();
        $('#selectSubjectsDegree').prop('selectedIndex',0);
        $('#selectSubjectsCountry').prop('selectedIndex',0);

    })

});
$(document).ready(function() {
    if (location.hash) {
        $("a[href='" + location.hash + "']").tab("show");
    }
    $(document.body).on("click", "a[data-toggle]", function(event) {
        location.hash = this.getAttribute("href");
    });
});
$(window).on("popstate", function() {
    var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
    $("a[href='" + anchor + "']").tab("show");
});