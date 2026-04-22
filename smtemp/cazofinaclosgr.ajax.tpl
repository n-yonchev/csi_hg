{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="групово приключване на постъпления"}
{include file="_erform.tpl"}

												{if $NOEF}
<font color=red>
<br>
ВНИМАНИЕ.
<br>
В момента делото е отворено от {$LOCKNAME}, поради което постъпленията не може да бъдат приключени.
</font>
<br>
<br>
{include file='_button.tpl' ONCLICK="document.location.reload();" TITLE='опитай отново' NAME='again' ID='again'}
												{else}
<br>
сума <font size=+1><b>{$SUMA|tomo3}</b></font> от {$COUN} постъпления
<br>
<br>
ВНИМАНИЕ.
<br>
<nobr>
Приключването означава, че разпределените суми са преведени на взискателите.
</nobr>
<br>
След приключването няма да може да променяте данните за тези постъпления.
<br>
<br>
							{if empty($LOCKNAME)}
дата за погасяване за всичките {$COUN} постъпления
<br>
<input type="text" name="datebala" id="datebala" size=20 {include file="_erelem.tpl" ID="datebala" C1="input" C2="inputer"}> 
{*----
								{if $FLAGOLD}
<br>
дата на приключване - задължителна за старо постъпление
<br>
<input type="text" name="dateclos" id="dateclos" size=20 {include file="_erelem.tpl" ID="dateclos" C1="input" C2="inputer"}> 
								{else}
								{/if}
----*}
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='приключи' NAME='submyes' ID='submyes'}
&nbsp;&nbsp;
							{else}
<font color=red>
Може да приключите тези постъпления само след като {$LOCKNAME} затвори дело {$LOCKCASE}
</font>
<br>
<br>
{include file='_button.tpl' ONCLICK="document.location.reload();" TITLE='опитай отново' NAME='again' ID='again'}
							{/if}
												{/if}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
