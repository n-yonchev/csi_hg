{assign var="myheadcode" value="
<script type='text/javascript' src='autocomp/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='autocomp/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='autocomp/thickbox-compressed.js'></script>
<script type='text/javascript' src='autocomp/jquery.autocomplete.js'></script>
<link rel='stylesheet' type='text/css' href='autocomp/jquery.autocomplete.css' />
<link rel='stylesheet' type='text/css' href='autocomp/thickbox.css' />
"}
{include file="_ajax.header.tpl" HEADCODE=$myheadcode}
{include file="_window.header.tpl" TITLE='приравняване към друг представител'}
{include file="_erform.tpl"}

Ще приравните <nobr> <b>{$AGNAME} ({$AGCOUN})</b> </nobr>
<br>
към друг представител.
<br>
<br>
Изберете другия представител (въведи текст)
<br>
<input type="text" name="newagent" id="newagent" size=40 {include file="_erelem.tpl" ID="newagent" C1="input" C2="inputer"}> 
<br>
<br>
<b>ВНИМАНИЕ.</b>
<br>
<br>
След приравняването ВСИЧКИТЕ {$AGCOUN} на 
<br>
<b>{$AGNAME}</b>
ще преминат към новия представител,
<br>
<br>
<b>{$AGNAME}</b> ще остане БЕЗ ДЕЛА и може да бъде изтрит.
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='приравни' NAME='submit' ID='submit'}

<script type="text/javascript">
//$('#newagent').autocomplete("agentauto.ajax.php",{ldelim}matchContains:false, cacheLength:20, extraParams:{ldelim}idmark:{$IDMARK}{rdelim}{rdelim});
	$('#newagent').autocomplete("agentauto.ajax.php",{ldelim}matchContains:false, cacheLength:20, scrollHeight:400
	,formatItem: function(data, i, total) {ldelim}
		var mycase= (data[2]) ? data[2] : 0;
		var mytext= (mycase==1) ? " дело" : " дела";
		var mycont= data[0]+" ["+mycase+mytext+"]";
{*
			if (data[1]=={$IDMARK}){ldelim}
	return "<font color=red>"+data[0]+"</font>";
			{rdelim}else{ldelim}
	return data[0];
			{rdelim}
		{rdelim}
*}
			if (data[1]=={$IDMARK}){ldelim}
	return "<font color=red>"+mycont+"</font>";
			{rdelim}else{ldelim}
	return mycont;
			{rdelim}
		{rdelim}
	{rdelim});
</script>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
