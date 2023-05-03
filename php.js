    var signUp = document.getElementById('signupbutton');
    var special=/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
    

    function password(){
        var str= document.getElementById('id').value;
        if(textLength(str) && containsSpecialChars(str) && containsUppercase(str) && passwordsMatch())
            document.registeruser.submit();
        else
            alert('this doesn\'t work');
    }
    
    document.getElementById('id1').addEventListener('keypress',function(e){
        const key=e.key;
        const keyLower=key.toLowerCase();
        const isUpperCase=(key!==keyLower);
        var upper=false;
        var keypress;
        if(isUpperCase){
            upper=true;

        }
        if(!upper){
            console.log("We need capital");

        }
        if(!special.test(key)){
            console.log("We need special character");
                
        }
        
         
    })

    var oldValue = '';
    var alert = document.getElementById('alert'); // 10 characters
    var clear = document.getElementById('alert2'); // 1 UpperCase
    var okiDokie = document.getElementById('alert1'); // 1 Special Character
    var match = document.getElementById('alert3');
   
    

    document.getElementById('id1').onkeyup = function(){
        if(!textLength(this.value)){
            alert.style="display:visible";
            this.value = this.value;
            alert.style.color='red';
            console.log(document.getElementById('id1').value);
        } 
        else {
            alert.style.color='green';
            alert.style="display:none";
        }
        if(this.value!== this.value.toLowerCase()){
            clear.style.color='green';
            clear.style="display:none";
        } 
        else {
            clear.style="display:visible";
            clear.style.color='red';
        }
        if(containsSpecialChars(this.value)){
            okiDokie.style.color='green';
            okiDokie.style="display:none";
        } 
        else {
            okiDokie.style="display:visible";
            okiDokie.style.color='red';
        }
        if(document.getElementById('id1').value === document.getElementById('id').value){
            match.style.color='green';
            match.style="display:none";
        }
        else {
            match.style="display:visible";
            match.style.color='red';
        }
    }

    document.getElementById('id').onkeyup = function(){
        if(document.getElementById('id').value === document.getElementById('id1').value){
            match.style.color='green';
            match.style="display:none";
        }
        else {
            match.style="display:visible";
            match.style.color='red';
        }
    }
    
    function passwordsMatch(){
        if(document.getElementById('id').value === document.getElementById('id1').value)
            return true;
    }


    function containsUppercase(str) {
        return /[A-Z]/.test(str);
      }

    function textLength(value){
        var minLength = 10;
        if(value.length < minLength) return false;
        return true;
    }

    function containsSpecialChars(str) {
        const specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
        return specialChars.test(str);
    }

    document.getElementById('id').onkeydown=function() {
        var key = event.keyCode||event.charCode; // const {key} = event; ES6+
        if (key === 8) {
           if(document.getElementById('id1').value.length-1<10){
            alert.style.color='red';
           }
           else{
            alert.style.color='green';
           }
           if(containsSpecialChars(this.value)){
            okiDokie.style.color='green';
            } 
            else {
            okiDokie.style.color='red';
            }
        }
    }

   