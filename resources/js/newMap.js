function newMap(e) {
    var n, i = [],
        a = JSON.parse(e),
        t = new google.maps.Map(document.getElementById("map"), {
            zoom: 7,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }),
        o = new google.maps.LatLngBounds,
        s = new google.maps.InfoWindow;
    for (var p in a) {
        switch (a[p].codiPrograma) {
            case "PR03":
                icon = "http://maps.google.com/mapfiles/ms/icons/green.png";
                break;
            case "ER02":
                icon = "http://maps.google.com/mapfiles/ms/icons/blue.png";
                break;
            default:
                icon = "http://maps.google.com/mapfiles/ms/icons/red.png"
        }
        n = new google.maps.Marker({
            position: new google.maps.LatLng(a[p].lat, a[p].lng),
            map: t,
            icon: new google.maps.MarkerImage(icon)
        }), i.push(n), o.extend(n.position), google.maps.event.addListener(n, "click", function(e, n) {
            return function() {
                var i = '<div id="content"><div id="siteNotice"></div><h3 id="firstHeading" class="firstHeading">' + a[n].nomUniversitat + '</h3><div id="bodyContent"><p><b>País:  </b>' + a[n].nomPais + "</p><p><b>Adreça:  </b>" + a[n].adreça + '</p><p><b>Pàgina principal:</b><a href="' + a[n].urlUniversitat + '" target="_blank" >  Click aquí</a></p> <p><b>Pàgina intercanvis:</b><a href="' + a[n].urlIntercanvis + '" target="_blank" >  Click aquí</a></p> ';
                isLogged ? i += '<form action="./information.php" method="get" target="_blank"><input type="hidden" name="id" value="' + a[n].idUniversitat + '"><input type="hidden" id="degreeselect" name="degree" value="nothing" ><button type="submit"  class="btn btn-primary btn-lg btn-block button-id button-custom" value="' + a[n].idUniversitat + '">Més Informació</button></form>' : i += '<p><a href="login/true" >Per més informació inicia sessió</a></p> ', i += "</div></div>", s.setContent(i), s.open(t, e)
            }
        }(n, p))
    }
    t.fitBounds(o)
}