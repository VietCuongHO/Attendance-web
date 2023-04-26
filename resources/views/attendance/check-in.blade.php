<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Face Detection</title>
    <script>
        var faceRegination = {!! json_encode($arr) !!};
    </script>

    <script defer src="{{ asset('assets/face-api/face-api.min.js') }}"></script>
    <script defer src="{{ asset('assets/face-api/script-face-detection.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Montserrat:ital,wght@0,400;0,500;0,700;1,400;1,700&family=Nunito+Sans:wght@400;600;700&family=Roboto:wght@500&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        canvas {
            position: absolute;
            top: 0;
            left: 0;
        }
    </style>
</head>
<body style="background-image:url('{{ asset('assets/face-api/background.jpg') }}')">

    <p id="url-face-api" hidden>{{ asset('assets/face-api') }}</p>
    <p id="url-image" hidden>{{asset('')}}</p>

    <div id="container">
        <div id="alert-div" style="width: 730px;height: 45px;margin-bottom:5vh;">
            <p id="alert-message" style="border-radius: 5px;line-height: 45px;padding-left: 30px;color: white;"></p>
        </div>

        <div id="webcam">
            <video id="video"  width="720" height="560" autoplay muted></video>
            <h2 id="text-loading">Loading...</h2>
        </div>

        <div id="id-input">
            <button id="btn-inp" style="background: none;
                color: white;
                font-size: 18px;
                border: 2px solid;
                height: 45px;
                width: 300px;
                border-radius: 5px;
                font-weight: 500;">Enter ID
            </button>
            <div class="id-field" id="div-inp" style="display: none">
                <form id="checkin-form" action="{{ route('attendance') }}">
                    <input id="inp-id" type="password" maxlength="8">
                </form>
            </div>
        </div>
    </div>
    <script src="http://localhost:6001/socket.io/socket.io.js"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>
</html>
