<?php 
//include css for uploading...
  $this->load->view ('MultiUpload');
?>
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
    <h2><i class="fa fa-user"></i>Edit<span>List</span></h2>
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
      <form id="quantityForm" class="form-horizontal" method="post" enctype="multipart/form-data">
          <div class="panel panel-success">
              <div class="panel-heading">
                <div class="panel-btns">
                  
                  <a href="#" class="minimize">−</a>
                </div>
                <h4 class="panel-title">Edit Stock</h4>
              </div>
              <div class="panel-body">
             	<div class="row">
					<div class="col-sm-4">
				      <div class="form-group no_margin">
							<label>Product Name</label>
							<select class="form-control search select2-2" name="product_id" id="product_id" data-placeholder="Select an option" data-allow-clear="true">
								<option value="">Select Product</option>
								<?php foreach($result as $r)
								{ ?>	
									<option value="<?php echo $r['id']; ?>" <?php if($result1[0]['product_id']==$r['id']) { echo "selected"; } ?>> <?php echo $r['name']; ?></option>
								<?php } ?>
							</select>
					</div>
					</div>
				   <!-- col-sm-6 -->
				   <div class="col-sm-3">
                <div class="form-group no_margin">
                  <label class="control-label">Quantity</label>
                  <input type="number" name="qty" class="form-control spinner" placeholder="Quantity" value="<?php echo stockAvailablity($result1[0]['product_id'],0); ?>">
                </div>
            </div>
            <div class="col-sm-3">
                  <div class="form-group no_margin">
                    <label class="control-label">Date</label>
                    <input type="text" name="created_date" class="form-control datepicker" placeholder="Select Date" value="<?php echo $result1[0]['created_date']; ?>">
                    <input type="hidden" name="hidden_id" value="<?php echo $result1[0]['id']; ?>">
                  </div>
            </div>
				   <!-- col-sm-6 -->
				</div>
			</div><!-- panel-body -->
			<div class="panel-footer">
                <div class="row">
                  <div class="col-sm-9 col-sm-offset-3">
                    <button class="btn btn-success">Update</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                  </div>
                </div>
            </div>
		</div>
		</form>
	</div>

<script type="text/javascript">
$(document).ready(function(){
//Form submit with Validation
  $("#quantityForm").validate({
  		ignore: [],
      rules: {
  				product_id: {
  					required: true,
  			},
        qty: {
            required: true,
        },
        created_date:
        {
          required: true
        }
  		},
      errorElement: "span",
        errorPlacement: function (error, element) {
            console.log(element);
            if ($(element).hasClass("ui-spinner-input")) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },  
     submitHandler: function() {
        var form_data = new FormData($('#quantityForm')[0]);
  	  
        $.ajax({
          type: "POST",
          url: "<?php echo base_url('stock/update');?>",
          data: form_data,
          cache: false,
          contentType: false,
          processData: false,
          beforeSend: function()
      		{
            $('.loading').show();
            $('.loading_icon').show();
      		},
          success: function(result)
          {
             console.log(result);
  			    $('.loading').hide();
  			    $('.loading_icon').hide();
        			if(result != "")
        			{
        				//console.log(result);
        				var abc=JSON.parse(result);
        				if(abc)
        				{
        					$.growl.notice({title: "<i class='fa fa-check'> Success </i>", message: "Stock Update Successfully!!!" }); 
        				}
        				else
        				{
        					$.growl.warning({title: "<i class='fa fa-times'> Sorry </i>", message: "Stock Not Update Successfully!!!" }); 
        				}
        			}
        			else
        			{
        					$.growl.danger({title: "<i class='fa fa-times'> Sorry </i>", message: "Please try again!!!" }); 
        			}
  			    document.getElementById("quantityForm").reset();
  			   
            $("#product_id").attr("data-placeholder","bar");
            $("#product_id").select2();
  		}
        });  
  	}

  });
});
</script>
<style type="text/css">
  .ui-spinner
  {
        display: block !important;
  }
</style>