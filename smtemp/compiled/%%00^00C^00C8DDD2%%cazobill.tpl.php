<?php /* Smarty version 2.6.9, created on 2020-02-27 12:55:45
         compiled from cazobill.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'cazobill.tpl', 108, false),array('modifier', 'tomo3', 'cazobill.tpl', 110, false),array('modifier', 'tomoney2', 'cazobill.tpl', 177, false),)), $this); ?>
<script type="text/javascript">
	$($.fn.nyroModal.settings.openSelector).nyroModal();	
</script>
<style>
.diff {color:red;}
.p1 {font: normal 8pt verdana;}
.p1:hover {color:red;border-bottom: 1px solid red;}
</style>
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />

		<table class="d_table" cellspacing='0' cellpadding='0' <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazoplan.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
		<thead>
		<tr>
<td class='d_table_title' colspan='200' onclick="toggle(this,event);">
		<div style="float:left" oncontextmenu="$('#tbilllink').click();return false;">
фактури и сметки
&nbsp;&nbsp;&nbsp;&nbsp;
</div>
		</tr>
	
		</thead>
		<tr class='header'>
<td> фактура
		<td class='sep'>&nbsp;</td>
<td> &nbsp;
		<td class='sep'>&nbsp;</td>
<td> сметка </td>
		<td class='sep'>&nbsp;</td>
<td> &nbsp;
		<td class='sep'>&nbsp;</td>
<td> дата </td>
		<td class='sep'>&nbsp;</td>
<td align=right> сума </td>
		<td class='sep'>&nbsp;</td>
<td> втч ддс </td>
		<td class='sep'>&nbsp;</td>
<td> задълж.лице </td>
		<td class='sep'>&nbsp;</td>
<td> тип
		<td class='sep'>&nbsp;</td>
<td> проф
		<tbody>
	<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>		
								<?php $this->assign('mybill', $this->_tpl_vars['elem']['id']); ?>
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>	
<td align=right bgcolor=#dddddd> 
						<?php if ($this->_tpl_vars['elem']['seriinvo'] <= 0): ?>
- &nbsp;
						<?php else: ?>
<?php echo $this->_tpl_vars['elem']['seriinvo']; ?>

						<?php endif; ?>
		<td class='sep'>&nbsp;</td>
<td>
						<?php if ($this->_tpl_vars['elem']['seriinvo'] <= 0): ?>
&nbsp;
						<?php else: ?>
<a href="#" onclick="fuprin('<?php echo $this->_tpl_vars['elem']['prininvo']; ?>
'); return false;"> 
<img src="images/print.gif" title="отпечати фактурата">
</a> 
						<?php endif; ?>
		<td class='sep'>&nbsp;</td>
<td align=right bgcolor=#dddddd> 
						<?php if ($this->_tpl_vars['elem']['serial'] <= 0): ?>
- &nbsp;
						<?php else: ?>
<?php echo $this->_tpl_vars['elem']['serial']; ?>

						<?php endif; ?>
		<td class='sep'>&nbsp;</td>
<td> 
						<?php if ($this->_tpl_vars['elem']['serial'] <= 0): ?>
&nbsp;
						<?php else: ?>
<a href="#" onclick="fuprin('<?php echo $this->_tpl_vars['elem']['prinbill']; ?>
'); return false;"> 
<img src="images/print.gif" title="отпечати сметката">
</a> 
						<?php endif; ?>
		<td class='sep'>&nbsp;</td>
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</td>
		<td class='sep'>&nbsp;</td>
<td align=right bgcolor=#dddddd> <?php echo ((is_array($_tmp=$this->_tpl_vars['LISTSUMA'][$this->_tpl_vars['elem']['id']]['suma'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
</td>
		<td class='sep'>&nbsp;</td>
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['LISTSUMA'][$this->_tpl_vars['elem']['id']]['svat'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

		<td class='sep'>&nbsp;</td>			
<td> <?php echo $this->_tpl_vars['elem']['name']; ?>
</td>
		<td class='sep'>&nbsp;</td>
<td> <?php echo $this->_tpl_vars['ARINVOTYPE'][$this->_tpl_vars['elem']['idinvotype']]; ?>

		<td class='sep'>&nbsp;</td>
<td> <?php echo $this->_tpl_vars['elem']['seriprof']; ?>

	<?php endforeach; endif; unset($_from); ?>

		<tr class='header'>
<td colspan=9> общо
		<td class='sep'>&nbsp;</td>
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['ARTOTA'][1])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

		<td class='sep'>&nbsp;</td>
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['ARTOTA'][2])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

		<td class='sep'>&nbsp;</td>
<td colspan=9> &nbsp;
</tbody>
</table>

			<?php if (empty ( $this->_tpl_vars['ARRAZH'] )): ?>
			<?php else: ?>
		<table class="d_table" cellspacing='0' cellpadding='0'>
		<thead>
		<tr>
<td class='d_table_title' colspan='200'> РКО
		</thead>
		<tr class='header'>
<td align=right> сума
		<td class='sep'>&nbsp;</td>
<td> номер
		<td class='sep'>&nbsp;</td>
<td> дата
		<td class='sep'>&nbsp;</td>
<td> изплатена на
		<td class='sep'>&nbsp;</td>
<td> &nbsp;
		<tbody>
	<?php $_from = $this->_tpl_vars['ARRAZH']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
		<tr>
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['amount'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

		<td class='sep'>&nbsp;</td>
<td> <?php echo $this->_tpl_vars['elem']['cashserial']; ?>
/<?php echo $this->_tpl_vars['elem']['cashyear']; ?>

		<td class='sep'>&nbsp;</td>
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['cashdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

		<td class='sep'>&nbsp;</td>
<td> <?php echo $this->_tpl_vars['elem']['cashname']; ?>

		<td class='sep'>&nbsp;</td>
<td> 
<a href="#" onclick="fuprin('<?php echo $this->_tpl_vars['elem']['prinrazh']; ?>
'); return false;"> 
<img src="images/print.gif" title="отпечати РКО">
</a> 

	<?php endforeach; endif; unset($_from); ?>
		</tbody>
		</table>
			<?php endif; ?>