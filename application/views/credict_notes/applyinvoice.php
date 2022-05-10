<form ng-app="form-example" method="post" id="ajaxModelForm" enctype="multipart/form-data" action="javascript:" ui-jp="parsley">
<div class="modal-content" id="tt">
  <div class="modal-header">
    <?php 
      foreach($credit_data->result() as $row)
      {
        $credit_id =$row->credict_id ;
        $credit_Num =$row->credit_number ;
        $credit_balance =$row->balance_amount ;

    }
    ?>
    <h3 class="modal-title" id="exampleModalCenterTitle"><b><?php echo"Apply Credits from";?><?php echo "   "; echo $credit_Num?></b></h3>
    <button type="button" class="close" data-dismiss="modal"  id="btn" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <form ng-app="form-example" method="post" id="ajaxModelForm" enctype="multipart/form-data" action="javascript:" ui-jp="parsley">
    <div class="modal-body">
      <span id="modalMessage"></span>
      <div class="row">
          <div class="col-sm-12 col-xs-12">
              <span  style="text-align: right;vertical-align: bottom;margin-left: 1200px;"><b>Balance: <div class="label label-success" role="button"><?php echo $credit_balance;?></div></b></span> 
          </div>
        </div>
        <hr>
         <div class="row">
          <div class="col-sm-3 col-xs-3">
            <?php echo "Invoice Number";?>
          </div>
           <div class="col-sm-3 col-xs-3">
            <?php echo "Invoice Date";?>
           </div>
            <div class="col-sm-2 col-xs-2">
              <?php echo "Invoice Amount ";?>
            </div>
             <div class="col-sm-2 col-xs-2">
             <?php echo "Invoice Balance ";?>
             </div>
             <div class="col-sm-2 col-xs-2">
              <?php echo "Amount to Credit  ";?>
             </div>
           </div>

   <?php 
   $i=0;
      foreach($values->result() as $row)
  { ?>
        <div class="row">
          <div class="col-sm-3 col-xs-3">
            <div class="form-group <?PHP if(form_error('inv_num')){ echo 'has-error';} ?>">
            <!--   <label for="exampleInputEmail1"><?php echo "INVOICE NUMBER";?></label> -->
            
              <input type="text" class="form-control"  id="inv_num<?php echo $i;?>" name="inv_num[]" value="<?php echo $row->sal_order ;?>" autocomplete="off" readonly >
                <input type="hidden" class="form-control"  id="inv_id<?php echo $i;?>" name="inv_id[]" value="<?php echo $row->sal_id ;?>" autocomplete="off" readonly >

              <?PHP if(form_error('inv_num')){ echo '<span class="help-block">'.form_error('inv_num').'</span>';} ?>
            </div>
          </div>  
            <div class="col-sm-3 col-xs-3">
            <div class="form-group <?PHP if(form_error('inv_date')){ echo 'has-error';} ?>">
              <!-- <label for="exampleInputEmail1"><?php echo "INVOICE DATE ";?></label> -->
               
<input type="text" class="form-control"  id="inv_date<?php echo $i;?>" name="inv_date[]" value="<?php echo date('d/m/Y', strtotime($row->sal_created_on));?>" autocomplete="off" readonly >

              <?PHP if(form_error('inv_date')){ echo '<span class="help-block">'.form_error('inv_date').'</span>';} ?>
            </div>
          </div>      
        <div class="col-sm-2 col-xs-2">
            <div class="form-group <?PHP if(form_error('inv_amt')){ echo 'has-error';} ?>">
             <!--  <label for="exampleInputEmail1"><?php echo "INVOICE AMOUNT ";?></label> -->
               <input type="text" class="form-control"  id="inv_amt<?php echo $i;?>" name="inv_amt[]" value="<?php echo $row->sal_grand_total ;?>" autocomplete="off" readonly  >
              <?PHP if(form_error('inv_amt')){ echo '<span class="help-block">'.form_error('inv_amt').'</span>';} ?>
            </div>
          </div>  
               <div class="col-sm-2 col-xs-2">
            <div class="form-group <?PHP if(form_error('inv_bal')){ echo 'has-error';} ?>">
              <!-- <label for="exampleInputEmail1"><?php echo "INVOICE BALANCE ";?></label> -->
              <?php $balance = $row->sal_grand_total - $row->paid_amount ;?>
               <input type="text" class="form-control"  id="inv_bal<?php echo $i;?>" name="inv_bal[]" value="<?php echo $balance;?>" autocomplete="off" readonly >
              <?PHP if(form_error('inv_bal')){ echo '<span class="help-block">'.form_error('inv_bal').'</span>';} ?>
            </div>
          </div>  
            <div class="col-sm-2 col-xs-2">
            <div class="form-group <?PHP if(form_error('amount_crt')){ echo 'has-error';} ?>">
              <!-- <label for="exampleInputEmail1"><?php echo "AMOUNT TO CREDIT ";?></label> -->
             
               <input type="text" class="form-control"  id="amount_crt<?php echo $i;?>" name="amount_crt[]" value="" autocomplete="off" onchange="calculate('<?php echo $i;?>');"  >
              <?PHP if(form_error('amount_crt')){ echo '<span class="help-block">'.form_error('amount_crt').'</span>';} ?>
            </div>
          </div>
        </div>
  
  <?php $i++; }?>
   

    </div>
      <div class="row">
       <div class="col-sm-4 col-xs-4">
       </div>
       <div class="col-sm-4 col-xs-4" >
      
    </div>
     <div class="col-sm-4 col-xs-4"align="right">
       <div class="row">
        <div class="col-sm-8 col-xs-8">
           <label style="text-align: right;" for="add_amount"><?php echo "Amount to Credit ";?>
        </div>
        <div class="col-sm-3 col-xs-3">
          <input type="text" style="background-color: #9FD0F9" class="form-control"  id="add_amount" name="add_amount" value="" autocomplete="off" readonly  >
        </div>
       </div>
    
     </div>
  </div>
  <br>
 <div class="row">
       <div class="col-sm-4 col-xs-4">
       </div>
       <div class="col-sm-4 col-xs-4" >
      
    </div>
     <div class="col-sm-4 col-xs-4"align="right">
       <div class="row">
       
        <div class="col-sm-8 col-xs-8">
           <label style="text-align: right;" for="add_amount"><?php echo "Remaining  Credits ";?>
        </div>
        <div class="col-sm-3 col-xs-3">
          <input type="text" style="background-color: #9FD0F9" class="form-control"  id="credit_bal" name="credit_bal" value="<?php echo $credit_balance;?>" autocomplete="off" readonly  >
        </div>
       </div>
    
     </div>
  </div>
    <div class="row">
       <div class="col-sm-4 col-xs-4">
       </div>
       <div class="col-sm-4 col-xs-4" align="center">
     <input type="hidden" name="submit" value="1">
      <input type="hidden" name="credit_id" id="credit_id" value="<?php echo $credit_id;?>">
      <input type="hidden" name="client_id" id="client_id" value="<?php echo $client_id;?>">
      <button type="submit" class="btn btn-primary" name="submit"><?php echo "Save";?></button>&nbsp;&nbsp;
      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn1"><?php echo "Cancel";?></button>
      
    </div>
     <div class="col-sm-4 col-xs-4">
     </div>
  </div>
  <br>

  <?php echo form_close(); ?>
