function show_loading()
{
	document.getElementById('load').style.display='block';
	setTimeout(hide_loading,1000);
    
}
function hide_loading() {
		document.getElementById('load').style.display='none';
}
function displaynoti()
{
	document.getElementById('notification').style.display='none';
}
function display(x)
{
	if(x==1)
	{
		document.getElementById('block01').style.display='block';
		document.getElementById('block02').style.display='none';
		document.getElementById('block03').style.display='none';
		document.getElementById('block04').style.display='none';
	}
	if(x==2)
	{
				document.getElementById('block01').style.display='none';
		document.getElementById('block02').style.display='block';
		document.getElementById('block03').style.display='none';
		document.getElementById('block04').style.display='none';
	}
	if (x==3) 
	{
				document.getElementById('block01').style.display='none';
		document.getElementById('block02').style.display='none';
		document.getElementById('block03').style.display='block';
		document.getElementById('block04').style.display='none';
	}
	if (x==4) 
	{
				document.getElementById('block01').style.display='none';
		document.getElementById('block02').style.display='none';
		document.getElementById('block03').style.display='none';
		document.getElementById('block04').style.display='block';
	}
}
function submitform()
{
document.getElementById('m0001').submit();
}
function showsamepanel()
{
	document.getElementById('block01').style.display='none';
		document.getElementById('block02').style.display='block';
		document.getElementById('block03').style.display='none';
		document.getElementById('block04').style.display='none';
}
function showsearch(x)
{
	if (x==0) 
	{
		document.getElementById('searchid').style.display='block';
		document.getElementById('search001').style.display='none';
		document.getElementById('select001').style.display='block';
		document.getElementById('shop').style.display='none';
	}
	else
	{

		document.getElementById('searchid').style.display='none';
		document.getElementById('search001').style.display='block';
		document.getElementById('select001').style.display='none';
		document.getElementById('shop').style.display='block';
	}
}