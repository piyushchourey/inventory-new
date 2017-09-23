<style type="text/css">
.no_margin{
    margin-left: 0px !important;
    margin-right: 0px !important;
    margin-bottom: 7px !important;
}
.p1
{
  padding-bottom: 8px;
}
.pddesc
{
  width: 5%;
}
</style>
<div class="pageheader">
    <h2><i class="fa fa-print"></i>Billing<span>List</span></h2>
</div>
  <div class="contentpanel">
      <div class="row">
        <?php if ($this->session->flashdata('status')=='success') { ?>
            <div class="col-md-8 col-md-offset-1">
            <div class="alert alert-success" id="success123" role="alert">
              <strong>Well done!</strong> <?php echo $this->session->flashdata('msg'); ?>
            </div>
          </div>
        <?php  } else if ($this->session->flashdata('status')=='fail') {?>
          <div class="col-md-8 col-md-offset-1">
            <div class="alert alert-danger" id="error123" role="alert">
              <strong>Oh snap!</strong> <?php echo $this->session->flashdata('msg'); ?>
            </div>
          </div>
        <?php } ?>
      </div>
		<div class="row">
      <form id="billing_form" action="<?php echo base_url('billing/done');?>" class="form-horizontal" method="post" enctype="multipart/form-data">
          <div class="panel panel-success">
              <div class="panel-heading">
                <div class="panel-btns">
                  
                  <a href="#" class="minimize">−</a>
                </div>
                <h4 class="panel-title"><i class="fa fa-print"></i>&nbsp;&nbsp;Bill Genrate</h4>
              </div>
              <div class="panel-body">
             	<div class="row">
  					     <div class="col-sm-4">
                  <label class="control-label">Customer Name</label>
      				      <div class="input-group mb15">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                      <input type="text" placeholder="Enter Customer Name" id="cname" class="form-control" name="customer_name" required>
                    </div>
  					     </div>
                 <div class="col-sm-4">
                     <label class="control-label">Mobile Number</label>
                     <div class="input-group mb15">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                        <input type="text" placeholder="Enter Phone Number" id="mnumber" class="form-control" name="mobile_number" required>
                     </div>
                  </div>
				      </div>

              <div class="row">
                 <div class="col-sm-3">
                    <div class="input-group mb15">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
                      <!--<input type="text" placeholder="Product Name" class="form-control prdct_nm" id="prdct0" main="0">-->
                      <select class="form-control prdct_nm" name="product_id[]" required>
                        <option value="">Select Product</option>
                        <?php
                            if(!empty($result) && !empty($result[0]))
                            {
                              foreach ($result as $value) 
                              {
                               ?>
              <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                            <?php } } ?> 
                      </select>
                    </div>
                 </div>
                  <div class="col-sm-2">
                    <div class="form-group no_margin">
                        <input type="number" name="qty[]" class="form-control spinner qty" placeholder="Quantity" value="1" vrequired>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="input-group mb15">
                      <span class="input-group-addon"><i class="fa fa-inr"></i></span>
                      <input type="text" placeholder="Per Price" name="price[]" class="form-control price" required>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="input-group mb15">
                      <span class="input-group-addon"><i class="fa fa-inr"></i></span>
                      <input type="text" placeholder="Total Price" id="tprice" class="form-control tprice" name="total_price[]" required>
                    </div>
                  </div>
				  <div class="col-sm-2">
                    <div class="input-group mb15">
                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                      <select id="gst" class="form-control gst" name="gst[]" required>
						<option value="">Select Tax</option>
						<?php
							if(!empty($all_tax))
							{
								foreach($all_tax as $t)
								echo "<option value=".$t['gst'].">".$t['name']." - ".$t['gst']."%</option>";
							}
						?>
					  </select>
                    </div>
                  </div>
                  <div class="col-sm-1">
                    <div class="input-group mb15">
                     <button type="button" class="btn btn-success addInput" main="0"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
              </div>

              <div class="dynamicFields"></div>
			</div><!-- panel-body -->
			<div class="panel-footer">
                <div class="row">
                  <div class="col-sm-9 col-sm-offset-3">
                    <button class="btn btn-success">Add</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                  </div>
                </div>
            </div>
		</div>
		</form>
	</div>
