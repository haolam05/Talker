var jsSettingsBasicsFirstName = document.getElementById("formSettingsBasicsFirstName");
var jsSettingsBasicsLastName = document.getElementById("formSettingsBasicsLastName");
var jsSettingsBasicsNickName = document.getElementById("formSettingsBasicsNickName");
var jsSettingsBasicsSubmit = document.getElementById("formSettingsBasicsSubmit");
var jsSettingsBasicsRegexPatternName = /^[a-zA-Z]{3,15}$/;

// button default as red and disabled
jsSettingsBasicsSubmit.disabled = true;
jsSettingsBasicsSubmit.classList.remove("btn-success");
jsSettingsBasicsSubmit.classList.add("btn-danger");

// if any of the 3 fields 1) is filled out and 2) matched required regex pattern => button turns green and is enable
function jsSettingsBasicsSubmitEnable() {
    if (jsSettingsBasicsRegexPatternName.test(jsSettingsBasicsFirstName.value) ||
        jsSettingsBasicsRegexPatternName.test(jsSettingsBasicsLastName.value) ||
        jsSettingsBasicsRegexPatternName.test(jsSettingsBasicsNickName.value)) {
        jsSettingsBasicsSubmit.disabled = false;
        jsSettingsBasicsSubmit.classList.remove("btn-danger");
        jsSettingsBasicsSubmit.classList.add("btn-success");
    } else {
        jsSettingsBasicsSubmit.disabled = true;
        jsSettingsBasicsSubmit.classList.remove("btn-success");
        jsSettingsBasicsSubmit.classList.add("btn-danger");
    }
}

// this is $feedback_text for 3 inputs of Basics form
function jsShowInputFeedback(elementId) {
    switch (elementId) {
        case "formSettingsBasicsFirstName":
            var feedbackMessage = "First name must be between 3 and 15 characters long and can contain only letters."
            break;

        case "formSettingsBasicsLastName":
            var feedbackMessage = "Last name must be between 3 and 15 characters long and can contain only letters."
            break;

        case "formSettingsBasicsNickName":
            var feedbackMessage = "Nickname must be between 3 and 15 characters long and can contain only letters."
            break;
    }

    return feedbackMessage;
}

function jsSettingsValidateName(elementId) {
    jsSettingsBasicsSubmitEnable();
    var element = document.getElementById(elementId);

    if (!jsSettingsBasicsRegexPatternName.test(element.value)) {
        if (!document.getElementById(elementId + "InvalidFeedback")) {
            element.classList.add("is-invalid");
            var newElement = document.createElement("div");
            newElement.setAttribute("id", elementId + "InvalidFeedback");
            newElement.classList.add("invalid-feedback");
            var newElementContent = document.createTextNode(jsShowInputFeedback(elementId));
            newElement.appendChild(newElementContent);
            element.parentNode.insertBefore(newElement, element.nextSibling);
        }
    } else {
        if (document.getElementById(elementId + "InvalidFeedback")) {
            document.getElementById(elementId + "InvalidFeedback").parentElement.removeChild(document.getElementById(elementId + "InvalidFeedback"));
        }
        element.classList.remove("is-invalid");
        element.classList.add("is-valid");
    }
}