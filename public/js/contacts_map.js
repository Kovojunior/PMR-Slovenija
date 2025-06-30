$.noConflict();
document.addEventListener("DOMContentLoaded", function() {
    // Pridobi vse checkbox elemente v razdelku "range"
    const rangeCheckboxes = document.querySelectorAll('input[name="range[]"]');
    rangeCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                rangeCheckboxes.forEach(function(box) {
                    if (box !== checkbox) {
                        box.checked = false;
                    }
                });
            }
        });
    });

    // Pridobi vse checkbox elemente v razdelku "date"
    const dateCheckboxes = document.querySelectorAll('input[name="date[]"]');
    dateCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                dateCheckboxes.forEach(function(box) {
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
        var callsignInput = document.getElementById('callsign_input');
        var dateRangePicker = document.getElementById('date-range-picker');
        callsignInput.style.display = 'none';
        callsignInput.value = '';
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

    document.getElementById('by-callsign-checkbox').addEventListener('change', function() {
        var callsignInput = document.getElementById('callsign_input');
        if (this.checked) {
            callsignInput.style.display = 'block'; // Prikaži vnosno polje
        } else {
            callsignInput.style.display = 'none'; // Skrij vnosno polje
            callsignInput.value = ''; // Počisti vnosno polje ob odkljukanju
        }
    });

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
    const map = L.map("map").setView([46.1, 14.7], 8);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    const customIcon_green = L.icon({
        iconUrl: '/images/location-dot-solid-green.png',
        iconSize: [20, 20],
        iconAnchor: [10, 20],
    });

    const customIcon_blue = L.icon({
        iconUrl: '/images/location-dot-solid-blue.png',
        iconSize: [20, 20],
        iconAnchor: [10, 20],
    });

    // Function to create a rounded custom icon based on URL
    function createCustomIcon(photoUrl) {
        return L.icon({
            iconUrl: photoUrl,
            iconSize: [20, 20],
            iconAnchor: [10, 20],
            className: 'rounded-circle'  // Apply the rounded circle class to icons
        });
    }

    showOnMap(contacts);

    function showOnMap(contacts) {
        // Reset zemljevida
        map.eachLayer(function (layer) {
            if (!layer._url) { // This ensures the tile layer isn't removed
                map.removeLayer(layer);
            }
        });

        contacts.forEach(function(contact) {
            // Pretvori koordinate iz niza v številke
            var myGridArray = contact.My_Grid.split(",").map(Number);
            var theirGridArray = contact.Their_Grid.split(",").map(Number);

            // Definiraj ikono za majhno rdečo piko z belim krogom v sredini
            var redCircleIcon = L.divIcon({
                className: 'red-circle-icon',
                html: '<div style="width: 10px; height: 10px; border: 2px solid red; border-radius: 50%; background-color: white;"></div>',
                iconSize: [10, 10], // Velikost pike
                iconAnchor: [5, 5]  // Središče pike
            });

            // Prikaži rdečo piko na My_Grid
            L.marker(myGridArray, {
                icon: redCircleIcon
            }).addTo(map);

            // Premakni obstoječo ikono desno zgoraj
            var myIcon = contact.myProfilePhoto ? createCustomIcon(contact.myProfilePhoto) : customIcon_green;
            L.marker(myGridArray, {
                title: contact.My_Callsign,
                icon: myIcon,
                // Zamikanje ikone desno zgoraj
                iconAnchor: [-15, 30]  // Negativne vrednosti premaknejo desno zgoraj
            }).bindPopup(`
            <span class="popup">
                <b>Klicatelj:</b> <a href="users/2/user-profile">${contact.My_Callsign}</a><br>
            </span>
        `).addTo(map);

            // Prikaži rdečo piko na Their_Grid
            L.marker(theirGridArray, {
                icon: redCircleIcon
            }).addTo(map);

            // Premakni obstoječo ikono prejemnika
            var theirIcon = contact.theirProfilePhoto ? createCustomIcon(contact.theirProfilePhoto) : customIcon_blue;
            L.marker(theirGridArray, {
                title: contact.Their_Callsign,
                icon: theirIcon,
                // Zamikanje ikone desno zgoraj
                iconAnchor: [-15, 30]
            }).bindPopup(`
            <span class="popup">
                <b>Prejemnik:</b> <a href="/users/2/user-profile" target="_blank">${contact.Their_Callsign}</a><br>
            </span>
        `).addTo(map);

            // Izriši črto med točkama
            let polyline = L.polyline([myGridArray, theirGridArray], {
                color: 'grey',
                weight: 2,             // Dejanska debelina črte
                dashArray: '4, 4',
            }).addTo(map);

            // Ustvari širšo, nevidno plast za zaznavanje klikov
            let clickableArea = L.polyline([myGridArray, theirGridArray], {
                color: 'transparent',  // Nastavi na nevidno
                weight: 8,            // Nastavi širše zaznavno območje
                opacity: 0,             // Nastavi na popolnoma nevidno
                interactive: true,
            }).on('click', function() {
                polyline.openPopup();  // Odpri popup na dejanski črti
            }).bindPopup(`
                <span class="popup">
                    <b>Klicatelj:</b> ${contact.My_Callsign}<br>
                    <b>Prejemnik:</b> ${contact.Their_Callsign}<br>
                    <b>RST Sent:</b> ${contact.RST_Sent}<br>
                    <b>RST Received:</b> ${contact.RST_Rcvd}<br>
                    <b>Date:</b> ${contact.Date_Time}<br>
                    <b>Frequency:</b> ${contact.Freq}
                </span>
            `).addTo(map);

            // Animiraj črto
            animatePolyline(polyline);
        });
    }

    // Funkcija za animacijo poliline
    function animatePolyline(polyline) {
        const dashArray = '3, 3'; // Črtasti vzorec
        const length = polyline._path.getTotalLength(); // Uporabimo getTotalLength() namesto getLength()
        let offset = 0; // Začetni offset

        // Nastavi začetni slog za dashArray
        polyline.setStyle({
            dashArray: dashArray,
            dashOffset: offset
        });

        // Animacija
        setInterval(() => {
            offset = (offset + 1) % length; // Posodobite offset
            polyline.setStyle({
                dashOffset: offset // Nastavi offset za animacijo
            });
        }, 100); // Prilagodite hitrost animacije
    }

    // Funkcija za posodabljanje števila prikazanih QSOs
    function updateQSOCount(count) {
        document.getElementById('qso-count').innerHTML = `${count} contacts`;
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
                // Primerjava uporabnikovega klica z malimi črkami
                if (showOptions.includes('mine') && contact.My_Callsign.toLowerCase() !== "{{auth()->user()->name}}".toLowerCase()) {
                    return false;
                }

                // Vrednost input polja - pretvori v male črke
                const callsignInput = document.getElementById('callsign_input').value.toLowerCase();

                // Če je vnesen klicni znak, primerjaj oba klicna znaka z malimi črkami
                if (callsignInput && !(contact.My_Callsign.toLowerCase() === callsignInput || contact.Their_Callsign.toLowerCase() === callsignInput)) {
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
