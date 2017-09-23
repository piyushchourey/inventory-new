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
    <div class="">
      <div class="col-md-4 col-md-offset-4">
        <div class="alert alert-success" id="success123" role="alert" style="display:none;">
            <strong>Well done!</strong> You successfully Add Locality.
         </div>
      </div>
      <div class="col-md-4 col-md-offset-4">
        <div class="alert alert-danger" id="error123" role="alert" style="display:none;">
            <strong>Oh snap!</strong> Please Try Again..
        </div>
      </div>
    </div>
    </br>
  <div class="contentpanel">
    <div class="row">
     <form id="addsop" action="<?php echo base_url();?>admin/updatesopform" class="form-horizontal" method="post" enctype="multipart/form-data">
          <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-btns">
                  <a href="#" class="panel-close">×</a>
                  <a href="#" class="minimize">−</a>
                </div>
                <h4 class="panel-title">Update Sop</h4>
              </div>
              <div class="panel-body">
              <!--alerts-->
					<?php if ($this->session->flashdata('status')=='added'){ ?>
					<div class="alert alert-success" id="success123" role="alert" >
					<strong><?php echo $this->session->flashdata('msg'); ?></strong>
					</div>
					<?php } else if($this->session->flashdata('status')=='error'){ ?>
					<div class="alert alert-danger" id="error123" role="alert">
					<strong><?php echo $this->session->flashdata('msg'); ?></strong>
					</div>
					  </div>
					<?php } else {}?>
               <!--alerts-->
			   <?php foreach($result as $arr){ ?> 
                <div class="row">
                    
					<div class="col-sm-6">
                      <div class="form-group no_margin">
					  <label for="title"class="col-sm-3 control-label">Title:</label>
						  <div class="col-sm-9">
                        <input type="text" name="title" id="title" class="form-control" value='<?php echo $arr['title'];?>'>
                        <input type="hidden" name="updateid" id="title" class="form-control" value='<?php echo $arr['id'];?>'>

						  </div>
                      </div>
                    </div><!-- col-sm-6 -->
					
					
                    <div class="col-sm-6">
                      <div class="form-group no_margin">
					  <label>Days:</label>
                        <input type="text" name="days" id="days" class="form-control" value='<?php echo $arr['days'];?>'>
                      </div>
                    </div><!-- col-sm-6 -->
					
                </div><!-- row -->
				  
                <!-- row -->
				<div class="row">
					<div class="col-sm-6">
					  <div class="form-group no_margin">
					  <label>Trainer:</label>
						<select name="trainer" class="form-control">
						<?php foreach($trainer as $train){ ?>
							<option value="<?php echo $train['id']; ?>" <?php if($train['id']==$arr['trainer']) { echo "selected"; }?>><?php echo $train['name']; ?></option>
			
					<?php 	}?>
						</select>
					  </div>
					</div><!-- col-sm-6 -->
					
                  <div class="col-sm-6">
                      <div class="form-group no_margin">
					  <label>Training-room:</label>
						<select name="trainingroom" class="form-control">
						<?php foreach($trainingroom as $training){ ?>
							<option value="<?php echo $training['id']; ?>" <?php if($training['id']==$arr['trainingroom']) { echo "selected"; }?>><?php echo $training['training_room']; ?></option>
			
					<?php 	}?>
						</select>
					 </div>
                   </div><!-- col-sm-6 -->
					
				</div><!-- row -->
				
                <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group no_margin">
					  <label>Location:</label>
						<select name="location" class="form-control">
						<?php foreach($location as $locations){ ?>
	<option value="<?php echo $locations['id']; ?>" <?php if($locations['id']==$arr['location']) { echo "selected"; }?>><?php echo $locations['location']; ?></option>
			
					<?php 	}?>
						</select>
                      </div>
                    </div><!-- col-sm-6 -->
                </div><!-- row -->
				
				<?php 
				if(!empty($arr['sopname'])){
				$size=sizeof($arr['sopname']);
				if($size<=1){ ?>
					<div id="dynamicField">
						<div class="row" id="rorcount">
							<div class="col-sm-4">
							   <div class="row">
								 <div class="col-sm-8">
								 
									 <div class="form-group no_margin">
									   <input type="text" name="name[<?php echo "id".$arr['sopnameID'][0];?>]" id="name" class="form-control" value="<?php echo $arr['sopname'][0];?>">
									</div>
								  </div>
							   </div>
							</div>
							
							<div class="col-sm-6">
							   <div class="row">
								 <div class="col-sm-8">
									 <div class="form-group no_margin">
									   <textarea type="text" name="description[]" id="description" class="form-control" placeholder="Description" >
									   <?php echo $arr['description'][0];?> 
									   </textarea>
									</div>
								  </div>
							   </div>
							</div>							
							<div class="col-sm-2">
								<button type="button" class="btn btn-success pull-right" style="margin-top:8px; " id="addRow"><span class="glyphicon glyphicon-plus"></span></button>
								<button type="button" class="btn btn-danger remove_buttons" id="" name="<?php echo $arr['sopnameID'][0];?>"><span class="glyphicon glyphicon-minus"></span></button>
							</div>
					  </div>
					</div>	
			<?php 	} else { ?> <div id="dynamicField"> <?php  
			
			for ($i=0; $i<$size; $i++)
				
			{ ?>
					<div class="row" id="rorcount">
							<div class="col-sm-4">
							   <div class="row">
								 <div class="col-sm-8">
									 <div class="form-group no_margin">
									   <input type="text" name="name[<?php echo "id".$arr['sopnameID'][$i];?>]" id="name" class="form-control" value="<?php echo $arr['sopname'][$i];?>">
									</div>
								  </div>
							   </div>
							</div>
							<div class="col-sm-6">
							   <div class="row">
								 <div class="col-sm-8">
									 <div class="form-group no_margin">
									   <textarea type="text" name="description[<?php echo "desid".$arr['sopnameID'][$i];?>]" id="description" class="form-control"  > <?php echo $arr['description'][$i];?></textarea>
									</div>
								  </div>
							   </div>
							</div>	
							
						<?php if ($i==0)
							{ ?>
								<div class="col-sm-2">
									<button type="button" class="btn btn-success pull-right" style="margin-top:8px; " id="addRow"><span class="glyphicon glyphicon-plus"></span></button>
									<button type="button" class="btn btn-danger remove_buttons" id="" name="<?php echo $arr['sopnameID'][$i];?>"><span class="glyphicon glyphicon-minus"></span></button>
								</div>
					<?php   } 
							else
							{ ?>
								<button type="button" class="btn btn-danger remove_buttons" id="remove_'+rowCount+'" name="<?php echo $arr['sopnameID'][$i];?>"><span class="glyphicon glyphicon-minus"></span></button>
					<?php 	}?>

					  </div>
				
		<?php 	}  echo "</div>";  } } else if (empty($arr['sopname'])){ ?>
				<div id="dynamicField">
						<div class="row" id="rorcount">
							<div class="col-sm-4">
							   <div class="row">
								 <div class="col-sm-8">
									 <div class="form-group no_margin">
									   <input type="text" name="name[]" id="name" class="form-control" placeholder='name' required>
									</div>
								  </div>
							   </div>
							</div>
							
							<div class="col-sm-6">
							   <div class="row">
								 <div class="col-sm-8">
									 <div class="form-group no_margin">
									   <textarea type="text" name="description[]" id="description" class="form-control" placeholder="Description" > </textarea>
									</div>
								  </div>
							   </div>
							</div>
							
							<div class="col-sm-2">
							 <button type="button" class="btn btn-success pull-right" style="margin-top:8px; " id="addRow"><span class="glyphicon glyphicon-plus"></span></button>
							</div>
					  </div>
					</div>
			
		<?php }?>
			

				
			<div class="col-sm-2">
				<button type="submit" class="btn btn-success pull-right" style="margin-top:8px;" >Submit</button>
			</div>
			   <?php } ?>
			</div><!-- panel-body -->

			</form>
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
    
 });

