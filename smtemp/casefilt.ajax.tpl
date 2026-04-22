{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="корегирай филтъра"}
{include file="_erform.tpl"}
<style>
td {ldelim}font: normal 8pt verdana{rdelim}
input {ldelim}font: normal 8pt verdana{rdelim}
</style>

{*-------------------------- изпълнително дело ------------------------------*}
{*
<br>
*}
		<fieldset class="filtgr">
		<legend align=right> изпълнително дело </legend>
			<table>
			<tr>
<td> номер (от-до)
<td> година
<td> създадено след дата
<td> създадено преди дата
			<tr>
<td>
<input type="text" name="exseri" id="exseri" size=14 {include file="_erelem.tpl" ID="exseri" C1="input" C2="inputer"}> 
<td>
{include file="_select.tpl" FROM=$ARYEARNAME ID="exyear" C1="input" C2="inputer"}
<td>
<input type="text" name="exafte" id="exafte" size=24 {include file="_erelem.tpl" ID="exafte" C1="input" C2="inputer"}> 
<td>
<input type="text" name="exbefo" id="exbefo" size=24 {include file="_erelem.tpl" ID="exbefo" C1="input" C2="inputer"}> 
			</table>
			<table>
			<tr>
<td>
описание
<br>
<input type="text" name="extext" id="extext" size=40 {include file="_erelem.tpl" ID="extext" C1="input" C2="inputer"}> 
<td>
деловодител
<br>
{include file="_select.tpl" FROM=$ARUSERNAME ID="oruser" C1="input" C2="inputer"}
			</table>
			<table>
			<tr>
<td>
ред за отчета
<br>
{include file="_select.tpl" FROM=$ARREPONAME ID="orrepo" C1="input" C2="inputer"}
<td>
текущ статус
<br>
{include file="_select.tpl" FROM=$ARSTATNAME ID="orstat" C1="input" C2="inputer"}
<td>
характер на изпълнението
<br>
{include file="_select.tpl" FROM=$ARCHARNAME ID="orchar" C1="input" C2="inputer"}
			</table>
		</fieldset>

{*-------------------------- съдебно дело ------------------------------*}
{*
		<fieldset class="filtgr">
		<legend align=right> съдебно дело </legend>
			<table>
			<tr>
<td> идва от
<td> изпълнителен титул
			<tr>
<td>
{include file="_select.tpl" FROM=$ARFROMNAME ID="orfrom" C1="input" C2="inputer"}
<td>
{include file="_select.tpl" FROM=$ARTITUNAME ID="ortitu" C1="input" C2="inputer"}
			</table>

			<table>
			<tr>
<td> вид
<td> година
			<tr>
<td>
{include file="_select.tpl" FROM=$ARSORTNAME ID="orsort" C1="input" C2="inputer"}
<td>
<input type="text" name="oryear" id="oryear" size=10 {include file="_erelem.tpl" ID="oryear" C1="input" C2="inputer"}> 
			</table>
		</fieldset>
*}
		<fieldset class="filtgr">
		<legend align=right> съдебно дело </legend>
			<table>
			<tr>
<td> идва от
<br>
{include file="_select.tpl" FROM=$ARFROMNAME ID="orfrom" C1="input" C2="inputer"}
<td> изпълнителен титул
<br>
{include file="_select.tpl" FROM=$ARTITUNAME ID="ortitu" C1="input" C2="inputer"}
<td> вид
<br>
{include file="_select.tpl" FROM=$ARSORTNAME ID="orsort" C1="input" C2="inputer"}
			<tr>
<td> дело
<br>
<input type="text" name="ornome" id="ornome" size=10 {include file="_erelem.tpl" ID="ornome" C1="input" C2="inputer"}> 
<td> година
<br>
<input type="text" name="oryear" id="oryear" size=10 {include file="_erelem.tpl" ID="oryear" C1="input" C2="inputer"}> 
			</table>
		</fieldset>

		<fieldset class="filtgr">
		<legend align=right> постъпления </legend>
			<table>
			<tr>
<td> без постъпления след дата
<br>
<input type="text" name="last_finance" id="last_finance" size=30 {include file="_erelem.tpl" ID="last_finance" C1="input" C2="inputer"}> 
			</table>
		</fieldset>
{*---------------------------------------------------------------------*}

{*-------------------------- страни ------------------------------*}
{*
		<fieldset class="filtgr">
		<legend align=right> страни </legend>
			<table>
			<tr>
<td> обхват
<td> тип
<td> идентификация
<td> име
			<tr>
<td>
{include file="_select.tpl" FROM=$ARRANGNAME ID="merang" C1="input" C2="inputer"}
<td>
{include file="_select.tpl" FROM=$ARTYPENAME ID="metype" C1="input" C2="inputer"}
<td>
<input type="text" name="meiden" id="meiden" size=20 {include file="_erelem.tpl" ID="meiden" C1="input" C2="inputer"}> 
<td>
<input type="text" name="mename" id="mename" size=20 {include file="_erelem.tpl" ID="mename" C1="input" C2="inputer"}> 
			</table>
			<table>
			<tr>
<td> адрес
<br>
<input type="text" name="meaddr" id="meaddr" size=40 {include file="_erelem.tpl" ID="meaddr" C1="input" C2="inputer"}> 
<td> представител
<br>
<input type="text" name="meagen" id="meagen" size=30 {include file="_erelem.tpl" ID="meagen" C1="input" C2="inputer"}> 
			</table>
		</fieldset>
*}


