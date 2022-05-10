<?php
if(isset($value) && !empty($value))
{
	foreach($value->result() as $row)
	{
		$con_id             =	$row->con_id;
    $con_type           = $row->con_type;
    $cg_id              = $row->cg_id;
		$sal_id             =	$row->sal_id; 
    $department_id      = $row->department_id;
		$con_primary		    =	$row->con_primary;
		$con_company_name	  =	$row->con_company_name;    
    $con_first_name     = $row->con_first_name;
		$con_middle_name		=	$row->con_middle_name;
		$con_last_name		  =	$row->con_last_name;
		$con_email          =	$row->con_email;
		$con_phone          =	$row->con_phone;
		$cur_id             =	$row->cur_id;
		$con_payment_terms	=	$row->con_payment_terms;
		$con_address		    =	$row->con_address;
		$con_notes          =	$row->con_notes;
		$con_status			    =	$row->con_status;
    $opening_balance    = $row->opening_balance;
		$contact_address    =	$row->contact_address;
		$contact_area       =	$row->contact_area;
		$contact_city       =	$row->contact_city;
		$contact_state      =	$row->contact_state;
		$contact_zip        =	$row->contact_zip;
		$contact_country    =	$row->contact_country;
		$contact_phone      =	$row->contact_phone;
		$contact_email      =	$row->contact_email;
		$contact_fax        =	$row->contact_fax;
		$contact_website    =	$row->contact_website;
	}
  
	foreach($evalue as $key =>$row)
	{
		$address[$key]      = $row->sal_address;
		$trow++;
	} 
}
else
{
  $opening_balance          = $this->input->post('opening_balance');
  $con_type                 = $this->input->post('con_type');
	$cg_id                    =	$this->input->post('cg_id');
  $sal_id                   = $this->input->post('sal_id');
  $department_id            = $this->input->post('department_id');
	$con_primary              =	$this->input->post('con_primary');
	$con_company_name		      =	$this->input->post('con_company_name');
  $con_first_name           = $this->input->post('con_first_name');
	$con_middle_name			    =	$this->input->post('con_middle_name');
	$con_last_name			      =	$this->input->post('con_last_name');
	$con_email				        =	$this->input->post('con_email');
	$con_phone				        =	$this->input->post('con_phone');
	$cur_id					          =	$this->input->post('cur_id');
	$con_payment_terms		    =	$this->input->post('con_payment_terms');
	$address				          =	$this->input->post('con_address');
	$con_notes				        =	$this->input->post('con_notes');
	$con_status				        =	$this->input->post('con_status');	
	$con_type				          =	$this->input->post('con_type');	
	$address				          =	$this->input->post('address');
	$contact_address		      =	$this->input->post('contact_address');
	$contact_area			        =	$this->input->post('contact_area');
	$contact_city			        =	$this->input->post('contact_city');
	$contact_state			      =	$this->input->post('contact_state');
	$contact_zip			        =	$this->input->post('contact_zip');
	$contact_country		      =	$this->input->post('contact_country');
	$contact_phone			      =	$this->input->post('contact_phone');
	$contact_email			      =	$this->input->post('contact_email'); 
	$contact_fax			        =	$this->input->post('contact_fax'); 
	$contact_website		      =	$this->input->post('contact_website');
}

$opening_balance  = ($opening_balance) ? $opening_balance : 0.00;

	$i = 1;
	$trow = ($trow=='') ? 1 : $trow;

?>
<style type="text/css">
hr {
    margin-top: 10px;
    margin-bottom: 8px;
    border: 0;
    border-top: 1px solid #eee;
  }
</style>

