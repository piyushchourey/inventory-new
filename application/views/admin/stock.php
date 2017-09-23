		<div class="pageheader">
				<h2><i class="fa fa-cubes"></i><?php echo $sel; ?><span>List</span></h2>
				<?php if($this->session->userdata['type']!= 'subadmin' && $this->session->userdata['type']!= 'seller') { ?>
					<a class="btn btn-success pull-right addItemButton"  style="margin-top:-35px" href="<?php echo base_url('stock/add'); ?>">Add</a>
				<?php } ?>
		</div>
				

	<div class="contentpanel">
		<div class="row">
			<div class="col-md-8 col-md-offset-1">
					<div class="alert alert-danger" id="parentError" role="alert" style="display:none">
						<strong>Sorry!!!</strong>You can't delete parents category While child are present.
					</div>
			</div>
			<div class="col-md-8 col-md-offset-1">
					<div class="alert alert-danger" id="deleteError" role="alert" style="display:none">
						<strong>Well done!!!</strong>You Successfully Delete Category.
					</div>
			</div>
		</div>
	<div class="row">
        <div class="table-responsive">
			<table class="table table2excel table-striped" id="table2">
					<thead>
						 <tr>
							<th>S.No.</th>
							<th>Product Name</th>
							<th>Quantity</th>
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
								<td> <?php echo getName("product","name",$r['product_id']); ?></td>
								<td> <?php echo stockAvailablity($r['product_id'],0); ?></td>
								<td> 
								<a href="<?php echo base_url('stock/edit');?>/<?php echo inc($r['id']);  ?>">
									<button class="btn btn-primary btn-icon btn-circle btn-sm delete" title="Edit Stock">
									<i class="fa fa-pencil"></i>
								</button>
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
	
	
<!--cvcv-->

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
		
		$("#lable_name").val("");
		$("#myModalLabel").html("Add item");
		$("#category-submit-btn").html("Submit");
		
	});
	
	
	//edit stock
	$('#table2 tbody').on( 'click', '.edit', function(){
		var id = $(this).attr('main');
		window.location.href="<?php echo base_url();?>stock/edit/"+id;
	});
	

//searching category
        $(".search").change(function(){
		var categoryId = $(this).val();
		if(categoryId)
		{
			var baseUrl = "<?php echo base_url('category/searching'); ?>";
			$.ajax({
				url: baseUrl,
				type:"post",
				data:"categoryId="+categoryId,                    
				success: function(data){
					if(data!="")
					{
						//console.log(data);
						var append = "";
						var abc = jQuery.parseJSON(data)
						if(abc!="childNotavailable")
						{
							if(abc.length >0)
							{
								for(i=0,j=1;i<abc.length;i++,j++)
								{
									append+="<tr id=row_"+abc[i]['id']+"><td>"+j+"</td><td>"+abc[i]['name']+"</td><td>"+abc[i]['parentName']+"</td><td><a class='btn btn-primary btn-xs edit'  data-toggle='modal' data-target='#editModal'  main="+abc[i]['id']+"><i class='fa fa-pencil'></i></a>&nbsp;<a class='btn btn-danger btn-xs delete' main="+abc[i]['id']+" title='Delete Student'><i class='fa fa-trash-o'></i></a></td>";
								}
							}
							else
							{
								append+="<td valign='top' colspan='7' class='dataTables_empty' style='padding:10px'>No matching records found</td>";
							}
						}
						else
						{
							append+="<td valign='top' colspan='7' class='dataTables_empty' style='padding:10px'>No Child Available of this Category.</td>";
						}
						$("#mutisearchingTbody").html(append);
					}
				}
		  });
		}

	}); 
	
	
	//---------------Update Category Submit
  var form_object = jQuery("#editForm"); 
  form_object.validate({
    rules: {
            name: {
                   required: true
            }
           },

    highlight: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
      //alert(element);
      jQuery(element).closest('.form-group').removeClass('has-error');
    },
    submitHandler: function() {
      var form_data = new FormData($('#editForm')[0]);
	  console.log(form_data);
      if(form_data != "")  
        {
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('category/update');?>",
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
				if(result != "")
				{
					$.growl.notice({title: "<i class='fa fa-check'> Success </i>", message: "Category Updated Successfully!!!" });
					//table.ajax.reload();
					$('.loading').hide();
					$('#editModal').modal('hide');
					$('.loading_icon').hide();
					
				}
				else
				{
					$.growl.notice({title: "<i class='fa fa-times'> Sorry.. </i>", message: "Category Not Updated Successfully!!!" });
					table.ajax.reload();
				}
			}
          }); 
        }
	}
});
	
	
 });

</script>








<script>

//---------------
$(document).on('click','.deletereq', function(){
	var id= $(this).attr('id');
	//alert(id);
          bootbox.confirm("Are You Sure You Want to Delete this entry?", function(result) {
            if(result == true)
                {
                $.ajax({
                    url:"<?php echo base_url(); ?>supervisor/deletereq",
                    type:"post",
                    data:{
						'arg1':id
					},                    
                    success: function(result){					
						//alert(result); 
						
						if (result=='deleted'){
							window.location.reload();
						}
						else{
							bootbox.alert("Some error occured");
						}
                    }
                  });
                }
          });
});
	
</script>