$(document).ready(function(){
    // Nastavi checkbox na checked
    $('#flexCheckIndeterminate').prop('checked', true);
    $('#flexCheckIndeterminate2').prop('checked', true);

    // Pridobi lat_lng prijavljenega uporabnika iz skritega polja
    var userLatLng = $('#userLatLng').val();

    // Ob preverjanju stanja checkboxa
    $('#flexCheckIndeterminate').change(function(){
        // Če je checkbox izbran
        if($(this).prop('checked')){
            // Onemogoči vnosno polje in napolni z vrednostjo uporabnikovega lat_lng
            $('#My_Grid').prop('readonly', true).val(userLatLng);
            $("#My_Grid").css("border-color", "green");
        } else {
            // Omogoči vnosno polje in pobriši vrednost
            $('#My_Grid').prop('readonly', false).val("");
            $("#My_Grid").css("border-color", "red");
        }
    });

    // Preveri stanje checkboxa
    if($('#flexCheckIndeterminate').prop('checked')){
        // Če je checkbox izbran, onemogoči spreminjanje vrednosti vnosnega polja
        $('#My_Grid').prop('readonly', true).val(userLatLng);
    } else {
        // Če checkbox ni izbran, omogoči spreminjanje vrednosti vnosnega polja
        $('#My_Grid').prop('readonly', false);
    }
});



// Get Coordinates From Username
// $("#Their_Callsign").val()
function getUserCoordinates() {
    axios.get('/spots/get-profile', {
        params: {
            name: $("#Their_Callsign").val()
        }
    })
        .then(response => {
            console.log(response.data);
            $("#Their_Grid").css("border-color", "green");
            $("#Their_Grid").val(response.data["lat_lng"]);
        })
        .catch(error => {
            console.log(error.response.data["message"]);
            $("#Their_Grid").css("border-color", "red");
            $("#Their_Grid").val(error.response.data["message"]);
        })
}

function getCoordinates() {
    var cityName = document.getElementById('mesto').value;
    fetch('https://api.opencagedata.com/geocode/v1/json?q=' + cityName + '&key=c4b4fd955e3c4311bf2c81fc2559759c')
        .then(response => response.json())
        .then(data => {

            if (data.results[0] == null) {
                alert('Lokacija ne obstaja, ponovno vpišite!');
            }

            var lat = data.results[0].geometry.lat;
            var lng = data.results[0].geometry.lng;

            // Preveri, ali je checkbox izbran
            if($('#flexCheckIndeterminate').prop('checked')){
                // Če je checkbox izbran, ne spreminjaj vrednosti vnosnega polja
                return;
            } else {
                // Če checkbox ni izbran, nastavi vrednost vnosnega polja z novimi koordinatami
                inputField.value = lat + ", " + lng;
            }

            map.getView().setCenter(ol.proj.fromLonLat([lng, lat]));
            map.getView().setZoom(13);
        });
}

document.addEventListener("DOMContentLoaded", function() {
    // OPENSTREET VIEW MAP FOR LOCATION FIELD SCRIPT
    var inputField1 = document.getElementById("My_Grid");
    var inputField2 = document.getElementById("Their_Grid");

    let defaultLocation = [46.052267, 14.508815];

    const customIcon_green = L.icon({
        iconUrl: '/images/location-dot-solid-green.png',
        iconSize: [30, 30], // Width and height of the icon
        iconAnchor: [15, 30] // Point of the icon which will correspond to marker's location
    });

    const map1 = L.map("map");
    map1.setView(defaultLocation, 8);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map1);

    const map2 = L.map("map2");
    map2.setView(defaultLocation, 8);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map2);

    let marker1 = L.marker(defaultLocation, {
        draggable: true,
        icon: customIcon_green
    }).addTo(map1);

    let marker2 = L.marker(defaultLocation, {
        draggable: true,
        icon: customIcon_green
    }).addTo(map2);

    marker1.on('moveend', function (e) {
        if($('#flexCheckIndeterminate').prop('checked')) {
            document.getElementById("My_Grid").value = "";
            return;
        }
        const {lat, lng} = e.target.getLatLng();
        document.getElementById("My_Grid").value = `${lat.toFixed(8)}, ${lng.toFixed(8)}`;
        $("#My_Grid").css("border-color", "green");
    });

    map1.on('click', function (e) {
        if($('#flexCheckIndeterminate').prop('checked')) {
            document.getElementById("My_Grid").value = "";
            return;
        }
        const {lat, lng} = e.latlng;
        marker1.setLatLng([lat, lng]);
        document.getElementById("My_Grid").value = `${lat.toFixed(8)}, ${lng.toFixed(8)}`;
        $("#My_Grid").css("border-color", "green");
    });

    marker2.on('moveend', function (e) {
        const {lat, lng} = e.target.getLatLng();
        document.getElementById("Their_Grid").value = `${lat.toFixed(8)}, ${lng.toFixed(8)}`;
        $("#Their_Grid").css("border-color", "green");
    });

    map2.on('click', function (e) {
        const {lat, lng} = e.latlng;
        marker2.setLatLng([lat, lng]);
        document.getElementById("Their_Grid").value = `${lat.toFixed(8)}, ${lng.toFixed(8)}`;
        $("#Their_Grid").css("border-color", "green");
    });
});

