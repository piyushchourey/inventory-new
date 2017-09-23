
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
     <form id="fileupload" action="<?php echo base_url('');?>" class="form-horizontal" method="post" enctype="multipart/form-data">
          <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-btns">
                  <a href="#" class="panel-close">×</a>
                  <a href="#" class="minimize">−</a>
                </div>
                <h4 class="panel-title">Add Product Description</h4>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <div class="">
                    <textarea>abc</textarea>
                  </div>
              </div>
            </div><!-- panel-body -->

             <!-- end code --> 
              <div class="panel-footer">
                <div class="row">
                  <div class="col-sm-9 col-sm-offset-3">
                    <button class="btn btn-success">Add</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                  </div>
                </div>
              </div>
          </div><!-- panel -->
      </form>
      </div><!--row-->
	</div><!-- contentpanel -->

<script type="text/javascript">
$(document).ready(function(){
//ajax for update category..
$(".edit").click(function() 
{
  $("#popuptitle").html("Edit");
  $("#dynamicbtn").html("update");
  var id=$(this).attr('myval');
  //alert(id);
  $.ajax({
            type: "POST",
            url: "<?php echo base_url('country/getUpdatedata/locality');?>",
            data: { id : id },                    
            success: function(result)
            {
              if(result != "")
              {
                var obj = jQuery.parseJSON(result);
                var name = obj[0]['name'];
                $("#name").attr('value',name);
                $("#city_id option[value='"+obj[0]['city_id']+"']").attr('selected','selected');
                $("#id1").attr('value',id);
              }
              else
              {
                 $("#error123").css("display", "block");
                 $('.alert-danger').fadeOut(5000);
              }

            }
          }); 
  });
});
</script>
<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
<script>tinymce.init({selector:'textarea'});</script>