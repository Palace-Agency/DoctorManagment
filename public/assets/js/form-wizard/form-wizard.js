// 1. horizontal wizard
"use strict";
var currentTab = 0;
showTab(currentTab);
function showTab(n) {
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == x.length - 1) {
        document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
        document.getElementById("nextBtn").innerHTML = "Next";
    }
    fixStepIndicator(n);
}

function nextPrev(n) {
  var x = document.getElementsByClassName("tab");
 if (currentTab === 0) {
     var type = document.querySelector('input[name="type_ordonnance"]:checked');
     if (!type) {
         alert("Please select a type_ordonnance before proceeding.");
         return;
     }
 }
  x[currentTab].style.display = "none";
  currentTab = currentTab + n;
    if (currentTab >= x.length) {
        $("#nextBtn").attr("type", "submit");
        currentTab = 0;
    }

  showTab(currentTab);
}

function showTab2(n) {
    var x = document.getElementsByClassName("tab2");
    x[n].style.display = "block";
    if (n == 0) {
        document.getElementById("previousBtn").style.display = "none";
    } else {
        document.getElementById("previousBtn").style.display = "inline";
    }
    if (n == x.length - 1) {
        document.getElementById("nexttBtn").innerHTML = "Submit";
    } else {
        document.getElementById("nexttBtn").innerHTML = "Next";
    }
    fixStepIndicator(n);
}

function nextPrevious(n) {
    var x = document.getElementsByClassName("tab2");

    x[currentTab].style.display = "none";
    currentTab = currentTab + n;
    if (currentTab >= x.length) {
        $(".submitBtn").attr("type", "submit");
        currentTab = 0;
    }

    showTab2(currentTab);
}
// function nextPrev(n) {
//     // Get all form steps
//     var x = document.getElementsByClassName("tab");

//     // If the current tab is the first tab and the user hasn't selected a type_ordonnance, prevent moving forward
//     if (currentTab === 0) {
//         var type = document.querySelector(
//             'input[name="type_ordonnance"]:checked'
//         );
//         if (!type) {
//             alert("Please select a type_ordonnance before proceeding.");
//             return;
//         }
//     }

//     // Hide the current step if it exists
//     if (x[currentTab]) {
//         x[currentTab].style.display = "none";
//     } else {
//         console.log("Error: Current tab element is undefined");
//         return;
//     }

//     // Move to the next step
//     currentTab += n;

//     // If the current tab is the last one with content, hide the next button
//     if (currentTab >= x.length - 1) {
//         // Adjusted condition
//         // $("#nextBtn").hide();
//         return false;
//     }

//     showTab(currentTab);
// }






function validateForm() {
    var x,
        y,
        i,
        valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    for (i = 0; i < y.length; i++) {
        if (y[i].value == "") {
            y[i].className += " invalid";
            valid = false;
        }
    }
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className +=
            " finish";
    }
    return valid;
}
function fixStepIndicator(n) {
    var i,
        x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    x[n].className += " active";
}

// 2. Numbering wizard
var form = document.getElementById("msform");
var fieldsets = form.querySelectorAll("form");
var currentStep = 0;
var numSteps = 5;

for (var i = 1; i < fieldsets.length; i++) {
    fieldsets[i].style.display = "none";
}

function nextStep() {
    document.getElementById("backbtn").disabled = false;
    currentStep++;
    if (currentStep > numSteps) {
        currentStep = 1;
    }
    var stepper = document.getElementById("stepper1");
    var steps = stepper.getElementsByClassName("step");

    Array.from(steps).forEach((step, index) => {
        let stepNum = index + 1;
        let stepLength = steps.length;
        if (stepNum === currentStep && currentStep < stepLength) {
            addClass(step, "editing");
            fieldsets[currentStep].style.display = "flex";
        } else {
            removeClass(step, "editing");
        }
        if (stepNum <= currentStep && currentStep < stepLength) {
            addClass(step, "done");
            addClass(step, "active");
            removeClass(step, "editing");
            fieldsets[currentStep - 1].style.display = "none";
        } else {
            removeClass(step, "done");
        }
        if (currentStep == stepLength - 1) {
            document.getElementById("nextbtn").textContent = "Finish";
        }
        if (currentStep > stepLength - 1) {
            document.getElementById("nextbtn").textContent = "Finish";
            addClass(step, "done");
            addClass(step, "active");
            removeClass(step, "editing");
            document.getElementById("nextbtn").disabled = true;
        }
    });
}

function backStep() {
    currentStep--;
    var stepper = document.getElementById("stepper1");
    var steps = stepper.getElementsByClassName("step");
    let stepLength = steps.length;
    document.getElementById("nextbtn").textContent = "Next";
    document.getElementById("nextbtn").disabled = false;
    if (currentStep < stepLength - 1) {
        document.getElementById("backbtn").disabled = false;
        fieldsets[currentStep + 1].style.display = "none";
        fieldsets[currentStep].style.display = "flex";
        removeClass(steps[currentStep], "done");
        removeClass(steps[currentStep], "active");
        if (currentStep == 0) {
            document.getElementById("backbtn").disabled = true;
        }
    } else {
        removeClass(steps[currentStep], "done");
        removeClass(steps[currentStep], "active");
    }
}

// function prevStep(){
//   fieldsets[currentStep].style.display = "none";
//   currentStep--;
//   fieldsets[currentStep].style.display = "block";
// }

/* get, set class, see https://ultimatecourses.com/blog/javascript-hasclass-addclass-removeclass-toggleclass */

function hasClass(elem, className) {
    return new RegExp(" " + className + " ").test(" " + elem.className + " ");
}

function addClass(elem, className) {
    if (!hasClass(elem, className)) {
        elem.className += " " + className;
    }
}

function removeClass(elem, className) {
    console.log("elem, className", elem, className);
    var newClass = " " + elem.className.replace(/[\t\r\n]/g, " ") + " ";
    if (hasClass(elem, className)) {
        while (newClass.indexOf(" " + className + " ") >= 0) {
            newClass = newClass.replace(" " + className + " ", " ");
        }
        elem.className = newClass.replace(/^\s+|\s+$/g, "");
    }
    console.log("elem.className", elem.className);
}
