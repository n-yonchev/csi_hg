<?php /* Smarty version 2.6.9, created on 2020-03-27 17:59:04
         compiled from delienveexis.ajax.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => "избери неизпратен плик",'WIDTH' => 700)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
td {font:normal 8pt verdana;border-bottom: 1px solid white;border-right: 1px solid white;}
.head {background-color:silver !important;}
.enve {background-color:beige !important;}
.link {background-color:khaki !important;cursor:pointer;}
.mark {color:red;}

</style>

за документ <b><?php echo $this->_tpl_vars['ROPOST']['d2seri']; ?>
/<?php echo $this->_tpl_vars['ROPOST']['d2year']; ?>
</b>
<br>
с адресат <b><?php echo $this->_tpl_vars['ROPOST']['adresat']; ?>
</b>
<br>
и адрес <b><?php echo $this->_tpl_vars['ROPOST']['address']; ?>
</b>

<br>
<br>
					<table align=center>
					<tr>
<td class="head" colspan=3> плик
<td class="head" colspan=3> включени документи
					<tr>
<td class="head" align=center> #
<td class="head"> адресат
<td class="head"> адрес
<td class="head"> изх.
<td class="head"> адресат
<td class="head"> адрес
<?php $_from = $this->_tpl_vars['ARENVE']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idenve'] => $this->_tpl_vars['elenve']):
?>
	<?php $this->assign('encoun', $this->_tpl_vars['ARCOUN'][$this->_tpl_vars['idenve']]); ?>
				<?php $this->assign('isfirst', true); ?>
	<?php $_from = $this->_tpl_vars['elenve']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idpost'] => $this->_tpl_vars['elem']):
?>
					<tr>
				<?php if ($this->_tpl_vars['isfirst']): ?>
<td rowspan=<?php echo $this->_tpl_vars['encoun']; ?>
 align=center <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['ARLINK'][$this->_tpl_vars['idenve']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> class="enve" 
onmouseover="$(this).addClass('link');" onmouseout="$(this).removeClass('link');"
> &nbsp;&nbsp;#<?php echo $this->_tpl_vars['idenve']; ?>
&nbsp;&nbsp;
<td rowspan=<?php echo $this->_tpl_vars['encoun']; ?>
> <?php echo $this->_tpl_vars['elem']['enveasat']; ?>

<td rowspan=<?php echo $this->_tpl_vars['encoun']; ?>
> <?php echo $this->_tpl_vars['elem']['enveaddr']; ?>

				<?php else: ?>
				<?php endif; ?>
		<?php if ($this->_tpl_vars['idpost'] == 0): ?>
<td class="mark" colspan=3> няма включени документи
		<?php else: ?>
<td> <?php echo $this->_tpl_vars['elem']['d2seri']; ?>
/<?php echo $this->_tpl_vars['elem']['d2year']; ?>

<td> <?php echo $this->_tpl_vars['elem']['postasat']; ?>

<td> <?php echo $this->_tpl_vars['elem']['postaddr']; ?>

		<?php endif; ?>
				<?php $this->assign('isfirst', false); ?>
	<?php endforeach; endif; unset($_from); ?>
<?php endforeach; endif; unset($_from); ?>
					<tr>
					</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>