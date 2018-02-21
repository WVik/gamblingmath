$(document).bind("mouseleave", function(e) {
    if (e.pageY - $(window).scrollTop() <= 1) {
        $('#BeforeYouLeaveDiv').show();
    }
});

var enteredAnswer=" ";
var correctAnswer=" ";
var rno = 0;
var score = 0;
var numOfQues = 0;
var pattern = /\d+/g;
var currentQuestion = 0;
var movable=[];
var dead=[];
var i=-1;
var ansId=0;
var qId = 0;
var currentOffset = 0;
var currBet = 0;


function ajaxCallCurrentQuestion(data){
  console.log("data"+data);
  var ajaxrequest = $.ajax({
  type: 'post',
  url: 'gameboarddetails.php',
  data: {cq:data}
  });
}



function ajaxCallAnsweredQuestions(data){
  console.log("data"+data);
  var ajaxrequest = $.ajax({
  type: 'post',
  url: 'gameboarddetails.php',
  data: {attempted:data}
  });
}

function ajaxCallNumberofQuestions(data){
  console.log("data"+data);
  var ajaxrequest = $.ajax({
  type: 'post',
  url: 'gameboarddetails.php',
  data: {nq:data}
  });
}

function ajaxCallScore(data){
  console.log("data"+data);
  var ajaxrequest = $.ajax({
  type: 'post',
  url: 'gameboarddetails.php',
  data: {score:data}
  });
}




/*function submitForm(e){
  console.log("He");
  var ans = prompt(question);
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
*/

function createBoard(){

    numOfQues = parseInt($('#numq').html());

    var nq = parseInt($('#numq').html());
    nq = 10-nq;

    console.log(nq);
    $('.numq').html(nq);


    score = parseInt($('#score').html());
    var correct = String($('#correct').html());
    var incorrect = $('#incorrect').html();
    var score = parseInt($('#score').html());
    $('.score').html(score);
    //currentQuestion = parseInt($('#cq').html());
    //currentQuestion = 0;
    rno = $('#rno').html();
    displayQuestion(currentQuestion);
    var redSquares = correct.match(pattern);
    //var greenSquares = incorrect.match(pattern);

    console.log(redSquares);
if(redSquares!=null){
    redSquares.forEach(function(data){          // Color dead squares red
       var d = parseInt(data);
       console.log(d);
       $('#'+d).addClass('dead');
    })
  }

/*
    greenSquares.forEach(function(data){       // Color movable squares green
       var d = parseInt(data);
       $('#'+d).addClass('movable');
    })
*/
}


//Scoring---------------------

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

//----------------------------



function displayQuestion(id,truID){
  if(id==0){
    return;
  }
    tid = parseInt(truID);
    $('#correct').append(", "+truID);
    currentOffset  =parseInt(id);
    var ansId = parseInt(id);
    var content = $('#q'+id).html();
    $('.questionContent').html(content);
    $('#cq').html(currentOffset);
    var attempted  = $('#correct').html();
    ajaxCallCurrentQuestion(parseInt(id));
    ajaxCallAnsweredQuestions(attempted);
    ajaxCallNumberofQuestions(numOfQues);

  }

function checkAnswer(enteredAnswer,qn){

     var ans = parseInt(enteredAnswer);

     var correctAnswer = $('#a'+currentQuestion).html();
     console.log(correctAnswer);
     console.log(SHA1(enteredAnswer));
     var currScore = parseInt($('.score').html());

     if(SHA1(enteredAnswer) == correctAnswer){
       {alert("Correct");currScore+=currBet;}
     }
     else
      {alert("Incorrect!");currScore-=currBet;}
      enteredAnswer = " ";
      $('#answer').val(" ");
      $('#answerSubmitButton').prop('disabled',true);
      $('.questionContent').html("Submitted! Pick Another Question!");

      $('.score').html(currScore);
      ajaxCallScore(currScore);
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

 //Initialize Random Number
           rno = parseInt($('#rno').html());
           createBoard();



          //------------------------------------
          $('.box').click(function(){



                if($(this).hasClass('dead'))
                     {alert("You already answered this question");return;}


                  if(enteredAnswer==" ")
                  {
                      if(currentQuestion!=0){

                      alert("You can't leave the question unanswered!");
                      return;
                      }
                  }

                  var bet = prompt("Place your bet for the question!");
                  console.log(bet);
                  if(bet==null)
                    return;

                  currBet = parseInt(bet);

                  if(!(20<=currBet && currBet<=50)){
                    alert("Please place a bet between 20 and 50!");
                    return;
                  }
                  //Enable Submit Button
                  $('#answerSubmitButton').prop('disabled',false);

                  if(numOfQues<10 && !$(this).hasClass('dead'))
                  {

                       if(!$(this).hasClass('movable'))
                                numOfQues++;
                          var nq = parseInt($('#numq').html());
                          nq = 10-nq;
                          nq--;
                          console.log(nq);
                          $('.numq').html(nq);

                         $(this).addClass('dead');
                         var id = $(this).attr('id');

                         var qId = parseInt((parseInt(id)+parseInt(rno))%50+1);
                         console.log(qId);
                         currentQuestion  =qId;
                         displayQuestion(parseInt(qId),id);
                   }
                  else
                    alert("You have already answered 10 questions!");
            });
          //-----------------------------------------


           $('#answerInput').submit(function(event){
                 event.preventDefault();

                 var answer = $('#answer').val();
                 enteredAnswer = parseInt(answer);

                 if(Number.isNaN(enteredAnswer)){
                     alert("Enter a valid numeric answer");
                     return;
                 }

                 var qno = parseInt($('#cq').html());
                 checkAnswer(enteredAnswer,qno);

                  /* $.ajax({
                      type: "POST",
                      url: "questionSubmit.php",
                      data: dataString,
                      cache: false,
                      success: function(result){
                        alert(result);
                      }
                    });*/
           });


               //Form submit stored in a variable "enteredAnswer"

          /*
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

          */

            //}

          $('.finish').click(function(){
            alert("Your score has been recorded. Thanks for playing GamblingMaths!");
          })













});
