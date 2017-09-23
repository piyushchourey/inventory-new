<link href="<?php echo base_url(); ?>css/carousle/carousle.css" rel="stylesheet">
<style type="text/css">
  .modal{
    overflow-y: auto !important;
  }
  .edit,.view
  {
    border-radius: 50%;
    height: 25px;
    width: 25px;
    text-align: center;
    padding: 2px 0px;
  }
  .delete
  {
    border-radius: 50%;
    height: 25px;
    width: 25px;
    text-align: center;
    padding: 2px 0px;
  }
 .approve
  {
    border-radius: 50%;
    height: 25px;
    width: 25px;
    text-align: center;
    padding: 2px 0px;
  }
.no_margin{
    margin-left: 0px !important;
    margin-right: 0px !important;
    margin-bottom: 7px !important;
}
.table2excel{
  width:1090px !important;
}
.modal {
    overflow-y: hidden !important;
}
</style>
<div class="pageheader">
      <h2><i class="fa fa-list"></i><?php echo $sel; ?><span>List</span></h2>
      <a style="margin-top:-40px;" class="btn btn-success pull-right" href="<?php echo base_url('admin/addSop');?>"  id="add">Create</a>
</div>
      <?php if($this->session->flashdata('result')=='true') { ?>
                <div id="msg_div1" class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <strong> </strong><?php echo $this->session->flashdata('msg');  ?>
                </div>
      <?php } ?>
    <div class="">
      <div class="col-md-4 col-md-offset-4">
        <div class="alert alert-success" id="success123" role="alert" style="display:none;">
            <strong>Well done!</strong> You successfully Approve.
         </div>
      </div>
      <div class="col-md-4 col-md-offset-4">
        <div class="alert alert-danger" id="error123" role="alert" style="display:none;">
            <strong>Oh snap!</strong> You successfully Disapprove.
        </div>
      </div>
    </div>
  <div class="contentpanel">
		<div class="row">
        <div class="table-responsive">
          <table class="table table2excel" id="table2">
              <thead>
                 <tr>
                    <th>S.No.</th>
                    <th>NAME</th>
                    <th>delete</th>
                    <th>update</th>
                 </tr>
              </thead>
             <tbody>
                 <?php  $count = 1;
				//print_r($this->data['result']); die;
                 foreach($result as $ar)
                    { ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td><?php echo $ar['name']; ?></td>
                           <td><button class="deletesopname" id='<?php echo $ar['id']; ?>'><span class="glyphicon glyphicon-trash"></span></button></td>
							
                        </tr>
                <?php  } ?>
             </tbody>
           </table>
          </div><!-- table-responsive -->

		</div><!--row-->
	</div><!-- contentpanel -->


  <!-- Modal -->
  <form id="basicForm" action="" class="form-horizontal" method="post" enctype="multipart/form-data">
  <div class="modal bs-example-modal-lg fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2>Store Information</h2>
          <div class="row">
          <div class="col-lg-6">
            <h3 id="title"></h3>
          <hr>
          <h1 class="pricetag"></h1>
          <span class="info-row"> <span class="date"><i class=" icon-clock"> </i></span> - 
          <span class="category"> </span> 
          <span class="item-location"><i class="fa fa-map-marker location"></i>&nbsp;</span> </span>
            <div id="carouselHacked" class="carousel decor slide carousel-fade" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">

                </div>
               <!-- Thumbnails --> 
            <ul id="li_thumbnail" class="thumbnails-carousel list-inline ">
            <!--<li><img src="http://placehold.it/100x100" class="deco-img" alt="1_tn.jpg"></li>
            <li><img src="http://s27.postimg.org/n4fjr7q2n/2_tn.jpg" alt="1_tn.jpg"></li>
            <li><img src="http://s29.postimg.org/afuhmf61f/3_tn.jpg" alt="1_tn.jpg"></li>-->
            </ul>
            </div>
            <h5 class="list-title"><strong>Description</strong></h5>
            <p id="description"> </p>

          </div>

          <div class="col-lg-6">
          <br>
          <br>
          <div class="row">
              <div class="col-lg-8">
                <aside class="panel panel-body panel-details">
                  <ul>
                      <li>
                          <p class=" no-margin "><strong>Discount: </strong><span id="discount"> </span> </p>
                      </li>
                      <li>
                          <p class="no-margin"><strong>Country: </strong> <span id="country"> </span></p>
                      </li>
                      <li>
                          <p class="no-margin"><strong>State: </strong> <span id="state"> </span> </p>
                      </li>
                      <li>
                          <p class=" no-margin "><strong>City: </strong> <span id="city"> </span></p>
                      </li>
                      <li>
                          <p class="no-margin"><strong>Locality: </strong> <span id="locality"> </span></p>
                      </li>
                  </ul>
            </aside>
            </div>
            </div>
          <h3>Store Owner information</h3>
          <div class="">
                <img src="<?php echo base_url('images/admin/user1.png'); ?>" class="img-responsive" height="100px" width="100px" alt="...">
                <div class="caption">
                  <h3>Name label</h3>
                  <p>Name: <span id="contactName"></span></p>
                  <p>Phone: <span id="phone_no"></span></p>
                  <p>Email: <span id="email"></span></p>
                  <p>Address: <span id="city11"></span></p>
              </div>
          </div>
            
          </div>
          </div>
        </div>
        
      </div>
      
    </div>
  </div>
