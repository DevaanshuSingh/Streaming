<?php
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
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM user;");
            $stmt->execute();
            $allUsers = $stmt->fetchColumn();

            for ($i = 1; $i <= $allUsers; $i++) {
                if($i== $userId)
                    continue;
                $stmt = $pdo->prepare("UPDATE data SET data = ? WHERE fromUserId = ? AND toUserId = ?");
                $stmt->execute([$imagePath, $userId, $i]);
            }
            $returnArr=[];
            $returnArr['imagePath']=$imagePath;
            // echo $imagePath; // Here The Self Captured Image Is Showing, Not By Fetching Database,

            //Fetch All Images From Database
            $stmt = $pdo->prepare("
                                    (SELECT * FROM data WHERE fromUserId = 1 LIMIT 1)
                                    UNION ALL
                                    (SELECT * FROM data WHERE fromUserId = 2 LIMIT 1)
                                    UNION ALL
                                    (SELECT * FROM data WHERE fromUserId = 3 LIMIT 1);
                                ");
            $stmt->execute();
            $updatedDatas = $stmt->fetchAll(PDO::FETCH_ASSOC); 

            $returnArr['updatedImages']=$updatedDatas;

            // print_r($updatedDatas);
            echo json_encode($returnArr);
        } else {
            echo "❌ Image Upload Failed!";
        }
    } else {
        echo "❌ No Image Data Received!";
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}