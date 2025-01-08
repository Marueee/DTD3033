<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Passion Hotel</title>

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

            /* Room Types Section */
        .w3-row-padding {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        justify-content: center;
        margin-bottom: 16px;
        }

        .w3-col {
        flex: 1 1 calc(25% - 8px);
        box-sizing: border-box;
        }

        .w3-margin-bottom {
        margin-bottom: 8px;
        }

        .w3-display-container {
        position: relative;
        width: 100%;
        overflow: hidden;
        border-radius: 4px;
        box-shadow: var(--shadow-1);
        background-color: white;
        }

        .w3-display-topleft {
        position: absolute;
        top: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 4px 8px;
        font-size: 12px;
        border-bottom-right-radius: 4px;
        }

        .w3-display-container img {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.3s ease;
        }

        .w3-display-container:hover img {
        transform: scale(1.05);
        }

        /* Content Box */
        .content {
          width: 90%;
          max-width: 1600px;
          padding-top: 30px;
          padding-right: 50px;
          padding-left: 50px;
          margin-right: auto;
          margin-left: auto;
        }
    </style>

    <div class="content">
        <h1>Welcome to Our Hotel</h1>
        <p>Experience luxury and comfort during your stay.</p>

        <div class="w3-row-padding">
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding">Single</div>
        <img src="img/single.jpg" alt="House" style="width:100%">
      </div>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding">Double</div>
        <img src="img/double.jpg" alt="House" style="width:100%">
      </div>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding">Triple</div>
        <img src="img/triple.jpg" alt="House" style="width:100%">
      </div>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding">Queen</div>
        <img src="img/queen.jpg" alt="House" style="width:100%">
      </div>
    </div>
  </div>

  <div class="w3-row-padding">
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding">King</div>
        <img src="img/king.jpg" alt="House" style="width:99%">
      </div>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding">Single Suite</div>
        <img src="img/singlesuite.jpg" alt="House" style="width:99%">
      </div>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding">Mini Suite</div>
        <img src="img/minisuite.jpg" alt="House" style="width:99%">
      </div>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding">Villa</div>
        <img src="img/villa.jpg" alt="House" style="width:99%">
      </div>
    </div>
  </div>

    </div>
    

</body>

<footer>
    
    <?php include 'footer.php'; ?>
</footer>

</html>