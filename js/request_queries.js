function dataRequest(formData, callbackFunc) {
    let request = new XMLHttpRequest();
    request.callback = callbackFunc;
    request.onload = xhrSuccess;
    request.onerror = xhrFail;
    request.open("POST", "/editor", true);
    request.send(formData);
}

function displayRequest(request) {
    alert('status: ' + request.readyState + ' response :' + request.responseText);
    if (request.status != 200) {
        alert(request.status + ': ' + request.statusText);
        alert(request.responseText);
    }
}

function xhrSuccess() {
   this.callback(this);
}
function xhrFail() {
    alert('status error: ' + this.readyState);
}