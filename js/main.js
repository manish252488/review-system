var pvalue=0;

function show_loading()
{
	document.getElementById('load').style.display='block';
	setTimeout(hide_loading,1000);
    
}
function hide_loading() {
		document.getElementById('load').style.display='none';
}
function changestar(x) {
	if (x==1) 
	{
		document.getElementById('pstar1').src='icons/redstar.ico';
		document.getElementById('pstar2').src='icons/star.ico';
		document.getElementById('pstar3').src='icons/star.ico';
		document.getElementById('pstar4').src='icons/star.ico';
		document.getElementById('pstar5').src='icons/star.ico';
		pvalue=1;
		document.getElementById('inputrate').value=pvalue;
		alert("Your rating have been submitted: 1 STARS");
		document.getElementById('formele').submit();
		
	}else
	if (x==2) 
	{
		document.getElementById('pstar1').src='icons/redstar.ico';
		document.getElementById('pstar2').src='icons/redstar.ico';
		document.getElementById('pstar3').src='icons/star.ico';
		document.getElementById('pstar4').src='icons/star.ico';
		document.getElementById('pstar5').src='icons/star.ico';
			pvalue=2;
			document.getElementById('inputrate').value=pvalue;
			alert("Your rating have been submitted: 2 STARS");
			document.getElementById('formele').submit();
	
	}else
	if (x==3)
	{
		document.getElementById('pstar1').src='icons/glowstar.ico';
		document.getElementById('pstar2').src='icons/glowstar.ico';
		document.getElementById('pstar3').src='icons/glowstar.ico';
		document.getElementById('pstar4').src='icons/star.ico';
		document.getElementById('pstar5').src='icons/star.ico';
			pvalue=3;
			document.getElementById('inputrate').value=pvalue;
			alert("Your rating have been submitted: 3 STARS");
			document.getElementById('formele').submit();
	}else
	if (x==4) 
	{
		document.getElementById('pstar1').src='icons/green.ico';
		document.getElementById('pstar2').src='icons/green.ico';
		document.getElementById('pstar3').src='icons/green.ico';
		document.getElementById('pstar4').src='icons/green.ico';
		document.getElementById('pstar5').src='icons/star.ico';
			pvalue=4;
			document.getElementById('inputrate').value=pvalue;
			alert("Your rating have been submitted: 4 STARS");
			document.getElementById('formele').submit();
	}else
	if (x==5)
	 {
	 	document.getElementById('pstar1').src='icons/green.ico';
		document.getElementById('pstar2').src='icons/green.ico';
		document.getElementById('pstar3').src='icons/green.ico';
		document.getElementById('pstar4').src='icons/green.ico';
		document.getElementById('pstar5').src='icons/green.ico';
		pvalue=5;
		document.getElementById('inputrate').value=pvalue;
		alert("Your rating have been submitted: 5 STARS");
		document.getElementById('formele').submit();
	 }
}

function validate()
{
	if (pvalue=='0'||qvalue=='0'||uvalue=='0') 
	{
		document.getElementById('err').innerHTML='*rating cannot be zero';
		return false;
	}
	else
		return true;
}