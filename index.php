<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title>Chris Travel</title>
    <meta charset="utf-8">
    <style type="text/css">
      html {
        height: 100%;
      }
      body {
        margin: 0;
        padding: 0;
        background: #000000 url(icons/loading.gif) center center no-repeat;
        color: #ffffff;
        font-family: sans-serif;
        font-size: 13px;
        line-height: 20px;
        height: 100%;
      }

      a {
        color: #aaa;
        text-decoration: none;
      }
      a:hover {
        text-decoration: underline;
      }

      #title {
        position: absolute;
        top: 20px;
        width: 270px;
        left: 20px;
        background-color: rgba(0,0,0,0.2);
        border-radius: 3px;
        font: 50px Georgia;
        padding: 10px;
      }
    </style>
  </head>
  <body>

  <div id="container"></div>
  <div id="title">
    <div>
      <span id="titlecalicon"><img src="icons/Cal-WF.png" width="32" height="32" style="margin-right:10px;" /></span>
      <span id="titlecaltext" style="font-size:22px;"></span>
    </div>
    <div>
      <span id="titleclockicon"><img src="icons/Clock-WF.png" width="32" height="32" style="margin-right:10px;" /></span>
      <span id="titleclocktext"></span>
    </div>
    <div id="titleweather" style="font-size:28px;">
      <?php
        require_once("weather.php");
        $W = new Weather;
        echo "<hr>";
        echo "<img width='24' height='24' src='icons/weather/".$W->CurrIcon.".png' style='margin-right:18px;'/>";
        echo $W->CurrF . "&deg; F";
      ?>
    </div>
  </div>


  <script type="text/javascript" src="/globe/third-party/Detector.js"></script>
  <script type="text/javascript" src="/globe/third-party/three.min.js"></script>
  <script type="text/javascript" src="/globe/third-party/Tween.js"></script>
  <script type="text/javascript" src="/globe/globe.js"></script>
  <script type="text/javascript">
// Where to put the globe?
var container = document.getElementById( 'container' );

// Make the globe
var globe = new DAT.Globe( container );

// We're going to ask a file for the JSON data.
var xhr = new XMLHttpRequest();

// Where do we get the data?
xhr.open( 'GET', 'data.php', true );

// What do we do when we have it?
xhr.onreadystatechange = function() {

    // If we've received the data
    if ( (xhr.readyState) == 4 && (xhr.status == 200)) {
      console.log("ok");

        // Parse the JSON
        var series = JSON.parse( xhr.responseText );

        // Tell the globe about your JSON data
        console.log(series);
        globe.addData(series, {format: 'magnitude', name: "Flights"} );

        // Create the geometry
        globe.createPoints();

        // Begin animation
        globe.animate();
        setTimeout(function(){rot ();}, 2000);
    }

};

function rot() {
  globe.grabTurn(5);
  setTimeout(function(){rot();}, 100);
}

function startTime() {
  var weekday = new Array(7);
  weekday[0]=  "Sunday";
  weekday[1] = "Monday";
  weekday[2] = "Tuesday";
  weekday[3] = "Wednesday";
  weekday[4] = "Thursday";
  weekday[5] = "Friday";
  weekday[6] = "Saturday";

  var today = new Date();

  // time
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);

  // date
  var month = today.getUTCMonth() + 1; //months from 1-12
  var day = today.getUTCDate();
  var year = today.getUTCFullYear();
   
  document.getElementById('titleclocktext').innerHTML =h + ":" + m + ":" + s;
  document.getElementById('titlecaltext').innerHTML = weekday[today.getDay()] + " " + month + "/" + day + "/" + year;
  var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}


// Begin request
xhr.send( null );
startTime();
  </script>

  </body>

</html>
