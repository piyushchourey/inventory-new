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
</style>
<div class="pageheader">
    <h2><i class="fa fa-list"></i>Add<span>List</span></h2>
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
	
    	<div class="col-md-1"></div>
    	<div class="col-md-10">
     <form id="categoryForm" action="<?php echo base_url('category/create'); ?>" class="form-horizontal" method="post" enctype="multipart/form-data" novalidate="novalidate">
          <div class="panel panel-success">
				<div class="panel-heading">
					<div class="panel-btns">
						<a href="#" class="panel-close">×</a>
						<a href="#" class="minimize">−</a>
					</div>
					<h4 class="panel-title">Create category</h4>
				</div>
			<div class="panel-body">
				
				<div class="row">
                    <div class="col-sm-5">
                      <div class="form-group no_margin subcat">
                      	<label class="control-label">Category</label>
						<select name="parentCategory_id" class="form-control category" main="1">
							<option value="">Select Category</option> 
							<?php if(!empty($result) && !empty($result[0])){ 
								foreach ($result as $r) { ?>
								 	<option value="<?php echo $r['id']; ?>"><?php echo $r['name']; ?></option>
							<?php }  } ?>
						</select>
					  </div>
                    </div><!-- col-sm-6 -->
					<div class="col-md-1 subcat subcat_initial" style="margin-top:35px">
						<label class="control-label"></label>
						<button type="button" class="btn btn-success addInput" main="0"><i class="fa fa-plus"></i></button>
					</div>
					<div class="col-sm-6 categoryname0" style="display:none">
                      <div class="form-group no_margin">
                      	<label class="control-label">Category name </label>
						<input type="text" name="name" id="name" class="form-control" required placeholder="Category Name">
						<span id="checkExistmsg"> </span>
                      </div>
                    </div><!-- col-sm-6 -->
					
				</div><!-- row -->
				<div class="subcatAdd"  style="display:none">
					
					
				</div>
			</div><!-- panel-body -->
				<div class="panel-footer">
	                <div class="row">
	                  <div class="col-sm-9 col-sm-offset-3">
					     <input type="hidden" name="parentCategory_id" id="setId">
	                    <button class="btn btn-success" type="submit">Create</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                  </div>
	                </div>
				</div>
          </div><!-- panel -->
      </form>
		</div> <div class="col-md-1"></div>
	</div>
</div>
<script type="text/javascript">
//data table
$(document).ready(function(){
    jQuery('#table2').dataTable({
      "sPaginationType": "full_numbers"
    });


// Chosen Select
    jQuery("#table2_length select").chosen({
      'min-width': '100px',
      'white-space': 'nowrap',
      disable_search_threshold: 10
    });
    


// for delete re-seller


      $("#add").click(function(){
        $("#name").attr('value',"");
        $("#id1").attr('value',"");
        $("#popuptitle").html("Add");
        $("#dynamicbtn").html("Add");
        
      })
 });

</script>
<script src="<?php echo base_url(); ?>js/jquery-ui-1.10.3.min.js"></script>






<script>
$(document).ready(function(){
		
$(document).on("change",".category",function() {

	if($(this).attr('main') == 1)
	{
		$(".subcatAdd").html("");
	}
	var catId = $(this).val();
	var level = $(this).attr("subcategorylevel");
	if(level){
		level = parseInt(level.trim());
		var length = $('.category-container').length;
		for(var i = level+1; i<length; i++){
			$('.category-container')[i].remove();
		}
		level++;
	}else{
		level = 0;
	}
	console.log(level);	
	if(catId!="")
	{
		$.ajax({
				url:"<?php echo base_url(); ?>category/getSubcat",
				type:"post",
				data:"catId="+catId,                    
				success: function(data){
					var abc = $.parseJSON(data);
					if(abc.length>0)
					{
						var toAppend="<div class='row category-container'><div class='col-sm-5'><div class='form-group no_margin subcat'><label class='control-label'>Subcategory</label><select  subcategorylevel='"+level+"' class='form-control category' main='' name='parentCategory_id'><option value=''>Select Subcategory</option>";
						var abc=JSON.parse(data);
						for(var i=0;i<abc.length;i++)
						{
							toAppend += '<option value='+abc[i]['id']+'>'+abc[i]['name']+'</option>'
						}
toAppend +='</select></div></div><div class="col-md-1 subcat" style="margin-top:27px"><label class="control-label"</label><button type="button" class="btn btn-success addInput" main="'+catId+'"><i class="fa fa-plus"></i></button></div><div class="col-sm-6 categoryname'+catId+'" style="display:none"><div class="form-group no_margin"><label class="control-label">Category name </label><input type="text" name="name" id="name" class="form-control" required="" placeholder="Category Name"></div></div></div>';
						$(".subcatAdd").append(toAppend);
						$(".subcatAdd").show();
					} else {
						var toAppend1="<div class='row category-container'><div class='col-sm-6 categoryname'><div class='form-group no_margin'><label class='control-label'>Category name </label><input type='text' name='name' id='name' class='form-control' placeholder='Category Name'></div></div></div>";
						$(".subcatAdd").append(toAppend1);
						$(".subcatAdd").show();
						$("#setId").val(catId);
					}
				}
		});
	}
});	
	
//--------------------check Level

$("#level").change(function(){
	var level = this.value;
	if(level!="")
	{
		if(level == 1)
		{
			$(".categoryname").show();
			$(".categoryname1").hide();
			$(".subcat").hide();
		}
		else
		{
			$(".categoryname").hide();
			//$(".categoryname1").show();
			$(".subcat").show();
		}
	}
	else 
	{
		$(".categoryname").hide();
		$(".categoryname1").hide();
		$(".subcat").hide();
	}

});

  jQuery("#categoryForm").validate({
    highlight: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-error');
    }
  });




//--------------------form validation
$.validator.addMethod('trainer', function(value, element) {
        return value !== 'select'
    }, 'Please select trainer');	
	
$('form.addsop').on('submit', function(event) { 

           
            $('input.name').each(function()
				{
					$(this).rules
					("add", {    required: true   }	)
				});
			
			$('input.description').each(function()
				{
					$(this).rules
					("add", {    required: true   }	)
				});
});

	
$("#addsop").validate({
        rules: {			
			title:{
				required:true
			},	
			days:{
				required:true
			},
			trainer:{
				required:true,
				trainer:true
			},
			location:{
				required:true,
				trainer:true
			},	
			trainingroom:{
				required:true,
				trainer:true
			},			
			name:{
				required:true
			},
			description:{
				required:true
			}
        },

        submitHandler: function(form) {
			if(check()==false)
			{
				$('#msg').css("display","block");
				return false;
			}
            form.submit();
        }
    });
	
	
});	



$(document).on("click",".addInput",function() {
	var id = $(this).attr('main');
	console.log(id);
	$("#setId").val(id);
	$(".categoryname"+id).show();
});	
</script>

