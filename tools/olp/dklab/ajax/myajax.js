var req;

function toServer(p1){
	req= new Subsys_JsHttpRequest_Js();
	req.onreadystatechange= fromServer;
	req.caching= false;
	req.open('POST',_phname_,true);
document.body.style.cursor='wait';
//alert(typeof(p1));
/*
	if (p1==null){
//alert('contin');
						tose();
	}else{
//alert('begin');
		if (p1==0){
						req.send({ user: "", pass: "" });
		}else{
alert('erajax=1');
		}
	}
*/
	//	req.send({ vari: "menulist" });
		req.send();
}

function fromServer(){
	if (req.readyState == 4) {
document.body.style.cursor='auto';
		if (req.responseText==''){
		}else{
//	alert(req.responseText);
			document.getElementById(_iderro_).innerHTML = req.responseText;
		}
		if (req.responseJS) {
						fromse();
		}
	}
}


//---------------------------------------------------------------------
//var _phname_= "cp2.php";
var _phname_= "get.ajax.php";
var _iderro_= "iderror";
var adminlist;
var Menu;

//var ajaxpara;
//var listpa;
/*
function tose(){
	var user= document.getElementById('username').value;
	var pass= document.getElementById('passowrd').value;
	req.send({ user: user, pass: pass });
}
*/
function fromse(){
	var respon= req.responseJS;
	for (var elem in respon){
					if (elem=="adminlist"){
adminlist= respon[elem];
					}else if (elem=="menulist"){
menulist= respon[elem];
					}else{
		document.getElementById(elem).innerHTML= respon[elem];
					}
//alert(elem+'==='+respon[elem]);
	}
	var obus= document.getElementById("username");
	if (typeof(respon.ermess)=="string"){
//alert('undef');
		obus.focus();
	}else{
//alert('OK-defi');

//----------------------------------------
//----------------------------------------

			Menu = new MLM_Menu( 'Menu' );
var indx;
var jscall;
var m0, m1, m2, m3, m4;
var flagelem, indxelem;
var mymark;
for (indx in menulist){
	m0= menulist[indx][0];
	m1= menulist[indx][1];
	m2= menulist[indx][2];
	m3= menulist[indx][3];
						m4= menulist[indx][4];
//alert(typeof(m4)+"="+m4);
						if (adminlist){
/*
							if (typeof(m4)=="undefined"){
								m4= menulist[m1][4];
//alert("UNDEF="+m1+"="+m4);
								indxelem= adminlist.indexOf('[menu'+m4);
								flagelem= (indxelem !=-1);
							}else{
								indxelem= adminlist.indexOf('[menu'+m4);
								flagelem= (indxelem !=-1);
							}
*/
				if (m1=="main"){
					mymark= '[menu'+indx;
				}else{
					mymark= '[menu'+m1;
				}
				indxelem= adminlist.indexOf(mymark);
				flagelem= (indxelem !=-1);
//alert(indx+"="+m4+"="+flagelem);
//alert(indx+"="+flagelem);
						}else{
							flagelem= true;
						}
						if (flagelem){
	if (0){
	}else if (m2=="dire"){
		jscall= "javascript:tohref('"+m3+"');";
	}else if (m2=="fram"){
		jscall= "javascript:tohref('cpmain.php?vari="+m3+"');";
	}else if (m2=="js"){
		jscall= "javascript:"+m3;
	}else{
//alert("menu=type="+m3);
	}
	Menu.AddMenuItem(indx, m0, m0, jscall, m1);
						}else{
						}
}
			Menu.ShowMenu("mlm_menu");
			tohref('cphome.php');
//----------------------------------------

	}
}


//---------------------------------------------------------------------
function tohref(p1){
//var obje= document.getElementById('_fram_');
//alert("SCR="+obje.src);
//	document.getElementById('_fram_').src= p1 +"?mode=cp";
	document.getElementById('_fram_').src= p1;
}

function framhe(){
	var ifra= document.getElementById('_fram_');
	var h1= ifra.contentWindow.document.body.offsetHeight;
	var h2= ifra.contentWindow.document.body.scrollHeight;
//alert(h1+'/'+h2);
	ifra.height= (h1 +70) +"px";
}

/*
function repoprin(){
	var ifra= document.getElementById('_fram_');
	ifra.contentWindow.print();
}

function lout(){
	window.location.reload();
}
*/
