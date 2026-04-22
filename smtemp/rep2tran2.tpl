{include file="_tab2.tpl"}
<style>
.link {ldelim}background-color:#ff9999;cursor:pointer;{rdelim}
.linkok {ldelim}background-color:lightgreen;cursor:pointer;{rdelim}
body {ldelim}margin-left:10px; margin-right:10px;{rdelim}
</style>

				<table class="tab2" cellspacing='0' cellpadding='2' align=center>
				<tr class='head2'>
<td colspan=20> списък трансформации на ред за отчета
				<tr class='head2'>
<td> основен взискател
<td> ред за отчета
<td> брой<br>дела
{foreach from=$ARTRAN item=elem key=indx}
				<tr onmouseover="this.style.backgroundColor='#dddddd';" onmouseout="this.style.backgroundColor='';">
<td> {$elem.name}
<td> {$ARREPO[$elem.idrepo]}
<td align=center class="{if $elem.isok==1}linkok{else}link{/if}" title="виж делата" onclick="document.location.href='{$elem.sear}';return false;"> {$elem.coun}
{/foreach}
				</table>
