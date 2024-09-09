<!DOCTYPE html>
<html>
<head>
    <title>Create Spot</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha512-3P8rXCuGJdNZOnUx/03c1jOTnMn3rP63nBip5gOP2qmUh5YAdVAvFZ1E+QLZZbC1rtMrQb+mah3AfYW11RUrWA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha512-TqmAh0/sSbwSuVBODEagAoiUIeGRo8u95a41zykGfq5iPkO9oie8IKCgx7yAr1bfiBjZeuapjLgMdp9UMpCVYQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://openlayers.org/en/v6.5.0/css/ol.css" type="text/css">
    <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v6.5.0/build/ol.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body{
            margin-top:20px;
            color: #1a202c;
            text-align: left;
            background-color: #e2e8f0;
        }
        .main-body {
            padding: 15px;
        }
        .card {
            box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0,0,0,.125);
            border-radius: .25rem;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .gutters-sm {
            margin-right: -8px;
            margin-left: -8px;
        }

        .gutters-sm>.col, .gutters-sm>[class*=col-] {
            padding-right: 8px;
            padding-left: 8px;
        }
        .mb-3, .my-3 {
            margin-bottom: 1rem!important;
        }

        .bg-gray-300 {
            background-color: #e2e8f0;
        }
        .h-100 {
            height: 100%!important;
        }
        .shadow-none {
            box-shadow: none!important;
        }
    </style>
</head>


