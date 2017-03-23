var pattern = /\d{2}/g;


function createBoard(){
  p1pos = $('#p1pos').html();
  p2pos = $('#p2pos').html();
  redSuares = $('#redBox').html();
  
  var newRedSquares = [];
  var content1 = $('.box:contains("Player 1")').html();
  var content2 = $('.box:contains("Player 2")').html();
  $('#'+p1pos).html()=content1;
  $('#'+p2pos).html()=content2;
  $('#14').html()='';
  $('#74').html()='';
  
  redSuares.forEach(function(entry){
  	newRedSquares.push(parseInt(entry));
  });

 newRedSquares.forEach(function(entry){
  $('#'+entry).addClass('dead');
  });
  
}
 