{*
		$FLDIRE 
		$VARI =head =cont 
*}
				{if $FLDIRE==0}
				{elseif $FLDIRE==1 or $FLDIRE==5}
					{if $VARI=="head"}
<td>ръ<br>чен
					{elseif $VARI=="cont"}
{*------------------------------------------------------------*}
						{if $elem.idstat==9}
							{assign var=mytext value="П"}
							{assign var=mytit1 value="ръчно преведен"}
							{assign var=mytit2 value=", клик за отложен"}
						{elseif $elem.idstat==6}
							{assign var=mytext value="отложен"}
							{assign var=mytit1 value="отложен"}
							{assign var=mytit2 value=", клик за ръчно преведен"}
						{else}
							{assign var=mytext value="ГРЕШКА"}
							{assign var=mytit1 value=""}
							{assign var=mytit2 value=""}
						{/if}
{***
						{if $FLIBAN==1}
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
onclick="$.nyroModalManual({ldelim}forceType:'iframe', url:'{$elem.editiban}'{rdelim});"
>{$elem.iban}
						{else}
>{$elem.iban}
						{/if}
***}
						{if $FLDIRE==1}
<td align=center title="{$mytit1}{$mytit2}"
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
{include file="_href.tpl" LINK=$elem.dire}
> {$mytext}
						{else}
<td align=center title="{$mytit1}"> {$mytext}
						{/if}
{*------------------------------------------------------------*}
					{else}
					{/if}
				{else}
				{/if}
