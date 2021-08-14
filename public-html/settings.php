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
                        placeholder="Enter your first name" 
                        onkeyup="jsSettingsValidateName()">
				<?php if ($_SESSION["msgid"]=="201") { ?>
                    <div class="invalid-feedback">
                        <?php echo (phpShowInputFeedback($_SESSION["msgid"])[1]); ?>
                    </div>
                <?php } ?>
                
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
                        placeholder="Enter your last name" 
                        onkeyup="jsSettingsValidateName()">
                <?php if ($_SESSION["msgid"]=="202") { ?>
                    <div class="invalid-feedback">
                        <?php echo (phpShowInputFeedback($_SESSION["msgid"])[1]); ?>
                    </div>
                <?php } ?>

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
                        placeholder="Enter your nickname" 
                        onkeyup="jsSettingsValidateName()">
                <?php if ($_SESSION["msgid"]=="203") { ?>
                    <div class="invalid-feedback">
                        <?php echo (phpShowInputFeedback($_SESSION["msgid"])[1]); ?>
                    </div>
                <?php } ?>
			</div>
			<button type="submit" id="formSettingsBasicsSubmit" class="btn btn-primary btn-success">Save</button>
		</form>
	</div>
</div>
