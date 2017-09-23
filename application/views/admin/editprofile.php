		<div class="pageheader">
				<h2><i class="fa fa-user"></i>My Profile<span>List</span>
				<div class="pull-right custom_fa">
					<a class="btn btn-success" href="<?php echo base_url('myprofile/edit'); ?>">
						<i class="fa fa-pencil mr5"></i>Edit Profile
					</a>
				</div>
				</h2>
		</div>
				

<div class="contentpanel">
   <div class="row">
   </div>
   <div class="row">
      <form id="editProfileForm" class="form-horizontal" method="post" enctype="multipart/form-data" novalidate="novalidate">
         <div class="panel panel-success">
            <div class="panel-heading">
               <div class="panel-btns">
                  <a href="#" class="minimize">−</a>
               </div>
               <h4 class="panel-title"><i class="fa fa-user"></i>&nbsp;&nbsp;Edit Profile</h4>
            </div>
            <div class="panel-body">
               <div class="row">
                  <div class="col-sm-4">
                     <label class="control-label">Firm Name</label>
                     <div class="input-group mb15">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" placeholder="Enter Firm Name" id="fnm" class="form-control" name="firm_nm" value="<?php if(!empty($result) && !empty($result[0]) && $result[0]['firm_nm']!="") { echo $result[0]['firm_nm']; }  ?>">
                     </div>
                  </div>
                  <!-- col-sm-6 -->
                  <div class="col-sm-4">
                     <label class="control-label">Phone Number</label>
                     <div class="input-group mb15">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
                        <input type="text" placeholder="Enter Phone Number" id="pnumber" class="form-control" name="phone_number" value="<?php if(!empty($result) && !empty($result[0]) && $result[0]['phone_number']!="") { echo $result[0]['phone_number']; }  ?>">
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <label class="control-label">Mobile Number</label>
                     <div class="input-group mb15">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                        <input type="text" placeholder="Enter Phone Number" id="mnumber" class="form-control" name="mobile_number" value="<?php if(!empty($result) && !empty($result[0]) && $result[0]['mobile_number']!="") { echo $result[0]['mobile_number']; }  ?>">
                     </div>
                  </div>
                
                  <div class="col-sm-4">
                     <label class="control-label">GST Number</label>
                     <div class="input-group mb15">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                        <input type="text" placeholder="Enter Tin Number" id="tnumber" class="form-control" name="tin_number" value="<?php if(!empty($result) && !empty($result[0]) && $result[0]['tin_number']!="") { echo $result[0]['tin_number']; }  ?>">
                     </div>
                  </div>
				  <div class="col-sm-4">
                     <label class="control-label">Firm Email</label>
                     <div class="input-group mb15">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input type="text" placeholder="Enter Firm Email" id="firm_email" class="form-control" name="firm_email" value="<?php if(!empty($result) && !empty($result[0]) && $result[0]['firm_email']!="") { echo $result[0]['firm_email']; }  ?>">
                     </div>
                  </div>
				  <div class="col-sm-4">
                     <label class="control-label">Firm Website</label>
                     <div class="input-group mb15">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                        <input type="text" placeholder="Enter Firm Url" id="firm_website" class="form-control" name="firm_website" value="<?php if(!empty($result) && !empty($result[0]) && $result[0]['firm_website']!="") { echo $result[0]['firm_website']; }  ?>">
                     </div>
                  </div>
				  <div class="col-sm-4">
                     <label class="control-label">Firm State</label>
                     <div class="input-group mb15">
                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                        <select id="firm_state" class="form-control" name="firm_state">
							<option value="">Select State</option>
							<?php if(!empty($state))
							{
								foreach($state as $s)
									{ ?>
									<option value="<?php echo $s['id']; ?>" <?php if(!empty($result) && !empty($result[0]) && $result[0]['firm_state']!="" && $result[0]['firm_state'] == $s['id']) { echo 'selected'; }  ?>><?php echo $s['name']; ?></option>
								<?php }
							}
							?>
						</select>
                     </div>
                  </div>
				  <div class="col-sm-4">
                     <label class="control-label">Firm City</label>
                     <div class="input-group mb15">
                        <span class="input-group-addon"><i class="fa fa-building"></i></span>
                        <select id="firm_city" class="form-control" name="firm_city">
							<option value="">Select City</option>
							<?php if(!empty($cities))
							{
								foreach($cities as $s)
								{ ?>
									<option value="<?php echo $s['id']; ?>" <?php if(!empty($result) && !empty($result[0]) && $result[0]['firm_city']!="" && $result[0]['firm_city'] == $s['id']) { echo 'selected'; }  ?>><?php echo $s['name']; ?></option>
								<?php }
									
							}
							?>
						</select>
                     </div>
                  </div>
				  <div class="col-sm-4">
                     <label class="control-label">Firm Telephone</label>
                     <div class="input-group mb15">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                        <input type="text" placeholder="Enter Firm Telephone" id="firm_telephone" class="form-control" name="firm_telephone" value="<?php if(!empty($result) && !empty($result[0]) && $result[0]['firm_telephone']!="") { echo $result[0]['firm_telephone']; }  ?>">
                     </div>
                  </div>
                  <!-- col-sm-6 -->
                  <div class="col-sm-4">
                     <label class="control-label">Address</label>
                      <textarea class="form-control" name="address" placeholder="Message">
                        <?php if(!empty($result) && !empty($result[0]) && $result[0]['address']!="") { echo $result[0]['address']; }  ?>  
                      </textarea>
                  </div>
                  <div class="col-sm-1">
                      <?php if(!empty($result) && !empty($result[0]) && $result[0]['logo']!="") { ?>
                          <img src="<?php echo base_url('upload')."/".$result[0]['logo']; ?>" height="50px" width="50px">
                    <input type="hidden" name="old_path" value="<?php echo $result[0]['logo']; ?>">
                      <?php } ?>
                  </div>
                  <div class="col-sm-3">
                     <label class="control-label">Company Logo</label>
                       <input type="file" class="form-control" name="clogo">
                  </div>
                </div>
            </div>
            <!-- panel-body -->
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
 </script>
