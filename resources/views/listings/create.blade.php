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
{{--                    <h3>Request a Demo</h3>--}}
{{--                    <p class="blue-text">Just answer a few questions<br> so that we can personalize the right experience for you.</p>--}}
                    <div class="card" style="background-image: url(); background-color: #f3f1f4">
                        <h5 class="text-center mb-4">Submit contact log form</h5>

                        {{-- CREATE LOG FORM --}}
                        <form method="POST" action="/listings" class="form-card" enctype="multipart/form-data">
                            @csrf
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
                                <div class="form-group col-12 flex-column d-flex">
                                    <label class="form-control-label px-3">Upload a Picture
                                    </label>
                                    <input type="file" id="Upload_Pic" name="Upload_Pic">
                                    {{-- UPLOAD PICTURE ERROR DISPLAY --}}
                                    <div class="input-group">
                                        @error("Upload_Pic")
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
                                    <input type="text" id="Notes" name="Notes">
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

        console.log({{auth()->user()->lat_lng}});

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
</script>



