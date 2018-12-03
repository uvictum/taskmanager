
let textArea = document.getElementById("taskText");
let username = document.getElementById("taskName");
let email = document.getElementById("taskEmail");
let form = document.querySelector('form');
let preview = document.getElementById("prev_container");
let prev_place = document.getElementById("prev_place");
let prevImg = new Image();
prevImg.className = "img-thumbnail";
upldBtn = document.getElementById("post");
prvBtn = document.getElementById("preview");

function loadPreview() {
    form.style.display = "none";
    prev_place.innerHTML = '';
    preview.style.display = "inline-block";

    for (let i = 0; i < 5; i++) {
       prev_place.insertCell(i);
       if (i === 3) {
           previewFile();
           prev_place.cells[i].appendChild(prevImg);
       } else if (i === 4 ) {
           prev_place.cells[i].innerHTML = "In Progress";
       } else {
           prev_place.cells[i].innerHTML = form[i].value;
       }
    }
    return false;
}

function checkFile(file) {
    if (typeof file !== 'undefined' && file.size < 3000000) {
        switch (file.type) {
            case 'image/jpeg':
            case 'image/gif':
            case 'image/png':
                return true;
        }
        return false;
    }
    return false;
}

function previewFile() {
    let file    = document.querySelector('input[type=file]').files[0];
    let reader  = new FileReader();
    let buferImg = new Image();
    let canvas = document.createElement('canvas');
    canvas.width = 320;
    canvas.height = 240;
    let context = canvas.getContext('2d');

    reader.onloadend = function () {
        buferImg.src = reader.result;
        buferImg.onload = function () {
            let sx = ((buferImg.width)/2) - 160; // get center coordinates to place crop rectangle in image center.
            let sy = ((buferImg.height)/2) - 120;
            context.drawImage(buferImg, sx, sy, 320, 240, 0, 0, 320, 240);
            prevImg.src = canvas.toDataURL();
        }
    };
    if (checkFile(file)) {
        reader.readAsDataURL(file);
    } else {
        prevImg.src = "";
    }
}

function stopPreview() {
    prev_place.innerHTML = "";
    preview.style.display = "none";
    form.style.display = "inline-block";
}

function checkLength(area, message, maxLength) {
    if (area.value.length > (0.8 * (maxLength)) && area.value.length < maxLength) {
        message.innerHTML = (maxLength-area.value.length) + " characters remaining";
        upldBtn.disabled = false;
        prvBtn.disabled = false;
    }
    else if (area.value.length > maxLength){
        message.innerHTML = "You've overcome maximum length";
        upldBtn.disabled = true;
        prvBtn.disabled = true;
    }
    else {
        message.innerHTML = "";
        upldBtn.disabled = false;
        prvBtn.disabled = false;
    }
}

textArea.onfocus = function() {
    let timer = setInterval(function (){checkLength(textArea, document.getElementById("message"), 2000)}, 300);
    textArea.onblur = function () { clearInterval(timer);};
};
username.onfocus = function() {
    let timer = setInterval(function (){checkLength(username, document.getElementById("messageName"), 50)}, 300);
    username.onblur = function () { clearInterval(timer);};
};
email.onfocus = function() {
    let timer = setInterval(function (){checkLength(email, document.getElementById("messageEmail"), 100)}, 300);
    email.onblur = function () { clearInterval(timer);};
};
