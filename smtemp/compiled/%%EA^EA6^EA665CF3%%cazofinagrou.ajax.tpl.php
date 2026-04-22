<?php /* Smarty version 2.6.9, created on 2020-11-16 14:04:48
         compiled from cazofinagrou.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomo3', 'cazofinagrou.ajax.tpl', 80, false),array('modifier', 'date_format', 'cazofinagrou.ajax.tpl', 82, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.header.tpl", 'smarty_include_vars' => array('TITLE' => "групово разпределяне на постъпления")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<input type="hidden" name="mode" id="mode" value="amount">

<style>
tr.head td {
	font: normal 8pt verdana;
	background-color: moccasin;
	padding: 1px 4px 1px 4px;
	align: center;
	}
tr.cell td {
	font: normal 8pt verdana;
	background-color: #ffffff;
	padding: 1px 4px 1px 4px;
	align: left;
	}
tr.cell td.perc {
	font: normal 8pt verdana;
	background-color: #bbbbbb;
	padding: 1px 4px 1px 4px;
	align: left;
	}
.yesmin {
	font:bold 7pt verdana;
	background-color: lightgreen;
	color: white;
	padding:1px 6px 3px 6px;
	cursor: help;
	}
.nomin {
	font:bold 7pt verdana;
	background-color: lightcoral;
	color: white;
	padding:1px 6px 3px 6px;
	cursor: help;
	}
.nochecked {
	font:bold 7pt verdana;
	background-color: orange;
	color: white;
	padding:1px 6px 3px 6px;
	cursor: help;
	}
input {
	font:bold 7pt verdana;
	background-color: #bbbbbb;
	border: 0px solid black;
	}
.acti {
	font: normal 8pt verdana; 
	border-bottom: 1px solid black;
	cursor: pointer
	}
</style>

									<?php if (count ( $this->_tpl_vars['LIST'] ) == 0): ?>
няма постъпления за разпределяне
									<?php else: ?>

избери постъпления за разпределяне
						<table class="">
						<tr class="head">
<td> тип
<td> постъп<br>сума
<td> разпре<br>делени
<td> дата<br>погас
<td> статус
<td> пога<br>сени
<td> ненасо<br>чени
<td> за груп.<br>разпред
<td>
		<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
			<?php $this->assign('myid', $this->_tpl_vars['elem']['id']); ?>
						<tr class="cell">
<td> <?php echo $this->_tpl_vars['ARTYPE'][$this->_tpl_vars['elem']['idtype']]; ?>

<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['inco'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['norest'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['datebala'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

<td align=center nowrap>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazofinagroustat.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['payd'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['pend'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['acti'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

<td>
			<?php if ($this->_tpl_vars['elem']['cb']): ?>
<input type=checkbox name="listdist[]" value="<?php echo $this->_tpl_vars['myid']; ?>
" onclick="cbupda();">
			<?php else: ?>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
						<tr class="head">
<td> общо
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['SUMA']['tota'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

<td> 
<td> 
<td> 
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['SUMA']['payd'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['SUMA']['pend'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['SUMA']['dist'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

<td>
						</table>

<br>
<a class="acti" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['LINKAUTO'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
разпредели всички автоматично </a>
<br>
групово разпределяне на избраните постъпления
						<table class="">
						<tr class="head">
<td> тип
<td> постъп<br>сума
		<?php $_from = $this->_tpl_vars['CLAILIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ckey'] => $this->_tpl_vars['clai']):
?>
<td align=right> <?php echo $this->_tpl_vars['clai']; ?>

		<?php endforeach; endif; unset($_from); ?>
		<?php $_from = $this->_tpl_vars['ARDIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
						<tr class="cell">
			<?php $this->assign('myid', $this->_tpl_vars['elem']['id']); ?>
<td> <?php echo $this->_tpl_vars['ARTYPE'][$this->_tpl_vars['elem']['idtype']]; ?>

<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['inco'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

				<?php $_from = $this->_tpl_vars['CLAILIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ckey'] => $this->_tpl_vars['clai']):
?>
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['DISTDATA'][$this->_tpl_vars['ekey']][$this->_tpl_vars['ckey']])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

				<?php endforeach; endif; unset($_from); ?>
		<?php endforeach; endif; unset($_from); ?>
						<tr class="head">
<td> общо
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['SUMA']['dist'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

		<?php $_from = $this->_tpl_vars['CLAILIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ckey'] => $this->_tpl_vars['clai']):
?>
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['DISTSUMA'][$this->_tpl_vars['ckey']])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

		<?php endforeach; endif; unset($_from); ?>
						<tr class="cell">
<td> избери за корекция
<td>
		<?php $_from = $this->_tpl_vars['CLAILIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ckey'] => $this->_tpl_vars['clai']):
?>
<td align=right> 
<input type=checkbox name="cb<?php echo $this->_tpl_vars['ckey']; ?>
" id="cb<?php echo $this->_tpl_vars['ckey']; ?>
" rela="mycb" onclick="oncb(<?php echo $this->_tpl_vars['ckey']; ?>
);">
		<?php endforeach; endif; unset($_from); ?>
						<tr class="cell">
<td> корегирай +enter
<td>
		<?php $_from = $this->_tpl_vars['CLAILIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ckey'] => $this->_tpl_vars['clai']):
?>
<td align=right> 
<input type=text name="am<?php echo $this->_tpl_vars['ckey']; ?>
" id="am<?php echo $this->_tpl_vars['ckey']; ?>
" size=12 style="display:none;" autocomplete=off>
		<?php endforeach; endif; unset($_from); ?>
						</table>
<span class="acti" onclick="subm();">
изчисли след корекциите </span>
<br>
						
<br>
рекапитулация
						<table class="">
						<tr class="head">
<td> 
<td> общо
		<?php $_from = $this->_tpl_vars['CLAILIST2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ckey'] => $this->_tpl_vars['clai']):
?>
<td align=right> <?php echo $this->_tpl_vars['clai']; ?>

		<?php endforeach; endif; unset($_from); ?>
						<tr class="cell">
<td> дължими
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazofigrtota.tpl", 'smarty_include_vars' => array('DATA' => $this->_tpl_vars['DATA'],'VARI' => 'plus')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<tr class="head">
<td colspan=20> преди груповото разпределяне
						<tr class="cell">
<td> погасени
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazofigrtota.tpl", 'smarty_include_vars' => array('DATA' => $this->_tpl_vars['DATA'],'VARI' => 'minu')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<tr class="cell">
<td nowrap> актуален дълг
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazofigrtota.tpl", 'smarty_include_vars' => array('DATA' => $this->_tpl_vars['DATA'],'VARI' => 'resu')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<tr class="cell">
<td> % погасяване
<td align=right>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazofigrperc.tpl", 'smarty_include_vars' => array('PERC' => $this->_tpl_vars['DATA']['percsuma'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $_from = $this->_tpl_vars['CLAILIST2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ckey'] => $this->_tpl_vars['clai']):
?>
<td align=right class="perc"> 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazofigrperc.tpl", 'smarty_include_vars' => array('PERC' => $this->_tpl_vars['DATA']['percpaid'][$this->_tpl_vars['ckey']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endforeach; endif; unset($_from); ?>
						<tr class="head">
<td colspan=20> след груповото разпределяне
						<tr class="cell">
<td nowrap> доп.погасени
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazofigr.tpl", 'smarty_include_vars' => array('DATA' => $this->_tpl_vars['RECADATA'],'VARI' => 'minuex')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<tr class="cell">
<td nowrap> общо погасени
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazofigr.tpl", 'smarty_include_vars' => array('DATA' => $this->_tpl_vars['RECADATA'],'VARI' => 'minu2')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<tr class="cell">
<td nowrap> актуален дълг
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazofigr.tpl", 'smarty_include_vars' => array('DATA' => $this->_tpl_vars['RECADATA'],'VARI' => 'resu2')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<tr class="cell">
<td> % погасяване
<td align=right>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazofigrperc.tpl", 'smarty_include_vars' => array('PERC' => $this->_tpl_vars['RECADATA']['percsuma'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $_from = $this->_tpl_vars['CLAILIST2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ckey'] => $this->_tpl_vars['clai']):
?>
<td align=right class="perc"> 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazofigrperc.tpl", 'smarty_include_vars' => array('PERC' => $this->_tpl_vars['RECADATA']['perc'][$this->_tpl_vars['ckey']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endforeach; endif; unset($_from); ?>
						</table>
<br>
<div>
<span class="acti" onclick="fosave();">
запиши състоянието </span>

<a onclik="javascript:void(0)" onclick="fuprint()" class="acti" style="float:right;" title="принтирай груповото разпределение" alt="принтирай груповото разпределение">
	принтирай състоянието <img src="images/print.gif" />
</a>
</div>
<br>

<script type="text/javascript">
var mes1= "може да изберете точно 2 полета за корекция";
var aminit= new Array();
		<?php $_from = $this->_tpl_vars['CLAILIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ckey'] => $this->_tpl_vars['clai']):
?>
//aminit[<?php echo $this->_tpl_vars['ckey']; ?>
]= "<?php echo ((is_array($_tmp=$this->_tpl_vars['DISTSUMA'][$this->_tpl_vars['ckey']])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
";
aminit[<?php echo $this->_tpl_vars['ckey']; ?>
]= "<?php echo $this->_tpl_vars['DISTSUMA'][$this->_tpl_vars['ckey']]; ?>
";
document.getElementById("cb<?php echo $this->_tpl_vars['ckey']; ?>
").checked= false;
		<?php endforeach; endif; unset($_from); ?>

<?php echo '
function fuprint() {
	$(\'#divscroll\').css({\'overflow\': \'none\'});
    window.print();
    $(\'#divscroll\').css({\'overflow\': \'auto\'});
	//window.frames["nyroModalIframe"].focus();
	//window.frames["nyroModalIframe"].print();
}
'; ?>

</script>
									<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>