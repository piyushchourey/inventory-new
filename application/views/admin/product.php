<style type="text/css">
	#table2
	{
	    width: 1090px !important;
	}
</style>	
	<div class="pageheader">
		<h2><i class="fa fa-briefcase"></i><?php echo $sel; ?><span>List</span></h2>
		<a class="btn btn-success pull-right addItemButton"  style="margin-top:-35px" href="<?php echo base_url('product/add'); ?>">Add</a>
	</div>
				

	<div class="contentpanel">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<span id="checkAlert"></span>
			</div>
			<div class="col-md-4">
				<a href="javascript:void(0)" class="delete_ad">
					<button type="button" class="btn btn-danger pull-right">Delete</button>
				</a>
			</div>
		</div>
		<div class="clearfix mb30"></div>
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
		<?php } ?>
		<!--searching-->

		<div class="row">
        <div class="table-responsive">
			<table class="table table2excel table-striped" id="table2">
					<thead>
						 <tr>
							<th>S.No.</th>
							<th><input name="select" type="checkbox" id="selecctall"  ></th>
							<th>Product Name</th>
							<th>Price (in <i class="fa fa-inr">)</i></th>
							<th>Category Name</th>
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
/*    var t = jQuery('#table2').dataTable({
      "sPaginationType": "full_numbers"
    });*/
   $('#table2').dataTable({
     "sPaginationType": "full_numbers",
      "processing": true,
          "serverSide": true,
          "ajax":{
            url :"<?php echo base_url('product/getallproductAjax');?>",
            type: "post",  // method  , by default get
            error: function(){
              $(".table2-error").html("");
              $("#table2").append('<tbody class="table2-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
              $("#table2_processing").css("display","none");
              
            }
          },
          "aoColumnDefs":[
		  {
           'bSortable': false,
           'aTargets': [1]
		  },
            {
              "aTargets":[6],
              "mData":"fgdfg",
              "bSortable":false,
               "mRender": function ( data, type, full ) {
                var result="";
                result =  '<button class="btn btn-primary btn-icon btn-circle btn-sm edit" title="Edit"><i class="fa fa-pencil"></i></button>&nbsp;<button class="btn btn-danger btn-icon btn-circle btn-sm delete" title="Delete"><i class="fa fa-trash-o"></i></button>';
        return result;
      }
            },
             {
              "aTargets":[0],
              "bSortable":false
                         }
          ]
         
    });



// Chosen Select
    jQuery("#table2_length select").chosen({
      'min-width': '100px',
      'white-space': 'nowrap',
      disable_search_threshold: 10
    });
    
	var table = $('#table2').DataTable();
  	$('#table2 tbody').on( 'click', '.delete', function(){
        var data = table.row($(this).parents('tr')).data();
        var id = data[6];
        console.log(data[6]);
		bootbox.confirm("Are You Sure You Want to Delete this Product?", function(result) {
            if(result == true)
                {
                $.ajax({
                    url:"<?php echo base_url(); ?>product/deleted",
                    type:"post",
                    data:"id="+id,                    
                    success: function(data){
                    	$.growl.error({ message: "Product Deleted Successfully!!!" });
						table.ajax.reload();
                    }
                  });
                }
            else if(result == false)
                {

                }
          });
    });

  	$('#table2 tbody').on( 'click', '.edit', function(){
        var data = table.row($(this).parents('tr')).data();
        var id = data[6];
        if(id)
        {
        	$.ajax({
                    url:"<?php echo base_url(); ?>product/edit",
                    type:"post",
                    data:"id="+id,                    
                    success: function(data)
                    {
                    	if(data!="")
                    	{
                    		var res = jQuery.parseJSON(data);
                    		console.log(res[0].name);
                    		$("#hidden_id").val(res[0].id);
                    		$("#name").val(res[0].name);
                    		$("#price").val(res[0].price);
                    		$("#myModal").modal('show');
                    	}
                    	else
                    	{
                    		$.growl.error({ message: "Please Try Again!!!" });
                    	}
					}
                  });
        }
        else
        {
        	$.growl.error({ message: "Please Try Again!!!" });
        }
	});

  	$(document).on('click','#selecctall',function(){
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{ 
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
	});

//multiple delte click event
$(".delete_ad").on('click',function(){
		//$("#checkAlert").html("");
		var text = getCheckedArray();
		var tableName = 'product';
        var fieldName = 'id';
		var msg = "Are You Sure You want to delete this Product?";
		var url = '<?php echo base_url('product/deleted');?>';
		customMethod(text,tableName,fieldName,msg,url);
	}); 
		
	//function get checked array
	
	function getCheckedArray()
	{
			var chks = document.getElementsByName('id[]');
			var checkCount = 0;
			var text = new Array();
			var strtext = "";
			for (var i = 0; i < chks.length; i++)
			{
				if (chks[i].checked)
				{
					var arlength = text.length;
					text[arlength] = chks[i].value;
				}
			}
			return text;
	}
	
	//Method for delete and approve in bunch
	function  customMethod(text,tableName,fieldName,msg,url)
	{
		bootbox.confirm(msg, function(result) {
            if(result == true)
                {
					if(text.length > 0)
					{
						$.ajax({
							url:url,
							type:"post",
							data:"id="+text+"&tableName="+tableName+"&field="+fieldName,                    
							success: function(data){
								//alert(data);
								if(data = "true")
								{
									$.growl.notice({title: "<i class='fa fa-times'> Sorry.. </i>", message: "Product Deleted Successfully!!!" });
									table.ajax.reload();
								}
								else
								{
									$.growl.notice({title: "<i class='fa fa-check'> Success </i>", message: "Product Not Deleted Successfully!!!" });
								}
							}
						  });
					}
					else
					{
						$.growl.warning({ message: "Please check On Checkbox!!!!" });
						return false;
					}
				}
            else if(result == false)
                {

                }
			});
	} 


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

//Edit product..
  $("#editProduct").validate({
  		ignore: [],
        rules: {
  				price: {
  					required: true,
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
        var form_data = new FormData($('#editProduct')[0]);
  	  
        $.ajax({
          type: "POST",
          url: "<?php echo base_url('product/update');?>",
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
        				$("#myModal").modal('hide');
        				//console.log(result);
        				var abc=JSON.parse(result);
        				if(abc)
        				{
        					$.growl.notice({title: "<i class='fa fa-check'> Success </i>", message: "Product Update Successfully!!!" }); 
        				}
        				else
        				{
        					$.growl.warning({title: "<i class='fa fa-times'> Sorry </i>", message: "Product Not Update Successfully!!!" }); 
        				}
        			}
        			else
        			{
        					$.growl.danger({title: "<i class='fa fa-times'> Sorry </i>", message: "Please try again!!!" }); 
        			}
  			    document.getElementById("editProduct").reset();
  			   	table.ajax.reload();
 			}
        });  
  	}

  });






 });

</script>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header modal-header-success">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Product</h4>
        </div>
        <form id="editProduct" class="" method="post" enctype="multipart/form-data">
        <div class="modal-body">
           <div class="form-group no_margin">
                <label class="control-label">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Product Name" disabled="disabled">
            </div>
            <div class="form-group no_margin">
              <label class="control-label">Price</label>
              <input type="number" name="price" id="price" class="form-control spinner" placeholder="Price">
              <input type="hidden" name="hidden_id" id="hidden_id">
            </div>
       </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success btn btn-block">Update</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>

  <style type="text/css">
  .ui-spinner
  {
        display: block !important;
  }
</style>