{include file="_base.header.tpl"}

					{$CONTENT}

{*---- за автоматично отпечатване ----*}
<iframe id="idprin" width=1 height=1 frameborder=0 style="display:block"></iframe>
{*
<iframe id="idprin" width=500 height=340 frameborder=0 style="display:block"></iframe>
*}
<script>
function fuprin(p1){ldelim}
	document.getElementById("idprin").focus();
	document.getElementById("idprin").src= p1;
{rdelim}
</script>

<script>
function automainsubm(event,foid){ldelim}
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){ldelim}
var obfi= document.getElementById(foid);
obfi.style.visibility= "hidden";
//obfi.value= foid+obfi.value;
document.forms['mymainform'].submit();
	{rdelim}else{ldelim}
return true;
	{rdelim}
{rdelim}
</script>

{include file="_base.footer.tpl"}
