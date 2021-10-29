<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="task2styles.css">
        <!--API KEY   AIzaSyA5u-MwwrlDPo4rFAjGfRty5kMZWqH9JjU -->
        <script src="https://maps.google.com/maps/api/js?key=AIzaSyA5u-MwwrlDPo4rFAjGfRty5kMZWqH9JjU"></script>
        <script>
            var latLong;
            var mapLatLong;
            function getLoc() {
                navigator.geolocation.getCurrentPosition(setLoc);
            }
            function setLoc(pos) {
                latLong = pos.coords;
                mapLatLong = new google.maps.LatLng(latLong.latitude, latLong.longitude)
            }
        </script>
    </head>
    <body onload="getLoc()"> <!-- I have to call getLoc() here as chrome asks for permission and prevents from always allowing it for security reasons. -->
        <h1 style="font-size:60px;">Welcome to My Website</h1>
        <p>Hello, welcome to this website. Click the button to see the time and where you are.</p>
        <button onclick="showPos();">Show Location Coordinates</button>
        <button onclick="showMap();">Show Location Map</button>
        <button onclick="showTime();">Show Local Time</button>
        <br>
        <section class="locCoords">
            <br>
            <h2>Location Coordinates:</h2>
            <p id="locCoords">Test<p>
        </section>
        <section class="locMap">
            <br>
            <h2>Location Map (API Test 1 - Google Maps):</h2>
            <p>Ignore the Error message.</p>
            <div id="locMap" style="width:100%; height:400px"><div>
        </section>
        <section class="locTime">
            <br>
            <h2>Location Time:</h2>
            <p id="locTime">Test<p>
        </section>
        <section>
            <br>
            <h2>API Test 2 - Getting JSON data from Github API</h2>
            <br>
            <button onclick="getData();">Get and Display Data</button>
            <br>
            <p>Data Will Appear below.</p>
            <p id="apiData" style="white-space:pre"></p>
        </section>
        <section>
            <br>
            <h2>PHP Tests</h2>
            <br>
            <form action="submission.php" method="post">
                Name: <input type="text" name="name"><br>
                E-mail: <input type="text" name="email"><br>
                <input type="submit">
            </form>
        </section>
    </body>
    <script>
        var latLongSection = document.getElementsByClassName("locCoords");
        var latLongText = document.getElementById("locCoords");
        var timeSection = document.getElementsByClassName("locTime");
        var timeText = document.getElementById("locTime");
        var mapSection = document.getElementsByClassName("locMap");
        var mapWindow = document.getElementById("locMap");
        var apiDataText = document.getElementById("apiData");
        function showPos() {
            latLongSection[0].style.display = "block";
            latLongText.innerHTML = "Location: Lat: " + latLong.latitude+ " Long: " + latLong.longitude;
        }
        function showMap() {
            mapSection[0].style.display = "block";
            var myOptions = {
                center:mapLatLong,zoom:14,
                mapTypeId:google.maps.MapTypeId.ROADMAP,
                mapTypeControl:false,
                navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
            }
            var map = new google.maps.Map(locMap, myOptions)
            var marker = new google.maps.Marker({position:mapLatLong,map:map,title:"You are here!"});
        }
        function showTime() {
            var time = new Date()
            timeSection[0].style.display = "block";
            timeText.innerHTML = time;
            setTimeout("showTime()",500);
        }
        function getData() {
            let xhr = new XMLHttpRequest();
            xhr.open("GET","https://api.github.com/users", true)
            xhr.onload = function() {
                if (this.status === 200)
                    {
                        apiDataText.innerHTML = this.responseText;
                    }
            }
            xhr.send()
        }
    </script>
</html>