document.querySelector('#myForm').addEventListener('submit', function (event) {
    // Prepreči takojšnjo oddajo obrazca
    event.preventDefault();

    // Koordinate My_Grid in Their_Grid
    var myGridCoords = document.getElementById("My_Grid").value.split(","); // Razdeli po vejici
    var theirGridCoords = document.getElementById("Their_Grid").value.split(",");

    // Izvleči širino in dolžino
    var myLat = parseFloat(myGridCoords[0].trim());
    var myLon = parseFloat(myGridCoords[1].trim());
    var theirLat = parseFloat(theirGridCoords[0].trim());
    var theirLon = parseFloat(theirGridCoords[1].trim());

    // Preveri, če so koordinate pravilno določene
    if (isNaN(myLat) || isNaN(myLon) || isNaN(theirLat) || isNaN(theirLon)) {
        alert("Napaka: Koordinate niso pravilno določene.");
        return;
    }

    // Izračunaj razdaljo med točkama
    var distance = distanceBetweenPoints(myLat, myLon, theirLat, theirLon);
    var distanceFixed = (distance / 1000).toFixed(3); // Prikaži rezultat s tremi decimalnimi mesti

    // Nastavi vrednost razdalje v skrito polje
    document.getElementById("QSO_Range").value = distanceFixed;

    // Pridobi tip zveze
    var freqValue = document.getElementById("Freq").value;
    var freqField = document.getElementById("Freq");
    var errorField = document.getElementById("freqError");

    // Resetiraj napako in obrobe polja
    freqField.style.border = "";
    errorField.innerHTML = "";

    // Za PMR preveri, če je številka med 1 in 16
    if (/^\d+$/.test(freqValue) && parseInt(freqValue) >= 1 && parseInt(freqValue) <= 16) {
        document.getElementById("QSO_Type").value = "PMR446";
    }
    // Preveri, če je string v formatu "CB" + številka med 1 in 40
    else if (/^CB(\d+)$/.test(freqValue)) {
        var cbChannel = parseInt(freqValue.match(/^CB(\d+)$/)[1]); // Izvleči številko kanala
        if (cbChannel >= 1 && cbChannel <= 40) {
            document.getElementById("QSO_Type").value = "CB";
        } else if (cbChannel > 40) {
            // Nastavi napako, če je kanal večji od 40
            document.getElementById("QSO_Type").value = "";
            errorField.innerHTML = "Izberite veljaven CB kanal '1-40'";
            errorField.style.color = "red";
            freqField.style.border = "2px solid red"; // Spremeni obrobo polja v rdečo
            return false; // Prepreči oddajo obrazca
        }
    }
    // Če ni PMR ali CB, je Ham
    else {
        document.getElementById("QSO_Type").value = "Ham";
    }

    // Pošlji obrazec
    this.submit();
});


// Pretvori stopinje v radiane
function degreesToRadians(degrees) {
    return degrees * Math.PI / 180;
}

