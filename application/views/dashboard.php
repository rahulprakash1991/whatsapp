<div class="page-inner">
    <div class="page-title">
        <h3>Dashboard</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </div>
    </div>
    <?php $getCurrency = $this->pre->getCurrencynew();?>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <a href="<?php echo base_url();?>Report/SalesReport"><p class="counter"><?php echo $getCurrency;?> <?php echo number_format($Current_Month_sales, 2);?></p></a>
                            <span class="info-box-title">Total Sales(Current Month)</span>
                        </div>
                        <div class="info-box-icon">
                            <i class="icon-bar-chart"></i>
                        </div>
                        <div class="info-box-progress">
                            <div class="progress progress-xs progress-squared bs-n">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <a href="<?php echo base_url();?>Report/purchase_report"><p class="counter"><?php echo $getCurrency;?> <?php echo number_format($Current_Month_purchase, 2);?></p></a>
                            <span class="info-box-title">Total Purchase (Current Month)</span>
                        </div>
                        <div class="info-box-icon">
                            <i class="icon-basket"></i>
                        </div>
                        <div class="info-box-progress">
                            <div class="progress progress-xs progress-squared bs-n">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php   
            foreach($Outstanding_Receivable_pay as $row)
            {
                $total2   +=  $row['outstanding']; 
            }     
            ?>
            <div class="col-lg-4 col-md-6">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <a href="<?php echo base_url();?>Report/Outstanding_payables"><p><span class="counter"><?php echo $getCurrency;?> <?php echo number_format($total2, 2);?></span></p></a>
                            <span class="info-box-title">Outstanding Payable</span>
                        </div>
                        <div class="info-box-icon">
                            <i class=" icon-credit-card"></i>
                        </div>
                        <div class="info-box-progress">
                            <div class="progress progress-xs progress-squared bs-n">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <?php 
            foreach($Outstanding_Receivable_sal as $row)
            {
                $Outstanding_receivables   +=  $row['outstanding']; 
            }    
          ?>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                           <a href="<?php echo base_url();?>Report/Outstanding_receivables"> <p class="counter"><?php echo $getCurrency;?> <?php echo number_format($Outstanding_receivables , 2);?></p></a>
                            <span class="info-box-title">Outstanding Receivable</span>
                        </div>
                        <div class="info-box-icon">
                            <i class="icon-wallet"></i>
                        </div>
                        <div class="info-box-progress">
                            <div class="progress progress-xs progress-squared bs-n">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php              
            foreach($Stock_value as $row)
            {
                $data+= $row->total_cost_price;
            }
            ?>
            <div class="col-lg-4 col-md-6">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                           <a href="<?php echo base_url();?>ProductReport/product_report"> <p class="counter"><?php echo $getCurrency;?> <?php echo number_format($data, 2);?></p></a>
                            <span class="info-box-title">Stock Value</span>
                        </div>
                        <div class="info-box-icon">
                            <i class="icon-briefcase"></i>
                        </div>
                        <div class="info-box-progress">
                            <div class="progress progress-xs progress-squared bs-n">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                        <a href="<?php echo base_url();?>ProductReport/rendor_item"><p class="counter"> <?php echo $reorder;?></p></a>
                            <span class="info-box-title">Reorder Count</span>
                        </div>
                        <div class="info-box-icon">
                            <i class=" icon-bell"></i>
                        </div>
                        <div class="info-box-progress">
                            <div class="progress progress-xs progress-squared bs-n">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="visitors-chart">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Top 10 Sales Items</h4>
                                </div>
                                <div class="panel-body">
                                    <div id=""> <!--id="flotchart1"-->
                                        <canvas id="canvas"></canvas>
                                        <?php
                                            $chartText  = 'Items Sales Value';
                                            $itemName   = array();
                                            $salesQty   = array();
                                            $salesValue = array();
                                            foreach ($topTenSalesItem as $row) 
                                            {
                                                $itemName[]   = "'".$row->pro_item_name."'";
                                                $salesQty[]   = $row->sales_qty;
                                                $salesValue[] = $row->sales_amount;
                                            }
                                        ?>
                                        <script>
                                            var color = Chart.helpers.color;
                                            var barChartData = {
                                                labels: [<?php echo implode(',', $itemName);?>],
                                                datasets: [{
                                                    label: '<?php echo $chartText;?>',
                                                    backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                                                    borderColor: window.chartColors.red,
                                                    borderWidth: 1,
                                                    data: [<?php echo implode(',', $salesValue);?>]
                                                }]

                                            };
                                        </script>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="stats-info">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Top 10 Sale Items</h4>
                                </div>
                                <div class="panel-body">
                                    <ul class="list-unstyled">
                                        <?php
                                        foreach ($topTenSalesItem as $row) 
                                        {
                                            ?>
                                            <li><small><?php echo $row->pro_item_name;?></small>
                                                <div class="text-success pull-right"><?php echo $getCurrency;?> <?php echo number_format($row->sales_amount, 2)?><i class="fa fa-level-up"></i></div>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<input type="hidden" name="url"  id= "url" value="<?php echo base_url().'masters/User_registration/Change_Password';?>" />
<input type="hidden" name="update_date"  id= "update_date" value="<?php echo$password_update_date;?>" />
            <div class="col-lg-7 col-md-12">
                <div class="panel panel-white" style="height: 100%;">
                    <div class="panel-heading">
                        <h4 class="panel-title">Top 10 product group sales</h4>
                    </div>
                    <div class="panel-body">
                        <canvas id="chart-area" style="width: 100%;"></canvas>
                        <?php
                            $chartText      = 'Product group wise sales';
                            $groupName      = array();
                            $salesQty       = array();
                            $salesValue     = array();
                            $randomColor    = array();
                            foreach ($groupWiseSales as $row) 
                            {
                                $groupName[]    = "'".$row->pro_group_name."'";
                                $salesQty[]     = $row->sales_qty;
                                $salesValue[]   = $row->sales_amount;
                                $randomColor[]  = "'#".str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT)."'";
                            }
                        ?>
                        <script>
                        var config = {
                            type: 'pie',
                            data: {
                                datasets: [{
                                    data: [<?php echo implode(',', $salesValue);?>],
                                    backgroundColor: [<?php echo implode(',', $randomColor);?>],
                                    label: 'Dataset 1'
                                }],
                                labels: [<?php echo implode(',', $groupName);?>]
                            },
                            options: {
                                responsive: true
                            }
                        };

                        window.onload = function() 
                        {
var update_date =$('#update_date').val();
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = yyyy + '-' + mm + '-' + dd;

const oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
const firstDate = new Date(update_date);
const secondDate = new Date(today);

const diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));

