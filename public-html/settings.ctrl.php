<?php
    session_start();
    require('system.ctrl.php');

    //BASICS FORM
    if(isset($_POST["formSettingsBasicsSubmit"])) {
        $user_firstname = $_POST["formSettingsBasicsFirstName"];
        $user_lastname = $_POST["formSettingsBasicsLastName"];
        $user_nickname = $_POST["formSettingsBasicsNickName"];
        $user_names_pattern = "~^[a-zA-Z]{3,15}$~";

        $firstname_validation = preg_match($user_names_pattern, $user_firstname);
        $lastname_validation = preg_match($user_names_pattern, $user_lastname);
		$nickname_validation = preg_match($user_names_pattern, $user_nickname);

        //query the database only if at least one name matches the regex pattern
        if ($firstname_validation || $lastname_validation || $nickname_validation) {
            //get the current values from the database and store them so we can potentially save them back if some value is actually empty
            $db_data = array($_SESSION["uid"]);
            $dbUserRow = phpFetchDB('SELECT * FROM users WHERE user_id = ?', $db_data);

            //check each of the three inputs validation, if not valid, assign the db value instead
            if (!$firstname_validation) {
                $user_firstname = $dbUserRow["user_firstname"];
            }
            if (!$lastname_validation) {
                $user_lastname = $dbUserRow["user_lastname"];
            }
            if (!$nickname_validation) {
                $user_nickname = $dbUserRow["user_nickname"];
            }

            //update the database row
            $db_data = array($user_firstname, $user_lastname, $user_nickname, $_SESSION["uid"]);
            phpModifyDB('UPDATE users SET user_firstname = ?, user_lastname = ?, user_nickname = ? WHERE user_id = ?', $db_data);

            //system feedback - your settings has been updated
            $_SESSION["msgid"] = "211";

        } else {
        
            //input feedback - for Javascript turned off
            if (!$firstname_validation && $user_firstname!="") {
                $_SESSION["msgid"] = "201";
            } else if (!$lastname_validation && $user_lastname!="") {
                $_SESSION["msgid"] = "202";
            } else if (!$nickname_validation && $user_nickname!="") {
                $_SESSION["msgid"] = "203";
            }
        }
    }

    if(isset($_POST["formSettingsBasicsClear"])) {
        //update the database row by setting empty strings
        $db_data = array("", "", "", $_SESSION["uid"]);
        phpModifyDB('UPDATE users SET user_firstname = ?, user_lastname = ?, user_nickname = ? WHERE user_id = ?', $db_data);

        //system feedback - your settings has been updated
        $_SESSION["msgid"] = "212";
    }

    header('Location: gate.php?module=settings');
?>