<?php /* Smarty version 2.6.9, created on 2020-11-16 17:05:32
         compiled from rep2tran2.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
.link {background-color:#ff9999;cursor:pointer;}
.linkok {background-color:lightgreen;cursor:pointer;}
body {margin-left:10px; margin-right:10px;}
</style>

				<table class="tab2" cellspacing='0' cellpadding='2' align=center>
				<tr class='head2'>
<td colspan=20> списък трансформации на ред за отчета
				<tr class='head2'>
<td> основен взискател
<td> ред за отчета
<td> брой<br>дела
<?php $_from = $this->_tpl_vars['ARTRAN']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['indx'] => $this->_tpl_vars['elem']):
?>
				<tr onmouseover="this.style.backgroundColor='#dddddd';" onmouseout="this.style.backgroundColor='';">
<td> <?php echo $this->_tpl_vars['elem']['name']; ?>

<td> <?php echo $this->_tpl_vars['ARREPO'][$this->_tpl_vars['elem']['idrepo']]; ?>

<td align=center class="<?php if ($this->_tpl_vars['elem']['isok'] == 1): ?>linkok<?php else: ?>link<?php endif; ?>" title="виж делата" onclick="document.location.href='<?php echo $this->_tpl_vars['elem']['sear']; ?>
';return false;"> <?php echo $this->_tpl_vars['elem']['coun']; ?>

<?php endforeach; endif; unset($_from); ?>
				</table>