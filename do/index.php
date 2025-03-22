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
                        echo '<canvas class="canvas canvas' .$i . '"><img src="" alt="THE IMAGE" class=" text-warning canvaImg'.$userId.'"></canvas>';
                    }
                ?>
                <video id="video" class="canvas" autoplay></video>
            </div>
            <div class="actions">
                <button class="btn btn-green" onclick="startCamera()">🎥 On Camera</button>
                <button class="btn btn-green" onclick="offCamera()">📷 Off Camera</button>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous">
    </script>
    <script src="script.js"></script>
    <?php
    echo "<script>
            let video = document.querySelector('video');
                let canvas = document.querySelector('.canvas".$userId."');
                let ctx = canvas.getContext('2d');
                // console.log('Your Canvas:');
                // console.log(canvas);

            function captureImage() {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

                let imageData = canvas.toDataURL('image/png');
                let userId = ".$userId.";
                
                console.log('Going For AJAX');
                $.ajax({
                    type: 'POST',
                    url: 'upload.php',
                    data: { capturedImage: imageData, userId: userId },
                    success: function(response) {
                        response=JSON.parse(response);
                        const updatedImages = response.updatedImages;
                        console.log(updatedImages);

                        // console.log(response);
                        let img = document.querySelector('.canvaImg".$userId."');
                        img.src = response.imagePath;
                        // img.src = response;
                        img.alt = 'Captured Image';
                        img.style.backgroundColor = 'gold';

                        img.onload = function() {
                            ctx.clearRect(0, 0, canvas.width, canvas.height);
                            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                        };
                        console.log('Came From AJAX');
                    },
                    error: function(xhr, status, error) {
                        console.error('❌ Error: ', error);
                    }
                });
            }
        </script>";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>