{*-------------------------- взискател ------------------------------*}
{*----
		<fieldset class="filtgr">
		<legend align=right> взискател </legend>
			<table>
			<tr>
<td> тип
<td> идентификация
<td> име
			<tr>
<td>
{include file="_select.tpl" FROM=$ARTYPENAME ID="metypeclai" C1="input" C2="inputer"}
<td>
<input type="text" name="meidenclai" id="meidenclai" size=20 {include file="_erelem.tpl" ID="meidenclai" C1="input" C2="inputer"}> 
<td>
<input type="text" name="menameclai" id="menameclai" size=20 {include file="_erelem.tpl" ID="menameclai" C1="input" C2="inputer"}> 
			</table>
			<table>
			<tr>
<td> адрес
<br>
<input type="text" name="meaddrclai" id="meaddrclai" size=40 {include file="_erelem.tpl" ID="meaddrclai" C1="input" C2="inputer"}> 
<td> представител
<br>
<input type="text" name="meagenclai" id="meagenclai" size=30 {include file="_erelem.tpl" ID="meagenclai" C1="input" C2="inputer"}> 
			</table>
		</fieldset>
----*}
								<table>
								<tr>
								<td>
		<fieldset class="filtgr">
		<legend align=right> взискател </legend>
тип
<br>
{include file="_select.tpl" FROM=$ARTYPENAME ID="metypeclai" C1="input" C2="inputer"}
<br>
идентификация
<br>
<input type="text" name="meidenclai" id="meidenclai" size=20 {include file="_erelem.tpl" ID="meidenclai" C1="input" C2="inputer"}> 
<br>
име
<br>
<input type="text" name="menameclai" id="menameclai" size=20 {include file="_erelem.tpl" ID="menameclai" C1="input" C2="inputer"}> 
<br>
адрес
<br>
<input type="text" name="meaddrclai" id="meaddrclai" size=40 {include file="_erelem.tpl" ID="meaddrclai" C1="input" C2="inputer"}> 
<br>
представител
<br>
<input type="text" name="meagenclai" id="meagenclai" size=30 {include file="_erelem.tpl" ID="meagenclai" C1="input" C2="inputer"}> 
		</fieldset>
{*---------------------------------------------------*}

{*-------------------------- длъжник ------------------------------*}
{*----
		<fieldset class="filtgr">
		<legend align=right> длъжник </legend>
			<table>
			<tr>
<td> тип
<td> идентификация
<td> име
			<tr>
<td>
{include file="_select.tpl" FROM=$ARTYPENAME ID="metypedebt" C1="input" C2="inputer"}
<td>
<input type="text" name="meidendebt" id="meidendebt" size=20 {include file="_erelem.tpl" ID="meidendebt" C1="input" C2="inputer"}> 
<td>
<input type="text" name="menamedebt" id="menamedebt" size=20 {include file="_erelem.tpl" ID="menamedebt" C1="input" C2="inputer"}> 
			</table>
			<table>
			<tr>
<td> адрес
<br>
<input type="text" name="meaddrdebt" id="meaddrdebt" size=40 {include file="_erelem.tpl" ID="meaddrdebt" C1="input" C2="inputer"}> 
<td> представител
<br>
<input type="text" name="meagendebt" id="meagendebt" size=30 {include file="_erelem.tpl" ID="meagendebt" C1="input" C2="inputer"}> 
			</table>
		</fieldset>
----*}
								<td>
		<fieldset class="filtgr">
		<legend align=right> длъжник </legend>
тип
<br>
{include file="_select.tpl" FROM=$ARTYPENAME ID="metypedebt" C1="input" C2="inputer"}
<br>
идентификация
<br>
<input type="text" name="meidendebt" id="meidendebt" size=20 {include file="_erelem.tpl" ID="meidendebt" C1="input" C2="inputer"}> 
<br>
име
<br>
<input type="text" name="menamedebt" id="menamedebt" size=20 {include file="_erelem.tpl" ID="menamedebt" C1="input" C2="inputer"}> 
<br>
адрес
<br>
<input type="text" name="meaddrdebt" id="meaddrdebt" size=40 {include file="_erelem.tpl" ID="meaddrdebt" C1="input" C2="inputer"}> 
<br>
представител
<br>
<input type="text" name="meagendebt" id="meagendebt" size=30 {include file="_erelem.tpl" ID="meagendebt" C1="input" C2="inputer"}> 
		</fieldset>
								</table>
{*---------------------------------------------------*}

<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='приложи филтъра' NAME='submit' ID='submit'}
{* <input type="submit" class="submit" name="submit" id="submit" value="приложи филтъра">  *}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
{include file='_but2.tpl' TYPE='submit' TITLE='изчисти полетата' NAME='clear' ID='clear'}
{* <input type="submit" class="submit" name="clear" id="clear" value="изчисти полетата"> *}

<script type="text/javascript">
// parent.$.nyroModalSettings({ldelim}width:540,height:580{rdelim});
</script>

{*---- скрипт за js календара --------------------------------*}
{*----
{include file="_jscale.tpl" FIELD="exafte"}
{include file="_jscale.tpl" FIELD="exbefo"}
----*}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
