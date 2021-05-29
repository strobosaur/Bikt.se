<?php

// CHECK EMAIL INPUT FUNCTION
function isEmail($email) {
    if ((strpos($email, "@") == false) 
    || (strpos($email, ".") == false)
    || (strlen($email) < 6)
    || (strripos($email, ".") < strripos($email,"@"))) {
        return false;
    } else {
        return true;
    }
}

// INPUT PASSWORD IS THE RIGHT ONE / VERIFY
function passwordMatchesDB($userID, $password) {
    $userData = userExists($userID);

    // USER IN DATABASE?
    if ($userData === false) {
        return false;
    } else {
        // PASSWORD OK?
        $passwordHashed = $userData['passwordHash'];
        $pwdOK = password_verify($password, $passwordHashed);

        if ($pwdOK === false){
            return false;
        } else {
            return true;
        }
    }
}
    
// CHECK IF USER EXISTS IN DATABASE
function userExists($userID){

    // CHECK DATA TYPE
    if (gettype($userID) == "string") {

        // DATA TYPE STRING
        $db = new SQLite3("./db/labb1.db");        
        $sql = "SELECT * FROM 'users' WHERE nname = :nname OR email = :email";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $userID, SQLITE3_TEXT);
        $stmt->bindParam(':nname', $userID, SQLITE3_TEXT);
        
    } else if (gettype($userID) == "integer") {

        // DATA TYPE INTEGER
        $db = new SQLite3("./db/labb1.db");        
        $sql = "SELECT * FROM 'users' WHERE userID = :userID";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':userID', $userID, SQLITE3_INTEGER);
    }
    
    // EXECUTE STATEMENT
    $result = $stmt->execute();

    if($row = $result->fetchArray()) {
        $db->close();
        return $row;
    } else {
        $db->close();
        return false;
    }
}

// REGISTER USER TO DATABASE
function registerUserToDB($userFname,$userLname,$userNname,$userEmail,$password1,$password2) {

    // TRIM VARIABLES
    $userFnameValue = trim($userFname);
    $userLnameValue = trim($userLname);
    $userNnameValue = trim($userNname);
    $userEmailValue = trim($userEmail);

    // INPUT VALIDATION
    if (strlen($userFnameValue) < 2) {        
        return false;
    } else if (strlen($userLnameValue) < 2) {
        return false;
    } else if (strlen($userNnameValue) < 2) {
        return false;
    } else if (strlen($password1) < 8) {
        return false;
    } else if ($password1 !== $password2) {
        return false;
    } else if (!isEmail($userEmailValue)) {
        return false;
    } else if (userExists($userEmailValue)){
        return false;
    } else if (userExists($userNnameValue) !== false){
        return false;
    } else {

        //OPEN DATABASE
        $db = new SQLite3("./db/labb1.db");

        // HASH PASSWORD
        $hashedPwd = password_hash($password1, PASSWORD_DEFAULT);

        // PREPARE USERS DB QUERY
        $sql1 = "INSERT INTO 'users' (fname, lname, nname, email, passwordHash)
                            VALUES (:fname, :lname, :nname, :email, :passwordHash)";

        $stmt1 = $db->prepare($sql1);

        $stmt1->bindParam(':fname', $userFnameValue, SQLITE3_TEXT);
        $stmt1->bindParam(':lname', $userLnameValue, SQLITE3_TEXT);
        $stmt1->bindParam(':nname', $userNnameValue, SQLITE3_TEXT);
        $stmt1->bindParam(':email', $userEmailValue, SQLITE3_TEXT);
        $stmt1->bindParam(':passwordHash', $hashedPwd, SQLITE3_TEXT);

        // EXECUTE STATEMENT
        if ($stmt1->execute()){
            $db->close();
            return true;
        } else {
            $db->close();
            return false;
        }
    }
}

