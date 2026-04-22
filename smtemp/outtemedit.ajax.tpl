{include file="_ajax.header.tpl"}
			{if $FLAGCLON}
	{assign var=myti value="клониране за изх.шаблон &quot;"|cat:$TEMPTEXT|cat:"&quot;"}
			{else}
					{if $EDIT==0}
	{assign var=myti value="въведи данни за нов изх.шаблон"}
					{else}
	{assign var=myti value="корегирай данните за изх.шаблон"}
					{/if}
			{/if}
{include file='_window.header.tpl' TITLE=$myti WIDTH=800}
{include file="_erform.tpl"}
{*
<input type="hidden" name="mark" id="mark">
*}

			{if $FLAGCLON}
въведи уникални данни за новия шаблон
<br>
<br>
			{else}
			{/if}
описание
<br>
<input type="text" name="text" id="text" size=100 {include file="_erelem.tpl" ID="text" C1="input" C2="inputer"}>
<br>
адресат
<br>
<input type="text" name="adresat" id="adresat" size=100 {include file="_erelem.tpl" ID="adresat" C1="input" C2="inputer"}>
<br>
<input class="input" type="checkbox" name="isinvi" id="isinvi" label="дали документа представлява ПДИ">
			{if $FLAGCLON}
<br>
<br>
име на файла
<br>
<input type="text" name="filename" id="filename" size=70 {include file="_erelem.tpl" ID="filename" C1="input" C2="inputer"}>
<br>
			{else}
			{/if}
			{if isset($FILIST.regitext)}
<br>
<br>
{*
		<div style="margin-left:50px;padding: 10px; border: 1px solid black">
*}
		<div style="margin-left:50px;">
за таксата от предмета на изпълнение
<br>
описателен текст
<br>
<input type="text" name="regitext" id="regitext" size=30 {include file="_erelem.tpl" ID="regitext" C1="input" C2="inputer"}>
<br>
			<table>
				<tr>
					<td>
						такса за 1 екземпляр
						<br>
						<input type="text" name="regitax" id="regitax" size=10 {include file="_erelem.tpl" ID="regitax" C1="input" C2="inputer"}>
					</td>
					<td style="padding-left: 10px;">
						по {$ARPOSTTYPE.1}
						<br>
						<input type="text" name="regitax_1" id="regitax_1" size=10 {include file="_erelem.tpl" ID="regitax_1" C1="input" C2="inputer"}>
					</td>
					<td style="padding-left: 10px;">
						по {$ARPOSTTYPE.2}
						<br>
						<input type="text" name="regitax_2" id="regitax_2" size=10 {include file="_erelem.tpl" ID="regitax_2" C1="input" C2="inputer"}>
					</td>
					<td style="padding-left: 10px;">
						по {$ARPOSTTYPE.3}
						<br>
						<input type="text" name="regitax_3" id="regitax_3" size=10 {include file="_erelem.tpl" ID="regitax_3" C1="input" C2="inputer"}>
					</td>
					<td style="padding-left: 10px;">
						по {$ARPOSTTYPE.4}
						<br>
						<input type="text" name="regitax_4" id="regitax_4" size=10 {include file="_erelem.tpl" ID="regitax_4" C1="input" C2="inputer"}>
					</td>
				</tr>
			</table>
		</div>
			{else}
			{/if}
					{if $EDIT==0}
<br>
		{if $ERTEXT==""}
		{else}
<div style="color:red"> {$ERTEXT} </div>
		{/if}
избери файла за качване
<br>
<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
<input type="file" name="file" id="file" size=50 class="input">
					{else}
					{/if}
								{*---- 09.01.2012 - данни за връчването ----*}
								{if $ISPOST}
<style>
.blue {ldelim}color:blue;{rdelim}
.red  {ldelim}color:red{rdelim}
.marked {ldelim}background-color:silver{rdelim}
</style>
<br>
		<fieldset class="filtgr" style="padding:10px;">
		<legend align=right> за връчването </legend>
<img src="images/dire.gif" title="избери параметри" style="float:right;cursor:pointer;" onclick="fudire();">
метод по подразбиране
<br>
{include file="_select.tpl" FROM=$ARTYPENAME ID="idposttype" C1="input" C2="inputer"}
<br>
адресат
<br>
<input type="text" name="postadresat" id="postadresat" size=100 {include file="_erelem.tpl" ID="postadresat" C1="input" C2="inputer"}>
<br>
адрес
<br>
<input type="text" name="postaddress" id="postaddress" size=100 {include file="_erelem.tpl" ID="postaddress" C1="input" C2="inputer"}>
{***
			{if $NOFILE}
<br>
<br>
<font>липсва файла за шаблона</font>
			{else}
			{/if}
<br>
<br>
<u>списък на таговете в шаблона</u>
<br>
			{foreach from=$ARTAGS item=code key=elem}
				{if $code==1}
					{assign var=clas value="blue"}
				{elseif $code==2}
					{assign var=clas value="red"}
				{else}
					{assign var=clas value=""}
				{/if}
&nbsp;&nbsp;
<nobr><span class="{$clas}" onmouseover="this.className='marked';" onmouseout="this.className='{$clas}';">
{$elem}</span></nobr>
			{/foreach}
***}
		</fieldset>
								{else}
								{/if}
								{*---- име на файла ----*}
{$FILENAME}&nbsp;&nbsp;
								{*---- разглеждане ----*}
					{if $ARTAGS===false}
					{else}
<img src="images/view.png" style="cursor:pointer" title="виж съдържанието на шаблона"
onclick="w2=window.open('{$VIEWTEMP}','win2');w2.focus();">
					{/if}
								{*---- тагове ----*}
					{if $ARTAGS===false}
<span style="color:red;"> липсва файла на шаблона </span>
					{elseif empty($ARTAGS)}
&nbsp;
					{else}
<br>
специални тагове :
{foreach from=$ARTAGS item=taelem}
	<b>{$taelem}</b>&nbsp;&nbsp;
{/foreach}
					{/if}
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
<input type=submit name="s2" id="s2" value="з2" style="display:none;">

<style>
td {ldelim}font:normal 8pt verdana;border-bottom:1px solid silver;{rdelim}
.h1 {ldelim}background-color:silver;{rdelim}
.c1 {ldelim}background-color:khaki;cursor:pointer;{rdelim}
</style>
				<table id="delihelp" style="display:none;">
				<tr>
<td colspan=10> избери параметри за връчване
				<tr class="h1">
<td> изх.шаблон
<td> адресат
<td> метод връчване
<td> адресат връчване
<td> адрес връчване
{foreach from=$ARHELP item=elem key=id2}
				<tr onmouseover="$(this).addClass('c1');" onmouseout="$(this).removeClass('c1');" onclick="fuclic('{$elem.code}');">
<td> {$elem.text}
<td> {$elem.adresat}
<td> {$ARPOSTTYPE_2[$elem.idposttype]}
<td> {$elem.postadresat}
<td> {$elem.postaddress}
{/foreach}
				</table>

<script>
var dhview= false;
function fudire(){ldelim}
	if (dhview){ldelim}
//		$("#delihelp").hide();
//		dhview= false;
$("#s2").click();
	{rdelim}else{ldelim}
		$("#delihelp").show();
		dhview= true;
	{rdelim}
	resizeNyroModalIframe();
{rdelim}
function fuclic(data){ldelim}
	var arre= data.split("^");
	$("#adresat").val(arre[0]);
	$("#idposttype").val(arre[1]);
	$("#postadresat").val(arre[2]);
	$("#postaddress").val(arre[3]);
$("#s2").click();
{rdelim}
</script>

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
