		{if count($DATA)==0}
няма юридически лица с "{$CODECONT}" в булстат
		{else}
	<table class="caseview" align=center>
	<tr>
	<td colspan=10>
намерени юридически лица с "{$CODECONT}" в булстат
	<tr>
	<th class="cont"> код
	<th class="cont"> име
	<th class="cont"> представител
	<th class="cont"> роля
{*----
	<th class="cont"> изп.дело
----*}

			{foreach from=$DATA item=elem}
				{assign var="myid" value=$elem.role|cat:$elem.id}
	<tr class="ttip" rel="#cont{$myid}" title="допълнителна информация" 
	onmouseover="this.style.color='red';this.style.cursor='pointer';" onmouseout="this.style.color='black';"
	onclick="copycont('{$myid}');">
	<td class="contleft"> {$elem.bulstat}
	<td class="contleft"> {$elem.name}
	<td class="contleft"> {$elem.agent}
	<td class="contleft"> {if $elem.role=="c"}взиск{else}длъж{/if}
{*----
	<td class="contleft"> {$elem.caseseri}/{$elem.caseyear}
----*}

{*---- съдържание на доп.информация ----*}
<span id="cont{$myid}" style="display: none">
докум : <b>{$elem.regidocu}/{$elem.regidate}</b>
<br>
изд.от : <b>{$elem.regicase}</b>
<br>
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
//	$('tr.ttip').cluetip({ldelim}splitTitle:'|', cursor:'pointer', local:true{rdelim});
	$('tr.ttip').cluetip({ldelim} width: 330, local:true, cursor:'pointer' {rdelim});
</script>

{*---- скрипт за копиране ----*}
<script type="text/javascript">
function copycont(paid){ldelim}
//	var fili= new Array("bulstat","name","address","agent","regidocu","regidate","regicase");
//alert(document.getElementById(paid+"_name").innerHTML+'/'+document.getElementById(paid+"_address").innerHTML);
//	var indx,fina;
//	for (indx=0; indx<fili.length; indx++){ldelim}
//		fina= fili[indx];
//		document.forms[0].elements[fina].value= document.getElementById(paid+fina).innerHTML;
//	{rdelim}
	{foreach from=$FILIST item=fielem}
//alert('{$fielem}');
		document.forms[0].elements['{$fielem}'].value= document.getElementById(paid+'_'+'{$fielem}').innerHTML;
	{/foreach}
{rdelim}
</script>