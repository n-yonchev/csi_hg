<style>
.x2 td {ldelim}font:normal 8pt verdana;background-color:beige;{rdelim}
.h2 {ldelim}font:normal 8pt verdana;background-color:tan !important;{rdelim}
.warn {ldelim}background-color:#ff9999 !important;{rdelim}
</style>
		{if isset($FORCLINK)}
					<table width=100% cellspacing=0 cellpadding=0>
					<tr>
<td class="warn">
предметите не са трансформирани според ДВ-86/17
					</table>
		{else}
					<table cellspacing=0 cellpadding=0>
					<tr>
<td valign=top>
							<table class="x2">
					<tr>
<td colspan=10 class="h2"> изчислени параметри
					<tr>
<td> задължение
<td align=right> <b>{$ARX2PARA.debt|tomo4}</b>
					<tr>
<td> мин.работна заплата 
<td align=right> <b>{$ARX2PARA.mins|tomo4}</b>
					<tr>
<td> група
<td align=right> <b>{$ARX2GRVISU[$ARX2PARA.idgrou]}</b>
{***
					<tr>
<td> пропорц.такси
<td align=right> <b>{$ARX2PARA.prop|tomo4}</b>
					<tr>
<td> всички такси
<td align=right> <b>{$ARX2PARA.all|tomo4}</b>
					<tr>
<td> такса т.26
<td align=right> <b>{$ARX2PARA.t26|tomo4}</b>
***}
							</table>

<td> &nbsp;
<td valign=top>
							<table class="x2">
							<tr>
<td class="h2"> параметър
<td class="h2" align=right> ориг<br>сума
<td class="h2" align=right> въвед<br>сума
<td class="h2"> ограничение
<td class="h2" align=right> таван
{*
<td class="h2"> флаг ориг
*}
<td class="h2"> из<br>пъл
{*
<td class="h2" align=right> резерв
*}
							<tr>
{foreach from=$ARX2VISU item=ar2 key=codepara}
	{foreach from=$ar2 item=elem}
							<tr>
<td> {$elem.text}
<td align=right> {$elem.orig|tomo4}
<td align=right
			{if isset($elem.linkinpu)}
id="{$elem.code}"
style="background-color:silver;cursor:pointer;" title="корегирай" onclick="fuinpu('{$elem.linkinpu}','{$elem.code}');"
			{else}
			{/if}
> {$elem.inpu|tomo4}
					{if $codepara=="t26"}
<td colspan=6> резерв за т.26 <span class="{if $elem.rese2<0}sut9{else}sut6{/if}">&nbsp;{$elem.rese2|tomoney}&nbsp;</span>
						{if $elem.rese2+0==0}
						{else}
							{if $elem.setto+0<0}
							{else}
&nbsp;
<img src="images/toedit.gif" title="трансформирай т.26={$elem.setto}" style="cursor:pointer;" 
onclick="tran26('{$T26SETTO}');">
{***
onclick="$('#t2link').attr('href','caseeditzone.php{$TRAN26}').click();">
onclick="$('#ttaxelink').attr('href','caseeditzone.php{$ARVARILINK[$idvari]}').click();"
<a href="caseeditzone.php{$TRAN26}" title="трансформирай т.26">
<img src="images/toedit.gif">
</a>
***}
							{/if}
						{/if}
					{else}
{***
<td> {$elem.limitext}{if isset($elem.formargu)}={$elem.formargu|tomo4}{$X2VATTEXT}{else}{/if}
***}
<td> {$elem.limitext}{if isset($elem.formargu)}={$elem.formargu|tomo4}{if $elem.isvatt}{$X2VATTEXT}{else}{/if}{else}{/if}
<td align=right> {$elem.limi|tomo4}
			{if !isset($elem.okflag)}
<td> &nbsp;
			{elseif $elem.okflag}
<td class="sut6" title="ограничението е изпълнено"> &nbsp;
			{else}
<td class="sut9" title="ограничението НЕ Е ИЗПЪЛНЕНО"> &nbsp;
			{/if}
{*
<td align=right> {$elem.rese|tomo4}
*}
					{/if}
	{/foreach}
{/foreach}
							</table>

<iframe id="framinpu" width=140 height=80 frameborder=0 style="position:absolute;display:none;"></iframe>
<a id="fihide" style="display:none;" href="#" onclick="$('#framinpu').hide();"></a>
<script>
function fuinpu(p1,pcod){ldelim}
	var obfram= document.getElementById("framinpu");
	obfram.src= "cazo2c.php"+p1;
	obfram.focus();
	moveobje(pcod,80,"framinpu");
	$(obfram).show();
{rdelim}
</script>

{*---- --------------------------------------------- ----*}
<script>
{*
function moveobje(idifra,idfiel,offset,idobje){ldelim}
				var o1= document.getElementById(idfiel);
				var o1sum= getOffsetSum(o1);
//alert(o1sum.top+'/'+o1sum.left);
				var oform= top.document.getElementById(idifra);
				var o2sum= getOffsetSum(oform);
//alert(o2sum.top+'/'+o2sum.left);
				var otop= o1sum.top + o2sum.top;
				var oleft= o1sum.left + o2sum.left +offset;
					var obje= top.document.getElementById(idobje);
					obje.style.top= otop+"px";
					obje.style.left= oleft+"px";
{rdelim}
*}
function moveobje(idfiel,offset,idobje){ldelim}
				var o1= document.getElementById(idfiel);
				var o1sum= getOffsetSum(o1);
					var obje= top.document.getElementById(idobje);
					obje.style.top= o1sum.top+"px";
					obje.style.left= Math.round(o1sum.left+offset)+"px";
//alert(obje.style.top+'/'+obje.style.left);
{rdelim}
function getOffsetSum(elem){ldelim}
    var top=0, left=0
    while(elem){ldelim}
        top = top + parseFloat(elem.offsetTop)
        left = left + parseFloat(elem.offsetLeft)
        elem = elem.offsetParent        
    {rdelim}
return {ldelim}top: Math.round(top), left: Math.round(left){rdelim}
{rdelim}

function tran26(p1){ldelim}
		jQuery.ajax({ldelim}
			url: "cazo2tran26.php?p1="+p1
			,success: function(data){ldelim}
					if (data=="ok"){ldelim}
{*---- рефреш на зоните - от cazo2modi.ajax.php ----*}
{***
var arzo= new Array("t2link","tactulink","tadvalink","t1link");
var zocode;
for (cuzo in arzo){ldelim}
	zocode= arzo[cuzo];
	$("#"+zocode).click();
{rdelim}
***}
refr4();
					{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
					{rdelim}
			{rdelim}
		{rdelim});
{rdelim}
function refr4(){ldelim}
	$("#t2link").click();
	$("#tactulink").click();
	$("#tadvalink").click();
	$("#t1link").click();
{rdelim}
</script>

					</table>
		
		{*---- {if isset($FORCLINK)} ----*}
		{/if}

