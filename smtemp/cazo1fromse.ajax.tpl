<style>
.ropers {ldelim}border-bottom: 1px solid silver;{rdelim}
</style>
			{if isset($MESS)}
<h3>{$MESS}</h3>
			{else}
			{/if}
			{if isset($ARRESU)}
{*
{$ARRESU}
*}
						<table>
						<tr>
<td align=center colspan=2 bgcolor="silver"> дело
	{foreach from=$ARTXCASE item=text key=codefiel}
					{assign var=cont value=$ARRESU.case.$codefiel}
					{if empty($cont)}
					{else}
						<tr>
<td> {$text}
<td> <b>{$cont}</b>
					{/if}
	{/foreach}
						</table>
						<table>
						<tr>
<td align=center colspan=10 bgcolor="silver"> участници
						<tr>
	{foreach from=$ARTXPERS item=text}
<td bgcolor="silver"> {$text}
	{/foreach}
	{foreach from=$ARRESU.persons item=arpers}
						<tr>
		{foreach from=$ARTXPERS item=text key=codefiel}
					{assign var=cont value=$arpers.$codefiel}
					{if $codefiel=="foreigner"}
						{if $cont==0}
							{assign var=cont value="не"}
						{else}
							{assign var=cont value="да"}
						{/if}
					{elseif $codefiel=="name"}
						{if empty($cont)}
							{assign var=cont value=$arpers.company_name}
						{else}
						{/if}
					{else}
					{/if}
<td class="ropers"> <b>{$cont}</b>
		{/foreach}
	{/foreach}
						</table>
			{else}
			{/if}
