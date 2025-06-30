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
        var dateRangePicker = document.getElementById('date-range-picker');
        dateRangePicker.style.display = 'none';
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

    const map = L.map("map");
    map.setView([46.1, 14.7], 8);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    const customIcon_portable = L.icon({
        iconUrl: '/images/mountain-solid.png',
        iconSize: [20, 20],
        iconAnchor: [10, 20]
    });

    const customIcon_mobile = L.icon({
        iconUrl: '/images/car-solid.png',
        iconSize: [20, 20],
        iconAnchor: [10, 20]
    });

    const customIcon_qth = L.icon({
        iconUrl: '/images/house-signal-solid.png',
        iconSize: [20, 20],
        iconAnchor: [10, 20]
    });

    const customIcon_drugo = L.icon({
        iconUrl: '/images/location-dot-solid-green.png',
        iconSize: [20, 20],
        iconAnchor: [10, 20]
    });

    const customIcon_alert = L.icon({
        iconUrl: '/images/alert.png',
        iconSize: [20, 20],
        iconAnchor: [10, 20]
    });

    filter(spots);

    // Funkcija za pretvorbo time vrednosti v milisekunde
    function getTimeDurationInMillis(time) {
        if (time === '15min') return 15 * 60 * 1000;       // 15 minut
        if (time === '1h') return 60 * 60 * 1000;          // 1 ura
        if (time === '1day') return 24 * 60 * 60 * 1000;   // 1 dan
        if (time === 'infinite') return 365 * 24 * 60 * 60 * 1000;  // 1 leto
        return 0;
    }

    // Funkcija za preverjanje, ali je spot še aktiven
    function isSpotActive(spot) {
        const spotUpdatedAt = new Date(spot.updated_at);    // Čas, ko je bil spot dodan/posodobljen
        const currentTime = new Date();                    // Trenutni čas
        const duration = getTimeDurationInMillis(spot.time); // Trajanje aktivnega spota v milisekundah
        if (duration === 0) return false;  // Če je neznano trajanje, spot ni aktiven
        // Preverimo, če je spot še aktiven
        return (currentTime - spotUpdatedAt <= duration);
    }

    function showOnMap(spots) {
        // Reset zemljevida
        map.eachLayer(function (layer) {
            if (!!layer.toGeoJSON) {
                map.removeLayer(layer);
            }
        });
        spots.forEach(function (spot) {
            // Preverimo, ali je spot aktiven ali je checkbox "Show inactive" označen
            if (spot.location && spot.location.includes(",")) {
                var myGridArray = spot.location.split(",").map(Number);

                // Preveri, če je spot.type "portable" ali "mobile" za utripajočo rdečo ikono
                var redCircleIcon = L.divIcon({
                    className: spot.type === "portable" || spot.type === "mobile" ? 'red-circle-icon blinking' : 'red-circle-icon',
                    html: '<div style="width: 10px; height: 10px; border: 2px solid red; border-radius: 50%; background-color: white;"></div>',
                    iconSize: [10, 10], // Velikost pike
                    iconAnchor: [5, 5]  // Središče pike
                });

                // Prikaži rdečo piko na My_Grid
                L.marker(myGridArray, {
                    icon: redCircleIcon
                }).addTo(map);

                // Preverimo, če sta obe koordinati veljavni številki
                if (!isNaN(myGridArray[0]) && !isNaN(myGridArray[1])) {
                    var icon = null;
                    if (spot.time === "alert") {
                        icon = customIcon_alert;
                    } else if (spot.type === "portable") {
                        icon = customIcon_portable;
                    } else if (spot.type === "mobile") {
                        icon = customIcon_mobile;
                    } else if (spot.type === "qth") {
                        icon = customIcon_qth;
                    } else {
                        icon = customIcon_drugo;  // Default icon for other types
                    }

                    L.marker(myGridArray, {
                        title: spot.activation_callsign,
                        icon: icon,  // Uporabi izbrano ikono
                        iconAnchor: [-15, 30]
                    })
                        .bindPopup(`
                <span class="popup">
                    <b>Activator:</b> ${spot.activation_callsign}<br>
                    <b>Spotted by:</b> ${spot.spotter_id}<br>
                    <b>Frequency:</b> ${spot.frequency}<br>
                    <b>QSO type</b> ${spot.Qso_type}<br>
                    <b>Mode:</b> ${spot.mode}<br>
                    <b>Spot Type:</b> ${spot.type}<br>
                    <b>Time:</b> ${spot.time}<br>
                    <b>Spotted at:</b> ${spot.created_at}<br>
                    <b>Comments:</b> ${spot.comments}<br>
                </span>
            `).addTo(map);
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
        document.getElementById('spot-count').innerHTML = `${count}`;
    }

    document.getElementById('ApplyFilters').addEventListener('click', filter);
    function filter() {
        // Pridobi vse izbrane vrednosti checkboxov
        let qsoTypes = Array.from(document.querySelectorAll('input[name="qso_type[]"]:checked')).map(filter => filter.value);
        let spotTypes = Array.from(document.querySelectorAll('input[name="spot_type[]"]:checked')).map(filter => filter.value);
        let spotModes = Array.from(document.querySelectorAll('input[name="spot_mode[]"]:checked')).map(filter => filter.value);
        let showOptions = Array.from(document.querySelectorAll('input[name="callsign[]"]:checked')).map(filter => filter.value);
        let dates = Array.from(document.querySelectorAll('input[name="date[]"]:checked')).map(filter => filter.value);
        // Preverimo stanje show inactive
        const showInactive = document.querySelector('input[name="callsign[]"][value="inactive"]').checked;
        // console.log(qsoTypes, spotTypes, spotModes, showOptions, dates);

        // Filtriraj objave glede na izbrane filtre
        let filteredSpots = spots.filter(spot => {
            // Preverjanje aktivnosti spota
            const isActive = isSpotActive(spot);

            // Preverjanje stanja checkboxa "Show inactive"
            const showInactive = document.querySelector('input[name="callsign[]"][value="inactive"]').checked;

            // Logika za filtriranje glede na aktivnost in tip spota
            if (!isActive && !showInactive && spot.time !== 'alert') {
                // Če spot ni aktiven, "Show inactive" ni označen in spot ni "alert", ga ne prikažemo
                return false;
            }

            // Filtriranje glede na QSO type
            if (qsoTypes.length && !qsoTypes.includes(spot.Qso_type)) {
                return false;
            }

            // Filtriranje glede na "Spot type"
            if (spotTypes.length && !((spotTypes.includes(spot.type)) || spotTypes.includes(spot.time))) {
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
                const spotDate = new Date(spot.created_at);

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
        return showOnMap(filteredSpots);
    }

    // Gumb za ponastavitev filtrov
    document.getElementById('ClearSelections').addEventListener('click', function() {
        // console.log("Cleared: ", spots);

        // Ponastavi filtre (primer)
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => checkbox.checked = false);
        document.getElementById('callsign_input').value = '';

        // Ponovno izvedi funkcijo za prikaz vseh kontaktov
        updateSpotCount(spots.length);

        // Osveži zemljevid z vsemi kontakti
        filter(spots);
    });
});
