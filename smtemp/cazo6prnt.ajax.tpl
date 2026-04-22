{*---- линкове за групите банки ----*}
				{if isset($ARLINK)}
{capture name=listlink}
	{foreach from=$ARLINK item=elem key=pano}
&nbsp;
<a href="#" onclick="window.location.href='caseeditzone.php{$elem}';"> {$pano}</a>
	{/foreach}
{/capture}
{assign var=list value="група"|cat:$smarty.capture.listlink}
				{else}
{assign var=list value=""}
				{/if}
{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="отпечатване "|cat:$list}
{include file="_erform.tpl"}

{*---- извеждане на PDF ----*}
				{if isset($URLPAR)}
							{if $WORDTRAN}
може да корегирате и разпечатвате doc файла,
<br>
но евентуалните корекции не може да бъдат съхранявани на сървъра
<iframe id="interdiv" frameborder="0" style="width:300px;height:100px">
</iframe>

<script type="text/javascript">
$(document).ready(function() {ldelim}
document.getElementById("interdiv").src= "cazo6word.ajax.php?name={$URLPAR}";
{rdelim});
</script>
							{else}
почакай...
след появата на документа натисни бутона Print за отпечатване
<iframe id="interdiv" frameborder="0" style="width:800px;height:800px">
</iframe>

<script type="text/javascript">
$(document).ready(function() {ldelim}
//	parent.$.nyroModalSettings({ldelim}width:1000, height:800{rdelim});
var newurl=
//'html2ps/demo/html2ps.php?process_mode=single&URL=http%3A%2F%2Flocalhost%2F{$URLPAR}&pixels=860&scalepoints=1&renderimages=1&renderlinks=1&media=A4&cssmedia=Screen&leftmargin=25&rightmargin=10&topmargin=10&bottommargin=10&encoding=utf-8&headerhtml=&footerhtml={$FOOTER}&watermarkhtml=&toc-location=before&smartpagebreak=1&pslevel=3&method=fpdf&pdfversion=1.3&output=0&convert=Convert+File';
'html2ps/demo/html2ps.php?process_mode=single&URL=http%3A%2F%2Flocalhost%2F{$URLPAR}'
+'&pixels=760&scalepoints=1&renderimages=1&renderlinks=1&media=A4&cssmedia=Screen'
+'&leftmargin=10&rightmargin=10&topmargin=10&bottommargin=10&encoding=utf-8&headerhtml=&footerhtml={$FOOTER}'
+'&watermarkhtml=&toc-location=before&smartpagebreak=1&pslevel=3&method=fpdf&pdfversion=1.3&output=0&convert=Convert+File';
document.getElementById("interdiv").src= newurl;
{rdelim});
</script>
							{/if}

				{else}
{*----
	{foreach from=$ARLINK item=elem key=pano}
			{assign var="oncl" value="window.location.href='caseeditzone.php"|cat:$elem|cat:"';"}
<a href="#" onclick="{$oncl}"> част {$pano}</a>
<br>
	{/foreach}
----*}

{*---- текст за групите банки ----*}
					{if isset($ARLINK)}
избери група банки за отпечатване
					{else}
					{/if}
				{/if}

{*---- списък клонове ----*}
				{if isset($ARBRAN)}
<font color="red">
При избор на повече от 15 клона извеждането може да приключи аварийно.
</font>
<br>
<br>
избери клонове за извеждане
&nbsp;&nbsp;&nbsp;&nbsp;
{*----
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer"
href="#" onclick="checkon();return false;"> <nobr>всички да</nobr> </a>
&nbsp;
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
href="#" onclick="checkoff();return false;"> <nobr>всички не</nobr> </a>
<br>
<script type="text/javascript" src="js/jq.checkbox.js"></script>
<script>
function checkon(){ldelim}
	$("input[@type='checkbox']").check("on");
{rdelim}
function checkoff(){ldelim}
	$("input[@type='checkbox']").check("off");
{rdelim}
</script>
					<table>
					<tr>
						{counter start=$COUNTPERCOL assign=mycoun}
	{foreach from=$ARBRAN item="branname" key="branid"}
						{counter assign=mycoun}
						{if $mycoun<=$COUNTPERCOL}
						{else}
							{counter start=1 assign=mycoun}
					<td valign=top>
						{/if}
<nobr>
<input type="checkbox" class="input" name="branlist[]" value="{$branid}" label="{$branname}">
</nobr>
<br/>
	{/foreach}
					</table>
----*}
{include file="cazo6bran.tpl"}
				{*---- евентуално за предмет на изпълнение ----*}
				{* източник : cazo6regi.ajax.tpl *}
{*
						{if $ISREGITAX and isset($ARBRAN)}
*}
						{if $ISREGITAX}
{*
<br>
		<div style="margin-left:50px;padding: 10px; border: 1px solid black">
			{if $NOADDSUB}
<font color= red>
нулева такса. НЯМА да бъде добавен предмет на изпълнение
</font>
			{else}
ще бъде добавен предмет на изпълнение
			{/if}
<br>
с описание
<br>
<input type="text" name="regitext" id="regitext" size=80 {include file="_erelem.tpl" ID="regitext" C1="input" C2="inputer"}>
<br>
и сума
<br>
<input type="text" name="regitax" id="regitax" size=10 {include file="_erelem.tpl" ID="regitax" C1="input" C2="inputer"}>
		</div>
*}
{include file="_cazo6tax.tpl"}
						{else}
						{/if}
				{*--------------------------------------*}
<br>
{include file='_button.tpl' TYPE='submit' TITLE='готово' NAME='submit' ID='submit'}
				{else}
				{/if}

<script>
			var retax= {$smarty.post.regitax} +0;
			var retext= "{$TEMPTEXT}";
			var tempmark= "{$TEMPMARK}";
</script>

{*----*}
{include file='_window.footer.tpl'}
{*----*}
{include file="_ajax.footer.tpl"}
