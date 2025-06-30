{{--<x-layout>--}}
{{--    <x-card class="p-10 rounded max-w-lg mx-auto mt-24">--}}
{{--        <header class="text-center">--}}
{{--            <h2 class="text-2xl font-bold uppercase mb-1">--}}
{{--                Edit gig--}}
{{--            </h2>--}}
{{--            <p class="mb-4">Edit: {{$listing->title}}</p>--}}
{{--        </header>--}}

{{--        --}}{{-- enctype="multipart/form-data", da nam dovoli nalaganje datoteke na spletno stran --}}
{{--        <form method="POST" action="/listings/{{$listing->id}}" enctype="multipart/form-data">--}}
{{--            --}}{{-- @csrf onemogoči cross-site scripting napade --}}
{{--            @csrf--}}
{{--            @method("PUT")--}}
{{--            <div class="mb-6">--}}
{{--                <label for="company" class="inline-block text-lg mb-2">My Callsign</label>--}}
{{--                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="company" value="{{$listing->company}}"/>--}}
{{--                @error("company")--}}
{{--                <p class="text-red-500 text-xs mt-1">{{$message}}</p>--}}
{{--                @enderror--}}
{{--            </div>--}}

{{--            <div class="mb-6">--}}
{{--                <label for="title" class="inline-block text-lg mb-2">Their Callsign</label>--}}
{{--                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title" value="{{$listing->title}}"/>--}}
{{--                @error("title")--}}
{{--                <p class="text-red-500 text-xs mt-1">{{$message}}</p>--}}
{{--                @enderror--}}
{{--            </div>--}}

{{--            <div class="mb-6">--}}
{{--                <label for="location" class="inline-block text-lg mb-2">RST Sent</label>--}}
{{--                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="location" value="{{$listing->location}}" placeholder="59" />--}}
{{--                @error("location")--}}
{{--                <p class="text-red-500 text-xs mt-1">{{$message}}</p>--}}
{{--                @enderror--}}
{{--            </div>--}}

{{--            <div class="mb-6">--}}
{{--                <label for="email" class="inline-block text-lg mb-2">RST Rcvd</label>--}}
{{--                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="email" value="{{$listing->email}}" placeholder="S57KZ" />--}}
{{--                @error("email")--}}
{{--                <p class="text-red-500 text-xs mt-1">{{$message}}</p>--}}
{{--                @enderror--}}
{{--            </div>--}}

{{--            <div class="mb-6">--}}
{{--                <label for="website" class="inline-block text-lg mb-2">My Grid (location)</label>--}}
{{--                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="website" value="{{$listing->website}}"/>--}}
{{--                @error("website")--}}
{{--                <p class="text-red-500 text-xs mt-1">{{$message}}</p>--}}
{{--                @enderror--}}
{{--            </div>--}}

{{--            <div class="mb-6">--}}
{{--                <label for="tags" class="inline-block text-lg mb-2">Their Grid (location)</label>--}}
{{--                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags" value="{{$listing->tags}}"/>--}}
{{--                @error("tags")--}}
{{--                <p class="text-red-500 text-xs mt-1">{{$message}}</p>--}}
{{--                @enderror--}}
{{--            </div>--}}

{{--            <div class="mb-6">--}}
{{--                <label for="date_time" class="inline-block text-lg mb-2">Date and Time</label>--}}
{{--                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="date_time" value="{{old("date_time")}}"/>--}}
{{--                @error("date_time")--}}
{{--                <p class="text-red-500 text-xs mt-1">{{$message}}</p>--}}
{{--                @enderror--}}
{{--            </div>--}}

{{--            <div class="mb-6">--}}
{{--                <label for="freq" class="inline-block text-lg mb-2">Frequency/Channel</label>--}}
{{--                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="freq" placeholder="446.00625/CH1" value="{{old("freq")}}"/>--}}
{{--                @error("freq")--}}
{{--                <p class="text-red-500 text-xs mt-1">{{$message}}</p>--}}
{{--                @enderror--}}
{{--            </div>--}}

{{--            --}}{{-- Nalaganje datoteke, moramo dodati atribut v form --}}
{{--            <div class="mb-6">--}}
{{--                <label for="logo" class="inline-block text-lg mb-2">Company Logo</label>--}}
{{--                <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo"/>--}}
{{--                <img class="w-48 mr-6 mb-6" src="{{$listing->logo ? asset("storage/" . $listing->logo) : asset("/images/no-image.png")}}" alt=""/>--}}
{{--                @error("logo")--}}
{{--                <p class="text-red-500 text-xs mt-1">{{$message}}</p>--}}
{{--                @enderror--}}
{{--            </div>--}}

{{--            <div class="mb-6">--}}
{{--                <label for="description" class="inline-block text-lg mb-2">Job Description</label>--}}
{{--                <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10" placeholder="Include tasks, requirements, salary, etc">--}}
{{--                    --}}{{-- tu zadevo naredimo nekoliko drugače, v textarea je potrebno dati vrednost znotraj tagov <textarea></textarea> --}}
{{--                    {{$listing->description}}--}}
{{--                </textarea>--}}
{{--                @error("description")--}}
{{--                <p class="text-red-500 text-xs mt-1">{{$message}}</p>--}}
{{--                @enderror--}}
{{--            </div>--}}

{{--            <div class="mb-6">--}}
{{--                <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">Update Gig</button>--}}
{{--                <a href="/" class="text-black ml-4"> Back </a>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </x-card>--}}
{{--</x-layout>--}}

<!DOCTYPE html>
<html>
<head>
    <title>Update Log</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha512-3P8rXCuGJdNZOnUx/03c1jOTnMn3rP63nBip5gOP2qmUh5YAdVAvFZ1E+QLZZbC1rtMrQb+mah3AfYW11RUrWA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha512-TqmAh0/sSbwSuVBODEagAoiUIeGRo8u95a41zykGfq5iPkO9oie8IKCgx7yAr1bfiBjZeuapjLgMdp9UMpCVYQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://openlayers.org/en/v6.5.0/css/ol.css" type="text/css">
    <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v6.5.0/build/ol.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body{color: #000;overflow-x: hidden;height: 100%;background-image: url("https://images.unsplash.com/photo-1477346611705-65d1883cee1e?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1920&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=c0d43804e2c7c93143fe8ff65398c8e9");background-repeat: no-repeat;background-size: 100% 100%}.card{padding: 30px 40px;margin-top: 60px;margin-bottom: 60px;border: none !important;box-shadow: 0 6px 12px 0 rgba(0,0,0,0.2)}.blue-text{color: #00BCD4}.form-control-label{margin-bottom: 0}input, textarea, button{padding: 8px 15px;border-radius: 5px !important;margin: 5px 0px;box-sizing: border-box;border: 1px solid #ccc;font-size: 18px !important;font-weight: 300}input:focus, textarea:focus{-moz-box-shadow: none !important;-webkit-box-shadow: none !important;box-shadow: none !important;border: 1px solid #00BCD4;outline-width: 0;font-weight: 400}.btn-block{text-transform: uppercase;font-size: 15px !important;font-weight: 400;height: 43px;cursor: pointer}.btn-block:hover{color: #fff !important}button:focus{-moz-box-shadow: none !important;-webkit-box-shadow: none !important;box-shadow: none !important;outline-width: 0}
    </style>
</head>

<body>
<div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            <div class="card">
                <h5 class="text-center mb-4">Edit Contact</h5>

                {{-- EDIT LOG FORM --}}
                <form method="POST" action="/listings/{{$listing->id}}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    {{-- ROW --}}
                    <div class="row justify-content-between text-left">

                        {{-- MY CALLSIGN FIELD --}}
                        <div class="form-group col-sm-6 flex-column d-flex">

                            <label class="form-control-label px-3"><i class="fa fa-user"></i> My Callsign
                                <span class="text-danger"> *</span>
                            </label>
                            <input type="text" id="My_Callsign" name="My_Callsign" placeholder="S57KZ" value="{{$listing->My_Callsign}}" onblur="validate(1)">
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
                            <input type="text" id="Their_Callsign" name="Their_Callsign" value="{{$listing->Their_Callsign}}" onblur="validate(2)">
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
                            <input type="text" id="RST_Sent" name="RST_Sent" placeholder="59" value="{{$listing->RST_Sent}}" onblur="validate(3)">
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
                            <input type="text" id="RST_Rcvd" name="RST_Rcvd" value="{{$listing->RST_Rcvd}}" onblur="validate(4)">
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
                            </label>
                            <input type="text" id="My_Grid" name="My_Grid" value="{{$listing->My_Grid}}" onblur="validate(5)" placeholder="46.04813017777806, 14.507444731173871" readonly>

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
                            <label class="form-control-label px-3"><i class="fa-solid fa-map-location-dot"></i> Their Grid (location)
                                <span class="text-danger"> *</span>
                            </label>
                            <input type="text" id="Their_Grid" name="Their_Grid" value="{{$listing->Their_Grid}}" onblur="validate(6)">

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
                            <input type="datetime-local" id="Date_Time" name="Date_Time" value="{{$listing->Date_Time}}" onblur="validate(7)">
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
                            <input type="text" id="Freq" name="Freq" placeholder="446.00625/CH1" value="{{$listing->Freq}}" onblur="validate(8)">
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
                            <img class="img-fluid rounded mx-auto d-block" style="width: 15%;" src="{{ $listing->Upload_Pic ? asset('storage/' . $listing->Upload_Pic) : asset('/images/no-image.png') }}" alt="">                            {{-- UPLOAD PICTURE ERROR DISPLAY --}}
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
                            <input type="text" id="Notes" name="Notes" value="{{$listing->Notes}}">
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
                            <button type="submit" class="btn-block btn-primary">Update Log</button>
                            <a href="/" class="btn-block btn btn-danger text-center"> Back </a>
                        </div>
                    </div>
                </form>
                {{-- END OF ROW --}}
                {{-- END OF EDIT LOG FORM --}}

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
            if(v6.value == "") {
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


{{-- OPENSTREET VIEW MAP FOR LOCATION FIELD SCRIPT --}}
<script>
    var inputField1 = document.getElementById("My_Grid");
    var inputField2 = document.getElementById("Their_Grid");

    var map1 = new ol.Map({
        target: 'map',
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM()
            })
        ],
        view: new ol.View({
            center: ol.proj.fromLonLat([{{$listing->My_Grid}}].reverse()),
            zoom: 11
        })
    });

    var map2 = new ol.Map({
        target: 'map2',
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM()
            })
        ],
        view: new ol.View({
            center: ol.proj.fromLonLat([{{$listing->Their_Grid}}].reverse()),
            zoom: 11
        })
    });

    map1.on('click', function(e) {
        var coordinates = ol.proj.toLonLat(e.coordinate);
        inputField1.value = coordinates[1] + ", " + coordinates[0];
    });

    map2.on('click', function(e) {
        var coordinates = ol.proj.toLonLat(e.coordinate);
        inputField2.value = coordinates[1] + ", " + coordinates[0];
    });

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

                inputField.value = lat + ", " + lng;

                map.getView().setCenter(ol.proj.fromLonLat([lng, lat]));
                map.getView().setZoom(13);
            });
    }
</script>
