document.addEventListener("DOMContentLoaded", function() {
    // Listings data passed from Blade to JavaScript
    console.log(users);
    const map = L.map("map");
    map.setView([46.1, 14.7], 8);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    const customIcon_green = L.icon({
        iconUrl: '/images/location-dot-solid-green.png',
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

    users.forEach(function(user) {
        if (user.lat_lng != null) {
            // Pretvori koordinate iz niza v številke
            var myGridArray = user.lat_lng.split(",").map(Number);

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

            // Preveri, ali obstaja profilna slika za uporabnika
            var myIcon = user.profile_photo_path ? createCustomIcon(user.profile_photo_path) : customIcon_green;

            // Izriši marker za My_Grid
            L.marker(myGridArray, {
                title: user.My_Callsign,
                icon: myIcon,
            })
                .bindPopup(`
                    <span class="popup">
                        <b>Uporabnik:</b> <a href="/users/${user.id}/user-profile" target="_blank">${user.name}<br>
                    </span>
                `)
                .addTo(map);
        }
    });
});
