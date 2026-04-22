{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="корегирай филтъра" WIDTH=800}
{include file="_erform.tpl"}

				<fieldset class="filtgr">
				<legend align=right> екземпляр за връчване </legend>
					<table>
{* --------------------------------------------------- *}
					<tr>
<td> дата или период на създаване
<td>
<input type="text" name="peridateregi" id="peridateregi" size=20 {include file="_erelem.tpl" ID="peridateregi" C1="input" C2="inputer"}> 
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="peridateregi" label="няма дата на създаване">
</nobr>
					<tr>
<td> адресата да съдържа
<td>
<input type="text" name="asatcont" id="asatcont" size=50 {include file="_erelem.tpl" ID="asatcont" C1="input" C2="inputer"}> 
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="asatcont" label="празен адресат">
</nobr>
					<tr>
<td> адреса да съдържа
<td>
<input type="text" name="addrcont" id="addrcont" size=50 {include file="_erelem.tpl" ID="addrcont" C1="input" C2="inputer"}> 
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="addrcont" label="празен адрес">
</nobr>
{* --------------------------------------------------- *}
					</table>
				</fieldset>

				<fieldset class="filtgr">
				<legend align=right> връчване </legend>
					<table>
									{if $ISINTE}
					<tr>
<td> метод
<td>
{include file="_select.tpl" FROM=$ARPOSTTYPENAME ID="idposttype" C1="input" C2="inputer"}
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="idposttype" label="няма метод на връчване">
</nobr>
									{else}
									{/if}
{*+++
					<tr>
<td> призовкар
<td>
{include file="_select.tpl" FROM=$ARUSERPOST ID="idpostuser" C1="input" C2="inputer"}
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="idpostuser" label="няма призовкар">
</nobr>
+++*}
					<tr>
<td> дата или период на вземане 
<td>
<input type="text" name="peridate1" id="peridate1" size=20 {include file="_erelem.tpl" ID="peridate1" C1="input" C2="inputer"}> 
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="peridate1" label="няма дата на вземане">
</nobr>
					<tr>
<td> дата или период на връчване
<td>
<input type="text" name="peridate2" id="peridate2" size=20 {include file="_erelem.tpl" ID="peridate2" C1="input" C2="inputer"}> 
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="peridate2" label="няма дата на връчване">
</nobr>
					<tr>
<td> дата или период на връщане 
<td>
<input type="text" name="peridate3" id="peridate3" size=20 {include file="_erelem.tpl" ID="peridate3" C1="input" C2="inputer"}> 
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="peridate3" label="няма дата на връщане">
</nobr>
					<tr>
<td> текущ статус
<td>
{include file="_select.tpl" FROM=$ARSTATPOST ID="idpoststat" C1="input" C2="inputer"}
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="idpoststat" label="няма текущ статус">
</nobr>
					</table>
				</fieldset>

									{if $ISINTE}
				<fieldset class="filtgr">
				<legend align=right> изходящ документ </legend>
					<table>
					<tr>
<td> номер
<td>
<input type="text" name="seridocuout" id="seridocuout" size=20 {include file="_erelem.tpl" ID="seridocuout" C1="input" C2="inputer"}> 
					<tr>
<td> година
<td>
<input type="text" name="yeardocuout" id="yeardocuout" size=20 {include file="_erelem.tpl" ID="yeardocuout" C1="input" C2="inputer"}> 
{***
					<tr>
<td> дата или период на изходяване
<td>
<input type="text" name="peridateregi" id="peridateregi" size=20 {include file="_erelem.tpl" ID="peridateregi" C1="input" C2="inputer"}> 
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="peridateregi" label="няма дата на изходяване">
</nobr>
					<tr>
<td> адресата да съдържа
<td>
<input type="text" name="asatcont" id="asatcont" size=50 {include file="_erelem.tpl" ID="asatcont" C1="input" C2="inputer"}> 
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="asatcont" label="празен адресат">
</nobr>
					<tr>
<td> адреса да съдържа
<td>
<input type="text" name="addrcont" id="addrcont" size=50 {include file="_erelem.tpl" ID="addrcont" C1="input" C2="inputer"}> 
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="addrcont" label="празен адрес">
</nobr>
***}
					<tr>
<td> тип
<td>
{include file="_select.tpl" FROM=$ARTYPEPOST ID="iddocutype" C1="input" C2="inputer"}
					<tr>
<td colspan=3>
въведи списък изходящи номера от текущото тримесечие, разделени с интервал
<br>
<textarea class="input" name="listdocuout" id="listdocuout" rows=2 cols=80></textarea>
					</table>
				</fieldset>
									{else}
				<fieldset class="filtgr">
				<legend align=right> входящ документ </legend>
					<table>
					<tr>
<td> номер
<td>
<input type="text" name="seridocu" id="seridocu" size=20 {include file="_erelem.tpl" ID="seridocu" C1="input" C2="inputer"}> 
					<tr>
<td> година
<td>
<input type="text" name="yeardocu" id="yeardocu" size=20 {include file="_erelem.tpl" ID="yeardocu" C1="input" C2="inputer"}> 
					<tr>
<td> описанието да съдържа
<td>
<input type="text" name="desccont" id="desccont" size=50 {include file="_erelem.tpl" ID="desccont" C1="input" C2="inputer"}> 
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="desccont" label="празно описание">
</nobr>
					<tr>
<td> подателя да съдържа
<td>
<input type="text" name="fromcont" id="fromcont" size=50 {include file="_erelem.tpl" ID="fromcont" C1="input" C2="inputer"}> 
{*
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="fromcont" label="празен подател">
</nobr>
*}
					<tr>
<td> бележките да съдържат
<td>
<input type="text" name="notecont" id="notecont" size=50 {include file="_erelem.tpl" ID="notecont" C1="input" C2="inputer"}> 
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="notecont" label="празни бележки">
</nobr>
					<tr>
<td> доп.инфо да съдържа
<td>
<input type="text" name="exincont" id="exincont" size=50 {include file="_erelem.tpl" ID="exincont" C1="input" C2="inputer"}> 
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="exincont" label="празна доп.инфо">
</nobr>
					</table>
				</fieldset>
									{/if}

									{if $ISINTE}
				<fieldset class="filtgr">
				<legend align=right> изп.дело </legend>
					<table>
					<tr>
<td> номер/год
<td>
<input type="text" name="seriyearcase" id="seriyearcase" size=20 {include file="_erelem.tpl" ID="seriyearcase" C1="input" C2="inputer"}> 
					<tr>
<td> деловодител
<td>
{include file="_select.tpl" FROM=$ARUSERCASE ID="idcaseuser" C1="input" C2="inputer"}
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="idcaseuser" label="без деловодител">
</nobr>
					</table>
				</fieldset>
									{else}
									{/if}

<br>
{include file='_button.tpl' TYPE='submit' TITLE='приложи' NAME='submit' ID='submit'}
<br>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
