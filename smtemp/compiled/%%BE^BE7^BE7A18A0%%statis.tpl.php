<?php /* Smarty version 2.6.9, created on 2025-04-11 16:18:16
         compiled from statis.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title> CSI STATISTICS </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="css/ip.css" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" href="nyromodal/styles/nyroModal.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
<script type="text/javascript" src="nyromodal/jquery.nyroModal-1.3.1.js"></script> 
</head>
<body style="font: normal 10pt verdana">

			<table class="main" align=center>
			<tr>
			<td>
		<?php $_from = $this->_tpl_vars['MAINMENU']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
<a class="<?php if ($this->_tpl_vars['ekey'] == $this->_tpl_vars['MODE']): ?>curr<?php else:  endif; ?>" href="<?php echo $this->_tpl_vars['elem']['link']; ?>
">
<?php echo $this->_tpl_vars['elem']['text']; ?>

</a>
		<?php endforeach; endif; unset($_from); ?>
			<tr>
			<td>
<br>
<?php echo $this->_tpl_vars['CONTENT']; ?>

			</table>
			
</body>
</html>