$(document).ready(function(){
  var play = 1;

clickable = function(a){
      var clickables = [];
      if (a==11) {
        clickables = [12,21,22];
      }

      else if(a>11 && a<17){
        clickables = [a-1,a+1,a+9,a+10,a+11];
      }

      else if (a==17) {
        clickables = [16,26,27];
      }

      else if (a == 21 ||a == 31 ||a == 41 ||a == 51 ||a == 61 ) {
        clickables = [a-10,a-9,a+1,a+10,a+11];
      }

      else if (a == 27 ||a == 37 ||a == 47||a == 57 ||a == 67 ) {
        clickables = [a-11,a-10,a-1,a+9,a+10];
      }

      else if (a>21 && a<67){
        clickables = [a-11,a-10,a-9,a-1,a+1,a+9,a+10,a+11];
      }

      else if (a>71 && a<77) {
        clickables = [a-11,a-10,a-9,a-1,a+1];
      }

      else if (a == 71){
        clickables = [61,62,72];
      }

      else if (a== 77) {
        clickables =[66,67,76];
      }
      var idd1 = parseInt($('.box:contains("Player 1")').attr("id"));
      var idd2 = parseInt($('.box:contains("Player 2")').attr("id"));
      n = clickables.length;
      var j;
      var a1 = clickables.slice(0,n);
      for (var i = 0; i<n; i++) {
        if ($('#' + a1[i]).hasClass('dead') || a1[i] == idd2 || a1[i] == idd1) {
          j = clickables.indexOf(a1[i]);
          clickables.splice(j,1);

        }
      }
      return clickables;

    }

function colorify(tiles,p){                  // Function to colour the squares where the user can move.
  
  for(var k=0;k<tiles.length;k++){
    if(tiles[k]!=p)
      $('#'+tiles[k]).addClass('movable');
  }
}


function decolorify(tiles){                  // Function to undo the changes done by colorify
  for(var k=0;k<tiles.length;k++){
    $('#'+tiles[k]).removeClass('movable');
  }
}

  

 var s=$('.box1:contains("Player 1")').attr('id');     // Block to colour the places where player 1 can move initially
  var t=parseInt(s);

  colorify(clickable(t),0);


function eatSpace(a){
  $("#" +  a).addClass('dead');

}


//var s=$('.box:contains("Player 1")').attr('id');
//var s1 = parseInt(s);
$(".box").click(function(){
  if (play==4) {
    var pl1 = $('.box:contains("Player 1")').attr("id");
    var pl2 = $('.box:contains("Player 2")').attr("id");
    var id1 = $(this).attr("id");

    displayQuestion(id1);
    if(SHA1(result)==answer)
    {
      
    if (id1!=pl1 && id1!=pl2) {
      if (confirm("Player 2 Are you sure you want to eat up this space?")) {
        eatSpace(id1);
        play = 1;
      //  alert("Now, it's Player1's turn to move.")
      $(".alert").html('<h4 style="text-align: center;"><strong>Move ! Move ! </strong> <em>Player 1 </em> its time to move your Zombie.</h4>');
      }
    }
  
  $(this).removeAttr("id");
  }



  if (play==3) {
    a= parseInt($(this).attr("id"));
    var b = $(this).attr("id");
    var s=$('.box1:contains("Player 2")').attr('id');
    var id = parseInt(s);
    var q =clickable(id);
    var content,new_box;
    if (q.length == 0) {
      //alert("Player2 Lost.");
      $('.alert').html('<h4 style="text-align: center;"><strong>Wohoo ! Hurray ! </strong> <em>Player 1 </em> Wins.</h4>');
    }
    if (q.indexOf(a) != -1) {
      if (confirm('Do you want to move here ?')) {
    content = $('.box:contains("Player 2")').html();
    decolorify(clickable(id));   //Uncolour the coloured changes.

    $('#' + s).html(' ');
    $('#' + s).removeClass("btn-defualt");
    $('#' + s).addClass("btn-primary");
    $('#' + b).html(content);
    $('#' + b).removeClass("btn-primary");
    $('#' + b).addClass("btn-defualt");


    play = 4;
   // alert("Now it's player 2's time to eat up some space.");
   $(".alert").html('<h4 style="text-align: center;"><strong>Eat ! Eat ! </strong> <em>Player 2 </em> its time to Eat up.</h4>');
    }
  }
  }

  



  if (play==2) {
    var pl1 = $('.box:contains("Player 1")').attr("id");
    var pl2 = $('.box:contains("Player 2")').attr("id");
    //alert(pl1);
    var id1 = $(this).attr("id");

    displayQuestion(id1);
    
   if(SHA1(result)==answer)
    {
    
    if (id1!=pl1 && id1!=pl2) {
      if (confirm("Player 2 Are you sure you want to eat up this space?")) {
        eatSpace(id1);
        play = 1;
      //  alert("Now, it's Player1's turn to move.")
      $(".alert").html('<h4 style="text-align: center;"><strong>Move ! Move ! </strong> <em>Player 1 </em> its time to move your Zombie.</h4>');
      }
      $(this).removeAttr("id");
    
    
    }
  }



    if (id1!=pl1 && id1!=pl2) {
      if (confirm("Player 1 Are you sure you want to eat up this space?")) {
        eatSpace(id1);
        play = 3;
        colorify(clickable(parseInt(pl2)),parseInt(id1));   // Colour movable squares
      //  alert("Now, it's Player2's turn to move.")
      $(".alert").html('<h4 style="text-align: center;"><strong>Move ! Move ! </strong> <em>Player 2 </em> its time to move your Zombie.</h4>');
      }
    }
  }



  if (play==1) {
    a= parseInt($(this).attr("id"));
    var b = $(this).attr("id");
    var s=$('.box1:contains("Player 1")').attr('id');
    var id = parseInt(s);
    var q =clickable(id);
    var content,new_box;
    if (q.length===0) {
      //alert("Player1 Lost.");
      $('.alert').html('<h4 style="text-align: center;"><strong>Wohoo ! Hurray ! </strong> <em>Player 2 </em> Wins