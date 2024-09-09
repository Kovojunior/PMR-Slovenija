<!DOCTYPE html>
<html lang="en" xmlns="">
    <head>
        <title>Map with markets</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <style>
            #map {
                width: 1000px;
                height: 1000px;
            }
            .popup {
                font-size: 1.1rem;
            }
        </style>
    </head>
    <body>
        <div id="map"></div>
    </body>
    <script>
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
                    <b>Prejemnik:</b> <a href="users/2/user-profile">${contact.Their_Callsign}</a><br>
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
    </script>
</html>
