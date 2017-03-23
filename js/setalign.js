var winheight = $(window).height();

var winwidth = $(window).width();
tosetwinheight=winheight*0.8;
tosetwinwidth=winwidth*0.8;
$('#game').height(tosetwinheight);
$('#game').width(tosetwinwidth);

if (winheight<winwidth) {
	$('.box1').height(winheight/12);
	$('.box1').width(winheight/13);
} 
else {
	$('.box1').height(winwidth/13);
	$('.box1').width(winwidth/13);
}
