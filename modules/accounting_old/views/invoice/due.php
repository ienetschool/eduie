<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-calculator"></i><small> <?php echo $this->lang->line('manage_due_invoice'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
           
             
            <div class="x_content quick-link no-print">
                <span><?php echo $this->lang->line('quick_link'); ?>:</span>
               <?php if(has_permission(VIEW, 'accounting', 'discount')){ ?>
                    <a href="<?php echo site_url('accounting/discount/index'); ?>"><?php echo $this->lang->line('discount'); ?></a>                  
                <?php } ?> 
              
               <?php if(has_permission(VIEW, 'accounting', 'feetype')){ ?>
                  | <a href="<?php echo site_url('accounting/feetype/index'); ?>"><?php echo $this->lang->line('fee_type'); ?></a>                  
                <?php } ?> 
                
                <?php if(has_permission(VIEW, 'accounting', 'invoice')){ ?>
                   
                   <?php if($this->session->userdata('role_id') == STUDENT || $this->session->userdata('role_id') == GUARDIAN){ ?>
                        | <a href="<?php echo site_url('accounting/invoice/due'); ?>"><?php echo $this->lang->line('due_invoice'); ?></a>                    
                   <?php }else{ ?>
                        | <a href="<?php echo site_url('accounting/invoice/add'); ?>"><?php echo $this->lang->line('fee'); ?> <?php echo $this->lang->line('collection'); ?></a>
                        | <a href="<?php echo site_url('accounting/invoice/index'); ?>"><?php echo $this->lang->line('manage_invoice'); ?></a>
                        | <a href="<?php echo site_url('accounting/invoice/due'); ?>"><?php echo $this->lang->line('due_invoice'); ?></a>                    
                    <?php } ?> 
                <?php } ?> 
                  
                <?php if(has_permission(VIEW, 'accounting', 'duefeeemail')){ ?>
                   | <a href="<?php echo site_url('accounting/duefeeemail/index'); ?>"><?php echo $this->lang->line('due_fee'); ?> <?php echo $this->lang->line('email'); ?></a>                  
                <?php } ?>
                 <?php if(has_permission(VIEW, 'accounting', 'duefeesms')){ ?>
                   | <a href="<?php echo site_url('accounting/duefeesms/index'); ?>"><?php echo $this->lang->line('due_fee'); ?> <?php echo $this->lang->line('sms'); ?></a>                  
                <?php } ?>         
              
            </div>
                        
            <div class="x_content">               
                    
                 <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">                 
                        <li  class="active"><a href="#due_invoice" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-calculator"></i> <?php echo $this->lang->line('due_invoice'); ?> </a></li>                          
                        
                        <li class="li-class-list">
                        <?php if($this->session->userdata('role_id') == SUPER_ADMIN || $this->session->userdata('dadmin') == 1){  ?>                                 
                             <select  class="form-control col-md-7 col-xs-12" onchange="get_invoice_by_school(this.value);">
                                     <option value="<?php echo site_url('accounting/invoice/due'); ?>">--<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('school'); ?>--</option> 
                                 <?php foreach($schools as $obj ){ ?>
                                     <option value="<?php echo site_url('accounting/invoice/due/'.$obj->id); ?>" <?php if(isset($filter_school_id) && $filter_school_id == $obj->id){ echo 'selected="selected"';} ?> > <?php echo $obj->school_name; ?></option>
                                 <?php } ?>   
                             </select>
                         <?php } ?>  
                        </li>  
                    </ul>
                    <br/>
                     <div class="tab-content">
                        <div  class="tab-pane fade in active" id="due_invoice" >
                            <div class="x_content">   
                               <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                   <thead>
                                       <tr>
                                           <th><?php echo $this->lang->line('sl_no'); ?></th>
                                           <?php if($this->session->userdata('role_id') == SUPER_ADMIN || $this->session->userdata('dadmin') == 1){ ?>
                                                <th><?php echo $this->lang->line('school'); ?></th>
                                            <?php } ?>
                                           <th><?php echo $this->lang->line('invoice'); ?> <?php echo $this->lang->line('number'); ?></th>
                                           <th><?php echo $this->lang->line('student'); ?></th>
                                           <th><?php echo $this->lang->line('class'); ?></th>
                                           <th><?php echo $this->lang->line('fee'); ?> <?php echo $this->lang->line('type'); ?></th>
                                           <th><?php echo $this->lang->line('gross_amount'); ?></th>
                                           <th><?php echo $this->lang->line('discount'); ?></th>
                                           <th><?php echo $this->lang->line('net_amount'); ?></th>
                                           <th><?php echo $this->lang->line('due_amount'); ?></th>
                                           <th><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('status'); ?></th>
                                           <th><?php echo $this->lang->line('action'); ?></th>                                            
                                       </tr>
                                   </thead>
                                   <tbody>   
                                       <?php $count = 1; if(isset($invoices) && !empty($invoices)){ ?>
                                           <?php foreach($invoices as $obj){ ?>
                                           <tr>
                                               <td><?php echo $count++; ?></td>
                                                <?php if($this->session->userdata('role_id') == SUPER_ADMIN || $this->session->userdata('dadmin') == 1){ ?>
                                                    <td><?php echo $obj->school_name; ?></td>
                                                <?php } ?>
                                               <td><?php echo $obj->custom_invoice_id; ?></td>
                                               <td><?php echo $obj->student_name; ?></td>
                                               <td><?php echo $obj->class_name; ?></td>
                                               <td><?php echo $obj->head; ?></td>
                                               <td><?php echo $obj->gross_amount; ?></td>
                                               <td><?php echo $obj->discount; ?></td>
                                               <td><?php echo $obj->net_amount; ?></td>
                                               <td class="red">
                                                   <?php 
                                                    $paid_amount = get_invoice_paid_amount($obj->id);
                                                    echo $paid_amount->net_amount - $paid_amount->paid_amount; 
                                                   ?>
                                               </td>
                                               <td><?php echo get_paid_status($obj->paid_status); ?></td>
                                               <td>
                                                   <a href="<?php echo site_url('accounting/invoice/view/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a>
                                                   <a href="<?php echo site_url('accounting/payment/index/'.$obj->id); ?>"  class="btn btn-success btn-xs"><i class="fa fa-credit-card"></i> <?php echo $this->lang->line('payment'); ?> </a>
                                               </td>
                                           </tr>
                                           <?php } ?>
                                       <?php } ?>
                                   </tbody>
                               </table>
                           </div>
                        </div>
                 </div>
                </div>
            </div>
       
    </div>
</div>
</div>
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
    
     function get_invoice_by_school(url){          
        if(url){
            window.location.href = url; 
        }
    }  
    
</script>