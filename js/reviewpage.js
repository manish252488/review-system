function displayblock(x)
{
	if (x==1) 
	{
		document.getElementById('block1').style.display='block';
		document.getElementById('block2').style.display='none';
		document.getElementById('block3').style.display='none';
		document.getElementById('b001').style.background='white';
		document.getElementById('b001').style.color='black';
		document.getElementById('b002').style.color='white';
		document.getElementById('b002').style.background='black';
		document.getElementById('b003').style.color='white';
		document.getElementById('b003').style.background='black';
	}else
	if (x==2) 
	{
		document.getElementById('block1').style.display='none';
		document.getElementById('block2').style.display='block';
		document.getElementById('block3').style.display='none';
		document.getElementById('b001').style.background='black';
		document.getElementById('b001').style.color='white';
		document.getElementById('b002').style.color='black';
		document.getElementById('b002').style.background='white';
		document.getElementById('b003').style.color='white';
		document.getElementById('b003').style.background='black';
	}else
	if (x==3) 
	{
		document.getElementById('block1').style.display='none';
		document.getElementById('block2').style.display='none';
		document.getElementById('block3').style.display='block';
			document.getElementById('b001').style.background='black';
		document.getElementById('b001').style.color='white';
		document.getElementById('b002').style.color='white';
		document.getElementById('b002').style.background='black';
		document.getElementById('b003').style.color='black';
		document.getElementById('b003').style.background='white';
	}
}
function openpanel()
{
	document.getElementById('console').style.display='block';
}
function checkval()
{
	var x=document.getElementById('check').value;
	if (x=="other") {
		document.getElementById('cate').style.display='block';
	}
	else
		document.getElementById('cate').style.display='none';
}