{{-- kot import headerja v phpju, glej index.blade.php, layout wrapper --}}
{{--@extends("components.layout")--}}
{{--@section("content")--}}
{{--<x-layout>--}}
{{--    @include("partials._search")--}}

{{--    <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back</a>--}}
{{--    <div class="mx-4">--}}
{{--        --}}{{-- dodajanje razreda za povečanje paddinga ne deluje direktno v tem filu, to naredimo v card.blade.php da lahko sprejme dodaten razred, ki ga tu vnesemo --}}
{{--        <x-card class="p-10">--}}
{{--            <div class="flex flex-col items-center justify-center text-center">--}}
{{--                <img class="w-48 mr-6 mb-6" src="{{$listing->logo ? asset("storage/" . $listing->logo) : asset("/images/no-image.png")}}" alt=""/>--}}

{{--                <h3 class="text-2xl mb-2">{{$listing->title}}</h3>--}}
{{--                <div class="text-xl font-bold mb-4">{{$listing->company}}</div>--}}

{{--                --}}{{-- tagi iz listing-tags.blade.php! --}}
{{--                <x-listing-tags :tagsCsv="$listing->tags"/>--}}

{{--                <div class="text-lg my-4">--}}
{{--                    <i class="fa-solid fa-location-dot"></i> {{$listing->location}}--}}
{{--                </div>--}}
{{--                <div class="border border-gray-200 w-full mb-6"></div>--}}
{{--                <div>--}}
{{--                    <h3 class="text-3xl font-bold mb-4">--}}
{{--                        Job Description--}}
{{--                    </h3>--}}
{{--                    <div class="text-lg space-y-6">--}}
{{--                        {{$listing->description}}--}}

