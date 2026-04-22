{include file="_ajax.header.tpl"}{include file="_window.header.tpl"}
{include file="_erform.tpl"}

<script>
//parent.$.nyroModalSettings({ldelim}width:560, height:720{rdelim});
</script>


			<table class="caseview" align=center>
						{if $FLPRIN}
			<tr>
			<td colspan=10>
{*-------------------------------- заглавни данни ---------------------------------------*}
							<table class="caseview" align=center>
							<tr>
							<td class="cont"> изпълнително дело {$DATACASE.serial}/{$DATACASE.year}
							<td class="cont"> предмет на изпълнение
							<tr>
							<td class="contleft" valign=top style="border: 1px solid black"> 
								образувано на <b>{$DATACASE.created|date_format:"%d.%m.%Y"}</b>
								<br>
						{assign var="arindx" value=$DATACASE.idcofrom}
								идва от <b>{$ARFROM.$arindx}</b> 
									{if empty($DATACASE.cogrou)}
									{else}
								състав <b>{$DATACASE.cogrou}</b>
									{/if}
								<br>
						{assign var="arindx" value=$DATACASE.idtitu}
								изп.титул <b>{$ARTITU.$arindx}</b>
								<br>
						{assign var="arindx" value=$DATACASE.idsort}
								описание <b>{$ARSORT.$arindx} {$DATACASE.conome}/{$DATACASE.coyear}</b>
							<td class="contleft" valign=top style="border: 1px solid black"> 
								описание <b>{$DATASUBJ.text}</b>
								<br>
						{assign var="arindx" value=$DATASUBJ.idtype}
								съдържание <b>{$ARTYPE.$arindx} {$DATASUBJ.amount|tomoney2} 
								от дата {$DATASUBJ.fromdate|date_format:"%d.%m.%Y"}</b>
								<br>
						{assign var="arindx" value=$DATASUBJ.idclaimer}
								взискател <b>{$ARCLAI.$arindx}</b>
								<br>
								длъжници <b>
									{assign var="isfirst" value=true}
						{foreach from=$DEBTLIST item=indxdebt}
							{if $isfirst}
									{assign var="isfirst" value=false}
							{else}
								, 
							{/if}
							{$ARDEBT.$indxdebt}
						{/foreach}
								</b>
							</table>
						{else}
			<tr>
			<td align=right colspan=10>
<img src="images/print.gif" title="отпечати текущата страница" style="cursor:pointer" onclick="fuprin('{$CURINT}');"></table>
						{/if}
{*-------------------------------- плащания ---------------------------------------*}
<table class="d_table" width='' cellspacing='0' cellpadding='0' align=center>
	<thead>
	<tr>
	<td class='d_table_title' colspan='200'>плащания по предмета на изпълнение</td>		
	</tr>			
		{if $FLPRIN}		
		{else}		
	<tr>			
	<td class="d_table_button" colspan=100 align=right>			
{include file='_button.tpl' HREF="$ADDNEW"  TITLE='добави'  }				
{* <span class="submit"><a href="{$ADDNEW}">добави</a></span> *}		
	</tr>						
		{/if}			
	</thead>		
	<tr class='header'>			
	<td> дата			
	<td class='sep'>&nbsp;</td>			
	<td class="contright"> общо			
	<td class='sep'>&nbsp;</td>			
	<td class="contright"> намалява главница			
	<td class='sep'>&nbsp;</td>			
	<td class="contright"> намалява лихва			
		{if $FLPRIN}
		{else}				
	<td class='sep'>&nbsp;</td>				
	<td class="contright">&nbsp;			
		{/if}
		{foreach from=$LIST item=elem key=ekey}
			<tr valign=top  onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
			<td class="contbott" align=right> {$elem.date|date_format:"%d.%m.%Y"}			
			<td class='sep'>&nbsp;</td>
			<td class="contbott" align=right> {$elem.tocapi+$elem.tointe|tomoney}			
			<td class='sep'>&nbsp;</td>
			<td class="contbott" align=right> {$elem.tocapi|tomoney}			
			<td class='sep'>&nbsp;</td>
			<td class="contbott" align=right> {$elem.tointe|tomoney}						
		{if $FLPRIN}
		{else}
			<td class='sep'>&nbsp;</td>
			<td class="none" align=center> 	<a href="{$elem.edit}"><img src="images/edit.png" title="корегирай"></a>						
		{/if}
		{/foreach}
			
			</table>

{*-------------------------------- история ---------------------------------------*}
<br>
{$SUBJHIST}


{include file="_window.footer.tpl"}{include file="_ajax.footer.tpl"}
