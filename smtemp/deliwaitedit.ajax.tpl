{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="корегирай чакащ документ"}
{include file="_erform.tpl"}

					{if $ISINTE}
					{else}
източник
<br>
{include file="_select.tpl" FROM=$ARSOURPOSTNAME ID="iddelisour" C1="input" C2="inputer"}
<br>
	<span id="r1" style="display:none">изп.дело   </span>
	<span id="r2" style="display:none">гр.дело   състав   </span>
	<span id="r0" style="display:none"></span>
доп.информация
&nbsp;&nbsp;&nbsp;
<input type="radio" name="extype" value="1" onclick="fuex('r1');"> ЧСИ
<input type="radio" name="extype" value="2" onclick="fuex('r2');"> съд
<input type="radio" name="extype" value="0" onclick="fuex('r0');" checked> други
<br>
<input type="text" name="exinfo" id="exinfo" size=60 {include file="_erelem.tpl" ID="exinfo" C1="input" C2="inputer"}> 
<br>
					{/if}
адресат
<br>
<input type="text" name="adresat" id="adresat" size=80 {include file="_erelem.tpl" ID="adresat" C1="input" C2="inputer"}> 
<br>
адрес
<br>
<textarea name="address" id="descrip" rows=3 cols=60></textarea>
					{if $ISINTE}
<br>
метод
<br>
{include file="_select.tpl" FROM=$ARPOSTTYPENAME ID="idposttype" C1="input" C2="inputer"}
					{else}
					{/if}
{*
<br>
призовкар
<br>
{include file="_select.tpl" FROM=$ARUSERPOSTNAME ID="idpostuser" C1="input" C2="inputer"}
*}
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
<br>

<script>
function fuex(pid){ldelim}
	$("#exinfo").attr("value",$("#"+pid).text());
{rdelim}
</script>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
