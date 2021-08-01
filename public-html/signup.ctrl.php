<?php
    session_start();
    require('system.ctrl.php');

    $user_email = $_POST["formSignUpEmail"];
    $user_email_pattern = "~^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$~";
    
    $user_password = $_POST["formSignUpPassword"];
    $user_password_pattern = "~(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@*$#]).{8,16}~";

    $email_validation = preg_match($user_email_pattern, $user_email);
    $password_validation = preg_match($user_password_pattern, $user_password);

    if ($email_validation && $password_validation && $user_password == $_POST["formSignUpPasswordConf"]) {
        //checking if the submitted email is already in users table
        $db_data = array($user_email);
        $db_query = 'SELECT user_email FROM users WHERE user_email = ?';
        $isAlreadySignedUp = phpFetchDB($db_query, $db_data);

        //if no result is returned, insert new record to the table, otherwise display feedback
        if (!is_array($isAlreadySignedUp)) {
            $db_data = array($user_email, $user_password);
            $db_query = 'INSERT INTO users (user_email, user_password) values (?, ?)';
            phpModifyDB($db_query, $db_data);
            $_SESSION["msgid"] = "811";
        }else{
            $_SESSION["msgid"] = "804";
        }
        
        header('Location: index.php');
    } else if (!$email_validation) {
        $_SESSION['msgid'] = '801';
        header('Location: index.php');
    } else if (!$password_validation) {
        $_SESSION['msgid'] = '802';
        header('Location: index.php');
    } else if ($user_password != $_POST["formSignUpPasswordConf"]){
        $_SESSION['msgid'] = '803';
        header('Location: index.php');
    } 
    
    // echo '<br>' . $_POST["formSignUpPassword"] . '<br>';
    // echo $_POST["formSignUpPasswordConf"] . '<br>';
    // echo $email_validation . '<br>';
    // echo $password_validation . '<br>';
?>