<table class="d_table" width='' cellspacing='0' cellpadding='0' align=center>	
<thead>
<tr>
<td class='d_table_title' colspan='200'>финансова история</td>
</tr>
</thead>
<tr class='header'>
<td> дата
<td class='sep'>&nbsp;</td>
<td> събитие
<td class='sep'>&nbsp;</td>
<td> промяна главница
<td class='sep'>&nbsp;</td>
<td> промяна лихва
<td class='sep'>&nbsp;</td>
<td> текуща главница
<td class='sep'>&nbsp;</td>
<td> общо лихвa
</tr>
		{foreach from=$ARHIST item=elem key=ekey}
			<tr valign=top  onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
					{*---- евент.премахваме подчертаването -------------------*}
						{assign var=myclas value="contbott"}
					{if $elem.flag=="a"}
						{assign var=myclas value="contregu"}
					{else}
					{/if}
					{*---- евент.премахваме извеждането на датата -------------------*}
						{assign var=mydate value=$elem.date|date_format:"%d.%m.%Y"}
					{if $elem.flag=="b"}
						{assign var=mydate value="&nbsp;"}
					{else}
					{/if}
					{*---- евент.премахваме извеждането на общо-лихва -------------------*}
						{assign var=myresuinte value=$elem.resuinte|tomoney2}
					{if $elem.flag=="c"}
						{assign var=myresuinte value="&nbsp;"}
								{*---- едновременно премахваме и датата ----*}
								{assign var=mydate value="&nbsp;"}
					{else}
					{/if}
					{*---- флаг за разтваряне на лихвата -------------------*}
						{assign var=myclasinte value="contbott"}
					{if $elem.open=="yes"}
						{assign var=myclasinte value="pagilink"}
					{else}
					{/if}
			<td class="{$myclas}"> {$mydate}			
		<td class='sep'>&nbsp;</td>
			<td class="{$myclas}"> {$elem.text}			
		<td class='sep'>&nbsp;</td>
			<td class="{$myclas}"> {$elem.capi|tomoney2}
						{if $FLPRIN}			
		<td class='sep'>&nbsp;</td>
			<td class="{$myclas}"> {$elem.inte|tomoney2}
						{else}			
		<td class='sep'>&nbsp;</td>
			<td class="{$myclasinte}" onclick="opinte('inte{$ekey}');"> {$elem.inte|tomoney2}
						{/if}
					{*---- фон за отрицат.стойности -------------------*}
						{assign var=capist value=""}
					{if $elem.resucapi<0}
						{assign var=capist value="style='background-color:#ff6666'"}
					{else}
					{/if}
						{assign var=intest value=""}
					{if $elem.resuinte<0}
						{assign var=intest value="style='background-color:#ff6666'"}
					{else}
					{/if}			
		<td class='sep'>&nbsp;</td>
			<td class="{$myclas}" {$capist}> {$elem.resucapi|tomoney2}			
		<td class='sep'>&nbsp;</td>
			<td class="{$myclas}" {$intest}> {$myresuinte}
	
{*---- отделен ред за разтваряне на лихвата -------------------*}
{assign var=peri value=$elem.listperi}
			<tr valign=top>
						{if $FLPRIN}
							{if count($peri.list)==0}
							{else}
			<td><td>
			<td style="border: 1px solid black" colspan=20>
							{/if}
						{else}
			<td id="inte{$ekey}" style="display: none; background-color: #aaffaa" colspan=20>
						{/if}
						{if count($peri.list)==0}
						{else}
<center>
олихвяване на сума <b>{$peri.descrip[2]|tomoney}</b>  
от <b>{$peri.descrip[0]|date_format:"%d.%m.%Y"}</b> до <b>{$peri.descrip[1]|date_format:"%d.%m.%Y"}</b>
</center>
	<table class="caseperc" align=center>
	<tr>
	<th> начало
	<th> край
	<th> дни
	<th> ОЛП
	<th> ЗЛ
	<th> днев%
	<th> лихва
{foreach from=$peri.list item=perielem}
	<tr>
	<td> {$perielem.d1}
	<td> {$perielem.d2}
	<td> {$perielem.days}
	<td> {$perielem.bnb}
	<td> {$perielem.zakono}
	<td> {$perielem.dnevna|tomoney:6}
	<td> {$perielem.result|tomoney:2}
{/foreach}		
</table>
						{/if}
		{*---- край на пасовете -------------------*}
		{/foreach}
			
	{*---- общ дълг -------------------*}
			<tr valign=top>
			<td class="contright" colspan=4> текущ дълг
			<td class="contright" colspan=2> {$TOTALAMO|tomoney2}
			
			</table>

{*---- скрипт за разтваряне на лихвата -------------------*}
<script>
function opinte(p1){ldelim}
	var o1= document.getElementById(p1);
	var newdis= (o1.style.display=="none") ? "" : "none";
	o1.style.display= newdis;
	resizeNyroModalIframe();
{rdelim}
</script>
						{if $FLPRIN}
						{else}
<iframe id="fraint" width=1 height=1 style="visibility:hidden">
</iframe>
<script>
function fuprin(p1){ldelim}
	var op= document.getElementById("fraint").src= p1;
{rdelim}
</script>
						{/if}

