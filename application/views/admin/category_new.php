		<div class="pageheader">
				<h2><i class="glyphicon glyphicon-align-center"></i><?php echo $sel; ?><span>List</span>
				<?php if($this->session->userdata['type']!= 'subadmin') { ?>
					<div class="pull-right">
						<a class="btn btn-success addItemButton" href="<?php echo base_url('category/add'); ?>">Add</a>
						<a class="btn btn-success"  href="<?php echo base_url('category/tree_View'); ?>">Tree View</a>
					</div>
				<?php } ?>
				</h2>
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
			<div class="col-md-3">
				<label>Reset</label>
				<div class="">
					<button class="btn btn-success" onclick="location.reload();">Reset</button>
				</div>
			</div>
		</div>

		<div class="clearfix mb30"></div>

		<!--searching-->

		<?php } ?>

		<div class="row">

        <div class="table-responsive">

			<table class="table table2excel table-striped" id="table2">

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

									<a class="btn btn-primary btn-xs edit"  data-toggle="modal" data-target="#editModal"  main="<?php echo $r['id']; ?>" title="Edit Category"><i class="fa fa-pencil"></i></a>

									<a class="btn btn-danger btn-xs delete" main="<?php echo $r['id']; ?>" title="Delete Category"><i class="fa fa-trash-o"></i></a>

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

          url:"<?php echo base_url('category/getEditdata'); ?>",

          type:"post",

          data:"catId="+id,                    

          success: function(data){

            var obj = jQuery.parseJSON(data);

			if(obj!="")
			{
				var name = obj[0]['name']; var id = obj[0]['id'];
				
				jQuery("#categoryName").val(name);
				
				jQuery("#hidden_id").val(id);  
				
				jQuery('#editModal').modal('show');
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
					}
					else
					{

						$.growl.notice({title: "<i class='fa fa-times'> Success!!! </i>", message: "Category Deleted Successfully!!!" });			
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

					location.reload();

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



  <!-- Modal -->

<div class="modal fade" id="editModal" role="dialog">

    <div class="modal-dialog modal-sm">

    <form id="editForm" action="" class="form-horizontal" method="post" enctype="multipart/form-data">

		  <!-- Modal content-->

		<div class="modal-content">

			<div class="modal-header">

			  <button type="button" class="close" data-dismiss="modal">&times;</button>

			  <h4 class="modal-title">Update Category</h4>

			</div>

			<div class="modal-body">

				<div class="form-group">

					  <div class="">
					  	<label>Category Name</label>
						<input class="form-control" type="text" name="name" id="categoryName" required="" placeholder="Category Name"></br>
						<input type="hidden" name="id" id="hidden_id">	

					   </div>

				</div>

				<button type="submit" class="btn btn-success btn-block mt10">Update</button>

			</div>

		</div>

    </form>  

    </div>

 </div>