<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Leaflet Map Example</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.css" />
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.js"></script>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div id="result">
        Distance en KM:
        <span id="length"></span>
    </div>
    <form id="form">
        <label for="start">Lieu de départ:</label>
        <input type="text" id="start" name="start" required><br><br>
        <label for="destination">Destination:</label>
        <input type="text" id="destination" name="destination" required><br><br>
        <button type="submit">Calculer l'itinéraire</button>
    </form>
  <div id="mapid" style="min-height: 500px; max-height: 600px; position:center;"></div>
  <script>
    var mymap = L.map('mapid').setView([14.7167, -17.4677], 10);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mymap);

    var control = L.Routing.control({
        waypoints: [],
        routeWhileDragging: true
    }).addTo(mymap);

    document.getElementById('form').addEventListener('submit', (e) => {
        e.preventDefault();
        var start = document.getElementById('start').value;
        var destination = document.getElementById('destination').value;

        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${start}`)
        .then(response => response.json())
        .then(data => {
            var startCoord = L.latLng(data[0].lat, data[0].lon);

            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${destination}`)
            .then(response => response.json())
            .then(data => {
                var destCoord = L.latLng(data[0].lat, data[0].lon);

                control.setWaypoints([startCoord, destCoord]);

                control.on('routesfound', function(e) {
                    var routes = e.routes;
                    var summary = routes[0].summary;
                    document.getElementById('length').innerHTML = (summary.totalDistance / 1000).toFixed(2) + ' km';
                });
            });
        });
    });
  </script>
</body>
</html>
