{include file="_ajax.header.tpl"}

{if $EDIT <= 0}
	{assign var="_title" value='ВЪВЕДИ бележки'}
{else}
	{assign var="_title" value='корегирай бележките'}
{/if}
{include file='_window.header.tpl' TITLE=$_title}
{include file="_erform.tpl"}

бележки
<br>
<textarea class="input" name="notes" id="notes" rows=6 cols=60></textarea>

<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

{*---- скрипт за скриване/показване според типа --------------------------------*}
{*
<script type="text/javascript">
var obtype= document.getElementById("idtitu");
var obsubt1= document.getElementById("subtit1");
var obsubt2= document.getElementById("subtit2");
var obsubt5= document.getElementById("subtit5");
obtype.onchange= typechan;
typechan();
//parent.$.nyroModalSettings({ldelim}height:260, width:350{rdelim});
function typechan(){ldelim}
	obsubt1.style.display= "none";
	obsubt2.style.display= "none";
	obsubt5.style.display= "none";
	if (obtype.value==1){ldelim}
		obsubt1.style.display= "block";
	{rdelim}else if (obtype.value==2){ldelim}
		obsubt2.style.display= "block";
		resizeNyroModalIframe();
	{rdelim}else if (obtype.value==5){ldelim}
		obsubt5.style.display= "block";
		resizeNyroModalIframe();
	{rdelim}else{ldelim}
	{rdelim}
	resizeNyroModalIframe();
{rdelim}
//getcof({$POSTCOFROM});
function getcof(p1){ldelim}
	$("#idcofrom").load(encodeURI("cazo1cofrom.ajax.php?sele="+p1),{ldelim}{rdelim},function() {ldelim}
		resizeNyroModalIframe();
		//setTimeout("resizeNyroModalIframe();",1000);
	
	{rdelim});
{rdelim}
</script>
*}
{include file='_window.footer.tpl'}

{include file="_ajax.footer.tpl"}
