<?php
// print_r($_GET);
?>
<!DOCTYPE html>
<html lang="hi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📸 कैमरा से चित्र खींचें 📸</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="main-container">

        <header>
            <h2>VSeet</h2>
        </header>
        <main>
            <div class="users">
                <?php
                require_once 'config.php';
                $userId = $_GET['id'];
                $stmt = $pdo->prepare("SELECT COUNT(id) FROM user;");
                $stmt->execute();
                $allUsers = $stmt->fetchColumn(0);
                for ($i = 1; $i <= $allUsers; $i++) {
                    echo '<canvas class="canvas" class="canvas' . $i . '"><img src="" alt="THE IMAGE" class=" text-warning canvaImg "></canvas>';
                }

                ?>
                <!-- <canvas class="canvas">
    <img src="" alt="THE IMAGE" class="canvaImg">
</canvas> -->
                <video id="video" class="canvas" autoplay></video>
                <!-- <canvas id="canvas" class="canvas"></canvas>
                <canvas id="canvas" class="canvas"></canvas>
                <canvas id="canvas" class="canvas"></canvas> -->
            </div>
            <div class="actions">
                <button class="btn btn-green" onclick="startCamera()">🎥 On Camera</button>
                <button class="btn btn-green" onclick="offCamera()">📷 Off Camera</button>
            </div>
        </main>
    </div>
    <script>
        let video = document.getElementById('video');
        let canvases = document.querySelectorAll('canvas'); // ✅ सभी <canvas> एलिमेंट्स चुनें
        let ctx;
        canvases.forEach(canvas => {
            ctx = canvas.getContext('2d'); // ✅ हर <canvas> के लिए Context बनाएं
        });

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

            captureInterval = setInterval(() => {
                captureImage();
            }, 100);
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
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous">
    </script>
    <script src="script.js"></script>
    <?php
    echo "<script>


        // function captureImage() {
            //         canvases.forEach(canvas => {
            //             canvas.width = video.videoWidth;
            //             canvas.height = video.videoHeight;
            //             let ctx = canvas.getContext('2d');

            //             ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            //             let imageData = canvas.toDataURL('image/png'); // ✅ Base64 format image
            //             let userId = " . $_GET['id'] . "; // ✅ PHP से यूजर आईडी ले रहे हैं

            //             $.ajax({
            //                 type: 'POST',
            //                 url: 'upload.php',
            //                 data: {
            //                     capturedImage: imageData, // ✅ Base64 image data भेजें
            //                     userId: userId
            //                 },
            //                 success: function(response) {
            //                     console.log('✅ Image Stored: ' + response);
            //                     ctx.drawImage(response, 0, 0, canvas.width, canvas.height);

            //                 },
            //                 error: function(xhr, status, error) {
            //                     console.error('❌ Error: ', error);
            //                 }
            //             });

            //         });
        // }
        // function captureImage() {
        //         canvases.forEach((canvas, index) => {
        //             canvas.width = video.videoWidth;
        //             canvas.height = video.videoHeight;
        //             let ctx = canvas.getContext('2d');

        //             ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
        //             let imageData = canvas.toDataURL('image/png');
        //             let userId = " . $_GET['id'] . "; // ✅ PHP से यूजर आईडी प्राप्त करें

        //             $.ajax({
        //                 type: 'POST',
        //                 url: 'upload.php',
        //                 data: {
        //                     capturedImage: imageData,
        //                     userId: userId
        //                 },
        //                 success: function(response) {
        //                     console.log('✅ Image Stored: ' + response);

        //                     let imgElements = document.querySelectorAll('.canvaImg');
        //                     imgElements.forEach((img, i) => {
        //                         img.src = response; // ✅ सर्वर से आए इमेज को सेट करें
        //                         img.alt = 'Captured Image';
        //                         img.style.backgroundColor = 'gold'; // ✅ गोल्ड बैकग्राउंड सेट करें
                                
        //                         img.onload = function() {
        //                             ctx.clearRect(0, 0, canvas.width, canvas.height); // ✅ पुराना Image हटाएं
        //                             ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        //                         };
        //                     });
        //                 },
        //                 error: function(xhr, status, error) {
        //                     console.error('❌ Error: ', error);
        //                 }
        //             });
        //         });
        // }USE IT WORKABLE

        function captureImage() {
    canvases.forEach((canvas, index) => {
        let ctx = canvas.getContext('2d');

        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

        let imageData = canvas.toDataURL('image/png');
        let userId = ".$_GET['id'].";

        $.ajax({
            type: 'POST',
            url: 'upload.php',
            data: {
                capturedImage: imageData,
                userId: userId
            },
            success: function(response) {
                console.log('✅ Image Stored at: ' + response);

                let imgElements = document.querySelectorAll('.canvaImg');
                let img = imgElements[index]; // ✅ हर canvas के लिए अलग img

                img.src = response; // ✅ इमेज लोड करें
                img.alt = 'Captured Image';
                img.style.backgroundColor = 'gold'; 

                img.onload = function() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                };
            },
            error: function(xhr, status, error) {
                console.error('❌ Error: ', error);
            }
        });
    });
}


        </script>";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>






