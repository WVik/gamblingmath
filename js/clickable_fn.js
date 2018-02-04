var enteredAnswer=" ";
var correctAnswer=" ";
var rno = 0;
var score = 0;
var numOfQues = 0;
var pattern = /\d{2}/g;
var currentQuestion = 0;
var movable=[];
var dead=[];
var i=-1;
var ansId=0;
var qId = 0;

function submitForm(e){
   if(!currentQuestion)
    return;

   console.log(currentQuestion);
   var cQ = parseInt(currentQuestion);
   $('#'+cQ).addClass('dead');
   $('#'+cQ).removeClass('movable');
   dead.push($('#'+cQ).attr("id"));
   var index = movable.indexOf(parseInt($('#'+cQ).attr("id")));
   movable[index]=0;

   enteredAnswer = document.forms[1].elements[0].value;
   document.forms[1].elements[0].value="";
  console.log(enteredAnswer);

var result = checkAnswer(enteredAnswer);

     if(result==1){
         score=score+randomNumCorrect();
     }
     else{
      score = score+randomNumIncorrect();
     }

   $('.score').html(score);
  pop();

   //AJAX to update movable and dead matrix

}


function createBoard(){

    numOfQues = parseInt($('.numq').html());
    score = parseInt($('.score').html());
    var correct = $('.correct').html();
    var incorrect = $('.incorrect').html();
    currentQuestion = parseInt($('.currentq').html());
    rno = $('.rno').html();
    displayQuestion(currentQuestion);
    var redSquares = correct.match(pattern);
    var greenSquares = incorrect.match(pattern);


    redSquares.forEach(function(data){          // Color dead squares red
       var d = parseInt(data);
       $('#'+d).addClass('dead');
    })

    greenSquares.forEach(function(data){       // Color movable squares green
       var d = parseInt(data);
       $('#'+d).addClass('movable');
    })

}




function randomNumCorrect(){                  //If answer is correct
 console.log("correct");
 var x = -20+Math.floor(Math.random()*60);
 return x;
}

function randomNumIncorrect(){                 //If answer is incorrect
 var x = -40+Math.floor(Math.random()*60);
 console.log("incorrect");
 return x;
}


function displayQuestion(id){

    var qId = (id+rNum)%50;
     if(qId==0){
      qId=50;
     }

    var ansId = qId;

   

    $('.question').removeClass("hidden");
  }

function checkAnswer(enteredAnswer){

     var correctAnswer = $('#'+ansId).html();


     if(SHA1(enteredAnswer) == correctAnswer){
      return 1;
     }
     else
      return 0;
    pop();

}

function pop(){
$('.score').addClass('pop');

 setTimeout(function(){
  $('.score').removeClass('pop');
 },300);
}




var score=0;
var numOfQues=0;


$(document).ready(function(){
 pop();

 rNum = parseInt($('.rNum').html());

 createBoard();

$('.box').click(function(){
  if(numOfQues<10 && !$(this).hasClass('dead')){

     if(!$(this).hasClass('movable')){
     numOfQues++;}

     $(this).addClass('movable');
     var id = $(this).attr('id');
     currentQuestion = id;
     displayQuestion(id);

     //Form submit stored in a variable "enteredAnswer"


     if(enteredAnswer==NULL){




     var result = checkAnswer(enteredAnswer);

     if(result){
         score=score+randomNumCorrect();
     }
     else{
      score = score+randomNumIncorrect();
     }

     pop();

    }
     //Ajax to set score . Score post AJAX



  }
  else{
    alert("You have already answered 10 questions!");
  }



})


$('.finish').click(function(){

  alert("Your score has been recorded. Thanks for playing GamblingMaths!");


})













});
