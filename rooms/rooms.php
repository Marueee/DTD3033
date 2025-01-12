<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include '../head.php';?>
    <style>
      body, html {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
      }
      .hero-wrap {
        position: relative;
        width: 100%;
        height: 400px;
        background-size: cover;
        background-position: center center;
      }
      .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
      }
      .room-wrap {
        display: flex;
        margin-bottom: 30px;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      }
      .room-wrap .img {
        width: 50%;
        background-size: cover;
        background-position: center center;
      }
      .room-wrap .text {
        width: 50%;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
      }
      .text-center {
        text-align: center;
      }
      .btn-custom {
        display: inline-block;
        padding: 10px 20px;
        background: #f96d00;
        color: #fff;
        border-radius: 5px;
        text-decoration: none;
      }
      .btn-custom:hover {
        background: #d85a00;
      }
      .star {
        font-size: 14px;
        color: #f96d00;
      }
      .breadcrumbs {
        color: #fff;
        font-size: 16px;
      }
      .breadcrumbs a {
        color: #f96d00;
        text-decoration: none;
      }
      .breadcrumbs span {
        margin-right: 5px;
      }
      .bread {
        color: #fff;
        font-size: 36px;
        font-weight: bold;
      }
      .subheading {
        color: #f96d00;
        font-size: 24px;
        font-weight: bold;
      }
      .container, .container-fluid {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
      }
      .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -15px;
      }
      .col-md-7, .col-md-9, .col-lg-6 {
        padding: 0 15px;
        flex: 0 0 50%;
        max-width: 50%;
      }
      @media (max-width: 768px) {
        .room-wrap {
          flex-direction: column;
        }
        .room-wrap .img, .room-wrap .text {
          width: 100%;
        }
        .breadcrumbs {
          font-size: 14px;
        }
        .bread {
          font-size: 28px;
        }
      }
      @media (max-width: 576px) {
        .room-wrap {
          margin-bottom: 20px;
        }
        .btn-custom {
          font-size: 14px;
          padding: 8px 15px;
        }
      }
    </style>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <a class="navbar-brand" href="../index.php">La<span>Passion</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="../index.php" class="nav-link">Home</a></li>
            <li class="nav-item active"><a href="../rooms.php" class="nav-link">Our Rooms</a></li>
            <li class="nav-item"><a href="../restaurant.html" class="nav-link">Restaurant</a></li>
            <li class="nav-item"><a href="../about.html" class="nav-link">About Us</a></li>
            <li class="nav-item"><a href="../blog.html" class="nav-link">Blog</a></li>
            <li class="nav-item"><a href="../contact.html" class="nav-link">Contact</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- END nav -->
    <div class="hero-wrap" style="background-image: url('../images/bg_3.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text d-flex align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
            <div class="text">
              <p class="breadcrumbs mb-2"><span class="mr-2"><a href="../index.php">Home</a></span> <span>Restaurant</span></p>
              <h1 class="mb-4 bread">Rooms</h1>
            </div>
          </div>
        </div>
      </div>
    </div>

    <section>
      <?php include '../add-rooms.php';?>
    </section>

    <section>
      <?php include '../show-rooms.php';?>
    </section>

    <section>
      <?php include '../edit-room.php';?>
    </section>

    <section class="ftco-section ftco-no-pb ftco-room">
      <div class="container-fluid px-0">
        <div class="row no-gutters justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <span class="subheading">La Passion Rooms</span>
            <h2 class="mb-4">Hotel Master's Rooms</h2>
          </div>
        </div>  
        <div class="row no-gutters">
          <div class="col-lg-6">
            <div class="room-wrap d-md-flex ftco-animate">
              <a href="#" class="img" style="background-image: url('../images/room-6.jpg');"></a>
              <div class="half left-arrow d-flex align-items-center">
                <div class="text p-4 text-center">
                  <p class="star mb-0"><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span></p>
                  <p class="mb-0"><span class="price mr-1">RM 550</span> <span class="per">per night</span></p>
                  <h3 class="mb-3"><a href="rooms.html">King Room</a></h3>
                  <p class="pt-1"><a href="rooms-single.html" class="btn-custom px-3 py-2 rounded">View Details <span class="icon-long-arrow-right"></span></a></p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="room-wrap d-md-flex ftco-animate">
              <a href="#" class="img" style="background-image: url('../images/room-1.jpg');"></a>
              <div class="half left-arrow d-flex align-items-center">
                <div class="text p-4 text-center">
                  <p class="star mb-0"><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span></p>
                  <p class="mb-0"><span class="price mr-1">RM 550</span> <span class="per">per night</span></p>
                  <h3 class="mb-3"><a href="rooms.html">Suite Room</a></h3>
                  <p class="pt-1"><a href="rooms-single.html" class="btn-custom px-3 py-2 rounded">View Details <span class="icon-long-arrow-right"></span></a></p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="room-wrap d-md-flex ftco-animate">
              <a href="#" class="img order-md-last" style="background-image: url('../images/room-2.jpg');"></a>
              <div class="half right-arrow d-flex align-items-center">
                <div class="text p-4 text-center">
                  <p class="star mb-0"><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span></p>
                  <p class="mb-0"><span class="price mr-1">RM 550</span> <span class="per">per night</span></p>
                  <h3 class="mb-3"><a href="rooms.html">Family Room</a></h3>
                  <p class="pt-1"><a href="rooms-single.html" class="btn-custom px-3 py-2 rounded">View Details <span class="icon-long-arrow-right"></span></a></p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="room-wrap d-md-flex ftco-animate">
              <a href="#" class="img order-md-last" style="background-image: url('../images/room-3.jpg');"></a>
              <div class="half right-arrow d-flex align-items-center">
                <div class="text p-4 text-center">
                  <p class="star mb-0"><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span></p>
                  <p class="mb-0"><span class="price mr-1">RM 550</span> <span class="per">per night</span></p>
                  <h3 class="mb-3"><a href="rooms.html">Deluxe Room</a></h3>
                  <p class="pt-1"><a href="rooms-single.html" class="btn-custom px-3 py-2 rounded">View Details <span class="icon-long-arrow-right"></span></a></p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="room-wrap d-md-flex ftco-animate">
              <a href="#" class="img" style="background-image: url('../images/room-4.jpg');"></a>
              <div class="half left-arrow d-flex align-items-center">
                <div class="text p-4 text-center">
                  <p class="star mb-0"><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span></p>
                  <p class="mb-0"><span class="price mr-1">RM 550</span> <span class="per">per night</span></p>
                  <h3 class="mb-3"><a href="rooms.html">Luxury Room</a></h3>
                  <p class="pt-1"><a href="rooms-single.html" class="btn-custom px-3 py-2 rounded">View Details <span class="icon-long-arrow-right"></span></a></p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="room-wrap d-md-flex ftco-animate">
              <a href="#" class="img" style="background-image: url('../images/room-5.jpg');"></a>
              <div class="half left-arrow d-flex align-items-center">
                <div class="text p-4 text-center">
                  <p class="star mb-0"><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span></p>
                  <p class="mb-0"><span class="price mr-1">RM 550</span> <span class="per">per night</span></p>
                  <h3 class="mb-3"><a href="rooms.html">Superior Room</a></h3>
                  <p class="pt-1"><a href="rooms-single.html" class="btn-custom px-3 py-2 rounded">View Details <span class="icon-long-arrow-right"></span></a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  <?php include '../footer.php';?> 

  </body>
</html>