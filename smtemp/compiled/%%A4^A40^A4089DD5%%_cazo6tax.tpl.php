<?php /* Smarty version 2.6.9, created on 2022-06-02 17:26:50
         compiled from _cazo6tax.tpl */ ?>
<br>
		<fieldset class="filtgr">
		<legend align=right> начисляване на такси </legend>
			<?php if ($this->_tpl_vars['NOADDSUB']): ?>
<font color= red>
нулева такса.
<br>
НЯМА да бъде добавен предмет на изпълнение
</font>
			<?php else: ?>
ще бъде добавен предмет на изпълнение
<br>
с описание
<br>
<input	 type="text" name="regitext" id="regitext" size=80 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'regitext','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<br>
и сума
<br>
<input type="text" name="regitax" id="regitax" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'regitax','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>


<script>
	$(document).ready(function (){
		console.log("register onchange function");
		$("#idposttype").change(function (){
			//alert( "Handler for .change() called." );
			switch(this.value) {
				<?php if ($this->_tpl_vars['REGITAX_DEF']['regitax_1'] > 0): ?>
				case '1':
					document.getElementById("regitax").value = '<?php echo $this->_tpl_vars['REGITAX_DEF']['regitax_1']; ?>
';
				break;
				<?php endif; ?>

				<?php if ($this->_tpl_vars['REGITAX_DEF']['regitax_2'] > 0): ?>
				case '2':
					document.getElementById("regitax").value = '<?php echo $this->_tpl_vars['REGITAX_DEF']['regitax_2']; ?>
';
				break;
				<?php endif; ?>

				<?php if ($this->_tpl_vars['REGITAX_DEF']['regitax_3'] > 0): ?>
					case '3':
						document.getElementById("regitax").value = '<?php echo $this->_tpl_vars['REGITAX_DEF']['regitax_3']; ?>
';
						break;
				<?php endif; ?>

				<?php if ($this->_tpl_vars['REGITAX_DEF']['regitax_4'] > 0): ?>
					case '4':
						document.getElementById("regitax").value = '<?php echo $this->_tpl_vars['REGITAX_DEF']['regitax_4']; ?>
';
						break;
				<?php endif; ?>

				default:
					document.getElementById("regitax").value = '<?php echo $this->_tpl_vars['REGITAX_DEF']['regitax']; ?>
';
			}
		})
	})
</script>
			<?php endif; ?>
		</fieldset>