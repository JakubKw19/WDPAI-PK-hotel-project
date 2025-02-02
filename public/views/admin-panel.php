<!DOCTYPE html>

<head>
    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="stylesheet" type="text/css" href="public/css/hotels.css">
    <link rel="stylesheet" type="text/css" href="public/css/admin-panel.css">
    <script src="/public/js/script.js" defer></script>
    <title>ADMIN PAGE</title>
</head>

<body>
<div class="container">
    <div class="header">
        <div class="logotype">
            <img src="public/img/logotype.svg" alt="logo">
        </div>
        <div class="user-space">
            <span>Admin</span>
            <div class="user-avatar">
                <img src="public/img/user.svg" alt="user">
            </div>
        </div>
    </div>
    <div class="content">
        <div class="title-text"><span>Hotels</span></div>
        <div id="add-hotel"><span>Add Hotel</span><img src="/public/img/add-icon.svg" alt="add-icon"></div>
        <div class="hotel-list">
            <?php
                if (!isset($hotels)) {
                    die("Hotels not found");
                }
            ?>
            <?php foreach ($hotels as $hotel): ?>
            <div class="hotel-box">
                <div class="hotel-image">
                    <img src="public/uploads/<?= htmlspecialchars($hotel['image']); ?>" alt="<?= htmlspecialchars($hotel['name']); ?>">
                </div>
                <div class="hotel-text">
                    <span><?= htmlspecialchars($hotel['name']); ?></span>
                    <div class="edit-hotel" data-hotel-id="<?= htmlspecialchars($hotel['id']); ?>">
                        <img src="public/img/exit.svg" alt="exit" />
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
        <div id="hotel-editor">
            <div class="hotel-editor-panel">
                <div class="editor-header"><div></div><div class="title">Edit Hotel <span id="hotel-id"></span></div><div id="exit"><img src="/public/img/exit.svg" alt='exit'></div></div>
                <div>
                    <form class="hotel-form" id="hotel-form" method="post" action="/addhotel" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="form-item">
                                <label for="hotel-name">Name</label>
                                <input type="text" placeholder="Hotel name" id="hotel-name" name="hotel-name">
                            </div>
                            <div class="form-item">
                                <label for="description">Description</label>
                                <textarea placeholder="Description" id="description" name="hotel-description"></textarea>
                            </div>
                            <div class="form-item">
                                <label for="location">Location</label>
                                <input type="text" placeholder="Location" id="location" name="hotel-location">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-item">
                                <label for="hotel-picture">Picture</label>
                                <div class="hotel-picture"><span>Upload</span><img src="/public/img/upload.svg" alt="upload"><input type="file" id="hotel-picture" accept=".png, .jpeg, .jpg"></div>
                                <div class="preview-container">
                                    <img id="preview">
                                </div>
                            </div>
                            <div class="form-item">
                                <label for="rooms">Rooms</label>
                                <div id="add-room" room-count="0"><span>Add Room</span><img src="/public/img/add-icon.svg" alt="add-icon"></div>
                                <div id="room-container">

                                </div>
                            </div>
                            <div class="form-item">
                                <button id="save-button" class="save-button">Save</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div id="room-editor">
            <div class="room-editor-panel">
                <div class="editor-header"><div></div><div class="title">Edit Room <span id="room-title"></span><span id="hotel-id"></span></div><div id="exit-room"><img src="/public/img/exit.svg" alt='exit'></div></div>
                <div class="room-editor-whole">
                    <div class="form-group">
                        <div class="form-item">
                            <label for="room-name">Name</label>
                            <input type="text" placeholder="Room name" id="room-name">
                        </div>
                        <div class="form-item">
                            <label for="room-description">Description</label>
                            <textarea placeholder="Description" id="room-description"></textarea>
                        </div>
                        <div class="form-item">
                            <label for="room-features">Features</label>
                            <textarea placeholder="Features" id="room-features"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-item">
                            <label for="room-gallery">Gallery</label>
                            <div class="hotel-picture"><span>Upload</span><img src="/public/img/upload.svg" alt="upload"><input type="file" id="room-gallery" accept=".png, .jpeg, .jpg" multiple></div>

                        </div>
                        <div id="gallery-preview-container">
                        </div>
                        <div class="form-item">
                            <button id="save-room-button" class="save-button">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</body>