<div class="pageheader">
	<h2><i class="fa fa-percent"></i><?php echo $sel; ?><span>List</span></h2>
	<a class="btn btn-success pull-right addItemButton"  style="margin-top:-35px" data-toggle="modal" data-target="#myModal">Add</a>
</div>
				

<div class="contentpanel">
	<div class="row">
		<div class="table-responsive">
			<table class="table table2excel table-striped" id="table2">
					<thead>
						 <tr>
							<th>S.No.</th>
							<th>Tax Name</th>
							<th>Category</th>
							<th>CGST</th>
							<th>SGST</th>
							<th>Action</th>
						 </tr>
					</thead>
					<tbody id="mutisearchingTbody">
					<?php if(!empty($result))
					{
						$i=1;
						foreach($result as $r)
						{ ?>
							<tr id="row_<?php echo $r['id']; ?>">
								<td> <?php echo $i++; ?></td>
								<td> <?php echo $r['name']; ?></td>
								<td> <?php echo $r['gst']; ?></td>
								<td> <?php echo $r['cgst']; ?></td>
								<td> <?php echo $r['sgst']; ?></td>
								<td> 
									<a class="btn btn-primary btn-icon btn-circle btn-sm edit" main="<?php echo $r['id']; ?>" title="Edit Tax">
										<i class="fa fa-pencil"></i>
									</a>
									<a class="btn btn-danger btn-icon btn-circle btn-sm delete" title="Edit Tax" main="<?php echo $r['id']; ?>">
										<i class="fa fa-trash"></i>
									</a>
								</td> 
							</tr>
						<?php }
					} ?>
					</tbody>
			</table>
		  </div><!-- table-responsive -->
	</div><!--row-->
</div><!-- contentpanel -->


<script type="text/javascript">

//data table
$(document).ready(function(){
    var t = jQuery('#table2').dataTable({
      "sPaginationType": "full_numbers"
    });


// Chosen Select
    jQuery("#table2_length select").chosen({
      'min-width': '100px',
      'white-space': 'nowrap',
      disable_search_threshold: 10
    });
    
	$(".addItemButton").click(function(){
		$("#editForm")[0].reset();
		$("#hidden_ids").val("");
		$(".submit_btn").html("Add");
		$(".modal-title").html("Add tax");
		$("#category").removeAttr("disabled");
		
	});
	
	
	//edit stock
	$('#table2 tbody').on( 'click', '.edit', function(){
		var id = $(this).attr('main');
		$(".modal-title").html("Edit tax"); 
		$(".submit_btn").html("Update");
		  $.ajax({
            type: "POST",
            url: "<?php echo base_url('product/getTax_data');?>",
            data: {id:id},                    
            beforeSend: function()
             {
                $('.loading').show();
				$('.loading_icon').show();
             },
            success: function(result)
            {
				$('.loading').hide();
				$('.loading_icon').hide();
				var rs = JSON.parse(result);
				if(rs.type != "fail")
				{
					var result = rs.html;
					$("#name").val(result[0]['name']);
					$("#gst").val(result[0]['gst']);
					$("#sgst").val(result[0]['sgst']);
					$("#cgst").val(result[0]['cgst']);
					$("#hidden_id").val(result[0]['id']);
					$("#category").attr("disabled","disabled");
					$('#myModal').modal('show');
				}
				else
				{
					$.growl.notice({title: "<i class='fa fa-times'> Sorry.. </i>", message: rs.msg });
				}
			}
          }); 
		
	});
	

//---------------Update Category Submit
  var form_object = jQuery("#editForm"); 
  form_object.validate({
    rules: {
            name: {
                   required: true
            },
			category: {
                   digits: true,
				   remote: {
						url: "<?php echo base_url('product/checkCategory'); ?>",
						type: "post",
						data: {
							  category: function() {
								return $( "#category" ).val();
							  }
							}
					}
				}
           },
	message:
	{
		category:
			 { 
				remote: jQuery.validator.format("Category is already taken.")
			 }
	},
    highlight: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
      //alert(element);
      jQuery(element).closest('.form-group').removeClass('has-error');
    },
	errorPlacement: function(error, element) { 
      // Append error within linked label
      $( element )
        .closest( "form" )
          .find( "label[for='" + element.attr( "id" ) + "']" )
            .append( error );
      },
    submitHandler: function() {
      var form_data = new FormData($('#editForm')[0]);
	  console.log(form_data);
      if(form_data != "")  
        {
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('product/add_tax');?>",
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
                $('.loading').hide();
				$('.loading_icon').hide();
				var rs = JSON.parse(result);
				if(rs.type != "fail")
				{
					$.growl.notice({title: "<i class='fa fa-check'> Success </i>", message: rs.msg });
					$("#editForm")[0].reset();
					$('#myModal').modal('hide');
					location.reload();
					
				}
				else
				{
					$.growl.notice({title: "<i class='fa fa-times'> Sorry.. </i>", message: rs.msg });
				}
			}
          }); 
        }
	}
});

$(document).on('click','.delete', function(){
	var id= $(this).attr('main');
		bootbox.confirm("Are You Sure You Want to Delete this Tax?", function(result) {
            if(result == true)
                {
                $.ajax({
                    url:"<?php echo base_url(); ?>product/delete_tax",
                    type:"post",
                    data:{
						'tax_id':id
					},                    
                    success: function(result){					
						//alert(result); 
						
						if (result){
							$("tr#row_"+id).remove();
							$.growl.notice({title: "<i class='fa fa-check'> Success </i>", message: "Tax Deleted Successfully!!" });
						}
						else{
							bootbox.alert("Some error occured");
						}
                    }
                  });
                }
          });
});

	
 });

</script>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
<form id="editForm" action="post">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header modal-header-success">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Tax</h4>
      </div>
      <div class="modal-body">
	  
        <div class="form-group">
		<label class="control-label">Tax Name</label>
			<div class="input-group mb15">
				 <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
				 <input type="text" placeholder="Tax Name" id="name" class="form-control" name="name" required="">
			</div>
		</div>
		<div class="form-group">
		<label class="control-label">Tax Category</label>
			<div class="input-group mb15">
				 <span class="input-group-addon"><i class="fa fa-cogs"></i></span>
				 <input type="text" placeholder="Tax Category" id="gst" class="form-control" name="gst" required="">
			</div>
		</div>
		<div class="form-group">
		<label class="control-label">CGST</label>
			<div class="input-group mb15">
				 <span class="input-group-addon"><i class="fa fa-percent"></i></span>
				 <input class="form-control valid" type="text" name="cgst" id="cgst" required="" placeholder="CGST">
			</div>
		</div>
		<div class="form-group">
		<label class="control-label">SGST</label>
			<div class="input-group mb15">
				 <span class="input-group-addon"><i class="fa fa-percent"></i></span>
				 <input class="form-control valid" type="text" name="sgst" id="sgst" required="" placeholder="SGST">
				 <input class="form-control valid" type="hidden" name="hidden_id" id="hidden_id">
			</div>
		</div>
		
	</div>
      <div class="modal-footer">
		<button type="submit" class="btn btn-success submit_btn">Add</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
</form>
  </div>
</div>

