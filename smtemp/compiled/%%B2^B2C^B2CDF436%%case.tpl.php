<?php /* Smarty version 2.6.9, created on 2020-02-27 15:08:06
         compiled from case.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'case.tpl', 14, false),array('modifier', 'date_format', 'case.tpl', 176, false),array('modifier', 'truncate', 'case.tpl', 231, false),)), $this); ?>
<style>
.user1 {background-color:wheat;}
.user2 {background-color:gold;color:red}
</style>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tabslist.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

							<?php if (isset ( $this->_tpl_vars['FLAGACTI'] )): ?>
					<?php if ($this->_tpl_vars['FLAGACTI']): ?>
			<?php $this->assign('textacti', 'активни'); ?>
					<?php else: ?>
			<?php $this->assign('textacti', 'прекратени'); ?>
					<?php endif; ?>
	<?php if ($this->_tpl_vars['FILT'] == 'all'):  $this->assign('_tmp', ((is_array($_tmp=((is_array($_tmp='списък на всички ')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['textacti']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['textacti'])))) ? $this->_run_mod_handler('cat', true, $_tmp, ' дела') : smarty_modifier_cat($_tmp, ' дела'))); ?>
	<?php else:  $this->assign('_tmp', ((is_array($_tmp=((is_array($_tmp='списък на ')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['textacti']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['textacti'])))) ? $this->_run_mod_handler('cat', true, $_tmp, 'те дела по филтър') : smarty_modifier_cat($_tmp, 'те дела по филтър'))); ?>
	<?php endif; ?>
							<?php else: ?>
	<?php if ($this->_tpl_vars['FILT'] == 'all'):  $this->assign('_tmp', 'списък на всички дела'); ?>
	<?php else:  $this->assign('_tmp', 'списък на всички дела по филтър'); ?>
	<?php endif; ?>
							<?php endif; ?>

<form name="myseleform" method=post style="margin:0px;padding:0px;width:auto;" enctype="multipart/form-data">
		<table class="d_table" width='' cellspacing='0' cellpadding='0' align=center>
			<thead>	
				<tr>
	<?php if ($this->_tpl_vars['VIEWUSERNAME']): ?>
				<td class='d_table_title' colspan='10'><?php echo $this->_tpl_vars['_tmp']; ?>

				</td>
<td colspan='12' align=right>
								<?php if ($this->_tpl_vars['FLAGBACK']): ?>
				<?php else: ?>
						<?php if ($this->_tpl_vars['NOPERMUSER']): ?>
						<?php else: ?>
деловодител за назначаване 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['USERLIST'],'ID' => 'ownerid','C1' => 'input7','C2' => 'inputer','ONCH' => "document.forms['myseleform'].submit();")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php endif; ?>
				<?php endif; ?>
</td>
</tr>
	<?php else: ?>
				<td class='d_table_title' colspan='22'><?php echo $this->_tpl_vars['_tmp']; ?>

				</td>
	<?php endif; ?>
				</tr>
				<tr>
				<td colspan='200'>
<table width=100%>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_filtvisu.tpl", 'smarty_include_vars' => array('GROUP' => 1,'TEXT' => "изпълнително дело")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_filtvisu.tpl", 'smarty_include_vars' => array('GROUP' => 2,'TEXT' => "съдебно дело")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_filtvisu.tpl", 'smarty_include_vars' => array('GROUP' => 3,'TEXT' => "взискател")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_filtvisu.tpl", 'smarty_include_vars' => array('GROUP' => 4,'TEXT' => "длъжник")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<td class='d_table_button' colspan='200'>
						<?php if (isset ( $this->_tpl_vars['FILTYES'] )): ?>
							<?php if ($this->_tpl_vars['FILT'] == 'all'): ?>
								<?php $this->assign('_tmp', 'въведи филтър'); ?>
							<?php else: ?>
								<?php $this->assign('_tmp', 'корегирай филтъра'); ?>
							<?php endif; ?>
							
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => $this->_tpl_vars['FILTYES'],'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => "<img src='images/view.png' title='".($this->_tpl_vars['_tmp'])."' /> ".($this->_tpl_vars['_tmp']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php else: ?>
						<?php endif; ?>
						
						<?php if (isset ( $this->_tpl_vars['FILTALL'] )):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('ONCLICK' => "document.location.href='".($this->_tpl_vars['FILTALL'])."';",'TITLE' => '<img src="images/all.gif" title="всички дела" /> всички дела')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php else: ?>
						<?php endif; ?>
</table>
					</td>
				</tr>
			</thead>
				<tr class='header'>
					<td><span> номер </span></td>
					<td class='sep'>&nbsp;</td>
					<td><span> описание</span></td>
					<td class='sep'>&nbsp;</td>
					<td><span> идва от</span></td>
					<td class='sep'>&nbsp;</td>
					<td><span> създадено</span></td>
					<td class='sep'>&nbsp;</td>
					<td><span> посл.промяна</span></td>
							<?php if ($this->_tpl_vars['VIEWUSERNAME']): ?>
					<td class='sep'>&nbsp;</td>
					<td><span> деловодител </span></td>
<td class='sep'>&nbsp;</td>
<td> вход.док. </td>
							<?php else: ?>
					<td class='sep'>&nbsp;</td>
					<td></td>
							<?php endif; ?>
					<td class='sep'>&nbsp;</td>
					<td></td>
					<td class='sep'>&nbsp;</td>
					<td></td>
<td class='sep'>&nbsp;</td>
<td colspan=2>статус</td>
								<?php if ($this->_tpl_vars['ISBASESTATUS'] && ! $this->_tpl_vars['VIEWUSERNAME']): ?>
<td class='sep'>&nbsp;
<td></td>
				<?php else: ?>
				<?php endif; ?>
																		<?php if ($this->_tpl_vars['FLAGARCHIVE']): ?>
<td class='sep'>&nbsp;</td>
<td>
</td>
									<?php else: ?>
									<?php endif; ?>
				</tr>
			<tbody>
			<?php $_from = $this->_tpl_vars['CASELIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
		<?php if ($this->_tpl_vars['elem']['flagstat'] == 1): ?>
			<?php $this->assign('bgco', "#ffddaa"); ?>
		<?php elseif ($this->_tpl_vars['elem']['flagstat'] == 2): ?>
			<?php $this->assign('bgco', "#ffaadd"); ?>
		<?php else: ?>
			<?php $this->assign('bgco', ""); ?>
		<?php endif; ?>
<tr onclick="document.location.href='<?php echo $this->_tpl_vars['elem']['edit']; ?>
';"
bgcolor="<?php echo $this->_tpl_vars['bgco']; ?>
"
onmouseover='this.style.backgroundColor="#dddddd";this.style.cursor="pointer";' 
onmouseout='this.style.backgroundColor="<?php echo $this->_tpl_vars['bgco']; ?>
";this.style.cursor="default";'
>
				<td> <?php echo $this->_tpl_vars['elem']['serial']; ?>
/<?php echo $this->_tpl_vars['elem']['year']; ?>
</td>
				<td class='sep'>&nbsp;</td>
				<td> <?php echo $this->_tpl_vars['elem']['text']; ?>

				<?php $this->assign('arindx', $this->_tpl_vars['elem']['idcofrom']); ?> </td>
				<td class='sep'>&nbsp;</td>
				<td> <?php echo $this->_tpl_vars['ARFROM'][$this->_tpl_vars['arindx']]; ?>
</td>
				<td class='sep'>&nbsp;</td>
				<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</td>
				<td class='sep'>&nbsp;</td>
				<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['lastdocu'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y %H:%M") : smarty_modifier_date_format($_tmp, "%d.%m.%Y %H:%M")); ?>
</td>
<?php $this->assign('myid', $this->_tpl_vars['elem']['id']); ?>
							<?php if ($this->_tpl_vars['VIEWUSERNAME']): ?>
			<td class='sep'>&nbsp;</td>
<td id="w<?php echo $this->_tpl_vars['elem']['id']; ?>
" class="user1" onmouseover="this.className='user2';" onmouseout="this.className='user1';"
						<?php if ($this->_tpl_vars['NOPERMUSER']): ?>
						<?php else: ?>
			title="назначи <?php if (empty ( $this->_tpl_vars['OWNAME'] )): ?>без деловодител<?php else:  echo $this->_tpl_vars['OWNAME'];  endif; ?>" 
			onclick="getowner(event,'w<?php echo $this->_tpl_vars['elem']['id']; ?>
',<?php echo $this->_tpl_vars['elem']['id']; ?>
);"
						<?php endif; ?>
			> <?php echo $this->_tpl_vars['elem']['username']; ?>
 </td>
<td class='sep'>&nbsp;</td>
<td bgcolor=#ddffdd> 
				<?php if (empty ( $this->_tpl_vars['elem']['listdocu'] )): ?>
<font color=red><b>
няма вход.докум.
</b></font>
				<?php else: ?>
<img src="images/view.png" class="ttip" rel="#cont<?php echo $this->_tpl_vars['myid']; ?>
" title="документите подробно">
&nbsp;
<?php $_from = $this->_tpl_vars['elem']['listdocu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['docukey'] => $this->_tpl_vars['eldocu']):
?>
		<?php if ($this->_tpl_vars['docukey'] <= 1): ?>
	<?php echo $this->_tpl_vars['eldocu']['serial']; ?>
/<?php echo $this->_tpl_vars['eldocu']['year']; ?>
 &nbsp;
		<?php else: ?>
	+
		<?php endif;  endforeach; endif; unset($_from); ?>
<span id="cont<?php echo $this->_tpl_vars['myid']; ?>
" style="display: none">
	<table class="ct" align=center>
	<thead>
	<tr>
<td> <b>вх.номер</b>
<td> <b>дата</b>
<td> <b>подател</b>
<td> <b>описание</b>
<td> <b>бележки</b>
	</thead>
	<tbody>
<?php $_from = $this->_tpl_vars['elem']['listdocu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['eldocu']):
?>
	<tr valign=top>
<td> <?php echo $this->_tpl_vars['eldocu']['serial']; ?>
/<?php echo $this->_tpl_vars['eldocu']['year']; ?>

<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['eldocu']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

<td> <?php echo $this->_tpl_vars['eldocu']['from']; ?>

<td> <?php echo $this->_tpl_vars['eldocu']['text']; ?>

<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['eldocu']['notes'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, "...", true) : smarty_modifier_truncate($_tmp, 30, "...", true)); ?>

<?php endforeach; endif; unset($_from); ?>
	</tbody>
	</table>
</span>
				<?php endif; ?>
</td>
							<?php else: ?>
				<td class='sep'>&nbsp;</td>
				<td align=center> 
						<?php if ($this->_tpl_vars['elem']['last2'] == 0): ?>
				<img src="images/notviewed.gif" border="0" title="отвори">
						<?php else: ?>
				&nbsp;
						<?php endif; ?>
				</td>
							<?php endif; ?>
				<td class='sep'>&nbsp;</td>
<td align=center>
<nobr>
						<?php if (empty ( $this->_tpl_vars['elem']['lockname'] )): ?>
				&nbsp;
						<?php else: ?>
<img src="images/locked.gif" border="0" title="заключено от <?php echo $this->_tpl_vars['elem']['lockname']; ?>
" style="cursor:help;">
						<?php endif; ?>
						<?php if (empty ( $this->_tpl_vars['elem']['gounlock'] )): ?>
				&nbsp;
						<?php else: ?>
<a href="<?php echo $this->_tpl_vars['elem']['gounlock']; ?>
" class="nyroModal" target="_blank">
<img src="images/lock3.gif" border="0" title="ОТКЛЮЧИ.">
</a>
						<?php endif; ?>
</nobr>
				<td class='sep'>&nbsp;</td>
<td align=center onclick="event.cancelBubble=true;document.location.href='<?php echo $this->_tpl_vars['elem']['lockmy']; ?>
';">
						<?php if (empty ( $this->_tpl_vars['elem']['lockmy'] )): ?>
				&nbsp;
						<?php else: ?>
&nbsp;
						<?php endif; ?>
				</td>
<td class='sep'>&nbsp;</td>
<td> 
	<?php if (empty ( $this->_tpl_vars['elem']['hist'] )): ?>
&nbsp;
	<?php else: ?>
<img src="images/view.png" class="hist" rel="#hist<?php echo $this->_tpl_vars['myid']; ?>
" title="история на статусите">

<span id="hist<?php echo $this->_tpl_vars['myid']; ?>
" style="display: none">
	<table class="ct" align=center>
	<thead>
	<tr>
<td> <b>време</b>
<td> <b>променил</b>
<td> <b>статус</b>
	</thead>
	<tbody>
<?php $_from = $this->_tpl_vars['elem']['hist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['eldocu']):
?>
	<tr valign=top>
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['eldocu']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y %H:%M") : smarty_modifier_date_format($_tmp, "%d.%m.%Y %H:%M")); ?>

<td> <?php echo $this->_tpl_vars['eldocu']['username']; ?>

	<?php $this->assign('indxstat', $this->_tpl_vars['eldocu']['idstat']); ?>
<td> <?php echo $this->_tpl_vars['ARSTAT'][$this->_tpl_vars['indxstat']]; ?>

<?php endforeach; endif; unset($_from); ?>
	</tbody>
	</table>
</span>
</td>
	<?php endif; ?>
	<?php $this->assign('indxstat', $this->_tpl_vars['elem']['idstat']); ?>
<td> <?php echo $this->_tpl_vars['ARSTAT'][$this->_tpl_vars['indxstat']]; ?>
 &nbsp;
								<?php if ($this->_tpl_vars['ISBASESTATUS'] && ! $this->_tpl_vars['VIEWUSERNAME']): ?>
<td class='sep'>&nbsp;</td>
	<?php if ($this->_tpl_vars['elem']['basecoun'] == '0'): ?>
<td class="red7bg" align=right> <?php echo $this->_tpl_vars['elem']['basecoun']; ?>
 </td>
	<?php else: ?>
<td class="red7" align=right> <?php echo $this->_tpl_vars['elem']['basecoun']; ?>
 </td>
	<?php endif; ?>
				<?php else: ?>
				<?php endif; ?>
																		<?php if ($this->_tpl_vars['FLAGARCHIVE']): ?>
<td class='sep'>&nbsp;</td>
										<?php if (empty ( $this->_tpl_vars['elem']['archive'] )): ?>
											<?php if ($this->_tpl_vars['elem']['notclosed'] > 1): ?>
<td>
&nbsp;
											<?php else: ?>
<td align=left>
											<?php endif; ?>
										<?php else: ?>
<td align=center>
<a href="casearch.ajax.php<?php echo $this->_tpl_vars['elem']['editarch']; ?>
" class="nyroModal" target="_blank" onclick="event.cancelBubble=true;">
<img src="images/archive.gif" class="arch" rel="#arch<?php echo $this->_tpl_vars['myid']; ?>
" title="данни за архива"></a>
<span id="arch<?php echo $this->_tpl_vars['myid']; ?>
" style="display: none">
последна корекция от <b><?php echo $this->_tpl_vars['elem']['archive']['username']; ?>
</b>
<br>
на <b><?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['archive']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y %H:%M") : smarty_modifier_date_format($_tmp, "%d.%m.%Y %H:%M")); ?>
</b>
	<table align=center>
	<tr>
<td align=left>арх.номер <td> <b><?php echo $this->_tpl_vars['elem']['archive']['serial']; ?>
</b> от <b><?php echo $this->_tpl_vars['elem']['archive']['year']; ?>
</b> год.
	<tr>
<td align=left>архивиран <td> <b><?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['archive']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</b>
	<tr>
<td align=left>протокол <td> <b><?php echo $this->_tpl_vars['elem']['archive']['protocol']; ?>
</b> от <b><?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['archive']['protdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</b>
	<tr>
<td align=left>забележка <td> <b><?php echo $this->_tpl_vars['elem']['archive']['notes']; ?>
</b>
	</table>
</span>
										<?php endif; ?>
</td>
									<?php else: ?>
									<?php endif; ?>
			</tr>
		<?php endforeach; endif; unset($_from); ?>
		</tbody>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</table>
<br> &nbsp;
</form>

	<?php if (isset ( $this->_tpl_vars['LINKLOCK'] )): ?>
<span style="visibility: hidden">
<a id="lock" href="caselocked.ajax.php<?php echo $this->_tpl_vars['LINKLOCK']; ?>
" class="nyroModal" target="_blank"> lock </a>
</span>
	<?php else: ?>
	<?php endif; ?>
	<?php if (isset ( $this->_tpl_vars['LINKOWNE'] )): ?>
<span style="visibility: hidden">
<a id="owne" href="casenotowner.ajax.php<?php echo $this->_tpl_vars['LINKOWNE']; ?>
" class="nyroModal" target="_blank"> notowner </a>
</span>
	<?php else: ?>
	<?php endif; ?>

<script>
function getowner(event,tdid,caid){
	event.cancelBubble=true; 
	$("#"+tdid).html("<img src='ajaxload.gif'>");
	$("#"+tdid).load(encodeURI('caseowne.ajax.php?caid='+caid));
}
</script>

<style>
table.ct thead tr td { background-color: silver }
table.ct tbody tr td { border-bottom: 1px solid black }
</style>
							<?php if ($this->_tpl_vars['VIEWUSERNAME']): ?>
<script type="text/javascript">
$(document).ready(function() {
	$('.ttip').cluetip({ width: 540, local:true, cursor:'pointer' });
});
</script>
							<?php else: ?>
							<?php endif; ?>
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script>
$(document).ready(function() {
	$('.hist').cluetip({ width: 360, local:true, cursor:'pointer' });
																		$('.arch').cluetip({ width: 300, local:true, cursor:'pointer' });
});
</script>