// FUNCTION UPDATE USER PROFILE
function updateUserProfile($userID,$userFname,$userLname,$userNname,$userEmail,$password1,$password2) {

    if ($password1 !== $password2) {
        header("location: profile.php?error=pwdmissmatch");
        exit();
    }

    // TRIM VARIABLES
    $userFnameValue = trim($userFname);
    $userLnameValue = trim($userLname);
    $userNnameValue = trim($userNname);
    $userEmailValue = trim($userEmail);

    // INPUT VALIDATION
    if (strlen($userFnameValue) < 2) {
        return false;
    } else if (strlen($userLnameValue) < 2) {
        return false;
    } else if (strlen($userNnameValue) < 2) {
        return false;
    } else if (strlen($password1) < 8) {
        return false;
    } else if (!isEmail($userEmailValue)) {
        return false;
    }
    
    // CHECK FOR EMAIL TAKEN
    $result = userExists($userEmailValue);
    if ($result !== false) {
        if ($result['userID'] != $userID) {
            return false;
        } 
    }
    
    // CHECK FOR USER NAME TAKEN
    $result = userExists($userNnameValue);
    if ($result !== false) {
        if ($result['userID'] != $userID) {
            return false;
        } 
    }

    //OPEN DATABASE
    $db = new SQLite3("./db/labb1.db");

    // HASH PASSWORD
    $hashedPwd = password_hash($password1, PASSWORD_DEFAULT);

    // PREPARE QUERY
    $sql = "UPDATE 'users' 
            SET fname = :fname, lname = :lname, nname = :nname, email = :email, passwordHash = :passwordHash
            WHERE userID = :userID";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':fname', $userFnameValue, SQLITE3_TEXT);
    $stmt->bindParam(':lname', $userLnameValue, SQLITE3_TEXT);
    $stmt->bindParam(':nname', $userNnameValue, SQLITE3_TEXT);
    $stmt->bindParam(':email', $userEmailValue, SQLITE3_TEXT);
    $stmt->bindParam(':passwordHash', $hashedPwd, SQLITE3_TEXT);
    $stmt->bindParam(':userID', $userID, SQLITE3_INTEGER);

    // EXECUTE STATEMENT
    if ($stmt->execute()){

        // UPDATE SESSION
        $_SESSION["userFname"] = $userFnameValue;
        $_SESSION["userLname"] = $userLnameValue;
        $_SESSION["userNname"] = $userNnameValue;
        $_SESSION["userEmail"] = $userEmailValue;

        $db->close();
        return true;

    } else {
        $db->close();
        return false;
    }    
}
    
// FUNCTION LOGIN USER TO SITE
function loginUser($userID, $password){

    // USER IN DATABASE?
    $userData = userExists($userID);

    if ($userData === false) {
        return false;
    }

    // CHECK PASSWORD MATCH
    if (passwordMatchesDB($userID, $password) === false) {
        return false;
    } else {
        session_start();

        $_SESSION["userID"] = $userData['userID'];
        $_SESSION["userFname"] = $userData['fname'];
        $_SESSION["userLname"] = $userData['lname'];
        $_SESSION["userNname"] = $userData['nname'];
        $_SESSION["userEmail"] = $userData['email'];
        $_SESSION["userProfileImg"] = $userData['profileImg'];
        $_SESSION["loggedIn"] = true;

        return true;
    }    
}

//FUNCTION LOG OUT USER
function logoutUser(){
    session_start();
    session_unset();
    session_destroy();
    return true;
}

// FUNCTION UPLOAD PROFILE IMAGE
function uploadProfileImg($userID,$fileName,$fileTmpName,$fileError) {

    $result = userExists($userID);
    $fileExt = end(explode('.', strtolower($fileName)));

    $allowedExtArr = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($fileExt, $allowedExtArr)) {
        if ($fileError === 0) {
            $fileNameNew = date("Ymd") . "_profile_" . $result['userID'] . "_" . mt_rand() . "." . $fileExt;
            $fileDestination = "./uploads/profile/" . $fileNameNew;
            move_uploaded_file($fileTmpName,$fileDestination);
            return $fileDestination;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

// FUNCTION CHANGE PROFILE IMAGE
function changeProfileImg($userID, $filePath) {

    $result = userExists($userID);

    // CHECK IF USER EXISTS
    if ($result != false) {
        $oldProfileImg = $result['profileImg'];
        $userEmail = $result['email'];

        // DELETE OLD PROFILE IMAGE
        if ($oldProfileImg != null) {
            unlink($oldProfileImg);
        }

        // PREPARE QUERY
        $db = new SQLite3("./db/labb1.db");

        $sql1 = "UPDATE 'users'
                SET profileImg = :profileImg
                WHERE email = :email";

        $stmt1 = $db->prepare($sql1);

        $stmt1->bindParam(':email', $userEmail, SQLITE3_TEXT);

        // UPDATE OR DELETE IMAGE
        if ($filePath !== null) {
            $stmt1->bindParam(':profileImg', $filePath, SQLITE3_TEXT);
        } else {
            $stmt1->bindParam(':profileImg', $filePath, SQLITE3_NULL);
        }

        // EXECUTE STATEMENT
        if ($stmt1->execute()) {
            $db->close();
            return $filePath;
        } else {
            $db->close();
            return false;
        }
    }
}

// FUNCTION FETCH PROFILE IMG
function fetchProfileImg($userID) {
    $result = userExists($userID);
    if ($result !== false) {
        if ($result['profileImg'] != null) {
            return $result['profileImg'];
        } else {
            return "./img/default_profile_img.png";
        }
    } else {
        return false;
    }
}
