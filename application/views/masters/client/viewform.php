  <div class="page-inner">
                <div class="page-title">
                    <h3><strong><?PHP echo $form_toptittle; ?></strong></h3>
                    <div class="page-breadcrumb">
                        <div class="row">
                            <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>"><strong><?php echo $this->lang->line('home')?></strong></a></li>
                            <li class="active"><?PHP echo $form_toptittle; ?></li>
                              <script src = "https://ajax.googleapis.com/ajax/libs/angularjs/1.3.3/angular.min.js">
                              </script>
                        </ol>
                    </div>
                         <div class="col-md-6" align="right">
                                      <a href="<?php echo base_url().'masters/Client/add_client';?>" style="text-align: right;" class="btn btn-primary "><?php echo $this->lang->line('add_new_client_button_name')?></a>
                                  </div>
                    </div>
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
                    </script>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-white">
                                 
                                <!-- <div class="panel-heading clearfix">
                                    <h4 class="panel-title"><?PHP echo $list_tittle; ?></h4>   
                                </div> -->
                                <div class="panel-body">
                                   <div class="table-responsive">
                                        <?php 
                                            echo $this->table->generate(); 
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row -->

                </div><!-- Main Wrapper -->
            </div>
  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">                       
                <div class="modal-content" id="viewajaxcontent">   
                </div>
            </div>
        </div>
<script type="text/javascript">
          function addrepModal(id)
          {
            $.ajax({
              type: "GET",
              url: "<?php echo site_url('masters/Client/addClientRep'); ?>",
              data: {client_id:id},
              dataType:"html",
              success: function(response)
              {
               
                jQuery('#viewajaxcontent').html(response);
                jQuery('.bs-example-modal-lg').modal('show', {});
                          
              },
            });
           
          }
          function AssignSupplier(id,status)
          {
             $.ajax({
                type: "GET",
                url: "<?php echo site_url('masters/Client/AssignSupplier'); ?>", 
                data: {user_id:id,status:status},
                dataType:"html",
                success: function(html)
                {
                     location.reload();
                },
              });
          }
        </script>