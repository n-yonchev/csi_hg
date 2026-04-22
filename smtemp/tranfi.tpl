{include file="_tab2.tpl"}
<style>
{*
.over {ldelim}cursor:pointer;background-color:aqua;{rdelim}
.curr {ldelim}cursor:pointer;background-color:wheat;padding:4px;border: 1px solid silver;{rdelim}
.vari {ldelim}cursor:pointer;padding:4px;border: 1px solid silver;{rdelim}
.coun {ldelim}font:normal 16pt verdana;padding-right:8px;{rdelim}
.dire {ldelim}cursor:pointer;background-color:wheat;{rdelim}
*}
.over {ldelim}cursor:pointer;background-color:aqua;{rdelim}
.dire {ldelim}cursor:pointer;background-color:wheat;{rdelim}
.seye {ldelim}font:normal 7pt verdana;border:0px solid black; color:black;{rdelim}
</style>
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />

				<form name="formseye" method=post 
				style="margin:0px 0px 0px 6px;padding:0px;width:auto;font: normal 8pt verdana;white-space:nowrap;">
		<table class="tab2" cellspacing='0' cellpadding='2' align=center>
		<tr class='head1'>
<td colspan='200'>
<div style="float:left">списък на постъпленията готови за превод {$HEADTX}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
<div style="float:right" class="seye">
по дело/год &nbsp;
<input type="text" name="seyefina" id="seyefina" size=12 autocomplete=off
style="font:bold 7pt verdana; border: 0px solid green;" onkeyup="autosubm4(event,this.form);">
+enter
</div>
				{if isset($ERCASE)}
<br> 
<font color=red>{$ERCASE}</font>
				{else}
				{/if}

		<tr class='head2'>
<td align=right> сума
<td> от къде
<td> кога
<td> дело
<td> деловодител

{foreach from=$LIST item=elem key=ekey}
						{assign var="myid" value=$elem.id}
						{assign var="idtype" value=$elem.idtype}
		{include file="_tab2tr.tpl"}
<td align=right 
			{if empty($elem.lockname)}
			{else}
bgcolor=salmon style="cursor:pointer;" title="заключена от {$elem.lockname}, кликни"
onclick="$.nyroModalManual({ldelim}forceType:'iframe', url:'{$elem.unlock}'{rdelim});"
			{/if}
>{$elem.inco|tomoney2}
				{assign var=bankname value=$ARBANK[$elem.codebank]}
				{if $idtype==1}
					{assign var="finaba" value="/"|cat:$elem.idfinabank|cat:"-"|cat:$bankname}
				{else}
					{assign var="finaba" value=""}
				{/if}
<td> <nobr>{$ARTYPE.$idtype|cat:$finaba}</nobr>
<td>
						{if $idtype==1}
<nobr>{$elem.finadate} {$elem.finahour}</nobr>
						{elseif $idtype==2}
<nobr>{$elem.cashdate}</nobr>
						{else}
&nbsp;
						{/if}
<td bgcolor=wheat {include file="_href.tpl" LINK=$elem.linkcase} onmouseover="$(this).addClass('over');" onmouseout="$(this).removeClass('over');">
{$elem.caseseri}/{$elem.caseyear}
<td> {$elem.username}
{/foreach}

{include file="_tab2pagi.tpl"}
		</table>
				</form>

<script>
function autosubm4(event,form){ldelim}
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
//alert("code="+code);
	if (code==13){ldelim}
//document.forms['formcaye'].submit();
form.submit();
	{rdelim}
{rdelim}
</script>
