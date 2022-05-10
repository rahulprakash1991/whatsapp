
  <div class="page-inner">
                <div class="page-title">
                    <h3>Invoice</h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="index-2.html">Home</a></li>
                            <li><a href="#">Extra</a></li>
                            <li class="active">Invoice</li>
                        </ol>
                    </div>
                </div>
                <div id="main-wrapper">
                    <div class="row">
                        <div class="invoice col-md-12">
                         <div class="panel panel-white">
                                <div class="panel-body">

                                 <div class="col-md-12 text-right" >
                                     
                                          <div class="row">
                                              <h1 class="no-m m-t-md ">Paid Amount </h1>
                                              <h1 class="no-m text-success">$<?php echo $paidamount?></h1>
                                              </div>
                                            <div class="row">
                                              <h1 class="no-m m-t-md ">Pendind Amount</h1>
                                              <h1 class="no-m text-danger">$<?php echo $pendingamount;?></h1>
                                              </div>
                                    
                                </div>
                                                       
                                        </div>
                                      </div><!-- Row -->
                                      </div>
                                                              
                            </div>
                        </div>
                        
                    </div><!-- Row -->
                </div><!-- Main Wrapper -->
               
            </div>
<script>
        function call(val)
{
  if(val == 1)
  {
    $('#paid_amount').css('display','block');
    

    $('#paid_amount').val('');
    
  }
  if(val == 2)
  {
    $('#paid_amount').css('display','none');
    

    $('#paid_amount').val('');
    
  }
  if(val == 1  )
  {
    $('#cheque_number').css('display','none');
    $('#cheque_date').css('display','none');
    $('#bank_name').css('display','none');

    $('#cheque_number').val('');
    $('#cheque_date').val('');
    $('#bank_name').val('');
  }
  if(val == 2  )
  {
    $('#cheque_number').css('display','block');
    $('#cheque_date').css('display','block');
    $('#bank_name').css('display','block');

    $('#cheque_number').val('');
    $('#cheque_date').val('');
    $('#bank_name').val('');
  }
  


}
</script>