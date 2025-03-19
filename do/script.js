
if (typeof jQuery == "undefined") {
    alert("jQuery लोड नहीं हुआ!");
} else {
    // alert("jQuery लोड हो गया!");
}




// let video = document.getElementById('video');
// let canvases = document.querySelectorAll('canvas'); // ✅ सभी <canvas> एलिमेंट्स चुनें
// let ctx;
// canvases.forEach(canvas => {
//     ctx = canvas.getContext('2d'); // ✅ हर <canvas> के लिए Context बनाएं
// });

// function startCamera() {
//     navigator.mediaDevices.getUserMedia({ video: true })
//         .then(stream => {
//             video.srcObject = stream;
//             // alert('Streaming');
//         })
//         .catch(error => {
//             alert('Streaming Error');
//             alert('Please Access Camera');
//             console.error('Error While Opening Camera: ', error);
//         });
//     // alert('Worked');
//     captureInterval = setInterval(() => { captureImage(); }, 1000);
// }

// function offCamera() {
//     console.log('OutFirst');
//     let stream = video.srcObject;
//     if (stream) {
//         let tracks = stream.getTracks();
//         tracks.forEach(track => track.stop());
//         video.srcObject = null;
//     }
//     console.log('OutSecond');
//     if (captureInterval) {
//         clearInterval(captureInterval);
//         captureInterval = null; // Reset the variable for safety
//         console.log('OOutThird');
//     }
// }

// function captureImage() {
//     console.log(video.content);
//     canvases.width = video.videoWidth;
//     canvases.height = video.videoHeight;
//     ctx.drawImage(video, 0, 0, canvases.width, canvases.height);
// }










// function captureImage() {
//     // canvases.forEach((canvas, index) => {
//         canvas.width = video.videoWidth;
//         canvas.height = video.videoHeight;

//         // ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

//         let imageData = video.toDataURL('image/png');
//         $.ajax({
//             type: 'POST',
//             url: 'upload.php',
//             data: {
//                 capturedImage: imageData.split(',')[1],
//                 userId: " . $userId . "
//             },
//             success: function (response) {
//              canvases.forEach((canvas, index) => {
//                 let ctx = canvas.getContext('2d');
//                 let img = new Image();
//                 // img.onload = function () {
//                     ctx.clearRect(0, 0, canvas.width, canvas.height);
//                     ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
//                 // };
//                 img.src = response;
//                 // $('.canvaImg').attr('src','./'+response);
//                 $('.canvaImg').attr('src', './uploads/testImg.jpg');
//             // });
//             // console.log('Response from canvas ' + (index + 1) + ':', response);
//             console.log(response);
//             },
//             error: function (error) {
//                 console.error('Error occurred for canvas ' + (index + 1) + ':', error);
//             }
//         });
//     });
// }
