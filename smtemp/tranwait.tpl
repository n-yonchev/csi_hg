{*
			{foreach from=$ARV2 item=elem key=ekey}
<span class="{if $ekey==$V2}curr2{else}vari2{/if}" {include file="_href.tpl" LINK=$ARV2LINK[$ekey]}> 
{$elem}</span>
			{/foreach}
*}
{$C2VARI}
