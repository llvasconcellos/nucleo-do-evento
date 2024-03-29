<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* This is the default Basket Template. Modify as you like.
*
* @version $Id: basket_b2b.html.php 617 2007-01-04 19:43:08Z soeren_nb $
* @package VirtueMart
* @subpackage templates
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
?>
<table width="100%" cellspacing="2" cellpadding="4" border="0">
  <tr align="left" class="sectiontableheader">
	<th><?php echo $VM_LANG->_PHPSHOP_CART_NAME ?></th>
	<th><?php echo $VM_LANG->_PHPSHOP_CART_SKU ?></th>
	<th><?php echo $VM_LANG->_PHPSHOP_CART_PRICE ?></th>
	<th><?php echo $VM_LANG->_PHPSHOP_CART_QUANTITY ?></th>
	<th><?php echo $VM_LANG->_PHPSHOP_CART_SUBTOTAL ?></th>
	<th colspan="2" align="center"><?php echo $VM_LANG->_PHPSHOP_CART_ACTION ?></th>
  </tr>
<?php foreach( $product_rows as $product ) { ?>
  <tr valign="top" class="<?php echo $product['row_color'] ?>">
	<td><?php echo $product['product_name'] . $product['product_attributes'] ?></td>
    <td><?php echo $product['product_sku'] ?></td>
    <td><?php echo $product['product_price'] ?></td>
    <td>
    	<form action="<?php echo $action_url ?>" method="post">
		<input type="hidden" name="option" value="com_virtuemart" />
		<?php echo $product['quantity_box'] ?>
	</td>
    <td><?php echo $product['subtotal'] ?></td>
    <td><?php echo $product['update_form'] ?></td>
    <td><?php echo $product['delete_form'] ?></td>
  </tr>
<?php } ?>
<!--Begin of SubTotal, Tax, Shipping, Coupon Discount and Total listing -->
  <tr class="sectiontableentry2">
    <td colspan="4" align="right"><?php echo $VM_LANG->_PHPSHOP_CART_SUBTOTAL ?>:</td> 
    <td colspan="3"><?php echo $subtotal_display ?></td>
  </tr>
<?php if( $discount_before ) { ?>
  <tr class="sectiontableentry1">
    <td colspan="4" align="right"><?php echo $VM_LANG->_PHPSHOP_COUPON_DISCOUNT ?>:
    </td> 
    <td colspan="3"><?php echo $coupon_display ?></td>
  </tr>
<?php } 
if( $shipping ) { ?>
  <tr class="sectiontableentry1">
	<td colspan="4" align="right"><?php echo $VM_LANG->_PHPSHOP_ORDER_PRINT_SHIPPING ?>: </td> 
	<td colspan="3"><?php echo $shipping_display ?></td>
  </tr>
<?php } 
if ( $show_tax ) { ?>
  <tr class="sectiontableentry2">
	<td colspan="4" align="right" valign="top"><?php echo $VM_LANG->_PHPSHOP_ORDER_PRINT_TOTAL_TAX ?>: </td> 
	<td colspan="3"><?php echo $tax_display ?></td>
  </tr>
<?php }
if($discount_after) { ?>
  <tr class="sectiontableentry1">
    <td colspan="4" align="right"><?php echo $VM_LANG->_PHPSHOP_COUPON_DISCOUNT ?>:
    </td> 
    <td colspan="3"><?php echo $coupon_display ?></td>
  </tr>
<?php } ?>
  <tr>
    <td colspan="3">&nbsp;</td>
    <td colspan="4"><hr /></td>
  </tr>
  <tr>
    <td colspan="4" align="right"><?php echo $VM_LANG->_PHPSHOP_ORDER_PRINT_TOTAL ?>: </td>
    <td colspan="3"><strong><?php echo $order_total_display ?></strong>
    </td>
  </tr>
  <tr>
    <td colspan="7"><hr /></td>
  </tr>
</table>
