let ccNum = document.getElementById('c-number');
let typingAllowed = true;

ccNum.addEventListener('keydown', function(event) {
    if (typingAllowed) {
        typingAllowed = false;
        
        let num = ccNum.value.replace(/\s/g, '');
        if (!/^\d*$/.test(num)) {
            ccNum.style.border = "1px solid red";
        } else if (num.length < 16) {
            ccNum.style.border = "1px solid red";
        } else {
            ccNum.style.border = "1px solid greenyellow";
        }
    } else {
        event.preventDefault(); 
    }
});


ccNum.addEventListener('keyup', function() {
    typingAllowed = true; 
});


let cNumber = document.getElementById('number');
cNumber.addEventListener('keyup', function(e){
 let num = cNumber.value;


 let newValue = '';
 num = num.replace(/\s/g, '');
 for(var i = 0; i < num.length; i++) {
  if(i%4 == 0 && i > 0) newValue = newValue.concat(' ');
  newValue = newValue.concat(num[i]);
  cNumber.value = newValue;
 }


 let ccNum = document.getElementById('c-number');
 if(num.length<16){
  ccNum.style.border="1px solid red";
 }
 else{
  ccNum.style.border="1px solid greenyellow";
 }
});


let eDate = document.getElementById('e-date');
let typingAllowed1 = true; 

eDate.addEventListener('keydown', function(event) {
    if (typingAllowed1) {
        typingAllowed1 = false; 

       
        if (event.which !== 8) { 
            let numChars = eDate.value.length;
            if (numChars === 2) {
                eDate.value += '/'; 
                console.log(eDate.value.length);
            }
        }
    } else {
        event.preventDefault(); 
    }
});

eDate.addEventListener('keyup', function() {
    typingAllowed1 = true; 

    // Validate the input length
    if (eDate.value.length < 5) {
        eDate.style.border = "1px solid red"; 
    } else {
        eDate.style.border = "1px solid greenyellow"; 
    }
});




let cvv = document.getElementById('cvv');
cvv.addEventListener('keyup', function(e){


 let elen = cvv.value;
 let cvvBox = document.getElementById('cvv-box');
 if(elen.length<3){
  cvvBox.style.border="1px solid red";
 }else{
  cvvBox.style.border="1px solid greenyellow";
 }
})


