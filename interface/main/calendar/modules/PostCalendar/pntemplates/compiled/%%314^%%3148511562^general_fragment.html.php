<?php /* Smarty version 2.6.2, created on 2015-08-21 05:37:49
         compiled from /Applications/MAMP/htdocs/openemr/templates/prescription/general_fragment.html */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'xl', '/Applications/MAMP/htdocs/openemr/templates/prescription/general_fragment.html', 4, false),)), $this); ?>
<table>
  <?php if (empty ( $this->_tpl_vars['prescriptions'] )): ?>
        <tr class='text'>
                <td>&nbsp;&nbsp;<?php echo smarty_function_xl(array('t' => 'None'), $this);?>
</td>
        </tr>
  <?php endif; ?>
	<?php if (count($_from = (array)$this->_tpl_vars['prescriptions'])):
    foreach ($_from as $this->_tpl_vars['prescription']):
?>
  <?php if ($this->_tpl_vars['prescription']->get_active() > 0): ?>
	<tr class='text'>
		<td><?php echo $this->_tpl_vars['prescription']->drug; ?>
</td>
		<td><?php echo $this->_tpl_vars['prescription']->get_dosage_display(); ?>
</td>
	</tr>
  <?php endif; ?>
	<?php endforeach; unset($_from); endif; ?>
</table>