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
            font-size: 1.1rem;
        }
        #date-range-picker {
            margin-top: 10px;
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
                                        <div class="panel-heading" role="tab" id="headingFiveMobile">
                                            <a class="panel-title accordion-toggle collapsed" role="button" data-toggle="collapse" data-parent="#filter-menu-mobile" href="#collapseFiveMobile" aria-expanded="false" aria-controls="collapseFiveMobile">
                                                Event
                                            </a>
                                        </div>
                                        <div id="collapseFiveMobile" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFiveMobile">
                                            <div class="panel-body">
                                                <div class="checkbox"><label><input type="checkbox" name="event[]" value="simplex_window">Simplex Window</label></div>
                                                <div class="checkbox"><label><input type="checkbox" name="event[]" value="weekly_net">Weekly Net</label></div>
                                                <div class="checkbox"><label><input type="checkbox" name="event[]" value="sota">(pmr) SOTA</label></div>
                                                <div class="checkbox"><label><input type="checkbox" name="event[]" value="classic">Classic</label></div>
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
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="range[]" value="local" class="format-checkbox">Local (<5km)
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="range[]" value="medium" class="format-checkbox">Medium (<25km)
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="range[]" value="long_range" class="format-checkbox">Long range (>25km)
                                                    </label>
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
                                                    <label><input type="checkbox" name="date[]" value="today" class="format-checkbox">Today</label>
                                                </div>
                                                <div class="checkbox">
                                                    <label><input type="checkbox" name="date[]" value="this_week" class="format-checkbox">This week</label>
                                                </div>
                                                <div class="checkbox">
                                                    <label><input type="checkbox" name="date[]" value="this_month" class="format-checkbox">This month</label>
                                                </div>
                                                <div class="checkbox">
                                                    <label><input type="checkbox" name="date[]" value="this_year" class="format-checkbox">This year</label>
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
                    <h6 class="d-flex align-items-center mb-3 text-info font-weight-bold">
                        <i class="material-icons mr-2">Query info:</i>
                    </h6>
                    <div>
                        <small id="qso-count">Showing {{$total}} QSOs</small>
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
    $.noConflict();

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
        var contacts = @json($listings);

        const map = L.map("map");
        map.setView([46.1, 14.7], 8);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        const customIcon_green = L.icon({
            iconUrl: '/images/location-dot-solid-green.png',
            iconSize: [30, 30], // Width and height of the icon
            iconAnchor: [15, 30] // Point of the icon which will correspond to marker's location
        });

        const customIcon_blue = L.icon({
            iconUrl: '/images/location-dot-solid-blue.png',
            iconSize: [30, 30], // Width and height of the icon
            iconAnchor: [15, 30] // Point of the icon which will correspond to marker's location
        });

        showOnMap(contacts);

        function showOnMap(contacts) {
            // Reset zemljevida
            map.eachLayer(function (layer) {
                if (!!layer.toGeoJSON) {
                    map.removeLayer(layer);
                }
            });

            contacts.forEach(function(contact) {
                // Pretvori koordinate iz niza v številke
                var myGridArray = contact.My_Grid.split(",").map(Number);
                var theirGridArray = contact.Their_Grid.split(",").map(Number);

                // Izriši marker za My_Grid
                L.marker(myGridArray, {
                    title: contact.My_Callsign,
                    icon: customIcon_green
                })
                    .bindPopup(`
                <span class="popup">
                    <b>Klicatelj:</b> <a href="users/2/user-profile">${contact.My_Callsign}<br>
                </span>
            `)
                    .addTo(map);

                // Izriši marker za Their_Grid
                L.marker(theirGridArray, {
                    title: contact.Their_Callsign,
                    icon: customIcon_blue
                })
                    .bindPopup(`
                <span class="popup">
                    <b>Prejemnik:</b> <a href="/users/2/user-profile" target="_blank">${contact.Their_Callsign}</a><br>
                </span>
            `)
                    .addTo(map);

                // Izriši črto med točkama
                L.polyline([myGridArray, theirGridArray], {
                    color: 'red'
                })
                    .bindPopup(`
                <span class="popup">
                    <b>Klicatelj:</b> ${contact.My_Callsign}<br>
                    <b>Prejemnik:</b> ${contact.Their_Callsign}<br>
                    <b>RST Sent:</b> ${contact.RST_Sent}<br>
                    <b>RST Received:</b> ${contact.RST_Rcvd}<br>
                    <b>Date:</b> ${contact.Date_Time}<br>
                    <b>Frequency:</b> ${contact.Freq}
                </span>
            `)
                    .addTo(map);
            });
        }

        // Funkcija za posodabljanje števila prikazanih QSOs
        function updateQSOCount(count) {
            document.getElementById('qso-count').innerHTML = `Showing ${count} QSOs`;
        }

        document.getElementById('ApplyFilters').addEventListener('click', function() {
            // Pridobi vse izbrane vrednosti checkboxov
            let qsoTypes = Array.from(document.querySelectorAll('input[name="qso_type[]"]:checked')).map(filter => filter.value);
            let showOptions = Array.from(document.querySelectorAll('input[name="callsign[]"]:checked')).map(filter => filter.value);
            let events = Array.from(document.querySelectorAll('input[name="event[]"]:checked')).map(filter => filter.value);
            let ranges = Array.from(document.querySelectorAll('input[name="range[]"]:checked')).map(filter => filter.value);
            let dates = Array.from(document.querySelectorAll('input[name="date[]"]:checked')).map(filter => filter.value);

            // console.log(qsoTypes, showOptions, events, ranges, dates);

            // Filtriraj objave glede na izbrane filtre
            let filteredContacts = contacts.filter(contact => {
                // Filtriranje glede na QSO type
                if (qsoTypes.length && !qsoTypes.includes(contact.QSO_Type)) {
                    return false;
                }

                // Filtriranje glede na "Event"
                if (events.length && !events.includes(contact.Event_type)) {
                    return false;
                }

                // Filtriranje glede na "Show" (uporabnikove ali javne)
                if (showOptions.length) {
                    if (showOptions.includes('mine') && contact.My_Callsign !== "{{auth()->user()->name}}") {
                        return false;
                    }
                    const callsignInput = document.getElementById('callsign_input').value;
                    if (callsignInput && contact.My_Callsign !== callsignInput) {
                        return false;
                    }
                }

                // Filtriranje glede na "Range"
                if (ranges.length) {
                    const qsoRange = parseFloat(contact.QSO_Range);
                    if (ranges.includes('local') && qsoRange > 5) {
                        return false;
                    }
                    if (ranges.includes('medium') && (qsoRange <= 5 || qsoRange > 25)) {
                        return false;
                    }
                    if (ranges.includes('long_range') && qsoRange <= 25) {
                        return false;
                    }
                }

                // Filtriranje glede na "Date"
                if (dates.length) {
                    const contactDate = new Date(contact.Date_Time);

                    if (dates.includes('today')) {
                        const today = new Date();
                        if (contactDate.toDateString() !== today.toDateString()) {
                            return false;
                        }
                    }

                    if (dates.includes('this_week')) {
                        const startOfWeek = new Date();
                        startOfWeek.setDate(startOfWeek.getDate() - startOfWeek.getDay()); // Začetek tedna
                        const endOfWeek = new Date(startOfWeek);
                        endOfWeek.setDate(endOfWeek.getDate() + 6); // Konec tedna
                        if (contactDate < startOfWeek || contactDate > endOfWeek) {
                            return false;
                        }
                    }

                    if (dates.includes('this_month')) {
                        const today = new Date();
                        const startOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
                        const endOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);
                        if (contactDate < startOfMonth || contactDate > endOfMonth) {
                            return false;
                        }
                    }

                    if (dates.includes('this_year')) {
                        const today = new Date();
                        const startOfYear = new Date(today.getFullYear(), 0, 1);
                        const endOfYear = new Date(today.getFullYear(), 11, 31);
                        if (contactDate < startOfYear || contactDate > endOfYear) {
                            return false;
                        }
                    }

                    if (dates.includes('choose_date')) {
                        const startDate = new Date(document.getElementById('start-date').value);
                        const endDate = new Date(document.getElementById('end-date').value);
                        if (contactDate < startDate || contactDate > endDate) {
                            return false;
                        }
                    }
                }

                return true;
            });

            // Posodobi številko QSOs na podlagi filtriranih kontaktov
            updateQSOCount(filteredContacts.length);

            // Prikaži filtrirane rezultate v konzoli (za testiranje)
            // console.log("Filtered: ", filteredContacts);

            // Kasneje lahko posodobiš DOM ali prikažeš rezultate na spletni strani
            // npr. osvežiš seznam prikazanih objav
            showOnMap(filteredContacts);
        });

        // Gumb za ponastavitev filtrov
        document.getElementById('ClearSelections').addEventListener('click', function() {
            // console.log("Cleared: ", contacts);

            // Ponastavi filtre (primer)
            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => checkbox.checked = false);
            document.getElementById('callsign_input').value = '';

            // Ponovno izvedi funkcijo za prikaz vseh kontaktov
            updateQSOCount(contacts.length);

            // Osveži zemljevid z vsemi kontakti
            showOnMap(contacts);
        });
    });
</script>
</body>
</html>

{{--TO:DO barva črte med točkama odvisna od sum rst_sent + rst_rcvd vrednosti, spremeni ikone na različne za prejemnika in oddajnika, lahko so to neke antence. filtering. črte zaobljene --}}