// Vincentyjeva formula za izračun razdalje med dvema točkama na Zemlji
function distanceBetweenPoints(lat1, lon1, lat2, lon2) {
    const a = 6378137; // polosem velike osi elipsoida v metrih
    const f = 1 / 298.257223563; // sploščenje elipsoida
    const b = (1 - f) * a; // polosem male osi elipsoida v metrih

    const phi1 = degreesToRadians(lat1);
    const phi2 = degreesToRadians(lat2);
    const lambda1 = degreesToRadians(lon1);
    const lambda2 = degreesToRadians(lon2);

    const U1 = Math.atan((1 - f) * Math.tan(phi1));
    const U2 = Math.atan((1 - f) * Math.tan(phi2));
    const L = lambda2 - lambda1;

    let lambda = L;
    var lambda_old, sigma, sin_sigma, cos_sigma, cos2_alpha, cos2_sigma_m;
    do {
        lambda_old = lambda;
        const sin_lambda = Math.sin(lambda);
        const cos_lambda = Math.cos(lambda);
        sin_sigma = Math.sqrt(Math.pow(Math.cos(U2) * sin_lambda, 2) + Math.pow(Math.cos(U1) * Math.sin(U2) - Math.sin(U1) * Math.cos(U2) * cos_lambda, 2));
        cos_sigma = Math.sin(U1) * Math.sin(U2) + Math.cos(U1) * Math.cos(U2) * cos_lambda;
        sigma = Math.atan2(sin_sigma, cos_sigma);
        const sin_alpha = Math.cos(U1) * Math.cos(U2) * Math.sin(lambda) / sin_sigma;
        cos2_alpha = 1 - Math.pow(sin_alpha, 2);
        cos2_sigma_m = cos_sigma - 2 * Math.sin(U1) * Math.sin(U2) / cos2_alpha;
        const C = f / 16 * cos2_alpha * (4 + f * (4 - 3 * cos2_alpha));
        lambda = L + (1 - C) * f * sin_alpha * (sigma + C * sin_sigma * (cos2_sigma_m + C * cos_sigma * (-1 + 2 * Math.pow(cos2_sigma_m, 2))));
    } while (Math.abs(lambda - lambda_old) > 1e-12);

    const u2 = cos2_alpha * (Math.pow(a, 2) - Math.pow(b, 2)) / Math.pow(b, 2);
    const A = 1 + u2 / 16384 * (4096 + u2 * (-768 + u2 * (320 - 175 * u2)));
    const B = u2 / 1024 * (256 + u2 * (-128 + u2 * (74 - 47 * u2)));
    const delta_sigma = B * sin_sigma * (cos2_sigma_m + B / 4 * (cos_sigma * (-1 + 2 * Math.pow(cos2_sigma_m, 2)) - B / 6 * cos2_sigma_m * (-3 + 4 * Math.pow(sin_sigma, 2)) * (-3 + 4 * Math.pow(cos2_sigma_m, 2))));
    const s = b * A * (sigma - delta_sigma);
    return s; // Razdalja v metrih
}

function validate(val) {
    v1 = document.getElementById("My_Callsign");
    v2 = document.getElementById("Their_Callsign");
    v3 = document.getElementById("RST_Sent");
    v4 = document.getElementById("RST_Rcvd");
    v5 = document.getElementById("My_Grid");
    v6 = document.getElementById("Their_Grid");
    v7 = document.getElementById("Freq");

    flag1 = true;
    flag2 = true;
    flag3 = true;
    flag4 = true;
    flag5 = true;
    flag6 = true;
    flag7 = true;


    if(val>=1 || val==0) {
        if(v1.value == "") {
            v1.style.borderColor = "red";
            flag1 = false;
        }
        else {
            v1.style.borderColor = "green";
            flag1 = true;
        }
    }

    if(val>=2 || val==0) {
        if(v2.value == "") {
            v2.style.borderColor = "red";
            flag2 = false;
        }
        else {
            v2.style.borderColor = "green";
            flag2 = true;
        }
    }
    if(val>=3 || val==0) {
        if(v3.value == "") {
            v3.style.borderColor = "red";
            flag3 = false;
        }
        else {
            v3.style.borderColor = "green";
            flag3 = true;
        }
    }
    if(val>=4 || val==0) {
        if(v4.value == "") {
            v4.style.borderColor = "red";
            flag4 = false;
        }
        else {
            v4.style.borderColor = "green";
            flag4 = true;
        }
    }
    if(val>=5 || val==0) {
        if(v5.value == "") {
            v5.style.borderColor = "red";
            flag5 = false;
        }
        else {
            v5.style.borderColor = "green";
            flag5 = true;
        }
    }
    if(val>=6 || val==0) {
        if(v6.value == "" || v6.value == "This user does not exist!") {
            v6.style.borderColor = "red";
            flag6 = false;
        }
        else {
            v6.style.borderColor = "green";
            flag6 = true;
        }
    }
    if(val>=7 || val==0) {
        if(v7.value == "") {
            v7.style.borderColor = "red";
            flag7 = false;
        }
        else {
            v7.style.borderColor = "green";
            flag7 = true;
        }
    }

    flag = flag1 && flag2 && flag3 && flag4 && flag5 && flag6 && flag7;

    return flag;
}
