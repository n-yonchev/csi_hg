{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="параметри на изх.документ"}
{include file="_erform.tpl"}

за документ {if empty($DOCUSERI)}{else}с изх.номер {$DOCUSERI}/{$DOCUYEAR}{/if}
<br>
<nobr>
<b>{$DOCUTYPE}</b>
</nobr>
<br>
<br>
				<fieldset class="filtgr" style="padding:10px;">
{*
	<nobr>
въведи новата дата
<input type="text" name="date" id="date" size=12 {include file="_erelem.tpl" ID="date" C1="input" C2="inputer"} 
autocomplete=off> 
{include file='_but2.tpl' TYPE='submit' TITLE='корегирай датата' NAME='subm2' ID='subm2'}
	</nobr>
*}
дата
<input type="text" name="date" id="date" size=12 {include file="_erelem.tpl" ID="date" C1="input" C2="inputer"} autocomplete=off> 
<br>
адресат
<input type="text" name="adresat" id="adresat" size=50 {include file="_erelem.tpl" ID="adresat" C1="input" C2="inputer"} autocomplete=off> 
<br>
<style>
option {ldelim}font: bold 8pt verdana{rdelim}
</style>
тип
<select name="iddocutype" id="iddocutype">
{foreach from=$ARDOCUTYPE item=elem key=ekey}
			{if $ARDOWORD[$ekey]}
	<option value="{$ekey}" style="color:blue">{$elem}</option>
			{else}
	<option value="{$ekey}">{$elem}</option>
			{/if}
{/foreach}
</select>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='корегирай' NAME='subm2' ID='subm2'}
				</fieldset>
<br>
<br> или
				<fieldset class="filtgr" style="padding:10px;">
	<nobr>
въведи новото дело/година
<input type="text" name="idcase" id="idcase" size=12 {include file="_erelem.tpl" ID="idcase" C1="input" C2="inputer"}
autocomplete=off> 
{include file='_but2.tpl' TYPE='submit' TITLE='смени делото' NAME='submit' ID='submit'}
	</nobr>
				</fieldset>
<br>
<br> или
				<fieldset class="filtgr" style="padding:10px;">
{include file='_but2.tpl' TYPE='submit' TITLE='изтрий документа' NAME='delete' ID='delete'}
		{if empty($DOCUSERI)}
		{else}
<br>
ВНИМАНИЕ.
<br>
След евентуално изтриване изх.номер {$DOCUSERI}/{$DOCUYEAR} ще остане НЕЗАЕТ.
		{/if}
				</fieldset>
<br> &nbsp;

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