if(diffDays>=89)
{
   if (confirm('Your password exceed today  please Update')) {
  // Save it!
  var url =  $('#url').val();
 window.location.href = url;
} else {
  // Do nothing!
  // console.log('Thing was not saved to the database.');
} 
}


                            var ctx = document.getElementById('canvas').getContext('2d');
                            window.myBar = new Chart(ctx, {
                                type: 'bar',
                                data: barChartData,
                                options: {
                                    responsive: true,
                                    legend: {
                                        position: 'top',
                                    },
                                    title: {
                                        display: true,
                                        text: 'Top Sales Item'
                                    }
                                }
                            });

                            var ctx = document.getElementById('chart-area').getContext('2d');
                            window.myPie = new Chart(ctx, config);
                        };
                        </script>                        
                    </div>
                </div>
            </div>
            <!--
            <div class="col-lg-5 col-md-6">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h4 class="panel-title">Weather</h4>
                        <div class="panel-control">
                            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Reload" class="panel-reload"><i class="icon-reload"></i></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="weather-widget">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="weather-top">
                                        <div class="weather-current pull-left">
                                            <i class="wi wi-day-cloudy weather-icon"></i>
                                            <p><span>83<sup>&deg;F</sup></span></p>
                                        </div>
                                        <h2 class="weather-day pull-right">Miami, FL<br><small><b>13th April, 2015</b></small></h2>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled weather-info">
                                        <li>Wind <span class="pull-right"><b>ESE 16 mph</b></span></li>
                                        <li>Humidity <span class="pull-right"><b>64%</b></span></li>
                                        <li>Pressure <span class="pull-right"><b>30.15 in</b></span></li>
                                        <li>UV Index <span class="pull-right"><b>6</b></span></li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled weather-info">
                                        <li>Cloud Cover <span class="pull-right"><b>60%</b></span></li>
                                        <li>Ceiling <span class="pull-right"><b>17800 ft</b></span></li>
                                        <li>Dew Point <span class="pull-right"><b>70?? F</b></span></li>
                                        <li>Visibility <span class="pull-right"><b>10 mi</b></span></li>
                                    </ul>
                                </div>
                                <div class="col-md-12">
                                    <ul class="list-unstyled weather-days row">
                                        <li class="col-xs-4 col-sm-2"><span>12:00</span><i class="wi wi-day-cloudy"></i><span>82<sup>&deg;F</sup></span></li>
                                        <li class="col-xs-4 col-sm-2"><span>13:00</span><i class="wi wi-day-cloudy"></i><span>82<sup>&deg;F</sup></span></li>
                                        <li class="col-xs-4 col-sm-2"><span>14:00</span><i class="wi wi-day-cloudy"></i><span>82<sup>&deg;F</sup></span></li>
                                        <li class="col-xs-4 col-sm-2"><span>15:00</span><i class="wi wi-day-cloudy"></i><span>83<sup>&deg;F</sup></span></li>
                                        <li class="col-xs-4 col-sm-2"><span>16:00</span><i class="wi wi-day-cloudy"></i><span>82<sup>&deg;F</sup></span></li>
                                        <li class="col-xs-4 col-sm-2"><span>17:00</span><i class="wi wi-day-sunny-overcast"></i><span>82<sup>&deg;F</sup></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h4 class="panel-title">Inbox</h4>
                        <div class="panel-control">
                            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Reload" class="panel-reload"><i class="icon-reload"></i></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="inbox-widget slimscroll">
                            <a href="#">
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="assets/images/avatar2.png" class="img-circle" alt=""></div>
                                    <p class="inbox-item-author">Sandra Smith</p>
                                    <p class="inbox-item-text">Hey! I'm working on your...</p>
                                    <p class="inbox-item-date">13:40 PM</p>
                                </div>
                            </a>
                            <a href="#">
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="assets/images/avatar3.png" class="img-circle" alt=""></div>
                                    <p class="inbox-item-author">Christopher</p>
                                    <p class="inbox-item-text">I've finished it! See you so...</p>
                                    <p class="inbox-item-date">13:34 PM</p>
                                </div>
                            </a>
                            <a href="#">
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="assets/images/avatar4.png" class="img-circle" alt=""></div>
                                    <p class="inbox-item-author">Amily Lee</p>
                                    <p class="inbox-item-text">This theme is awesome!</p>
                                    <p class="inbox-item-date">13:17 PM</p>
                                </div>
                            </a>
                            <a href="#">
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="assets/images/avatar5.png" class="img-circle" alt=""></div>
                                    <p class="inbox-item-author">Nick Doe</p>
                                    <p class="inbox-item-text">Nice to meet you</p>
                                    <p class="inbox-item-date">12:20 PM</p>
                                </div>
                            </a>
                            <a href="#">
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="assets/images/avatar2.png" class="img-circle" alt=""></div>
                                    <p class="inbox-item-author">Sandra Smith</p>
                                    <p class="inbox-item-text">Hey! I'm working on your...</p>
                                    <p class="inbox-item-date">10:15 AM</p>
                                </div>
                            </a>
                            <a href="#">
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="assets/images/avatar4.png" class="img-circle" alt=""></div>
                                    <p class="inbox-item-author">Amily Lee</p>
                                    <p class="inbox-item-text">This theme is awesome!</p>
                                    <p class="inbox-item-date">9:56 AM</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel twitter-box">
                    <div class="panel-body">
                        <div class="live-tile" data-mode="flip" data-speed="750" data-delay="3000">
                            <span class="tile-title pull-right">New Tweets</span>
                            <i class="fa fa-twitter"></i>
                            <div><h2 class="no-m">It???s kind of fun to do the impossible...</h2><span class="tile-date">10 April, 2015</span></div>
                            <div><h2 class="no-m">Sometimes by losing a battle you find a new way to win the war...</h2><span class="tile-date">6 April, 2015</span></div>
                        </div>
                    </div>
                </div>
                <div class="panel facebook-box">
                    <div class="panel-body">
                        <div class="live-tile" data-mode="carousel" data-direction="horizontal" data-speed="750" data-delay="4500">
                            <span class="tile-title pull-right">Facebook Feed</span>
                            <i class="fa fa-facebook"></i>
                            <div><h2 class="no-m">If you're going through hell, keep going...</h2><span class="tile-date">23 March, 2015</span></div>
                            <div><h2 class="no-m">To improve is to change; to be perfect is to change often...</h2><span class="tile-date">15 March, 2015</span></div>
                        </div>
                    </div>
                </div>
            </div>
            -->
            <div class="col-lg-5 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h4 class="panel-title">Top 10 moving items</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive project-stats">  
                           <table class="table">
                               <thead>
                                   <tr>
                                       <th>#</th>
                                       <th>Item</th>
                                       <th>Sales Qty</th>
                                       <th>Sales Value</th>
                                   </tr>
                               </thead>
                               <tbody>
                               <?php
                               $i = 1;
                               foreach ($topTenMovingItem as $row) 
                               {
                                  ?>
                                   <tr>
                                       <th scope="row"><?php echo $i++;?></th>
                                       <td><?php echo $row->pro_item_name;?></td>
                                       <td class="text-success"><?php echo $row->sales_qty;?> <small><?php echo $row->unit_name;?></small></td>
                                       <td><?php echo $getCurrency;?> <?php echo number_format($row->sales_amount, 2);?></td>
                                       <!--<td>
                                           <div class="progress progress-sm">
                                               <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                               </div>
                                           </div>                                       
                                        </td>-->
                                   </tr>
                                  <?php
                               }
                               ?>
                               </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Main Wrapper -->

</div><!-- Page Inner -->