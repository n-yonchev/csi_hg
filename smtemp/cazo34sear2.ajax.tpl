		{if count($DATA)==0}
няма физически лица с "{$CODECONT}" в ЕГН
		{else}
	<table class="caseview" align=center>
	<tr>
	<td colspan=10>
намерени физически лица с "{$CODECONT}" в ЕГН (или на съпруга)
	<tr>
	<th class="cont"> егн
	<th class="cont"> име
	<th class="cont"> представител
	<th class="cont"> роля
	<th class="cont"> съпруг
	<th class="cont"> егн
{*----
	<th class="cont"> изп.дело
----*}
			
			{foreach from=$DATA item=elem}
				{assign var="myid" value=$elem.role|cat:$elem.id}
	<tr class="ttip" rel="#cont{$myid}" title="допълнителна информация" 
	onmouseover="this.style.color='red';this.style.cursor='pointer';" onmouseout="this.style.color='black';"
	onclick="copycont('{$myid}');">
	<td class="contleft"> {$elem.egn}
	<td class="contleft"> {$elem.name}
	<td class="contleft"> {$elem.agent}
	<td class="contleft"> {if $elem.role=="c"}взиск{else}длъж{/if}
	<td class="contleft"> {$elem.name2}
	<td class="contleft"> {$elem.egn2}
{*----
	<td class="contleft"> {$elem.caseseri}/{$elem.caseyear}
----*}

{*---- съдържание на доп.информация ----*}
<span id="cont{$myid}" style="display: none">
адреси : <br>
<b>{$elem.address|nl2br}</b>
</span>
{*---- съдържание на полетата за копиране ----*}
<span style="display: none">
	{foreach from=$FILIST item=fielem}
<span id="{$myid}_{$fielem}">{$elem.$fielem}</span>
	{/foreach}
</span>
			{/foreach}
	</table>
		{/if}

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
	$('tr.ttip').cluetip({ldelim} width: 330, local:true, cursor:'pointer' {rdelim});
</script>

{*---- скрипт за копиране ----*}
<script type="text/javascript">
function copycont(paid){ldelim}
	var indx,fina;
	{foreach from=$FILIST item=fielem}
		document.forms[0].elements['{$fielem}'].value= document.getElementById(paid+'_'+'{$fielem}').innerHTML;
//alert("copy={$fielem}");
	{/foreach}
{rdelim}
</script>