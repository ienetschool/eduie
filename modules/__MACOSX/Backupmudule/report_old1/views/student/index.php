<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-bar-chart"></i><small> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('report'); ?></small></h3>                
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            
            <?php $this->load->view('quick_report'); ?>   
            
             <div class="x_content filter-box no-print"> 
                <?php echo form_open_multipart(site_url('report/student'), array('name' => 'student', 'id' => 'student', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row">   
                    
                    <?php $this->load->view('layout/school_list_filter'); ?>
                    
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div> <?php echo $this->lang->line('academic_year'); ?> </div>
                            <select  class="form-control col-md-7 col-xs-12" name="academic_year_id" id="academic_year_id">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                <?php foreach ($academic_years as $obj) { ?>
                                <option value="<?php echo $obj->id; ?>" <?php if(isset($academic_year_id) && $academic_year_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->session_year; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('group_by_data'); ?> <span class="required">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12" name="group_by" id="group_by" required="required"> 
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                               
                                <option value="gender" <?php if(isset($group_by) && $group_by == 'gender'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('gender'); ?></option>
                                <option value="vehicle" <?php if(isset($group_by) && $group_by == 'vehicle'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('vehicle'); ?></option>
                                <option value="library" <?php if(isset($group_by) && $group_by == 'library'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('library'); ?></option>
                                <option value="hostel" <?php if(isset($group_by) && $group_by == 'hostel'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('hostel'); ?></option>
                                <option value="class" <?php if(isset($group_by) && $group_by == 'class'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('class'); ?></option>
                            </select>
                        </div>
                    </div>  
                
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group"><br/>
                            <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('find'); ?></button>
                        </div>
                    </div>
                </div>

                <!-- ak -->

                 <div class="container">
                            <div>
                                <strong>Checked the Checkbox for Hide column</strong>
                                    <input type="checkbox" class="hidecol"  id="col_2" />&nbsp;<?php echo $this->lang->line('academic_year'); ?>&nbsp;
                                    <input type="checkbox" class="hidecol"  id="col_3" />&nbsp;<?php echo $this->lang->line('class'); ?> <?php echo $this->lang->line('name'); ?>
                                    <input type="checkbox" class="hidecol" v id="col_4" />&nbsp;<?php echo $this->lang->line('male'); ?>
                                    <input type="checkbox" class="hidecol"  id="col_5" />&nbsp;<?php echo $this->lang->line('female'); ?>
                                    <input type="checkbox" class="hidecol"  id="col_5" />&nbsp;<?php echo $this->lang->line('total'); ?>
                            </div>
                        </div>


                <!-- ak -->


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
                                                    <h3 class="head-title ptint-title" style="width: 100%;"><i class="fa fa-bar-chart"></i><small> <?php echo $this->lang->line('fee'); ?> <?php echo $this->lang->line('collection'); ?>  <?php echo $this->lang->line('report'); ?></small></h3>                
                                                    <div class="clearfix">&nbsp;</div>
                                                </div>
                                            </div>
                                                <div class="col-sm-3  col-xs-3"></div>
                                        </div>            
                                    </div>
                    <?php } ?>    
                    <ul  class="nav nav-tabs bordered no-print">
                        <li class=""><a href="#tab_tabular"   role="tab" data-toggle="tab"   aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('tabular'); ?> <?php echo $this->lang->line('report'); ?></a> </li>
                        <li  class="active"><a href="#tab_graphical"   role="tab" data-toggle="tab"  aria-expanded="false"><i class="fa fa-line-chart"></i> <?php echo $this->lang->line('graphical'); ?> <?php echo $this->lang->line('report'); ?></a> </li>                          
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in" id="tab_tabular" >
                            <div class="x_content">
                            <table id="datatable-keytable" class="datatable-responsive table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th><?php echo $this->lang->line('academic_year'); ?></th>
                                        <th><?php echo $this->lang->line('class'); ?> <?php echo $this->lang->line('name'); ?></th>
                                        <th><?php echo $this->lang->line('male'); ?></th>
                                        <th><?php echo $this->lang->line('female'); ?></th>
                                        <th><?php echo $this->lang->line('total'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php 
                                    $grand_total = 0;
                                    $male_arr = array();
                                    $female_arr = array();
                                    $total_arr = array();
                                    
                                    $count = 1; if(isset($students) && !empty($students)){ ?>
                                        <?php foreach($students as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>                                            
                                            <td><?php echo $obj->session_year; ?></td>
                                            <td><?php echo $this->lang->line('class'); ?> <?php echo $obj->group_by_field; ?></td>
                                            <td><?php echo $obj->male; $male_arr[] = $obj->male; ?></td>
                                            <td><?php echo $obj->female; $female_arr[] = $obj->female; ?></td>
                                            <td>
                                                <?php //echo $obj->total; $grand_total +=$obj->total; $total_arr[] = $obj->total; ?>
                                                <?php echo ($obj->male+$obj->female); $grand_total +=($obj->male+$obj->female); $total_arr[] = ($obj->male+$obj->female); ?>
                                            </td>                                           
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="5"><strong><?php echo $this->lang->line('total'); ?> </strong></td>
                                            <td><strong><?php echo $grand_total; ?></strong></td>                                           
                                        </tr>
                                    <?php }else{ ?>
                                        <tr><td class="text-center" colspan="6"><?php echo $this->lang->line('no_data_found'); ?></td></tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                     
                        <div  class="tab-pane fade in active" id="tab_graphical" >
                            <div class="x_content">
                                <?php if(isset($students) && !empty($students)){ ?>
                                 <script type="text/javascript">
                                     
                                      $(function () {
                                        $('#student-report').highcharts({
                                                chart: {
                                                type: 'column'
                                                },
                                                title: {
                                                    text: '<?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('report'); ?>'
                                                },
                                                xAxis: {
                                                    categories: [
                                                        <?php foreach($students as $obj){ ?> 
                                                         '<?php echo $this->lang->line('class'); ?> <?php echo $obj->group_by_field; ?>',
                                                         <?php } ?>         
                                                     ]
                                                },
                                                credits: {
                                                    enabled: false
                                                },
                                                series: [{
                                                    name: '<?php echo $this->lang->line('male'); ?>',
                                                    data: [<?php echo implode(',', $male_arr); ?>]
                                                }, {
                                                    name: '<?php echo $this->lang->line('female'); ?>',
                                                    data: [<?php echo implode(',', $female_arr); ?>]
                                                }, {
                                                    name: '<?php echo $this->lang->line('total'); ?>',
                                                    data: [<?php echo implode(',', $total_arr); ?>]
                                                }],
                                            credits: {
                                            enabled: false
                                            }
                                        });
                                     });
                                     
                                </script>
                                
                                <div id="student-report" style="width: 99%; height:<?php echo count($students)*30+250 ?>px !important; margin: 0 auto"></div>
                                 <?php }else{ ?>
                                <p class="text-center"><?php echo $this->lang->line('no_data_found'); ?></p>
                                 <?php } ?>
                            </div>
                        </div>
                            <h4>Signature: __________ </h4>  
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
    
    $("#student").validate();  

    $("document").ready(function() {
         <?php if(isset($school_id) && !empty($school_id)){ ?>
            $(".fn_school_id").trigger('change');
         <?php } ?>
    });
     
    $('.fn_school_id').on('change', function(){
      
        var school_id = $(this).val();
        var academic_year_id = '';
        
        <?php if(isset($school_id) && !empty($school_id)){ ?>
            academic_year_id =  '<?php echo $academic_year_id; ?>'; 
         <?php } ?>          
        
        if(!school_id){
           toastr.error('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('school'); ?>');
           return false;
        }
        
        get_academic_year_by_school(school_id, academic_year_id);
       
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

   // ak

     $(document).ready(function(){

            // Checkbox click
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


   // ak
    
 </script>   