<div class="page-inner">
  <div class="page-title">
    <h3><strong><?PHP echo $form_toptittle; ?></strong></h3>
    <div class="page-breadcrumb">
        <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><strong>Home</strong></a></li>
        <li class="active"><?PHP echo $form_toptittle; ?></li>
        </ol>
    </div>
  </div>
  <div id="main-wrapper">

    <?php
    if($notification)
    {
    ?>
      <div class="alert alert-success no-border successmessage">
        <span class="text-semibold"> <?php echo $notification;?></span>
      </div>
    <?php
    }
    ?>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-body">
        <?php echo form_open_multipart($form_url); ?>
         <head><h3>Contact Type</h3></head>
        <hr>
        <div class="row">
          <div class="col-md-2">
            <div class="form-group <?PHP if(form_error('con_type')){ echo 'has-error';} ?>">
              <div class="control-group" id="con_type">
                <div class="controls">
                  <label>
                    <input type="radio" name="con_type" value="1" <?php if($con_type=='1'){?> checked <?php }?> onclick="loadContactGroup(this.value)"/> Customer
                  </label>
                  <label>
                    <input type="radio" name="con_type" value="0"  <?php if($con_type=='0'){?> checked <?php }?> onclick="loadContactGroup(this.value)"/> Vendor
                  </label>
                </div>
              </div>
              <label class="error"><?php echo form_error('con_type'); ?></label>
            </div>												
          </div>
          <div class="col-md-3">
            <div class="form-group <?PHP if(form_error('con_company_name')){ echo 'has-error';} ?>">
              <label>Company Name<span1>*</span1></label>
              <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Company Name" id="con_company_name" name="con_company_name" value="<?php echo $con_company_name; ?>">
              <label class="error"><?php echo form_error('con_company_name'); ?></label>
            </div>
          </div>
        </div>
        <head><h3>Contact Address</h3></head>
        <hr /> 
        <div class="row">
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_address')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
              <input type="text" class="form-control" name="contact_address" autocomplete="off" id="contact_address" placeholder="Address" value="<?php echo $contact_address;?>">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_area')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
              <input type="text" class="form-control" name="contact_area" autocomplete="off" id="contact_area" placeholder="Area" value="<?php echo $contact_area;?>">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_city')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
              <input type="text" class="form-control" name="contact_city" autocomplete="off" id="contact_city" placeholder="city" value="<?php echo $contact_city;?>">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_state')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
              <input type="text" class="form-control" name="contact_state" autocomplete="off" id="contact_state" placeholder="State" value="<?php echo $contact_state;?>">
            </div>
          </div>
        </div>
        <br />
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_zip')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
              <input type="text" class="form-control" name="contact_zip" autocomplete="off" id="contact_zip" placeholder="Zip" value="<?php echo $contact_zip;?>">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_country')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa fa-flag"></i></div>
               <input type="text" class="form-control" name="contact_country" autocomplete="off" id="contact_country" placeholder="Country" value="<?php echo $contact_country;?>">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_phone')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa fa-phone"></i></div>
                <input type="text" class="form-control" name="contact_phone" autocomplete="off" id="contact_phone" placeholder="Phone" value="<?php echo $contact_phone;?>">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_email')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                <input type="text" class="form-control" name="contact_email" autocomplete="off" id="contact_email" placeholder="Email" value="<?php echo $contact_email;?>">
            </div>
          </div>
        </div>
        <br />
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_fax')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa fa-fax"></i></div>
                <input type="text" class="form-control" name="contact_fax" autocomplete="off" id="contact_fax" placeholder="Fax" value="<?php echo $contact_fax;?>">
             </div>
           </div>
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_website')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-external-link"></i></div>
                <input type="text" class="form-control" name="contact_website" autocomplete="off" id="contact_website" placeholder="Website" value="<?php echo $contact_website;?>">
            </div>
          </div>
        </div>
        <br />
        <div class="clearfix"></div>
        <head><h3>Contact Person</h3></head>
        <hr />
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="15%">Department</th>
                    <th>Salutation</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Contact Phone</th>
                    <th>Contact Email</th>
                </tr>
            </thead>
            <tbody id="contactPersonRows">
                <tr>
                    <td>
                      <div class="form-group <?PHP if(form_error('department_id')){ echo 'has-error';} ?>">
                        <select name="department_id" id="department_id" class="form-control select2" data-name="department_id" data-name="<?php echo $i;?>">
                          <?php foreach ($drop_menu_department as $key_id => $key_name )
                          {?>
                            <option value="<?php echo $key_id;?>" <?php if($key_id == $department_id){?> selected <?php }?>><?php echo $key_name;?></option>
                          <?php
                          }?>
                        </select>
                      </div>
                    </td>
                    <td>
                      <div class="form-group <?PHP if(form_error('con_salutation')){ echo 'has-error';} ?>">
                        <select name="sal_id" id="con_salutation" class="form-control select2">
                          <?php foreach ($drop_menu_salutation as $key_id => $key_name) 
                          {?>
                          <option value="<?php echo $key_id;?>" <?php if($key_id == $sal_id){?> selected <?php }?>><?php echo $key_name;?></option>
                          <?php 
                          }?>
                        </select><br />
                        <label class="error"><?php echo form_error('sal_id'); ?></label>                 
                      </div>     
                    </td>
                    <td>
                      <div class="form-group <?PHP if(form_error('con_first_name')){ echo 'has-error';} ?>">
                        <input type="text" autocomplete="off" class="form-control"  placeholder="Enter First Name" id="con_first_name" name="con_first_name" value="<?php echo $con_first_name; ?>">
                      </div>                      
                    </td>                    
                    <td>
                      <div class="form-group <?PHP if(form_error('con_middle_name')){ echo 'has-error';} ?>">
                        <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Middle Name" id="con_middle_name" name="con_middle_name" value="<?php echo $con_middle_name; ?>">
                      </div>                      
                    </td>
                    <td>
                      <div class="form-group <?PHP if(form_error('con_last_name')){ echo 'has-error';} ?>">
                        <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Last Name" id="con_last_name" name="con_last_name" value="<?php echo $con_last_name; ?>">
                      </div>                      
                    </td>
                    <td>
                      <div class="form-group <?PHP if(form_error('con_phone')){ echo 'has-error';} ?>">
                        <div class="input-group <?php if(form_error('con_phone')){ echo 'has-error'; }?>">
                          <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                            <input type="text" class="form-control" name="con_phone" autocomplete="off" id="con_phone" placeholder="Enter Contact Phone" value="<?php echo $con_phone;?>">
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="form-group <?PHP if(form_error('con_email')){ echo 'has-error';} ?>">
                          <div class="input-group <?php if(form_error('con_email')){ echo 'has-error'; }?>">
                            <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                              <input type="text" class="form-control" name="con_email" autocomplete="off" id="con_email" placeholder="Email" value="<?php echo $con_email;?>">
                          </div>
                      </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="clearfix"></div>
        <head><h3>Payment Detail</h3></head>
        <hr />
        <div class="row">
          <div class="col-md-3">
            <div class="form-group <?PHP if(form_error('con_payment_terms')){ echo 'has-error';} ?>">
                <label>Payment Terms<span1>*</span1></label>
                <select name="con_payment_terms" id="con_payment_terms" class="form-control">
                <?php foreach ($drop_menu_terms as $key_id => $key_name) 
                {?>
                <option value="<?php echo $key_id;?>" <?php if($key_id == $con_payment_terms){?> selected <?php }?>><?php echo $key_name;?></option>
                <?php 
                }?>
                </select>
                <label class="error"><?php echo form_error('con_payment_terms'); ?></label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group <?PHP if(form_error('cur_id')){ echo 'has-error';} ?>">
              <label>Currency:<span1>*</span1></label>
              <select name="cur_id" id="cur_id" class="form-control">
              <?php foreach ($drop_menu_currency as $key_id => $key_name) 
              {?>
              <option value="<?php echo $key_id;?>" <?php if($key_id == $cur_id){?> selected <?php }?>><?php echo $key_name;?></option>

              <?php 
              }?>
              </select>
              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('cur_id'); ?></label>
            </div>
          </div>
          <div class="col-sm-3">
          <label>Opening Balance:<span1>*</span1></label>
            <div class="input-group <?php if(form_error('opening_balance')){ echo 'has-error'; }?>">
              
              <input type="text" class="form-control" name="opening_balance" autocomplete="off" id="opening_balance" placeholder="Opening Balance" value="<?php echo $opening_balance;?>">
            </div>
          </div>
        </div>
        <br /> 
        <div class="row"> 
          <div class="col-md-12">
            <div class="form-group ">
                
                 <head><h3>Notes</h3></head>
                 <hr> 
                <textarea  autocomplete="off" name="con_notes" class="form-control" autocomplete="off" rows="4" ><?php echo $con_notes;?></textarea>
               <label class="error"><?php echo form_error('con_notes'); ?></label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">                  
            <span id="partProductData">
              <head><h3>Add more delivery address here</h3></head>
              <hr>
                <?php 
                $is=1;
                for($i=0; $i < $trow; $i++)
                {
                ?>
                <div class="row allrowvalues" id="rowssids_<?php echo $i;?>">
                  <div class="col-md-3">
                    <div class="form-group <?PHP if(form_error('address')){ echo 'has-error';} ?>">
                      <textarea  autocomplete="off" name="address[]" class="form-control address" autocomplete="off" rows="4" id="address<?php echo $i;?>"><?php echo $address[$i];?></textarea>
                      <label class="error"><?php echo form_error('address'); ?></label>
                    </div>
                  </div>  
                  <div class="col-md-2">
                    <div class="form-group">
                      <a href="javascript:void(0);" onclick="getConfirmPart(<?php echo $i;?>)" class="btn btn-danger btn-xs" onclick="calculate()" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                    </div>
                  </div>  
                </div> 
                <?php 
                $is++; 
                } 
                ?>
            </span>                                            
          </div>
          <div class="col-md-3">
            <div class="col-md-1">
              <a onclick="addNewPart()" class="label label-danger"> Add New </a>    
              <input type="hidden" name="attproduct" id="attproduct" value="<?PHP echo $is-1?>" />
            </div>
          </div>
          <div class="text-center">

            <input type="hidden" name="con_id" value="<?php echo $con_id;?>" />                       
            <button type="submit" name="Submit" class="btn btn-primary"><?php echo ($con_id!='' ? 'Update Contact' : 'Create Contact'); ?> 
            </button>
          </div>
        </div>                         
        <?php echo form_close(); ?>
      </div> 
    </div>
  </div> 
