<?php /* Smarty version 2.6.9, created on 2020-02-27 12:55:45
         compiled from cazofinaendd.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'cazofinaendd.tpl', 12, false),array('modifier', 'tomoney2', 'cazofinaendd.tpl', 30, false),)), $this); ?>
													<?php $this->assign('isoldway', false); ?>

					<?php if ($this->_tpl_vars['elem']['idcase'] <> 0 && $this->_tpl_vars['elem']['rest'] == 0): ?>
												<?php if ($this->_tpl_vars['elem']['isclosed'] == 1): ?>
																					<?php if ($this->_tpl_vars['elem']['istran'] == 0): ?>
																<span class="yes" title="ПРИКЛЮЧЕНО на <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['timeclosed'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
"
								<?php if ($this->_tpl_vars['ADMINLOGGED']): ?>
oncontextmenu="proc4('<?php echo $this->_tpl_vars['elem']['id']; ?>
');return false;"
								<?php else: ?>
								<?php endif; ?>
>&nbsp;</span>
							<?php elseif ($this->_tpl_vars['elem']['istran'] == 2): ?>
								<img src="images/finish.gif" title="СТАРО ПРИКЛЮЧЕНО на <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['timeclosed'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
">
							<?php else: ?>
																<?php if ($this->_tpl_vars['ENDDLIST'][$this->_tpl_vars['myid']]['isendd'] == 1): ?>
<span class="stat2aaa stat2ok" rel="#tran<?php echo $this->_tpl_vars['myid']; ?>
" title="разпределенията от постъпление <b><?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['inco'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
</b> са ИЗЦЯЛО ПРЕВЕДЕНИ">&nbsp;ОК&nbsp;</span>
								<?php else: ?>
<span class="stat2aaa" rel="#tran<?php echo $this->_tpl_vars['myid']; ?>
" title="разпределенията от постъпление <b><?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['inco'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
</b> са в процес на превод">&nbsp;&nbsp;&nbsp;</span>
								<?php endif; ?>
<span id="tran<?php echo $this->_tpl_vars['myid']; ?>
" style="display: none">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazofinatran.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</span>
							<?php endif; ?>
						<?php else: ?>
														<?php if ($this->_tpl_vars['elem']['istran'] == 0): ?>
																								<?php if (( $this->_tpl_vars['elem']['idtype'] == 1 || $this->_tpl_vars['elem']['idtype'] == 2 || $this->_tpl_vars['elem']['idtype'] == 7 )): ?>
																		<?php $this->assign('cannew', true); ?>
								<?php else: ?>
																		<?php $this->assign('cannew', false); ?>
								<?php endif; ?>
																								<?php if ($this->_tpl_vars['cannew'] && $this->_tpl_vars['FLAGBANKMASS']): ?>
											<?php if ($this->_tpl_vars['INCASE']): ?>
			<?php $this->assign('pref', "caseeditzone.php"); ?>
		<?php else: ?>
			<?php $this->assign('pref', ""); ?>
		<?php endif; ?>
<a href="<?php echo $this->_tpl_vars['pref'];  echo $this->_tpl_vars['elem']['markclos']; ?>
" class="nyroModal" target="_blank"><img src="images/tran1.gif" title="приключване/превод"></a>
								<?php else: ?>
											<?php if ($this->_tpl_vars['INCASE']): ?>
			<?php $this->assign('pref', "caseeditzone.php"); ?>
		<?php else: ?>
			<?php $this->assign('pref', ""); ?>
		<?php endif; ?>
<a href="<?php echo $this->_tpl_vars['pref'];  echo $this->_tpl_vars['elem']['clos']; ?>
" class="nyroModal" target="_blank"><img src="images/clos.gif" title="приключи"></a>
													<?php $this->assign('isoldway', true); ?>
																	<?php endif; ?>
							<?php elseif ($this->_tpl_vars['elem']['istran'] == 2): ?>
<span class="stat1" title="ГОТОВО ЗА ПРЕВОД">&nbsp;&nbsp;&nbsp;</span>
							<?php else: ?>
								<font color=red> ???????? </font>
							<?php endif; ?>
						<?php endif; ?>
					<?php else: ?>
						<span class="no" title="приключването е невъзможно">&nbsp;</span>
					<?php endif; ?>


							<?php if ($this->_tpl_vars['INCASE']): ?>
	<td class='sep'>&nbsp;</td>
<td align=center>
								<?php if ($this->_tpl_vars['isoldway']): ?>
<input type=checkbox id="cbfina<?php echo $this->_tpl_vars['elem']['id']; ?>
" rela="cbfina" onclick="setgrimg();">
								<?php else: ?>
								<?php endif; ?>
							<?php else: ?>
							<?php endif; ?>