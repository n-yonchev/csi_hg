{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="Приключване на касов пакет" WIDTH=300}
{include file="_erform.tpl"}

<center class="n10">
касов пакет <font size=+1><b>{$DATA.serial}</b></font><br />
на обща сума <font size=+1><b>{$DATA.amount|tomoney}</b></font>
<br>
<br>
След приключване сумите ще бъдат разнесени по делата
<br>
и ще бъдат забранени корекциите в приходните ордери и в пакета.
</center>

<br>
<center>{* include file='_button.tpl' ONCLICK='document.myform.submit()' TITLE='приключи пакета' *}
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

{* <input type="submit" class="submit" name="submit" id="submit" value="приключи пакета">  *}
</center>

<script>
$(document).ready(function() {ldelim}	//parent.$.nyroModalSettings({ldelim}width:560});
{rdelim});
</script>
{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
