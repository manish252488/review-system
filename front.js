function show_loading()
{
	document.getElementById('load').style.display='block';
	setTimeout(hide_loading,1000);
    
}
function hide_loading() {
		document.getElementById('load').style.display='none';
}
function slideshow() 
{
setTimeout(show2,3000);
}
function show2() {
	document.getElementById('frame2').src='images/image2.jpg';
setTimeout(show3,3000);
}
function show3() {
	document.getElementById('frame2').src='images/image3.jpg';
	
	setTimeout(slideshow,3000);

}
function openslide(x)
{
	if (x==1) 
	{
		document.getElementById('slides1').style.width='40vw';
		document.getElementById('slides2').style.width='2vw';
		document.getElementById('slides3').style.width='2vw';
		document.getElementById('slides4').style.width='2vw';
		document.getElementById('slides1').style.background='white';
	
	}
	if (x==2) 
	{
		document.getElementById('slides1').style.width='2vw';
		document.getElementById('slides2').style.width='40vw';
		document.getElementById('slides3').style.width='2vw';
		document.getElementById('slides4').style.width='2vw';
		document.getElementById('slides2').style.background='white';
	
	}
	if (x==3) 
	{
		document.getElementById('slides1').style.width='2vw';
		document.getElementById('slides2').style.width='2vw';
		document.getElementById('slides3').style.width='40vw';
		document.getElementById('slides4').style.width='2vw';
		document.getElementById('slides3').style.background='white';
	
	}
	if (x==4) 
	{
		document.getElementById('slides1').style.width='2vw';
		document.getElementById('slides2').style.width='2vw';
		document.getElementById('slides3').style.width='2vw';
		document.getElementById('slides4').style.width='40vw';
		document.getElementById('slides4').style.background='white';
	
	}
}
function closeslide()
{
	document.getElementById('slides1').style.width='2vw';
		document.getElementById('slides2').style.width='2vw';
		document.getElementById('slides3').style.width='2vw';
		document.getElementById('slides4').style.width='2vw';
		document.getElementById('slides1').style.background='linear-gradient(180deg,violet,indigo,blue,green,yellow,orange,red,violet,indigo,blue,green,yellow,orange,red)';
		document.getElementById('slides2').style.background='linear-gradient(180deg,violet,indigo,blue,green,yellow,orange,red,violet,indigo,blue,green,yellow,orange,red)';
		document.getElementById('slides3').style.background='linear-gradient(180deg,violet,indigo,blue,green,yellow,orange,red,violet,indigo,blue,green,yellow,orange,red)';
		document.getElementById('slides4').style.background='linear-gradient(180deg,violet,indigo,blue,green,yellow,orange,red,violet,indigo,blue,green,yellow,orange,red)';
}