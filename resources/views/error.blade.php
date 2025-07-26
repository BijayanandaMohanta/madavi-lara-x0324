<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Please wait...</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: hsl(190, 91%, 46%); /* Set your desired background color here */
            margin: 0;
        }
        img {
            max-width: 80%;   /* Adjust the width as needed */
            object-fit: contain;
        }
    </style>
</head>
<body>
    <img src="{{ asset('frontend/SAVINGINGS.gif') }}" alt="Loading...">
</body>
</html>
