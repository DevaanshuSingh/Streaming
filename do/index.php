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
    <video id="video" autoplay></video>
    <img src="" alt="" class="bcgImg">
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
                $allUsers = $stmt->fetchColumn();
                for ($i = 1; $i <= $allUsers; $i++) {
                    echo '<canvas id="canvas" class="canvas' . $i . '"><img src="" alt="img" class="canvaImg bg-warning"></canvas>';
                }
                ?>
                <!-- <canvas id="canvas" class="canvas"></canvas>
                <canvas id="canvas" class="canvas"></canvas>
                <canvas id="canvas" class="canvas"></canvas> -->
            </div>
            <div class="actions">
                <button class="btn btn-green" onclick="startCamera()">🎥 On Camera</button>
                <button class="btn btn-green" onclick="offCamera()">📷 Off Camera</button>
                <!-- <button class="btn btn-green" onclick="startCamera()">On Camera</button>
                <button class="btn btn-green" onclick="offCamera()">Off Camera</button> -->
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <?php
    echo "<script defer>

            let video = document.getElementById('video');
            let canvases = document.querySelectorAll('canvas'); // ✅ सभी <canvas> एलिमेंट्स चुनें
            let ctx;
            canvases.forEach(canvas => {
                ctx = canvas.getContext('2d'); // ✅ हर <canvas> के लिए Context बनाएं
            });

            function startCamera() {
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(stream => {
                        video.srcObject = stream;
                        // alert('Streaming');
                        })
                        .catch(error => {
                            alert('Streaming Error');
                        alert('Please Access Camera');
                        console.error('Error While Opening Camera: ', error);
                    });
                    // alert('Worked');
                    captureInterval = setInterval(() => { captureImage(); }, 500);
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
                    }
            }

            // function captureImage() {
            //     canvas.width = video.videoWidth;
            //     canvas.height = video.videoHeight;
            //     ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

            //     let imageData = canvas.toDataURL('image/png');
            //     $.ajax({
            //         type: 'POST',
            //         url: 'upload.php',
            //         data: {
            //             capturedImage: imageData.split(',')[1] ,
            //             userId: " . $userId . "
            //         },
            //         success: function (response) {
            //             console.log('Response:'+response);
            //              let img = new Image(); // Create a new image object
            //             img.onload = function () {
            //                 // Calculate the x and y coordinates to center the image
            //                 let x = (canvas.width - img.width) / 2;
            //                 let y = (canvas.height - img.height) / 2;

            //                 // Optionally, you can scale the image to fit
            //                 let scaleWidth = canvas.width / img.width;
            //                 let scaleHeight = canvas.height / img.height;
            //                 let scale = Math.min(scaleWidth, scaleHeight);

            //                 // Draw the image centered and scaled
            //                 let drawWidth = img.width * scale;
            //                 let drawHeight = img.height * scale;
            //                 x = (canvas.width - drawWidth) / 2; // Recalculate x for scaled width
            //                 y = (canvas.height - drawHeight) / 2; // Recalculate y for scaled height

            //                 ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear the canvas
            //                 ctx.drawImage(img, x, y, drawWidth, drawHeight);
            //             };
            //             img.src = response; 
            //             // $('.bcgImg').attr('src', '../' + response);
                        
            //             // console.log('सर्वर प्रतिक्रिया: ' + response);
            //             // $('.bcgImg').attr('src', .\uploads\captured_1741970265.png);
            //             // console.log('Setting Src: '+response);
            //             // $('.bcgImg').attr('src','../'+ response);
            //             // let imageUrl = 'data:image/png;base64,' + res.imageData;  // ✅ सही Base64 फॉर्मेट बनाएं
            //             // $('.bcgImg').attr('src', imageUrl);  // ✅ सही तरीके से इमेज दिखाएं
            //             },
            //         error: function (error) {
            //             console.error('त्रुटि:' + error);
            //         }
            //     });
            //     // requestAnimationFrame(captureImage);
            // }   
            // setInterval(() => { captureImage(); }, 1000);

            function captureImage() {
                // canvases.forEach((canvas, index) => {
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;

                    // ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

                    let imageData = video.toDataURL('image/png');
                    $.ajax({
                        type: 'POST',
                        url: 'upload.php',
                        data: {
                            capturedImage: imageData.split(',')[1],
                            userId: " . $userId . "
                        },
                        success: function (response) {
                         canvases.forEach((canvas, index) => {
                            let ctx = canvas.getContext('2d');
                            let img = new Image();
                            // img.onload = function () {
                                ctx.clearRect(0, 0, canvas.width, canvas.height);
                                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                            // };
                            img.src = response;
                            // $('.canvaImg').attr('src','./'+response);
                            $('.canvaImg').attr('src', './uploads/testImg.jpg');
                        // });
                        // console.log('Response from canvas ' + (index + 1) + ':', response);
                        console.log(response);
                        },
                        error: function (error) {
                            console.error('Error occurred for canvas ' + (index + 1) + ':', error);
                        }
                    });
                });
            }

    </script>";

    require_once 'config.php';

    $stmt = $pdo->prepare("SELECT data FROM data WHERE fromUserId = 2 LIMIT 1;");
    $stmt->execute();
    $image = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($image) {
        $imageSrc = htmlspecialchars($image['data'], ENT_QUOTES, 'UTF-8'); // सुरक्षा के लिए एस्केपिंग
        // echo "<script>
        //     document.addEventListener('DOMContentLoaded', function() {
        //     console.log(" . ${$imageSrc} . ");
        //         document.querySelector('.bcgImg').src = '$imageSrc'; // ✅ सीधा सही तरीके से जोड़ें
        //     });
        // </script>";
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.querySelector('.bcgImg').src = '$imageSrc';
                });
            </script>";
    } else {
        echo "<script>
            console.warn('Did Not Found Any Image!');
            // alert('Did Not Found Image!');
        </script>";
    }

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>