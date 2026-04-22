{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="необхванати изх.документи" WIDTH=540}
{include file="_erform.tpl"}
<style>
.butt {ldelim}font: normal 8pt verdana; background-color:plum; padding:6px 10px 6px 10px; cursor:pointer; border: 0px solid black;{rdelim}
.fon7 {ldelim}font: normal 7pt verdana !important;{rdelim}
</style>

{include file="_tab2.tpl"}
				<table class="tab2" cellspacing='0' cellpadding='2' align=center>
				<tr class='head2'>
<td colspan='200'> Списък на изходящите документи по дело {$ROCASE.serial}/{$ROCASE.year}, необхванати за връчване
				<tr class='head2'>
<td> документ
<td> изходен
<td> описание
<td> адресат
<td> бележки
<td> &nbsp;
{foreach from=$ARNOPOST item=elem key=idout}
				<tr>
<td> {$elem.outseri}/{$elem.outyear}
<td class="fon7"> {$elem.registered|date_format:"%d.%m.%Y %H:%M:%S"}
<td> {$elem.descrip}
<td> {$elem.adresat}
<td class="fon7"> {$elem.notes}
<td align=center>
<input class="cbox" type=checkbox name="cbnopost[]" value="{$idout}" id="{$idout}">
{/foreach}
				<tr>
<td colspan=20>
{include file='_button.tpl' TYPE='submit' TITLE='назначи' NAME='submit' ID='submit'}
маркираните документи за връчване с призовкар
{*
	<div style="float:right">
<button class="butt" onclick="begi2();"> назначи </button>
маркираните документи за връчване с призовкар
	</div>
*}
				</table>

{***
<script>
var currlink;
function begi2(){ldelim}
	var list= $("input[@type='checkbox']");
	var lico= "";
	var coun= 0;
	for (var i=0; i<list.length; i++){ldelim}
		if (list[i].checked){ldelim}
			lico += list[i].id+"/";
			coun ++;
		{rdelim}else{ldelim}
		{rdelim}
	{rdelim}
alert(coun);
	if (coun==0){ldelim}
	{rdelim}else{ldelim}
alert('AJAX');
		jQuery.ajax({ldelim}
			url: "delidocucbox.ajax.php?list="+lico
			,success: succ2
			{rdelim});
	{rdelim}
{rdelim}
function succ2(data){ldelim}
alert(data);
	var arre= data.split("^");
	var ok= arre[0];
	if (ok=="ok"){ldelim}
//$.nyroModalManual({ldelim}forceType:'iframe', url:currlink{rdelim});
parent.location.href= "{$RELOLINK}";
	{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
{rdelim}
</script>
***}

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
