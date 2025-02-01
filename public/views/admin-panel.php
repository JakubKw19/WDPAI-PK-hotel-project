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
            <div class="hotel-box">
                <div class="hotel-image">
                    <img src="public/img/hotel-1.jpg" alt="hotel-1">
                </div>
                <div class="hotel-text"><span>Hotel 1</span><div class="edit-hotel" data-hotel-id="1"><img src="public/img/settings-icon.svg" alt="settings-icon" /></a></div>
            </div>
        </div>
    </div>
        <div id="hotel-editor">
            <div class="hotel-editor-panel">
                <div class="editor-header"><div></div><div class="title">Edit Hotel <span id="hotel-id"></span></div><div id="exit"><img src="/public/img/exit.svg" alt='exit'></div></div>
                <div>
                    <form class="hotel-form">
                        <div class="form-group">
                            <div class="form-item">
                                <label for="hotel-name">Name</label>
                                <input type="text" placeholder="Hotel name" id="hotel-name">
                            </div>
                            <div class="form-item">
                                <label for="description">Description</label>
                                <textarea placeholder="Description" id="description"></textarea>
                            </div>
                            <div class="form-item">
                                <label for="location">Location</label>
                                <input type="text" placeholder="Location" id="location">
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</body>