</div>             

<script type="text/javascript">
	$(document).ready(function() {
    var oTable = $('#example').dataTable({
    "bProcessing": true,
    responsive: true,
    "sAjaxSource": '<?php echo base_url().$datatable_url; ?>',
    "bJQueryUI": true,
    "sPaginationType": "full_numbers",
    "iDisplayStart ":20,
    "oLanguage": {
    "sProcessing": "<img src='<?php echo base_url(); ?>img/ajax-loader_dark.gif'>"
    },  
    "fnInitComplete": function() {
    //oTable.fnAdjustColumnSizing();
    },
    'fnServerData': function(sSource, aoData, fnCallback)
    {
      $.ajax
      ({
        'dataType': 'json',
        'type'    : 'POST',
        'url'     : sSource,
        'data'    : aoData,
        'success' : fnCallback
      });
    }
    });
  });
  
  function addNewPart()
  {
    row = $('#attproduct').val();
    $.ajax({
      type: "GET",
      url: "<?php echo site_url('masters/Contacts/getPartNoContent'); ?>", 
      data: {i:row},
      dataType:"html",
      success: function(html)
      {
        $('#partProductData').append(html);
        $('#address'+row).val();
      },
    });
  }

  function getConfirmPart(inv, prid)
  {
      var x;
      var r=confirm("You Want Delete!!");
      if(prid!='' && r==true)
      {
        $.ajax(
        {
          "url":"<?php echo site_url('masters/Contacts/getPartNoContent'); ?>",
          "type":"GET",
          data:{"prid":prid},
          success:function(data)
          {
            //alert("Daelted Successfully");
            $('#rowssids_'+inv+'').remove();
            $('#attproduct').val( Number($('#attproduct').val()) - Number(1));
          }
        });
      }
      else if (prid=='' && r==true)
      {
        $('#rowssids_'+inv+'').remove();
        $('#attproduct').val( Number($('#attproduct').val()) - Number(1));
      }
  }

  function loadContactGroup(cg_id)
  {
    $.ajax({
      type: "GET",
      url: "<?php echo site_url('masters/Contact_group/getContactGroups');?>", 
      data: {cg_id:cg_id},
      dataType:"html",
      success: function(html)
      {
        $('#partProductData').append(html);
        $('#pro_item_id'+row).select2();
        row = Number($('#attproduct').val()) + 1; 
        $('#attproduct').val( row );      
      },
    });
  }

  function addNewRow(content_id)
  {
    var row = $("#"+content_id+" tr:last");

    row.find("select").each(function(index)
    {
      $(this).select2('destroy');
    }); 

    row.clone().find("input, textarea, select, button, checkbox, radio").each(function()
    {
        i   = $(this).data('row') + 1;
        id  = $(this).data('name') + i;

        $(this).val('').attr({'id' : id, 'data-row' : i});
    }).end().appendTo("#"+content_id);

    $(".select2").select2();
  }

  function addRowDelete(content_id, inputClass, table, pk_field)
  {
    if((arguments[0] != null))
    {
      swal({
          title: "Are you sure?",
          text: "You want to delete this???",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: '#DD6B55',
          confirmButtonText: "Yes",
          cancelButtonText:  "Cancel",
          closeOnConfirm: false,
          closeOnCancel: false
       },
       function(isConfirm)
       {
           if (isConfirm)
           {

              $('.'+inputClass+':checkbox:checked').each(function ()
              {
                var isThisVal = (this.checked ? $(this).val() : "");                
                if(isThisVal)
                {  
                  $.ajax({
                            type: "POST",
                            url :"<?php echo base_url();?>/Common_controller/delete",
                            data: {"table" : table, "pk_field" : pk_field, "val" : isThisVal}
                        });
                }

                $(this).closest('tr').remove();
              });



              swal("DONE", "", "success");


            } else 
            {
              swal("This operation has been cancelled", "", "error");
              //e.preventDefault();
            }
       });
    } 
  }  
</script>
   <!--<div class="row">
				<div class="col-md-12">
					<div class="panel ">
						<div class="panel-heading clearfix">
							<h4 class="panel-title"><?PHP echo $list_tittle; ?></h4>
						</div>
						<div class="panel-body">
						   <div class="table-responsive">
								<?php 
									echo $this->table->generate(); 
								?>
							</div>
						</div>
					</div>
				</div>
		</div>-->
	</div>
</div><!-- Main Wrapper -->


	
	
 
