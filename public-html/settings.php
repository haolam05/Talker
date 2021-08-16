<?php
    $db_data = array($_SESSION["uid"]);
    $dbUserRow = phpFetchDB('SELECT * FROM users WHERE user_id = ?', $db_data);
?>

<h4>Basics</h4>
<hr>

<div class="row">
	<div class="col-lg-12">
		<form name="formSettingsBasics" action="settings.ctrl.php" method="POST" novalidate>
			<div class="form-group">
				<label for="formSettingsBasicsFirstName">First name</label>
				<input  type="text" 
                        class="form-control <?php 
                            if ($_SESSION['msgid']!='201' && $_SESSION['msgid']!='') { 
                                echo 'is-valid'; 
                            } else { 
                                echo (phpShowInputFeedback($_SESSION['msgid'])[0]); 
                            } 
                        ?>" 
                        id="formSettingsBasicsFirstName" 
                        name="formSettingsBasicsFirstName"
                        value="<?php echo $dbUserRow["user_firstname"]; ?>" 
                        placeholder="Enter your first name" 
                        onkeyup="jsSettingsValidateName('formSettingsBasicsFirstName')">
				<?php if ($_SESSION["msgid"]=="201") { ?>
                    <div class="invalid-feedback">
                        <?php echo (phpShowInputFeedback($_SESSION["msgid"])[1]); ?>
                    </div>
                <?php } ?>
            </div>
            
            <div class="form-group">
                <label for="formSettingsBasicsLastName">Last name</label>
                <input  type="text" 
                        class="form-control <?php 
                            if ($_SESSION['msgid']!='202' && $_SESSION['msgid']!='') { 
                                echo 'is-valid'; 
                            } else { 
                                echo (phpShowInputFeedback($_SESSION['msgid'])[0]); 
                            } 
                        ?>" 
                        id="formSettingsBasicsLastName" 
                        name="formSettingsBasicsLastName" 
                        value="<?php echo $dbUserRow["user_lastname"]; ?>" 
                        placeholder="Enter your last name" 
                        onkeyup="jsSettingsValidateName('formSettingsBasicsLastName')">
                <?php if ($_SESSION["msgid"]=="202") { ?>
                    <div class="invalid-feedback">
                        <?php echo (phpShowInputFeedback($_SESSION["msgid"])[1]); ?>
                    </div>
                <?php } ?>
            </div>

            <div class="form-group">
                <label for="formSettingsBasicsNickName">Nickname</label>
                <input  type="text" 
                        class="form-control <?php 
                            if ($_SESSION['msgid']!='203' && $_SESSION['msgid']!='') { 
                                echo 'is-valid'; 
                            } else { 
                                echo (phpShowInputFeedback($_SESSION['msgid'])[0]); 
                            } 
                        ?>" 
                        id="formSettingsBasicsNickName" 
                        name="formSettingsBasicsNickName" 
                        value="<?php echo $dbUserRow["user_nickname"]; ?>" 
                        placeholder="Enter your nickname" 
                        onkeyup="jsSettingsValidateName('formSettingsBasicsNickName')">
                <?php if ($_SESSION["msgid"]=="203") { ?>
                    <div class="invalid-feedback">
                        <?php echo (phpShowInputFeedback($_SESSION["msgid"])[1]); ?>
                    </div>
                <?php } ?>
			</div>
            
			<button type="submit" id="formSettingsBasicsSubmit" name="formSettingsBasicsSubmit" class="btn btn-primary btn-success">Save</button>
			<button type="submit" id="formSettingsBasicsClear" name="formSettingsBasicsClear" class="btn btn-primary btn-success">Clear</button>
		</form>
	</div>
</div>
