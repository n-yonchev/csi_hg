{include file="delihead.tpl"}
<style>
.inputlink {ldelim}background:khaki;font:normal 8pt verdana;{rdelim}
</style>

<br>
				<table class="tab2" cellspacing='0' cellpadding='2' align=center>
				<tr class='head1'>
<td colspan='200'>
{*
Списък на документи за връчване от външни източници според текущия филтър
Списък на документи за връчване от външни източници
*}
Списък на документи от външни източници според текущия филтър
&nbsp;&nbsp;&nbsp;&nbsp;
							{*
							<div style="float:right" class="doinpu">
							*}
							<span class="doinpu">
само от избран източник
{include file="_select.tpl" FROM=$ARSOURPOSTNAME ID="idsour" C1="inputlink" C2="input" 
ONCH="document.location.href=$(this).get(0).options[$(this).get(0).selectedIndex].value;"}
							</span>
							{*
							</div>
							*}
				<tr class='head2'>
<td> вх.ном
<td> дата
<td> източник
{*
<td> бележки
*}
<td> адресат
<td> адрес
<td> метод
<td class="head3"> взет
<td class="head3"> връчен
<td class="head3"> върнат
<td class="head3"> статус
<td class="head3"> бел
<td class="head3"> &nbsp;
<td class="head3"> <input class="cbox" type=checkbox name="cball" id="cball" onclick="cbtran($(this).attr('checked'));">
<script>
function cbtran(flag){ldelim}
	if (flag){ldelim}
		$("input[@name='cbdeli[]']").attr("checked",true);
	{rdelim}else{ldelim}
		$("input[@name='cbdeli[]']").attr("checked",false);
	{rdelim}
{rdelim}
</script>
	
	{foreach from=$ARPOST item=elpost key=idpost}
				<tr>
<td> {$elpost.serial}/{$elpost.year}
		{if empty($elpost.docunotes)}
		{else}
<img src="images/view.png" title='{$elpost.docunotes}'>
		{/if}
<td> {$elpost.created|date_format:"%d.%m.%Y"}
<td> {$elpost.sourname}
{*
<td> {$elpost.notes}
*}

{include file="deli2.tpl"}

	{/foreach}

{include file="_tab2pagi.tpl"}
				<tr>
<td colspan=20>
	<div style="float:right">
	само в маркираните документи
<br>
<div class="link butt" onclick="fubegi('{$LINKEDIT}');"> корегирай полета </div>
<div class="link butt" onclick="fubegi('{$LINKCLEAR}');"> изчисти полета </div>
	</div>

				</table>
{include file="deli.inc.tpl"}

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
{*
function delelist(link){ldelim}
	var resu= confirm('ВНИМАНИЕ\\nПотвърди изтриването на целия списък');
	if (resu){ldelim}
		document.location.href= link;
	{rdelim}else{ldelim}
	{rdelim}
{rdelim}
function autosubm8(event,form){ldelim}
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){ldelim}
form.submit();
	{rdelim}else if(code==17 || code==74){ldelim}
		event.preventDefault();
	{rdelim}else{ldelim}
	{rdelim}
{rdelim}
*}
$(document).ready(function() {ldelim}
	$("#idsour").val("{$IDSOUR}");
	$('.ctip').cluetip({ldelim} width: 300, local:true, cursor:'pointer' {rdelim});
{rdelim});
</script>

