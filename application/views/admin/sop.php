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
      <?php if($this->session->flashdata('status')=='error') { ?>
                <div id="msg_div1" class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <strong> </strong><?php echo $this->session->flashdata('msg');  ?>
                </div>
      <?php } ?>
    <div class="">
    </div>
  <div class="contentpanel">
		<div class="row">
        <div class="table-responsive">
          <table class="table table2excel" id="table2">
              <thead>
                 <tr>
                    <th>S.No.</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Days</th>
                    <th>Date</th>
                    <th>Action</th>
                 </tr>
              </thead>
             <tbody>
                 <?php  $count = 1;
				//print_r($this->data['result']); die;
                 foreach($result as $ar)
                    { ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td><?php echo $ar['title']; ?></td>
                            <td><?php echo $ar['sop_description']; ?></td>
                            <td><?php echo $ar['days']; ?></td>
                            <td><?php echo $ar['date']; ?></td>
                           <td>
                           <a href="<?php echo base_url();?>admin/update/<?php echo $ar['id'];?>"> <span class="glyphicon glyphicon-edit"></span></a>
						   <a class="deletesop" id='<?php echo $ar['id']; ?>'><span class="glyphicon glyphicon-trash"></span></a>
						   </td>
 
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
 
 
$(document).ready(function(){
   
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

 });

</script>


<script>

	//---------------
	$(document).on('click','.deletesop', function(){
	var id= $(this).attr('id');
          bootbox.confirm("Are You Sure You Want to Delete this entry?", function(result) {
            if(result == true)
                {
                $.ajax({
                    url:"<?php echo base_url(); ?>admin/deletesop",
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






$("#search_hotel_submit").click(function() 
{
    var url =  '<?php echo site_url(); ?>/gethotels.php';
    var city_code = $("#hidden_location").val();
    var chek_in= $("#check_in").val();
    var check_out= $("#check_out").val();
    var passenger= $("#guest").val();
    var someData = { "city_code": city_code,"arrival_date": chek_in,"leave_date": check_out,"number_people": passenger };

});




  //filter...
  $("#hotel_filter_button").click(function() {
    
    var url =  '<?php echo site_url(); ?>/gethotels_filter.php';
    var city_code = $("#hidden_location").val();
    var chek_in= $("#check_in").val();
    var check_out= $("#check_out").val();
    var passenger= $("#guest").val();
    var price_val = $("#amount").val();
    var amountSplit = price_val.split("-");
    var min_parse = amountSplit[0].replace ( /[^\d.]/g, '' ); 
        var minPrice = parseFloat(min_parse); 
    var max_parse = amountSplit[1].replace ( /[^\d.]/g, '' );
         var maxPrice = parseFloat(max_parse);
    var rating = $("input[name='star_rating']:checked").val(); console.log(rating);




    if(city_code!="")
    {
      $(".dynamiccontent").html("");
      var base_url = '<?php echo site_url(); ?>';
      $.ajax({
        type: "POST",
        url: url,
        dataType: "json",
        data: { city_code : city_code,arrival_date :chek_in,leave_date:check_out,number_people :passenger,minPrice:minPrice,maxPrice:maxPrice,rating:rating }, 
        beforeSend: function()
        {
          $('.loading').show();
          $('.loading_icon').show();
        },
        success: function(result)
        {
          $('.loading').hide();
          $('.loading_icon').hide();
          if(result.type=="fail")
          {
            var toAppend ="<img src='http://www.skicheap.com.au/wp-content/uploads/2017/04/sorry.jpg'>";
            $(".dynamiccontent").append(toAppend);
            $(".container").show();
            return false;
          }
          if(result != "")
          {
            if(result.hotelResultSet.length>0)
            {
              var toAppend = ""; var price_arr = []; var  markersData11 = new Array();
              for(var i=0;i<result.hotelResultSet.length;i++)
              {
                var new_arr = new Array();
                new_arr[0] = result.hotelResultSet[i]['hotel_name'];
                new_arr[1] = parseFloat(result.hotelResultSet[i]['latitude']);
                new_arr[2] = parseFloat(result.hotelResultSet[i]['longitude']);
                markersData11[i] = new_arr;
                
                
                var detail_url = base_url+"/detail?id="+result.hotelResultSet[i]['hotel_id'];
                if(result.hotelResultSet[i]['thumbnail']=="") 
                  var image = base_url+"/wp-content/uploads/2017/04/NoImage.png";
                else  var image = result.hotelResultSet[i]['thumbnail'];
                
                if(result.hotelResultSet[i]['stars']>0)
                {
                  var rat_star = "";
                  for(var j=1;j<=result.hotelResultSet[i]['stars'];j++)
                  {
                    rat_star+= "<i class='fa fa-star'></i>";
                  }
                }
                else
                  rat_star = "";
                
                price_arr[i] = result.hotelResultSet[i]['max_rate']['amount'];
                toAppend +="<div class='well well-lg' style='height:228px'><div class='col-sm-4'><a href="+detail_url+"><img src='"+image+"' class='img-rounded my_hotel_image' alt='Cinque Terre' width='206' height='150'></a></div><div class='col-sm-4'><a href="+detail_url+"><h5>"+result.hotelResultSet[i]['hotel_name']+"<small><br></small></h5></a><h6 style='font-size: 12px;'>"+rat_star+"</h6><p><a class='show_marker' main="+parseFloat(result.hotelResultSet[i]['latitude'])+" main1="+parseFloat(result.hotelResultSet[i]['longitude'])+" main2='"+result.hotelResultSet[i]['hotel_name']+"' href='javascript:void(0)'><i class='fa fa-map-marker'></i>&nbsp;&nbsp;Show On Map</a></p></div><div class='col-sm-4'><h4 class='text-danger'>"+result.hotelResultSet[i]['max_rate']['amount']+"AUD</h4><h6 style='font-size: 12px;'></h6><h6 style='font-size: 12px;'>With Shared Bathroom<br> non-refundable<br>Breakfast<br><br></h6><p><button class='btn btn-success btn-block'>Book Now</button></p></div></div>";
              }
                var max_price = Math.max.apply(Math,price_arr); 
                var min_price = Math.min.apply(Math,price_arr);
                locations = markersData11;
                google_map(locations);
                $("#slider-range").slider("destroy");
                reinitilize_slider(parseFloat(min_price),parseFloat(max_price));
                $(".dynamiccontent").append(toAppend);
                $(".container").show();
            }
          }
          else
          {
            console.log("sorry");
          }
        }
        }); 
    }
    });


function callMethod()
{
  if(city_code!="")
  {
      $(".dynamiccontent").html("");
      var base_url = '<?php echo site_url(); ?>';
       $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: { city_code : city_code,arrival_date :chek_in,leave_date:check_out,number_people :passenger }, 
            beforeSend: function()
            {
                $('.loading').show();
                $('.loading_icon').show();
            },
            success: function(result)
            {
                $('.loading').hide();
                $('.loading_icon').hide();
                if(result.type=="fail")
                {
                  var toAppend ="<img src='http://www.skicheap.com.au/wp-content/uploads/2017/04/sorry.jpg'>";
                  $(".dynamiccontent").append(toAppend);
                  $(".container").show();
                  return false;
                }
        
                if(result != "")
                {
                  if(result.hotelResultSet.length>0)
                  {
                    var toAppend = ""; var price_arr = [];  var  markersData11 = new Array(); 
                    for(var i=0;i<result.hotelResultSet.length;i++)
                              {
                      var new_arr = new Array();
                      new_arr[0] = result.hotelResultSet[i]['hotel_name'];
                      new_arr[1] = parseFloat(result.hotelResultSet[i]['latitude']);
                      new_arr[2] = parseFloat(result.hotelResultSet[i]['longitude']);
                      markersData11[i] = new_arr;
                      var detail_url = base_url+"/detail?id="+result.hotelResultSet[i]['hotel_id'];
                      if(result.hotelResultSet[i]['thumbnail']=="") 
                        var image = base_url+"/wp-content/uploads/2017/04/NoImage.png";
                      else  var image = result.hotelResultSet[i]['thumbnail'];
                      
                      if(result.hotelResultSet[i]['stars']>0)
                      {
                        var rat_star = "";
                        for(var j=1;j<=result.hotelResultSet[i]['stars'];j++)
                        {
                          rat_star+= "<i class='fa fa-star'></i>";
                        }
                      }
                      else
                        rat_star = "";
                      
                      //console.log(rat_star);
                      price_arr[i] = result.hotelResultSet[i]['max_rate']['amount'];
                      toAppend +="<div class='well well-lg' style='height:228px'><div class='col-sm-4'><a href="+detail_url+"><img src='"+image+"' class='img-rounded my_hotel_image' alt='Cinque Terre' width='206' height='150'></a></div><div class='col-sm-4'><a href="+detail_url+"><h5>"+result.hotelResultSet[i]['hotel_name']+"<small><br></small></h5></a><h6 style='font-size: 12px;'>"+rat_star+"</h6><p><a class='show_marker' main="+parseFloat(result.hotelResultSet[i]['latitude'])+" main1="+parseFloat(result.hotelResultSet[i]['longitude'])+" main2='"+result.hotelResultSet[i]['hotel_name']+"' href='javascript:void(0)'><i class='fa fa-map-marker'></i>&nbsp;&nbsp;Show On Map</a></p></div><div class='col-sm-4'><h4 class='text-danger'>"+result.hotelResultSet[i]['max_rate']['amount']+"AUD</h4><h6 style='font-size: 12px;'></h6><h6 style='font-size: 12px;'>With Shared Bathroom<br> non-refundable<br>Breakfast<br><br></h6><p><button class='btn btn-success btn-block'>Book Now</button></p></div></div>";
                    }
                      var max_price = Math.max.apply(Math,price_arr); 
                      var min_price = Math.min.apply(Math,price_arr);
                      locations = markersData11;
                      console.log(locations);google_map(locations);
                      $("#slider-range").slider("destroy");
                      reinitilize_slider(parseFloat(min_price),parseFloat(max_price));
                      $(".dynamiccontent").append(toAppend);
                      $(".container").show();
                  }
                  else
                  {
                      toAppend +="<span>No Hotel Available</span>";
                      $(".dynamiccontent").append(toAppend);
                      $(".container").show();
                  }
              }
              else
              {
                  console.log("sorry");
              }

            }
          }); 
     }
}
</script>
