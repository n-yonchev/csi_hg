<?php /* Smarty version 2.6.9, created on 2020-02-27 12:55:45
         compiled from cazo34view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'nl2br', 'cazo34view.tpl', 73, false),)), $this); ?>
<table id='aaa' class="d_table" width='' cellspacing='0' cellpadding='0' align=left>
	<thead>
		<tr>
		<td class='d_table_title' colspan='200'>
<div style="float:left">
<?php echo $this->_tpl_vars['LISTTEXT']; ?>

</div>
			<?php if ($this->_tpl_vars['FLAGNOCHANGE']): ?>
			<?php else: ?>
<div class='d_table_button' style="float:right">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => "caseeditzone.php".($this->_tpl_vars['ADDNEW']),'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => 'добави')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
			<?php endif; ?>
		</tr>
	</thead>
		<tr class='header'>
			<td><span> &nbsp;</span></td>
			<td class='sep'>&nbsp;</td>
			<td><span> код/егн</span></td>
			<td class='sep'>&nbsp;</td>	
			<td><span> име</span></td>
				<?php if ($this->_tpl_vars['FLAGNOCHANGE']): ?>
				<?php else: ?>
<td class='sep'>&nbsp;</td>
<td><span> &nbsp;</span></td>
				<?php endif; ?>
														<?php if ($this->_tpl_vars['ISDEBT']): ?>
			<td class='sep'>&nbsp;</td>	
			<td><span>&nbsp;</span></td>
							<?php else: ?>
							<?php endif; ?>
		</tr>
	<tbody>
		<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
		<tr  onmouseover='this.className="trhove";' onmouseout='this.className="";'>
				<?php $this->assign('txtype', ""); ?>
				<?php $this->assign('txcode', ""); ?>
			<?php if ($this->_tpl_vars['elem']['idtype'] == 1): ?>
				<?php $this->assign('txtype', "ю"); ?>
				<?php $this->assign('txcode', $this->_tpl_vars['elem']['bulstat']); ?>
			<?php elseif ($this->_tpl_vars['elem']['idtype'] == 2): ?>
				<?php $this->assign('txtype', "ф"); ?>
				<?php $this->assign('txcode', $this->_tpl_vars['elem']['egn']); ?>
			<?php else: ?>
				<?php $this->assign('txcode', $this->_tpl_vars['elem']['bulstat']); ?>
			<?php endif; ?>
			<td align="left"> <?php echo $this->_tpl_vars['txtype']; ?>
</td>
			<td class='sep'>&nbsp;</td>
			<td align="left"> <?php echo $this->_tpl_vars['txcode']; ?>
</td>
			<td class='sep'>&nbsp;</td>
			<td align="left"> 
<nobr>
			<?php echo $this->_tpl_vars['elem']['name']; ?>

<?php if (empty ( $this->_tpl_vars['elem']['notes'] )):  else: ?>
	<img src="images/view.png" class="comment" rel="#cont<?php echo $this->_tpl_vars['ekey'];  echo $this->_tpl_vars['TANAME']; ?>
" title='коментар' style="cursor:help">
<span id="cont<?php echo $this->_tpl_vars['ekey'];  echo $this->_tpl_vars['TANAME']; ?>
" style="display: none">
<?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['notes'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>

</span>
<?php endif; ?>
</nobr>
			</td>
				<?php if ($this->_tpl_vars['FLAGNOCHANGE']): ?>
				<?php else: ?>
			<td class='sep'>&nbsp;</td>
			<td align="left">
<nobr>
<a href="caseeditzone.php<?php echo $this->_tpl_vars['elem']['edit']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
<a href="caseeditzone.php<?php echo $this->_tpl_vars['elem']['delrec']; ?>
" class="nyroModal" target="_blank"><img src="images/free.gif" title="изтрий"></a>
						<?php if (isset ( $this->_tpl_vars['elem']['regi'] )): ?>
			<?php if ($this->_tpl_vars['elem']['isnoregi'] == 1): ?>
н
			<?php else: ?>
			<?php endif; ?>
						<?php else: ?>
			<?php if ($this->_tpl_vars['elem']['isjoin'] == 1): ?>
п
			<?php else: ?>
			<?php endif; ?>
						<?php endif; ?>
</nobr>
			</td>
				<?php endif; ?>
														<?php if ($this->_tpl_vars['ISDEBT']): ?>
			<td class='sep'>&nbsp;</td>	
			<td>
<a href="caseeditzone.php<?php echo $this->_tpl_vars['elem']['reg4']; ?>
" class='nyroModal' target='_blank' style="font:normal 6pt verdana">
<img src="images/admin.gif" title="съвпадение в ЦРД-2014"></a>
			</td>
							<?php else: ?>
							<?php endif; ?>
		</tr>			
		<?php endforeach; endif; unset($_from); ?>
	</tbody>
</table>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {
//	$('.comment').cluetip({ cluetipClass: 'jtip', width: 300, local:true, cursor:'help' });
	$('.comment').cluetip({ width: 300, local:true, cursor:'help' });
});
</script>