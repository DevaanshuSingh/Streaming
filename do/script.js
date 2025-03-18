
if (typeof jQuery == "undefined") {
    alert("jQuery लोड नहीं हुआ!");
} else {
    // alert("jQuery लोड हो गया!");
}


// let video = document.getElementById('video');
// let canvas = document.getElementById('canvas');
// let ctx = canvas.getContext('2d');

// function startCamera() {
//     navigator.mediaDevices.getUserMedia({ video: true })
//         .then(stream => {
//             video.srcObject = stream;
//         })
//         .catch(error => {
//             alert("कैमरा चालू नहीं हो सका! कृपया अनुमति दें।");
//             console.error("कैमरा खोलने में बाधा आई:", error);
//         });
// }

// function offCamera() {
//     let stream = video.srcObject;
//     if (stream) {
//         let tracks = stream.getTracks();
//         tracks.forEach(track => track.stop());
//         video.srcObject = null;
//     }
// }

// function captureImage() {
//     canvas.width = video.videoWidth;
//     canvas.height = video.videoHeight;
//     ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
//     let imageData = canvas.toDataURL("image/png"); // इमेज डेटा बेस64 में बदलें

//     $.ajax({ 
//         type: 'POST',
//         url: 'swapData.php',
//         data: { capturedImage: imageData }, // सही इमेज डेटा भेजें
//         success: function (response) {
//             if (response) {
//                 // console.log("सर्वर प्रतिक्रिया: " + response); // सही "console.log"
//             }
//         },
//         error: function (error) {
//             alert("त्रुटि: " + error); // सही तरीका
//             // console.error("त्रुटि: " + error);
//         }
//     });
// }
// function captureImage() {
//     canvas.width = video.videoWidth;
//     canvas.height = video.videoHeight;
//     ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

//     let imageData = canvas.toDataURL("image/png"); // इमेज डेटा को Base64 में बदलें

//     $.ajax({
//         type: 'POST',
//         url: 'swapData.php',
//         data: { capturedImage: imageData.split(',')[1] }, // केवल Base64 भाग भेजें
//         success: function (response) {
//             $(".bcgImg").attr("src", response); // अब सही इमेज दिखेगी
//             // console.log("सर्वर प्रतिक्रिया: " + $(".bcgImg").attr("src"));
//             // $("body").attr("backgroundImage", "url(response)"); // अब सही इमेज दिखेगी
//         },
//         error: function (error) {
//             // console.error("त्रुटि: " + error);
//         }
//     });
// }

// setInterval(() => { captureImage(); }, 500);


// function captureImage() {
//     // alert("Capturing");
//     canvas.width = video.videoWidth;
//     canvas.height = video.videoHeight;
//     ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

//     let imageData = canvas.toDataURL("image/png"); // Base64 में बदलें
//     $.ajax({
//         type: 'POST',
//         url: 'swapData.php',
//         data: { capturedImage: imageData.split(',')[1] }, // केवल इमेज डेटा भेजें
//         success: function (response) {
//             if (response.includes("uploads")) { // यदि सही पथ मिले तो अपडेट करें
//                 let timestamp = new Date().getTime(); // यूनिक टाइमस्टैम्प
//                 $(".bcgImg").attr("src", response + "?t=" + timestamp); // कैश बायपास
//             } else {
//                 console.error("सर्वर से गलत प्रतिक्रिया:", response);
//             }
//         },
//         error: function (error) {
//             console.error("त्रुटि:", error);
//         }
//     });
// }

// setInterval(() => { captureImage(); }, 500);

// function captureImage() {
//     canvas.width = video.videoWidth;
//     canvas.height = video.videoHeight;
//     ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

//     let imageData = canvas.toDataURL("image/png");

//     $.ajax({
//         type: 'POST',
//         url: 'swapData.php',
//         data: { capturedImage: imageData.split(',')[1] }, // केवल Base64 भाग भेजें
//         success: function (response) {
//             // console.log("सर्वर प्रतिक्रिया: " + response);
//             $(".bcgImg").attr("src", response);
//         },
//         error: function (error) {
//             console.error("त्रुटि: " + error);
//         }
//     });
// }

// let count = 0;
// function captureImage() {
//     canvas.width = video.videoWidth;
//     canvas.height = video.videoHeight;
//     ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

//     let imageData = canvas.toDataURL("image/png");

//     $.ajax({
//         type: 'POST',
//         url: 'swapData.php',
//         data: { 
//             capturedImage: imageData.split(',')[1] ,
//             userId: id
//         },
//         success: function (response) {
//             console.log("सर्वर प्रतिक्रिया: " + response);
//             // $(".bcgImg").attr("src", response);
//         },
//         error: function (error) {
//             // console.error("त्रुटि: " + error);
//         }
//     });

//     // requestAnimationFrame(captureImage);
// }


// // setInterval(() => { captureImage(); }, 1000);



// let lastCaptureTime = 0;
// const captureInterval = 100; // हर 100ms में कैप्चर
// let isUploading = false;

// function captureImage() {
//     let now = Date.now();
//     if (now - lastCaptureTime < captureInterval || isUploading) {
//         return;
//     }
//     lastCaptureTime = now;
//     isUploading = true;

//     if (!video.videoWidth || !video.videoHeight) {
//         // console.error("❌ वीडियो लोड नहीं हुआ!");
//         isUploading = false;
//         return;
//     }

//     canvas.width = video.videoWidth;
//     canvas.height = video.videoHeight;
//     ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

//     // ✅ अगर Canvas में सही डेटा है तो ही Blob बनाएं
//     if (canvas.toDataURL("image/png").length < 100) {
//         console.error("❌ कैनवास में डेटा नहीं है!");
//         isUploading = false;
//         return;
//     }

//     canvas.toBlob(function (blob) {
//         if (!blob) {
//             console.error("❌ Blob बनाने में असफल!");
//             isUploading = false;
//             return;
//         }

//         let formData = new FormData();
//         formData.append("capturedImage", blob, "capture.png");

//         $.ajax({
//             type: 'POST',
//             url: 'swapData.php',
//             data: formData,
//             processData: false,
//             contentType: false,
//             success: function (response) {
//                 console.log("✅ सर्वर प्रतिक्रिया: " + response);
//                 $(".bcgImg").attr("src", response);
//             },
//             error: function (error) {
//                 console.error("❌ त्रुटि: " + error);
//             },
//             complete: function () {
//                 isUploading = false;
//             }
//         });
//     }, "image/png");
// }

// // हर 100ms में कैप्चर करें
// setInterval(() => { captureImage(); }, 100);