{{--                        <a href="mailto:{{$listing->email}}"--}}
{{--                           class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80">--}}
{{--                            <i class="fa-solid fa-envelope"></i> Contact Employer--}}
{{--                        </a>--}}

{{--                        <a href="{{$listing->website}}" target="_blank"--}}
{{--                           class="block bg-black text-white py-2 rounded-xl hover:opacity-80">--}}
{{--                            <i class="fa-solid fa-globe"></i> Visit Website</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </x-card>--}}

{{--        --}}{{----}}{{-- Edit gumb --}}
{{--        <x-card class="mt-4 p-2 flex space-x-6">--}}
{{--            <a href="/listings/{{$listing->id}}/edit">--}}
{{--                <i class="fa-solid fa-pencil"></i> Edit--}}
{{--            </a>--}}

{{--            <form method="POST" action="/listings/{{$listing->id}}">--}}
{{--                @csrf--}}
{{--                @method("DELETE")--}}
{{--                <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>--}}
{{--            </form>--}}
{{--        </x-card>--}}
{{--    </div>--}}

{{--@endsection--}}
{{--</x-layout>--}}

<!DOCTYPE html>
<html>
<head>
    <title>Contact detail</title>
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
                <li class="breadcrumb-item"><a href="javascript:void(0)">Contact</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact Detail</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->

        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{$listing->Upload_Pic ? asset("storage/" . $listing->Upload_Pic) : asset("https://bootdey.com/img/Content/avatar/avatar7.png")}}" alt="Admin" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4>{{auth()->user()->name}}</h4>
                                <p class="text-secondary mb-1">PMR Enthusiast</p>
                                <p class="text-muted font-size-sm">{{auth()->user()->city}}</p>
                                <button class="btn btn-primary">Follow</button>
                                <button class="btn btn-outline-primary">Message</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><i class="fa-regular fa-clock mr-2"></i>Date and Time</h6>
                            <span class="text-secondary">{{$listing->Date_Time}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><i class="fa-solid fa-wave-square mr-2"></i>Channel/Frequency</h6>
                            <span class="text-secondary" id="Freq"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><i class="fa-solid fa-ruler mr-2"></i>Contact Distance</h6>
                            <span class="text-secondary" id="contact-distance">{{$listing->QSO_Range}} km</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><i class="fa-solid fa-tag"></i> Additional information</h6>
                            <span class="text-secondary">'{{$listing->QSO_Type}}', '{{$listing->Event_type}}'</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><i class="fa-solid fa-note-sticky mr-2"></i>Notes</h6>
                            <span class="text-secondary">{{$listing->Notes}}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        {{-- MAP --}}
                        <div id="map" class="map" style="height: 500px;"></div>
                        {{-- END OF MAP --}}
                    </div>
                </div>

                <div class="row gutters-sm">
                    <div class="col-sm-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <?php
                                    // Pretvorba stringa v celo število in deljenje z 10
                                    $Mod_Sent = floor(intval($listing->RST_Sent) / 10);
                                    $Mod_Rcvd = floor(intval($listing->RST_Rcvd) / 10);

                                    $Sig_Sent = floor(intval($listing->RST_Sent) % 10);
                                    $Sig_Rcvd = floor(intval($listing->RST_Rcvd) % 10);

                                    $My_Lat = explode(',', $listing->My_Grid)[0];
                                    $My_Lon = explode(',', $listing->My_Grid)[1];

                                    $Their_Lat = explode(',', $listing->Their_Grid)[0];
                                    $Their_Lon = explode(',', $listing->Their_Grid)[1];

                                    // Maths for getting % out of 100 for progress bar width
                                    $conversion4Modulation = 10/5;
                                    $conversion4Signal = 10/9;

                                    // Definiranje različnih razredov barv za različne vrednosti
                                    $modSentColorClass = '';
                                    $sigSentColorClass = '';
                                    $modRcvdColorClass = '';
                                    $sigRcvdColorClass = '';

                                    if ($Mod_Sent == 1) {
                                        $modSentColorClass = 'bg-danger';
                                    } elseif ($Mod_Sent == 2) {
                                        $modSentColorClass = 'bg-warning';
                                    } elseif ($Mod_Sent == 3) {
                                        $modSentColorClass = 'bg-info';
                                    } elseif ($Mod_Sent == 4) {
                                        $modSentColorClass = 'bg-success';
                                    } elseif ($Mod_Sent == 5) {
                                        $modSentColorClass = 'bg-primary';
                                    }

                                    if ($Sig_Sent <= 2) {
                                        $sigSentColorClass = 'bg-danger';
                                    } elseif ($Sig_Sent > 2 && $Sig_Sent <= 4) {
                                        $sigSentColorClass = 'bg-warning';
                                    } elseif ($Sig_Sent > 4 && $Sig_Sent <= 6) {
                                        $sigSentColorClass = 'bg-info';
                                    } elseif ($Sig_Sent > 6 && $Sig_Sent <= 8) {
                                        $sigSentColorClass = 'bg-success';
                                    } elseif ($Sig_Sent > 8) {
                                        $sigSentColorClass = 'bg-primary';
                                    }

                                    if ($Mod_Rcvd == 1) {
                                        $modRcvdColorClass = 'bg-danger';
                                    } elseif ($Mod_Rcvd == 2) {
                                        $modRcvdColorClass = 'bg-warning';
                                    } elseif ($Mod_Rcvd == 3) {
                                        $modRcvdColorClass = 'bg-info';
                                    } elseif ($Mod_Rcvd == 4) {
                                        $modRcvdColorClass = 'bg-success';
                                    } elseif ($Mod_Rcvd == 5) {
                                        $modRcvdColorClass = 'bg-primary';
                                    }

                                    if ($Sig_Rcvd <= 2) {
                                        $sigRcvdColorClass = 'bg-danger';
                                    } elseif ($Sig_Rcvd > 2 && $Sig_Rcvd <= 4) {
                                        $sigRcvdColorClass = 'bg-warning';
                                    } elseif ($Sig_Rcvd > 4 && $Sig_Rcvd <= 6) {
                                        $sigRcvdColorClass = 'bg-info';
                                    } elseif ($Sig_Rcvd > 6 && $Sig_Rcvd <= 8) {
                                        $sigRcvdColorClass = 'bg-success';
                                    } elseif ($Sig_Rcvd > 8) {
                                        $sigRcvdColorClass = 'bg-primary';
                                    }
                                ?>

                                <h6 class="d-flex align-items-center mb-3 text-info font-weight-bold"><i class="material-icons mr-2">User sender:</i>{{$listing->My_Callsign}}</h6>
                                <small>RTS Modulation Sent:</small> <small class="text-primary ml-1 font-weight-bold">{{$Mod_Sent}}</small>
                                <div class="progress mb-3" style="height: 5px">
                                    <div class="progress-bar {{$modSentColorClass}}" role="progressbar" style="width: {{$Mod_Sent * 10 * $conversion4Modulation}}%" aria-valuenow="{{$Mod_Sent}}" aria-valuemin="0" aria-valuemax="5"></div>
                                </div>
                                <small>RTS Signal Strength Sent:</small> <small class="text-primary ml-1 font-weight-bold">{{$Sig_Sent}}</small>
                                <div class="progress mb-3" style="height: 5px">
                                    <div class="progress-bar {{$sigSentColorClass}}" role="progressbar" style="width: {{$Sig_Sent * 10 * $conversion4Signal}}%" aria-valuenow="{{$Sig_Sent}}" aria-valuemin="0" aria-valuemax="9"></div>
                                </div>
                                <div>
                                    <small>Sender Latitude:</small> <small class="text-primary ml-1 font-weight-bold">{{$My_Lat}}</small>
                                </div>
                                <div>
                                    <small>Sender Longitude:</small> <small class="text-primary ml-1 font-weight-bold">{{$My_Lon}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="d-flex align-items-center mb-3 text-success font-weight-bold"><i class="material-icons mr-2">User receiver:</i>{{$listing->Their_Callsign}}</h6>
                                <small>RTS Modulation Rcvd:</small> <small class="text-primary ml-1 font-weight-bold">{{$Mod_Rcvd}}</small>
                                <div class="progress mb-3" style="height: 5px">
                                    <div class="progress-bar {{$modRcvdColorClass}}" role="progressbar" style="width: {{$Mod_Rcvd * 10 * $conversion4Modulation}}%" aria-valuenow="{{$Mod_Rcvd}}" aria-valuemin="0" aria-valuemax="5"></div>
                                </div>
                                <small>RTS Signal Strength Rcvd:</small> <small class="text-primary ml-1 font-weight-bold">{{$Sig_Rcvd}}</small>
                                <div class="progress mb-3" style="height: 5px">
                                    <div class="progress-bar {{$sigRcvdColorClass}}" role="progressbar" style="width: {{$Sig_Rcvd * 10 * $conversion4Signal}}%" aria-valuenow="{{$Sig_Rcvd}}" aria-valuemin="0" aria-valuemax="9"></div>
                                </div>
                                <div>
                                    <small>Receiver Latitude:</small> <small class="text-primary ml-1 font-weight-bold">{{$Their_Lat}}</small>
                                </div>
                                <div>
                                    <small>Receiver Longitude:</small> <small class="text-primary ml-1 font-weight-bold">{{$Their_Lon}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Coordinates of My_Grid and Their_Grid
        var myGridCoords = ol.proj.fromLonLat([{{$listing->My_Grid}}].reverse());
        var theirGridCoords = ol.proj.fromLonLat([{{$listing->Their_Grid}}].reverse());

        // Calculate the extent of the line between My_Grid and Their_Grid
        var lineExtent = ol.extent.boundingExtent([myGridCoords, theirGridCoords]);

        // Calculate the center point between My_Grid and Their_Grid
        var centerCoords = [(myGridCoords[0] + theirGridCoords[0]) / 2, (myGridCoords[1] + theirGridCoords[1]) / 2];

        // OpenStreetMap view with center set to the middle point
        var map = new ol.Map({
            target: 'map',
            layers: [
                new ol.layer.Tile({
                    source: new ol.source.OSM()
                })
            ],
            view: new ol.View({
                center: centerCoords,
                zoom: 16
            })
        });

        // My marker
        var myMarker = new ol.Feature({
            geometry: new ol.geom.Point(myGridCoords)
        });

        // Their marker
        var theirMarker = new ol.Feature({
            geometry: new ol.geom.Point(theirGridCoords)
        });

        // Define icon style for markers, Icon must be in .png format not SVG!
        // Laravel pravila zahtevajo, da se ikone nahajajo v mapi public images
        var iconStyle = new ol.style.Style({
            image: new ol.style.Icon({
                anchor: [0.5, 1],
                src: "{{asset("/images/location-dot-solid-green.png")}}",
                scale: 0.06 // Pomanjšaj ikono
            })
        });

        var iconStyle2 = new ol.style.Style({
            image: new ol.style.Icon({
                anchor: [0.5, 1],
                src: "{{asset("/images/location-dot-solid-blue.png")}}",
                scale: 0.06 // Pomanjšaj ikono
            })
        });


        // Set icon style for markers
        myMarker.setStyle(iconStyle);
        theirMarker.setStyle(iconStyle2);

        // Define line feature between markers
        var lineFeature = new ol.Feature({
            geometry: new ol.geom.LineString([myGridCoords, theirGridCoords])
        });

        // Define line style
        var lineStyle = new ol.style.Style({
            stroke: new ol.style.Stroke({
                color: '#FF0000', // Red color
                width: 2 // Line width
            })
        });

        // Set line style for line feature
        lineFeature.setStyle(lineStyle);

        // Create vector source and layer for markers and line
        var vectorSource = new ol.source.Vector({
            features: [myMarker, theirMarker, lineFeature]
        });

        var vectorLayer = new ol.layer.Vector({
            source: vectorSource
        });

        // Add vector layer to map
        map.addLayer(vectorLayer);

        // Fit the map view to the extent of the line
        map.getView().fit(lineExtent, { padding: [100, 100, 100, 100], duration: 1000 }); // Padding is optional


        // Pridobi tip zveze
        var freqValue = {{$listing->Freq}};

        // Za PMR preveri, če je številka med 1 in 16
        if (/^\d+$/.test(freqValue) && parseInt(freqValue) >= 1 && parseInt(freqValue) <= 16) {
            document.getElementById("Freq").innerText = "PMR".concat(" CH", freqValue);
        }
        // Preveri, če je string v formatu "CB" + številka med 1 in 40
        else if (/^CB(\d+)$/.test(freqValue)) {
            var cbChannel = parseInt(freqValue.match(/^CB(\d+)$/)[1]); // Izvleči številko kanala
            document.getElementById("Freq").innerText = "CB".concat(" CH", freqValue);
        }
        // Če ni PMR ali CB, je Ham
        else {
            document.getElementById("Freq").innerText = freqValue.concat( "MHz");
        }
    });
</script>



