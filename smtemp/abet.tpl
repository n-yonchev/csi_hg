						{if $FLPRIN}
						{else}
<div class='tabs_line' >
	<table class='tabs' style='' cellspacing='0'  cellpadding='0' border='0' >
	<tr>
	{foreach from=$YEARLIST item=elem key=ekey}
		<td class='tabs_sep'>&nbsp;</td> 
		{if $YEAR==$ekey}
			<td class='tabs_left_selected'></td>
			<td class='tabs_middle_selected'><span>{$ekey}</span></td>
			<td class='tabs_right_selected'></td>
		{else}	
			<td onclick='document.location.href="{$elem}"' class='tabs_left'></td>
			<td onclick='document.location.href="{$elem}"' class='tabs_middle'><span>{$ekey}</span></td>
			<td onclick='document.location.href="{$elem}"' class='tabs_right'></td>
		{/if}
	{/foreach}
	</tr>
	</table>
</div>
						{/if}

<table class="d_table" width='' cellspacing='0' cellpadding='0' align=center>

						{if $FLPRIN}
							{assign var=txpage value="стр."|cat:$PAGENO}
						{else}
	<thead>
		<tr>
			<td class="d_table_title" colspan=100>
									{if empty($LETTLIST)}
<span style="padding:40px;"> няма имена </span>
									{else}
			{foreach from=$LETTLIST item=elem}
				{if $elem.letter < "А"}
					{assign var=ex1 value="style='background-color:wheat;padding-left:4px;'"}
					{assign var=et1 value="title='лат.буква, цифра или служ.символ'"}
				{else}
					{assign var=ex1 value=""}
					{assign var=et1 value=""}
				{/if}
{*----
				<a class="pagilink" {$ex1} href="{$elem.link}"> {$elem.letter}={$elem.ord} </a>&nbsp;
----*}
<a class="pagilink" {$ex1} href="{$elem.link}" {$et1}> {$elem.letter} </a>&nbsp;
			{/foreach}
									{/if}
						{/if}

									{if empty($LETTLIST)}
	</thead>
									{else}
			<tr>
			<td class="d_table_title" colspan=100>имена с буква "{$CULETT}" {$txpage}
						{if $FLPRIN}
						{else}
<tr>
	<td class='d_table_button' colspan='100'>
	{include file='_button.tpl' ONCLICK="fuprin('$CURINT');" TITLE='отпечати буквата'}
	{include file='_button.tpl' ONCLICK="fuprin('$CURINTALL');" TITLE='отпечати азбучника'}
						{/if}
	</thead>
		<tr class='header'>
			<td> име
			<td class='sep'>&nbsp;</td>
			<td> тип
			<td class='sep'>&nbsp;</td>
			<td> ЕГН/ЕИК
			<td class='sep'>&nbsp;</td>
			<td> адрес
			<td class='sep'>&nbsp;</td>
			<td> роля
		</tr>


		{foreach from=$LIST item=elem key=ekey}
{*----
			<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
----*}
			<tr>
			<td valign=top> {$elem.text}
					{if $elem.type==1}
						{assign var=txtype value="юл"}
					{elseif $elem.type==2}
						{assign var=txtype value="фл"}
					{else}
						{assign var=txtype value="друго"}
					{/if}
			<td class='sep'>&nbsp;</td>
			<td valign=top> {$txtype}
			<td class='sep'>&nbsp;</td>
			<td valign=top> {$elem.iden}
			<td class='sep'>&nbsp;</td>
{*------ адресите ----------------------*}

			<td valign=top> 
					{if count($elem.addr)==0}
			&nbsp;
					{else}
				{foreach from=$elem.addr item=elemaddr}
			{$elemaddr}
			<br>
				{/foreach}
					{/if}

{*------ ролите ----------------------*}
			<td class='sep'>&nbsp;</td>
			<td valign=top>
					{if count($elem.suit)==0}
			&nbsp;
					{else}
				{foreach from=$elem.suit item=elemsuit}
			{if $elemsuit.role==1}взиск.{else}длъжник{/if} {$elemsuit.seri}/{$elemsuit.year}
			<br>
				{/foreach}
					{/if}
		{/foreach}

{include file="_pagina.tr.tpl"}
									{/if}
			</table>

{*----
						{if $FLPRIN}
						{else}

<br>
<iframe id="fraint" width=300 height=100 style="visibility:visible">
</iframe>
<script>
function fuprin(p1){ldelim}
alert(p1);
	document.getElementById("fraint").src= p1;
{rdelim}
</script>
						{/if}
----*}

