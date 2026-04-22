{include file="_ajax.header.tpl"}

{assign var='tmp' value=$HEADDATA.AMOUNT_C}

{include file="_window.header.tpl" TITLE="насочване на постъпила сума <b>$tmp</b> към взискател по дело"}
{include file="_erform.tpl"}







{*---- заглавна част ----------------------*}

<table class="d_table" align=left cellpadding=0 cellspacing=0 >
	<tbody>
	<tr>
<td class="contleft"> време
<td class="cont"> <b>{$HEADDATA.POST_DATE} {$HEADDATA.TIME}</b>
<td class="contleft"> забележка
	<tr>
<td class="contleft"> описание
<td class="cont"> <b>{$HEADDATA.TR_NAME}</b>
<td class="cont" rowspan=2> <b>{$HEADDATA.REM_I}<br>{$HEADDATA.REM_II}</b>
	<tr>
<td class="contleft"> име
<td class="cont"> <b>{$HEADDATA.NAME_R}</b>
</tbody>
	</table>

{*---- форма за филтъра ----------------------*}
<fieldset class="filtgr" style="clear:left;margin-top:10px">
<legend> търсене на дела </legend>
		<table class="base">
		<tr>
<td class="t8"> номер
<td class="t8"> година
<td class="t8"> егн/булстат
<td class="t8"> име
<td class="t8" rowspan=2 valign=bottom> 

{include file='_button.tpl' TYPE='submit' TITLE='търси' NAME='submit' ID='submit'}

{* <input type="submit" class="submit" name="submit" id="submit" value="търси"> *}
		<tr>
<td class="none">
<input type="text" name="cano" id="cano" size=6 class="input"> 
<td class="none">
{include file="_select.tpl" FROM=$ARYEARNAME ID="caye" C1="input" C2="inputer"}
<td class="none">
<input type="text" name="buls" id="buls" size=20 class="input"> 
<td class="none">
<input type="text" name="name" id="name" size=20 class="input"> 
		</table>
</fieldset>

{*---- списък с намерените дела ----------------------*}
<br>
						{if empty($CASEDATA)}
<center class="n8">
<font color="red">
няма намерени дела
</font>
</center>
						{else}
<table class="d_table" width='' cellspacing='0' cellpadding='0' align=center>
	<thead>
		<tr>
			<td class='d_table_title' colspan='200'>банкови извлечения</td>
		</tr>
		
	</thead>
		<tr class='header'>
			<td > номер </td>





			<td class='sep'>&nbsp;</td>
			<td > описание </td>
			<td class='sep'>&nbsp;</td>
			<td > взискатели </td>
			<td class='sep'>&nbsp;</td>
			<td > длъжници </td>
		
		</tr>
		{foreach from=$CASEDATA item=elem key=ekey}
				{assign var="idcase" value=$elem.id}
			<tr>
				<td class="t8bord" valign=top> {$elem.serial}/{$elem.year}</td>
				<td class='sep'>&nbsp;</td>
				<td class="t8bord" valign=top> {$elem.text}</td>





				<td class='sep'>&nbsp;</td>

			{*---- списък взискатели -----------------------------*}
				<td class="t8bord" valign=top>
					<table>
					{foreach from=$ARCLAI[$idcase] item=memb}
									{assign var="txtype" value=""}
									{assign var="txcode" value=""}
								{if $memb.idtype==1}
									{assign var="txtype" value="ю"}
									{assign var="txcode" value=$memb.bulstat}
								{elseif $memb.idtype==2}
									{assign var="txtype" value="ф"}
									{assign var="txcode" value=$memb.egn}
								{else}
								{/if}
						<tr>
							<td class="t8" align=center> <img src="images/direclai.gif" title="избери този взискател" style="cursor:pointer" onclick="document.location.href='{$memb.direclai}';"> </td>


							<td class="t8"> {$txtype}</td>
							<td class="t8"> {$txcode}</td>
							<td class="t8"> {$memb.name}</td>
						</tr>
					{/foreach}
					</table>
				</td>
				<td class='sep'>&nbsp;</td>
			{*---- списък длъжници -----------------------------*}
				<td class="t8bord" valign=top>
					<table>
						{foreach from=$ARDEBT[$idcase] item=memb}
										{assign var="txtype" value=""}
										{assign var="txcode" value=""}
									{if $memb.idtype==1}
										{assign var="txtype" value="ю"}
										{assign var="txcode" value=$memb.bulstat}
									{elseif $memb.idtype==2}
										{assign var="txtype" value="ф"}
										{assign var="txcode" value=$memb.egn}
									{else}
									{/if}
							<tr>
								<td class="t8"> {$txtype}</td>
								<td class="t8"> {$txcode}</td>
								<td class="t8"> {$memb.name}</td>
							</tr>
						{/foreach}
					</table>

				</td>
		</tr>
		{/foreach}
		</form>
{include file="_pagina.tr.tpl"}
<form>
		</table>
<br>









						{/if}

<script>
	// parent.$.nyroModalSettings({ldelim}width:740, height:460{rdelim});
</script>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
