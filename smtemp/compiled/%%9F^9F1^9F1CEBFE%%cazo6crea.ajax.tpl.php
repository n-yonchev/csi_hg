<?php /* Smarty version 2.6.9, created on 2020-02-27 12:58:08
         compiled from cazo6crea.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'cazo6crea.ajax.tpl', 129, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.header.tpl", 'smarty_include_vars' => array('TITLE' => "нов изходящ документ")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

			<?php if (isset ( $this->_tpl_vars['ONLYGET'] )): ?>
<input type="checkbox" name="onlyserial">
само вземи изходящ номер
<br>
			<?php else: ?>
			<?php endif; ?>
тип
<br>
<style>
option {font: bold 8pt verdana}
.opt2 {color:blue;}
</style>
<select name="iddocutype" id="iddocutype" onchange="document.forms[0].submit();">
<?php $_from = $this->_tpl_vars['ARDOCUTYPE']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
			<?php if (isset ( $this->_tpl_vars['ARDOWORD'][$this->_tpl_vars['ekey']] )): ?>
	<option value="<?php echo $this->_tpl_vars['ekey']; ?>
" class="opt2"><?php echo $this->_tpl_vars['elem']; ?>
</option>
			<?php else: ?>
	<option value="<?php echo $this->_tpl_vars['ekey']; ?>
"><?php echo $this->_tpl_vars['elem']; ?>
</option>
			<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</select>

			<?php if (isset ( $this->_tpl_vars['CLAINAME'] )): ?>
<br>
избери взискател
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['CLAINAME'],'ID' => 'idclaimer','C1' => 'input','C2' => 'inputer','ONCH' => "document.forms[0].submit();")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php else: ?>
			<?php endif; ?>

			<?php if (isset ( $this->_tpl_vars['DEBTNAME'] )): ?>
<br>
избери длъжник
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['DEBTNAME'],'ID' => 'iddebtor','C1' => 'input','C2' => 'inputer','ONCH' => "document.forms[0].submit();")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php else: ?>
			<?php endif; ?>

			<?php if (isset ( $this->_tpl_vars['OLIHNAME'] )): ?>
<br>
избери предмет за олихв.сума
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['OLIHNAME'],'ID' => 'idpredolih','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php else: ?>
			<?php endif; ?>

			<?php if (isset ( $this->_tpl_vars['NEOLIHNAME'] )): ?>
<br>
избери предмет за неолихв.сума
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['NEOLIHNAME'],'ID' => 'idpredneolih','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php else: ?>
			<?php endif; ?>

			<?php if (isset ( $this->_tpl_vars['SMETKANAME'] )): ?>
<br>
избери банкова сметка за дълг
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['SMETKANAME'],'ID' => 'idsmetka','C1' => 'input','C2' => 'inputer','ONCH' => "document.forms[0].submit();")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php else: ?>
			<?php endif; ?>

			<?php if (isset ( $this->_tpl_vars['SMETKA2NAME'] )): ?>
<br>
избери банкова сметка за такси
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['SMETKANAME'],'ID' => 'idsmetka2','C1' => 'input','C2' => 'inputer','ONCH' => "document.forms[0].submit();")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php else: ?>
			<?php endif; ?>

			<?php if (isset ( $this->_tpl_vars['ADVRNAME'] )): ?>
<br>
избери клон на АДВ
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ADVRNAME'],'ID' => 'idregionadv','C1' => 'input','C2' => 'inputer','ONCH' => "document.forms[0].submit();")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php else: ?>
			<?php endif; ?>

			<?php if (isset ( $this->_tpl_vars['NAPRNAME'] )): ?>
<br>
избери клон на НАП
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['NAPRNAME'],'ID' => 'idregionnap','C1' => 'input','C2' => 'inputer','ONCH' => "document.forms[0].submit();")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php else: ?>
			<?php endif; ?>

<br>
<br>
			<table class="base" align=center width=100%>
		<?php $_from = $this->_tpl_vars['DATA']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
			<tr>
<td class="t8bord" valign=top> 
			<?php if ($this->_tpl_vars['elem']['SPECFLAG'] == 1): ?>
	<font color="red"><?php echo $this->_tpl_vars['elem']['text']; ?>
</font>
			<?php elseif ($this->_tpl_vars['elem']['SPECFLAG'] == 2): ?>
	<font color="blue"><?php echo $this->_tpl_vars['elem']['text']; ?>
</font>
			<?php else: ?>
				<?php if ($this->_tpl_vars['elem']['fieltype'] == 'cbox'): ?>
	избери да/не
				<?php else: ?>
	<?php echo $this->_tpl_vars['elem']['text']; ?>

				<?php endif; ?>
			<?php endif; ?>
<td class="t8bord" valign=top>
														<?php if (empty ( $this->_tpl_vars['elem']['ajax'] )): ?>
							<?php else: ?>
								<?php $this->assign('smarname', $this->_tpl_vars['elem']['fielname']); ?>
								<?php $this->assign('ajaxname', ((is_array($_tmp='ajax')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['elem']['fielname']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['elem']['fielname']))); ?>
<div id="<?php echo $this->_tpl_vars['ajaxname']; ?>
" class="inp7bold"> <?php echo $_SESSION[$this->_tpl_vars['smarname']]['code']; ?>

</div>
							<?php endif; ?>
				<?php if ($this->_tpl_vars['elem']['fieltype'] == 'tear'): ?>
<textarea name="<?php echo $this->_tpl_vars['elem']['fielname']; ?>
" id="<?php echo $this->_tpl_vars['elem']['fielname']; ?>
" class="input" rows=5 cols=50></textarea>
				<?php elseif ($this->_tpl_vars['elem']['fieltype'] == 'text'): ?>
<input name="<?php echo $this->_tpl_vars['elem']['fielname']; ?>
" id="<?php echo $this->_tpl_vars['elem']['fielname']; ?>
" class="input" size=40>
				<?php elseif ($this->_tpl_vars['elem']['fieltype'] == 'select'): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['elem']['arname'],'ID' => $this->_tpl_vars['elem']['fielname'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php elseif ($this->_tpl_vars['elem']['fieltype'] == 'cbox'): ?>
<input type="checkbox" name="<?php echo $this->_tpl_vars['elem']['fielname']; ?>
" id="<?php echo $this->_tpl_vars['elem']['fielname']; ?>
"checked> <label for="<?php echo $this->_tpl_vars['elem']['fielname']; ?>
"><?php echo $this->_tpl_vars['elem']['text']; ?>
</label>
				<?php elseif ($this->_tpl_vars['elem']['cont'] == ""): ?>
&nbsp;
				<?php else: ?>
<?php echo $this->_tpl_vars['elem']['cont']; ?>

				<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
			</table>

			<?php if (isset ( $this->_tpl_vars['ONLYGET'] )): ?>
			<?php else: ?>
<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'запиши','NAME' => 'subm','ID' => 'subm')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
&nbsp;
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'създай документа','NAME' => 'subm2','ID' => 'subm2')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php if ($this->_tpl_vars['WORDFLAG']): ?>
<div style="float:right;">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'Word','NAME' => 'subm3','ID' => 'subm3')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div>
					<?php else: ?>
					<?php endif; ?>

			<?php endif; ?>

			<?php if ($this->_tpl_vars['DOCUTYPE'] == 0): ?>
<script>
//parent.$.nyroModalSettings({width:180, height:140});
</script>
			<?php else: ?>
<script>
parent.$.nyroModalSettings({width:740, height:580});
var flag3= false;
function listchan(p1,p2,p3){
				if (p3){
flag3= true;
				}
	jQuery.ajax({
		url: "<?php echo $this->_tpl_vars['AJAXNAME']; ?>
?mychan="+p1.value+"&mypref="+p2+"&mypref2="+p3,
		success: function(data){
				if (flag3){
			var myar= data.split("^");
			$('#'+p2).text(myar[0]);
			$('#'+p3).attr("value",myar[1]);
	sync();
				}else{
			$('#'+p2).text(data);
				}
		}
	});
}
$(document).ready(function(){
	<?php if (isset ( $_POST['delo_acdebt'] )): ?>
	<?php else: ?>
		var v1= parent.getacdebt();
		$("#delo_acdebt").val(v1);
	<?php endif; ?>
	<?php if (isset ( $_POST['delo_acdebt_list'] )): ?>
	<?php else: ?>
		var v2= parent.getacdebt_list();
		$("#delo_acdebt_list").val(v2);
	<?php endif; ?>
			sync();
});
function sync(){
<?php echo $this->_tpl_vars['SUMATOTA']; ?>

}
</script>
			<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>