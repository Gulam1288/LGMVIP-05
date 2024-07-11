<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logging Out...</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(90deg, rgb(43, 77, 130),rgb(40, 144, 172));
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: #FFF;
            font-size: 32px;
        }

        #countdown {
            margin-left: 15px;
        }

        #dots {
            display: inline-block;
            width: 1em;
            text-align: left;
        }

        p {
            margin-top: 20px;
            font-size: 24px;
        }

        a {
            font-size: 24px;
            color: #FFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div>
        Logging out<span id="dots"></span> <span id="countdown">3</span>
    </div>
    <div>
        <p>If you are not redirected <a href="login.php">Click here</a></p>
    </div>
    <script>
        var countdown = 3; // Set the countdown duration in seconds
        function startCountdown() {
            var countdownElement = document.getElementById('countdown');
            var countdownInterval = setInterval(function() {
                countdown--;
                countdownElement.textContent = countdown;
                if (countdown <= 0) {
                    clearInterval(countdownInterval);
                    window.location.href = 'login.php'; // Redirect to login.php
                }
            }, 1000);
        }
        window.onload = startCountdown;

        var dotsElement = document.getElementById('dots');
        var dotsInterval = setInterval(function() {
            dotsElement.textContent += '.';
            if (dotsElement.textContent.length > 3) {
                dotsElement.textContent = '';
            }
        }, 250);
    </script>
    </div>
</body>
</html>
