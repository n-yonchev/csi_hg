{include file="_ajax.header.tpl"}
{*
			{if $EDIT <= 0}	
				{assign var="_title" value='ВЪВЕДИ'}
			{else}
				{assign var="_title" value='КОРЕГИРАЙ'}
			{/if}
*}
{include file='_window.header.tpl' TITLE="заместване"}
{include file="_erform.tpl"}

							{if $ACTION}
<input type=hidden name="iduserdepu">
{*
					{if $smarty.post.iduserdepu==0}
<b>прекратяване на заместването от <br>{$NAMEDEPUOLD}</b>
<br>
<br>
ВНИМАНИЕ.
<br>
<nobr>
всички дела на деловодителя {$NAMEORIG} ще му бъдат възстановени
</nobr>
					{else}
*}
<b>прехвърляне на дела</b>
<br>
<br>
ВНИМАНИЕ.
<br>
<nobr>
Всичките <b>{$COUNORIG} дела</b> на деловодителя <b>{$NAMEORIG}</b>
</nobr>
<br>
<nobr>
ще бъдат прехвърлени на заместника му <b>{$NAMEDEPU}</b>
</nobr>
{*
<br>
с възможност за възстановяване
					{/if}
*}
<br>
<br>
{*
{include file='_but2.tpl' TYPE='submit' TITLE='да' NAME='submyes' ID='submyes'}
&nbsp;&nbsp;
{include file='_but2.tpl' TYPE='submit' TITLE='отказ' NAME='submno' ID='submno'}
*}
{include file='_but2.tpl' TYPE='submit' TITLE='прехвърли временно' NAME='submyes' ID='submyes'}
<br>
с възможност за възстановяване
<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='премести постоянно' NAME='submperm' ID='submyes'}
<br>
БЕЗ възможност за възстановяване
<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='откажи' NAME='submno' ID='submno'}

							{else}

избери заместник на деловодителя
<br>
<b>{$NAMEORIG}</b>
<br>
<br>
{include file="_select.tpl" FROM=$ARDEPUNAME ID="iduserdepu" C1="input" C2="inputer"}
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
							{/if}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
