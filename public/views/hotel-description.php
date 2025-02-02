<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="stylesheet" type="text/css" href="/public/css/hotels.css">
    <link rel="stylesheet" type="text/css" href="/public/css/single-hotel.css">
    <title>HOTEL DESCRIPTION</title>
</head>
<body>
<div class="container">
    <div class="header">
        <div class="logotype">
            <img src="/public/img/logotype.svg" alt="logo">
        </div>
        <div class="user-space">
            <span>User</span>
            <div class="user-avatar">
                <img src="/public/img/user.svg" alt="user">
            </div>
        </div>
    </div>
    <div class="content">
        <?php
            if (!isset($hotel)) {
                die("Error: Hotel data is missing.");
            }
            ?>
        <div class="hotel-card">
            <div class="single-hotel-image">
                <img src="/public/uploads/<?= htmlspecialchars($hotel['image']) ?>" alt="hotel image">
            </div>
            <div class="hotel-content">
                <div class="upper-hotel-content">
                    <div class="hotel-title"><?= htmlspecialchars($hotel['name']) ?></div>
                    <div class="line"></div>
                    <div class="stars">
                        <span><?= htmlspecialchars($hotel['opinion']) ?></span>
                        <?php
                        $rating = (int) explode('/', $hotel['opinion'])[0]; // Extracts the numeric value before '/'
                        for ($i = 1; $i <= 5; $i++): ?>
                            <img src="/public/img/<?= $i <= $rating ? 'star-red' : 'star' ?>.svg" alt="star">
                        <?php endfor; ?>

                    </div>
                </div>
                <div class="hotel-description-container">
                    <div class="hotel-description">
                        <span><?= htmlspecialchars($hotel['description']) ?></span>
                    </div>
                    <div class="location">
                        <img src="/public/img/location.svg" alt="location">
                        <span><?= htmlspecialchars($hotel['location']) ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="title-text">Look for a room</div>
        <div class="line-separator">
            <div class="line"></div><div class="dot"></div><div class="line"></div>
        </div>

        <div class="room-container">
            <?php
            if (!isset($rooms)) {
                die("Error: Hotel data is missing.");
            }
            ?>
            <?php foreach ($rooms as $room): ?>
                <?php
                $galleryString = trim($room['gallery'], '{}');
                $galleryArray = array_map('trim', explode(',', $galleryString));
                ?>
                <div class="room-card">
                    <div class="room-image">
                        <img src="/public/uploads/<?= htmlspecialchars($galleryArray[0]) ?>" alt="room image">
                    </div>
                    <div class="room-details">
                        <div class="room-name"><?= htmlspecialchars($room['name']) ?></div>
                        <div class="room-area">
                            <?php
                            $features = explode(',', $room['features']);
                            $total = count($features);
                            ?>
                            <?php for ($i = 0; $i < $total; $i++): ?>
                                <?php if ($i % 4 === 0): ?>
                                    <ul>
                                <?php endif; ?>
                                <li><?= htmlspecialchars(trim($features[$i])) ?></li>
                                <?php if ($i % 4 === 3 || $i === $total - 1): ?>
                                    </ul>
                                <?php endif; ?>
                            <?php endfor; ?>

                        </div>
                    </div>
                    <div class="button-section">
                        <a href="/gotoroom/<?= $room['id'] ?>" class="read-more">Read more</a>
                        <div class="book-now">Book Now</div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</body>
</html>