// for delete re-seller

$(document).ready(function(){
      $("#add").click(function(){
        $("#name").attr('value',"");
        $("#id1").attr('value',"");
        $("#popuptitle").html("Add");
        $("#dynamicbtn").html("Add");
        
      })

        $(".table").on('click','.delete_country',function(){
          var id = $(this).attr('main');
          bootbox.confirm("Are You Sure You Want to Delete this Locality?", function(result) {
            if(result == true)
                {
                $.ajax({
                    url:"<?php echo base_url(); ?>country/deleteCountry/locality",
                    type:"post",
                    data:"id="+id,                    
                    success: function(data){
                        window.location.reload();
                    }
                  });
                }
            else if(result == false)
                {

                }
          });
        }); 
});
</script>
<script src="<?php echo base_url(); ?>js/jquery-ui-1.10.3.min.js"></script>





<script>
$(document).ready(function(){
	//------------addrow
var rowCount = 1;
 $("#addRow").click(function(){
  var toAppend = ' <div class="row" id="row_'+rowCount+'"> <div class="col-sm-4"> <div class="row"> <div class="col-sm-8"> <div class="form-group no_margin"> <input type="text" name="name[]" id="name'+rowCount+'" class="form-control" placeholder="Name"> </div></div> </div></div> <div class="col-sm-6"><div class="row"><div class="col-sm-8"><div class="form-group no_margin"><textarea type="text" name="description[]" id="description'+rowCount+'" class="form-control" placeholder="Description" > </textarea></div></div></div></div><div class="col-sm-2"><button type="button" class="btn btn-danger remove_button" id="remove_'+rowCount+'"><span class="glyphicon glyphicon-minus"></span></button></div></div>';
  //var toAppend = '<br>test<br>'; 
  $('#dynamicField').append(toAppend);
  rowCount++;
 })


$(document).on( "click", ".remove_button" , function(){
  var id = $(this).attr('id');
  var temp = id.split('_');
  $("#row_"+temp[1]).remove();
     //alert(temp[1]);
 });
 
 //---------
});
</script>

<script>
$(document).ready(function(){
	

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
 function check () {

	var name=document.getElementsByName('name[]');
	var description=document.getElementsByName('description[]');
	var text="";
	var k=0;
	for (var i = 0; i < name.length; i++)
{
	
	if (name[i].value=='')
	{
			//alert('ddd');
			
			return false;
	}
	
	if(description[i].value=='')
	{
		alert('desc');
		return false;
	}
}

return true;
}
</script>

<script>
$(document).on('click', '.remove_buttons',function(){
	var id=$(this).attr('name');
	//alert(id);
	        bootbox.confirm("Are You Sure You Want to Delete this entry?", function(result) {
            if(result == true)
                {
                $.ajax({
                    url:"<?php echo base_url(); ?>admin/deleteupdatesopname",
                    type:"post",
                    data:{
						'arg1':id
					},                    
                    success: function(result){					
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
	
} );
</script>

