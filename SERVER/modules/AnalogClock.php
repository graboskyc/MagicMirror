<?php
class AnalogClock {

    public function __construct() {
    }

    public function Draw($tzonearray) {
        ?>
        <style>
            #current-time {
                display: block;
                font-weight: bold;
                text-align: center;
                width: 200px;
                padding: 10px;
            }

            #clock {
                padding: 10px;
                border:1px solid #000000;
            }
        </style>

        <?php
        foreach ($tzonearray as $offset) {
        ?>
            <div style="display:inline-block;padding:10px;">
                <div id="aclockname_<?php echo $offset?>" style="width:100%;font-size:20px;padding-bottom:5px;"></div>
                <canvas id="aclock_<?php echo $offset?>" class="aclock" width="100" height="100">
                If you can see this message, your browser does not support canvas 
                and needs an upate. Sorry. :(
                </canvas>
                <div id="aclocktext_<?php echo $offset?>" style="width:100%;font-size:20px;padding-bottom:5px;"></div>
            </div>
        <?php
        }
        ?>
        
        <script>
        document.addEventListener('DOMContentLoaded', startTimer);
        function startTimer()
        {
            updateClocks();
            setInterval(updateClocks, 5000);
        }

        function updateClocks()
        {

            function drawArm(clockX, clockY, clockRadius, context, progress, armThickness, armLength, armColor)
            {
                var armRadians = (Math.TAU * progress) - (Math.TAU/4);
                var targetX = clockX + Math.cos(armRadians) * (armLength * clockRadius);
                var targetY = clockY + Math.sin(armRadians) * (armLength * clockRadius);

                context.lineWidth = armThickness;
                context.strokeStyle = armColor;

                context.beginPath();
                context.moveTo(clockX, clockY); // Start at the center
                context.lineTo(targetX, targetY); // Draw a line outwards
                context.stroke();
            }


            var tza = [<?php echo implode(",",$tzonearray); ?>];
            var tzLookup = {"0":"UTC","-5":"NYC", "3": "Jerusalem", "-7":"LA"};
            tza.forEach(function(tz) {
                document.getElementById("aclockname_"+tz).innerHTML=tzLookup[tz]; 
                

                var now = new Date();
                var offset = tz*1;
                var h = (now.getUTCHours() + offset) % 12;
                var m = now.getMinutes();
                var s = now.getSeconds();

                document.getElementById("aclocktext_"+tz).innerHTML= ("00" +(now.getUTCHours() + offset)).slice(-2)+":"+("00" + m).slice(-2);
                
                // --- Analog clock ---//

                var canvas = document.getElementById("aclock_"+tz);
                var context = canvas.getContext("2d");
                
                // You can change this to make the clock as big or small as you want.
                // Just remember to adjust the canvas size if necessary.
                var clockRadius = 50;

                // Make sure the clock is centered in the canvas
                var clockX = canvas.width / 2;
                var clockY = canvas.height / 2;

                // Make sure TAU is defined (it's not by default)
                Math.TAU = 2 * Math.PI;
                
                context.clearRect(0, 0, canvas.width, canvas.height);
                
                // Draw background

                for (var i = 0; i < 12; i++)
                {
                    var innerDist		= (i % 3) ? 0.75 : 0.7;
                    var outerDist		= (i % 3) ? 0.95 : 1.0;
                    context.lineWidth 	= (i % 3) ? 4 : 10;
                    context.strokeStyle = '#999999';
                    
                    var armRadians = (Math.TAU * (i/12)) - (Math.TAU/4);
                    var x1 = clockX + Math.cos(armRadians) * (innerDist * clockRadius);
                    var y1 = clockY + Math.sin(armRadians) * (innerDist * clockRadius);
                    var x2 = clockX + Math.cos(armRadians) * (outerDist * clockRadius);
                    var y2 = clockY + Math.sin(armRadians) * (outerDist * clockRadius);
                    
                    context.beginPath();
                    context.moveTo(x1, y1); // Start at the center
                    context.lineTo(x2, y2); // Draw a line outwards
                    context.stroke();
                }

                var hProgress = (h/12) + (1/12)*(m/60) + (1/12)*(1/60)*(s/60);
                var mProgress =                 (m/60) +        (1/60)*(s/60);
                var sProgress =                                        (s/60);
                
                drawArm(clockX, clockY, clockRadius, context,  hProgress, 4, 1/2, '#ffffff'); // Hour
                drawArm(clockX, clockY, clockRadius, context,  hProgress, 4, -5/clockRadius, '#ffffff'); // Hour

                drawArm(clockX, clockY, clockRadius, context,  mProgress,  2, 3/4, '#ffffff'); // Minute
                drawArm(clockX, clockY, clockRadius, context,  mProgress,  2, -2/clockRadius, '#ffffff'); // Minute

                //drawArm(clockX, clockY, clockRadius, context,  sProgress,  2,   1, '#FF0000'); // Second
                //drawArm(clockX, clockY, clockRadius, context,  sProgress,  2, -10/clockRadius, '#FF0000'); // Second
            });
        }
        </script>
        <?php
    }
}
?>