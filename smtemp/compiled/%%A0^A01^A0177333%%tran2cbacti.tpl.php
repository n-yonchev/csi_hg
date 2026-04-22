<?php /* Smarty version 2.6.9, created on 2020-02-27 13:27:53
         compiled from tran2cbacti.tpl */ ?>
<script type="text/javascript">
var bankname= new Array();
<?php $_from = $this->_tpl_vars['ARBANKPAYM']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['indxba'] => $this->_tpl_vars['nameba']):
?>
bankname[<?php echo $this->_tpl_vars['indxba']; ?>
]= "<?php echo $this->_tpl_vars['nameba']; ?>
";
<?php endforeach; endif; unset($_from); ?>

var worklinkacti;
var workinve, workpack;
function cboxaction(functx,linkacti){
	worklinkacti= linkacti;
	var list= $("input[@type='checkbox']").not('.tranprntchck');
	var lico= "";
	var coun= 0;
	for (var i=0; i<list.length; i++){
		if (list[i].checked){
			lico += list[i].id+"/";
			coun ++;
		}else{
		}
	}
//return lico+"^"+coun;
	var cotext= functx(coun);
	var retu= confirm(cotext);
//alert(retu);
	if (retu){
		jQuery.ajax({
			url: "tran2sess.ajax.php?p="+lico
			,success: cboxsuccess
			});
	}else{
	}
}
function cboxsuccess(data){
	var arre= data.split("^");
//alert(data);
	if (arre[0]=="ok"){
document.location.href= worklinkacti;
	}else{
alert("ERROR"+String.fromCharCode(10)+data);
	}
}

function samebank(){
	var list= $("input[@type='checkbox']").not('.tranprntchck');
	var cuobje, cubank;
	var whatbank= -1;
	for (var i=0; i<list.length; i++){
		cuobje= list[i];
		if (cuobje.checked){
			cubank= $(cuobje).attr("bank");
			if (whatbank==-1){
var whatbank= cubank;
			}else{
				if (cubank==whatbank){
				}else{
return 0;
				}
			}
		}else{
		}
	}
return whatbank;
}

function indeinve(inve,linkinve,idbank){
	workinve= inve;
	var resubank= samebank();
//alert(resubank+'/'+typeof(resubank));
	if (resubank==-1){
alert("Грешка при маркирането.\\nНЯМА маркирани суми.");
	}else if (resubank==0){
alert("Грешка при маркирането.\\nМаркирани са суми за различни банки.");
	}else{
		if (idbank!=0 && resubank!=idbank){
alert("Грешка при маркирането.\\n"+inve+" е за банка "+bankname[idbank]+"\\nИма маркирани суми за други банки.");
		}else{
//alert("OOOK");
			cboxaction(indeinvetext,linkinve);
		}
	}
}
function indeinvetext(coun){
	if (coun==0){
		var text= "ВСИЧКИТЕ "+<?php echo $this->_tpl_vars['PAGIPARA']['TOTREC']; ?>
+" превода от списъка";
	}else{
		var text= "само маркираните "+coun+" превода";
	}
	text= "Към "+workinve+" ще бъдат включени \\n"+text;
return text;
}

function exdeinve(){
	cboxaction(exdeinvetext,'<?php echo $this->_tpl_vars['FROMINVE']; ?>
');
}
function exdeinvetext(coun){
	if (coun==0){
		var text= "ВСИЧКИТЕ "+<?php echo $this->_tpl_vars['PAGIPARA']['TOTREC']; ?>
+" превода от списъка";
	}else{
		var text= "само маркираните "+coun+" превода";
	}
	text= "От описа ще бъдат изключени \\n"+text;
return text;
}

function indepack(pack,linkpack,idbank){
	workpack= pack;
	var resubank= samebank();
	if (resubank==-1){
alert("Грешка при маркирането.\\nНЯМА маркирани суми.");
	}else if (resubank==0){
alert("Грешка при маркирането.\\nМаркирани са суми за различни банки.");
	}else{
		if (idbank!=0 && resubank!=idbank){
alert("Грешка при маркирането.\\n"+pack+" е за банка "+bankname[idbank]+"\\nИма маркирани суми за други банки.");
		}else{
			cboxaction(indepacktext,linkpack);
		}
	}
}
function indepacktext(coun){
	if (coun==0){
		var text= "ВСИЧКИТЕ "+<?php echo $this->_tpl_vars['PAGIPARA']['TOTREC']; ?>
+" превода от списъка";
	}else{
		var text= "само маркираните "+coun+" превода";
	}
	text= "Към "+workpack+" ще бъдат включени \\n"+text;
return text;
}

function exdepack(){
	cboxaction(exdepacktext,'<?php echo $this->_tpl_vars['FROMPACK']; ?>
');
}
function exdepacktext(coun){
	if (coun==0){
		var text= "ВСИЧКИТЕ "+<?php echo $this->_tpl_vars['PAGIPARA']['TOTREC']; ?>
+" превода от списъка";
	}else{
		var text= "само маркираните "+coun+" превода";
	}
	text= "От ПАКЕТА ще бъдат изключени \\n"+text;
return text;
}

function inclmark(){
	cboxaction(inclmarktext,'<?php echo $this->_tpl_vars['MARKDIRE']; ?>
');
}
function inclmarktext(coun){
	if (coun==0){
		var text= "ВСИЧКИТЕ "+<?php echo $this->_tpl_vars['PAGIPARA']['TOTREC']; ?>
+" превода от списъка";
	}else{
		var text= "само маркираните "+coun+" превода";
	}
	text= "Ще бъдат трансформирани като отложени ръчни преводи \\n"+text;
return text;
}

function exdemark(){
	cboxaction(exdemarktext,'<?php echo $this->_tpl_vars['DEMARKDIRE']; ?>
');
}
function exdemarktext(coun){
	if (coun==0){
		var text= "ВСИЧКИТЕ "+<?php echo $this->_tpl_vars['PAGIPARA']['TOTREC']; ?>
+" превода от списъка";
	}else{
		var text= "само маркираните "+coun+" превода";
	}
	text= "Ще бъдат премахнати като отложени ръчни преводи \\nи трансформирани обратно в чакащи \\n"+text;
return text;
}

</script>