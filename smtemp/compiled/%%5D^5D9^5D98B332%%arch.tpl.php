<?php /* Smarty version 2.6.9, created on 2020-03-09 09:18:30
         compiled from arch.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'arch.tpl', 6, false),array('modifier', 'date_format', 'arch.tpl', 146, false),array('modifier', 'nl2br', 'arch.tpl', 159, false),array('modifier', 'replace', 'arch.tpl', 163, false),)), $this); ?>
<style>
.link {font: normal 7pt verdana; color:black; cursor:pointer; border-bottom: 1px solid black}
.text {font: normal 7pt verdana; color:black;}
</style>
						<?php if ($this->_tpl_vars['FLPRIN']): ?>
							<?php $this->assign('txpage', ((is_array($_tmp="стр.")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['PAGENO']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['PAGENO']))); ?>
						<?php else: ?>
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
						<?php endif; ?>

					<?php $this->assign('abou', ((is_array($_tmp=$this->_tpl_vars['YEAR'])) ? $this->_run_mod_handler('cat', true, $_tmp, " год.") : smarty_modifier_cat($_tmp, " год."))); ?>
			<table align=center class="d_table" cellspacing='0' cellpadding='0'>
		<thead>
		<tr>
<td class='d_table_title' colspan='30'> 
							<?php if ($this->_tpl_vars['LOGGEDISADMIN']): ?>
Aрхивна книга за <?php echo $this->_tpl_vars['abou']; ?>
 <?php echo $this->_tpl_vars['txpage']; ?>

							<?php else: ?>
списък на архивираните дела за <?php echo $this->_tpl_vars['abou']; ?>
 <?php echo $this->_tpl_vars['txpage']; ?>

							<?php endif; ?>
						<?php if ($this->_tpl_vars['FLPRIN']): ?>
						<?php else: ?>
<div style="float:right">
&nbsp;&nbsp;&nbsp;
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('ONCLICK' => "fuprin('".($this->_tpl_vars['CURINT'])."');",'TITLE' => "<img src='css/blue/button/printer.gif' alt='' /> Принтирай")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<div style="float:right">
&nbsp;&nbsp;&nbsp;
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => ($this->_tpl_vars['ADDNEW']),'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => 'добави')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
							<?php if ($this->_tpl_vars['LOGGEDISADMIN']): ?>
							<?php else: ?>
<br>
			<?php if ($this->_tpl_vars['ONLYUSER'] == 1): ?>
<span class="text">на деловодител <?php echo $this->_tpl_vars['USERNAME']; ?>
</span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a class="link" href="<?php echo $this->_tpl_vars['LINKALL']; ?>
"> на целия архив </a>
			<?php else: ?>
<span class="text">целия архив</span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a class="link" href="<?php echo $this->_tpl_vars['LINKONLY']; ?>
"> само на деловодител <?php echo $this->_tpl_vars['USERNAME']; ?>
 </a>
			<?php endif; ?>
							<?php endif; ?>

		</tr>
						<?php endif; ?>
		</thead>
		<tr class='header'>
<td> арх.№ </td>
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
<td> дата архивир </td>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> връзка </td>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> протокол </td>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> запаз.документи </td>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> том </td>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> забележка </td>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> деловодител </td>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td>&nbsp;</td>
		</tr>
		<tbody>

		<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
								<?php if ($this->_tpl_vars['elem']['serial'] == -1): ?>
									<?php if ($this->_tpl_vars['ONLYUSER'] == 0): ?>
			<tr>
											<?php if ($this->_tpl_vars['elem']['arch2'] == $this->_tpl_vars['elem']['arch1']): ?>
<td colspan=9 bgcolor=salmon> ЛИПСВА АРХИВЕН НОМЕР <b><?php echo $this->_tpl_vars['elem']['arch2']; ?>
</b>
											<?php else: ?>
<td colspan=9 bgcolor=salmon> липсват <b><?php echo $this->_tpl_vars['elem']['archcoun']; ?>
</b> бр. архивни номера <b><?php echo $this->_tpl_vars['elem']['arch2']; ?>
 - <?php echo $this->_tpl_vars['elem']['arch1']; ?>
</b>
											<?php endif; ?>
									<?php else: ?>
									<?php endif; ?>
								<?php else: ?>
			<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
<td align=right> <?php echo $this->_tpl_vars['elem']['serial']; ?>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['elem']['caseseri'])) ? $this->_run_mod_handler('cat', true, $_tmp, "/") : smarty_modifier_cat($_tmp, "/")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['elem']['caseyear']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['elem']['caseyear'])); ?>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> <?php echo $this->_tpl_vars['elem']['packet']; ?>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
								<?php $this->assign('protda', ((is_array($_tmp=$this->_tpl_vars['elem']['protdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y"))); ?>
<td> <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['elem']['protocol'])) ? $this->_run_mod_handler('cat', true, $_tmp, "/") : smarty_modifier_cat($_tmp, "/")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['protda']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['protda'])); ?>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['doculist'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> <?php echo $this->_tpl_vars['elem']['volume']; ?>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['notes'])) ? $this->_run_mod_handler('replace', true, $_tmp, ";", "; ") : smarty_modifier_replace($_tmp, ";", "; ")); ?>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> <?php echo $this->_tpl_vars['elem']['t2username']; ?>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td>
			<?php if ($this->_tpl_vars['elem']['t2userid'] == $this->_tpl_vars['LOGGEDID'] || $this->_tpl_vars['LOGGEDISADMIN']): ?>
<a href="<?php echo $this->_tpl_vars['elem']['edit']; ?>
" class="nyroModal" target="_blank" onclick="event.cancelBubble=true;">
<img src="images/archive.gif" class="arch" title="корегирай"></a>
			<?php else: ?>
			<?php endif; ?>
								<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>

		</tbody>
						<?php if ($this->_tpl_vars['FLPRIN']): ?>
						<?php else: ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php endif; ?>
			</table>