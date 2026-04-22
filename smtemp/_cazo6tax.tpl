<br>
{*
		<div style="margin-left:50px;padding: 10px; border: 1px solid black">
*}
		<fieldset class="filtgr">
		<legend align=right> начисляване на такси </legend>
			{if $NOADDSUB}
<font color= red>
нулева такса.
<br>
НЯМА да бъде добавен предмет на изпълнение
</font>
			{else}
ще бъде добавен предмет на изпълнение
<br>
с описание
<br>
<input	 type="text" name="regitext" id="regitext" size=80 {include file="_erelem.tpl" ID="regitext" C1="input" C2="inputer"}>
<br>
и сума
<br>
<input type="text" name="regitax" id="regitax" size=10 {include file="_erelem.tpl" ID="regitax" C1="input" C2="inputer"}>


<script>
	$(document).ready(function (){ldelim}
		console.log("register onchange function");
		$("#idposttype").change(function (){ldelim}
			//alert( "Handler for .change() called." );
			switch(this.value) {ldelim}
				{if $REGITAX_DEF.regitax_1 > 0}
				case '1':
					document.getElementById("regitax").value = '{$REGITAX_DEF.regitax_1}';
				break;
				{/if}

				{if $REGITAX_DEF.regitax_2 > 0}
				case '2':
					document.getElementById("regitax").value = '{$REGITAX_DEF.regitax_2}';
				break;
				{/if}

				{if $REGITAX_DEF.regitax_3 > 0}
					case '3':
						document.getElementById("regitax").value = '{$REGITAX_DEF.regitax_3}';
						break;
				{/if}

				{if $REGITAX_DEF.regitax_4 > 0}
					case '4':
						document.getElementById("regitax").value = '{$REGITAX_DEF.regitax_4}';
						break;
				{/if}

				default:
					document.getElementById("regitax").value = '{$REGITAX_DEF.regitax}';
			{rdelim}
		{rdelim})
	{rdelim})
</script>
			{/if}
{*
		</div>
*}
		</fieldset>
