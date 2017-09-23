<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<title>
	<?php if(!empty($myprofile))
	{ 
		echo $myprofile['firm_nm'];
	} ?>
	</title>
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>css/print_style.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>css/print.css' media="print" />
	<script type='text/javascript' src='http://code.jquery.com/jquery-1.3.2.js'></script>
	<script type='text/javascript' src='<?php echo base_url(); ?>js/example.js'></script>
</head>

<body>
<input type="button" id="print_button" value="PRINT" style="float:right;background: green;color: #fff;padding: 10px;border: 1px green;" onclick="myFunction()">
	<div id="page-wrap">
		<textarea id="header">INVOICE</textarea>
		
		<div id="identity">
			<textarea id="address">
			<?php if(!empty($myprofile))
			{ 
				echo $myprofile['firm_nm']." ".trim($myprofile['address']);
				echo "GSTIN: ".$myprofile['tin_number'];
				echo "Phone: ".$myprofile['mobile_number']; } ?>
			</textarea>
			<div id="logo">

              <div id="logoctr">
                <a href="javascript:;" id="change-logo" title="Change logo">Change Logo</a>
                <a href="javascript:;" id="save-logo" title="Save changes">Save</a>
                |
                <a href="javascript:;" id="delete-logo" title="Delete logo">Delete Logo</a>
                <a href="javascript:;" id="cancel-logo" title="Cancel changes">Cancel</a>
              </div>

              <div id="logohelp">
                <input id="imageloc" type="text" size="50" value="" /><br />
                (max width: 540px, max height: 100px)
              </div>
              <img id="image" src="<?php if($myprofile['logo']!="") { echo base_url('upload/')."/".$myprofile['logo'];  } ?>" alt="logo" height="100px" width="175px"/>
            </div>
		
		</div>
		
		<div style="clear:both"></div>
		
		<div id="customer">

            <textarea id="customer-title">
		   <?php if(!empty($order))
  			{ 
  				echo ucfirst($order['customer_name']).$order['mobile_number'];
  			} ?>
			</textarea>

            <table id="meta">
                <tr>
                    <td class="meta-head">Invoice #</td>
                    <td><textarea>
                    <?php 
                    	if(!empty($order) && $order['order_date'])
  						{ 
                    		$date = DateTime::createFromFormat("Y-m-d", $order['order_date']);
							echo "LT".$date->format("dm").$order['id'];
						}
					?>
                    </textarea></td>
                </tr>
                <tr>

                    <td class="meta-head">Date</td>
                    <td><textarea id="date">December 15, 2009</textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Amount Due</td>
                    <td><div class="due"> 
                    <img src="<?php echo base_url('images/nGbfO.png'); ?>" width="8" height="10">
                    <?php if(!empty($order) && $order['order_amount']!="")
		  			{ 
		  				echo $order['order_amount'];
		  			} ?>
	  				
	  			</div></td>
                </tr>

            </table>
		
		</div>
		
		<table id="items">
		
		  <tr>
		      <th>Item</th>
		      <th>Description</th>
		      <th>Unit Cost (<img src="<?php echo base_url('images/nGbfO.png'); ?>" width="8" height="10">)</th>
		      <th>Quantity</th>
		      <th>Price(<img src="<?php echo base_url('images/nGbfO.png'); ?>" width="8" height="10">)</th>
			  <th>GST(<img src="<?php echo base_url('images/nGbfO.png'); ?>" width="8" height="10">)</th>
		  </tr>
	  	<?php if(!empty($order_detail))
	  	{
	  		foreach ($order_detail as $od) {
  		?>
		  <tr class="item-row">
		      <td class="item-name"><div class="delete-wpr"><textarea><?php echo $od['pname']; ?></textarea><a class="delete" href="javascript:;" title="Remove row">X</a></div></td>
		      <td class="description">
		      	<textarea>Monthly web updates</textarea>
		      </td>
		      <td><textarea class="cost"><?php echo $od['prdct_price']; ?></textarea></td>
		      <td><textarea class="qty"><?php echo $od['prdct_qty']; ?></textarea></td>
		      <td><span class="price"><?php echo $od['prdct_qty']*$od['prdct_price']; ?></span></td>
			  <td><span class="price"><?php echo $od['gst']."%"; ?></span></td>
		  </tr>
	  	<?php } }?>
		  <tr id="hiderow">
		    <td colspan="5"><a id="addrow" href="javascript:;" title="Add a row">Add a row</a></td>
		  </tr>
		  
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Subtotal</td>
		      <td class="total-value"><div id="subtotal">
		      <img src="<?php echo base_url('images/nGbfO.png'); ?>" width="8" height="10">
		      <?php if(!empty($order) && $order['order_amount']!="")
	  			{ 
	  				echo $order['order_amount'];
	  			} ?>
  			</div></td>
		  </tr>
		  <tr>

		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Total</td>
		      <td class="total-value"><div id="total">
		      	<img src="<?php echo base_url('images/nGbfO.png'); ?>" width="8" height="10">
		      <?php if(!empty($order) && $order['order_amount']!="")
	  			{ 
	  				echo $order['order_amount'];
	  			} ?>
		      </div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Amount Paid</td>

		      <td class="total-value"><textarea id="paid">0.00</textarea></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Balance Due</td>
		      <td class="total-value balance"><div class="due">
		      <img src="<?php echo base_url('images/nGbfO.png'); ?>" width="8" height="10">
		      <?php if(!empty($order) && $order['order_amount']!="")
	  			{ 
	  				echo $order['order_amount'];
	  			} ?></div></td>
		  </tr>
		
		</table>
		
		<div id="terms">
		  <h5>Terms</h5>
		  <textarea><?php if(!empty($myprofile))
			{ 
				echo $myprofile['firm_nm']." ".trim($myprofile['address']).", ";
				echo "Phone: ".$myprofile['mobile_number']; } ?></textarea>
		</div>
	
	</div>
	
</body>

</html>
<script>
function myFunction() {
    window.print();
}
</script>