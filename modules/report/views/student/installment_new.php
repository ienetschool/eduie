
<?php
?>
<style>

@media print { 
    
    html {
        margin-left:30px;
    }
}
</style>

<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
       <div class="x_panel">
           <div class="x_title">
               <h3 class="head-title"><i class="fa fa-bar-chart"></i><small>Installment wise <?php echo $this->lang->line('report'); ?></small></h3>                
               <ul class="nav navbar-right panel_toolbox">
                   <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
               </ul>
               <div class="clearfix"></div>
           </div>
           <div class="x_content quick-link no-print">
           <?php $this->load->view('quick-link.php'); ?>  

           </div>            
            <div class="x_content filter-box no-print">
            <?php
           
                    echo form_open_multipart(site_url('report/installment_wise_new'), array('name' => 'student', 'id' => 'student', 'class' => 'form-horizontal form-label-left'), '');
                    $class_name ="";
                    $fee_type_name ="";
                ?>
               <div class="row">   
               <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group item">
                        <div>Filter Type <span class="required"> *</span> </div>

                        <select name="filter_type" class="form-control col-md-7 col-xs-12" id="filter_type" required="required">
                        <option value="class">-- Select Filter Type --</option>
                            <option value="class" <?php echo isset($filter_type) && $filter_type == "class" ? "selected='selected'" : "" ; ?> >Class Wise</option>
                            <?php if(($this->session->userdata('role_id') == SUPER_ADMIN || $this->session->userdata('dadmin') == 1)) {?>
                                <option value="school"  <?php echo isset($filter_type) && $filter_type == "school" ? "selected='selected'" : "" ; ?>>School Wise</option>
                                <?php if($this->session->userdata('role_id') == SUPER_ADMIN ) {?>
                            <option value="prant"  <?php echo isset($filter_type) && $filter_type == "prant" ? "selected='selected'" : "" ; ?>>Prant Wise</option>
                            <option value="district"  <?php echo isset($filter_type) && $filter_type == "district" ? "selected='selected'" : "" ; ?>>District Wise</option>
                            <?php }?>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 district_cols" id="district_col">

                       <div class="form-group item">
                       <div>District </div>

                          <select name="district_id" class="form-control col-md-7 col-xs-12" id="district_select">
                                <option value="">-- Select District --</option>
                                <?php foreach($districts as $district) { 
                                    if(isset($filter_type) && $filter_type == "school" && isset($district_id) && $district_id == $district->id)
                                    {
                                        $filter_head = $district->name ;
                                    }
                                    ?>
                                    <option value="<?php echo  $district->id  ?>" <?php echo isset($district_id) && $district_id == $district->id ? "selected='selected'" : "" ; ?> ><?php echo  $district->name  ?></option>
                                <?php } ?>
                             
                          </select>
                       </div>
                   </div>
               <?php $this->load->view('layout/school_list_filter'); ?>
                
                <div class="col-md-3 col-sm-3 col-xs-12 school_coloumns">
                        <div class="form-group item">
                        <div>Academic Year <span class="required"> *</span></div>

                        <select name="academic_year_id_filter" class="form-control col-md-7 col-xs-12" id="academic_year_id"  required="required">
                        <option value="">-- Select Academic Year --</option>
                        <?php foreach($academic_years as $academic_year) {
                            ?>
                                    <option value="<?php echo  $academic_year->id  ?>" <?php echo isset($academic_year_id) && $academic_year_id == $academic_year->id ? 'selected="selected"' : "" ; ?> ><?php echo  $academic_year->session_year  ?></option>
                                <?php } ?>
                        </select>
                        </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 district_cols">

                        <div class="form-group item">
                        <div>Fee Type <span class="required"> *</span></div>

                        <select name="income_head_id_" class="form-control col-md-7 col-xs-12"  required="required">
                        <option value="">-- Select Fee Type --</option>
                            <option value="1" <?php echo isset($income_head_id) && $income_head_id == 1 ? "selected='selected'" : "" ; ?> >Tution Fee</option>
                            <option value="2" <?php echo isset($income_head_id) && $income_head_id == 2 ? "selected='selected'" : "" ; ?> >Hostel Fee</option>
                            <option value="3" <?php echo isset($income_head_id) && $income_head_id == 3 ? "selected='selected'" : "" ; ?> >Transport Fee</option>
                        </select>
                        </div>
                    </div>
                   <div class="col-md-3 col-sm-3 col-xs-12 school_coloumns">

                        <div class="form-group item">
                        <div>Fee Type <span class="required"> *</span></div>

                        <select name="income_head_id" class="form-control col-md-7 col-xs-12" id="fee_type" required="required">
                        <option value="">-- Select Fee Type --</option>
                        <?php foreach($fee_types as $fee_type) { 
                             if(isset($income_head_id) && $income_head_id == $fee_type->id)
                             {
                                $fee_type_name =  $fee_type->title;

                             }
                            ?>
                                    <option value="<?php echo  $fee_type->id  ?>" <?php echo isset($income_head_id) && $income_head_id == $fee_type->id ? "selected='selected'" : "" ; ?> ><?php echo $fee_type->title  ?></option>
                                <?php } ?>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12" id="extra_dropdown" style="display:none">
                    </div>
                    
                  

                   
                   <div class="col-md-3 col-sm-3 col-xs-12">
                       <div class="form-group"><br/>
                           <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('find'); ?></button>
                       </div>
                   </div>
               </div>


               <?php echo form_close(); ?>
           </div>

           <div class="x_content" id="main-content">
               <div class="" data-example-id="togglable-tabs">
                   
         
                   <ul  class="nav nav-tabs bordered no-print">
                       <li class=""><a href="#tab_tabular"   role="tab" data-toggle="tab"   aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('tabular'); ?> <?php echo $this->lang->line('report'); ?></a> </li>
                   </ul>
                   <br/>
                   
                   <div class="tab-content">
                       <div  class="tab-pane fade in active" id="tab_tabular" >
                           <div class="x_content" style="overflow-x:scroll">
                                    <?php $rowspan = count($emi_data) > 0 ? 'rowspan="2"' : "" ?>
                                    <?php if($_POST) {?>
                                    <table id="datatable-keytable" class="datatable-responsive table table-striped table-bordered dt-responsive nowrap" cellspacing="0"  width="100%">
                                        <thead>
                                        <?php if($_POST) {?>
                                            <tr>
                                                <th colspan="<?php echo 9+count($emi_data)?>" style="text-align : center">
                                                    Installmentwise Report |  
                                                   <?php if(isset($school))  echo " ".$school->school_name." "  ?> | 
                                                   <?php  echo  $class_name." class -  ".$fee_type_name   ?> 
                                                </th>
                                            </tr>
                                            <?php }?>
                                            <tr>
                                                <th <?php echo $rowspan  ?>>S.No</th>
                                                <th  <?php echo $rowspan  ?>>Class</th>
                                                <th  <?php echo $rowspan  ?>>Total Students</th>
                                                <th  <?php echo $rowspan  ?>>Total</th>
                                                <th  <?php echo $rowspan  ?>>Recieved Fees</th>
                                                <th  <?php echo $rowspan  ?>>Discount</th>
                                                <th colspan="<?php echo count($emi_data) ?>">Due's Installment</th>
                                                <th  <?php echo $rowspan  ?>>Previous Year Due</th>
                                                <th  <?php echo $rowspan  ?>>Total Due</th>

                                            </tr>
                                            <?php if(count($emi_data) >0){ ?>
                                            <tr>
                                                <?php foreach ($emi_data as $obj ){ ?>
                                                <th>  <?php echo $obj->emi_name ?></th>
                                                <?php } ?>

                                            </tr>
                                            <?php } ?>
                                        </thead>
                                        <?php if($_POST) {?>

                                        <tbody>
                                            <?php
                                            $icount = 0;
                                            $grand_total_due = 0;
                                            foreach($fee_data as $iClassID => $student) 
                                            {
                                                $sClassName = $class_data[$iClassID] ?? "";
                                                $previous_year =  $student[$previous_academic_year_id] ?? new stdClass();
                                                if (!isset( $student[$academic_year_id]))
                                                    continue;
                                                $student =  $student[$academic_year_id] ?? new stdClass();
                                                $previous_year_fee_amount = $previous_year->fee_amount ?? 0;
                                                if(isset($student->type) && ($student->type == "hostel" || $student->type == "transport")) {
                                                    $yearly_fee_amount = isset($student->yearly_fee_amount) && $student->yearly_fee_amount ? json_decode($student->yearly_fee_amount,true) : array();
                                                    if($academic_year_id_sel && isset($yearly_fee_amount[$previous_academic_year_id]))
                                                    {
                                                        $previous_year_fee_amount = $yearly_fee_amount[$previous_academic_year_id];
                                                    }
                                                }
                                                $previous_total_paid =  $previous_year->total_paid ?? 0;
                                                $previous_year_total_discount =  $previous_year->total_discount ?? 0;
                                                $previous_year->total_paid =  $previous_total_paid + $previous_year_total_discount;

                                                $fee_amount = $student['fee_amount'];
                                                $total_students = $student['student_count'];


                                                $total_paid =  $student['total_paid'];
                                                $total_discount =  $student['total_discount'];
                                                $student['total_paid'] =$student['total_paid'] + $total_discount ;

                                                $icount++;
                                                ?>
                                            <tr>
                                            <td ><?php echo $icount; ?></td>                                               
                                            <td ><?php echo   $sClassName; ?></td>
                                            <td ><?php echo   $total_students; ?></td>
                                                <td ><?php echo $fee_amount; ?></td>
                                                <td ><?php echo  $total_paid  ?></td>
                                                <td ><?php echo  $total_discount ?></td>
                                                <?php 
                                                //  if(strtolower($student->rte) == "yes" && (!isset($student->type) || (isset($student->type) && $student->type != "hostel" && $student->type != "transport")))
                                                // {
                                                //     $student->total_paid =   $fee_amount;
                                                //     $total_paid =  $student->total_paid;
                                                // }
                                                $iTotalDue = $student['due_amount'];
                                                if (empty($emi_data))
                                                {
                                                    ?>
                                                    <td></td>
                                                    <?php 
                                                }
                                                else
                                                {
                                                    foreach ($emi_data as $obj ){ 
                                                        $emi_due = $student['emi'][$obj->id] ?? 0;
                                                        $iTotalDue =  $iTotalDue +$emi_due;
                                                      
                                                    ?>
                                                    <td>  <?php echo  $emi_due ?></td>
                                                    <?php }
                                                    
                                                }
                                                ?>
                                                
                                                
                                                <td><?php echo  $student['due_amount']; ?></td>
                                              
                                                <td ><?php 
                                               
                                                //  $total_due =$fee_amount-($total_paid+$total_discount)+ $student['due_amount'] ;
                                                //  $grand_total_due =   $grand_total_due +  $total_due;
                                                echo  ( $iTotalDue) ?></td>

                                            </tr>
                                            <?php } ?>
                                       </tbody>
                                       <?php } else { ?>
                                        <tbody>

                                       </tbody>
                                        <tfoot>
                                       </tfoot>
                                       <?php }
                                        if($_POST) {?>
                                        <tfoot>

                                            <tr>
                                                <td colspan="2">Total</td>
                                                <td  ></td>
                                                <td  ></td>
                                                <td ></td>
                                                <td ></td>
                                               <?php   
                                               if (empty($emi_data))
                                               {
                                                   ?>
                                                   <td></td>
                                                   <?php 
                                               }
                                               else
                                               {
                                                    foreach($emi_data as $key => $emi){ ?>
                                                    <td ></td>
                                                    <?php }
                                               }
                                              ?>
                                                <td ></td>

                                                <td >
                                                 <?php echo  $grand_total_due  ?>
                                                </td>                                           
                                             </tr>
                                             </tfoot>

                                            <?php }?>
                                    </table>
                                    <?php } ?>

                          
                           </div>
                       </div>
                    

                           <h4>Signature: __________ </h4>  
                   </div>
               </div>
           </div>
           
           <div class="row no-print">
               <div class="col-xs-12 text-right">
                <button class="btn btn-default " onclick="printDiv()"><i class="fa fa-print"></i> <?php echo $this->lang->line('print'); ?></button>

               </div>
           </div>
           
       </div>
   </div>
</div>

<script type="text/javascript">
var emi_count = <?php echo !empty($emi_data) ? count($emi_data) : 0; ?>;
function doit(type, fn, dl) {
	var elt = document.getElementById('datatable-keytable');
	var wb = XLSX.utils.table_to_book(elt, {sheet:"Sheet JS"});
	return dl ?
		XLSX.write(wb, {bookType:type, bookSST:true, type: 'base64'}) :
		XLSX.writeFile(wb, fn || ('installmentwise_report.' + (type || 'xlsx')));
}
var extra_value = <?php echo isset($extra_value) && $extra_value ?  $extra_value : 0 ?>;

$(document).ready(function() {
    $('#school_filter_col').hide();
            $('#district_col').hide();  
            $('.district_cols').hide();   
 
        <?php
        if((isset($filter_type))){  ?>
            <?php if($filter_type == "class")
            { ?>
                $('#school_filter_col').show();   
                $('.district_cols').hide();   

            <?php } 
            else if($filter_type == "school")
            { ?>
                $('.school_coloumns').hide(); 
                $('.district_cols').show();   
                
                 $('#district_col').show();   
            <?php } ?>
           
       <?php } ?>
           // Checkbox click
           $('#filter_type').on('change',function(){
            $('#district_col').hide();   
            $('#school_filter_col').hide();
               if(this.value =="class")
               {
                   $('#school_filter_col').show();
                   $('.school_coloumns').show();  
                   $('.district_cols').hide();   
 
               }
               else if(this.value =="school")
               {
                    $('.school_coloumns').hide();   
                    $('.district_cols').show();   
                    $('#district_col').show();   
               }
               
           })
      var class_id = <?php echo isset($class_id) && $class_id ?  $class_id : 0 ?>;
            $('#school_id').change(function(){
                var academic_year_id = <?php echo isset($academic_year_id) && $academic_year_id ?  $academic_year_id : 0 ?>;
                var class_id = <?php echo isset($class_id) && $class_id ?  $class_id : 0 ?>;
                var fee_type_id = <?php echo isset($income_head_id) && $income_head_id ?  $income_head_id : 0 ?>;
                get_academic_year_by_school(this.value, academic_year_id)
                get_class_by_school(this.value, class_id)
                // get_fee_type_by_school(this.value, fee_type_id);
            })
            <?php if(isset($class_id) && isset($section_id)){ ?>
        get_section_by_class('<?php echo $class_id; ?>', '<?php echo $section_id; ?>');
    <?php } ?>
            $('#academic_year_id').change(function(){
                var school_id = $('#school_id').val();
                var income_head_id = $('#income_head_id').val();
                var fee_type_id = <?php echo isset($income_head_id) && $income_head_id ?  $income_head_id : 0 ?>;
                get_fee_type_by_year(school_id, this.value, fee_type_id);
            })
            $('.datatable-responsive').DataTable({
                dom: 'Bfrtip',
                "ordering": true,
                "searching": false,
                "paging" : false,

                buttons: [
                    {
                        text: 'Export',
                        action: function ( ) {
                            doit('xlsx')
                        }
                    }
                ],
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
        
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
                    total_students = api
                    .column( 2 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                    $( api.column( 2 ).footer() ).html(
                        total_students 
                    );
                    total_fees = api
                    .column( 3 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                    $( api.column( 3 ).footer() ).html(
                        total_fees 
                    );
                    total_recieved = api
                    .column( 4 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                    $( api.column( 4 ).footer() ).html(
                        total_recieved 
                    );
                    total_discount = api
                    .column( 5 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                    $( api.column( 5 ).footer() ).html(
                        total_discount 
                    );
                    <?php 
                    $iCount = 6;
                    foreach($emi_data as $key => $emi){ ?>
                        emi_total_<?php echo $key ?> = api
                        .column( <?php echo $iCount ?> )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                        $( api.column(  <?php echo $iCount ?>  ).footer() ).html(
                            emi_total_<?php echo $key ?>  
                        );
                    <?php 
                    $iCount++;
                    }
                    
                    ?>
                     total_prev = api
                    .column( <?php echo $iCount ?> )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                    $( api.column( <?php echo $iCount ?> ).footer() ).html(
                        total_prev 
                    );
                    total_due = api
                    .column( <?php echo $iCount ?>+1 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                    $( api.column( <?php echo $iCount ?>+1 ).footer() ).html(
                        total_due 
                    );
                   

                }
                
            });          
          });
</script>
<script type="text/javascript">
       
   $("#student").validate();    

   $("document").ready(function() {
        <?php if(isset($school_id) && !empty($school_id)){ ?>
           $(".fn_school_id").trigger('change');
        <?php } ?>
   });
    
   $('#fee_type').change(function(){
        getextra_dropwdown( $(this).val())
        // $('#extra_dropdown').hide();
        // var school_id = $('#school_id').val();
        // var academic_year_id = <?php echo isset($academic_year_id) && $academic_year_id ?  $academic_year_id : 0 ?>;
        // $.ajax({       
        //     type   : "POST",
        //     url    : "<?php echo site_url('ajax/get_extra_dropdowns'); ?>",
        //     data   : { school_id:school_id, academic_year_id :academic_year_id,  fee_type : $(this).val(), extra_value : extra_value},               
        //     async  : false,
        //     success: function(response){                                                   
        //         if(response)
        //         { 
        //             if (response)
        //             {
        //                 $('#extra_dropdown').show();
        //                 $('#extra_dropdown').html(response)
        //             }
        //             else
        //             {
        //                 $('#extra_dropdown').hide();

        //                 $('#extra_dropdown').html('')

        //             }
        //         }
        //     }
        // });
   })
 
        
    function get_section_by_class(class_id, section_id){ 
        
        var school_id = $('#school_id').val();        
        
       if(!school_id){
           toastr.error('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('school'); ?>');
           return false;
        }
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_section_by_class'); ?>",
            data   : {school_id:school_id,  class_id : class_id , section_id: section_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#filter_section_id').html(response);
               }
            }
        }); 
    }
  
   function getextra_dropwdown(fee_type)
   {
        $('#extra_dropdown').hide();
        var school_id = $('#school_id').val();
        var academic_year_id = <?php echo isset($academic_year_id) && $academic_year_id ?  $academic_year_id : 0 ?>;
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_extra_dropdowns'); ?>",
            data   : { school_id:school_id, academic_year_id :academic_year_id,  fee_type :fee_type, extra_value : extra_value},               
            async  : false,
            success: function(response){                                                   
                if(response)
                { 
                    if (response)
                    {
                        $('#extra_dropdown').show();
                        $('#extra_dropdown').html(response)
                    }
                    else
                    {
                        $('#extra_dropdown').hide();

                        $('#extra_dropdown').html('')

                    }
                }
            }
        });
   }
   function get_academic_year_by_school(school_id, academic_year_id){       
        
       $.ajax({       
           type   : "POST",
           url    : "<?php echo site_url('ajax/get_academic_year_by_school'); ?>",
           data   : { school_id:school_id, academic_year_id :academic_year_id},               
           async  : false,
           success: function(response){                                                   
              if(response)
              { 
                   $('#academic_year_id').html(response); 
                   var fee_type_id = <?php echo isset($income_head_id) && $income_head_id ?  $income_head_id : 0 ?>;
                    get_fee_type_by_year(school_id, academic_year_id, fee_type_id);
              }
           }
       });
  }  
  function get_class_by_school(school_id, class_id) {

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('ajax/get_class_by_school'); ?>",
            data: {
                school_id: school_id,
                class_id: class_id
            },
            async: false,
            success: function(response) {
                if (response) {
                        $('#filter_class_id').html(response);
                }
            }
        });

    }
    function get_fee_type_by_school(school_id, fee_type_id) {

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('accounting/invoice/get_fee_type_by_school'); ?>",
            data: {
                school_id: school_id,
                fee_type_id: fee_type_id
            },
            async: false,
            success: function(response) {
                if (response) {
                    $('#fee_type').html(response);
                    getextra_dropwdown(fee_type_id)
                }
            }
        });
    }
  // ak

    $(document).ready(function(){
            $('#district_col').hide();   
            $('#zone_col').hide();   
            <?php if($this->session->userdata('role_id') == SUPER_ADMIN || $this->session->userdata('dadmin') == 1){ ?>
            <?php }else { ?>
                $('#school_filter_col').hide();  

            <?php } ?>
        <?php
        if((isset($filter_type))){  ?>
            <?php if($filter_type == "district")
            { ?>
                $('#district_col').show();   

            <?php }
            else if($filter_type == "prant") {?>
                $('#zone_col').show();  
            <?php } 
            else if($filter_type == "school") {?>
                console.log("ighfh")
               $('#school_filter_col').show();  
            <?php } }
            ?>
            
           
           // Checkbox click
           $('#report_type').on('change',function(){
            $('#district_col').hide();   
            $('#zone_col').hide();   
            $('#school_filter_col').hide();  
            if(this.value == "school")
            {
                $('#school_filter_col').show();  
            }
               if(this.value =="district")
               {
                    $('#district_col').show();   
               }
               else if(this.value =="prant")
               {
                $('#zone_col').show();  
               }
               
               
           })
           $(".hidecol").click(function(){

               var id = this.id;
               var splitid = id.split("_");
               var colno = splitid[1];
               var checked = true;
                
               // Checking Checkbox state
               if($(this).is(":checked")){
                   checked = true;
               }else{
                   checked = false;
               }
               setTimeout(function(){
                   if(checked){
                       $('#datatable-keytable td:nth-child('+colno+')').hide();
                       $('#datatable-keytable th:nth-child('+colno+')').hide();
                   } else{
                       $('#datatable-keytable td:nth-child('+colno+')').show();
                       $('#datatable-keytable th:nth-child('+colno+')').show();
                   }

               }, 1500);

           });
       });

       function printDiv() {
            $("#main-content").printThis({
                debug: false,               // show the iframe for debugging
                importCSS: true,            // import parent page css
                importStyle: true,          // import style tags
               
            });
        }
        function get_fee_type_by_year(school_id, academic_year_id, fee_type_id){       
        
                $.ajax({       
                    type   : "POST",
                    url    : "<?php echo site_url('ajax/get_fee_type_by_year'); ?>",
                    data   : { school_id:school_id, academic_year_id :academic_year_id,fee_type_id : fee_type_id },               
                    async  : false,
                    success: function(response){                                                   
                    if(response)
                    { 
                        console.log('fee_type')
                        $(".fee_type").trigger('change');
                        getextra_dropwdown(fee_type_id)

                            $('#fee_type').html(response); 
                    }
                    }
                });
        }  
  // ak
   
</script>   
<script>

</script>
