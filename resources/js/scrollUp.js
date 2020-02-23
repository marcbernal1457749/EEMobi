function scrollFunction(){document.body.scrollTop>20||document.documentElement.scrollTop>20?document.getElementById("myBtn").style.display="block":document.getElementById("myBtn").style.display="none"}window.onscroll=function(){scrollFunction()},$(document).on("click","#myBtn",function(){document.body.scrollTop=0,document.documentElement.scrollTop=0}),
    $(document).on("change","#selectFilter",function(n){
        var t=$(this).val();
        if(-1!=t){
            var o=new FormData;
            o.append("idCat",$("#selectFilterCategory").val()),o.append("university",$("#idUni").val()),o.append("data",$("#selectFilter").val()),
                $.ajax({
                    type:"POST",
                    url:"/EEmobi/perfil.php/orderPublicationsByFilter",
                    data:o,
                    contentType:!1,
                    cache:!1,
                    processData:!1}).done(function(n){$(".publications").html(n)})}n.preventDefault()}),
    $(document).on("change","#selectFilterCategory",function(n){
    var t=$(this).val();

        var o=new FormData;
        o.append("idCat",$("#selectFilterCategory").val()),o.append("university",$("#idUni").val()),o.append("data",$("#selectFilter").val()),
            $.ajax({
                type:"POST",
                url:"/EEmobi/perfil.php/orderPublicationsByFilter",
                data:o,
                contentType:!1,
                cache:!1,
                processData:!1}).done(function(n){$(".publications").html(n)}), n.preventDefault()});