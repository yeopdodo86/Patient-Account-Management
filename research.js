window.onsubmit = validateResearch;


function validateResearch() {

	"use strict";

	var warningMessage = "";
 	var phoneFirstPart = document.getElementById('phoneFirstPart').value;
 	var phoneSecondPart = document.getElementById('phoneSecondPart').value;
 	var phoneThirdPart = document.getElementById('phoneThirdPart').value; 

	if((isNaN(phoneFirstPart) || phoneFirstPart.length !==3 ) ||
		(isNaN(phoneSecondPart) || phoneSecondPart.length !==3 ) ||
		(isNaN(phoneThirdPart) || phoneThirdPart.length !==4)
		 ){
		warningMessage +=  "Invalid phone number\n";
	}

	if((!document.getElementById('highBloodPressure').checked) &&
		(!document.getElementById('diabetes').checked) &&
		(!document.getElementById('glaucoma').checked) &&
		(!document.getElementById('asthma').checked) &&
		(!document.getElementById('none').checked)){
		warningMessage +=   "No conditions selected\n"
	}else if((document.getElementById('none').checked) &&
	(document.getElementById('highBloodPressure').checked ||
	document.getElementById('diabetes').checked ||
	document.getElementById('glaucoma').checked ||
	document.getElementById('asthma').checked)){
		warningMessage += "Invalid conditions selection\n";
	}

warningMessage += timePeriod(warningMessage);


	var firstFourDigits = document.getElementById('firstFourDigits').value;
	var secondFourDigits = document.getElementById('secondFourDigits').value;

	if ((firstFourDigits.length === 4 && firstFourDigits.charAt(0) === "A")
		&& (secondFourDigits.length === 4 && secondFourDigits.charAt(0) === "B")
       && (!isNaN(firstFourDigits.charAt(1))  && !isNaN(secondFourDigits.charAt(1)))
       && (!isNaN(firstFourDigits.charAt(2))  && !isNaN(secondFourDigits.charAt(2)))
        && (!isNaN(firstFourDigits.charAt(3))  && !isNaN(secondFourDigits.charAt(3)))){
//		var i = 1;
//		while(i < 5){
//			if(!isNaN(firstFourDigits.charAt(i)) && 
//				!isNaN(secondFourDigits.charAt(i))){
//				alert(i);
//			}else{
//                	warningMessage += "Invalid study id\n";
//            }
//			i+=i;
//		}
	}else{
		warningMessage += "Invalid study id\n";
	}


	if (warningMessage !== "") {
        alert(warningMessage);
         return false;
   	 } else {
        var valuesProvided = "Do you want to submit the form data?\n";

        if (window.confirm(valuesProvided)){
          return true;
        }else{    
           return false;
			
		}
	}
}

function timePeriod(warningMessage){


	if((!document.getElementById('Never').checked) &&
		(!document.getElementById('Less').checked) &&
		(!document.getElementById('One').checked) &&
		(!document.getElementById('More').checked)){
		return  "No time period selected\n";
	}
	return "";
}