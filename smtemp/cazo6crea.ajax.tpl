{*
	ВНИМАНИЕ. 
	Бутоните за събмит са с имена "subm" и "subm2"
	За да не съвпадат с името на функцията submit(), която се използва за автоматичен събмит.
*}
{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="нов изходящ документ"}
{include file="_erform.tpl"}

			{if isset($ONLYGET)}
<input type="checkbox" name="onlyserial">
само вземи изходящ номер
<br>
			{else}
			{/if}
тип
<br>
{*
{include file="_select.tpl" FROM=$ARDOCUTYPENAME ID="iddocutype" C1="input" C2="inputer" ONCH="document.forms[0].submit();"}
*}
<style>
option {ldelim}font: bold 8pt verdana{rdelim}
.opt2 {ldelim}color:blue;{rdelim}
</style>
<select name="iddocutype" id="iddocutype" onchange="document.forms[0].submit();">
{foreach from=$ARDOCUTYPE item=elem key=ekey}
			{if isset($ARDOWORD[$ekey])}
{*
	<option value="{$ekey}" style="color:blue">{$elem}</option>
*}
	<option value="{$ekey}" class="opt2">{$elem}</option>
			{else}
	<option value="{$ekey}">{$elem}</option>
			{/if}
{/foreach}
</select>

			{if isset($CLAINAME)}
<br>
избери взискател
<br>
{include file="_select.tpl" FROM=$CLAINAME ID="idclaimer" C1="input" C2="inputer" ONCH="document.forms[0].submit();"}
			{else}
			{/if}

			{if isset($DEBTNAME)}
<br>
избери длъжник
<br>
{include file="_select.tpl" FROM=$DEBTNAME ID="iddebtor" C1="input" C2="inputer" ONCH="document.forms[0].submit();"}
			{else}
			{/if}

			{if isset($OLIHNAME)}
<br>
избери предмет за олихв.сума
<br>
{include file="_select.tpl" FROM=$OLIHNAME ID="idpredolih" C1="input" C2="inputer"}
			{else}
			{/if}

			{if isset($NEOLIHNAME)}
<br>
избери предмет за неолихв.сума
<br>
{include file="_select.tpl" FROM=$NEOLIHNAME ID="idpredneolih" C1="input" C2="inputer"}
			{else}
			{/if}

			{if isset($SMETKANAME)}
<br>
избери банкова сметка за дълг
<br>
{include file="_select.tpl" FROM=$SMETKANAME ID="idsmetka" C1="input" C2="inputer" ONCH="document.forms[0].submit();"}
			{else}
			{/if}

			{if isset($SMETKA2NAME)}
<br>
избери банкова сметка за такси
<br>
{include file="_select.tpl" FROM=$SMETKANAME ID="idsmetka2" C1="input" C2="inputer" ONCH="document.forms[0].submit();"}
			{else}
			{/if}

			{if isset($ADVRNAME)}
<br>
избери клон на АДВ
<br>
{include file="_select.tpl" FROM=$ADVRNAME ID="idregionadv" C1="input" C2="inputer" ONCH="document.forms[0].submit();"}
			{else}
			{/if}

			{if isset($NAPRNAME)}
<br>
избери клон на НАП
<br>
{include file="_select.tpl" FROM=$NAPRNAME ID="idregionnap" C1="input" C2="inputer" ONCH="document.forms[0].submit();"}
			{else}
			{/if}

{*---- таблицата за заместване ------------------------*}
<br>
<br>
			<table class="base" align=center width=100%>
		{foreach from=$DATA item=elem key=ekey}
			<tr>
<td class="t8bord" valign=top> 
			{if $elem.SPECFLAG==1}
	<font color="red">{$elem.text}</font>
			{elseif $elem.SPECFLAG==2}
	<font color="blue">{$elem.text}</font>
			{else}
				{if $elem.fieltype=="cbox"}
	избери да/не
				{else}
	{$elem.text}
				{/if}
			{/if}
