<style type="text/css">
	#table2
	{
	    width: 1090px !important;
	}
  .mt28
  {
    margin-top: 28px;
  }
</style>	
	<div class="pageheader">
		<h2><i class="fa fa-file"></i><?php echo $sel." Record"; ?><span>List</span></h2>
	</div>
				

	<div class="contentpanel">
	
	<!--searching-->
  	<div class="row">
			<div class="col-md-2">
        <label>From</label>
      <input type="text" name="from_date" class="form-control bill_datepicker from_date" placeholder="From Date" id="from_date">
      </div>
      <div class="col-md-2">
        <label>To</label>
        <input type="text" name="to_date" class="form-control bill_datepicker1 to_date" placeholder="To Date" id="to_date">
      </div>
      <div class="col-md-3">
        <label>Mobile Number</label>
          <input type="text" name="mobile_number" class="form-control mobile_number" placeholder="Mobile Number" id="mobile_number">
      </div>
      <div class="col-md-2">
          <button type="button" class="btn btn-success mt28 billing_searching">Search</button>
      </div>
		</div>
		<div class="clearfix mb30"></div>
		<!--searching-->

		<div class="row">
        <div class="table-responsive">
			<table class="table table2excel table-striped" id="table2">
					<thead>
						<tr>
							<th>S.No.</th>
							<th>Customer Name</th>
              <th>Mobile Number</th>
							<th>Total Amount (in <i class="fa fa-inr">)</i></th>
							<th>Date</th>
						</tr>
					</thead>
         
					<tbody id="mutisearchingTbody">
					
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
            url :"<?php echo base_url('billing/getallbillingAjax');?>",
            type: "post",  // method  , by default get
            error: function(){
              $(".table2-error").html("");
              $("#table2").append('<tbody class="table2-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
              $("#table2_processing").css("display","none");
              
            }
          }
         
    });



// Chosen Select
    jQuery("#table2_length select").chosen({
      'min-width': '100px',
      'white-space': 'nowrap',
      disable_search_threshold: 10
    });
    

 /*var table = $('#table2').DataTable();
  $('.mobile_number').on( 'keyup click', function () {
       table.search(
           $('.mobile_number').val()
       ).draw();
    });  */        

jQuery(".billing_searching").click(function(){
  var from_date = $(".from_date").val();
  var to_date = $(".to_date").val();
  var mobile_number = $(".mobile_number").val();
  if(mobile_number!="")
  {
    phonenumber(mobile_number);
      $.ajax({
          url:"<?php echo base_url('billing/searching'); ?>",
          type:"post",
          data: { mob_number: mobile_number,f_date:from_date,to_date:to_date},                    
            success: function(data)
            {
              var abc=JSON.parse(data);
              console.log(abc.length);
              if(abc.length>0)
              {
                var toAppend=""; var j=1;
                for (var i = 0;i < abc.length; i++) 
                {
                  var bill_url = '<?php echo base_url('billing/printings');?>/'+abc[i]['id'];
                  toAppend += "<tr role='row' class='odd'><td class='sorting_1'>"+j+"</td><td><a href="+bill_url+" targrt='_blank'>"+abc[i]['customer_name']+"</a></td><td>"+abc[i]['mobile_number']+"</td><td>"+abc[i]['order_amount']+"</td><td>"+abc[i]['order_date']+"</td></tr>";
                   j++;
                   $("#table2_info").html("Showing "+abc.length+" entries");
                }
              }
              else
              {
              toAppend = "<tr role='row' class='odd'><td colspan='5'>No Orders Found.</td></tr>";
              }
              $("#mutisearchingTbody").html("");
              $("#mutisearchingTbody").append(toAppend);
            }
          });
  }
  else
  {
    $.growl.error({title: "<i class='fa fa-times'> Sorry </i>", message: "Please Enter Mobile Number *required." });
  }

});


$('.bill_datepicker').datepicker({
    dateFormat: 'yy-mm-dd',
    onClose: function() {
            $(".bill_datepicker1").datepicker(
                    "change",
                    { minDate: new Date($('.bill_datepicker').val()) }
            );
        }
   });
$(".bill_datepicker1").datepicker({
      dateFormat: 'yy-mm-dd',
        onClose: function() {
            $(".bill_datepicker").datepicker(
                    "change",
                    { maxDate: new Date($('.bill_datepicker1').val()) }
            );
        }
    });

function phonenumber(inputtxt)  
{  
   if (/^\d{10}$/.test(inputtxt)) {
      return true;
  } else {
       $.growl.warning({title: "<i class='fa fa-times'> Sorry </i>", message: "Please Enter Valid Mobile Number *required." });
      number.focus()
      return false;
  } 
}  

});
</script>