let addHotelButton = document.getElementById('add-hotel');
let hotelEditor = document.getElementById('hotel-editor');
let settingsButtons = document.getElementsByClassName('edit-hotel');
let exitButton = document.getElementById('exit');
let hotelSpanId = document.getElementById('hotel-id');
const preview = document.getElementById("preview");
if (exitButton) {
    exitButton.addEventListener('click', () => {
        hotelEditor.style.display = 'none';
        preview.src = "";
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

