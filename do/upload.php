<?php
// try {
//     require_once "./config.php";

//     if (!is_dir('uploads')) {
//         mkdir('uploads', 0775, true);  // ✅ फोल्डर खुद से बना देगा अगर नहीं है
//     }

//     chmod('uploads', 0777);  // ✅ परमिशन दे देगा

//     if (isset($_POST['capturedImage'])) {
//         $imageData = $_POST['capturedImage'];
//         $imageName = "captured_" . time() . ".png";
//         $imagePath = "uploads/" . $imageName;
//         $userId = $_POST['userId'];
//         $imageSetted = NULL;

//         // ✅ इमेज को फोल्डर में सेव करें
//         if (file_put_contents($imagePath, base64_decode($imageData))) {
//             $imageSetted = TRUE;
//             // echo "id: $userId, Image: $imagePath";
//             // echo "Image Setted Successfully At Uploads Folder\n";
//         } else {
//             $imageSetted = FALSE;
//             echo "❌ Failed To Store Image By Taking From Database,";
//         }

//         //Get Total Users;
//         $stmt = $pdo->prepare("SELECT COUNT(id) FROM user;");
//         $stmt->execute();
//         $allUsers = $stmt->fetchColumn();

//         $stmt = $pdo->prepare("UPDATE data set data = ? WHERE fromUserId = ?");
//         $stmt->execute([$imagePath, $userId]);
//         if ($stmt->execute([$imagePath, $userId]))
//             echo $imagePath;
//     } else {
//         echo "Did Not Found Any Image Data,";
//     }
// } catch (PDOException $e) {
//     echo 'Error: ' . $e->getMessage();
// }

try {
    require_once "./config.php";

    if (!is_dir('uploads')) {
        mkdir('uploads', 0775, true);
    }
    if (isset($_POST['capturedImage'])) {
        $imageData = $_POST['capturedImage'];
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $decodedImage = base64_decode($imageData);

        $imageName = "captured_" . time() . ".png";
        $imagePath = "uploads/" . $imageName;
        $userId = $_POST['userId'];

        if (file_put_contents($imagePath, $decodedImage)) {
            // ✅ कुल उपयोगकर्ताओं की संख्या प्राप्त करें
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM user;");
            $stmt->execute();
            $allUsers = $stmt->fetchColumn(); // ✅ सही तरीका

            // ✅ सभी उपयोगकर्ताओं के लिए डेटा अपडेट करें
            for ($i = 1; $i <= $allUsers; $i++) {
                if($i== $userId)
                    continue;
                $stmt = $pdo->prepare("UPDATE data SET data = ? WHERE fromUserId = ? AND toUserId = ?");
                $stmt->execute([$imagePath, $userId, $i]);
            }
            echo $imagePath; // ✅ सफलतापूर्वक सेव किया गया इमेज पथ
        } else {
            echo "❌ Image Upload Failed!";
        }
    } else {
        echo "❌ No Image Data Received!";
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}