<script type="text/javascript">
    $(document).ready(function(){
      //Form submit with Validation
      $("#editProfileForm").validate({
          ignore: [],
          rules: {
              firm_nm: {
                required: true,
            },
            phone_number: {
                required: true,
            },
            mobile_number:
            {
              required:true,
            },
            address:
            {
              required:true
            }
          },
    errorPlacement: function(error, element) { console.log(element);
      // Append error within linked label
      $( element )
        .closest( "form" )
          .find( "label[for='" + element.attr( "id" ) + "']" )
            .append( error );
      },

         submitHandler: function() {
            var form_data = new FormData($('#editProfileForm')[0]);
          
            $.ajax({
              type: "POST",
              url: "<?php echo base_url('myprofile/update')?>",
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
                      $.growl.notice({title: "<i class='fa fa-check'> Success </i>", message: "Profile Update Successfully!!!" }); 
                    }
                    else
                    {
                      $.growl.warning({title: "<i class='fa fa-times'> Sorry </i>", message: "Profile Not Update Successfully!!!" }); 
                    }
                  }
                  else
                  {
                      $.growl.danger({title: "<i class='fa fa-times'> Sorry </i>", message: "Please try again!!!" }); 
                  }
                document.getElementById("editProfileForm").reset();
          }
            });  
        }
      
      });
	  

$("#firm_state").change(function(){
	var state_id = $(this).val();
    if(state_id)
    {
        $.ajax({
            url:"<?php echo base_url('product/getcities'); ?>",
            type:"post",
            data:"state_id="+state_id,                    
            success: function(data)
            {
                var abc=JSON.parse(data);
				if(abc.length>0)
				{
					var cities = "";
					for(var i=0;i<abc.length;i++)
					{
					  cities += '<option value='+abc[i]['id']+'>'+abc[i]['name']+'</option>'
					}
					$("#firm_city").html(cities);
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
	  
	  
});
   </script>
   <style type="text/css">
      .ui-spinner
      {
      display: block !important;
      }
   </style>
   <!--content end-->
   <!--footer-->
</div><!-- contentpanel -->

<style type="text/css">
.custom_fa .fa
{
	font-size: 15px;
	border:none;
}
.custom_fa .fa.fa-pencil
{
	padding: 0px;
}
</style>