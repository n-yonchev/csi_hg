<?php /* Smarty version 2.6.9, created on 2020-02-28 11:14:13
         compiled from delihead.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
body {font: normal 8pt verdana; padding: 1px 8px 1px 8px;}
.h1 {font: normal 8pt verdana; background-color:tan; padding:2px; 4px; 2px; 4px;padding:6px;}
.link {font: normal 8pt verdana; cursor: pointer; background-color:aquamarine; padding:2px 6px 2px 6px; margin:2px; 2px; 2px; 2px;float:left;}
.curr {background-color:khaki;}
.fon7 {font: normal 7pt verdana !important;}
.doinpu {font:normal 7pt verdana !important; color:black !important;}
.butt {padding:8px 10px 8px 10px;}
.sort {font:normal 7pt verdana !important; color:black !important;border-bottom: 1px solid black;cursor:pointer;}
.sortcurr {background-color:khaki !important;padding-left:6px;padding-right:6px; }
.case {background-color:khaki !important;cursor:pointer;}
.stat0 {background-color:lightgreen;}
.stat1 {background-color:#ff9999;}
.toli {cursor:pointer;}
.tohe {cursor:help;}
.link3 {font: normal 8pt verdana; cursor: pointer; border-bottom:1px solid black; padding:2px 6px 2px 6px;}
.curr3 {background-color:khaki;cursor:pointer;}
</style>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "deliinfobase.ajax.tpl", 'smarty_include_vars' => array('ISTTIP' => false)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					<table align=center>
					<tr>
<?php $_from = $this->_tpl_vars['ARMETH']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['inmeth'] => $this->_tpl_vars['txmeth']):
?>
<td align=center> <?php echo $this->_tpl_vars['txmeth']; ?>

					<td width=10>
<?php endforeach; endif; unset($_from); ?>
					<tr>
<?php $_from = $this->_tpl_vars['ARMETH']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['inmeth'] => $this->_tpl_vars['txmeth']):
?>
<td class="h1" align=center>
	<?php $_from = $this->_tpl_vars['ARVARILINK'][$this->_tpl_vars['inmeth']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['codevari'] => $this->_tpl_vars['culink']):
?>
			<?php if ($this->_tpl_vars['codevari'] == 'filt_11'): ?>
<div class="link ctip<?php if ($this->_tpl_vars['codevari'] == $this->_tpl_vars['VARI']): ?> curr<?php else:  endif; ?>" 
onclick="$.nyroModalManual({forceType:'iframe',url:'<?php echo $this->_tpl_vars['culink']; ?>
'});"
rel="#filtcont" title="съдържание на филтъра">
			<?php else: ?>
<div class="link<?php if ($this->_tpl_vars['codevari'] == $this->_tpl_vars['VARI']): ?> curr<?php else:  endif; ?>" 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['culink'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
			<?php endif; ?>
<?php echo $this->_tpl_vars['ARVARI'][$this->_tpl_vars['codevari']]; ?>

<?php if ($this->_tpl_vars['ARCOUN'][$this->_tpl_vars['codevari']] == 0):  else: ?>&nbsp;[<?php echo $this->_tpl_vars['ARCOUN'][$this->_tpl_vars['codevari']]; ?>
]<?php endif; ?>
</div>
	<?php endforeach; endif; unset($_from); ?>
					<td width=10>
<?php endforeach; endif; unset($_from); ?>

<span id="filtcont" style="display: none">
				<?php if (empty ( $this->_tpl_vars['ARVIEWFILT'] )): ?>
няма въведен филтър
				<?php else: ?>
	<table>
<?php $_from = $this->_tpl_vars['ARVIEWFILT']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fina'] => $this->_tpl_vars['fico']):
?>
	<tr>
<td> <?php echo $this->_tpl_vars['ARELEM'][$this->_tpl_vars['fina']]['text']; ?>

<td> <b><?php echo $this->_tpl_vars['fico']; ?>
</b>
<?php endforeach; endif; unset($_from); ?>
	</table>
<hr>
<font color=blue>клик за корекция</font>
				<?php endif; ?>
</span>
					</table>
