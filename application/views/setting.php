

<section>
 
        
    <div class="pageheader">
      <h2><i class="fa fa-pencil"></i>Edit Setting<span></span></h2>
      
    </div>
    
    <div class="contentpanel">
      <?php  if(sizeof($posts)==0)
					{
			  ?>
	  <div class="row">
        
        <div class="col-md-6">
          <form id="basicForm" action="<?php echo base_url(); ?>admin/setting/insert" class="form-horizontal" enctype='multipart/form-data' method="post">
		 
          <div class="panel panel-default">
             
			  
			
              <div class="panel-body">
			  	<div class="form-group">
                  <label class="col-sm-3 control-label">Username: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
				      <input type="checkbox" id="username" name="username" value="1" class="form-control" placeholder="Type a password.."  />
                
                  </div>
                </div>
			   <div class="form-group">
                  <label class="col-sm-3 control-label">User Groups: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
				      <input type="checkbox" name="groupid" id="groupid" value="1" class="form-control" placeholder="Type a password.." />
                
                  </div>
                </div>
               
                <div class="form-group">
                  <label class="col-sm-3 control-label">Password : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="password" value="1" class="form-control" placeholder="Type a password.."  />
                  </div>
                </div>
				    <div class="form-group">
                  <label class="col-sm-3 control-label">Enable user : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
              
                      <input type="Checkbox" class="form-control" value="1"  id="vip" name="enableuser" />
                      
                      
					  
                 
                  </div>
                </div>
                  <div class="form-group">
                  <label class="col-sm-3 control-label">Up limit : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="uplimit" value="1" class="form-control" placeholder="Type your up limit. ..." required />
                  </div>
                </div>
                  <div class="form-group">
                  <label class="col-sm-3 control-label">Down limit <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="downlimit" value="1" class="form-control" placeholder="Type your down limit..." required />
                  </div>
                </div>

				  <div class="form-group">
                  <label class="col-sm-3 control-label">Comblimit: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
				   <input type="checkbox" name="comblimit" value="1" class="form-control" placeholder="Type your comblimit..." required />
                    
                  </div>
                </div>
				  <div class="form-group">
                  <label class="col-sm-3 control-label">First Name: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
				   <input type="checkbox" name="firstname" value="1" class="form-control" placeholder="Type your first name..." required />
                    
                  </div>
                </div>
				    <div class="form-group">
                  <label class="col-sm-3 control-label">Last Name: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
				   <input type="checkbox" name="lastname" value="1" class="form-control" placeholder="Type your lastname..."  />
                    
                  </div>
                </div>
                  <div class="form-group">
                  <label class="col-sm-3 control-label">Company: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="company" value="1"class="form-control" placeholder="Type your company..." />
                  </div>
                </div>
                  <div class="form-group">
                  <label class="col-sm-3 control-label">Phone : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="phone" value="1" class="form-control" placeholder="Type your phone.." />
                  </div>
                </div>
                  <div class="form-group">
                  <label class="col-sm-3 control-label">Mobile : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="mobile" value="1" class="form-control" placeholder="Type your mobile."  />
                  </div>
                </div>
                  <div class="form-group">
                  <label class="col-sm-3 control-label">Address: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="address" value="1" class="form-control" placeholder="Type your address."  />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Country: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="country" value="1" class="form-control" placeholder="Type your country." />
                  </div>
                </div><div class="form-group">
                  <label class="col-sm-3 control-label">State: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="state" value="1" class="form-control" placeholder="Type your state."  />
                  </div>
                </div>
                 <div class="form-group">
                  <label class="col-sm-3 control-label">City: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="city" value="1" class="form-control" placeholder="Type your city." />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Zip: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="zip" value="1" class="form-control" placeholder="Type your zip." />
                  </div>
                </div>
				 <div class="form-group">
                  <label class="col-sm-3 control-label">Comment: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="comment" value="1" class="form-control" placeholder="Type your comment."  />
                  </div>
                </div> <div class="form-group">
                  <label class="col-sm-3 control-label">Gpslat: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="gpslat" value="1" class="form-control" placeholder="Type your gpslat."  />
                  </div>
                </div> <div class="form-group">
                  <label class="col-sm-3 control-label">Gpslong: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="gpslong" value="1" class="form-control" placeholder="Type your city."  />
                  </div>
                </div> <div class="form-group">
                  <label class="col-sm-3 control-label">MAC: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="mac" value="1" class="form-control" placeholder="Type your mac." />
                  </div>
                </div> 
				<div class="form-group">
                  <label class="col-sm-3 control-label">Usemacauth: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="usemacauth" value="1" class="form-control" placeholder="Type your usemacauth." />
                  </div>
                </div>
								<div class="form-group">
                  <label class="col-sm-3 control-label">Expiration: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="expiration" value="1" class="form-control" placeholder="Type your expiration."  />
                  </div>
                </div>				
				<div class="form-group">
                  <label class="col-sm-3 control-label">Uptime limit: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="uptimelimit" value="1" class="form-control" placeholder="Type your uptimelimit."  />
                  </div>
                </div>				
				<div class="form-group">
                  <label class="col-sm-3 control-label">Srvid: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="srvid" value="1" class="form-control" placeholder="Type your srvid."  />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Static ipcm: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="staticipcm" value="1" class="form-control" placeholder="Type your staticipcm."/>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Static ipcpe: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="staticipcpe" value="1" class="form-control" placeholder="Type your staticipcpe." />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Ipmodecm: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="ipmodecm" value="1" class="form-control" placeholder="Type your ipmodecm."  />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Ipmodecpe: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="ipmodecpe" value="1" class="form-control" placeholder="Type your ipmodecpe" ></div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Poolidcm: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="poolidcm" value="1" class="form-control" placeholder="Type your poolidcm." >
                  </div>
                </div>
                
              </div><!-- panel-body -->
            
          </div><!-- panel -->
        
          
          
        </div><!-- col-md-6 -->
        
        <div class="col-md-6">
      
          <div class="panel panel-default">
              <div class="panel-body">
                <div class="error"></div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Poolidcpe : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="poolidcpe" value="1" class="form-control" placeholder="Type your poolidcpe..." />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Createdon : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="createdon" value="1" class="form-control" placeholder="Type your createdon..." />
                  </div>
                </div>
                  <div class="form-group">
                  <label class="col-sm-3 control-label">Acctype: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="acctype" value="1" class="form-control" placeholder="Type your acctype..."  />
                  </div>
                </div>
                  <div class="form-group">
                  <label class="col-sm-3 control-label">Credits : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="credits" value="1" class="form-control" placeholder="credits"  />
                  </div>
                </div>
                  <div class="form-group">
                  <label class="col-sm-3 control-label">Cardfails : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="cardfails" value="1" class="form-control" placeholder="cardfails"  />
                  </div>
                </div> 
				<div class="form-group">
                  <label class="col-sm-3 control-label">Createdby : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="createdby" value="1" class="form-control" placeholder="createdby"  />
                  </div>
                </div>  
				<div class="form-group">
                  <label class="col-sm-3 control-label">Owner: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="owner" value="1" class="form-control" placeholder="owner"  />
                  </div>
                </div>  <div class="form-group">
                  <label class="col-sm-3 control-label">Taxid : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="taxid" value="1" class="form-control" placeholder="taxid" />
                  </div>
                </div>  <div class="form-group">
                  <label class="col-sm-3 control-label">Email Id: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="email" value="1" class="form-control" placeholder="email"/>
                  </div>
                </div>  <div class="form-group">
                  <label class="col-sm-3 control-label">Maccm : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="maccm" value="1" class="form-control" placeholder="maccm"  />
                  </div>
                </div>  <div class="form-group">
                  <label class="col-sm-3 control-label">Custattr : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="custattr" value="1" class="form-control" placeholder="custattr"/>
                  </div>
                </div>  <div class="form-group">
                  <label class="col-sm-3 control-label">Warningsent : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="warningsent" value="1>" class="form-control" placeholder="warningsent"/>
                  </div>
                </div>  <div class="form-group">
                  <label class="col-sm-3 control-label">Verifycode: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="verifycode" value="1" class="form-control" placeholder="verifycode" />
                  </div>
                </div> 
				<div class="form-group">
                  <label class="col-sm-3 control-label">Verified : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="verified" value="1" class="form-control" placeholder="verified"  />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Selfreg : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="selfreg" value="1" class="form-control" placeholder="selfreg"/>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Verifyfails : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="verifyfails" value="1" class="form-control" placeholder="verifyfails"  />
                  </div>
                </div>				
				<div class="form-group">
                  <label class="col-sm-3 control-label">Verifysentnum : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="verifysentnum" value="1" class="form-control" placeholder="verifysentnum" />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Verifymobile: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="verifymobile" value="1" class="form-control" placeholder="verifymobile"  />
                  </div>
                </div>	
				<div class="form-group">
                  <label class="col-sm-3 control-label">Contractid: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="contractid" value="1" class="form-control" placeholder="contractid" />
                  </div>
                </div>	
				<div class="form-group">
                  <label class="col-sm-3 control-label">Actcode: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="actcode" value="1" class="form-control" placeholder="actcode"  />
                  </div>
                </div>	
				<div class="form-group">
                  <label class="col-sm-3 control-label">Pswactsmsnum: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="pswactsmsnum" value="1" class="form-control" placeholder="pswactsmsnum"  />
                  </div>
                </div>	
				<div class="form-group">
                  <label class="col-sm-3 control-label">id Proof type : </label>
                  <div class="col-sm-9">
				   <input type="checkbox" name="id_type" value="1" class="form-control" placeholder="pswactsmsnum"  />
				
             
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Id Proof No: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="id_no" value="1" class="form-control" placeholder="id_no"  />
                  </div>
                </div>	
				<div class="form-group">
                  <label class="col-sm-3 control-label">Id Proof Image: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="id_path" value="1" class="form-control" placeholder="id_no"  />
                  </div>
                </div>
				
				<div class="form-group">
                  <label class="col-sm-3 control-label">Address Proof type : </label>
                  <div class="col-sm-9">
				   <input type="checkbox" name="address_type" value="1" class="form-control" placeholder="id_no"  />
				
             
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Address Proof No: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="address_no" value="1" class="form-control" placeholder="address no"/>
                  </div>
                </div>	
				<div class="form-group">
                  <label class="col-sm-3 control-label">Address Proof Image: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="address_path" value="1" class="form-control" placeholder="id_no"  />
                  </div>
                </div>
					<div class="form-group">
                  <label class="col-sm-3 control-label">Photo: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="photo_path" value="1" class="form-control" placeholder="id_no"  />
                  </div>
                </div>
								
              
              <!-- form-group -->

			
              </div><!-- panel-body -->
              <div class="panel-footer">
                <div class="row">
                  <div class="col-sm-9 col-sm-offset-3">
                    <button class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                  </div>
                </div>
              </div>
            
          </div><!-- panel -->
          </form>
          
        </div><!-- col-md-6 -->
        
      </div><!--row -->
	  
	  <?php } ?>
	  
	  
	  
	  
	  
	   <?php   foreach($posts as $data)
					{
						$value=explode(",",$data->colum);
						$size=sizeof($value);
						$value[$size]=$value[0];
						$value[0]='null';
					
					?>
      <div class="row">
        
        <div class="col-md-6">
          <form id="basicForm" action="<?php echo base_url(); ?>admin/setting/update" class="form-horizontal" enctype='multipart/form-data' method="post">
		 
          <div class="panel panel-default">
              
			 
			
              <div class="panel-body">
			  	<div class="form-group">
                  <label class="col-sm-3 control-label">Username: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
				      <input type="checkbox" id="username" name="username" value="1" class="form-control" placeholder="Type a password.."  <?php if(array_search("username",$value)) { echo 'checked'; } ?> />
                
                  </div>
                </div>
			   <div class="form-group">
                  <label class="col-sm-3 control-label">User Groups: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
				      <input type="checkbox" name="groupid" id="groupid" value="1" class="form-control" placeholder="Type a password.." <?php if(array_search("groupid",$value)) { echo 'checked'; } ?> />
                
                  </div>
                </div>
               
                <div class="form-group">
                  <label class="col-sm-3 control-label">Password : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="password" value="1" class="form-control" placeholder="Type a password.." <?php if(array_search("password",$value)) { echo 'checked'; } ?>  />
                  </div>
                </div>
				    <div class="form-group">
                  <label class="col-sm-3 control-label">Enable user : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
              
                      <input type="Checkbox" value="1" class="form-control" <?php if(array_search("enableuser",$value)) { echo 'checked'; } ?> id="enableuser" name="enableuser" />
                      
                      
					  
                 
                  </div>
                </div>
                  <div class="form-group">
                  <label class="col-sm-3 control-label">Up limit : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="uplimit" value="1" class="form-control" placeholder="Type your up limit. ..." required  <?php if(array_search("uplimit",$value)) { echo 'checked'; } ?>/>
                  </div>
                </div>
                  <div class="form-group">
                  <label class="col-sm-3 control-label">Down limit <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="downlimit" value="1" class="form-control" placeholder="Type your down limit..."   <?php if(array_search("downlimit",$value)) { echo 'checked'; } ?>/>
                  </div>
                </div>

				  <div class="form-group">
                  <label class="col-sm-3 control-label">Comblimit: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
				   <input type="checkbox" name="comblimit" value="1" class="form-control" placeholder="Type your comblimit..." <?php if(array_search("comblimit",$value)) { echo 'checked'; } ?> />
                    
                  </div>
                </div>
				  <div class="form-group">
                  <label class="col-sm-3 control-label">First Name: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
				   <input type="checkbox" name="firstname" value="1" class="form-control" placeholder="Type your first name..." <?php if(array_search("firstname",$value)) { echo 'checked'; } ?>/>
                    
                  </div>
                </div>
				    <div class="form-group">
                  <label class="col-sm-3 control-label">Last Name: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
				   <input type="checkbox" name="lastname" value="1" class="form-control" placeholder="Type your lastname..."  <?php if(array_search("lastname",$value)) { echo 'checked'; } ?> />
                    
                  </div>
                </div>
                  <div class="form-group">
                  <label class="col-sm-3 control-label">Company: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="company" value="1"class="form-control" placeholder="Type your company..."  <?php if(array_search("company",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>
                  <div class="form-group">
                  <label class="col-sm-3 control-label">Phone : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="phone" value="1" class="form-control" placeholder="Type your phone.."  <?php if(array_search("phone",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>
                  <div class="form-group">
                  <label class="col-sm-3 control-label">Mobile : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="mobile" value="1" class="form-control" placeholder="Type your mobile." <?php if(array_search("mobile",$value)) { echo 'checked'; } ?>  />
                  </div>
                </div>
                  <div class="form-group">
                  <label class="col-sm-3 control-label">Address: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="address" value="1" class="form-control" placeholder="Type your address." <?php if(array_search("address",$value)) { echo 'checked'; } ?>  />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Country: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="country" value="1" class="form-control" placeholder="Type your country." <?php if(array_search("country",$value)) { echo 'checked'; } ?> />
                  </div>
                </div><div class="form-group">
                  <label class="col-sm-3 control-label">State: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="state" value="1" class="form-control" placeholder="Type your state." <?php if(array_search("state",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>
                 <div class="form-group">
                  <label class="col-sm-3 control-label">City: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="city" value="1" class="form-control" placeholder="Type your city." <?php if(array_search("city",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Zip: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="zip" value="1" class="form-control" placeholder="Type your zip." <?php if(array_search("zip",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>
				 <div class="form-group">
                  <label class="col-sm-3 control-label">Comment: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="comment" value="1" class="form-control" placeholder="Type your comment."  <?php if(array_search("comment",$value)) { echo 'checked'; } ?> />
                  </div>
                </div> <div class="form-group">
                  <label class="col-sm-3 control-label">Gpslat: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="gpslat" value="1" class="form-control" placeholder="Type your gpslat." <?php if(array_search("gpslat",$value)) { echo 'checked'; } ?> />
                  </div>
                </div> <div class="form-group">
                  <label class="col-sm-3 control-label">Gpslong: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="gpslong" value="1" class="form-control" placeholder="Type your city." <?php if(array_search("gpslong",$value)) { echo 'checked'; } ?> />
                  </div>
                </div> <div class="form-group">
                  <label class="col-sm-3 control-label">MAC: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="mac" value="1" class="form-control" placeholder="Type your mac." <?php if(array_search("mac",$value)) { echo 'checked'; } ?> />
                  </div>
                </div> 
				<div class="form-group">
                  <label class="col-sm-3 control-label">Usemacauth: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="usemacauth" value="1" class="form-control" placeholder="Type your usemacauth." <?php if(array_search("usemacauth",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>
								<div class="form-group">
                  <label class="col-sm-3 control-label">Expiration: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="expiration" value="1" class="form-control" placeholder="Type your expiration."  <?php if(array_search("expiration",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>				
				<div class="form-group">
                  <label class="col-sm-3 control-label">Uptime limit: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="uptimelimit" value="1" class="form-control" placeholder="Type your uptimelimit." <?php if(array_search("uptimelimit",$value)) { echo 'checked'; } ?>  />
                  </div>
                </div>				
				<div class="form-group">
                  <label class="col-sm-3 control-label">Srvid: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="srvid" value="1" class="form-control" placeholder="Type your srvid." <?php if(array_search("srvid",$value)) { echo 'checked'; } ?>  />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Static ipcm: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="staticipcm" value="1" class="form-control" placeholder="Type your staticipcm." <?php if(array_search("staticipcm",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Static ipcpe: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="staticipcpe" value="1" class="form-control" placeholder="Type your staticipcpe." <?php if(array_search("staticipcpe",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Ipmodecm: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="ipmodecm" value="1" class="form-control" placeholder="Type your ipmodecm." <?php if(array_search("ipmodecm",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Ipmodecpe: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="ipmodecpe" value="1" class="form-control" placeholder="Type your ipmodecpe" <?php if(array_search("ipmodecpe",$value)) { echo 'checked'; } ?> ></div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Poolidcm: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="poolidcm" value="1" class="form-control" placeholder="Type your poolidcm."  <?php if(array_search("poolidcm",$value)) { echo 'checked'; } ?> >
                  </div>
                </div>
                
              </div><!-- panel-body -->
            
          </div><!-- panel -->
        
          
          
        </div><!-- col-md-6 -->
        
        <div class="col-md-6">
      
          <div class="panel panel-default">
              <div class="panel-body">
                <div class="error"></div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Poolidcpe : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="poolidcpe" value="1" class="form-control" placeholder="Type your poolidcpe..." <?php if(array_search("poolidcpe",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Createdon : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="createdon" value="1" class="form-control" placeholder="Type your createdon..." <?php if(array_search("createdon",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>
                  <div class="form-group">
                  <label class="col-sm-3 control-label">Acctype: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="acctype" value="1" class="form-control" placeholder="Type your acctype..." <?php if(array_search("acctype",$value)) { echo 'checked'; } ?>  />
                  </div>
                </div>
                  <div class="form-group">
                  <label class="col-sm-3 control-label">Credits : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="credits" value="1" class="form-control" placeholder="credits" <?php if(array_search("credits",$value)) { echo 'checked'; } ?>  />
                  </div>
                </div>
                  <div class="form-group">
                  <label class="col-sm-3 control-label">Cardfails : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="cardfails" value="1" class="form-control" placeholder="cardfails" <?php if(array_search("cardfails",$value)) { echo 'checked'; } ?> />
                  </div>
                </div> 
				<div class="form-group">
                  <label class="col-sm-3 control-label">Createdby : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="createdby" value="1" class="form-control" placeholder="createdby"  <?php if(array_search("createdby",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>  
				<div class="form-group">
                  <label class="col-sm-3 control-label">Owner: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="owner" value="1" class="form-control" placeholder="owner" <?php if(array_search("owner",$value)) { echo 'checked'; } ?>  />
                  </div>
                </div>  <div class="form-group">
                  <label class="col-sm-3 control-label">Taxid : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="taxid" value="1" class="form-control" placeholder="taxid"  <?php if(array_search("taxid",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>  <div class="form-group">
                  <label class="col-sm-3 control-label">Email Id: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="email" value="1" class="form-control" placeholder="email" <?php if(array_search("email",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>  <div class="form-group">
                  <label class="col-sm-3 control-label">Maccm : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="maccm" value="1" class="form-control" placeholder="maccm" <?php if(array_search("maccm",$value)) { echo 'checked'; } ?>  />
                  </div>
                </div>  <div class="form-group">
                  <label class="col-sm-3 control-label">Custattr : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="custattr" value="1" class="form-control" placeholder="custattr" <?php if(array_search("custattr",$value)) { echo 'checked'; } ?>/>
                  </div>
                </div>  <div class="form-group">
                  <label class="col-sm-3 control-label">Warningsent : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="warningsent" value="1>" class="form-control" placeholder="warningsent" <?php if(array_search("warningsent",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>  <div class="form-group">
                  <label class="col-sm-3 control-label">Verifycode: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="verifycode" value="1" class="form-control" placeholder="verifycode" <?php if(array_search("verifycode",$value)) { echo 'checked'; } ?> />
                  </div>
                </div> 
				<div class="form-group">
                  <label class="col-sm-3 control-label">Verified : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="verified" value="1" class="form-control" placeholder="verified"  <?php if(array_search("verified",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Selfreg : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="selfreg" value="1" class="form-control" placeholder="selfreg" <?php if(array_search("selfreg",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Verifyfails : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="verifyfails" value="1" class="form-control" placeholder="verifyfails" <?php if(array_search("verifyfails",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>				
				<div class="form-group">
                  <label class="col-sm-3 control-label">Verifysentnum : <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="verifysentnum" value="1" class="form-control" placeholder="verifysentnum"  <?php if(array_search("verifysentnum",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Verifymobile: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="verifymobile" value="1" class="form-control" placeholder="verifymobile" <?php if(array_search("verifymobile",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>	
				<div class="form-group">
                  <label class="col-sm-3 control-label">Contractid: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="contractid" value="1" class="form-control" placeholder="contractid" <?php if(array_search("contractid",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>	
				<div class="form-group">
                  <label class="col-sm-3 control-label">Actcode: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="actcode" value="1" class="form-control" placeholder="actcode" <?php if(array_search("actcode",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>	
				<div class="form-group">
                  <label class="col-sm-3 control-label">Pswactsmsnum: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="pswactsmsnum" value="1" class="form-control" placeholder="pswactsmsnum"  <?php if(array_search("pswactsmsnum",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>	
				<div class="form-group">
                  <label class="col-sm-3 control-label">id Proof type : </label>
                  <div class="col-sm-9">
				   <input type="checkbox" name="id_type" value="1" class="form-control" placeholder="pswactsmsnum" <?php if(array_search("id_type",$value)) { echo 'checked'; } ?> />
				
             
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Id Proof No: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="id_no" value="1" class="form-control" placeholder="id_no" <?php if(array_search("id_no",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>	
				<div class="form-group">
                  <label class="col-sm-3 control-label">Id Proof Image: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="id_path" value="1" class="form-control" placeholder="id_no" <?php if(array_search("id_path",$value)) { echo 'checked'; } ?>  />
                  </div>
                </div>
				
				<div class="form-group">
                  <label class="col-sm-3 control-label">Address Proof type : </label>
                  <div class="col-sm-9">
				   <input type="checkbox" name="address_type" value="1" class="form-control" placeholder="id_no" <?php if(array_search("address_type",$value)) { echo 'checked'; } ?>  />
				
             
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Address Proof No: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="address_no" value="1" class="form-control" placeholder="address no" <?php if(array_search("address_no",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>	
				<div class="form-group">
                  <label class="col-sm-3 control-label">Address Proof Image: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="address_path" value="1" class="form-control" placeholder="id_no" <?php if(array_search("address_path",$value)) { echo 'checked'; } ?>  />
                  </div>
                </div>
					<div class="form-group">
                  <label class="col-sm-3 control-label">Photo: <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="photo_path" value="1" class="form-control" placeholder="id_no"  <?php if(array_search("photo_path",$value)) { echo 'checked'; } ?> />
                  </div>
                </div>
								
              
              <!-- form-group -->

              </div><!-- panel-body -->
              <div class="panel-footer">
                <div class="row">
                  <div class="col-sm-9 col-sm-offset-3">
                    <button class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                  </div>
                </div>
              </div>
            
          </div><!-- panel -->
          </form>
          
        </div><!-- col-md-6 -->
        
      </div><!--row -->
      
      
			  <?php } ?>
    
  </div><!-- mainpanel -->

 
</section>

<script src="http://tinymce.cachefly.net/4.2/tinymce.min.js"></script>
<script>tinymce.init({selector:'textarea'});</script>
<!--- edit model --->

