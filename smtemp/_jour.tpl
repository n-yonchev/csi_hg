{*----
	PRIN = true/false
----*}
						{assign var=mycrea value=""}
		{foreach from=$LIST item=elem key=ekey}
			<tr onmouseover='this.className="trdocu";' onmouseout='this.className="";'>
						{assign var=focrea value=$elem.created|date_format:"%d.%m.%Y"}
						{if $mycrea==$focrea}
			<td valign=top> &nbsp;
						{else}
			<td valign=top> {$focrea}
							{assign var=mycrea value=$focrea}
						{/if}
	{include file="_sepaprin.tpl"}
			<td valign=top align=center> {$elem.seno} &nbsp;
	{include file="_sepaprin.tpl"}
				{if isset($elem.caselist)}
<td valign=top align=left> 
{*----
	{foreach from=$elem.caselist item=cael}
{$cael}&nbsp;
	{/foreach}
----*}
{if $PRIN}
{$elem.caselist[0]}&nbsp;
	{if count($elem.caselist)>1}
...
	{else}
	{/if}
{else}
	{if count($elem.caselist)>1}
<img src="images/view.png" title='{foreach from=$elem.caselist item=cuca}{$cuca}&nbsp;{/foreach}'>
	{else}
{$elem.caselist[0]}
	{/if}
{/if}
				{elseif empty($elem.caseseri) and empty($elem.caseyear)}
			<td valign=top align=left> &nbsp;
				{else}
			<td valign=top align=left> {$elem.caseseri}/{$elem.caseyear} &nbsp;
				{/if}
	{include file="_sepaprin.tpl"}
			<td valign=top> {$elem.descrip}
	{include file="_sepaprin.tpl"}
			<td valign=top> {$elem.person}
	{include file="_sepaprin.tpl"}
							{if $elem.type==0}
								{assign var="tdtext" value="ръчно въведен"}
							{elseif $elem.type==1}
								{assign var="tdtext" value="входящ"}
							{elseif  $elem.type==2}
								{assign var="tdtext" value="изх."}
							{elseif  $elem.type==3}
								{assign var="tdtext" value="постъпление"}
							{elseif  $elem.type==4}
								{assign var="tdtext" value="ПДИ"}
							{elseif  $elem.type==5}
								{assign var="tdtext" value="плащане"}
							{elseif  $elem.type==6}
								{assign var="tdtext" value="връчване"}
{*----
								{assign var="tdtext" value="постъп.плащане брой"}
							{elseif  $elem.type==4}
								{assign var="tdtext" value="постъп.плащане банка"}
----*}
							{else}
								{assign var="tdtext" value="?"}
							{/if}
			<td valign=top> {$tdtext}
	{include file="_sepaprin.tpl"}
			<td valign=top align=right> 
				{if empty($elem.serial) and empty($elem.year)}
			&nbsp;
				{else}
			{$elem.serial}/{$elem.year} &nbsp;
				{/if}
	{include file="_sepaprin.tpl"}
						{if $PRIN}
						{else}
							{if $elem.type==0}
<td align=center>
<nobr>
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
<a href="{$elem.dele}" class="nyroModal" target="_blank">
<img src="images/free.gif" title="изтрий">
</a>
</nobr>
</td>
							{else}
<td> &nbsp;
							{/if}
						{/if}
		{/foreach}
