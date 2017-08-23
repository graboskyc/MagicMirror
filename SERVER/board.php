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
        background: #000000;
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

      #clear {
        margin-top:225px;
        width:100%;
        position:absolute;
      }
      .flt {
        float:left;
        width:22%;
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
  <div id="topcontainer">
    <?php
      require_once('modules/AnalogClock.php');
      $AC = new AnalogClock;
      $AC->Draw(["-7", "0","3"]);
    ?>
  </div>

  <div id="clear">
    <div class="flt">
        <?php
          require_once("modules/Trello.php");
          $T = new Trello;
          $T->Draw("Incubation");
        ?>
    </div>

    <div class="flt">
        <?php
          require_once("modules/Trello.php");
          $T = new Trello;
          $T->Draw("Scheduling");
        ?>
    </div>

    <div class="flt">
        <?php
          require_once("modules/Trello.php");
          $T = new Trello;
          $T->Draw("Scheduled");
        ?>
    </div>

    <div class="flt">
        <?php
          require_once("modules/Trello.php");
          $T = new Trello;
          $T->Draw("Complete");
        ?>
    </div>
  </div>

  </body>

</html>