<td class="t8bord" valign=top>
							{*---- за полетата с ajax ----*}
							{if empty($elem.ajax)}
							{else}
{*----
								{assign var=smarname value="SMAR"|cat:$elem.fielname}
<div id="ajaxcb" class="inp7bold"> {$smarname}
----*}
								{assign var=smarname value=$elem.fielname}
								{assign var=ajaxname value="ajax"|cat:$elem.fielname}
<div id="{$ajaxname}" class="inp7bold"> {$smarty.session.$smarname.code}
</div>
							{/if}
				{if $elem.fieltype=="tear"}
<textarea name="{$elem.fielname}" id="{$elem.fielname}" class="input" rows=5 cols=50></textarea>
				{elseif $elem.fieltype=="text"}
{*----
<input type="text" name="{$elem.fielname}" id="{$elem.fielname}" class="input" size=20 {include file="_erelem.tpl" ID="{$elem.fielname}" C1="input" C2="inputer"}> 
----*}
<input name="{$elem.fielname}" id="{$elem.fielname}" class="input" size=40>
				{elseif $elem.fieltype=="select"}
{include file="_select.tpl" FROM=$elem.arname ID=$elem.fielname}
{*---- 12.12.2013 - чекбоксове за искане до НАП ----*}
				{elseif $elem.fieltype=="cbox"}
<input type="checkbox" name="{$elem.fielname}" id="{$elem.fielname}"checked> <label for="{$elem.fielname}">{$elem.text}</label>
				{elseif $elem.cont==""}
&nbsp;
				{else}
{$elem.cont}
				{/if}
		{/foreach}
			</table>

			{if isset($ONLYGET)}
			{else}
<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='запиши' NAME='subm' ID='subm'}
&nbsp;
{include file='_but2.tpl' TYPE='submit' TITLE='създай документа' NAME='subm2' ID='subm2'}
					{if $WORDFLAG}
<div style="float:right;">
{include file='_but2.tpl' TYPE='submit' TITLE='Word' NAME='subm3' ID='subm3'}
<div>
					{else}
					{/if}

			{/if}

			{if $DOCUTYPE==0}
<script>
//parent.$.nyroModalSettings({ldelim}width:180, height:140{rdelim});
</script>
			{else}
<script>
parent.$.nyroModalSettings({ldelim}width:740, height:580{rdelim});
{*----
function listchan(p1){ldelim}
//alert(p1.checked+'/'+p1.value);
	jQuery.ajax({ldelim}
		url: "{$AJAXNAME}?mychan="+p1.value,
		success: function(data){ldelim}
			$('#'+'{$DEBTFIEL}').text(data);
		{rdelim}
	{rdelim});
{rdelim}
{$LISTCHAN}
----*}
{*----
function listchan(p1,p2){ldelim}
//alert(p1.checked+'/'+p1.value);
	jQuery.ajax({ldelim}
		url: "{$AJAXNAME}?mychan="+p1.value+"&mypref="+p2,
		success: function(data){ldelim}
			$('#'+p2).text(data);
		{rdelim}
	{rdelim});
{rdelim}
----*}
var flag3= false;
function listchan(p1,p2,p3){ldelim}
				if (p3){ldelim}
flag3= true;
				{rdelim}
	jQuery.ajax({ldelim}
		url: "{$AJAXNAME}?mychan="+p1.value+"&mypref="+p2+"&mypref2="+p3,
		success: function(data){ldelim}
				if (flag3){ldelim}
			var myar= data.split("^");
			$('#'+p2).text(myar[0]);
			$('#'+p3).attr("value",myar[1]);
	sync();
				{rdelim}else{ldelim}
			$('#'+p2).text(data);
				{rdelim}
		{rdelim}
	{rdelim});
{rdelim}
$(document).ready(function(){ldelim}
	{if isset($smarty.post.delo_acdebt)}
	{else}
		var v1= parent.getacdebt();
		$("#delo_acdebt").val(v1);
	{/if}
	{if isset($smarty.post.delo_acdebt_list)}
	{else}
		var v2= parent.getacdebt_list();
		$("#delo_acdebt_list").val(v2);
	{/if}
			sync();
{rdelim});
function sync(){ldelim}
{$SUMATOTA}
{rdelim}
</script>
			{/if}

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
