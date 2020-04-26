function validate() 
{
	document.getElementById('err1').innerHTML='';
	document.getElementById('err2').innerHTML='';
	document.getElementById('err3').innerHTML='';
	document.getElementById('err4').innerHTML='';
	document.getElementById('err5').innerHTML='';
	document.getElementById('err6').innerHTML='';
var fn="",sn="",ln="",cusid="";
fn=document.getElementById('fname').value;
fn=fn.trim();
sn=document.getElementById('mname').value;
sn=sn.trim();
ln=document.getElementById('lname').value;
ln=ln.trim();
cusid=document.getElementById('cus_id').value;
cusid=cusid.trim();
phno=document.getElementById('phno').value;
phno=phno.trim();
pin=document.getElementById('pcode').value;
pin=pin.trim();
shop=document.getElementById('shop').value;
shop=shop.trim();
var val1=check_name(fn,sn,ln);
var val2=check_cusid(cusid);
var val3=check_ph(phno);
var val4=check_pin(pin);
var val5=check_shopid(shop);
if(val1 && val2 && val3 && val4 && val5)
return true;
else
return false;
}
function check_shopid(x)
{
	patt1=/[^0-9]/g;
	if(patt1.test(x))
	{
		document.getElementById('err7').innerHTML='*Invalid';
 	return false;
	}
	else
		return true;
}
function check_name(x,y,z)
{
var patt2 = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
var patt1 = /[0-9]/g;
var c=0;
if(patt2.test(x)||patt1.test(x))
{
document.getElementById('err2').innerHTML='name cannot conatin special char or digit';
c++;
}
if(patt2.test(y)||patt1.test(y))
{
document.getElementById('err3').innerHTML='name cannot conatin special char or digit';
c++;
}
if(patt2.test(z)||patt1.test(z))
{
document.getElementById('err4').innerHTML='name cannot conatin special char or digit';
c++;
}
if(c==0)
	return true;
else
	return false;
}
function check_cusid(x)
{
	patt1=/[^0-9]/g;
	if(patt1.test(x))
	{
		document.getElementById('err1').innerHTML='*Invalid';
 	return false;
	}
	else
		return true;
}
function check_ph(x)
{
	patt1=/[^0-9]/g;
	if(patt1.test(x))
	{
		document.getElementById('err5').innerHTML='*Invalid';
 	return false;
	}
	else
		return true;
}
function check_pin(x)
{
	patt1=/[^0-9]/g;
	if(patt1.test(x))
	{
		document.getElementById('err6').innerHTML='*Invalid pincode';
 	return false;
	}
	else
		return true;
}
function validatepass()
{
	var pass1=document.getElementById('psw1').value;
	var pass2=document.getElementById('psw2').value;
	var patt2 = /[!#%^&*()+\-=\[\]{};':"\\|,.<>\/?]/;
	if (patt2.test(pass1)||patt2.test(pass2)) 
	{
			document.getElementById('err001').innerHTML='use only #$_';
			return false;
	}
	else
	if (pass1!=pass2)
	 {
	 	document.getElementById('err002').innerHTML='*re-type same pass';
			return false;
	 }
	 else
	 	return true;
}
function show_loading()
{
	document.getElementById('load').style.display='block';
	setTimeout(hide_loading,1000);
    
}
function hide_loading() {
		document.getElementById('load').style.display='none';
}
