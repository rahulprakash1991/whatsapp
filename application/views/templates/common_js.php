<script type="text/javascript">

//var i = 1;

  $(document).ready(function ()
  {
      // Select2
      $('.select2').select2();

      //Date picker
      $('.single-daterange').daterangepicker({
        singleDatePicker: true,
        //showDropdowns: true
        locale: {
                  format: 'DD-MM-YYYY'
                }
      });

      //$('input.multi-daterange').daterangepicker({ "startDate": "03/28/2017", "endDate": "04/06/2017" });

      // Toggle Menu
      $('legend').click(function() {
          var $this = $(this);
          var parent = $this.parent();
          var contents = parent.contents().not(this);
          if (contents.length > 0) {
              $this.data("contents", contents.remove());
          } else {
              $this.data("contents").appendTo(parent);
          }
          return false;
      });

      <?php
      if($dataTableUrl)
      {
        ?>
          var oTable = $('#dataTableId').dataTable
              ({
                  "sScrollX"        : "100%",
                  "sScrollXInner"   : "110%",
                  "bScrollCollapse" : true,                
                  "bProcessing"     : true,
                  responsive        : true,
                  "sAjaxSource"     : '<?php echo base_url(); ?>index.php/<?php echo $dataTableUrl;?>',
                  "bJQueryUI"       : true,
                  "sPaginationType" : "full_numbers",
                  "iDisplayStart "  :20,
                      "oLanguage"   : {
                  "sProcessing"     : "<img src='<?php echo base_url(); ?>assets/ajax-loader_dark.gif'>"

              },
                "fnInitComplete": function()
                 {
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
        <?php 
      }
      ?>

      // When the form is submitted
      $("#ajaxModelForm, #ajaxModelForm1, #ajaxModelForm2").submit(function()
      {   // 'this' refers to the current submitted form 
        var str       = $(this).serialize();
        var actionUrl = $(this).data('action');
        var model_no1  = $(this).data('model_no');
        (typeof model_no1 == 'undefined') ? (model_no='1') : (model_no = model_no1);
        console.log(model_no);
        $.ajax({
        type: "POST",
        url: actionUrl, 
        data: {postdata: str},
        dataType:"html",
          success: function(html1)
          {
            try 
            {
              var parsedJson = JSON.parse(html1);
              if(parsedJson.result == 'success')
              {
                  var parsedJson = JSON.parse(html1);
                  $('#modal'+model_no).modal('hide');
                   $('.select2me').select2();
                  location.reload();
              }       
            } 
            catch(e) 
            {
              $("#body"+model_no).html("<p>"+html1+"</p>"); // msg in modal body
              $("#modal"+model_no).modal("show"); // show modal instead alert box
            }
          },
        });
      }); // end submit event 


      $("#ajaxModelFormWithFile").submit(function()
      { 
        // 'this' refers to the current submitted form 
        //var str       = $(this).serialize();
        var actionUrl = $(this).data('action');
        $.ajax({
        type: "POST",
        url: actionUrl, 
        data: new FormData( this ),
        processData: false,
        contentType: false, 
          success: function(html1)
          {
            try 
            {
              var parsedJson = JSON.parse(html1);
              if(parsedJson.result == 'success')
              {
                  var parsedJson = JSON.parse(html1);
                  $('#modal1').modal('hide');
                  location.reload();
              }       
            } 
            catch(e) 
            {
              $("#body1").html("<p>"+html1+"</p>"); // msg in modal body
              $("#modal1").modal("show"); // show modal instead alert box
            }
          },
        });
      }); // end submit event 
      

      // When the form is submitted
      $("#ajaxContentForm").submit(function()
      { 
        // 'this' refers to the current submitted form 
        var str       = $(this).serialize();
        var actionUrl = $(this).data('action');

        $.ajax({
        type: "POST",
        url: actionUrl, 
        data: {postdata: str},
        dataType:"html",
          success: function(html1)
          {
            try 
            {
              var parsedJson = JSON.parse(html1);
              if(parsedJson.result == 'success')
              {
                  var parsedJson = JSON.parse(html1);
                  $('#result').val(parsedJson.inserted_id);
                 console.log(parsedJson);
                  $('#modal2').modal('hide');
                  //location.reload();
              }       
            } 
            catch(e) 
            {
              $("#body2").html("<p>"+html1+"</p>"); // msg in modal body
              $("#modal2").modal("show"); // show modal instead alert box
            }
          },
        });
      }); 

      //Alert message fade
      $("#alert-message").fadeTo(2000, 500).slideUp(500, function(){
      $("#alert-message").slideUp(500);
      $("#alert-message").remove();
      });
    
      // Check all and un-check all for HR/attendance
      $("#checkAll").click(function(){
          $(".checkbox").prop("checked", true);
      });

      $("#uncheckAll").click(function(){
          $(".checkbox").prop("checked", false);
      });  
  });

  //Add new popup
  function addNewPop(addFormUrl, pkey)
  { 
      $.ajax({
      type: "GET",
      url: "<?php echo base_url();?>"+addFormUrl,
      data: {'pkey_id' : pkey},
      dataType:"html",
          success: function(html1)
          {      
              if(html1 != 'success')
              {
                // assigning modal title from parameter
                $("#body1").html("<p>"+html1+"</p>"); // msg in modal body
                $("#modal1").modal("show"); // show modal instead alert box
              }
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

    $("select.select2").select2();
    $('.single-daterange').daterangepicker({singleDatePicker: true,locale: {format: 'DD-MM-YYYY'}});
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

  function addTableContentPop(addFormUrl, pkey)
  { 
      $.ajax({
      type: "GET",
      url: "<?php echo base_url();?>"+addFormUrl,
      data: {'pkey_id' : pkey},
      dataType:"html",
          success: function(html1)
          {      
              if(html1 != 'success')
              {
                // assigning modal title from parameter
                $("#body2").html("<p>"+html1+"</p>"); // msg in modal body
                $("#modal2").modal("show"); // show modal instead alert box
                loadDeliveryNoteDropdown();
              }
          },
      });
  }
  
  function addTableContentPop1(addFormUrl, pkey)
  { 
      $.ajax({
      type: "GET",
      url: "<?php echo base_url();?>"+addFormUrl,
      data: {'pkey_id' : pkey},
      dataType:"html",
          success: function(html1)
          {      
             
                // assigning modal title from parameter
                $("#body1").html("<p>"+html1+"</p>"); // msg in modal body
                $("#modal1").modal("show"); // show modal instead alert box
              
          },
      });
  }

  function addDropdownPopup(addFormUrl, pkey)
  { 
      $.ajax({
      type: "GET",
      url: "<?php echo base_url();?>"+addFormUrl,
      data: {'pkey_id' : pkey},
      dataType:"html",
          success: function(html1)
          {      
              if(html1 != 'success')
              {
                // assigning modal title from parameter
                $("#body3").html("<p>"+html1+"</p>"); // msg in modal body
                $("#modal3").modal("show"); // show modal instead alert box
              }
          },
      });
  }

  //Delete function with sweet alert
  function confirmDelete(url)
  {
    if(arguments[0] != null)
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
            //swal("<?php echo lang('common_message_delete')?>", "", "success");
            location.href = url;

          } else 
          {
            swal("This operation has been cancelled", "", "error");
            //e.preventDefault();
          }
       });
     
    }
    else
    {
      return false;
    }
    return;
  }    

  //Checkbox show content
  function showContent(checkbox, contentDiv) 
  {
    if(checkbox.checked)
    {
        $(contentDiv).css('display', 'block');
    }else
    {
        $(contentDiv).css('display', 'none');
    }
  }

  //Checkbox show Multicontent BY CHANDRU
  function showMultiContent(checkbox, contentDiv, value) 
  {
    if(checkbox.checked)
    {
        $(contentDiv).css('display', 'block');
        $(value).css('display', 'none');
    }else
    {
        $(contentDiv).css('display', 'none');
        $(value).css('display', 'block');
    }
  }

  //Select box show content
  function showSelectContent(opt, contentDiv)
  {
    if(opt  ==  contentDiv)
    {
         $('#'+contentDiv).css('display', 'block');
    }
    else
    {
         $('#'+contentDiv).css('display', 'none');
    }
  }

  //Select box show content
  function showSelectContentremarks(opt, value)
  {
    if(opt  ==  3)
    {
         $('#'+value).css('display', 'block');
    }
    else
    {
         $('#'+value).css('display', 'none');
    }
  }

  //script for load leave approver name
  function loadleave_approver_name()
  {
    leave_approver_id = $('#leave_approver_id').val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Leaves_holiday/Leave_application/loadleave_approver_name',
      data : {'leave_approver_id' : leave_approver_id},
      success : function(data)
      {
        $('#leave_approver_name').val(data);
      },
    });
  }

  //Load Employee Name by praveen
  function loademployeename()
  {
    $employee_id = $('#employee_id').val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Employee_loan/Loan_application/getemployeename',
      data : {'employee_id' : $employee_id},
      success : function(data)
      {
        parseData = JSON.parse(data);
        $('#employee_name').val(parseData.employee_name);
        $('#company_id').select2('val', parseData.company_id);
      },
    });
  }

  

  //Load User name
  function loadusername()
  {
    $user_id = $('#user_id').val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Leaves_holiday/Leave_application/getusername',
      data : {'user_id' : $user_id},
      success : function(data)
      {
        $('#leave_approver_name').val(data);
      },
    });
  }

  /*  by uday dropdown select  */
  function showSelectContent1(opt,values1,values2)
  { 
    if (opt == "1")
    {
      $('#'+values1).css('display', 'block');
      $('#'+values2).css('display', 'none');
    }else if(opt == "2")
    {
      $('#'+values1).css('display', 'none');
      $('#'+values2).css('display', 'block');
    }else
    {
      $('#'+values1).css('display', 'none');
      $('#'+values2).css('display', 'none');
    }
  }

  //script for load ops form  by chandru
  function getops()
  { 
    $.ajax({
    type: "GET",
    url: "<?php echo base_url();?>manufacturing/Bill_of_materials/Master_production_schedule/ops", 
    data: {},
    dataType:"html",
        success: function(html1)
        {
            if(html1 != 'success')
            {
              // assigning modal title from parameter
              $(".modal-title").html("Operation Process Sheet Form"); 
              $(".modal-body").html("<p>"+html1+"</p>"); // msg in modal body
              $(".modal").modal("show"); // show modal instead alert box
            }
        },
    });
  }

  //script for load Alternate Dropdown From checkbox in Ops form  by chandru
  $(function () 
  {
      $("#alternate_item").click(function () {
          if ($(this).is(":checked")) {
              $("#content_ts").show();
          } else {
              $("#content_ts").hide();
          }
      });
  });

  //Work order generation radio button selection by sivanesh
  $(function () {
        $("input[name='icon']").click(function () {
            if ($("#chkYes").is(":checked")) {
                $("#dvbyworkorder").show();
                $("#dvbycustomer").hide();
            } else {
              $("#dvbyworkorder").hide();
                $("#dvbycustomer").show();
                $("#dvsales").show();
                $("#dvmultipletable").hide();
            }
        });
    });

  //Work order generation dropdown selection to show/hide table by sivanesh
  $(function () {
        $("#dvtable").change(function () {
            if ($(this).val() == "multiple") {
                $("#dvsales").hide();
                $("#dvmultipletable").show();
            }else{
              $("#dvsales").show();
                $("#dvmultipletable").hide();
            }
        });
    });

  //Load details for trainer by praveen
  function loadDetails()
  {
    trainer_id = $('#trainer_id').val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Training/Training_event/loadDetails',
      data : {'trainer_id' : trainer_id},
      success : function(data)
      {         
        parseData = JSON.parse(data);
        $('#trainer_email').val(parseData.trainer_email);
        $('#contact_number').val(parseData.trainer_contact);
        $('#company_id').select2('val', parseData.company_id);
      },
    });
  }

  function loadTranierName()
  {
    training_event_id = $('#training_event_id').val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Training/Training_feedback/getTranierName',
      data : {
        'training_event_id' : training_event_id},
      success : function(data)
      {         
        parseData = JSON.parse(data);
         $('#trainer_name').val(parseData.trainer_name);
      },
    });
  }

  //counthalfdays in leave application by dhanam
  function counthalfdays(val)
  {
    if($('#half_day').is(':checked'))
    {

      from_date       = $('#from_date').val();
      to_date         = $('#to_date').val();
      half_day_date   = $('#half_day_date').val();
      $.ajax
      ({
        type : "POST",
        url  : '<?php echo base_url();?>hr/Leaves_holiday/Leave_application/halfdaydiff',
        data : {
                'from_date' : from_date,
                'to_date' : to_date,
                'half_day_date' : half_day_date,
              },
        success : function(data)
        {         
          $('#total_leave_days').val(data);
        },
      });
    }
    else
    {
      from_date   = $('#from_date').val();
      to_date   = $('#to_date').val();

      $.ajax
      ({
        type : "POST",
        url  : '<?php echo base_url();?>hr/Leaves_holiday/Leave_application/daydiff',
        data : {
                  'from_date' : from_date,
                  'to_date' : to_date,
              },
        success : function(data)
        {

         $('#total_leave_days').val(data);
        },
      });
    }
  } 
 
  function loadVehicle()
  {
    vehicle_id = $('#vehicle_id').val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Fleet_management/Vehicle_log/getVehicle',
      data : {'vehicle_id' : vehicle_id},
      success : function(data)
      {         
        parseData = JSON.parse(data);
        $('#make').val(parseData.make);
        $('#model').val(parseData.model);
      },
    });
  }  

  // Get End Date 
  function loadEnddate(val)
  {
    from_date   = $('#from_date').val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Leaves_holiday/Holiday_list/getToDate/',
      data : {
        'from_date' : from_date,
    },
      success : function(data)
      {         
       $('#to_date').val(data);
      },
    });
  }

  function loadTodate(val)
  {
    from_date   = $('#from_date').val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Payroll/Salary_structure/getToDate/',
      data : {
        'from_date' : from_date,
    },
      success : function(data)
      {         
       $('#to_date').val(data);
      },
    });
  } 

  // Get WeekOff Days 
  function LoadWeekOff(val)
  {
    from_date = $('#from_date').val();
    to_date   = $('#to_date').val();
    holliday_list_weekly_off_id = $('#holliday_list_weekly_off_id').val();

    $.ajax
    ({
      type : "POST",
      dataType:'html',
      url  : '<?php echo base_url();?>hr/Leaves_holiday/Holiday_list/getWeekOff/',
      data : 
      {
        'from_date' : from_date,
        'to_date'   : to_date,
        'holliday_list_weekly_off_id' : holliday_list_weekly_off_id,
      },
      success : function(htmlContent)
      {     
        $('#holidayList').html(htmlContent);
      }
    });
  }

  //HR Module Loan application Dropdown
  function loadrepayment(opt)
  {
    if(opt == '1')
    {
      $('#Repayfixedamount').css('display', 'block');
      $('#Repayovernumber').css('display', 'none');
    }else
    {
      $('#Repayfixedamount').css('display', 'none');
      $('#Repayovernumber').css('display', 'block');
    }
  }

  //HR Module Loan application rejection remarks
  function loadRejectionRemarks(opt)
  {
    if(opt == 3)
    {
      $('#rejection_remarks').css('display', 'block');
     
    }else
    {
      $('#rejection_remarks').css('display', 'none');
    }
  }

  // Check all and un-check all for HR/attendance
  $(function () 
  {
    $("#checkAll").click(function(){
        $(".checkbox").prop("checked", true);
    });

    $("#uncheckAll").click(function(){
        $(".checkbox").prop("checked", false);
    });  
  });

  function addEmployee()
  {
    branch_id     = $('#branch_id').val();
    company_id    = $('#company_id').val();
    department_id = $('#department_id').val();

    $.ajax
    ({
      type : "POST",
      dataType:'html',
      url  : '<?php echo base_url();?>hr/Employee_attendance/Employee_attendance/getEmployeeDetails/',
      data : {

                'branch_id' : branch_id,
                'company_id' : company_id,
                'department_id' : department_id
            },
      success : function(html1)
      {
        $('#employeeAttendanceData').html(html1);
      }
    });
  }

  function getCheckedCheckboxesFor(attendanceStatus) 
  {
      var checkboxes = $(".employeeList:checked"), values = [];
      Array.prototype.forEach.call(checkboxes, function(el){
        if(!el.disabled)
        {
          values.push(el.value);
        }
      });         

      $("#employeeList_"+attendanceStatus).val(values);

      presentList = $("#employeeList_1").val();
      absentList  = $("#employeeList_2").val();
      halfDayList = $("#employeeList_3").val();
      leaveList   = $("#employeeList_4").val();

      //AjaxCall
      $.ajax
      ({
        type : "POST",
        url  : '<?php echo base_url();?>hr/Employee_attendance/Employee_attendance/loadDetails/',
        data : {
                  'presentList'   : presentList,
                  'absentList'    : absentList,
                  'halfDayList'   : halfDayList,
                  'leaveList'     : leaveList
               },
        success : function(data)
        {        
          $('#employeeAttendanceContent').html(data);
          
          $(".employee_id").each(function()
          {
            employee_id = $(this).data('id');
            $('#employee_id_'+employee_id).prop('disabled', true);
          });
        },
      });
  }

  //Load details for Loan Type by Manoj
  function loadLoanDetails()
  {
    loan_type_id = $('#loan_type_id').val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Employee_loan/Loan_application/loadLoanDetails',
      data : {'loan_type_id' : loan_type_id},
      success : function(data)
      {         
        parseData = JSON.parse(data);
        $('#rate_of_interest').val(parseData.rate_of_interest);
      },
    });
  }

  // Calculate total payable interest and total payable amount in employee loan application by Manoj
  function calculateInterest()
  {
    var repay_period        = $('#emp_loan_repayment_method_id').val();
    var loan_amount         = $('#maximum_loan_amount').val();
    var rate_of_interest    = $('#rate_of_interest').val();
    var no_of_months        = $('#repayment_periods').val();
    var repay_month_amount  = $('#repayment_amount').val();
    var no_of_periods       = no_of_months/12;

      if(repay_period == 2)
      {
        var payable_interest        = (Number(loan_amount)*Number(no_of_periods)*Number(rate_of_interest))/100;
        $('#total_payable_interest').val(payable_interest.toFixed(2));

        var repay_amount            = Number(loan_amount)/Number(no_of_months);
        $('#repayment_amount').val(repay_amount.toFixed(2));

        var total_payable_amount    = Number(payable_interest)+Number(loan_amount);
        $('#total_payable_amount').val(total_payable_amount.toFixed(2));
      }
      else 
      {
        var repay_month_period      = Number(loan_amount)/Number(repay_month_amount);
        $('#repayment_periods').val(repay_month_period.toFixed(0));

        var payable_interest        = (Number(loan_amount)*Number(repay_month_period)/12*Number(rate_of_interest))/100;
        $('#total_payable_interest').val(payable_interest.toFixed(2));

        var total_payable_amount    = Number(payable_interest)+Number(loan_amount);
        $('#total_payable_amount').val(total_payable_amount.toFixed(2)); 
      }
  }

  // Load repayment period and repayment amount
  function showSelectContentrepayment(opt,values1)
  { 
    if (opt == "1")
    {
      $('#repaymentAmountContent').show();
      $('#repayment_amount').attr("readonly",false);
      $('#repayment_periods').attr("readonly",true); 
      $('#repayment_periods').val('');
      $('#repayment_amount').val('');
    }else if(opt == "2")
    {
      $('#repaymentAmountContent').show();
      $('#repayment_periods').attr("readonly",false);
      $('#repayment_amount').attr("readonly",true);
      $('#repayment_amount').val('');
      $('#repayment_periods').val('');
    }
  }
  
  //Load Salary Earning abbr For Salary Structure by KR
  function loadSalaryearn_abbr(id,val)
  {
    var id             =   id;
    var thenum           =   id.match(/\d+$/)[0];
    salary_component_id  =   $('#salary_component_id_earing'+thenum).val();
      
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Payroll/Salary_structure/getsalary_earnabbr',
      data : {'salary_component_id' : salary_component_id},
      success : function(data)
      {
         $('#salary_component_abbr_earing'+thenum).val($.trim(data));
      },
    });
  }


  //Load Salary Deduction For Salary Structure abbr by KR
  function loadSalarydeduct_abbr(id,val)
  {
    var id             =   id;
    var thenum           =   id.match(/\d+$/)[0];
    salary_component_id  =   $('#salary_component_id_deduction'+thenum).val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Payroll/Salary_structure/getsalary_deductabbr',
      data : {'salary_component_id' : salary_component_id},
      success : function(data)
      {
        $('#salary_component_abbr_deduction'+thenum).val($.trim(data));
      },
    });
  }
  
  //Calculate halday
  function halfdaydate()
  {
      if($('#half_day').is(':checked'))
      {
      $('#halfday').css('display', 'block');
      }
      else
      {
          $('#halfday').css('display', 'none'); 
      }
  }

  // unused leaves for leave application  
  function leavebalance(val)
  {
    total_leaves_allocated   = $('#total_leaves_allocated').val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Leaves_holiday/Leave_application/getleavebalance/',
      data : {
        'total_leaves_allocated' : total_leaves_allocated,
    },
      success : function(data)
      {         
       $('#leave_balance').val(data);
      },
    });
  } 

  //Block Leaves
  function blockLeaves(val)
  {
    from_date = $('#from_date').val();
    to_date   = $('#to_date').val();
    $.ajax
    ({
        type : "POST",
        url  : '<?php echo base_url();?>hr/Leaves_holiday/Leave_application/blockLeaves/',
        data : {
                from_date: from_date,
                to_date: to_date,
               },
      success : function(data)
      {
        if(data == 0)
        {
         
        } 
        else
        {
          alert('These dates are in block list!!!!');
        }
      }
    });
  }

  function carryforwardleaves()
  {
    employee_id = $('#employee_id').val();
    total_leaves_allocated = $('#total_leaves_allocated').val();
    //alert(total_leaves_allocated);
    
      $.ajax
      ({
        type : "POST",
        url  : '<?php echo base_url();?>hr/Leaves_holiday/Leave_allocation/gettotalleavesallocated',
        data : {
                 'employee_id' : employee_id,
                 'total_leaves_allocated' : total_leaves_allocated
                },
        success : function(data)
        {  

         $('#carry_forwarded_leaves').val(data);

        },
      });
  }

  function loadUnusedLeaves(checkbox, contentDiv)
  {
    if(checkbox.checked)
    {
        carry_forward   = $('#carry_forward').val();
        employee_id     = $('#employee_id').val();
        leave_type_id   = $('#leave_type_id').val();
        $.ajax
        ({
            type : "POST",
            url  : '<?php echo base_url();?>hr/Leaves_holiday/Leave_allocation/loadUnusedLeaves',
            data : {'carry_forward' : carry_forward,
                    'employee_id'   : employee_id,
                    'leave_type_id' : leave_type_id
                    }, 
            success : function(data)
            {
                //parseData = JSON.parse(data);
                $('#unused_leaves').show();
                carryforwardleaves();

                var new_leaves      = $('#new_leaves_allocated').val();
                var unused_leaves   = $('#carry_forwarded_leaves').val();
                var total_leaves    = new_leaves+unused_leaves;

                $('total_leaves_allocated').val(total_leaves);
            },
        });
    }
    else
    {
        $('#unused_leaves').hide();
        var new_leaves    = $('#new_leaves_allocated').val();
        $('#total_leaves_allocated').val(new_leaves);  
    }
  }

  $("#new_leaves_allocated").keyup(function()
  {
    $("#total_leaves_allocated").val($(this).val());
  });

  function Iscritical()
  {
      if($('#is_critical').is(':checked'))
      {
      $('#disabled').css('display', 'none');
      }
      else
      {
          $('#disabled').css('display', 'block'); 
      }
  }

  function loadcurrency(val)
  {

    price_list_id   = $('#price_list_id').val();
    $.ajax
    ({

      type : "POST",
      url  : '<?php echo base_url();?>inventory/Items_and_pricing/Item_price/getcurrency',
      data : {
        'price_list_id' : price_list_id,
    },
      success : function(data)
      {         
        parseData = JSON.parse(data);
        $('#currency').val(parseData.currency);
        if(parseData.buying  == '1')
        {
          $("#buying").attr('checked', 'true');
        }
        if(parseData.selling  == '1')
        {
        $("#selling").attr('checked', 'true');
        }
      },
    });
  }


  // Below code for Salary silp  And Salary Strcuture author by @ KarthiRam
  function salaryStructureEmployee()
  {
      employee_id             = $('#employee_id').val();
      $.ajax
      ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Payroll/Salary_slip/loadEmployeeDetails/',
      data : {
        'employee_id' : employee_id,
      },
        success : function(data)
        {


            parseData = JSON.parse(data);
            $('#employee_name').val(parseData.employee_name);
            $('#company_id').val(parseData.company_name);
            $('#department_id').val(parseData.department_name);
            $('#branch_id').val(parseData.branch);
            $('#designation_id').val(parseData.designation_name);
            $('#payroll_frequency_id').select2('val', parseData.payroll_frequency_id);
            $('#letter_head_id').select2('val', parseData.letter_head_id);
            $('#salary_structure_id').select2('val', parseData.salary_structure_id);
            $('#base').val(parseData.base);
            calculateWorkingdays();
        },
      });
  }

  // Below code for Salary silp  And Salary Strcuture author by @ KarthiRam
  function salaryslipGetToDate()
  {
      posting_date            = $('#posting_date').val();
      payroll_frequency_id    = $('#payroll_frequency_id').val();
      $.ajax
      ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Payroll/Salary_slip/getToDate/',
      data : {
        'posting_date' : posting_date,
        'payroll_frequency_id' : payroll_frequency_id,
      },
          success : function(data)
      {

          $('#start_date').val(posting_date);
          $('#end_date').val(data);
          
      },
      });
  }

  // Below code for Salary silp And Salary Strcuture author by @ KarthiRam
  function getComponent()
  {
      salary_structure_id            = $('#salary_structure_id').val();
      $.ajax
      ({
        type : "POST",
        url  : '<?php echo base_url();?>hr/Payroll/Salary_slip/getComponent/',
        data : {'salary_structure_id' : salary_structure_id,},
            success : function(htmlContent)
            {
                $('#Earning').html(htmlContent);
               // $('#DeductionData').html(htmlContent);
            },
      });
     
      if(salary_structure_id != '')
      {
            $.ajax
            ({
            type : "POST",
            url  : '<?php echo base_url();?>hr/Payroll/Salary_slip/getDedComponent/',
            data : {
              'salary_structure_id' : salary_structure_id,
            },
                success : function(htmlContent)
                {
                   // $('#EarningData').html(htmlContent);
                    $('#Deduction').html(htmlContent);
                },
            });
      }
  }
  // Below code for Salary silp And Salary Strcuture 
  function calculateWorkingdays()
  {
      start_date              = $('#start_date').val();
      end_date                = $('#end_date').val();
      employee_id             = $('#employee_id').val();
              hour_rate                   = $('#hour_rate').val();
        total_working_hours         = $('#total_working_hours').val();

      $.ajax
      ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Payroll/Salary_slip/calculateSalary/',
      data : {
        'from_date' : start_date,
        'to_date' : end_date,
        'employee_id' : employee_id,
        'hour_rate' : hour_rate,
        'total_working_hours' : total_working_hours,

      },
      success : function(data)
      {
          parseData = JSON.parse(data);

          $('#total_working_days').val(parseData.total_working_days);
          $('#payment_days').val(parseData.payment_days);
          $('#leave_without_pay').val(parseData.leave_without_pay);
          $('#payment_days').val(parseData.payment_days);
          $('#salary_component_earning').select2('val', parseData.salary_component_id);
          $('#salary_component_abbr_ear').val(parseData.salary_component_abbr_ear);
          $('#salary_component_formula_ear').val(parseData.salary_component_formula_ear);
          $('#gross_pay').val(parseData.totalEarnings);
          $('#total_deduction').val(parseData.totalDeduction);
          $('#net_pay').val(parseData.totalEarnings-parseData.totalDeduction);
          $('#rounded_total').val(parseData.totalEarnings-parseData.totalDeduction);
      },
      });
  }

  //Load Appraisal Tem[plate
  function getAppraisalTemplate()
  {
      appraisal_template_id            = $('#appraisal_template_id').val();
      $.ajax
      ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Appraisals/Appraisal/getAppraisalTemplate/',
      data : {
        'appraisal_template_id' : appraisal_template_id,
              },
      dataType : 'JSON',

          success : function(response)
          {
              $('#template_goal').html(response['templateContent']);


          },
      });
  }
  // Calculate total score based on kra  
  function calculateScore() 
  {
    $('.all_row_values').each(function(i,o){
      weightAge       = $(o).find('.weight_age').val()/100;
      score           = $(o).find('.score').val();
      if(score > 5)
      {
        swal({
              title: "Score must be less than or equal to 5",
              type: "warning",
              confirmButtonColor: '#339eff',
              confirmButtonText: "Ok",
           })
        $(o).find('.score').val('');
        $(o).find('.score_earned').val('');

      }
      else
      {
        var total = 0;

        scoreEarned    = Number(weightAge) * Number(score);

        $(o).find('.score_earned').val(scoreEarned.toFixed(2));
        $('.score_earned').each(function() 
        {
            total += Number($(this).val());
            var count = $('.score_earned').length;
            totalAvg = total/count;
            $('#total_score').val(totalAvg.toFixed(2));
        });
      }
      
    });
  }
  
  // Calculate Purchase Tax for supplier Quotation  author by @ KarthiRam
  function getAddress()
  {
    address_id = $('#address_id').val();
    
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>purchase/Purchasing/Supplier_quotation/getAddress',
      data : {'address_id' : address_id},
      success : function(data)
      {
        $('#address_display').val($.trim(data));
      },
    });
  }
  
  // Calculate Purchase Tax for supplier Quotation author by @ KarthiRam
  function getContact()
  {
    contact_id = $('#contact_id').val();
    
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>purchase/Purchasing/Supplier_quotation/getContact',
      data : {'contact_id' : contact_id},
      success : function(data)
      {         
        parseData = JSON.parse(data);
        $('#contact_display').val(parseData.first_name);
        $('#contact_email').val(parseData.email_address);
        $('#contact_mobile').val(parseData.mobile_no);
      },
    });
  }
  
  // Calculate Purchase Tax for supplier Quotation author by @ KarthiRam
  function getTaxCharage()
  {
    taxes_charges_template_id = $('#taxes_charges_template_id').val();
    
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>purchase/Purchasing/Supplier_quotation/getTaxCharage',
      data : {'taxes_charges_template_id' : taxes_charges_template_id},
      success : function(data)
      {         
       
        $('#TaxData').html(data);
         calculateTotalTaxAmount();
      },
    });
  }
  
  // Calculate Purchase Tax for supplier Quotation author by @ KarthiRam
  function discountCalculation()
  {
    discount_amount = 0;
    var additional_discount_percentage  = $('#additional_discount_percentage').val()/100;
    var total_amount          = $('#total_amount').val();

    var discount_amount = Number(additional_discount_percentage)*Number(total_amount);
    $('#base_discount_amount').val(discount_amount.toFixed(2));

    var grand_total = Number(total_amount) - Number(discount_amount);
    $('#grand_total').val(grand_total)
  }
  
  // Calculate Purchase Tax for supplier Quotation author by @ KarthiRam
  function calculateTotalTaxAmount() 
  {
    totalTaxAmount = 0;
    $('.calculation').each(function()
    {
      totalTaxAmount              += Number($(this).val());
      var total_amount_added       = $('#total_amount_added').val(totalTaxAmount.toFixed(2));
      var total_amount_deducted    = $('#total_amount_deducted').val();
      $('#total_amount').val(totalTaxAmount.toFixed(2));
    });
  }

  //Total Calculation For Grand Amount base on Purchase Tax and item Amount for supplier Quotation(Using All Quotation Calculation Process) author by @ KarthiRam
  function grandTotal()
  { 
    var str =$('#supplier_quo_apply_addi_disc_id').val();
    
    if ( str == "1")
    {
         discount_amount = 0;
        //alert('hi');
        var net_item_amount                 =  Number($('#net_rate').val());
        var total_tax_amount                = $('#total_amount').val();
        var  total_amount                   = Number(net_item_amount) + Number(total_tax_amount);
        var additional_discount_percentage  = $('#additional_discount_percentage').val()/100;
        var base_discount_amount            =  Number(total_amount)*Number(additional_discount_percentage);
        $('#base_discount_amount').val(base_discount_amount.toFixed(2));
        var  grand_total_amount             = Number(total_amount) - Number(base_discount_amount);
        $('#grand_total').val(grand_total_amount.toFixed(2));
      
    }
    else
    {
        var net_amount                      = Number($('#net_rate').val());
        var additional_discount_percentage  = $('#additional_discount_percentage').val()/100;
        var base_discount_amount            =  Number(net_amount)*Number(additional_discount_percentage);
        $('#base_discount_amount').val(base_discount_amount.toFixed(2));
        
        var  grand_total_amount             = Number(net_amount) - Number(base_discount_amount);        
        $('#grand_total').val(grand_total_amount.toFixed(2));
    }
  }

  
  // Load Exchange Rate by Manojkumar
  function exchangeRate(opt)
  {
    if(opt == '1')
    {
      $('#exchangeRate').css('display', 'none');
    }
    else
    {
      $('#exchangeRate').css('display', 'block');
    }
  }

  function getItemRate()
  {
      
      item_id = $('#item_id').val();
      $.ajax
      ({
        type : "POST",
        url  : '<?php echo base_url();?>purchase/Purchasing/Supplier_quotation/getItemRate',
        data : {'item_id' : item_id},
        success : function(data)
        {         
         
          parseData = JSON.parse(data);
          $('#item_rate').val(parseData.item_rate);     
        },
      });
  }

  function calculateAmount(val)
  {
      var qty =  Number($('#qty').val());
      var rate =  Number($('#item_rate').val());
      var net_amount =qty*rate;

      $('#net_amount').val(net_amount);
      var final  = $('#net_amount').val();
      $('#net_rate').val(final);
  } 

  function getTaxCharagePurchase()
  {
    taxes_charges_template_id = $('#taxes_charges_template_id').val();

    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>inventory/Stock_transactions/Purchase_receipt/getTaxCharagePurchase',
      data : {'taxes_charges_template_id' : taxes_charges_template_id},
      success : function(data)
    {         
      $('#TaxData').html(data);
      calculateTotalTaxAmount();
    },
    });
  }
  

  function calculatePurchaseTaxAmount() 
  {
    totalTaxAmount = 0;
    
    $('.totalTax').each(function()
    {
      totalTaxAmount              += Number($(this).val());
      var total_amount_added       = $('#total_amount_added_purchase').val(totalTaxAmount);
      var total_amount_deducted    = $('#total_amount_deducted_purchase').val();
      $('#total_amount_purchase').val(totalTaxAmount);
    });
  }
  
  //Load  Term And Conditions Description author @ Manojkumar
  function loadTermAndConditions()
  {
    tc_id   = $('#tc_id').val();
    
    $.ajax
    ({
        type : "POST",
        url  : '<?php echo base_url();?>inventory/Stock_transactions/Purchase_receipt/getTermsAndConditions/',
        data : {'tc_id' : tc_id},
        success : function(data)
        {
          $('#terms_conditions').val($.trim(data));          
        },
    });
  }
   //Load  Supplier Address Id author @ Manojkumar
  function loadSupplierAddress()
  {
    supplier_id   = $('#supplier_id').val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>inventory/Stock_transactions/Purchase_receipt/getSupplierAddress/',
      data : {'supplier_id' : supplier_id},
      success : function(data)
      {
        $('#supplier_quo_address_id').html(data);
        loadSupplierContact();
        loadFullAddress();
        showSupplierAddress(opt);
      },
    });
  }
   //Load  Supplier Address author @ Manojkumar
  function loadFullAddress()
  {
    supplier_quo_address_id   = $('#supplier_quo_address_id').val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>inventory/Stock_transactions/Purchase_receipt/getFullAddress/',
      data : {
      'supplier_quo_address_id' : supplier_quo_address_id
    },
    success : function(data)
    {
      $('#show_supplier_address').show();
      $('#full_address').val($.trim(data));

    },
    });
  }
 //Load  Supplier Contact author @ Manojkumar
  function loadSupplierContact()
  {
    supplier_id   = $('#supplier_id').val();
    
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>inventory/Stock_transactions/Purchase_receipt/getSupplierContact/',
      data : {'supplier_id' : supplier_id},
      success : function(data)
      {
        $('#contact_person_id').html(data);
        loadContactmobile();
      },
    });
  }
  //Load  Supplier Mobile  No author @ Manojkumar
  function loadContactmobile() 
  {
    contact_person_id   = $('#contact_person_id').val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>inventory/Stock_transactions/Purchase_receipt/getContactmobile/',
      data :{
              'contact_person_id' : contact_person_id
            },
      success : function(data)
        {
         parseData = JSON.parse(data);
          $('#contact_mobile').val(parseData.mobile_no);
          $('#contact_email').val(parseData.email_address);
          
        },
    });   
  }

  //Get  Item rate and qty base on  Load each item amount  author @ KR
  function itemGetAmount(id, val)
  {
      var id          =   id;
      var thenum      =   id.match(/\d+$/)[0];
      item_id         =   $('#item_id'+thenum).val();
      qty             =   $('#qty'+thenum).val();
      
      $.ajax
      ({
          type : "POST",
          url  : '<?php echo base_url();?>inventory/Stock_transactions/Stock_entry/getValuationRate/',
          data : {'item_id'   : item_id,'qty'       : qty},
          success : function(data)
          {  
              parseData = JSON.parse(data);
              $('#net_amount'+thenum).val(parseData.totalIncomeValue);
              $('#uom_id'+thenum).select2('val', parseData.uom_id);
              $('#income_value'+thenum).val(parseData.standard_rate);
              calculateTotalItemNetAmount(); net_amount
          },
      });
  }
  
  // Load item Total  amount  author @ KR
  function calculateTotalItemNetAmount() 
  {
      total_item_rate = 0;
     
      $('.all_row_values').each(function()
      {
        total_item_rate       += Number($(this).val());
        $('#net_rate').val(total_item_rate);
      });
  }

  function loadpricelist(id)
  {
      var id                  = id;
      var thenum              = id.match(/\d+$/)[0];
      $('#rate'+thenum).val('');
      $('#qty'+thenum).val('');
      $('#net_amount'+thenum).val('');
      $('#additional_discount_percentage').val('');
      $('#discount_amount').val('');
      $('#rounded_total').val('');
      $('#grand_total').val('');
      
      item_id                 = $('#item_id'+thenum).val();
      price_list_id           = $('#ignore_pricing_rule').val();
      var ignore_pricing_rule = $("#ignore_pricing_rule").is(':checked');
     
      $.ajax
      ({
          type : "POST",
          url  : '<?php echo base_url();?>sales/Sales/Quotation/getpricelistrate',
          data : {'item_id' : item_id,
                  'price_list_id' : price_list_id
                  },
          success : function(data)
          {         
              parseData = JSON.parse(data);
              if(ignore_pricing_rule)
              {
                  $('#rate'+thenum).val(parseData.price_listitem_rate);     

              }
              else
              {
                  $('#rate'+thenum).val(parseData.standard_selling_rate);     
     
              }
          },
      }); 
      $('.dataTables_filter input').addClass('form-control');
  }

  function loadItemName(id, val)
  {
      var id              =   id;
      var thenum          =   $("#"+id).attr('data-row');
      var item_id         =   $('#item_id'+thenum).val();
      
      $.ajax
      ({
          type : "POST",
          url  : '<?php echo base_url();?>maintenance/Maintenance_schedule/getItemName',
          data : {'item_id' : item_id},
          success : function(data)
          {
              $('#item_name'+thenum).val(data);
          },
      });
  }

  function loadSalesrate(id)
  {
    var id           =   id;
    var thenum       =   id.match(/\d+$/)[0];
    var charge_type  =   $('#charge_type'+thenum).val();
    
    if(charge_type == 1)
    {
        $('#tax_amount'+thenum).keyup(function(event) 
        { 
            var stt = $(this).val(); 
            $('#total'+thenum).val(stt); 
        });
    }
  }
</script>