</div>

<script type="text/javascript">
 $("#btn").click(function(){
            $("#tt").hide();
        });
  $("#btn1").click(function(){
            $("#tt").hide();
        });
jQuery(document).ready(function() 
      {
        //$('.modal .select2').select2('disable');

        // When the form is submitted
        $("#ajaxModelForm").submit(function()
        { 

          
          // 'this' refers to the current submitted form 
          var str = $(this).serialize();
          //  var formdata= new FormData($(this)[0]);
// var form = $('#ajaxModelForm')[0];

          $.ajax({
          type: "POST",
          url: "<?php echo site_url('Credict_notes/applyInvoice'); ?>",
          data: {postdata: str},
          dataType:"html",
            success: function(html1)
            {

             var credit_id = $('#credit_id').val();
             var client_id = $('#client_id').val();
             cr_id = credit_id;
             client_id = client_id;
             alert("Added Successfully");
                 
            $.ajax({
              type: "GET",
              url: "<?php echo site_url('Credict_notes/applyInvoice'); ?>",
              data: {credit_id:cr_id,client_id:client_id},
              dataType:"html",
              success: function(response)
              {
        
                jQuery('#viewajaxcontent').html(response);
                jQuery('.bs-example-modal-lg').modal('show', {});
                          
              },
            });
            // try
            //   {
            //     var data = JSON.parse(html1);
             
            //     if(data.result == "Success")
            //     {
            //       var htmlText = '<div class="alert alert-'+data.res_type+'" successmessage">'+data.res+'</div>';
            //       $('#modalMessage').html(htmlText);
                  
            //          setTimeout(function(){
            //     window.location.reload(1);
            //   }, 1500);

            //     }
            //     if(data.result == "Success1")
            //     {
            //       var htmlText = '<div class="alert alert-'+data.res_type+'" successmessage">'+data.res+'</div>';
            //       $('#modalMessage').html(htmlText);
                
            //       setTimeout(function(){
            //     window.location.reload(1);
            //   }, 1500);


            //     }
               
            //   }
            //   catch(e)
            //   {
            //     //alert(e);
            //     $('#attributeVIDetailsModal').html(html1);
            //   }
            },
          });
          
        }); // end submit event        
    });
function EditClient(id)
{
  
     $.ajax({
        type: "GET",
        url: "<?php echo site_url('masters/Client/getRepDetailsDataModal'); ?>", 
        data: {rep_id:id},
        dataType:"html",
       
        success: function(html1){
          var res = $.parseJSON(html1);
         
          //getSatipEnggNoDropDown(res.engg_no_name, res.satip_engg_no, res.satip_id);

          $('#rep_name').val(res.rep_name);
          $('#email').val(res.email);
          $('#contact_num').val(res.mobile);
          $('#designation').val(res.designation);
           $('#contact_num1').val(res.mobile1);
           $('#title').val(res.title_id);
           $('#rep_id').val(res.id);
        
  
        },
   
      });
}
function calculate(row)
{
 var apply_amount =  $('#amount_crt'+row+'').val();
 var add_amount =  $('#add_amount').val();
 var credit_amount_bal =  $('#credit_bal').val();
 if(Number(credit_amount_bal) >= Number(apply_amount))
  {
     var bal = Number(credit_amount_bal) - Number(apply_amount);
     var anount = Number(add_amount) + Number(apply_amount);
     $('#add_amount').val(anount); 
     $('#credit_bal').val(bal);
    
  }

  // if(add_amount=='')
  // {
  //   var bal = Number(credit_amount_bal) - Number(apply_amount);
  //  $('#add_amount').val(apply_amount); 
  //   $('#credit_bal').val(bal);

  // }
  else
  {
     
     alert('Enter value Greaterthan Credit Amount!!!!!');
    $('#add_amount').val(add_amount); 
    $('#credit_bal').val( credit_amount_bal );
    $('#amount_crt'+row+'').val(''); 

  }
}


</script> 

