{include file="_ajax.header.tpl"}
{*
	{assign var=myti value="смяна на файла за изх.шаблон &quot;"|cat:$TEMPTEXT|cat:"&quot;"}
{include file='_window.header.tpl' TITLE=$myti}
*}


							{if count($ARINCO)==1}
								{assign var=innumb value=$ARINCO[0]}
							{else}
								{assign var=innumb value=""}
							{/if}
																{if !$ISDOCUOUT}
{include file='_window.header.tpl' TITLE="качване на сканиран файл за вх.документ "|cat:$innumb WIDTH=420}
{include file="_erform.tpl"}
<script>
nyremo= function(){ldelim}
	jQuery.ajax({ldelim}
		url: "docuedituplosess.ajax.php"
		,success: fusucc
		{rdelim});
{rdelim}
function fusucc(data){ldelim}
	if (data=="OK"){ldelim}
parent.$.nyroModalRemove();
	{rdelim}else{ldelim}
alert(data);
	{rdelim}
{rdelim}
</script>

							{if count($ARINCO)==1}
							{else}
входящи документи : 
{foreach from=$ARINCO item=elem}
	&nbsp;{$elem}
{/foreach}
<br>
							{/if}
<br>
{*
			{if isset($ISFILE)}
ВНИМАНИЕ.
<br>
В момента има текущ файл за този документ.
<br>
След евентуално каване на нов файл текущия ще бъде изтрит.
<br>
<br>
			{else}
			{/if}
*}
		{if $ERTEXT==""}
		{else}
<div style="color:red"> {$ERTEXT} </div>
		{/if}
избери файла за качване
<br>
<input type="hidden" name="MAX_FILE_SIZE" value="12000000">
<input type="file" name="file" id="file" size="90" class="input">
{include file='_but2.tpl' TYPE='submit' TITLE='качи' NAME='submyes' ID='submyes'}
<br>
			{***
			{if isset($ISFILE)}
<br>
или
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='само изтрий текущия файл' NAME='submdele' ID='submdele'}
			{else}
			{/if}
			***}
{*
<br>
или
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='затвори без сканиран файл' NAME='submno' ID='submno'}
*}
<br>&nbsp;

{*
<script type="text/javascript">
$(document).ready(function() {ldelim}
	$('.wclose_normal').hide();
{rdelim});
</script>
*}
																{else}

{include file='_window.header.tpl' TITLE="качване на сканиран файл за изходящ документ "|cat:$innumb WIDTH=420}
{include file="_erform.tpl"}
<script>
nyremo= function(){ldelim}
	jQuery.ajax({ldelim}
		url: "docuedituplosess.ajax.php"
		,success: fusucc
		{rdelim});
{rdelim}
function fusucc(data){ldelim}
	if (data=="OK"){ldelim}
parent.$.nyroModalRemove();
	{rdelim}else{ldelim}
alert(data);
	{rdelim}
{rdelim}
</script>

<br>
		{if $ERTEXT==""}
		{else}
<div style="color:red"> {$ERTEXT} </div>
		{/if}
избери файла за качване
<br>
<input type="hidden" name="MAX_FILE_SIZE" value="12000000">
<input type="file" name="file" id="file" size="90" class="input">
{include file='_but2.tpl' TYPE='submit' TITLE='качи' NAME='submyes' ID='submyes'}
<br>
<br>&nbsp;

																{/if}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
