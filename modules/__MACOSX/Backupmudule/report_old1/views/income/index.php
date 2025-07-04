<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-bar-chart"></i><small> <?php echo $this->lang->line('income'); ?> <?php echo $this->lang->line('report'); ?></small></h3>                
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            
            <?php $this->load->view('quick_report'); ?>   
            
             <div class="x_content filter-box no-print"> 
                <?php echo form_open_multipart(site_url('report/income'), array('name' => 'income', 'id' => 'income', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row">                    
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        
                     <?php $this->load->view('layout/school_list_filter'); ?> 
                        
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group"> 
                            <?php echo $this->lang->line('academic_year'); ?>
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
                            <?php echo $this->lang->line('group_by_data'); ?> <span class="required">*</span>
                            <select  class="form-control col-md-7 col-xs-12" name="group_by" id="group_by" required="required">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                <?php $groups = get_group_by_type(); ?>
                                <?php foreach ($groups as $key=>$value) { ?>
                                <option value="<?php echo $key; ?>" <?php if(isset($group_by) && $group_by == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                <?php } ?>
                                <option value="income_head" <?php if(isset($group_by) && $group_by == 'income_head'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('income_head'); ?></option>
                                <option value="income_by" <?php if(isset($group_by) && $group_by == 'income_by'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('income'); ?> <?php echo $this->lang->line('method'); ?></option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group"> 
                            <?php echo $this->lang->line('from_date'); ?>
                            <input  class="form-control col-md-7 col-xs-12"  name="date_from"  id="date_from" value="<?php echo isset($date_from) && $date_from != '' ?  date('d-m-Y', strtotime($date_from)) : ''; ?>" placeholder="<?php echo $this->lang->line('from_date'); ?>" type="text">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group"> 
                            <?php echo $this->lang->line('to_date'); ?>
                            <input  class="form-control col-md-7 col-xs-12"  name="date_to"  id="date_to" value="<?php echo isset($date_to) && $date_to != '' ?  date('d-m-Y', strtotime($date_to)) : ''; ?>" placeholder="<?php echo $this->lang->line('to_date'); ?>" type="text">
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
                                        <th><?php echo $this->lang->line('group_by_data'); ?></th>
                                        <th><?php echo $this->lang->line('amount'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php 
                                    $grnd_total = 0;
                                    $count = 1; if(isset($income) && !empty($income)){ ?>
                                        <?php foreach($income as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>                                            
                                            <td><?php echo $obj->session_year; ?></td>
                                            <td>
                                                <?php // echo $obj->group_by_field; ?>
                                                 <?php
                                                if($group_by == 'month'){
                                                    echo date('M, Y', strtotime('1-'.$obj->group_by_field));
                                                }elseif($group_by == 'income_head' || $group_by == 'income_by'){
                                                    echo $this->lang->line($obj->group_by_field) ? $this->lang->line($obj->group_by_field) : $obj->group_by_field;
                                                }else{
                                                    echo $obj->group_by_field;
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $obj->total_amount; $grnd_total +=$obj->total_amount; ?></td>                                           
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="3"><strong><?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('amount'); ?></strong></td>
                                            <td><strong><?php echo number_format($grnd_total,2); ?></strong></td>                                           
                                        </tr>
                                    <?php }else{ ?>
                                        <tr><td class="text-center" colspan="5"><?php echo $this->lang->line('no_data_found'); ?></td></tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div  class="tab-pane fade in active" id="tab_graphical" >
                            <div class="x_content">
                                <?php if(isset($income) && !empty($income)){ ?>
                                 <script type="text/javascript">

                                    $(function () {
                                        $('#income-report').highcharts({
                                            chart: {
                                                type: 'pie',
                                                options3d: {
                                                    enabled: true,
                                                    alpha: 45
                                                }
                                            },
                                            title: {
                                                text: ' <?php echo $this->lang->line('income'); ?> <?php echo $this->lang->line('report'); ?>'
                                            },
                                            subtitle: {
                                                text: ''
                                            },
                                            plotOptions: {
                                                pie: {
                                                    innerSize: 100,
                                                    depth: 45,
                                                    dataLabels: {
                                                        format: '{point.name}'
                                                    }
                                                }
                                            },
                                            series: [{
                                                name: '<?php echo $this->lang->line('amount'); ?>',
                                                data: [ 
                                                    
                                                    <?php foreach($income as $obj){ ?>
                                                       <?php                                                       
                                                       if($group_by == 'month'){
                                                            $obj->group_by_field = date('M, Y', strtotime('1-'.$obj->group_by_field));
                                                        }elseif($group_by == 'income_head' || $group_by == 'income_by'){
                                                            $obj->group_by_field = $this->lang->line($obj->group_by_field) ? $this->lang->line($obj->group_by_field) : $obj->group_by_field;
                                                        } 
                                                        ?>
                                                    ['<?php echo $obj->session_year; ?><br/><?php echo $obj->group_by_field ? $obj->group_by_field : 'N/A'; ?>', <?php echo $obj->total_amount ? $obj->total_amount : 0; ?>],
                                                    <?php } ?>                                                   
                                                ]
                                            }],
                                            credits: {
                                            enabled: false
                                            }
                                        });
                                     });
                                </script>
                                <div id="income-report" style="width: 99%; height: 500px; margin: 0 auto"></div>
                                 <?php }else{ ?>
                                <p class="text-center"><?php echo $this->lang->line('no_data_found'); ?></p>
                                 <?php } ?>
                            </div>
                        </div>
                    </div><h4>Signature: __________ </h4>
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
<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
 <script type="text/javascript">
     
    $('#date_from').datepicker();
    $('#date_to').datepicker();
    $("#income").validate();  
    
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
    
</script>