</form>
<!-- Modal -->




<script type="text/javascript">
$(document).ready(function(){
     $('#table2').dataTable({
     "sPaginationType": "full_numbers",
      "processing": true,
          "serverSide": true,
          "ajax":{
            url :"<?php echo base_url('upload/getallStoreAjax');?>",
            type: "post",  // method  , by default get
            error: function(){
              $(".table2-error").html("");
              $("#table2").append('<tbody class="table2-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
              $("#table2_processing").css("display","none");
              
            }
          },
          "aoColumnDefs":[
            {
              "aTargets":[6],
              "mData":"fgdfg",
              "bSortable":false,
               "mRender": function ( data, type, full ) {
                var result="";
                 if(full[7]==1){
                    result='<button class="btn btn-info btn-icon btn-circle btn-sm approve"><i class="fa fa-thumbs-o-up"></i></button>';
                  }
                  else{
                    result='<button class="btn btn-warning btn-icon btn-circle btn-sm approve"><i class="fa fa-thumbs-down"></i></button>';
                  }

                result +=  '&nbsp;<button data-toggle="modal" data-target="#myModal" class="btn btn-success btn-icon btn-circle btn-sm view"><i class="fa fa-eye"></i></button>&nbsp;<button class="btn btn-danger btn-icon btn-circle btn-sm delete"><i class="fa fa-trash-o"></i></button>';
        return result;
      }
            },
             {
              "aTargets":[0],
              "bSortable":false
                         }
          ]
         
    });
    
    var table = $('#table2').DataTable();
    $('#table2 tbody').on( 'click', '.approve', function(){
        var data = table.row($(this).parents('tr')).data();
        var id = data[6];
          $.ajax({
          url:"<?php echo base_url('upload/approve'); ?>",
          type:"post",
          data:"id="+id,                    
          success: function(data){
            //alert(data);
              if(data=="2")
              {
                  $("#success123").css("display", "block");
                  $("#error123").css("display", "none");
                  table.ajax.reload();
                  $('.alert-success').fadeOut(2000);
              }
              else
              {
                  $("#error123").css("display", "block");
                  $("#success123").css("display", "none");
                  table.ajax.reload();
                  $('.alert-danger').fadeOut(2000);
              }
          }
        });
    }); 
    
     var table = $('#table2').DataTable();
    $('#table2 tbody').on( 'click', '.view', function(){
        var data = table.row($(this).parents('tr')).data();
        var id = data[6];
        //alert(id);
            $.ajax({
            type: "POST",
            url: "<?php echo base_url('upload/ViewStore');?>",
            data: { id : id },                    
            success: function(result)
            {
             console.log(result);
              if(result != "")
              {
                jQuery.getScript('<?php echo base_url('js/carousle/carousle.js'); ?>');
                var obj = jQuery.parseJSON(result);
                var baseurl = "<?php echo base_url(); ?>files/";
                var storeName = obj['store_info']['storeName'];
                var MainstoreName = storeName.substr(0, 1).toUpperCase() + storeName.substr(1);
                
                var contry_nm = obj['store_info']['cname'];
                var contryName = contry_nm.substr(0, 1).toUpperCase() + contry_nm.substr(1);
                
                var fromDate = new Date(obj['store_info']['fromDate']).toUTCString();
                var toDate = new Date(obj['store_info']['toDate']).toUTCString();

                var desc = obj['store_info']['description'];
                var description = desc.substr(0, 1).toUpperCase() + desc.substr(1);

                var sname = obj['store_info']['sname'];
                var sttenm = sname.substr(0, 1).toUpperCase() + sname.substr(1);

                var city = obj['store_info']['ctname'];
                var city1 = city.substr(0, 1).toUpperCase() + city.substr(1);
                
                var lname = obj['store_info']['lname'];
                var locality_nm = lname.substr(0, 1).toUpperCase() + lname.substr(1);

                var ownerName = obj['store_info']['ownerName'];
                var contact_Name = ownerName.substr(0, 1).toUpperCase() + ownerName.substr(1);

                var phone_no = obj['store_info']['phone_no'];
                var discount = obj['store_info']['discount'];
                var email = obj['store_info']['email'];
                var contact_email = email.substr(0, 1).toUpperCase() + email.substr(1);

                $("#title").html(MainstoreName);
                $("#country").html(contryName);
                $("#state").html(sttenm);
                $("#discount").html(discount);
                $("#city").html(city1);
                $("#description").html(description);
                $("#locality").html(locality_nm);
                $(".date").html(fromDate); 
               // $("#price").html(price);
                //$("#city").html(city1);
                //$("#type").html(categoryName);
                //$("#brands").html(Maintitle);
                $("#contactName").html(contact_Name);
                $("#phone_no").html(phone_no);
                $("#email").html(contact_email);
                //alert(obj['image'].length);
                toappend =""; toappend1="";
                for(var i=0;i<obj['image'].length;i++)
                  {
                    if(i==0)
                    {
                      toappend += "<div class='item active'>"+
                            "<img src='"+obj['image'][i]['Address']+"' alt='2.jpg' height='350px' width='350px' class='img-responsive'>"+
                        "</div>";
                      toappend1 += "<li><img src='"+obj['image'][i]['Address']+"' height='48px' width='48px' alt='1_tn.jpg'></li>";
                     }
                    else{
                      toappend += "<div class='item'>"+
                            "<img src='"+obj['image'][i]['Address']+"' alt='2.jpg' height='350px' width='350px' class='img-responsive'>"+
                        "</div>";
                      toappend1 += "<li><img src='"+obj['image'][i]['Address']+"' height='48px' width='48px' alt='1_tn.jpg'></li>";
                    }
                  }
                  $(".carousel-inner").html(toappend);
                  $("#li_thumbnail").html(toappend1);
             }
            }
          }); 
});
  
  $('#table2 tbody').on( 'click', '.delete', function(){
        var data = table.row($(this).parents('tr')).data();
        var id = data[6];
        bootbox.confirm("Are You Sure You Want to Delete this Store?", function(result) {
            if(result == true)
                {
                $.ajax({
                    url:"<?php echo base_url(); ?>upload/deleteStore",
                    type:"post",
                    data:"id="+id,                    
                    success: function(data){
                         table.ajax.reload();
                    }
                  });
                }
            else if(result == false)
                {

                }
          });
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
<script type="text/javascript">
        //form submit using ajax
    
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
                //console.log(result);
               // var obj = jQuery.parseJSON(result);
               // var name = obj[0]['name'];
               // $("#name").attr('value',name);
                // $("#city_id option[value='"+obj[0]['city_id']+"']").attr('selected','selected');
              //  $("#id1").attr('value',id);
              }
              else
              {
               //  $("#error123").css("display", "block");
                // $('.alert-danger').fadeOut(5000);
              }

            }
          }); 
     });
});
</script>
<script>

	//---------------
	$(document).on('click','.deletesopname', function(){
	var id= $(this).attr('id');
          bootbox.confirm("Are You Sure You Want to Delete this entry?", function(result) {
            if(result == true)
                {
                $.ajax({
                    url:"<?php echo base_url(); ?>admin/deletesopname",
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
});
	
	
	//---------------




</script>