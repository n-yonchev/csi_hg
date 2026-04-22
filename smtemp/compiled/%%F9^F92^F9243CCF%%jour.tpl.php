<?php /* Smarty version 2.6.9, created on 2020-03-02 13:41:29
         compiled from jour.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'jour.tpl', 43, false),)), $this); ?>
<div class='tabs_line' >
	<table class='tabs' style='' cellspacing='0'  cellpadding='0' border='0' >
	<tr>
	<?php $_from = $this->_tpl_vars['YEARLIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
		<td class='tabs_sep'>&nbsp;</td> 
		<?php if ($this->_tpl_vars['YEAR'] == $this->_tpl_vars['ekey']): ?>
			<td class='tabs_left_selected'></td>
			<td class='tabs_middle_selected'><span><?php echo $this->_tpl_vars['ekey']; ?>
</span></td>
			<td class='tabs_right_selected'></td>
		<?php else: ?>	
			<td onclick='document.location.href="<?php echo $this->_tpl_vars['elem']; ?>
"' class='tabs_left'></td>
			<td onclick='document.location.href="<?php echo $this->_tpl_vars['elem']; ?>
"' class='tabs_middle'><span><?php echo $this->_tpl_vars['ekey']; ?>
</span></td>
			<td onclick='document.location.href="<?php echo $this->_tpl_vars['elem']; ?>
"' class='tabs_right'></td>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</tr>
	</table>
</div>

		<table align=center class="d_table" cellspacing='0' cellpadding='0'>
		<thead>
		<tr>
<td class='d_table_title' colspan='30'> Дневник на извършените действия за <?php echo $this->_tpl_vars['YEAR']; ?>
 год.
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => ($this->_tpl_vars['ADDNEW']),'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => 'добави')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</td>
		</tr>
			<tr>
			<td class='d_table_button' colspan='20'>
						<?php if ($this->_tpl_vars['FLPRIN']): ?>
						<?php else: ?>
	<?php if (isset ( $this->_tpl_vars['DATE']['date'] )): ?>
		<?php if (empty ( $this->_tpl_vars['DATE']['date2'] )): ?>
за дата <b><?php echo ((is_array($_tmp=$this->_tpl_vars['DATE']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</b>
&nbsp;
		<?php else: ?>
за периода от <b><?php echo ((is_array($_tmp=$this->_tpl_vars['DATE']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</b> до <b><?php echo ((is_array($_tmp=$this->_tpl_vars['DATE']['date2'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</b>
&nbsp;
		<?php endif; ?>
	<?php else: ?>
	<?php endif;  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => $this->_tpl_vars['DATE']['linkget'],'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => "период")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
&nbsp;
	<?php if (isset ( $this->_tpl_vars['DATE']['linkall'] )): ?>
<a href="<?php echo $this->_tpl_vars['DATE']['linkall']; ?>
">
<img src="images/all.gif" title='всички редове'>
</a>
&nbsp;
	<?php else: ?>
	<?php endif; ?>
&nbsp;
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('ONCLICK' => "fuprinjour('".($this->_tpl_vars['CURINT'])."');",'TITLE' => "<img src='css/blue/button/printer.gif' alt='' /> Принтирай")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php endif; ?>
		</td>
		</tr>
		</thead>
		<tr class='header'>
<td> дата </td>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> пор.№ </td>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> изп.дело </td>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> описание </td>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> задължено лице </td>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> тип </td>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> рег. </td>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td></td>
		</tr>
		<tbody>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_jour.tpl", 'smarty_include_vars' => array('PRIN' => false)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		</tbody>
	<?php if ($this->_tpl_vars['FLPRIN']): ?>
			</table>
	<?php else:  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</table>

<iframe id="fraint" width=200 height=100 style="display:none"></iframe>
<script>
function fuprinjour(p1){
//	var op= document.getElementById("fraint").src= p1;
	$("#fraint").show().focus().attr("src",p1);
}
</script>
	<?php endif; ?>