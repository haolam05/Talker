<?php
    require("db-conn.inc.php");

    // Place directly inside Bootstrap container to keep the right structure of Bootstrap document
    function phpShowFeedback($feedback_id) {
        switch ($feedback_id) {
            case "801":
            $feedback_type="danger";
            $feedback_text="This is not a valid email address";
            break;

            case "802":
            $feedback_type="danger";
            $feedback_text="Password must be between 8 and 16 characters long, with at least one uppercase and lowercase character, one number and one special character (@, *, $ or #).";
            break;
            
            case "803":
            $feedback_type="danger";
            $feedback_text="Passwords don't match";
            break;

            case "811":
            $feedback_type="success";
            $feedback_text="You have been successfully signed up!";
            break;

            default:
            $feedback_type="danger";
            $feedback_text="Unspecified error or warning";
            break;
        }

        return '<div class="row">
                    <div class="col-12">
                        <div class="alert alert-' . $feedback_type . '" role="alert">
                            ' . $feedback_text . '
                        </div>
                    </div>
                </div>';
    }

    // Create, update or delete a record in the database
    function phpModifyDB($db_query, $db_data) {
        // global: look outside of this function(global scope) for this $connection variable
        global $connection;

        // prepare statements inserts placeholders: ? to avoid SQL injection
        $statement = $connection->prepare($db_query);

        // actual execution of query
        $statement->execute($db_data);
    }
?>