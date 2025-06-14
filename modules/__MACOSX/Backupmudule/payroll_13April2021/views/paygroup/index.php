<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-home"></i><small> <?php echo $this->lang->line('manage')." ".$this->lang->line('pay_group'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>             
             <div class="x_content quick-link">
			 <span><?php echo $this->lang->line('quick_link'); ?>:</span>
               <?php if(has_permission(VIEW, 'payroll', 'paygroup')){ ?>
                    <a href="<?php echo site_url('payroll/paygroups/index'); ?>"><?php echo $this->lang->line('pay_group'); ?></a>                   
                <?php } ?>   
                 <span><?php echo $this->lang->line('quick_link'); ?>:</span>
               <?php if(has_permission(VIEW, 'payroll', 'grade')){ ?>
                   | <a href="<?php echo site_url('payroll/payscalecategory/index'); ?>"><?php echo $this->lang->line('salary_grade'); ?></a>                   
                <?php } ?>              
                <?php if(has_permission(VIEW, 'payroll', 'payment')){ ?>
                  | <a href="<?php echo site_url('payroll/payment/index'); ?>"><?php echo $this->lang->line('salary'); ?> <?php echo $this->lang->line('payment'); ?></a>                  
                <?php } ?> 
                <?php if(has_permission(VIEW, 'payroll', 'history')){ ?>
                  | <a href="<?php echo site_url('payroll/history/index'); ?>"><?php echo $this->lang->line('payroll'); ?> <?php echo $this->lang->line('history'); ?></a>                  
                <?php } ?> 
                
            </div>
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <?php if(has_permission(VIEW, 'payroll', 'paygroup')){ ?>
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_paygroup_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('pay_group'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
                       <?php } ?>
                          <?php if(has_permission(ADD, 'payroll', 'paygroup')){ ?>
                             <?php if(isset($edit)){ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('payroll/paygroups/add'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('pay_group'); ?></a> </li>                          
                             <?php }else{ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_paygroup"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('pay_group'); ?></a> </li>                          
                             <?php } ?>
                        <?php } ?> 
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_paygroup"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('pay_group'); ?></a> </li>                          
                        <?php } ?>                     
 <li class="li-class-list">
                       <?php if($this->session->userdata('role_id') == SUPER_ADMIN || $this->session->userdata('dadmin') == 1){  ?>                                 
                            <select  class="form-control col-md-7 col-xs-12" onchange="get_paygroup_by_school(this.value);">
                                    <option value="<?php echo site_url('payroll/paygroups/index'); ?>">--<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('school'); ?>--</option> 
                                <?php foreach($schools as $obj ){ ?>
                                    <option value="<?php echo site_url('payroll/paygroups/index/'.$obj->id); ?>" <?php if(isset($filter_school_id) && $filter_school_id == $obj->id){ echo 'selected="selected"';} ?> > <?php echo $obj->school_name; ?></option>
                                <?php } ?>   
                            </select>
                        <?php } ?>  
                    </li> 						
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_paygroup_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
										<?php if($this->session->userdata('role_id') == SUPER_ADMIN || $this->session->userdata('dadmin') == 1){ ?>
										<th><?php echo $this->lang->line('school'); ?></th>
										<?php } ?>
                                        <th><?php echo $this->lang->line('name'); ?></th>
										<th><?php echo $this->lang->line('group_code'); ?></th>
										<th><?php echo $this->lang->line('action'); ?></th>
										                                           
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($paygroups) && !empty($paygroups)){ ?>
                                        <?php foreach($paygroups as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
											<?php if($this->session->userdata('role_id') == SUPER_ADMIN || $this->session->userdata('dadmin') == 1){ ?>
											<td><?php echo $obj->school_name; ?></td>
											<?php } ?>
                                            <td><?php echo $obj->name; ?></td>
											<td><?php echo $obj->group_code; ?></td>	
											<td>
                                                <?php if(has_permission(EDIT, 'payroll', 'paygroup')){ ?>
												<?php if($obj->school_id == 0){
													if($this->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                    <a href="<?php echo site_url('payroll/paygroups/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a>
													<?php } } else { ?>
													 <a href="<?php echo site_url('payroll/paygroups/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a>
													
													<?php }} ?>
                                                <?php if(has_permission(DELETE, 'payroll', 'paygroup')){ ?>
												<?php if($obj->school_id == 0){
													if($this->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                    <a href="<?php echo site_url('payroll/paygroups/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
													<?php } } else { ?>
													  <a href="<?php echo site_url('payroll/paygroups/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                <?php }} ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>                                
                            </div>
                        </div>
                      <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_paygroup">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('payroll/paygroups/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                               
                                <?php $this->load->view('layout/school_list_form'); ?> 
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('name'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="name"  id="name" value="<?php echo isset($name) ?  $name : ''; ?>" placeholder="<?php echo $this->lang->line('name'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('name'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('code'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       <input  class="form-control col-md-7 col-xs-12"  name="group_code"  id="code" value="<?php echo isset($group_code) ?  $group_code : ''; ?>" placeholder="<?php echo $this->lang->line('code'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('code'); ?></div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a  href="<?php echo site_url('payroll/paygroups'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_paygroup">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('payroll/paygroups/edit/'.$paygroup->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php $this->load->view('layout/school_list_edit_form'); ?> 
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('name'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        
                                        <input  class="form-control col-md-7 col-xs-12"  name="name" value="<?php echo isset($paygroup) ? $paygroup->name : ''; ?>"  placeholder="<?php echo $this->lang->line('name'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('name'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('code'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                         <input  class="form-control col-md-7 col-xs-12"  name="group_code" value="<?php echo isset($paygroup) ? $paygroup->group_code : ''; ?>"  placeholder="<?php echo $this->lang->line('code'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('code'); ?></div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($paygroup) ? $paygroup->id : ''; ?>" name="id" />
                                        <a href="<?php echo site_url('payroll/paygroups'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
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
        
       $("#add").validate();  
       $("#edit").validate();  
	   function get_paygroup_by_school(url){          
			if(url){
				window.location.href = url; 
			}		
		} 

</script>