<?php /* Smarty version 2.6.9, created on 2020-02-27 15:19:23
         compiled from cazo6to.ajax.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => "параметри на изх.документ")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

за документ <?php if (empty ( $this->_tpl_vars['DOCUSERI'] )):  else: ?>с изх.номер <?php echo $this->_tpl_vars['DOCUSERI']; ?>
/<?php echo $this->_tpl_vars['DOCUYEAR'];  endif; ?>
<br>
<nobr>
<b><?php echo $this->_tpl_vars['DOCUTYPE']; ?>
</b>
</nobr>
<br>
<br>
				<fieldset class="filtgr" style="padding:10px;">
дата
<input type="text" name="date" id="date" size=12 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'date','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> autocomplete=off> 
<br>
адресат
<input type="text" name="adresat" id="adresat" size=50 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'adresat','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> autocomplete=off> 
<br>
<style>
option {font: bold 8pt verdana}
</style>
тип
<select name="iddocutype" id="iddocutype">
<?php $_from = $this->_tpl_vars['ARDOCUTYPE']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
			<?php if ($this->_tpl_vars['ARDOWORD'][$this->_tpl_vars['ekey']]): ?>
	<option value="<?php echo $this->_tpl_vars['ekey']; ?>
" style="color:blue"><?php echo $this->_tpl_vars['elem']; ?>
</option>
			<?php else: ?>
	<option value="<?php echo $this->_tpl_vars['ekey']; ?>
"><?php echo $this->_tpl_vars['elem']; ?>
</option>
			<?php endif;  endforeach; endif; unset($_from); ?>
</select>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'корегирай','NAME' => 'subm2','ID' => 'subm2')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</fieldset>
<br>
<br> или
				<fieldset class="filtgr" style="padding:10px;">
	<nobr>
въведи новото дело/година
<input type="text" name="idcase" id="idcase" size=12 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'idcase','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
autocomplete=off> 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'смени делото','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</nobr>
				</fieldset>
<br>
<br> или
				<fieldset class="filtgr" style="padding:10px;">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'изтрий документа','NAME' => 'delete','ID' => 'delete')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php if (empty ( $this->_tpl_vars['DOCUSERI'] )): ?>
		<?php else: ?>
<br>
ВНИМАНИЕ.
<br>
След евентуално изтриване изх.номер <?php echo $this->_tpl_vars['DOCUSERI']; ?>
/<?php echo $this->_tpl_vars['DOCUYEAR']; ?>
 ще остане НЕЗАЕТ.
		<?php endif; ?>
				</fieldset>
<br> &nbsp;

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>