<script type="text/javascript">
//data table
$(document).ready(function(){
 // Chosen Select
    jQuery("#table2_length select").chosen({
      'min-width': '100px',
      'white-space': 'nowrap',
      disable_search_threshold: 10
    });
    
 });

</script>
<style type="text/css">
  .ui-spinner
  {
        display: block !important;
  }
  .ui-spinner-input
  {
    padding: 6px !important;
  }
  
</style>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<script type="text/javascript">

var options = {
    source: '<?php echo base_url('product/getAll')?>',
      select: function (event, ui) { 
      var pro_id = ui.item.id; 
      //getpprice(pro_id);
      var label = ui.item.label; 
      var value = ui.item.value;
      var unique = $(this).attr("main"); 
      $("#prdct_nm"+unique).val(value);
   },
 };

$(document).on('keydown.autocomplete', '.prdct_nm', function() {
      $(this).autocomplete(options);
 });  


$(document).ready(function(){

$(document).on("click",".addInput",function() {  
  var timestamp = new Date().getUTCMilliseconds();
   $.ajax({
        url:"<?php echo base_url(); ?>product/getAjaxproduct",
        success: function(data){
          var abc = $.parseJSON(data); console.log();
          if(abc.type = 'success' && abc.product.length > 0)
          {
              var toAppend="<div class='row r"+timestamp+"'><div class='col-sm-3'><div class='input-group mb15'><span class='input-group-addon'><i class='glyphicon glyphicon-briefcase'></i></span><select class='form-control prdct_nm' name='product_id[]' id='prdct"+timestamp+"' main='"+timestamp+"' required><option value=''>Select Product</option>";
                var abc=JSON.parse(data);
                for(var i=0;i<abc.product.length;i++)
                {
                  toAppend += '<option value='+abc['product'][i]['id']+'>'+abc['product'][i]['name']+'</option>'
                }
          }
		  if(abc.tax.length > 0)
		  {
			  var  tax_text= "<div class='col-sm-2'><div class='input-group mb15'><span class='input-group-addon'><i class='fa fa-percent'></i></span><select id='gst' class='form-control gst' name='gst[]' required=''><option value=''>Select Tax</option>"
			  
			  for(var i=0;i<abc.tax.length;i++)
				{
                  tax_text += '<option value='+abc['tax'][i]['gst']+'>'+abc['tax'][i]['name']+" - "+abc['tax'][i]['gst']+'%</option>'
				}
			  
			   tax_text +="</select></div></div>";
		  }
      
      toAppend += "</select></div></div><div class='col-sm-2'><div class='form-group no_margin'><input type='number' name='qty[]' class='form-control spinner qty' placeholder='Quantity' required value='1'></div></div><div class='col-sm-2'><div class='input-group mb15'><span class='input-group-addon'><i class='fa fa-inr'></i></span><input type='text' placeholder='Per Price' class='form-control price' name='price[]' required></div></div><div class='col-sm-2'><div class='input-group mb15'><span class='input-group-addon'><i class='fa fa-inr'></i></span><input type='text' name='total_price[]' placeholder='Total Price' class='form-control tprice' required></div></div>"+tax_text+"<div class='col-sm-1'><div class='input-group mb15'><button type='button' class='btn btn-danger remove' main='"+timestamp+"'><i class='fa fa-minus'></i></button></div></div></div></div>";
      $(".dynamicFields").append(toAppend);
      $('.prdct_nm', toAppend).autocomplete(options);
  
      $( ".spinner" ).spinner({
        spin: function( event, ui ) { //console.log(ui.value);
          if ( ui.value < 1 ) {
            $( this ).spinner( "value", 1 );
            return false;
          }
        }
      });

      }
    });
});

$(document).on("click",".remove",function() {
   // $(this).parent().parent().nextAll().remove();
    var rid = $(this).attr("main");
    $(".r"+rid).remove();
   });



$(document).on('click.spinner', '.ui-spinner-button', function() {
    $(".spinner").spinner({
        spin: function( event, ui ) { 
          if ( ui.value < 1 ) {
            $( this ).spinner( "value", 1 );
            return false;
          }
          else
          {
            var qty = ui.value; 
            var p_id = $(this).parent().find(".qty").attr("mainPro_id");
            //checkStock(qty,p_id);
            var price = $(this).parent().parent().parent().next().find(".price").val();
            if(parseInt(qty)>0 && parseInt(price)>0)
            {
              $(this).parent().parent().parent().next().next().find(".tprice").val(parseInt(qty)*parseInt(price));
            }
          }
        }
      });
 }); 

$(document).on("keyup",".price",function() {
    var price1 = $(this).val();
    var tprceselector = $(this).parent().parent().next();
    var qty1 = $(this).parent().parent().prev().find(".qty").val();
    if(qty1>0 && price1>0)
    { 
        console.log(tprceselector.val());
        tprceselector.find(".tprice").val(qty1*price1);
    }
  });

$(document).on("keyup",".qty",function() {  
    var qty = $(this).val();
    var price = $(this).parent().parent().parent().next().find(".price").val();
    if(parseInt(qty)>0 && parseInt(price)>0)
    {
      $(this).parent().parent().parent().next().next().find(".tprice").val(parseInt(qty)*parseInt(price));
    }
  });

});

