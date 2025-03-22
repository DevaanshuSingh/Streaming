
if (typeof jQuery == "undefined") {
    alert("jQuery Is Not Loaded");
} else {
    // alert("jQuery Is Loaded");
}

function startCamera() {
    navigator.mediaDevices.getUserMedia({
        video: true
    })
        .then(stream => {
            video.srcObject = stream;
        })
        .catch(error => {
            alert('Streaming Error');
            alert('Please Access Camera');
            console.error('Error While Opening Camera: ', error);
        });

    setTimeout(() => {
        captureInterval = setInterval(() => {
            captureImage();
        }, 500);
    }, 1000);
}

function offCamera() {
    let stream = video.srcObject;
    if (stream) {
        let tracks = stream.getTracks();
        tracks.forEach(track => track.stop());
        video.srcObject = null;
    }
    if (captureInterval) {
        clearInterval(captureInterval);
        captureInterval = null; // Reset the variable for safety
        console.log('Stopped');
    }
}

function dataURItoBlob(dataURI) {
    let byteString = atob(dataURI.split(',')[1]);
    let mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

    let arrayBuffer = new ArrayBuffer(byteString.length);
    let uint8Array = new Uint8Array(arrayBuffer);

    for (let i = 0; i < byteString.length; i++) {
        uint8Array[i] = byteString.charCodeAt(i);
    }

    return new Blob([uint8Array], {
        type: mimeString
    });
}