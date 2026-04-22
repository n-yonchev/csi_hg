{* отгоре : 
	$DATALIST - масива с данните за взсикатели или длъжници за текущото дело 
*}
{foreach from=$DATALIST item=datael}
				{assign var="txtype" value=""}
				{assign var="txcode" value=""}
			{if $datael.idtype==1}
				{assign var="txtype" value="юл"}
				{assign var="txcode" value="булстат "|cat:$datael.bulstat}
			{elseif $datael.idtype==2}
				{assign var="txtype" value="фл"}
				{assign var="txcode" value="ЕГН "|cat:$datael.egn}
			{else}
			{/if}
{$txtype} {$datael.name} {$txcode}
<br>
{$datael.address}
<br>
{/foreach}
