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

      #leftcontainer {
        position: absolute;
        top: 20px;
        width: 350px;
        left: 20px;
        background-color: rgba(0,0,0,0.2);
        border-radius: 3px;
        font: 50px Georgia;
        padding: 10px;
      }
      #rightcontainer {
        position: absolute;
        top: 20px;
        width: 350px;
        right: 20px;
        background-color: rgba(0,0,0,0.2);
        border-radius: 3px;
        font: 50px Georgia;
        padding: 10px;
      }
      #topcontainer {
        position: absolute;
        top: 20px;
        width: 33%;
        left: 33%;
        background-color: rgba(0,0,0,0.2);
        border-radius: 3px;
        font: 50px Georgia;
        padding: 10px;
        text-align:center;
      }
    </style>
  </head>
  <body>

  <div id="container"></div>

  <div id="topcontainer">
    <?php
      require_once('modules/AnalogClock.php');
      $AC = new AnalogClock;
      $AC->Draw(["-7", "0","3"]);
    ?>
  </div>

  <div id="leftcontainer">
      <?php
        require_once("modules/Clock.php");
        $C = new Clock;
        $C->Draw();
      ?>
    
      <?php
        require_once("modules/CurrentWeather.php");
        $W = new CurrentWeather;
        echo "<hr>";
        $W->Draw();
      ?>

      <?php
        require_once("modules/FAA.php");
        echo "<hr>";

        $FAA = new FAA("PHL");
        $FAA->Draw();

        $FAA = new FAA("EWR");
        $FAA->Draw();

        $FAA = new FAA("BOS");
        $FAA->Draw();

        $FAA = new FAA("ATL");
        $FAA->Draw();
      ?>

  </div>

  <div id="rightcontainer">

      <?php
        require_once("modules/News.php");
        $N = new News;
        $N->Draw();
      ?>
      
  </div>

  <script type="text/javascript" src="/globe/third-party/Detector.js"></script>
  <script type="text/javascript" src="/globe/third-party/three.min.js"></script>
  <script type="text/javascript" src="/globe/third-party/Tween.js"></script>
  <script type="text/javascript" src="/globe/globe.js?<?php echo filemtime('globe.js');?>"></script>
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

  // Begin request
  xhr.send( null );
  </script>

  </body>

</html>
