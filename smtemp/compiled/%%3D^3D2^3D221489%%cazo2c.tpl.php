<?php /* Smarty version 2.6.9, created on 2020-10-19 13:57:33
         compiled from cazo2c.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
body {font:normal 8pt verdana;background-color:lightgreen; padding:14px;overflow:hidden;}
.inpu2 {font:normal 7pt verdana;border:0px solid black;}
.inpu2er {font:normal 7pt verdana;border:0px solid black;background-color:salmon;}
</style>

корегирай +enter
<br>
<input type="text" name="amou" id="amou" size=12 autocomplete=off value="<?php echo $_POST['amou']; ?>
" 
	<?php if (isset ( $this->_tpl_vars['TXER'] )): ?>
class="inpu2er" style="cursor:help;" title="<?php echo $this->_tpl_vars['TXER']; ?>
"
	<?php else: ?>
class="inpu2"
	<?php endif; ?>
> 
<br>
<a style="cursor:pointer;border-bottom:1px solid black;" href="#" onclick="parent.$('#fihide').click();">отказ</a>

<script>
$(document).ready(function() {
	document.getElementById('amou').focus();
});
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>