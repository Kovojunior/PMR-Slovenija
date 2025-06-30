document.addEventListener("DOMContentLoaded", function() {
    console.log("User location: ", userLocation);
    console.log("Map Zoom: ", mapZoom);
    console.log("Marker Draggable: ", markerDraggable);

    // Ustvari zemljevid
    const map = L.map("map").setView(userLocation, mapZoom);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Sredica utripajočega kroga
    const redCircleIcon = L.divIcon({
        className: "red-circle-icon blinking",
        html: '<div style="width: 20px; height: 20px; border: 3px solid red; border-radius: 50%; background-color: white;"></div>',
        iconSize: [50, 50],
        iconAnchor: [25, 25]
    });

    // Shrani marker v spremenljivko
    let marker = L.marker(userLocation, {
        icon: redCircleIcon,
        draggable: markerDraggable
    }).addTo(map);

    // Omogoči premikanje markerja, če je draggable
    if (markerDraggable) {
        marker.on("moveend", function (e) {
            const { lat, lng } = e.target.getLatLng();
            document.getElementById("lat_lng").value = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
        });

        // Klik na zemljevid premakne marker
        map.on("click", function (e) {
            const { lat, lng } = e.latlng;
            marker.setLatLng([lat, lng]); // ✅ Zdaj marker obstaja
            document.getElementById("lat_lng").value = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
        });
    }
});
