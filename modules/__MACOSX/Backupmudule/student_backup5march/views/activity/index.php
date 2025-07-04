<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-clipboard"></i><small> <?php echo $this->lang->line('manage_activity'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            
            <div class="x_content quick-link">
                 <span><?php echo $this->lang->line('quick_link'); ?>:</span>
                <?php if(has_permission(ADD, 'student', 'type')){ ?>
                    <a href="<?php echo site_url('student/type/index'); ?>"> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('type'); ?></a>
                 <?php } ?>
                <?php if(has_permission(ADD, 'student', 'student')){ ?>
                   | <a href="<?php echo site_url('student/add/'); ?>"><?php echo $this->lang->line('admit'); ?> <?php echo $this->lang->line('student'); ?></a>
                 <?php } ?>
                <?php if(has_permission(VIEW, 'student', 'student')){ ?>
                   | <a href="<?php echo site_url('student/index'); ?>"><?php echo $this->lang->line('manage_student'); ?></a>                    
                 <?php } ?>
                <?php if(has_permission(VIEW, 'student', 'bulk')){ ?>
                   | <a href="<?php echo site_url('student/bulk/add'); ?>"><?php echo $this->lang->line('bulk'); ?> <?php echo $this->lang->line('admission'); ?></a>                    
                <?php } ?>
                <?php if(has_permission(VIEW, 'student', 'admission')){ ?>
                   | <a href="<?php echo site_url('student/admission/index'); ?>"><?php echo $this->lang->line('online'); ?> <?php echo $this->lang->line('admission'); ?></a>                    
                 <?php } ?>   
                <?php if(has_permission(VIEW, 'student', 'activity')){ ?>
                   | <a href="<?php echo site_url('student/activity/index'); ?>"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('activity'); ?></a>                    
                 <?php } ?>
            </div>
            
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_activity_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('activity'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'student', 'activity')){ ?>
                            <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_activity"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('activity'); ?></a> </li>                          
                        <?php } ?>                
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_activity"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('activity'); ?></a> </li>                          
                        <?php } ?>  
                            
                        <li class="li-class-list">
                            <?php if($this->session->userdata('role_id') != SUPER_ADMIN && $this->session->userdata('dadmin') != 1){  ?> 
                            
                                <select  class="form-control col-md-7 col-xs-12" onchange="get_student_by_class(this.value);">
                                    <?php if($this->session->userdata('role_id') != STUDENT){ ?>    
                                        <option value="<?php echo site_url('student/activity/index/'); ?>">--<?php echo $this->lang->line('select'); ?>--</option> 
                                    <?php } ?>
                                    <?php $teacher_student_data = get_teacher_access_data('student'); ?>     
                                    <?php $guardian_class_data = get_guardian_access_data('class'); ?>      
                                    <?php foreach($classes as $obj ){ ?>
                                        <?php if($this->session->userdata('role_id') == STUDENT){ ?>
                                            <?php if ($obj->id != $this->session->userdata('class_id')){ continue; } ?>
                                            <option value="<?php echo site_url('student/activity/index/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $this->lang->line('class'); ?> <?php echo $obj->name; ?></option>
                                        <?php }elseif($this->session->userdata('role_id') == GUARDIAN){ ?>
                                            <?php if (!in_array($obj->id, $guardian_class_data)) { continue; } ?>
                                            <option value="<?php echo site_url('student/activity/index/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $this->lang->line('class'); ?> <?php echo $obj->name; ?></option>
                                        <?php }elseif($this->session->userdata('role_id') == TEACHER){ ?>
                                            <?php if (!in_array($obj->id, $teacher_student_data)) { continue; } ?>
                                            <option value="<?php echo site_url('student/activity/index/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $this->lang->line('class'); ?> <?php echo $obj->name; ?></option>
                                        <?php }else{ ?>
                                            <option value="<?php echo site_url('student/activity/index/'.$obj->id); ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?> ><?php echo $this->lang->line('class'); ?> <?php echo $obj->name; ?></option>
                                        <?php } ?>
                                    <?php } ?>                                            
                                </select>   
                            
                            <?php }else{ ?> 
                            
                                <?php echo form_open(site_url('student/activity/index'), array('name' => 'filter', 'id' => 'filter', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                    <select  class="form-control col-md-7 col-xs-12" style="width:auto;" name="school_id"  onchange="get_class_by_school(this.value, '');">
                                            <option value="">--<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('school'); ?>--</option> 
                                        <?php foreach($schools as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" <?php if(isset($filter_school_id) && $filter_school_id == $obj->id){ echo 'selected="selected"';} ?> > <?php echo $obj->school_name; ?></option>
                                        <?php } ?>   
                                    </select>
                                    <select  class="form-control col-md-7 col-xs-12" id="filter_class_id" name="class_id"  style="width:auto;" onchange="this.form.submit();">
                                         <option value="">--<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('class'); ?>--</option> 
                                        <?php if(isset($class_list) && !empty($class_list)){ ?>
                                            <?php foreach($class_list as $obj ){ ?>
                                                <option value="<?php echo $obj->id; ?>"><?php echo $obj->name; ?></option> 
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                   <?php echo form_close(); ?>
                            
                            <?php } ?>
                        </li>    
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_activity_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                         <?php if($this->session->userdata('role_id') == SUPER_ADMIN || $this->session->userdata('dadmin') == 1){ ?>
                                            <th><?php echo $this->lang->line('school'); ?></th>
                                        <?php } ?>
                                        <th><?php echo $this->lang->line('student'); ?></th>
                                        <th><?php echo $this->lang->line('class'); ?></th>
                                        <th><?php echo $this->lang->line('section'); ?></th>
                                        <th><?php echo $this->lang->line('activity'); ?> </th>
                                        <th><?php echo $this->lang->line('activity'); ?> <?php echo $this->lang->line('date'); ?></th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($activities) && !empty($activities)){ ?>
                                        <?php foreach($activities as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <?php if($this->session->userdata('role_id') == SUPER_ADMIN || $this->session->userdata('dadmin') == 1){ ?>
                                                <td><?php echo $obj->school_name; ?></td>
                                            <?php } ?>
                                            <td><?php echo $obj->student; ?></td>
                                            <td><?php echo $obj->class_name; ?></td>
                                            <td><?php echo $obj->section; ?></td>
                                            <td><?php echo $obj->activity; ?></td>
                                            <td><?php echo date($this->global_setting->date_format, strtotime($obj->activity_date)); ?></td>
                                            <td>
                                                <?php if(has_permission(EDIT, 'student', 'activity')){ ?>
                                                    <a href="<?php echo site_url('student/activity/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(VIEW, 'student', 'activity')){ ?>
                                                    <a  onclick="get_activity_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-activity-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'student', 'activity')){ ?>
                                                    <a href="<?php echo site_url('student/activity/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_activity">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('student/activity/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                         
                                <?php $this->load->view('layout/school_list_form'); ?>    
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo $this->lang->line('class'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12 quick-field"  name="class_id"  id="add_class_id" required="required" onchange="get_section_by_class(this.value, '', 'add');" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php foreach($classes as $obj ){ ?>
                                               <option value="<?php echo $obj->id; ?>" <?php echo isset($post['class_id']) && $post['class_id'] == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->name; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>
                                
                                 <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="section_id"><?php echo $this->lang->line('section'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="section_id" id="add_section_id" required="required" onchange="get_student_by_section(this.value, '', 'add');">                                
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('section_id'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="student_id"><?php echo $this->lang->line('student'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="student_id" id="add_student_id" required="required">                                
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('student_id'); ?></div>
                                    </div>
                                </div>
                                
                               <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="activity_date"><?php echo $this->lang->line('activity'); ?> <?php echo $this->lang->line('date'); ?><span class="required"> *</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="activity_date"  id="add_activity_date" value="" placeholder="<?php echo $this->lang->line('activity'); ?> <?php echo $this->lang->line('date'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('activity_date'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="activity"><?php echo $this->lang->line('activity'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="activity"  id="activity" placeholder="<?php echo $this->lang->line('activity'); ?>"><?php echo isset($post['activity']) ?  $post['activity'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('activity'); ?></div>
                                    </div>
                                </div>
                               
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('student/activity/index'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                                
                            </div>
                        </div>  

                        
                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_activity">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('student/activity/edit/'.$activity->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php $this->load->view('layout/school_list_edit_form'); ?>  
                                                                                               
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id"><?php echo $this->lang->line('class'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12 quick-field"  name="class_id"  id="edit_class_id" required="required" onchange="get_section_by_class(this.value, '', 'edit');">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php foreach($classes as $obj ){ ?>
                                            <option value="<?php echo $obj->id; ?>" <?php if($activity->class_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                            <?php } ?>                                            
                                        </select>
                                        <div class="help-block"><?php echo form_error('class_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="section_id"><?php echo $this->lang->line('section'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="section_id" id="edit_section_id" required="required" onchange="get_student_by_section(this.value,'', 'edit');">                                
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('section_id'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="student_id"><?php echo $this->lang->line('student'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="student_id" id="edit_student_id" required="required">                                
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('student_id'); ?></div>
                                    </div>
                                </div>
                                                               
                                <div class="form-group"> 
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="activity_date"><?php echo $this->lang->line('activity'); ?> <?php echo $this->lang->line('date'); ?><span class="required"> *</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="activity_date"  id="edit_activity_date" value="<?php echo isset($activity->activity_date) ?  date('d-m-Y', strtotime($activity->activity_date)) : ''; ?>" placeholder="<?php echo $this->lang->line('activity'); ?> <?php echo $this->lang->line('date'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('activity_date'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="activity"><?php echo $this->lang->line('activity'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="activity"  id="activity" placeholder="<?php echo $this->lang->line('activity'); ?>"><?php echo isset($activity->activity) ?  $activity->activity : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('activity'); ?></div>
                                    </div>
                                </div>
                                                             
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($activity) ? $activity->id : $id; ?>" name="id" />
                                        <a href="<?php echo site_url('student/activity/index'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('update'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        <?php } ?>
              
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bs-activity-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo $this->lang->line('activity'); ?> <?php echo $this->lang->line('information'); ?></h4>
        </div>
        <div class="modal-body fn_activity_data">
            
        </div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_activity_modal(activity_id){
         
        $('.fn_activity_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('student/activity/get_single_activity'); ?>",
          data   : {activity_id : activity_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_activity_data').html(response);
             }
          }
       });
    }
</script>


<!-- bootstrap-datetimepicker -->
<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
 
 <script type="text/javascript">     
  
  $('#add_activity_date').datepicker(); 
  $('#edit_activity_date').datepicker(); 
  
  
      var edit = false;
    <?php if(isset($edit)){ ?>
        edit = true;
    <?php } ?>
         
    $("document").ready(function() {
         <?php if(isset($edit) && !empty($edit)){ ?>
            $(".fn_school_id").trigger('change');
         <?php } ?>
    });
     
    $('.fn_school_id').on('change', function(){
      
        var school_id = $(this).val();        
        var class_id = '';
        <?php if(isset($edit) && !empty($edit)){ ?>
            class_id =  '<?php echo $activity->class_id; ?>';
         <?php } ?> 
        
        if(!school_id){
           toastr.error('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('school'); ?>');
           return false;
        }
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_class_by_school'); ?>",
            data   : { school_id:school_id, class_id:class_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {  
                   if(edit){
                       $('#edit_class_id').html(response);   
                   }else{
                       $('#add_class_id').html(response);   
                   }
                                    
               }
            }
        });
    }); 
    
  
    <?php if(isset($activity) && isset($activity)){ ?>
        get_section_by_class('<?php echo $activity->class_id; ?>', '<?php echo $activity->section_id; ?>', 'edit');
    <?php } ?>
    
    function get_section_by_class(class_id, section_id, type){       
       
        var school_id = $('#'+type+'_school_id').val();  
        if(!school_id){
           toastr.error('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('school'); ?>');
           return false;
        }
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_section_by_class'); ?>",
            data   : { school_id : school_id, class_id : class_id , section_id: section_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#'+type+'_section_id').html(response);
               }
            }
        });         
    }
 
    <?php if(isset($activity) && isset($activity)){ ?>
        get_student_by_section('<?php echo $activity->section_id; ?>', '<?php echo $activity->student_id; ?>','edit');
    <?php } ?>
    
    function get_student_by_section(section_id, student_id, type){       
        
        var school_id = $('#'+type+'_school_id').val();  
        if(!school_id){
           toastr.error('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('school'); ?>');
           return false;
        }
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_student_by_section'); ?>",
            data   : {school_id : school_id, section_id: section_id, student_id: student_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#'+type+'_student_id').html(response);
               }
            }
        });         
    }
  
</script>


 <!-- datatable with buttons -->
 <script type="text/javascript">
        $(document).ready(function() {
          $('#datatable-responsive').DataTable( {
              dom: 'Bfrtip',
              iDisplayLength: 15,
              buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdfHtml5',
                  'pageLength'
              ],
              search: true,              
              responsive: true
          });
        });
        
        
    /* Menu Filter Start */   
        function get_student_by_class(url){          
            if(url){
                window.location.href = url; 
            }
        }         
        
     <?php if(isset($filter_class_id)){ ?>
        get_class_by_school('<?php echo $filter_school_id; ?>', '<?php echo $filter_class_id; ?>');
    <?php } ?>
    
    function get_class_by_school(school_id, class_id){
        
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_class_by_school'); ?>",
            data   : { school_id : school_id, class_id : class_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               { 
                    $('#filter_class_id').html(response);                     
               }
            }
        });
    }  
    
    
    $("#add").validate();     
    $("#edit").validate();   
</script>
 