<!DOCTYPE html>
<html>
    <head>
        <title>Create Log</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha512-3P8rXCuGJdNZOnUx/03c1jOTnMn3rP63nBip5gOP2qmUh5YAdVAvFZ1E+QLZZbC1rtMrQb+mah3AfYW11RUrWA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha512-TqmAh0/sSbwSuVBODEagAoiUIeGRo8u95a41zykGfq5iPkO9oie8IKCgx7yAr1bfiBjZeuapjLgMdp9UMpCVYQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://openlayers.org/en/v6.5.0/css/ol.css" type="text/css">
        <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v6.5.0/build/ol.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <style>
            body{color: #000;overflow-x: hidden;height: 100%;background-image: url("https://images.unsplash.com/photo-1477346611705-65d1883cee1e?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1920&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=c0d43804e2c7c93143fe8ff65398c8e9");background-repeat: no-repeat;background-size: 100% 100%}.card{padding: 30px 40px;margin-top: 60px;margin-bottom: 60px;border: none !important;box-shadow: 0 6px 12px 0 rgba(0,0,0,0.2)}.blue-text{color: #00BCD4}.form-control-label{margin-bottom: 0}input, textarea, button{padding: 8px 15px;border-radius: 5px !important;margin: 5px 0px;box-sizing: border-box;border: 1px solid #ccc;font-size: 18px !important;font-weight: 300}input:focus, textarea:focus{-moz-box-shadow: none !important;-webkit-box-shadow: none !important;box-shadow: none !important;border: 1px solid #00BCD4;outline-width: 0;font-weight: 400}.btn-block{text-transform: uppercase;font-size: 15px !important;font-weight: 400;height: 43px;cursor: pointer}.btn-block:hover{color: #fff !important}button:focus{-moz-box-shadow: none !important;-webkit-box-shadow: none !important;box-shadow: none !important;outline-width: 0}

        </style>
    </head>

    <body>
        <div class="container-fluid px-1 py-5 mx-auto">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                    <div class="card" style="background-color: #f3f1f4">
                        <h5 class="text-center mb-4">Submit contact log form</h5>

                        {{-- CREATE LOG FORM --}}
                        <form method="POST" action="/listings" class="form-card" enctype="multipart/form-data">
                            @csrf
                            <!-- Rest of the form content here -->

                            {{-- ROW --}}
                            <div class="row justify-content-between text-left">

                                {{-- MY CALLSIGN FIELD --}}
                                <div class="form-group col-sm-6 flex-column d-flex">

                                    <label class="form-control-label px-3"><i class="fa fa-user"></i> My Callsign
                                        <span class="text-danger"> *</span>
                                    </label>
                                        <input type="text" id="My_Callsign" name="My_Callsign" placeholder="S57KZ" value="{{old("My_Callsign")}}" onblur="validate(1)">
                                    {{-- MY CALLSIGN ERROR DISPLAY --}}
                                    <div>
                                        @error("My_Callsign")
                                            <p class="text-danger text-sm mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- THEIR CALLSIGN FIELD --}}
                                <div class="form-group col-sm-6 flex-column d-flex">
                                    <label class="form-control-label px-3"><i class="fa-regular fa-user"></i> Their Callsign
                                        <span class="text-danger"> *</span>
                                    </label>
                                    <input type="text" id="Their_Callsign" name="Their_Callsign" value="{{old("Their_Callsign")}}" onblur="validate(2)">
                                    {{-- THEIR CALLSIGN ERROR DISPLAY --}}
                                    <div class="input-group">
                                        @error("Their_Callsign")
                                            <p class="text-danger text-sm mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- END OF ROW --}}


                            {{-- ROW --}}
                            <div class="row justify-content-between text-left">
                                {{-- RTS SENT FIELD --}}
                                <div class="form-group col-sm-6 flex-column d-flex">
                                    <label class="form-control-label px-3"><i class="fa-solid fa-signal"></i> RST Sent
                                        <span class="text-danger"> *</span>
                                    </label>
                                    <input type="text" id="RST_Sent" name="RST_Sent" placeholder="59" value="{{old("RST_Sent")}}" onblur="validate(3)">
                                    {{-- RTS SENT ERROR DISPLAY --}}
                                    <div class="input-group">
                                        @error("RST_Sent")
                                            <p class="text-danger text-sm mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- RTS RECEIVED FIELD --}}
                                <div class="form-group col-sm-6 flex-column d-flex">
                                    <label class="form-control-label px-3"><i class="fa-solid fa-signal"></i> RST Rcvd
                                        <span class="text-danger"> *</span>
                                    </label>
                                    <input type="text" id="RST_Rcvd" name="RST_Rcvd" value="{{old("RST_Rcvd")}}" onblur="validate(4)">
                                    {{-- RTS RECEIVED ERROR DISPLAY --}}
                                    <div class="input-group">
                                        @error("RST_Rcvd")
                                            <p class="text-danger text-sm mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- END OF ROW --}}


                            {{-- ROW --}}
                            <div class="row justify-content-between text-left">
                                {{--MY LOCATION FIELD --}}
                                <div class="form-group col-sm-6 flex-column d-flex">
                                    <label class="form-control-label px-3"><i class="fa-solid fa-map-location-dot"></i> My Grid (location)
                                        <span class="text-danger"> *</span>
                                        <span class="form-control-label ml-5 font-italic text-secondary">Use your location from database</span>
                                        <input class="form-check-input ml-2 mt-2" type="checkbox" value="" id="flexCheckIndeterminate">
                                    </label>
                                    <input type="text" id="My_Grid" name="My_Grid" value="{{old("My_Grid")}}" onblur="validate(5)" placeholder="46.04813017777806, 14.507444731173871" readonly>

                                    {{-- MAP --}}
                                    <div id="map" class="map" style="height: 285px;"></div>
                                    {{-- END OF MAP --}}

                                    {{-- MY GRID ERROR DISPLAY --}}
                                    <div class="input-group">
                                        @error("My_Grid")
                                            <p class="text-danger text-sm mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- THEIR LOCATION FIELD --}}
                                <div class="form-group col-sm-6 flex-column d-flex">
{{--                                    <form method="POST" action="{{route('users.get-location')}}"></form>--}}
                                    <label class="form-control-label px-3"><i class="fa-solid fa-map-location-dot"></i> Their Grid (location)
                                        <span class="text-danger"> *</span>
                                        <span class="form-control-label ml-1 font-italic text-secondary"> Get user location from database
                                        <a href="#" onclick="getUserCoordinates()" class="btn btn-secondary btn-sm ml-1" style="height: 25px; margin-top: -2%">GET</a></span>
{{--                                        <button type="button" class="btn-block btn-primary" onclick="getUserCoordinates()">Get location</button>--}}

                                    </label>
                                    <input type="text" id="Their_Grid" name="Their_Grid" value="{{old("Their_Grid")}}" onblur="validate(6)" readonly>

                                    {{-- SECOND MAP --}}
                                    <div id="map2" class="map" style="height: 285px;"></div>
                                    {{-- END OF SECOND MAP --}}

                                    {{-- THEIR GRID ERROR DISPLAY --}}
                                    <div class="input-group">
                                        @error("Their_Grid")
                                            <p class="text-danger text-sm mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- END OF ROW --}}


                            {{-- ROW --}}
                            <div class="row justify-content-between text-left">
                                {{-- DATE AND TIME FIELD --}}
                                <div class="form-group col-sm-6 flex-column d-flex">
                                    <label class="form-control-label px-3"><i class="fa-regular fa-clock"></i> Date and Time
                                        <span class="text-danger"> *</span>
                                    </label>
                                    <input type="datetime-local" id="Date_Time" name="Date_Time" value="{{old("Date_Time")}}" onblur="validate(7)">
                                    {{-- DATE-TIME ERROR DISPLAY --}}
                                    <div class="input-group">
                                        @error("Date_Time")
                                            <p class="text-danger text-sm mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- FREQUENCY FIELD --}}
                                <div class="form-group col-sm-6 flex-column d-flex">
                                    <label class="form-control-label px-3"><i class="fa-solid fa-wave-square"></i> Frequency/Channel
                                        <span class="text-danger"> *</span>
                                    </label>
                                    <input type="text" id="Freq" name="Freq" placeholder="446.00625/CH1" value="{{old("Freq")}}" onblur="validate(8)">
                                    <div id="freqError"></div>
                                    {{-- FREQUENCY ERROR DISPLAY --}}
                                    <div class="input-group">
                                        @error("Freq")
                                             <p class="text-danger text-sm mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- END OF ROW --}}


                            {{-- ROW --}}
                            <div class="row justify-content-between text-left">
                                {{-- UPLOAD A PICTURE FIELD --}}
                                <div class="form-group col-6 flex-column d-flex">
                                    <label class="form-control-label px-3"><i class="fa-regular fa-image"></i> Upload a Picture</label>
                                    <input type="file" id="Upload_Pic" name="Upload_Pic">
                                    {{-- UPLOAD PICTURE ERROR DISPLAY --}}
                                    <div class="input-group">
                                        @error("Upload_Pic")
                                            <p class="text-danger text-sm mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- CHOOSE EVENT TYPE FIELD --}}
                                <div class="form-group col-6 flex-column d-flex mt-1">
                                    <label class="form-control-label px-3"><i class="fa-solid fa-tag"></i> Choose an Event Type</label>
                                    <select class="form-select text-primary form-control border border-primary" name="Event_type" id="Event_type" aria-label="Event_type">
                                        <option value="classic" {{ old('Event_type') == "classic" ? 'selected' : '' }}>Classic</option>
                                        <option value="simplex_window" {{ old('Event_type') == "simplex_window" ? 'selected' : '' }}>Simplex Window</option>
                                        <option value="weekly_net" {{ old('Event_type') == "weekly_net" ? 'selected' : '' }}>Weekly Net</option>
                                        <option value="sota" {{ old('Event_type') == "sota" ? 'selected' : '' }}>(pmr) SOTA</option>
                                    </select>
                                    {{-- EVENT TYPE ERROR DISPLAY --}}
                                    <div class="input-group">
                                        @error("Event_type")
                                            <p class="text-danger text-sm mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- END OF ROW --}}


                            {{-- ROW --}}
                            <div class="row justify-content-between text-left">
                                {{-- ADDITIONAL NOTES FIELD --}}
                                <div class="form-group col-12 flex-column d-flex">
                                    <label class="form-control-label px-3"><i class="fa-solid fa-note-sticky"></i> Additional Notes
                                    </label>
                                    {{-- Hidden fields --}}
                                    <input type="hidden" id="QSO_Range" name="QSO_Range" value="">
                                    <input type="hidden" id="QSO_Type" name="QSO_Type" value="">
                                    <input type="text" id="Notes" name="Notes">
                                    {{-- !Hidden fields --}}
                                    {{-- ADDITIONAL NOTES ERROR DISPLAY --}}
                                    <div class="input-group">
                                        @error("Notes")
                                            <p class="text-danger text-sm mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- END OF ROW --}}


                            {{-- ROW --}}
                            <div class="row justify-content-end">
                                {{-- SUBMIT BUTTON --}}
                                <div class="form-group col-sm-6">
                                    <button type="submit" class="btn-block btn-primary">Create Log</button>
                                    <a href="/" class="btn-block btn btn-danger text-center"> Back </a>
                                </div>
                            </div>
                        </form>
                        {{-- END OF ROW --}}
                        {{-- END OF CREATE LOG FORM --}}

                    </div>
                </div>
            </div>
        </div>

    </body>
</html>


{{-- VALIDATE FIELDS SCRIPT--}}
{{-- TO:DO NEEDS UPDATING FOR NEW NAMES AND FIELDS --}}
<script>
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
</script>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
    $(document).ready(function(){
        // Nastavi checkbox na checked
        $('#flexCheckIndeterminate').prop('checked', true);
        $('#flexCheckIndeterminate2').prop('checked', true);

        // Ob preverjanju stanja checkboxa
        $('#flexCheckIndeterminate').change(function(){
            // Če je checkbox izbran
            if($(this).prop('checked')){
                // Onemogoči vnosno polje in napolni z vrednostjo spremenljivke
                $('#My_Grid').prop('readonly', true).val("{{auth()->user()->lat_lng}}");
                $("#My_Grid").css("border-color", "green");
            } else {
                // Omogoči vnosno polje in pobriši vrednost
                $('#My_Grid').prop('readonly', false).val("");
                $("#My_Grid").css("border-color", "red");
            }
        });

        {{--$('#flexCheckIndeterminate2').change(function(){--}}
        {{--    // Če je checkbox izbran--}}
        {{--    if($(this).prop('checked')){--}}
        {{--        // Onemogoči vnosno polje in napolni z vrednostjo spremenljivke--}}
        {{--        $('#Their_Grid').prop('readonly', true).val("{{auth()->user()->lat_lng}}");--}}
        {{--    } else {--}}
        {{--        // Omogoči vnosno polje in pobriši vrednost--}}
        {{--        $('#Their_Grid').prop('readonly', false).val("");--}}
        {{--    }--}}
        {{--});--}}

        // Preveri stanje checkboxa
        if($('#flexCheckIndeterminate').prop('checked')){
            // Če je checkbox izbran, onemogoči spreminjanje vrednosti vnosnega polja
            $('#My_Grid').prop('readonly', true);
        } else {
            // Če checkbox ni izbran, omogoči spreminjanje vrednosti vnosnega polja
            $('#My_Grid').prop('readonly', false);
        }

        // // Preveri stanje checkboxa2
        // if($('#flexCheckIndeterminate2').prop('checked')){
        //     // Če je checkbox izbran, onemogoči spreminjanje vrednosti vnosnega polja
        //     $('#Their_Grid').prop('readonly', true);
        // } else {
        //     // Če checkbox ni izbran, omogoči spreminjanje vrednosti vnosnega polja
        //     $('#Their_Grid').prop('readonly', false);
        // }

    });


    {{-- Get Coordinates From Username--}}
    // $("#Their_Callsign").val()
    function getUserCoordinates() {
        axios.get('/users/get-location', {
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

    document.querySelector('form').addEventListener('submit', function (event) {
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
</script>



