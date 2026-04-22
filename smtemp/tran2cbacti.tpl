<script type="text/javascript">
var bankname= new Array();
{foreach from=$ARBANKPAYM item=nameba key=indxba}
bankname[{$indxba}]= "{$nameba}";
{/foreach}

{*-----------------------------------------------------*}
var worklinkacti;
var workinve, workpack;
function cboxaction(functx,linkacti){ldelim}
	worklinkacti= linkacti;
	var list= $("input[@type='checkbox']").not('.tranprntchck');
	var lico= "";
	var coun= 0;
	for (var i=0; i<list.length; i++){ldelim}
		if (list[i].checked){ldelim}
			lico += list[i].id+"/";
			coun ++;
		{rdelim}else{ldelim}
		{rdelim}
	{rdelim}
//return lico+"^"+coun;
	var cotext= functx(coun);
	var retu= confirm(cotext);
//alert(retu);
	if (retu){ldelim}
		jQuery.ajax({ldelim}
			url: "tran2sess.ajax.php?p="+lico
			,success: cboxsuccess
			{rdelim});
	{rdelim}else{ldelim}
	{rdelim}
{rdelim}
function cboxsuccess(data){ldelim}
	var arre= data.split("^");
//alert(data);
	if (arre[0]=="ok"){ldelim}
document.location.href= worklinkacti;
	{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
{rdelim}

function samebank(){ldelim}
	var list= $("input[@type='checkbox']").not('.tranprntchck');
	var cuobje, cubank;
	var whatbank= -1;
	for (var i=0; i<list.length; i++){ldelim}
		cuobje= list[i];
		if (cuobje.checked){ldelim}
			cubank= $(cuobje).attr("bank");
			if (whatbank==-1){ldelim}
var whatbank= cubank;
			{rdelim}else{ldelim}
				if (cubank==whatbank){ldelim}
				{rdelim}else{ldelim}
return 0;
				{rdelim}
			{rdelim}
		{rdelim}else{ldelim}
		{rdelim}
	{rdelim}
return whatbank;
{rdelim}
{*-----------------------------------------------------*}

function indeinve(inve,linkinve,idbank){ldelim}
	workinve= inve;
	var resubank= samebank();
//alert(resubank+'/'+typeof(resubank));
	if (resubank==-1){ldelim}
alert("Грешка при маркирането.\\nНЯМА маркирани суми.");
	{rdelim}else if (resubank==0){ldelim}
alert("Грешка при маркирането.\\nМаркирани са суми за различни банки.");
	{rdelim}else{ldelim}
		if (idbank!=0 && resubank!=idbank){ldelim}
alert("Грешка при маркирането.\\n"+inve+" е за банка "+bankname[idbank]+"\\nИма маркирани суми за други банки.");
		{rdelim}else{ldelim}
//alert("OOOK");
			cboxaction(indeinvetext,linkinve);
		{rdelim}
	{rdelim}
{rdelim}
function indeinvetext(coun){ldelim}
	if (coun==0){ldelim}
		var text= "ВСИЧКИТЕ "+{$PAGIPARA.TOTREC}+" превода от списъка";
	{rdelim}else{ldelim}
		var text= "само маркираните "+coun+" превода";
	{rdelim}
	text= "Към "+workinve+" ще бъдат включени \\n"+text;
return text;
{rdelim}

function exdeinve(){ldelim}
	cboxaction(exdeinvetext,'{$FROMINVE}');
{rdelim}
function exdeinvetext(coun){ldelim}
	if (coun==0){ldelim}
		var text= "ВСИЧКИТЕ "+{$PAGIPARA.TOTREC}+" превода от списъка";
	{rdelim}else{ldelim}
		var text= "само маркираните "+coun+" превода";
	{rdelim}
	text= "От описа ще бъдат изключени \\n"+text;
return text;
{rdelim}

function indepack(pack,linkpack,idbank){ldelim}
	workpack= pack;
	var resubank= samebank();
	if (resubank==-1){ldelim}
alert("Грешка при маркирането.\\nНЯМА маркирани суми.");
	{rdelim}else if (resubank==0){ldelim}
alert("Грешка при маркирането.\\nМаркирани са суми за различни банки.");
	{rdelim}else{ldelim}
		if (idbank!=0 && resubank!=idbank){ldelim}
alert("Грешка при маркирането.\\n"+pack+" е за банка "+bankname[idbank]+"\\nИма маркирани суми за други банки.");
		{rdelim}else{ldelim}
			cboxaction(indepacktext,linkpack);
		{rdelim}
	{rdelim}
{rdelim}
function indepacktext(coun){ldelim}
	if (coun==0){ldelim}
		var text= "ВСИЧКИТЕ "+{$PAGIPARA.TOTREC}+" превода от списъка";
	{rdelim}else{ldelim}
		var text= "само маркираните "+coun+" превода";
	{rdelim}
	text= "Към "+workpack+" ще бъдат включени \\n"+text;
return text;
{rdelim}

function exdepack(){ldelim}
	cboxaction(exdepacktext,'{$FROMPACK}');
{rdelim}
function exdepacktext(coun){ldelim}
	if (coun==0){ldelim}
		var text= "ВСИЧКИТЕ "+{$PAGIPARA.TOTREC}+" превода от списъка";
	{rdelim}else{ldelim}
		var text= "само маркираните "+coun+" превода";
	{rdelim}
	text= "От ПАКЕТА ще бъдат изключени \\n"+text;
return text;
{rdelim}

function inclmark(){ldelim}
	cboxaction(inclmarktext,'{$MARKDIRE}');
{rdelim}
function inclmarktext(coun){ldelim}
	if (coun==0){ldelim}
		var text= "ВСИЧКИТЕ "+{$PAGIPARA.TOTREC}+" превода от списъка";
	{rdelim}else{ldelim}
		var text= "само маркираните "+coun+" превода";
	{rdelim}
	text= "Ще бъдат трансформирани като отложени ръчни преводи \\n"+text;
return text;
{rdelim}

function exdemark(){ldelim}
	cboxaction(exdemarktext,'{$DEMARKDIRE}');
{rdelim}
function exdemarktext(coun){ldelim}
	if (coun==0){ldelim}
		var text= "ВСИЧКИТЕ "+{$PAGIPARA.TOTREC}+" превода от списъка";
	{rdelim}else{ldelim}
		var text= "само маркираните "+coun+" превода";
	{rdelim}
	text= "Ще бъдат премахнати като отложени ръчни преводи \\nи трансформирани обратно в чакащи \\n"+text;
return text;
{rdelim}

</script>
