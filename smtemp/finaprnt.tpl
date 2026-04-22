<style>
.head {ldelim}font: normal 16pt verdana;{rdelim}
.text {ldelim}font: normal 12pt verdana;{rdelim}
.cont {ldelim}font: bold 12pt verdana; padding-left: 20px;{rdelim}
</style>

<div align=right>
изп.дело <b>{$ROCASE.serial}/{$ROCASE.year}</b>
&nbsp;&nbsp;
деловодител <b>{$ROCASEUSER.name}</b>
</div>
<div style="border: 2px solid black; padding: 10px 10px 10px 10px; margin: 10px 0px 10px 80px;">

<center>
<div class="head"> ПОСТЪПЛЕНИЕ </div>
<div class="cont"> {$ARTYPE[$ROFINA.idtype]} </div>
</center>
<div class="text"> сума </div>
<div class="cont"> {$ROFINA.inco} </div>
<div class="text"> описание </div>
<div class="cont"> {$ROFINA.descrip} </div>
{if $ROOPNAME}
	<div class="text"> наредител </div>
	<div class="cont"> {$ROOPNAME} </div>
{/if}
<div class="text"> създадено </div>
<div class="cont"> {$ROFINA.time|date_format:'%d.%m.%Y %H:%M:%S'} от {$ROUSER.name} </div>
		{if isset($ROBANK)}
<br>
<div class="text"> информация от извлечение № <b>{$ROBANK.idfinabank}</b> </div>
<br>
<div class="text"> време </div>
<div class="cont"> {$ROBANK.date} {$ROBANK.hour} </div>
<div class="text"> референция </div>
<div class="cont"> {$ROBANK.reference} </div>
		{else}
		{/if}

</div>
		{if $FIRST==1}
<br>
<br>
<br>
	<hr>
<br>
<br>
<br>
		{elseif $FIRST==2}
<br style="page-break-after: always;">
		{else}
		{/if}
