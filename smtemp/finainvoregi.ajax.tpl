{include file="_ajax.header.tpl"}
				{if isset($SERIINVODIFF) or  isset($SERIDIFF)}
					{assign var=mywidth value=400}
				{else}
					{assign var=mywidth value=240}
				{/if}
{include file="_window.header.tpl" TITLE="корекция на номерата" WIDTH=$mywidth}
{include file="_erform.tpl"}
{*
							{if $COUN==0 and $ROINVO.serial==0}
<br>
фактурата няма редове 
<br>
и не може да бъде изходена
<br>
<br>
							{else}
*}		
<br>
		<table>
		<tr>
<td> номер фактура
<td> 
<input type="text" name="seriinvo" id="seriinvo" size=14 {include file="_erelem.tpl" ID="seriinvo" C1="input" C2="inputer"}>
									{if isset($SERIINVODIFF)}
		<tr>
<td colspan=4> 
<font color=red>
при този номер на фактурата ще останат {$SERIINVODIFF} незаети номера <br>след максималния в момента номер {$INVOMAXSER}
<br>потвърди желания номер на фактурата {$smarty.post.seriinvo}
<input type="checkbox" name="seriinvoconf">
</font>
									{else}
									{/if}
		<tr>
<td> номер сметка
<td> 
<input type="text" name="serial" id="serial" size=14 {include file="_erelem.tpl" ID="serial" C1="input" C2="inputer"}>
						{if isset($SERIDIFF)}
			<tr>
<td colspan=4> 
<font color=red>
при този номер на сметката ще останат {$SERIDIFF} незаети номера <br>след максималния в момента номер {$MAXSER}
<br>потвърди желания номер на сметката {$smarty.post.serial}
<input type="checkbox" name="sericonf">
</font>
						{else}
						{/if}
		</table>

<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
{*
							{/if}
*}
{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
