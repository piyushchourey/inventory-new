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
.p1
{
  padding-bottom: 8px;
}
.pddesc
{
  width: 5%;
}
</style>
<div class="pageheader">
    <h2><i class="fa fa-list"></i>Edit<span>List</span></h2>
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
      </div>
		<div class="row">
      <form id="addProduct" action="<?php echo base_url('product/create');?>" class="form-horizontal" method="post" enctype="multipart/form-data">
          <div class="panel panel-success">
              <div class="panel-heading">
                <div class="panel-btns">
                  <a href="#" class="panel-close">×</a>
                  <a href="#" class="minimize">−</a>
                </div>
                <h4 class="panel-title">Edit Product</h4>
              </div>
              <div class="panel-body">
             	<div class="row">
                <div class="col-sm-3">
                    <div class="form-group no_margin">
                      <label class="control-label">Product Name</label>
                      <input type="text" name="name" class="form-control" placeholder="Product Name" value="<?php if(!empty($result) && !empty($result[0]) && $result[0]['name']!="") { echo $result[0]['name']; } ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group no_margin">
                      <label class="control-label">Price</label>
                      <input type="number" name="price" class="form-control spinner" placeholder="Price" value="<?php if(!empty($result) && !empty($result[0]) && $result[0]['price']!="") { echo $result[0]['price']; } ?>">
                    </div>
                </div>
                 <!-- col-sm-4 -->
                 <div class="col-sm-3">
                    <div class="form-group no_margin">
                      <label class="control-label">Quantity</label>
                      <input type="number" name="qty" class="form-control spinner" placeholder="Quantity" value="<?php if(!empty($result) && !empty($result[0]) && $result[0]['price']!="") { echo $result[0]['qty']; } ?>">
                    </div>
                </div>
                 <!-- col-sm-4 -->
                <div class="col-sm-3">
                    <div class="form-group no_margin">
                      <label class="control-label">Date</label>
                      <input type="text" name="created_date" class="form-control datepicker" placeholder="Select Date" value="<?php if(!empty($result) && !empty($result[0]) && $result[0]['price']!="") { echo $result[0]['created_date']; } ?>">
                    </div>
                </div>
              </div><!-- row -->



           	</div><!-- panel-body -->
              <div class="panel-footer">
                <div class="row">
                  <div class="col-sm-9 col-sm-offset-3">
                    <button class="btn btn-success">Update</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                  </div>
                </div>
              </div>
          </div><!-- panel -->
      </form>
      </div><!--row-->
	</div><!-- contentpanel -->
	 





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

//get model according to brand... 
 $(document).on("click",".subcat",function() {
  var selectedCat = $(this).parent().prev().find(".category option:selected").val();
      if($(this).attr('main') == 1)
      {
        $(".subcatAdd").html("");
      }
    var level = $(this).parent().prev().find(".category").attr("subcategorylevel");
    console.log(level);
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

    //var selectedCat = $(".category option:selected").val();
		//alert(selectedCat);
      if(selectedCat!="")
        {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('product/getSubcat');?>",
                data: { catId : selectedCat } 
            }).done(function(result){
              if(result!="")
              { 
                //console.log(result);
                var abc=JSON.parse(result);
                if(abc.length > 0)
                {
                    var toAppend = "<div class='row category-container p1 r"+selectedCat+"'><div class='col-sm-5'><select class='form-control category' subcategorylevel='"+level+"' name='category_id'><option value=''>Select Category</option>"
                    for(var i=0;i<abc.length;i++)
                    {
                        toAppend += '<option value='+abc[i]['id']+'>'+abc[i]['name']+'</option>';
                    }
                    toAppend +="</select></div><div class='col-md-1 pddesc'><button type='button' class='btn btn-success subcat btn-sm' main=''><i class='fa fa-arrow-down'></i></button></div><div class='col-md-1 pddesc'><button type='button' class='btn btn-danger remove btn-sm' main='"+selectedCat+"'><i class='fa fa-arrow-up'></i></button></div></div>";
                    //console.log(toAppend);
                    $(".dynamicSubcat").append(toAppend);
                }
                else
                {
                  $.growl.error({title: "<i class='fa fa-check'> Sorry </i>", message: "No Subcategory available!!!" });
                }
              }
            });
        }
    });

$(document).on("change",".category",function() {  return;
    if($(this).attr('main') == 1)
      {
        $(".subcatAdd").html("");
      }
    level = $(this).attr("subcategorylevel");
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
      var selectedCat = $(this).val();
      if(selectedCat!="")
        {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('product/getSubcat');?>",
                data: { catId : selectedCat } 
            }).done(function(result){
              if(result!="")
              { 
                //console.log(result);
                var abc=JSON.parse(result);
                if(abc.length > 0)
                {
                    var toAppend = "<div class='row category-container p1 r"+selectedCat+"'><div class='col-sm-5'><select class='form-control category' subcategorylevel='"+level+"' name='category_id'><option value=''>Select Category</option>"
                    for(var i=0;i<abc.length;i++)
                    {
                        toAppend += '<option value='+abc[i]['id']+'>'+abc[i]['name']+'</option>';
                    }
                    toAppend +="</select></div><div class='col-md-1 pddesc'><button type='button' class='btn btn-success subcat btn-sm' main=''><i class='fa fa-arrow-down'></i></button></div><div class='col-md-1 pddesc'><button type='button' class='btn btn-danger remove btn-sm' main='"+selectedCat+"'><i class='fa fa-arrow-up'></i></button></div></div>";
                    //console.log(toAppend);
                    $(".dynamicSubcat").append(toAppend);
                }
              }
            });
        }
    });

$(document).on("click",".remove",function() {
    $(this).parent().parent().nextAll().remove();
    var rid = $(this).attr("main");
    $(".r"+rid).remove();
   });

});

</script>
<script type="text/javascript">
$(document).ready(function(){
  var form_object = jQuery("#addProduct"); 
  form_object.validate({
    rules: {
            category_id: {
                  required: true,
            },
            name: {
                  required: true,
            },
            price: {
                  required: true,
                  number: true
            },
            qty: {
                  required: true,
                  number: true
            },
			      created_date: {
                  required: true,
            }
           }
  });


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
<style type="text/css">
  .ui-spinner
  {
        display: block !important;
  }
</style>