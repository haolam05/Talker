<?php 
    session_start(); 
    require('system.ctrl.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TALKER</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-12 col-md-auto"><h1>TALKER | SIGN UP</h1></div>
        </div>

        <hr><br>

        <!-- SYSTEM-WIDE FEEDBACK -->                                           
        <?php if (isset($_SESSION["msgid"]) && $_SESSION["msgid"]!="" && phpShowSystemFeedback($_SESSION["msgid"])[0]!="") { ?>

            <div class="row">
                <div class="col-12">
                    <div class="alert alert-<?php echo (phpShowSystemFeedback($_SESSION['msgid'])[0]); ?>" role="alert">
                        <?php echo (phpShowSystemFeedback($_SESSION['msgid'])[1]); ?>
                    </div>
                </div>
            </div>

        <?php } ?>
        <!-- SYSTEM-WIDE FEEDBACK -->

        <div class="row">
            <div class="col-6">
                <form name='formSignUp' action='signup.ctrl.php' method='POST' novalidate>
                    <div class="form-group">
                        <label for="formSignUpEmail">Email address</label>
                        <input      type="email" 
                                    <?php echo (phpShowEmailInputValue($_SESSION['formSignUpEmail'])); ?>
                                    class="form-control 
                                        <?php 
                                            if ($_SESSION['msgid'] != '801' && $_SESSION['msgid'] != '') { 
                                                echo 'is-valid'; 
                                            } else { 
                                                echo phpShowInputFeedback($_SESSION['msgid'])[0]; 
                                            } 
                                        ?>" 
                                    id="formSignUpEmail" 
                                    placeholder="Enter your email address" 
                                    onkeyup="jsSignUpValidateEmail()"
                                    name="formSignUpEmail">
                                    <?php if ($_SESSION['msgid'] == '801') { ?>
                                            <div class="invalid-feedback">
                                                <?php echo phpShowInputFeedback($_SESSION['msgid'])[1]; ?>
                                            </div>
                                    <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="formSignUpPassword">Password</label>
                        <input      type="password" 
                                    class="form-control <?php echo (phpShowInputFeedback($_SESSION['msgid'])[0]); ?>"
                                    id="formSignUpPassword" 
                                    placeholder="Enter your password" 
                                    onkeyup="jsSignUpValidatePassword()" 
                                    name="formSignUpPassword">
                                    <?php if ($_SESSION['msgid'] == '802') { ?>
                                            <div class="invalid-feedback">
                                                <?php echo (phpShowInputFeedback($_SESSION['msgid'])[1]); ?>
                                            </div>
                                    <?php } ?>                                    

                        <input      type="password" 
                                    class="form-control mt-4 <?php echo (phpShowInputFeedback($_SESSION['msgid'])[0]); ?>" 
                                    id="formSignUpPasswordConf" 
                                    placeholder="Confirm your password"  
                                    onkeyup="jsSignUpValidatePassword()" 
                                    name="formSignUpPasswordConf">  
                                    <?php if ($_SESSION['msgid'] == '803') { ?>
                                            <div class="invalid-feedback">
                                                <?php echo (phpShowInputFeedback($_SESSION['msgid'])[1]); ?>
                                            </div>
                                    <?php } ?>                                                                      
                    </div>
                    <p id="password_comparison"></p>
                    <button type="submit" id="formSignUpSubmit" class="btn btn-primary btn-success">Sign Up</button>
                </form>
            </div>

            <div class="col-6">
                <p>Hello and welcome to Talker! We are very happy that you want to join our great community!</p>
                <p>Please, enter your email and password. Your must have access to your email because we will send
            a confirmation code to that address. Your password must be between 8 and 16 characters long, with at
            least one uppercase and one lowercase character, one number and one special character (@, *, $ or #).</p>
                <p>We hope you'll enjoy Talker!</p>
            </div>
        </div>
    </div>

    <?php 
        $_SESSION["msgid"]=""; 
        $_SESSION["formSignUpEmail"]="";
    ?>

    <script>
        var jsSignUpPassword = document.getElementById("formSignUpPassword");
        var jsSignUpPasswordConf = document.getElementById("formSignUpPasswordConf");
        var jsPasswordRegexPattern = /(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@*$#]).{8,16}/;

        var jsSignUpEmail = document.getElementById("formSignUpEmail");            
        var jsEmailRegexPattern = /^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$/;

        // disabled 'Sign Up' button as default                                    
        document.getElementById("formSignUpSubmit").disabled = true;

        // replaces green with red box around 'Sign Up' button
        document.getElementById("formSignUpSubmit").classList.remove('btn-success');
        document.getElementById("formSignUpSubmit").classList.add('btn-danger');

        // if password and email patterns matched required regex and password == passwordConf, enable the 'Sign Up' button, otherwise, disabled it.
        function jsSignUpSubmitEnable() {
            if (jsEmailRegexPattern.test(jsSignUpEmail.value) && jsPasswordRegexPattern.test(jsSignUpPassword.value) && jsSignUpPassword.value == jsSignUpPasswordConf.value) {
                document.getElementById("formSignUpSubmit").disabled = false;
                
                // replaces red with green box around 'Sign Up' button
                document.getElementById("formSignUpSubmit").classList.remove('btn-danger');
                document.getElementById("formSignUpSubmit").classList.add('btn-success');
            } else {
                document.getElementById("formSignUpSubmit").disabled = true;
                
                // replaces green with red box around 'Sign Up' button
                document.getElementById("formSignUpSubmit").classList.remove('btn-success');
                document.getElementById("formSignUpSubmit").classList.add('btn-danger');
            }
        }

        function jsSignUpValidateEmail() {
            jsSignUpSubmitEnable();

            // checking email regex
            if (!jsEmailRegexPattern.test(jsSignUpEmail.value)) {

                // check this id so that error message will not be printed out every time user clicks a key.
                // we want the message to appear once and stay there unitl email regex is valid
                if (!document.getElementById("formSignUpEmailInvalidFeedback")) {
                    // add red box for email input using BS class: 'is-invalid'
                    jsSignUpEmail.classList.add("is-invalid");                                       

                    // creates a <div> element
                    var newElement = document.createElement("div");         

                    // sets an attribute id to check for <div> existance later
                    newElement.setAttribute('id', 'formSignUpEmailInvalidFeedback');                  

                    // BS requires <div class='invalid-feedback'> for $feedback_text, so we add this class to the div above                     
                    newElement.classList.add("invalid-feedback");  

                    // creates $feedback_text
                    var newElementContent = document.createTextNode("This is not a valid email address");

                    // adds feedback_text into the <div class="invalid-feedback">This is not a valid email address</div>
                    newElement.appendChild(newElementContent);          

                    //places this <div> element below email <input>                              
                    jsSignUpEmail.parentNode.insertBefore(newElement, jsSignUpEmail.nextSibling); 
                }
            } else {
                if (document.getElementById('formSignUpEmailInvalidFeedback')) {
                    // remove <div id="formSignUpEmailInvalidFeedback"> we created earlier for $feedback_text
                    document.getElementById("formSignUpEmailInvalidFeedback").parentNode.removeChild(document.getElementById("formSignUpEmailInvalidFeedback"));                    
                }
                
                // replaces red box with green box
                    // remove red box
                jsSignUpEmail.classList.remove("is-invalid");                
                    // add green box
                jsSignUpEmail.classList.add("is-valid");                     
            }
        }

        // checking password regex and whether passwords are matched
        function jsSignUpValidatePassword() {
            jsSignUpSubmitEnable();

            // checking password regex
            if (!jsPasswordRegexPattern.test(jsSignUpPassword.value)) {

                // check this id so that error message will not be printed out every time user clicks a key.
                // we want the message to appear once and stay there unitl email regex is valid
                if (!document.getElementById("formSignUpPasswordInvalidFeedback")) {
                    // add red box for email input using BS class: 'is-invalid'
                    jsSignUpPassword.classList.add("is-invalid");                                       

                    // creates a <div> element
                    var newElement = document.createElement("div");  

                    // sets an attribute id to check for <div> existance later
                    newElement.setAttribute('id', 'formSignUpPasswordInvalidFeedback');   

                    // BS requires <div class='invalid-feedback'> for $feedback_text, so we add this class to the div above                                 
                    newElement.classList.add("invalid-feedback");     

                    // creates $feedback_text                                 
                    var newElementContent = document.createTextNode("Password must be between 8 and 16 characters long, with at least one uppercase and lowercase character, one number and one special character (@, *, $ or #).");
                    
                    // adds feedback_text into the <div class="invalid-feedback">Password...</div>
                    newElement.appendChild(newElementContent);      

                    // places this <div> element below password <input> 
                    jsSignUpPassword.parentNode.insertBefore(newElement, jsSignUpPassword.nextSibling); 
                }
            } else if (jsSignUpPassword.value != jsSignUpPasswordConf.value) {
                if (document.getElementById('formSignUpPasswordInvalidFeedback')) {
                    // remove <div id="formSignUpPasswordInvalidFeedback"> we created earlier for $feedback_text
                    document.getElementById("formSignUpPasswordInvalidFeedback").parentNode.removeChild(document.getElementById("formSignUpPasswordInvalidFeedback"));
                }

                // replaces red box with green box 
                    // remove red box
                jsSignUpPassword.classList.remove("is-invalid");  
                    // add green box
                jsSignUpPassword.classList.add("is-valid");                   
                
                // check this id so that error message will not be printed out every time user clicks a key.
                // we want the message to appear once and stay there unitl email regex is valid                
                if (!document.getElementById("formSignUpPasswordConfInvalidFeedback")) {
                    // add red box for email input using BS class: 'is-invalid'
                    jsSignUpPasswordConf.classList.add("is-invalid");                  

                    // creates a <div> element
                    var newElement = document.createElement("div");  

                    // sets an attribute id to check for <div> existance later
                    newElement.setAttribute('id', 'formSignUpPasswordConfInvalidFeedback');   

                    // BS requires <div class='invalid-feedback'> for $feedback_text, so we add this class to the div above                 
                    newElement.classList.add("invalid-feedback");    

                    // creates $feedback_text                                     
                    var newElementContent = document.createTextNode("Passwords don't match!");

                    // adds feedback_text into the <div class="invalid-feedback">Password don't match</div>
                    newElement.appendChild(newElementContent);                                          

                    // places this <div> element below passwordConf <input> 
                    jsSignUpPasswordConf.parentNode.insertBefore(newElement, jsSignUpPasswordConf.nextSibling); 
                }
            } else {
                if (document.getElementById('formSignUpPasswordConfInvalidFeedback')) {
                    // remove <div id="formSignUpPasswordConfInvalidFeedback"> we created earlier for $feedback_text                
                    document.getElementById("formSignUpPasswordConfInvalidFeedback").parentNode.removeChild(document.getElementById("formSignUpPasswordConfInvalidFeedback"));
                }

                // replaces red box with green box 
                    // remove red box
                jsSignUpPasswordConf.classList.remove("is-invalid");                
                    // add green box
                jsSignUpPasswordConf.classList.add("is-valid");                     

            }
        }
    </script>

    <!-- Optional Javascript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
