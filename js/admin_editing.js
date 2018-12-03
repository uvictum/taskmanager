window.onload = function adminEdit() {
    let textAreas = document.getElementsByClassName('taskText');
    let statusFields = document.getElementsByClassName('taskStatus');
    let button = document.getElementById('submitChanges');
    let message = document.getElementById("message");
    let table = document.getElementsByClassName("table")[0];
    let sortingBtns = document.getElementsByClassName("sorting_btn");

    Array.from(sortingBtns).forEach(function (elem) {
        elem.addEventListener("click", sortElems);
    });

    if (document.getElementById('logged').innerHTML === "Logout") { //&& typeof this.flag === 'undefined') {

        if (typeof this.flag === 'undefined') {
            button.addEventListener("click", saveChanges);
        }
        button.style.display="inline-block";
        Array.from(textAreas).forEach(function (element) {
            element.addEventListener("click", editContent);
            element.addEventListener("focus", function (){
                let timer = setInterval(function (){checkLength(element, message, 2000)}, 300);
                element.onblur = function () { clearInterval(timer);};
            });
        });
        Array.from(statusFields).forEach(function (element) {
            let newInp = document.createElement('input');
            newInp.type = "checkbox";
            newInp.addEventListener("click", changeStatus);
            if (element.firstChild.innerHTML === "Complete") {
                newInp.setAttribute('checked', 'true');
            }
            element.appendChild(newInp);
        });
    }

    function editContent() {
        this.setAttribute("contenteditable", "true");
        if (message.innerHTML !== "You've overcome maximum length") {
            button.disabled = false;
        }
    }

    function sortElems() {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', '/?order_type='+ this.id, true);
        xhr.onload = function() {
            table.innerHTML = xhr.responseText;
            window.flag = 1;
            adminEdit();
        };
        xhr.send();
    }

    function checkLength(area, message, maxLength) {
        if (area.innerText.length > (0.8 * (maxLength)) && area.innerText.length < maxLength) {
            message.innerHTML = (maxLength-area.innerText.length) + " characters remaining";
            button.disabled = false;
        }
        else if (area.innerText.length > maxLength){
            message.innerHTML = "You've overcome maximum length";
            button.disabled = true;
        }
        else {
            message.innerHTML = "";
            button.disabled = false;
        }
    }

    function saveChanges() {

        let formData = new FormData();
        let xhr = new XMLHttpRequest();
        let rows = Array.from(document.getElementsByTagName('tr'));
        for (let i = 1; i < rows.length; i++) {
            let taskData = {ID:rows[i].id, Text:rows[i].cells[2].innerHTML, Status:rows[i].cells[4].lastChild.checked};
            formData.append('task' + i, JSON.stringify(taskData));
        }
        xhr.open("POST", '/', true);
        xhr.onload = function() {
            alert('Saved');
            if (xhr.status != 200) {
                alert(xhr.status + ': ' + xhr.statusText);
                alert(xhr.responseText);
            }
        };
        xhr.send(formData);
        button.disabled = true;
    }

    function changeStatus() {
        if (this.checked) {
            this.previousElementSibling.innerHTML = "Complete"
        } else {
            this.previousElementSibling.innerHTML = "In Progress"
        }
        if (message.innerHTML !== "You've overcome maximum length") {
            button.disabled = false;
        }
    }
};

