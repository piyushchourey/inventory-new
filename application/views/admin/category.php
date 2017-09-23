		<div class="pageheader">
				<h2><i class="fa fa-list"></i><?php echo $sel; ?><span>List</span></h2>
				<a class="btn btn-success pull-right addItemButton"  style="margin-top:-35px" href="<?php echo base_url('category/add'); ?>">Add</a>
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
	<?php if(!empty($result) && !empty($result[0]))
		{ ?>
	  	<!--searching-->
	  	<div class="row">
			<div class="col-md-3">
				<label>Category Name</label>
				<select class="form-control search select2-2" id="category" data-placeholder="Select an option" data-allow-clear="true">
					<option value="">Select Category</option>
					<?php foreach($result as $r)
					{ ?>	
						<option value=" <?php echo $r['id']; ?>"> <?php echo $r['name']; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="clearfix mb30"></div>
		<!--searching-->
		<?php } ?>
		<div class="row">
        <div class="table-responsive">
			<table class="table table2excel" id="table2">
					<thead>
						 <tr>
							<th>S.No.</th>
							<th>Category Name</th>
							<th>Parent Category</th>
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
								<td> <?php echo $r['parentName']; ?></td>
								<td>
									<a class="btn btn-danger btn-xs delete" main="<?php echo $r['id']; ?>"><i class="fa fa-trash-o"></i></a>
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
	
	
   $('#table2 tbody').on( 'click', '.edit', function(){
		var id = $(this).attr('main');
		$.ajax({
          url:"<?php echo base_url('admin/getEditData'); ?>",
          type:"post",
          data:"id="+id,                    
          success: function(data){
            var obj = jQuery.parseJSON(data);
			if(obj!="")
			{
				var name = obj[0]['lable_name']; var imgTitle = obj[0]['id'];
				$("#lable_name").val(name);
				$("#hidden_id").val(id);
				$("#myModalLabel").html("Update Item");
				$("#category-submit-btn").html("Update");
				jQuery('#categoryModal').modal('show');
            }
			else
			{
				$("#myModalLabel").html("Update Item");
				$("#category-submit-btn").html("Update");
				jQuery('#categoryModal').modal('show');
			}
          }
        });
    }); 
	
//delete 
	$(".table").on('click','.delete',function(){
          var id = $(this).attr('main');
          bootbox.confirm("Are You Sure You Want to Delete this category?", function(result) {
            if(result == true)
			{
			$.ajax({
				url:"<?php echo base_url(); ?>category/delete",
				type:"post",
				data:"id="+id,                    
				success: function(data){  var abc = jQuery.parseJSON(data);
					if(abc == "parent")
					{
						$("#parentError").show();
						//$("#parentError").fadeOut();
					}
					else
					{
						$("#deleteError").show(); $("#deleteError").fadeOut();
						t.fnDeleteRow(jQuery("#row_" + id)[0]);
					}
				}
			  });
			}
            else if(result == false)
                {

                }
          });
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
									append+="<tr id=row_"+abc[i]['id']+"><td>"+j+"</td><td>"+abc[i]['name']+"</td><td>"+abc[i]['parentName']+"</td><td><a class='btn btn-danger btn-sm delete' main="+abc[i]['id']+" title='Delete Student'><i class='fa fa-trash-o'></i></a></td>";
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
	
	
	//---------------




</script>
