<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Pab</title>

    <!-- Favicon -->
    <link rel="icon" href="img/Icon.png" type="image/png">

    <link rel="stylesheet" href="css/styles.css">
</head>

<body class="home-page">

    <?php include 'navigation.php'; ?>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            position: relative;

            /* Add background image */
            background-image: url('img/hotel_bg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-color: rgba(0, 0, 0, 0.1); 
            z-index: 0;
        }
    </style>

    <div class="content">
        <h1>Welcome to Our Hotel</h1>
        <p>Experience luxury and comfort during your stay.</p>
    </div>
</body>

</html>