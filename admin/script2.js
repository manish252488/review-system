function show_loading()
{
	document.getElementById('load').style.display='block';
	setTimeout(hide_loading,1000);
    
}
function hide_loading() {
		document.getElementById('load').style.display='none';
}
