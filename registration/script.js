var letters = /^[a-zA-Z ]+$/;          //Regex pattern to identify names
var phone = /^[7-9]+[0-9]{9}$/;        //Regex pattern to identify phone number


//Function after clicking submit of player1
$('#submit1').on('click', function(e){
   e.preventDefault();

  var name1 = document.forms[0].elements[0].value;
  var college_name = document.forms[0].elements[2].value;
  var phone_number = document.forms[0].elements[3].value;
   if(validateData(name1,phone_number,college_name))
    {
    }
    else
    {return;}

   if(confirm("Is the information entered by you correct?")){
console.log("All Okay!");
 $('#form1').submit();
$('#player').addClass("disabled");

 }

console.log("All Okay!");

});




function validateData(name,phone_number,college_name){
	if(name.match(letters)&&college_name.match(letters))
    {

    }
  else
     {
     alert("Check Name or College Name fields! Please enter ONLY letters in these fields");
     return false;
     }

    if(phone_number.match(phone))
    {
      return true;
    }
    else
    {

      alert("Enter a valid phone number!");
      return false;
    }
}
