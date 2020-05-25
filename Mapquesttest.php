<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js"></script>
    <script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-map.js?key=Zmt3zLFCEahwQ7lnLsSF0U6j6AmmkGWP"></script>
    <script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-routing.js?key=Zmt3zLFCEahwQ7lnLsSF0U6j6AmmkGWP"></script>

    <script type="text/javascript">
        window.onload = function() {

            var map;
            var dir;

            map = L.map('map', {
                layers: MQ.mapLayer(),
                center: [38.895345, -77.030101],
                zoom: 15
            });

            dir = MQ.routing.directions();

            dir.route({
                locations: [
                    '1600 pennsylvania ave, washington dc',
                    '935 pennsylvania ave, washington dc'
                ]
            });

            map.addLayer(MQ.routing.routeLayer({
                directions: dir,
                fitBounds: true
            }));
        }
    </script>
</head>

<body style='border:0; margin: 0'>
    <div id='map' style='width: 100%; height:530px;'></div>
</body>

</html>