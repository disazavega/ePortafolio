<?php /* Smarty version Smarty-3.1.15, created on 2013-11-30 13:47:56
         compiled from "tpl/home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14490928785299ec5d3669b0-72326537%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f99195648e6e1098f8d12653e724370662324a83' => 
    array (
      0 => 'tpl/home.tpl',
      1 => 1385819273,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14490928785299ec5d3669b0-72326537',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5299ec5d6ac204_25150418',
  'variables' => 
  array (
    'name' => 0,
    'address' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5299ec5d6ac204_25150418')) {function content_5299ec5d6ac204_25150418($_smarty_tpl) {?>Hello <?php echo $_smarty_tpl->tpl_vars['name']->value;?>
, your current address is <?php echo $_smarty_tpl->tpl_vars['address']->value;?>

<?php }} ?>
