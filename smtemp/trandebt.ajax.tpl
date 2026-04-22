{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="корекция на длъжник за превод" WIDTH=400}
{include file="_erform.tpl"}

<br>
Избери длъжник за превод на сумата <b>{$ARDATA.amount|tomo3}</b> 
<br>
{include file="_select.tpl" FROM=$ARDEBTNAME ID="iddebtor" C1="input" C2="inputer" ONCH=getiban(this);}
<br>
<div id="debtiban"></div>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}

<script>
function getiban(obje){ldelim}
	var valu= $(obje).get(0).options[$(obje).get(0).selectedIndex].value;
	jQuery.ajax({ldelim}
		url: "trandebtiban.ajax.php?p="+valu
		,success: ibansucc
		{rdelim});
{rdelim}
function ibansucc(data){ldelim}
	var arre= data.split("^");
//alert(data);
	var text;
	if (arre[0]=="ok"){ldelim}
		if (arre[1]==""){ldelim}
			text= "";
		{rdelim}else{ldelim}
			text= "iban= <b>"+arre[1]+"</b>";
		{rdelim}
		$("#debtiban").html(text);
	{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
{rdelim}
</script>
