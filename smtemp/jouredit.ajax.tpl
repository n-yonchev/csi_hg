{include file="_ajax.header.tpl"}
{if $EDIT==0}
	{assign var='_title' value='въведи нов запис'}
{else}
	{assign var='_title' value='корегирай записа'}
{/if}
{include file="_window.header.tpl" TITLE=$_title}
{include file="_erform.tpl"}

{*
изп.дело
<br>
<input type="text" name="casenumb" id="casenumb" size=20 {include file="_erelem.tpl" ID="casenumb" C1="input" C2="inputer"}> 
<br>
*}
дата на действието
<br>
<input type="text" name="created" id="created" size=16 {include file="_erelem.tpl" ID="created" C1="input" C2="inputer"}> 
<br>
описание
<br>
<input type="text" name="descrip" id="descrip" size=100 {include file="_erelem.tpl" ID="descrip" C1="input" C2="inputer"}> 
<br>
задължено лице
<br>
<input type="text" name="person" id="person" size=60 {include file="_erelem.tpl" ID="person" C1="input" C2="inputer"}> 
<br>
характер на изпълнението за отчета раздел 1 
<br>
{include file="_select.tpl" FROM=$ARCHARTYPENAME ID="idchar" C1="input" C2="inputer"}
			{if isset($EDITCASECODE)}
<input type="hidden" name="tacaselist" id="tacaselist" {include file="_erelem.tpl" ID="tacaselist" C1="input" C2="inputer"}> 
{*
<input type="hidden" name="isdiff" id="isdiff" {include file="_erelem.tpl" ID="isdiff" C1="input" C2="inputer"}> 
*}
			{else}
<br>
дело, по което се извършва действието
<br>
или списък дела, разделени с интервал
<br>
<textarea rows=4 cols=70 name="tacaselist" id="tacaselist" {include file="_erelem.tpl" ID="tacaselist" C1="input" C2="inputer"}></textarea>
{*
<br>
<input type="checkbox" name="isdiff" id="isdiff" {include file="_erelem.tpl" ID="isdiff" C1="input" C2="inputer"}> 
всяко дело от списъка да формира отделна позиция в дневника на изв.действия
*}
				{if isset($CASEER)}
<br>
<font color=red>липсващи дела</font>
<br>
{foreach from=$CASEER item=cael}
<span class="red7bg">{$cael}</span>&nbsp;
{/foreach}
				{else}
				{/if}
			{/if}
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