<body>
<div class="container">
    <div class="main-body">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->

        <form method="POST" action="/spots" class="form-card" enctype="multipart/form-data">
            @csrf
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4>{{auth()->user()->name}}</h4>
                                    <p class="text-secondary mb-1"><i class="fa-solid fa-map-location-dot mr-2"></i>{{auth()->user()->lat_lng}}</p>
                                    <p class="text-secondary mb-1"><i class="fa-solid fa-table-cells-large mr-2"></i>{{auth()->user()->grid}}</p>
                                    <p class="text-secondary mb-2"><i class="fa-solid fa-city mr-2"></i>{{auth()->user()->city}}</p>

                                    {{-- SUBMIT AND BACK BUTTONS --}}
                                    <button type="submit" class="btn btn-primary">Create a spot</button>
                                    <a href="/" class="btn btn-danger text-center">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            {{-- Types of Spots: normal pmr, sota pmr, ??? --}}
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="ml-2 mb-1"><i class="fa fa-user"></i> Activation Callsign/nickname</h6>
                                <input type="text" id="activation_callsign" name="activation_callsign" class="text-secondary form-control border border-primary" placeholder="S57KZ" value="{{old("activation_callsign")}}">
                                {{-- activation_callsign ERROR DISPLAY --}}
                                <div class="input-group">
                                    @error("activation_callsign")
                                    <p class="text-danger text-sm mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="ml-2 mb-1"><i class="fa-solid fa-map-location-dot"></i> Location (Lat,Lng)</h6>
                                <input type="text" id="location" name="location" class="text-secondary form-control border border-primary" value="{{old("location")}}" readonly>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="ml-2 mb-1"><i class="fa-solid fa-wave-square"></i> Frequency/channel</h6>
                                <input type="text" id="frequency" name="frequency" class="text-secondary form-control border border-primary" placeholder="446.00625" value="{{old("frequency")}}">
                                {{-- MY GRID ERROR DISPLAY --}}
                                <div class="input-group">
                                    @error("frequency")
                                    <p class="text-danger text-sm mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="ml-2 mb-1"><i class="fa-solid fa-signal"></i> Mode</h6>
                                <select class="form-select text-primary form-control border border-primary" name="mode" id="mode" aria-label="mode">
                                    <option value="" {{ old('mode') == "" ? 'selected' : '' }}>Select mode</option>
                                    <option value="fm" {{ old('mode') == "fm" ? 'selected' : '' }}>FM</option>
                                    <option value="am" {{ old('mode') == "am" ? 'selected' : '' }}>AM</option>
                                    <option value="ssb" {{ old('mode') == "ssb" ? 'selected' : '' }}>SSB</option>
                                    <option value="digital" {{ old('mode') == "digital" ? 'selected' : '' }}>Digital</option>
                                    <option value="other" {{ old('mode') == "other" ? 'selected' : '' }}>Other</option>
                                </select>
                                {{-- MODE ERROR DISPLAY --}}
                                <div class="input-group">
                                    @error("mode")
                                    <p class="text-danger text-sm mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="ml-2 mb-1"><i class="fa-regular fa-clock"></i> Time window</h6>
                                <select class="form-select text-primary form-control border border-primary" name="time" id="time" aria-label="time">
                                    <option value="" {{ old('time') == "" ? 'selected' : '' }}>Select time window</option>
                                    <option value="15min" {{ old('time') == "15min" ? 'selected' : '' }}>15 minutes or less</option>
                                    <option value="1h" {{ old('time') == "1h" ? 'selected' : '' }}>An hour</option>
                                    <option value="1day" {{ old('time') == "1day" ? 'selected' : '' }}>A day</option>
                                    <option value="infinite" {{ old('time') == "infinite" ? 'selected' : '' }}>Infinite</option>
                                    <option value="alert" {{ old('time') == "alert" ? 'selected' : '' }}>Alert in advance (TODO: koledar za izbor)</option>
                                </select>
                                {{-- TIME ERROR DISPLAY --}}
                                <div class="input-group">
                                    @error("time")
                                    <p class="text-danger text-sm mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="ml-2 mb-1"><i class="fa-brands fa-hubspot"></i> Spot type</h6>
                                <select class="form-select text-primary form-control border border-primary" name="type" id="type" aria-label="type">
                                    <option value="" {{ old('type') == "" ? 'selected' : '' }}>Select spot type</option>
                                    <option value="portable" {{ old('type') == "portable" ? 'selected' : '' }}>Portable (+ pmr SOTA/POTA)</option>
                                    <option value="mobile" {{ old('type') == "mobile" ? 'selected' : '' }}>Mobile</option>
                                    <option value="qth" {{ old('type') == "qth" ? 'selected' : '' }}>Qth</option>
                                    <option value="other" {{ old('type') == "other" ? 'selected' : '' }}>Other</option>
                                </select>
                                {{-- TYPE ERROR DISPLAY --}}
                                <div class="input-group">
                                    @error("type")
                                    <p class="text-danger text-sm mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="ml-2 mb-1"><i class="fa-solid fa-note-sticky"></i> Comments</h6>
                                <input type="text" id="comments" name="comments" class="text-secondary form-control border border-primary" placeholder="Notes..." value="{{old("comments")}}">
                                {{-- MY CITY ERROR DISPLAY --}}
                                <div class="input-group">
                                    @error("comments")
                                    <p class="text-danger text-sm mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row justify-content-between text-left">
                                {{--MY LOCATION FIELD --}}
                                <div class="form-group col-sm-12 flex-column d-flex">
                                    {{-- MAP --}}
                                    <div id="map" class="map" style="height: 600px;"></div>
                                    {{-- END OF MAP --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
{{-- OPENSTREET VIEW MAP FOR LOCATION FIELD SCRIPT --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let userLocation = [46.052267, 14.508815];

        console.log(userLocation);
        const map = L.map("map").setView(userLocation, 8);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        const customIcon_green = L.icon({
            iconUrl: '/images/location-dot-solid-green.png',
            iconSize: [30, 30], // Width and height of the icon
            iconAnchor: [15, 30] // Point of the icon which will correspond to marker's location
        });

        let marker = L.marker(userLocation, {
            draggable: true,
            icon: customIcon_green
        }).addTo(map);

        marker.on('moveend', function (e) {
            const {lat, lng} = e.target.getLatLng();
            document.getElementById("location").value = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
        });

        map.on('click', function (e) {
            const {lat, lng} = e.latlng;
            marker.setLatLng([lat, lng]);
            document.getElementById("location").value = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
        });
    });
</script>




