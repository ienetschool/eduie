<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-bar-chart"></i><small> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('yearly'); ?> <?php echo $this->lang->line('attendance'); ?> <?php echo $this->lang->line('report'); ?></small></h3>                
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content quick-link">
            <?php if(has_permission(VIEW, 'report', 'report')){ ?>
                                <a href="<?php echo site_url('report/income'); ?>"><?php echo $this->lang->line('income'); ?> <?php echo $this->lang->line('report'); ?></a>
                                | <a href="<?php echo site_url('report/expenditure'); ?>"><?php echo $this->lang->line('expenditure'); ?> <?php echo $this->lang->line('report'); ?></a>
                                | <a href="<?php echo site_url('report/invoice'); ?>"><?php echo $this->lang->line('invoice'); ?> <?php echo $this->lang->line('report'); ?></a>
                                | <a href="<?php echo site_url('report/duefee'); ?>"><?php echo $this->lang->line('due_fee'); ?> <?php echo $this->lang->line('report'); ?></a>
                                | <a href="<?php echo site_url('report/feecollection'); ?>"><?php echo $this->lang->line('fee'); ?> <?php echo $this->lang->line('collection'); ?> <?php echo $this->lang->line('report'); ?></a>
                                | <a href="<?php echo site_url('report/balance'); ?>"><?php echo $this->lang->line('accounting'); ?> <?php echo $this->lang->line('balance'); ?> <?php echo $this->lang->line('report'); ?></a> 
                                | <a href="<?php echo site_url('report/library'); ?>"><?php echo $this->lang->line('library'); ?> <?php echo $this->lang->line('report'); ?></a>
                                | <a href="<?php echo site_url('report/sattendance'); ?>"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('attendance'); ?></a>
                                | <a href="<?php echo site_url('report/syattendance'); ?>"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('yearly'); ?> <?php echo $this->lang->line('attendance'); ?></a>
                                | <a href="<?php echo site_url('report/tattendance'); ?>"><?php echo $this->lang->line('teacher'); ?> <?php echo $this->lang->line('attendance'); ?></a>
                                | <a href="<?php echo site_url('report/tyattendance'); ?>"><?php echo $this->lang->line('teacher'); ?> <?php echo $this->lang->line('yearly'); ?> <?php echo $this->lang->line('attendance'); ?></a>
                                | <a href="<?php echo site_url('report/eattendance'); ?>"><?php echo $this->lang->line('employee'); ?> <?php echo $this->lang->line('attendance'); ?></a>
                                | <a href="<?php echo site_url('report/eyattendance'); ?>"><?php echo $this->lang->line('employee'); ?> <?php echo $this->lang->line('yearly'); ?> <?php echo $this->lang->line('attendance'); ?></a>
                                | <a href="<?php echo site_url('report/student'); ?>"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('report'); ?></a>
                                | <a href="<?php echo site_url('report/sinvoice'); ?>"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('invoice'); ?> <?php echo $this->lang->line('report'); ?></a> 
                                | <a href="<?php echo site_url('report/sactivity'); ?>"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('activity'); ?> <?php echo $this->lang->line('report'); ?></a>
                               
                                | <a href="<?php echo site_url('report/transaction'); ?>"><?php echo $this->lang->line('daily'); ?> <?php echo $this->lang->line('transaction'); ?> <?php echo $this->lang->line('report'); ?></a>
                                | <a href="<?php echo site_url('report/statement'); ?>"><?php echo $this->lang->line('daily'); ?> <?php echo $this->lang->line('statement'); ?> <?php echo $this->lang->line('report'); ?></a>
                                | <a href="<?php echo site_url('report/examresult'); ?>"><?php echo $this->lang->line('exam'); ?> <?php echo $this->lang->line('result'); ?> <?php echo $this->lang->line('report'); ?></a>
                       
                    <?php } ?>
            </div>
            <?php $this->load->view('quick_report'); ?>   
            
             <div class="x_content filter-box no-print"> 
                <?php echo form_open_multipart(site_url('report/syattendance'), array('name' => 'sattendance', 'id' => 'sattendance', 'class' => 'form-horizontal form-label-left'), ''); ?>
                 <div class="row">                    
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        
                        <?php $this->load->view('layout/school_list_filter'); ?>
                        
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <div class="item form-group"> 
                                <div><?php echo $this->lang->line('academic_year'); ?> <span class="required">*</span></div>
                                <select  class="form-control col-md-7 col-xs-12" name="academic_year_id" id="academic_year_id">
                                    <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                    <?php foreach ($academic_years as $obj) { ?>
                                    <option value="<?php echo $obj->id; ?>" <?php if(isset($academic_year_id) && $academic_year_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->session_year; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <div class="item form-group"> 
                                <div><?php echo $this->lang->line('class'); ?> <span class="required">*</span></div>
                                <select  class="form-control col-md-7 col-xs-12" name="class_id" id="class_id"   onchange="get_section_by_class('', this.value,'');">
                                    <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                    <?php if(isset($classes) && !empty($classes)) { ?>
                                        <?php foreach ($classes as $obj) { ?>
                                        <option value="<?php echo $obj->id; ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <div class="item form-group"> 
                                <div><?php echo $this->lang->line('section'); ?> <span class="required">*</span></div>
                                <select  class="form-control col-md-7 col-xs-12" name="section_id" id="section_id"   onchange="get_student_by_section('', this.value, '');">
                                    <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="item form-group"> 
                                <div><?php echo $this->lang->line('student'); ?> <span class="required">*</span></div>
                                <select  class="form-control col-md-7 col-xs-12" name="student_id" id="student_id"  >
                                    <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                    
                                </select>
                            </div>
                        </div>                                               
                    </div>
                
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group"><br/>
                            <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('find'); ?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>

            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                     <h5> <?php echo "Date : ". date("d/m/Y") ?> 
                   <?php if(isset($school) && !empty($school)){ ?>
                                    <div class="x_content">             
                                        <div class="row">
                                            <div class="col-sm-3  col-xs-3">&nbsp;</div>
                                            <div class="col-12 layout-box">
                                                <div>
                                                    <?php if($school->logo){ ?>
                                                        <img src="<?php echo UPLOAD_PATH; ?>/logo/<?php echo $school->logo; ?>" alt="" style="height: 50px; margin-right: 200px;" /> 
                                                    <?php }else if($school->frontend_logo){ ?>
                                                        <img src="<?php echo UPLOAD_PATH; ?>/logo/<?php echo $school->frontend_logo; ?>" alt="" style="height: 50px; margin-right: 200px;" /> 
                                                    <?php }else{ ?>                                                        
                                                        <img src="<?php echo UPLOAD_PATH; ?>/logo/<?php echo $this->global_setting->brand_logo; ?>" alt="" style="height: 50px; margin-right: 200px;" />
                                                    <?php } ?>
                                                    <h4><?php echo $school->school_name; ?></h4>
                                                    <p><?php echo $school->address; ?></p>
                                                    <h3 class="head-title ptint-title" style="width: 100%;"><i class="fa fa-bar-chart"></i><small>  <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('yearly'); ?> <?php echo $this->lang->line('attendance'); ?> <?php echo $this->lang->line('report'); ?></small></h3>                
                                                    <div class="clearfix">&nbsp;</div>
                                                </div>
                                            </div>
                                                <div class="col-sm-3  col-xs-3"></div>
                                        </div>            
                                    </div>
                    <?php } ?>    
                    
                    <ul  class="nav nav-tabs bordered no-print">
                        <li class="active"><a href="#tab_tabular"   role="tab" data-toggle="tab"   aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('tabular'); ?> <?php echo $this->lang->line('report'); ?></a> </li>
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in active" id="tab_tabular" >
                            <div class="x_content">
                                                            
                            <table class="datatable-responsive table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <td><?php echo $this->lang->line('month'); ?> <i class="fa fa-long-arrow-down"></i> - <?php echo $this->lang->line('date'); ?> <i class="fa fa-long-arrow-right"></i></td>
                                        <?php for($i = 1; $i<=$days; $i++ ){
                                               $aTotalPresent[$i] = 0;
                                               $aTotalAbsent[$i] = 0;
                                            ?>
                                            <td><?php echo $i; ?></td>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php  $months = get_months(); ?>
                                    <?php foreach($months as $key=>$value){
                                        $iKeyValue = str_replace("day_", "", $key);
                                        if ($sValue == "P")
                                        {
                                            $aTotalPresent[$iKeyValue]++;
                                        }
                                        elseif ($sValue == "A")
                                        {
                                            $aTotalAbsent[$iKeyValue]++;
                                        }
                                        ?>
                                        <?php 
                                            $month_number = date('m',strtotime($key)); 
                                            $attendance = @get_student_monthly_attendance($school_id, $student_id, $academic_year_id, $class_id, $section_id, $month_number ,$days);
                                           ?>
                                        <?php if(!empty($attendance)){ ?>
                                         <tr>
                                             <td><?php echo $value; ?></td> 
                                             <?php foreach($attendance AS $key ){ ?>
                                                 <td> <?php echo $key ? $key : '<i style="color:red;">--</i>'; ?></td>
                                             <?php } ?>
                                         </tr>
                                         <?php } ?>  
                                        <?php } ?>  
                                        <tr>
                                            <td></td>
                                 <?php
                                        for($i = 1; $i<=$days; $i++ ){
                                            $iPresentCount = $aTotalPresent[$i] ?? 0;
                                            $iAbscentCount = $aTotalAbsent[$i] ?? 0;
                                            ?>
                                            <td><?php echo " P:$iPresentCount  A:$iAbscentCount ";?></td>
                                        <?php } ?>
                                        </tr>      
                                </tbody>
                            </table>
                            </div>
                        </div>    <h4>Signature: __________ </h4>                     
                    </div>
                </div>
            </div>
            
             <div class="row no-print">
                <div class="col-xs-12 text-right">
                    <button class="btn btn-default " onclick="window.print();"><i class="fa fa-print"></i> <?php echo $this->lang->line('print'); ?></button>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script type="text/javascript">
         
    $("document").ready(function() {
         <?php if(isset($school_id) && !empty($school_id)){ ?>
            $(".fn_school_id").trigger('change');
         <?php } ?>
    });
     
    $('.fn_school_id').on('change', function(){
      
        var school_id = $(this).val();
        var class_id = '';
        var section_id = '';
        var academic_year_id = '';
        
        <?php if(isset($school_id) && !empty($school_id)){ ?>
            class_id =  '<?php echo $class_id; ?>';
            section_id =  '<?php echo $section_id; ?>';
            academic_year_id =  '<?php echo $academic_year_id; ?>'; 
         <?php } ?> 
        
        // if(!school_id){
        //    toastr.error('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('school'); ?>');
        //    return false;
        // }
        
        get_academic_year_by_school(school_id, academic_year_id);
        get_class_by_school(school_id, class_id, section_id);
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_class_by_school'); ?>",
            data   : { school_id:school_id, class_id:class_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {  
                   
                    $('#class_id').html(response);                                      
                   get_section_by_class(class_id, section_id);
               }
            }
        });
    }); 
    
    
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
               }
            }
        });
   }  
    
    function get_class_by_school(school_id, class_id, section_id){       
        
        if(!school_id){
            school_id = $('#school_id').val();
        }
        
        // if(!school_id){
        //    toastr.error('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('school'); ?>');
        //    return false;
        // }
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_class_by_school'); ?>",
            data   : { school_id:school_id, class_id:class_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {  
                   $('#class_id').html(response);                                      
                   get_section_by_class(school_id, class_id, section_id);
               }
            }
        });         
    }
    
    
    function get_section_by_class(school_id, class_id, section_id){       
       
        if(!school_id){
            school_id = $('#school_id').val();
        }
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_section_by_class'); ?>",
            data   : { school_id:school_id, class_id : class_id , section_id: section_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#section_id').html(response);
               }
            }
        });          
    }
    
    <?php if(isset($student_id) && isset($section_id)){ ?>
        get_student_by_section('<?php echo $school_id; ?>', '<?php echo $section_id; ?>', '<?php echo $student_id; ?>');
    <?php } ?>
    
    function get_student_by_section(school_id, section_id, student_id){       
        
        if(!school_id){
            school_id = $('#school_id').val();
        }
        
        // if(!school_id){
        //    toastr.error('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('school'); ?>');
        //    return false;
        // }
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_student_by_section'); ?>",
            data   : {school_id:school_id, section_id: section_id, student_id : student_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#student_id').html(response);
               }
            }
        });          
    }
    
    $("#sattendance").validate();  
</script>

