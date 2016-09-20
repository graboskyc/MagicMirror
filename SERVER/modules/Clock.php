<?php
class Clock {

    public function __construct() {
    }

    public function Draw() {
        ?>
        <div id="cal">
            <span id="calicon"><img src="icons/Cal-WF.png" width="32" height="32" style="margin-right:10px;" /></span>
            <span id="caltext" style="font-size:22px;"></span>
        </div>
        <div id="clock">
            <span id="clockicon"><img src="icons/Clock-WF.png" width="32" height="32" style="margin-right:10px;" /></span>
            <span id="clocktext"></span>
        </div>
        
        <script>
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
            
            document.getElementById('clocktext').innerHTML =h + ":" + m + ":" + s;
            document.getElementById('caltext').innerHTML = weekday[today.getDay()] + " " + month + "/" + day + "/" + year;
            var t = setTimeout(startTime, 500);
        }

        function checkTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }

        startTime();
        </script>
        <?php
    }
}
?>