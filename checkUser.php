<?php
require_once "./do/config.php";
$name = $_POST['name'];
$user_pass = $_POST['password'];
$stmt = $pdo->prepare("select * from user where name= ?  and user_pass= ?");
$stmt->execute([$name, $user_pass]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
// print_r($user);
$returnArr = [];
if ($user) {
    $returnArr['success'] = TRUE;
    $returnArr['id'] = $user['id'];
    
    $stmt = $pdo->prepare("SELECT fromUserId FROM data WHERE fromUserId = ?;");
    $stmt->execute([$user['id']]);
    $thisUser = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    //Get Total Users;
    $stmt = $pdo->prepare("SELECT COUNT(id) FROM user;");
    $stmt->execute();
    $allUsers = $stmt->fetchColumn();
    if (!$thisUser) { //check is user alreadyLoggedIn==false
        for ($i = 1; $i <= $allUsers; $i++) {
            if ($i == $user['id']) {
                continue;
            }

            //Add In data Table For Updating In Future The Data Field,
            $stmt = $pdo->prepare("INSERT INTO data (fromUserId, toUserId)VALUES(?,?)");
            $stmt->execute([$user['id'], $i]);
        }
    }
    // $stmt = $pdo->prepare("SELECT data FROM data WHERE fromUserId = ?;");
    // $stmt->execute([$user['id']]);
    // $image = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $returnArr['success'] = FALSE;
}
echo json_encode($returnArr);