</script>
<script type="text/javascript">
$(document).ready(function(){
/*function getpprice(pid)
{
   var priceField = $(this).parent().parent().next().next().find(".price");
    if(pid!="")
    {
        $.ajax({
            url:"<?php //echo base_url('product/getPrice'); ?>",
            type:"post",
            data:"pid="+pid,                    
            success: function(data)
            {
                var abc11=JSON.parse(data);
                var proprice = parseInt(abc11[0]['price']);
                if(proprice)
                {
                  priceField.val(proprice);
                }
            }
          });
    } 
    else
    {
        priceField.val("");
        priceField.parent().parent().next().find(".tprice").val("");
    }
}*/

$(document).on("change",".prdct_nm",function() {
    console.log($(this).parent().parent().parent().closest('.qty').val());
    var pid = $(this).val();
    $(this).parent().parent().next().find(".qty").attr("mainPro_id",pid);
    var priceField = $(this).parent().parent().next().next().find(".price");
	var tpriceField = $(this).parent().parent().next().next().next().find(".tprice");
	var taxField = $(this).parent().parent().next().next().next().next().find(".gst");
    if(pid!="")
    {
        $.ajax({
            url:"<?php echo base_url('product/getPrice'); ?>",
            type:"post",
            data:"pid="+pid,                    
            success: function(data)
            {
				console.log(data);
                var abc=JSON.parse(data);
                if(parseInt(abc[0]['price'])!="")
                {
                  priceField.val(parseInt(abc[0]['price']));
				  tpriceField.val((parseInt(abc[0]['price'])*1));
				  taxField.val(abc[0]['gst']);
                }
            }
          });
    } 
    else
    {
        priceField.val("");
        priceField.parent().parent().next().find(".tprice").val("");
    }
   });

function checkStock(qty,p_id)
{

}

  var form_object = jQuery("#billing_form"); 
  form_object.validate({
    errorPlacement: function(error, element) { console.log(element);
      // Append error within linked label
      $( element )
        .closest( "form" )
          .find( "label[for='" + element.attr( "id" ) + "']" )
            .append( error );
      },
  });

});
</script>