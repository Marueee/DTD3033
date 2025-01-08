<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="nav">
        <div class="logo">
            <a href="index.php">
                <h1>La Passion Hotel</h1>
            </a>
        </div>
        <button class="menu-toggle"><i class="fa fa-bars"></i></button>
        <div class="nav-container">
            <ul class="nav-main-menu">
                <li><a href="index.php" class="nav-link">Home</a></li>
                <li><a href="#" class="nav-link">About</a></li>
                <li><a href="#" class="nav-link">Services</a></li>
            </ul>
            <div class="nav-profile">
                <div class="dropdown">
                    <a href="#" class="nav-link">
                        <span><img src="img/profile.jpg" width="30" height="30" alt="user image" /></span>
                        <i class="fa fa-chevron-down"></i>
                    </a>
                    <ul class="dropdown-content">
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</body>

</html>