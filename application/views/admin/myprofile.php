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
  <?php if(!empty($result) && !empty($result[0])) { ?>
   <div class="row">
      <div class="col-sm-3">
      <?php if($result[0]['firm_nm']!="") { ?>
         <img src="<?php echo base_url('upload')."/".$result[0]['logo'];?>" class="thumbnail img-responsive" alt="">
      <?php } ?>
         <div class="mb30"></div>
         <h5 class="subtitle">About</h5>
         <p class="mb30">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat... <a href="">Show More</a></p>
         <h5 class="subtitle">Connect</h5>
         <ul class="profile-social-list">
            <li><i class="fa fa-twitter"></i> <a href="">twitter.com/eileensideways</a></li>
            <li><i class="fa fa-facebook"></i> <a href="">facebook.com/eileen</a></li>
            <li><i class="fa fa-youtube"></i> <a href="">youtube.com/eileen22</a></li>
            <li><i class="fa fa-linkedin"></i> <a href="">linkedin.com/4ever-eileen</a></li>
            <li><i class="fa fa-pinterest"></i> <a href="">pinterest.com/eileen</a></li>
            <li><i class="fa fa-instagram"></i> <a href="">instagram.com/eiside</a></li>
         </ul>
         <div class="mb30"></div>
         <h5 class="subtitle">Address</h5>
         <address>
            795 Folsom Ave, Suite 600<br>
            San Francisco, CA 94107<br>
            <abbr title="Phone">P:</abbr> (123) 456-7890
         </address>
      </div>
      <!-- col-sm-3 -->
      <div class="col-sm-9">
         <div class="profile-header">
            <h2 class="profile-name">
              <?php if($result[0]['firm_nm']!="") { echo $result[0]['firm_nm']; } ?>
            </h2>
            <div class="profile-location"><i class="fa fa-map-marker"></i> 
              <?php if($result[0]['address']!="") { echo $result[0]['address']; } ?></div>
            <div class="profile-position"><i class="fa fa-briefcase"></i> Software Engineer at <a href="">SomeCompany, Inc.</a></div>
            <div class="mb20"></div>
            <button class="btn btn-success mr5"><i class="fa fa-user"></i> Follow</button>
            <button class="btn btn-white"><i class="fa fa-envelope-o"></i> Message</button>
         </div>
         <!-- profile-header -->
      </div>
      <!-- col-sm-9 -->
   </div>
   <!-- row -->
   <?php }  else { ?>
          <div class="alert alert-danger">
            <strong>Sorry!</strong>Please update Your Profile.
          </div>
   <?php } ?>
</div><!-- contentpanel -->
	
	
<!--cvcv-->

<script type="text/javascript">

//data table
$(document).ready(function(){
 
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