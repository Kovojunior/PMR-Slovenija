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
        .filter-buttons {
            display: flex;
            justify-content: space-between; /* Postavi gumba levo in desno */
            margin-top: 15px; /* Malo odmika zgoraj za vizualno razdaljo */
        }
        .filter-buttons button {
            width: 48%; /* Vsak gumb bo imel približno polovico širine */
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
                    <div class="panel panel-mobile">
                        <div class="panel-heading" role="tab" id="headingFiltersMobile">
                            <a class="panel-title accordion-toggle" role="button" data-toggle="collapse" href="#collapseFiltersMobile" aria-expanded="false" aria-controls="collapseFiltersMobile">
                                Filter
                            </a>
                        </div>
                        <!-- Dodan flex container za gumba -->
                        <div class="panel-body filter-buttons">
                            <button class="btn btn-primary" type="submit" id="ApplyFilters">Apply</button>
                            <button class="btn btn-danger" type="button" id="ClearSelections">Clear</button>
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
                                                <div class="checkbox"><label><input type="checkbox" name="qso_type[]" value="PMR446">PMR446</label></div>
                                                <div class="checkbox"><label><input type="checkbox" name="qso_type[]" value="CB">CB</label></div>
                                                <div class="checkbox"><label><input type="checkbox" name="qso_type[]" value="Ham">Ham radio</label></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-mobile">
                                        <div class="panel-heading" role="tab" id="headingFiveMobile">
                                            <a class="panel-title accordion-toggle collapsed" role="button" data-toggle="collapse" data-parent="#filter-menu-mobile" href="#collapseFiveMobile" aria-expanded="false" aria-controls="collapseFiveMobile">
                                                Spot type
                                            </a>
                                        </div>
                                        <div id="collapseFiveMobile" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFiveMobile">
                                            <div class="panel-body">
                                                <div class="checkbox"><label><input type="checkbox" name="spot_type[]" value="portable">Portable</label></div>
                                                <div class="checkbox"><label><input type="checkbox" name="spot_type[]" value="mobile">Mobile</label></div>
                                                <div class="checkbox"><label><input type="checkbox" name="spot_type[]" value="qth">Home location (QTH)</label></div>
                                                <div class="checkbox"><label><input type="checkbox" name="spot_type[]" value="other">Other</label></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-mobile">
                                        <div class="panel-heading" role="tab" id="headingThreeMobile">
                                            <a class="panel-title accordion-toggle collapsed" role="button" data-toggle="collapse" data-parent="#filter-menu-mobile" href="#collapseThreeMobile" aria-expanded="false" aria-controls="collapseThreeMobile">
                                                Mode
                                            </a>
                                        </div>
                                        <div id="collapseThreeMobile" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThreeMobile">
                                            <div class="panel-body">
                                                <div class="checkbox"><label><input type="checkbox" name="spot_mode[]" value="fm">FM</label></div>
                                                <div class="checkbox"><label><input type="checkbox" name="spot_mode[]" value="am">AM</label></div>
                                                <div class="checkbox"><label><input type="checkbox" name="spot_mode[]" value="ssb">SSB</label></div>
                                                <div class="checkbox"><label><input type="checkbox" name="spot_mode[]" value="digital">Digital</label></div>
                                                <div class="checkbox"><label><input type="checkbox" name="spot_mode[]" value="other">Other</label></div>
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
                                                <div class="checkbox"><label><input type="checkbox" name="callsign[]" value="mine">Mine only</label></div>
                                                <div class="checkbox"><label><input type="checkbox" name="callsign[]" value="callsign">By Callsign:</label>
                                                    <input type="text" class="form-control" id="callsign_input">
                                                </div>
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
                                                <div class="checkbox">
                                                    <label><input type="checkbox" name="date[]" value="today">Today</label>
                                                </div>
                                                <div class="checkbox">
                                                    <label><input type="checkbox" name="date[]" value="this_week">This week</label>
                                                </div>
                                                <div class="checkbox">
                                                    <label><input type="checkbox" name="date[]" value="this_month">This month</label>
                                                </div>
                                                <div class="checkbox">
                                                    <label><input type="checkbox" name="date[]" value="this_year">This year</label>
                                                </div>
                                                <!-- Checkbox za izbiro datuma -->
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" id="choose-date-checkbox" name="date[]" value="choose_date">Choose date
                                                    </label>
                                                </div>
                                                <!-- Dve polji za izbiro datuma (skrito dokler ni checkbox izbran) -->
                                                <div id="date-range-picker" style="display: none;">
                                                    <label for="start-date">Start Date:</label>
                                                    <input type="text" id="start-date" name="start_date" placeholder="Select start date">

                                                    <label for="end-date">End Date:</label>
                                                    <input type="text" id="end-date" name="end_date" placeholder="Select end date">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h6 class="d-flex align-items-center mb-3 text-info font-weight-bold"><i class="material-icons mr-2">Query info:</i></h6>
                    <div>
                        <small id="spot-count">Showing {{$total}} User locations</small> <small class="text-primary font-weight-bold"></small>
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
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<!-- Flatpickr JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Pridobi vse checkbox elemente
        const checkboxes = document.querySelectorAll('.format-checkbox');

        // Dodaj event listener za vsak checkbox
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                // Če je checkbox označen, odznači vse druge
                if (this.checked) {
                    checkboxes.forEach(function(box) {
                        if (box !== checkbox) {
                            box.checked = false;
                        }
                    });
                }
            });
        });

        // Funkcionalnost za "Clear Selections"
        document.getElementById('ClearSelections').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false; // Odznači vse checkboxe
            });
        });

        // Ko je checkbox "Choose date" izbran, pokaži polji za izbiro datuma
        document.getElementById('choose-date-checkbox').addEventListener('change', function() {
            var dateRangePicker = document.getElementById('date-range-picker');
            if (this.checked) {
                dateRangePicker.style.display = 'block'; // Pokaži polji za izbiro datuma
            } else {
                dateRangePicker.style.display = 'none'; // Skrij polji za izbiro datuma
            }
        });

        // TO:DO popravi prikaz. Trenutno se uporabnikova izbira NE prikaže v vnosnem polju. Verjetno konflikt med knjižnicami!
        // Uporabi Flatpickr za oba input polja
        flatpickr("#start-date", {
            dateFormat: "Y-m-d", // Format datuma
            allowInput: true,
            onChange: function(selectedDates, dateStr, instance) {
                console.log("Začetni datum: " + dateStr);
                document.getElementById('start-date').setAttribute('data-selected-date', dateStr); // Shrani datum kot atribut
            }
        });

        flatpickr("#end-date", {
            dateFormat: "Y-m-d",
            allowInput: true,
            onChange: function(selectedDates, dateStr, instance) {
                console.log("Končni datum: " + dateStr);
                document.getElementById('end-date').setAttribute('data-selected-date', dateStr); // Shrani datum kot atribut
            }
        });

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

        showOnMap(spots);

        function showOnMap(spots) {
            // console.log(spots);
            // Reset zemljevida
            map.eachLayer(function (layer) {
                if (!!layer.toGeoJSON) {
                    map.removeLayer(layer);
                }
            });

            spots.forEach(function(spot) {
                if (spot.location && spot.location.includes(",")) {
                    var myGridArray = spot.location.split(",").map(Number);
                    if (!isNaN(myGridArray[0]) && !isNaN(myGridArray[1])) {
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
                    } else {
                        console.error('Invalid coordinates:', myGridArray);
                    }
                } else {
                    console.error('No valid location for spot:', spot);
                }
            });
        }

        // Funkcija za posodabljanje števila prikazanih QSOs
        function updateSpotCount(count) {
            document.getElementById('spot-count').innerHTML = `Showing ${count} QSOs`;
        }

        document.getElementById('ApplyFilters').addEventListener('click', function() {
            // Pridobi vse izbrane vrednosti checkboxov
            let qsoTypes = Array.from(document.querySelectorAll('input[name="qso_type[]"]:checked')).map(filter => filter.value);
            let spotTypes = Array.from(document.querySelectorAll('input[name="spot_type[]"]:checked')).map(filter => filter.value);
            let spotModes = Array.from(document.querySelectorAll('input[name="spot_mode[]"]:checked')).map(filter => filter.value);
            let showOptions = Array.from(document.querySelectorAll('input[name="callsign[]"]:checked')).map(filter => filter.value);
            let dates = Array.from(document.querySelectorAll('input[name="date[]"]:checked')).map(filter => filter.value);

            console.log(qsoTypes, spotTypes, spotModes, showOptions, dates);

            // Filtriraj objave glede na izbrane filtre
            let filteredSpots = spots.filter(spot => {
                // Filtriranje glede na QSO type
                if (qsoTypes.length && !qsoTypes.includes(spot.QSO_type)) {
                    return false;
                }

                // Filtriranje glede na "Spot type"
                if (spotTypes.length && !spotTypes.includes(spot.type)) {
                    return false;
                }

                // Filtriranje glede na "Show" (uporabnikove ali javne)
                if (showOptions.length) {
                    if (showOptions.includes('mine') && spot.activation_callsign !== "{{auth()->user()->name}}") {
                        return false;
                    }
                    const callsignInput = document.getElementById('callsign_input').value;
                    if (callsignInput && spot.activation_callsign !== callsignInput) {
                        return false;
                    }
                }

                // Filtriranje glede na "Spot mode"
                if (spotModes.length && !spotModes.includes(spot.mode)) {
                    return false;
                }

                // Filtriranje glede na "Date"
                if (dates.length) {
                    const spotDate = new Date(spot.Date_Time);

                    if (dates.includes('today')) {
                        const today = new Date();
                        if (spotDate.toDateString() !== today.toDateString()) {
                            return false;
                        }
                    }

                    if (dates.includes('this_week')) {
                        const startOfWeek = new Date();
                        startOfWeek.setDate(startOfWeek.getDate() - startOfWeek.getDay()); // Začetek tedna
                        const endOfWeek = new Date(startOfWeek);
                        endOfWeek.setDate(endOfWeek.getDate() + 6); // Konec tedna
                        if (spotDate < startOfWeek || spotDate > endOfWeek) {
                            return false;
                        }
                    }

                    if (dates.includes('this_month')) {
                        const today = new Date();
                        const startOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
                        const endOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);
                        if (spotDate < startOfMonth || spotDate > endOfMonth) {
                            return false;
                        }
                    }

                    if (dates.includes('this_year')) {
                        const today = new Date();
                        const startOfYear = new Date(today.getFullYear(), 0, 1);
                        const endOfYear = new Date(today.getFullYear(), 11, 31);
                        if (spotDate < startOfYear || spotDate > endOfYear) {
                            return false;
                        }
                    }

                    if (dates.includes('choose_date')) {
                        const startDate = new Date(document.getElementById('start-date').value);
                        const endDate = new Date(document.getElementById('end-date').value);
                        if (spotDate < startDate || spotDate > endDate) {
                            return false;
                        }
                    }
                }
                return true;
            });

            // Posodobi številko QSOs na podlagi filtriranih kontaktov
            updateSpotCount(filteredSpots.length);

            // Prikaži filtrirane rezultate v konzoli (za testiranje)
            // console.log("Filtered: ", filteredContacts);

            // Kasneje lahko posodobiš DOM ali prikažeš rezultate na spletni strani
            // npr. osvežiš seznam prikazanih objav
            showOnMap(filteredSpots);
        });

        // Gumb za ponastavitev filtrov
        document.getElementById('ClearSelections').addEventListener('click', function() {
            // console.log("Cleared: ", spots);

            // Ponastavi filtre (primer)
            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => checkbox.checked = false);
            document.getElementById('callsign_input').value = '';

            // Ponovno izvedi funkcijo za prikaz vseh kontaktov
            updateSpotCount(spots.length);

            // Osveži zemljevid z vsemi kontakti
            showOnMap(spots);
        });
    });
</script>
</body>
</html>

