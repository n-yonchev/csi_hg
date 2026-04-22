<?php /* Smarty version 2.6.9, created on 2020-02-27 12:56:50
         compiled from _ajax.header.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style='height:100%'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="<?php echo $this->_tpl_vars['CSSPATH'];  echo $this->_tpl_vars['VISUNAME']; ?>
" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" href="nyromodal/styles/nyroModal.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/tools.js"></script><script type="text/javascript" src="js/eff.js"></script>
<script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
<script type="text/javascript" src="nyromodal/jquery.nyroModal-1.3.1.js"></script>
<script type="text/javascript" src="js/resize.iframe.js"></script> 
<script type="text/javascript" src="help.js"></script>
		<?php if (isset ( $this->_tpl_vars['HEADJS'] )): ?>
			<?php $_from = $this->_tpl_vars['HEADJS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['jselem']):
?>
<script type="text/javascript" src="js/<?php echo $this->_tpl_vars['jselem']; ?>
"></script>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
		<?php endif; ?>
	<?php if (isset ( $this->_tpl_vars['HEADCODE'] )):  echo $this->_tpl_vars['HEADCODE']; ?>

	<?php else: ?>
	<?php endif;  echo $this->_tpl_vars['EXITCODE']; ?>

</head>
<body onload="<?php echo $this->_tpl_vars['ONLOAD']; ?>
;" style='height:100%;'>
<form name="myform" method=post style="margin:0px;padding:0px;width:auto;" enctype="multipart/form-data">