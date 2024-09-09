<!DOCTYPE html>
<html lang="en">
<head>
    <title>Filter Menu Panel Group with Bootstrap</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="https://openlayers.org/en/v6.5.0/css/ol.css" type="text/css">
    <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v6.5.0/build/ol.js"></script>
    <style>
        .primary {
            min-height: 800px;
        }
        .panel-heading {
            position: relative;
        }
        .panel-heading .accordion-toggle:after {
            font-family: 'Glyphicons Halflings';
            content: "\e260";
            position: absolute;
            right: 16px;
        }
        .panel-heading .accordion-toggle.collapsed:after {
            font-family: 'Glyphicons Halflings';
            content: "\e259";
        }
        .filter-menu .panel {
            border-radius: 0;
            border: 1px solid #eeeeee;
        }
        .filter-menu .panel-heading {
            background: #fff;
            padding: 0;
        }
        .filter-menu .panel-title {
            color: #333333;
            font-weight: bold;
            display: block;
            padding: 16px;
        }
        .filter-menu a.panel-title {
            color: #333333;
        }
        .filter-menu a.panel-title:hover,
        .filter-menu a.panel-title:focus {
            color: #333333;
            text-decoration: none;
        }
        .filter-menu .panel-body {
            padding: 16px;
        }
        .filter-menu .panel-group {
            margin: -16px;
        }
        .filter-menu .panel-group .panel-title {
            background: #eee;
            transition: color, 0.5s, ease;
        }
        .filter-menu .panel-group .panel-title:hover {
            color: #333333;
            text-decoration: none;
            background: #777777;
        }
        .filter-menu .panel-group .panel + .panel {
            margin-top: 0;
        }
        .filter-menu.mobile .btn-link {
            color: #f9f9f9;
        }
        .filter-menu.mobile hr {
            margin-top: 0;
            border-top-color: #4B6473;
        }
        .filter-menu.mobile .panel-group .panel-heading + .panel-collapse > .panel-body {
            border-color: #4B6473;
        }
        .filter-menu.mobile .panel {
            border-color: #4B6473;
            background: #30404a;
            color: #f9f9f9;
        }
        .filter-menu.mobile .panel-heading {
            background: #30404a;
        }
        .filter-menu.mobile a.panel-title {
            color: #f9f9f9;
        }
        .filter-menu.mobile a.panel-title:hover {
            color: #f9f9f9;
        }
        .filter-menu.mobile .panel-group .panel {
            border-color: #4B6473;
        }
        .filter-menu.mobile .panel-group .panel-title {
            background: #3f5460;
        }
        .filter-menu.mobile .panel-group .panel-title:hover {
            color: #f9f9f9;
            background: #30404a;
        }
        html {
            position: relative;
            min-height: 100%;
        }
        body {
            margin-bottom: 60px;
        }

        .ol-popup {
            position: absolute;
            background-color: white;
            -webkit-filter: drop-shadow(0 1px 4px rgba(0,0,0,0.2));
            filter: drop-shadow(0 1px 4px rgba(0,0,0,0.2));
            padding: 15px;
            border-radius: 10px;
            border: 1px solid #cccccc;
            bottom: 12px;
            left: -50px;
            min-width: 280px;
        }
        .ol-popup:after, .ol-popup:before {
            top: 100%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }
        .ol-popup:after {
            border-top-color: white;
            border-width: 10px;
            left: 48px;
            margin-left: -10px;
        }
        .ol-popup:before {
            border-top-color: #cccccc;
            border-width: 11px;
            left: 48px;
            margin-left: -11px;
        }
        .ol-popup-closer {
            text-decoration: none;
            position: absolute;
            top: 2px;
            right: 8px;
        }
        .ol-popup-closer:after {
            content: "✖";
        }
        .popup {
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
<header class="header">
    <div class="container">
    </div>
</header>

<div class="primary">
    <div class="container">

        <br>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Contact</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact Detail</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->

        <div class="row">

            <div class="col-xs-3">
                <div class="filter-menu mobile">
                    <form>
                        <div class="panel panel-mobile">
                            <div class="panel-heading" role="tab" id="headingFiltersMobile">
                                <a class="panel-title accordion-toggle" role="button" data-toggle="collapse" href="#collapseFiltersMobile" aria-expanded="false" aria-controls="collapseFiltersMobile">
                                    Filter
                                </a>
                                <div class="panel-body">
                                    <hr />
                                    <button class="btn btn-primary" type="submit">Apply Filters</button>
                                    <a class="btn btn-sm btn-link pull-right" href="#">Clear Selections</a>
                                </div>
                            </div>
                            <div id="collapseFiltersMobile" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFiltersMobile">
                                <div class="panel-body">
                                    <div class="panel-group" id="filter-menu-mobile" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-mobile">
                                            <div class="panel-heading" role="tab" id="headingOneMobile">
                                                <a class="panel-title accordion-toggle" role="button" data-toggle="collapse" data-parent="#filter-menu-mobile" href="#collapseOneMobile" aria-expanded="true" aria-controls="collapseOneMobile">
                                                    QSO type
                                                </a>
                                            </div>
                                            <div id="collapseOneMobile" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOneMobile">
                                                <div class="panel-body">
                                                    <div class="checkbox"><label><input type="checkbox" name="career_state[]" value="recent_graduate">PMR446</label></div>
                                                    <div class="checkbox"><label><input type="checkbox" name="career_state[]" value="imposter_syndrome">CB</label></div>
                                                    <div class="checkbox"><label><input type="checkbox" name="career_state[]" value="wise_old_head">Ham radio</label></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-mobile">
                                            <div class="panel-heading" role="tab" id="headingTwoMobile">
                                                <a class="panel-title accordion-toggle collapsed" role="button" data-toggle="collapse" data-parent="#filter-menu-mobile" href="#collapseTwoMobile" aria-expanded="false" aria-controls="collapseTwoMobile">
                                                    Show
                                                </a>
                                            </div>
                                            <div id="collapseTwoMobile" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwoMobile">
                                                <div class="panel-body">
                                                    <div class="checkbox"><label><input type="checkbox" name="topic[]" value="politics">Mine only</label></div>
                                                    <div class="checkbox"><label><input type="checkbox" name="topic[]" value="religion">Public</label></div>
                                                    <div class="checkbox"><label><input type="checkbox" name="topic[]" value="music">By Callsign:</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-mobile">
                                            <div class="panel-heading" role="tab" id="headingThreeMobile">
                                                <a class="panel-title accordion-toggle collapsed" role="button" data-toggle="collapse" data-parent="#filter-menu-mobile" href="#collapseThreeMobile" aria-expanded="false" aria-controls="collapseThreeMobile">
                                                    Range (CB/PMR446)
                                                </a>
                                            </div>
                                            <div id="collapseThreeMobile" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThreeMobile">
                                                <div class="panel-body">
                                                    <div class="checkbox"><label><input type="checkbox" name="format[]" value="magazine">Local (<5km)</label></div>
                                                    <div class="checkbox"><label><input type="checkbox" name="format[]" value="website">Medium (<25km)</label></div>
                                                    <div class="checkbox"><label><input type="checkbox" name="format[]" value="vine">Long range (>25km)</label></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-mobile">
                                            <div class="panel-heading" role="tab" id="headingFourMobile">
                                                <a class="panel-title accordion-toggle collapsed" role="button" data-toggle="collapse" data-parent="#filter-menu-mobile" href="#collapseFourMobile" aria-expanded="false" aria-controls="collapseFourMobile">
                                                    Date
                                                </a>
                                            </div>
                                            <div id="collapseFourMobile" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFourMobile">
                                                <div class="panel-body">
                                                    <div class="checkbox"><label><input type="checkbox" name="status[]" value="single">Today</label></div>
                                                    <div class="checkbox"><label><input type="checkbox" name="status[]" value="in_a_relationship">Yesterday</label></div>
                                                    <div class="checkbox"><label><input type="checkbox" name="status[]" value="engaged">This week</label></div>
                                                    <div class="checkbox"><label><input type="checkbox" name="status[]" value="married">This month</label></div>
                                                    <div class="checkbox"><label><input type="checkbox" name="status[]" value="its_complicated">This year</label></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div>
                    <h6 class="d-flex align-items-center mb-3 text-info font-weight-bold"><i class="material-icons mr-2">Query info:</i></h6>
                    <div>
                        <small>Showing {{$total}} User locations</small> <small class="text-primary font-weight-bold"></small>
                    </div>
                    <div>
                        {{-- TO:DO dodaj druge računovodske informacije --}}
                    </div>
                </div>
            </div>

            <div class="col-xs-9">
                {{-- MAP --}}
                <div id="map" class="map" style="height: 750px;"></div>
                {{-- END OF MAP --}}
            </div>

        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.primary -->
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Listings data passed from Blade to JavaScript
        var spots = @json($spots);

        const map = L.map("map");
        map.setView([46.1, 14.7], 8);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        const customIcon_portable = L.icon({
            iconUrl: '/images/mountain-solid.png',
            iconSize: [20]
        });

        const customIcon_mobile = L.icon({
            iconUrl: '/images/car-solid.png',
            iconSize: [18]
        });

        const customIcon_qth = L.icon({
            iconUrl: '/images/house-signal-solid.png',
            iconSize: [20]
        });

        const customIcon_drugo = L.icon({
            iconUrl: '/images/location-dot-solid-green.png',
            iconSize: [20]
        });

        // console.log(spots);

        spots.forEach(function(spot) {
            if (spot.location != null) {
                // Pretvori koordinate iz niza v številke
                var myGridArray = spot.location.split(",").map(Number);

                var icon = null;
                if (spot.type == "portable") {
                    icon = customIcon_portable;
                }
                else if (spot.type == "mobile") {
                    icon = customIcon_mobile;
                }
                else if (spot.type == "qth") {
                    icon = customIcon_qth;
                }
                else {
                    icon = customIcon_drugo;
                }

                // Izriši marker za My_Grid
                L.marker(myGridArray, {
                    title: spot.activation_callsign,
                    icon: icon
                })
                .bindPopup(`
                    <span class="popup">
                        <b>Activator:</b> ${spot.activation_callsign}<br>
                        <b>Spotted by:</b> ${spot.spotter_id}<br>
                        <b>Frequency:</b> ${spot.frequency}<br>
                        <b>Mode:</b> ${spot.mode}<br>
                        <b>Time:</b> ${spot.time}<br>
                        <b>Type:</b> ${spot.type}<br>
                        <b>Comments:</b> ${spot.comments}<br>
                        <b>Spotted at:</b> ${spot.created_at}<br>
                    </span>
                `)
                .addTo(map);
            }
        });
    });
</script>
</body>
</html>

