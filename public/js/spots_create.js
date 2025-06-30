document.addEventListener("DOMContentLoaded", function() {

    const timeSelect = document.getElementById('time');
    const calendarContainer = document.getElementById('calendar-container');

    // Funkcija za prikaz ali skritje koledarja
    timeSelect.addEventListener('change', function () {
        if (timeSelect.value === 'alert') {
            calendarContainer.style.display = 'block';  // Prikaži koledar
        } else {
            calendarContainer.style.display = 'none';   // Skrij koledar
        }
    });

    // Če je bila možnost "alert" predhodno izbrana (npr. pri ponovnem nalaganju strani)
    if (timeSelect.value === 'alert') {
        calendarContainer.style.display = 'block';
    }

    let userLocation = [46.052267, 14.508815];

    // console.log(userLocation);
    // Inicializacija zemljevida
    const map = L.map("map").setView(userLocation, 8);

    // Dodajanje zemljevidne plasti
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    const customIcon_green = L.icon({
        iconUrl: '/images/location-dot-solid-blue.png',
        iconSize: [30],
        iconAnchor: [15, 40],
    });

    // Dodajanje zeleni marker
    let marker = L.marker(userLocation, {
        draggable: true,
        icon: customIcon_green
    }).addTo(map);

    // Definiraj ikono za majhno rdečo piko z belim krogom v sredini
    var redCircleIcon = L.divIcon({
        className: 'red-circle-icon',
        html: '<div style="width: 10px; height: 10px; border: 2px solid red; border-radius: 50%; background-color: white;"></div>',
        iconSize: [10, 10],
        iconAnchor: [5, 5]
    });

    // Tabela za shranjevanje rdečih markerjev
    let redMarkers = [];

    // Funkcija za odstranjevanje rdečih markerjev
    function clearRedMarkers() {
        redMarkers.forEach(marker => {
            map.removeLayer(marker); // Odstrani marker z zemljevida
        });
        redMarkers = []; // Počisti tabelo
    }

    // Premik markera
    marker.on('moveend', function (e) {
        const {lat, lng} = e.target.getLatLng();
        document.getElementById("location").value = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;

        // Počisti stare rdeče marke
        clearRedMarkers();

        // Dodaj nov rdeč marker
        let redMarker = L.marker([lat, lng], {
            icon: redCircleIcon
        }).addTo(map);

        redMarkers.push(redMarker); // Shrani referenco na nov marker
    });

    // Klik na zemljevid
    map.on('click', function (e) {
        const {lat, lng} = e.latlng;
        marker.setLatLng([lat, lng]);
        document.getElementById("location").value = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;

        // Počisti stare rdeče marke
        clearRedMarkers();

        // Dodaj nov rdeč marker
        let redMarker = L.marker([lat, lng], {
            icon: redCircleIcon
        }).addTo(map);

        redMarkers.push(redMarker); // Shrani referenco na nov marker
    });
});

document.querySelector('#myForm').addEventListener('submit', function (event) {
    // Prepreči takojšnjo oddajo obrazca
    event.preventDefault();

    // Pridobi tip zveze
    var freqValue = document.getElementById("frequency").value;
    var freqField = document.getElementById("frequency");
    var errorField = document.getElementById("freqError");

    // Resetiraj napako in obrobe polja
    freqField.style.border = "";
    errorField.innerHTML = "";

    // Za PMR preveri, če je številka med 1 in 16
    if (/^\d+$/.test(freqValue) && parseInt(freqValue) >= 1 && parseInt(freqValue) <= 16) {
        document.getElementById("Qso_type").value = "PMR446";
    }
    // Preveri, če je string v formatu "CB" + številka med 1 in 40
    else if (/^CB(\d+)$/.test(freqValue)) {
        var cbChannel = parseInt(freqValue.match(/^CB(\d+)$/)[1]); // Izvleči številko kanala
        if (cbChannel >= 1 && cbChannel <= 40) {
            document.getElementById("Qso_type").value = "CB";
        } else if (cbChannel > 40) {
            // Nastavi napako, če je kanal večji od 40
            document.getElementById("Qso_type").value = "";
            errorField.innerHTML = "Izberite veljaven CB kanal '1-40'";
            errorField.style.color = "red";
            freqField.style.border = "2px solid red"; // Spremeni obrobo polja v rdečo
            return false; // Prepreči oddajo obrazca
        }
    }
    // Če ni PMR ali CB, je Ham
    else {
        document.getElementById("Qso_type").value = "Ham";
    }
    // Pošlji obrazec
    this.submit();
});

function getUserProfile() {
    axios.get('/spots/get-profile', {
        params: {
            name: $("#activation_callsign").val()
        }
    })
        .then(response => {
            const profile = response.data.activator_profile;
            const spots = response.data.spots;
            const contacts = response.data.contacts;
            console.log(response.data);

            // Posodobi druge profile podatke
            $("#profile_name").text(profile.name);
            $("#profile_grid").text(profile.grid);
            $("#profile_city").text(profile.city);
            // Nastavite URL profilne slike
            $("img[alt='Profile picture']").attr("src", profile.profile_photo_path);


            // Počisti obstoječe vrstice v tabeli za spote
            const spotsTableBody = $("#spotsTable tbody");
            spotsTableBody.empty();

            // Ustvari novo vrstico za vsak spot
            spots.forEach((spot, index) => {
                const date = new Date(spot.created_at);
                // Pridobi dan, mesec in leto
                const formattedDate = date.toLocaleDateString('en-GB'); // Format: DD/MM/YYYY
                const row = `
                <tr>
                    <th scope="row">${index + 1}</th>
                    <td>${formattedDate}</td>
                    <td>${spot.Qso_type}</td>
                    <td>${spot.type}</td>
                </tr>
            `;
                spotsTableBody.append(row);
            });

            // Počisti obstoječe vrstice v tabeli za kontakte
            const contactsTableBody = $("#contactsTable tbody");
            contactsTableBody.empty();

            // Ustvari novo vrstico za vsak kontakt
            contacts.forEach((contact, index) => {
                // Ustvari Date objekt iz Date_Time niza
                const date = new Date(contact.Date_Time);
                // Pridobi dan, mesec in leto
                const formattedDate = date.toLocaleDateString('en-GB'); // Format: DD/MM/YYYY
                const row = `
                <tr>
                    <th scope="row">${index + 1}</th>
                    <td>${contact.Their_Callsign}</td>
                    <td>${formattedDate}</td>
                    <td>${contact.QSO_Range}</td>
                    <td>${contact.QSO_Type}</td>
                    <td>${contact.Event_type}</td>
                </tr>
            `;
                contactsTableBody.append(row);
            });

            // Po uspešnem klicu počisti morebitno sporočilo o napaki
            $("#activation_callsign_error").text("");
            $("#activation_callsign").css("border-color", "");
        })
        .catch(error => {
            // Prikaz sporočila o napaki pod poljem
            $("#activation_callsign_error").text(error.response.data["message"]).css("color", "red");
            $("#activation_callsign").css("border-color", "red");
        });
}





