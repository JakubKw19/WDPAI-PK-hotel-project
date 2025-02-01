let addHotelButton = document.getElementById('add-hotel');
let hotelEditor = document.getElementById('hotel-editor');
let settingsButtons = document.getElementsByClassName('edit-hotel');
let exitButton = document.getElementById('exit');
let hotelSpanId = document.getElementById('hotel-id');
const preview = document.getElementById("preview");
const addRoomButton = document.getElementById('add-room');
const roomContainer = document.getElementById('room-container');
let roomCount = parseInt(addRoomButton.getAttribute('room-count'));
const roomTitle = document.getElementById('room-title');
const roomEditor = document.getElementById('room-editor');
let exitRoomButton = document.getElementById('exit-room');
const saveButton = document.getElementById('save-button');
const saveRoomButton = document.getElementById('save-room-button');
const galleryPreview = document.getElementById("gallery-preview-container");
let rooms = [];
let roomGalleryFiles = [];
let galleryInput = document.getElementById('room-gallery');
if (exitButton) {
    exitButton.addEventListener('click', () => {
        hotelEditor.style.display = 'none';
        preview.src = "";
        // rooms = [];
        roomGalleryFiles = [];
    })
    exitRoomButton.addEventListener('click', () => {
        roomEditor.style.display = 'none';
        // rooms = [];
        roomGalleryFiles = [];
    })
}
if (addHotelButton) {
    addHotelButton.addEventListener('click', (e) => {
        e.preventDefault();
        let hotelsCounter = 1;
        let hotels = document.querySelectorAll('.hotel-box');
        for (let i = 0; i < hotels.length; i++) {
            hotelsCounter++;
        }
        hotelEditor.style.display = 'flex';
        hotelSpanId.innerText = hotelsCounter.toString();
        console.log('hello');
    })
}
if (settingsButtons) {
    for (let i = 0; i < settingsButtons.length; i++) {
        settingsButtons[i].addEventListener('click', (e) => {
            e.preventDefault();
            let hotelId = settingsButtons[i].getAttribute('data-hotel-id');
            hotelEditor.style.display = 'flex';
            hotelSpanId.innerText = hotelId.toString();
            console.log(hotelId);
        })
    }
}
function previewImage(file) {
    if (file) {
        const allowedTypes = ["image/png", "image/jpeg", "image/jpg"];
        if (!allowedTypes.includes(file.type)) {
            alert("Only PNG, JPEG, and JPG files are allowed.");
            return;
        }
        const reader = new FileReader();
        reader.onload = function () {
            preview.src = reader.result;
            preview.style.display = "block";
        };
        reader.readAsDataURL(file);
    }
}
document.getElementById('hotel-picture').addEventListener('change', (e) => {
    console.log(e);
    const file = document.getElementById('hotel-picture').files[0];
    if (file) {
        previewImage(file);
    }
});

addRoomButton.addEventListener('click', (e) => {
    roomCount++;
    let newRoom = document.createElement("div");
    newRoom.id = "room-" + roomCount;
    newRoom.className = "room-button";
    newRoom.innerHTML = "Room " + roomCount;
    roomTitle.innerText = roomCount.toString();
    roomEditor.style.display = 'flex';
    roomContainer.appendChild(newRoom);
})


saveButton.addEventListener('click', (e) => {
    e.preventDefault();
    let formData = new FormData(document.getElementById('hotel-form'));
    let fileInput = document.getElementById("hotel-picture");
    if (fileInput.files.length > 0) {
        formData.append("hotel-picture", fileInput.files[0]);
    }
    rooms.forEach((room, index) => {
        room.images.forEach((image, i) => {
            formData.append(`room-${index}-image-${i}`, image);
        });
        room.images = room.images.map((image, i) => `room-${index}-image-${i}`);
    });
    formData.append("rooms", JSON.stringify(rooms));
    fetch("/addhotel", {
        method: "POST",
        body: formData,
    })
        .then(response => response.json())
        .then(data => console.log("Success:", data))
        .catch(error => console.error("Error:", error));
    hotelEditor.style.display = 'none';
    preview.src = "";
    rooms = [];
    roomGalleryFiles = [];
    roomCount = 0;
    roomContainer.innerHTML = "";
})

saveRoomButton.addEventListener('click', (e) => {
    let newRoom = {
        id: roomCount,
        name: document.getElementById("room-name").value,
        description: document.getElementById("room-description").value,
        features: document.getElementById("room-features").value,
        images: roomGalleryFiles,
    }
    rooms.push(newRoom);
    roomGalleryFiles = [];
    galleryPreview.innerHTML = "";
    roomEditor.style.display = 'none';
})

galleryInput.addEventListener('change', (e) => {
    const files = e.target.files;
    for (const file of files) {
        roomGalleryFiles.push(file);
        let newDiv = document.createElement("div");
        newDiv.className = "gallery-preview-div";
        newDiv.innerHTML = file.name;
        galleryPreview.appendChild(newDiv);
    }
})