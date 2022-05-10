<?php
if(isset($evalue) && !empty($evalue))
{
	foreach($value->result() as $row)
	{
	  $con_id=$row->con_id;

		$con_type=$row->con_type; 
		$sal_id=$row->sal_id;      
		$con_primary=$row->con_primary;
		$con_company_name=$row->con_company_name;    
    $con_first_name=$row->con_first_name;
		$con_middle_name=$row->con_middle_name;
		$con_last_name=$row->con_last_name; 
		
		$con_email=$row->con_email;  
		$con_phone=$row->con_phone;
	
		
		$cur_id =$row->cur_id;
		$con_payment_terms=$row->con_payment_terms;
		$con_address=$row->con_address;  
		$con_notes=$row->con_notes;  
		$con_status=$row->con_status;  
    $contact_address=$row->contact_address;  
    $contact_area=$row->contact_area;
    $contact_city=$row->contact_city;
    $contact_state=$row->contact_state;  
    $contact_zip =$row->contact_zip;
    $contact_country=$row->contact_country;
    $contact_phone=$row->contact_phone;  
    $contact_email=$row->contact_email;  
    $contact_fax=$row->contact_fax;  
    $contact_website=$row->contact_website;
	}
  
  foreach($evalue as $key =>$row)
    {
      $address[$key]      = $row->sal_address;
      $trow++;
    }
}
else
{
 
		$con_type=$this->input->post('con_type');
		$sal_id=$this->input->post('sal_id');
		$con_primary=$this->input->post('con_primary');
		$con_company_name=$this->input->post('con_company_name');
    $con_first_name=$this->input->post('con_first_name');
		$con_middle_name=$this->input->post('con_middle_name');
		$con_last_name=$this->input->post('con_last_name');
	  $con_email=$this->input->post('con_email');
		$con_phone=$this->input->post('con_phone');
		$cur_id=$this->input->post('cur_id');
		$con_payment_terms=$this->input->post('con_payment_terms');
		$address=$this->input->post('con_address');
		$con_notes=$this->input->post('con_notes');
		$con_status=$this->input->post('con_status');	
    $con_type=$this->input->post('con_type');	
    $address=$this->input->post('address');
    $contact_address=$this->input->post('contact_address');
    $contact_area=$this->input->post('contact_area');
    $contact_city=$this->input->post('contact_city');
    $contact_state=$this->input->post('contact_state');
    $contact_zip=$this->input->post('contact_zip');
    $contact_country=$this->input->post('contact_country');
    $contact_phone=$this->input->post('contact_phone');
    $contact_email=$this->input->post('contact_email'); 
    $contact_fax=$this->input->post('contact_fax'); 
    $contact_website=$this->input->post('contact_website');  

}
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
					

					<!-- /page container -->
					   	<script type="text/javascript">
				$(document).ready(function() {
			var oTable = $('#example').dataTable( {
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
			} );
		} );
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
            //alert(html);
            
            //alert(row);
            $('#partProductData').append(html);
          
            $('#address'+row).val();
          
          },
        });
      }
        function getConfirmPart(inv,prid)
      {
        //alert(prid);
          var x;
          var r=confirm("You Want Delete!!");
          if(prid!='' && r==true)
          {
            
            $.ajax({"url":"<?php echo site_url('masters/Contacts/getPartNoContent'); ?>",
            "type":"GET",
            data:{
                "prid":prid
            },

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
		</script>
   <div class="row">
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
		</div>
	</div>
</div><!-- Main Wrapper -->


	
	
 
