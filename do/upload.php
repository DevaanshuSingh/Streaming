<?php
try {
    require_once "./config.php";


    if (!is_dir('uploads')) {
        mkdir('uploads', 0775, true);  // ✅ फोल्डर खुद से बना देगा अगर नहीं है
    }

    chmod('uploads', 0777);  // ✅ परमिशन दे देगा

    if (isset($_POST['capturedImage'])) {
        $imageData = $_POST['capturedImage'];
        $imageName = "captured_" . time() . ".png";
        $imagePath = "uploads/" . $imageName;
        $userId = $_POST['userId'];
        $imageSetted = NULL;

        // ✅ इमेज को फोल्डर में सेव करें
        if (file_put_contents($imagePath, base64_decode($imageData))) {
            $imageSetted = TRUE;
            // echo "id: $userId, Image: $imagePath";
            // echo "Image Setted Successfully At Uploads Folder\n";
        } else {
            $imageSetted = FALSE;
            echo "❌ Failed To Store Image By Taking From Database,";
        }

        //Get Total Users;
        $stmt = $pdo->prepare("SELECT COUNT(id) FROM user;");
        $stmt->execute();
        $allUsers = $stmt->fetchColumn();

        $stmt = $pdo->prepare("UPDATE data set data = ? WHERE fromUserId = ?");
        $stmt->execute([$imagePath, $userId]);
        if ($stmt->execute([$imagePath, $userId]))
            echo $imagePath;
    } else {
        echo "Did Not Found Any Image Data,";
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}