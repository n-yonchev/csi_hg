<?php /* Smarty version 2.6.9, created on 2020-02-27 13:27:53
         compiled from tran.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'counter', 'tran.tpl', 24, false),array('modifier', 'tointe', 'tran.tpl', 44, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
.over {cursor:pointer;background-color:aqua;}
.curr {cursor:pointer;background-color:wheat;padding:4px;border: 1px solid silver;}
.vari {cursor:pointer;padding:4px;border: 1px solid silver;}
.coun {font:normal 14pt verdana;padding-right:8px;}
.curr2 {cursor:pointer;font:normal 8pt verdana;padding:1px 4px;border-bottom: 1px solid brown;color:brown;background-color:wheat;}
.vari2 {cursor:pointer;font:normal 8pt verdana;padding:1px 4px;border-bottom: 1px solid brown;color:brown;}
.prob2 {cursor:pointer;font:bold 8pt verdana;padding:1px 4px;border-bottom: 1px solid brown;color:white;background-color:red;}
</style>
<style>
.mini {font:normal 7pt verdana;}
.toin {font:normal 7pt verdana;cursor:pointer;padding:0px 8px 0px 8px;color:black;background-color:lightgreen;}
</style>
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />

				<?php if (isset ( $this->_tpl_vars['NAMELOCKED'] )): ?>
<span class="no"><?php echo $this->_tpl_vars['NAMELOCKED']; ?>
</span>
				<?php else: ?>
				<?php endif; ?>
												<?php if (isset ( $this->_tpl_vars['ARVARI'] )): ?>
			<form name="formcaye" method=post 
			style="margin:0px 0px 0px 6px;padding:0px;width:auto;font: normal 8pt verdana;white-space:nowrap;">
							<?php echo smarty_function_counter(array('start' => 0,'assign' => 'coun'), $this);?>

<?php $_from = $this->_tpl_vars['ARVARI']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
						<?php if ($this->_tpl_vars['ekey'] <= $this->_tpl_vars['ELECLIMI']): ?>
							<?php echo smarty_function_counter(array('assign' => 'coun'), $this);?>

						<?php else: ?>
						<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
			<table align=center>
			<tr>
						<td align=center bgcolor=#dddddd colspan=<?php echo $this->_tpl_vars['coun']; ?>
> електронни
<td width=20>&nbsp;
						<td align=center bgcolor=#dddddd colspan=2> ръчни
			<tr>
			<?php $_from = $this->_tpl_vars['ARVARI']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
										<?php if ($this->_tpl_vars['ekey'] <= $this->_tpl_vars['DIRELIMI']): ?>
<td class="<?php if ($this->_tpl_vars['ekey'] == $this->_tpl_vars['VARI']): ?>curr<?php else: ?>vari<?php endif; ?>" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['ARVARILINK'][$this->_tpl_vars['ekey']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
								<?php $this->assign('myco', $this->_tpl_vars['ARVARICOUN'][$this->_tpl_vars['ekey']]); ?>
								<?php if ($this->_tpl_vars['myco'] == 0): ?>
									<?php $this->assign('mycotx', "няма"); ?>
								<?php else: ?>
									<?php $this->assign('mycotx', ((is_array($_tmp=$this->_tpl_vars['myco'])) ? $this->_run_mod_handler('tointe', true, $_tmp) : smarty_modifier_tointe($_tmp))); ?>
								<?php endif; ?>
<div style="float:left" class="coun"><?php echo $this->_tpl_vars['mycotx']; ?>
</div>
<div style="float:right"><?php echo $this->_tpl_vars['elem']; ?>
</div>
						<?php if ($this->_tpl_vars['ekey'] == $this->_tpl_vars['ELECLIMI']): ?>
<td width=30>&nbsp;
						<?php else: ?>
						<?php endif; ?>
										<?php else: ?>
										<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
<td>
<div class="<?php if ($this->_tpl_vars['VARI'] == 11): ?>curr2<?php else: ?>vari2<?php endif; ?>" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['ARVARILINK'][11])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>><?php echo $this->_tpl_vars['ARVARI'][11]; ?>
 [<?php echo $this->_tpl_vars['ARVARICOUN'][11]; ?>
]</div> 
<div class="<?php if ($this->_tpl_vars['VARI'] == 12): ?>curr2<?php else: ?>vari2<?php endif; ?>" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['ARVARILINK'][12])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>><?php echo $this->_tpl_vars['ARVARI'][12]; ?>
 [<?php echo $this->_tpl_vars['ARVARICOUN'][12]; ?>
]</div> 

<td width=30>&nbsp;
<td>
преводи по дело/год &nbsp;
<br>
<input type="text" name="caseyear" id="caseyear" size=12 autocomplete=off
style="font:bold 7pt verdana; background-color:#dddddd; border: 0px solid green;" onkeyup="autocaseyear(event);">
+enter
			</table>
			</form>
												<?php else: ?>
												<?php endif; ?>

<?php echo $this->_tpl_vars['CONTVARI']; ?>