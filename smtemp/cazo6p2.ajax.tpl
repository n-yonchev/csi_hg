{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="отпечатване"}
{include file="_erform.tpl"}

{*----
{$HTMLCONT}
----*}

{*----
<iframe id="interdiv" frameborder="0" style="width:800px;height:800px">
</iframe>
<script type="text/javascript">
$(document).ready(function() {ldelim}
//	parent.$.nyroModalSettings({ldelim}width:1000, height:800{rdelim});
alert('{$HTMLOUT}');
//document.getElementById("interdiv").src= "cazo6p2.ajax.php?htmlout={$HTMLOUT}";
{rdelim});
</script>
----*}

<iframe id="interdiv" frameborder="0" style="width:800px;height:800px" src="cazo6p2.ajax.php?htmlout={$HTMLOUT}">
</iframe>

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
