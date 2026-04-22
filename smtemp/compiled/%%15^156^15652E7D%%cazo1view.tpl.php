<?php /* Smarty version 2.6.9, created on 2026-03-10 15:40:02
         compiled from cazo1view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'cazo1view.tpl', 48, false),)), $this); ?>
<style>
.cont {background-color:#dddddd;}
</style>
<table class="d_table" cellspacing='0' cellpadding='0' <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazoplan.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<thead>
			<tr>
			<td class='d_table_title' colspan=10>
<div style="float:left">
основни данни
&nbsp;&nbsp;&nbsp;
<a href="#" onclick="$('#t1link').click();return false;" title="обнови"><img src="images/refresh.gif"></a>
</div>
			<?php if ($this->_tpl_vars['FLAGNOCHANGE']): ?>
			<?php else: ?>
<div style="float:right">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'reg4case.tpl', 'smarty_include_vars' => array('EDIT' => $this->_tpl_vars['EDIT'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => "caseeditzone.php".($this->_tpl_vars['URLMOD']),'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => 'корегирай')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
			<?php endif; ?>
</thead>
												<tr>
												<td>
											<table><tr>
											<td valign=top>
												<table>
			<tr>
			<td>
образувано на
			<td class="cont">
<?php echo ((is_array($_tmp=$this->_tpl_vars['DATA']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

			<tr>
			<td>
описание
			<td class="cont">
<?php echo $this->_tpl_vars['DATA']['text']; ?>

			<tr>
			<td>
идва от
			<td class="cont">
<?php echo $this->_tpl_vars['ARFROM'][$this->_tpl_vars['DATA']['idcofrom']]; ?>

	<?php if (empty ( $this->_tpl_vars['DATA']['cogrou'] )): ?>
	<?php else: ?>
/ състав <?php echo $this->_tpl_vars['DATA']['cogrou']; ?>

	<?php endif; ?>
			<tr>
			<td>
изп.титул
			<td class="cont">
						<?php $this->assign('arindx', $this->_tpl_vars['DATA']['idtitu']); ?>
<?php echo $this->_tpl_vars['ARTITU'][$this->_tpl_vars['arindx']]; ?>

						<?php if ($this->_tpl_vars['DATA']['idtitu'] == 1): ?>
от <?php echo $this->_tpl_vars['DATA']['dateexec']; ?>

						<?php else: ?>
						<?php endif; ?>
			<tr>
			<td>
вид, номер/год
			<td class="cont">
						<?php $this->assign('arindx', $this->_tpl_vars['DATA']['idsort']); ?>
<?php echo $this->_tpl_vars['ARSORT'][$this->_tpl_vars['arindx']]; ?>
, <?php echo $this->_tpl_vars['DATA']['conome']; ?>
/<?php echo $this->_tpl_vars['DATA']['coyear']; ?>

			<tr>
			<td>
текущ статус
			<td class="cont">
						<?php $this->assign('arindx', $this->_tpl_vars['DATA']['idstat']); ?>
<?php echo $this->_tpl_vars['ARSTAT'][$this->_tpl_vars['arindx']]; ?>
 
<nobr>
<?php echo ((is_array($_tmp=$this->_tpl_vars['DATA']['timestat'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y %H:%M:%S") : smarty_modifier_date_format($_tmp, "%d.%m.%Y %H:%M:%S")); ?>

</nobr>
			<tr>
			<td>
схема погасяване
			<td class="cont">
						<?php $this->assign('arindx', $this->_tpl_vars['DATA']['idpayoff']); ?>
<?php echo $this->_tpl_vars['ARPAYOFF'][$this->_tpl_vars['arindx']]; ?>

			<tr>
			<td>
ред за отчета
			<td class="cont">
						<?php $this->assign('arindx', $this->_tpl_vars['DATA']['idrepo']); ?>
<?php echo $this->_tpl_vars['ARREPO'][$this->_tpl_vars['arindx']]; ?>

			<tr>
			<td>
характер на изп.
			<td class="cont">
						<?php $this->assign('arindx', $this->_tpl_vars['DATA']['idchar']); ?>
<?php echo $this->_tpl_vars['ARCHAR'][$this->_tpl_vars['arindx']]; ?>

												</table>
											<td valign=top>
												<table>
			<tr>
			<td>
вземане вид размер
			<td class="cont">
<?php echo $this->_tpl_vars['DATA']['claimdescrip']; ?>

			<tr>
			<td>
вземане произход
			<td class="cont">
<?php echo $this->_tpl_vars['DATA']['origtext']; ?>

			<tr>
			<td>
надбавка ОЛП %
			<td class="cont">
<?php echo $this->_tpl_vars['DATA']['extraint']; ?>

			<tr>
			<td colspan=2>
<u>ЦРД-2014 вземане</u>
			<tr>
			<td>
тип
			<td class="cont">
<?php echo $this->_tpl_vars['AR4TYPE'][$this->_tpl_vars['DATA']['idtypereg4']]; ?>

			<tr>
			<td>
вид
			<td class="cont">
<?php echo $this->_tpl_vars['AR4VARI'][$this->_tpl_vars['DATA']['idvarireg4']]; ?>

			<tr>
			<td>
произход
			<td class="cont">
<?php echo $this->_tpl_vars['AR4ORIG'][$this->_tpl_vars['DATA']['idorigreg4']]; ?>


<?php if ($this->_tpl_vars['EPEP_PROCESS']): ?>
<tr>
	<td colspan="2" style="text-align: center; border: none; padding-top: 3px;">
		<table style="border: 2px solid black; width: 100%">
			<thead>
				<tr>
					<td style="font-weight: bold;">Файлове от ел. изпълнителен лист</td>
					<td onclick="files_show()" style="cursor: pointer;"><img src="images/down.gif" title="Покажи всички файлове"/></td>
				</tr>
			</thead>
			<tbody class="files-table-body" style="display: none;">
				<?php $_from = $this->_tpl_vars['EPEP_PROCESS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
					<tr>
						<td colspan="2">
							<a style="color: blue; text-decoration: underline;" target="_blank" href="<?php echo $this->_tpl_vars['item']['fileurl']; ?>
"><?php echo $this->_tpl_vars['item']['name']; ?>
</a>
						</td>
					</tr>
				<?php endforeach; endif; unset($_from); ?>
			</tbody>
		</table>
<?php endif; ?>
												</table>
											</table>
			</table>

<script type="text/javascript">
	$('a.nyroModal').nyroModal();
		var heob= document.getElementById("caseheader");
		if (heob){
$("#caseheader").load("caseheader.ajax.php?para=<?php echo $this->_tpl_vars['DATA']['id']+10597; ?>
");
		}else{
		}

	<?php echo '
		function files_show() {
			if($(\'.files-table-body\').is(":visible")) {
				$(\'.files-table-body\').hide();
			} else {
				$(\'.files-table-body\').show();
			}
		}
	'; ?>

</script>