<!DOCTYPE html>

<head>
    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="stylesheet" type="text/css" href="public/css/hotels.css">
    <title>HOTELS PAGE</title>
</head>

<body>
<div class="container">
    <div class="header">
        <div class="logotype">
            <img src="public/img/logotype.svg" alt="logo">
        </div>
        <div class="user-space">
            <span>User</span>
            <div class="user-avatar">
                <img src="public/img/user.svg" alt="user">
            </div>
        </div>
    </div>
    <div class="content">
        <div class="secondary-text">You will be pleased</div>
        <div class="title-text"><span>Choose The Perfect Hotel</span><span>Just For You</span></div>
        <div class="hotels-container">
            <?php
                if (isset($hotels)) {
                    foreach ($hotels as $hotel) {
                        // For each hotel, create a hotel box
                        echo '<div class="hotel-box">';
                        echo '<div class="hotel-image">';
                        echo '<img src="public/uploads/' . $hotel['image'] . '" alt="' . $hotel['name'] . '">';
                        echo '</div>';
                        echo '<div class="hotel-text"><span>' . $hotel['name'] . '</span>';
                        echo '<a href="/gotohotel/' . $hotel['id'] . '" class="arrow-left-link">';
                        echo '<img src="public/img/arrow-left.svg" alt="arrow-left" /></a></div>';
                        echo '</div>';
                    }
                }


            ?>
        </div>
    </div>
</div>
</body>