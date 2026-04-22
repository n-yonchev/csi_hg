<?php /* Smarty version 2.6.9, created on 2020-02-27 16:42:58
         compiled from oure.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'oure.tpl', 6, false),array('modifier', 'date_format', 'oure.tpl', 31, false),array('modifier', 'replace', 'oure.tpl', 188, false),)), $this); ?>
<style>
.he7 {font: normal 7pt verdana !important; background-color:silver !important; padding-left:4px;}
.ro7 {font: normal 7pt verdana !important; border-bottom: 1px solid black !important;}
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

				<?php if (isset ( $this->_tpl_vars['DATE']['date'] ) && $this->_tpl_vars['FLPRIN']): ?>
					<?php $this->assign('abou', ((is_array($_tmp=$this->_tpl_vars['DATE']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y"))); ?>
				<?php else: ?>
					<?php $this->assign('abou', ((is_array($_tmp=$this->_tpl_vars['YEAR'])) ? $this->_run_mod_handler('cat', true, $_tmp, " год.") : smarty_modifier_cat($_tmp, " год."))); ?>
				<?php endif; ?>
			<table align=center class="d_table" cellspacing='0' cellpadding='0'>
		<thead>
		<tr>
<td class='d_table_title' colspan='30'> 
Изходящ регистър за <?php echo $this->_tpl_vars['abou']; ?>
 <?php echo $this->_tpl_vars['txpage']; ?>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => ($this->_tpl_vars['ADDNEW']),'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => 'добави')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<tr>
				<td class='d_table_button' colspan='20'>
						<?php if ($this->_tpl_vars['FLPRIN']): ?>
						<?php else: ?>
	<?php if (! empty ( $this->_tpl_vars['DATE']['date'] )): ?>
		<?php if (empty ( $this->_tpl_vars['DATE']['date2'] )): ?>
за дата <b><?php echo $this->_tpl_vars['DATE']['date']; ?>
</b>
&nbsp;
		<?php else: ?>
за периода от <b><?php echo $this->_tpl_vars['DATE']['date']; ?>
</b> до <b><?php echo $this->_tpl_vars['DATE']['date2']; ?>
</b>
&nbsp;
		<?php endif; ?>
	<?php else: ?>
	<?php endif; ?>
	<?php if (empty ( $this->_tpl_vars['DATE']['adre'] )): ?>
	<?php else: ?>
адресат=<b><?php echo $this->_tpl_vars['DATE']['adre']; ?>
</b>
&nbsp;
	<?php endif; ?>
	<?php if (empty ( $this->_tpl_vars['DATE']['bele'] )): ?>
	<?php else: ?>
бележки=<b><?php echo $this->_tpl_vars['DATE']['bele']; ?>
</b>
&nbsp;
	<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => $this->_tpl_vars['DATE']['linkget'],'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => "филтър")));
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
<span id="buttoure">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('ONCLICK' => "fuprinoure('".($this->_tpl_vars['CURINT'])."');",'TITLE' => "<img src='css/blue/button/printer.gif' alt='' /> Принтирай")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</span>
<iframe id="framoure" width=100 height=50 frameborder=0 style="display:none">
</iframe>
</td>
						<?php endif; ?>
		</tr>
		</thead>
		<tr class='header'>
<td> дата </td>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> изх.номер </td>
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
<td> адресат </td>
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
<td> бележки </td>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td>&nbsp</td>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td>образ
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td>връчване
		</tr>
		<tbody>

		<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
			<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
			<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['registered'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<td> 
<nobr>
<?php echo $this->_tpl_vars['elem']['serial']; ?>

<?php if ($this->_tpl_vars['elem']['iduserregi'] == 0): ?>
<?php else: ?>
	<img style="cursor:help" src="images/info.gif" title="изходен от <?php echo $this->_tpl_vars['elem']['userregi']; ?>
 на <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['registered'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
">
<?php endif; ?>
</nobr>
													<?php if ($this->_tpl_vars['elem']['idcase'] == 0): ?>
								<?php $this->assign('tdtext', ""); ?>
								<?php $this->assign('tddire', 'left'); ?>
							<?php else: ?>
								<?php $this->assign('tdtext', ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['elem']['caseseri'])) ? $this->_run_mod_handler('cat', true, $_tmp, "/") : smarty_modifier_cat($_tmp, "/")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['elem']['caseyear']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['elem']['caseyear']))); ?>
								<?php $this->assign('tddire', 'right'); ?>
							<?php endif; ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<td align="<?php echo $this->_tpl_vars['tddire']; ?>
"> <?php echo $this->_tpl_vars['tdtext']; ?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<td> <?php echo $this->_tpl_vars['elem']['adresat']; ?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php if (empty ( $this->_tpl_vars['elem']['descrip'] )): ?>
<td> <?php echo $this->_tpl_vars['elem']['descriptype']; ?>

					<?php else: ?>
<td> <?php echo $this->_tpl_vars['elem']['descrip']; ?>

					<?php endif; ?>
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
<td align=center>
<a href="<?php echo $this->_tpl_vars['elem']['edit']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td align=left>
					<?php $this->assign('iddocu', $this->_tpl_vars['elem']['id']); ?>
					<?php $this->assign('scancoun', $this->_tpl_vars['ARSCANCOUN'][$this->_tpl_vars['iddocu']]); ?>
		<?php if ($this->_tpl_vars['scancoun'] == 0): ?>
&nbsp;
		<?php else: ?>
<img src="images/tranclos.gif" style="cursor:pointer" title="виж изображение" onclick="w2=window.open('<?php echo $this->_tpl_vars['elem']['scanview']; ?>
','win2');w2.focus();">
			<?php if ($this->_tpl_vars['scancoun'] == 1): ?>
			<?php else: ?>
<sup><?php echo $this->_tpl_vars['ARSCANCOUN'][$this->_tpl_vars['iddocu']]; ?>
</sup>
			<?php endif; ?>
		<?php endif; ?>
		
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "deliinfo.ajax.tpl", 'smarty_include_vars' => array('iddocu' => $this->_tpl_vars['iddocu'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endforeach; endif; unset($_from); ?>
		</tbody>
						<?php if ($this->_tpl_vars['FLPRIN']): ?>
						<?php else: ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "deliinfobase.ajax.tpl", 'smarty_include_vars' => array('ISTTIP' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script>
$(document).ready(function() {
	$("[@rela='ttip']").cluetip({ width: 560, cursor:'help' });
});
function fuprinoure(p1){
		prinbegi();
	document.getElementById("framoure").focus();
	document.getElementById("framoure").src= p1;
}
function prinbegi(){
		document.getElementById("buttoure").style.display= "none";
		document.getElementById("framoure").style.display= "";
}
function prinfini(){
		document.getElementById("buttoure").style.display= "";
		document.getElementById("framoure").style.display= "none";
}
</script>
						<?php endif; ?>
			</table>