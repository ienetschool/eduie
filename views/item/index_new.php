
<?php 
$aTotalCols = array('5'=>'opening_q',6=>"opening_am", 7=>"purchase_yq"
, 8=>"purchase_ymrp", 9=>"purchase_yamv", 10=>"purchase_yam",11=>'total_q', 12=>'total_am', 13=>'sale_q', 14=>'sale_am'
, 15=>'return_q', 16=>'return_am'
, 17=>'balance_q', 18=>'balance_am'
)
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-home"></i><small> <?php echo $this->lang->line('manage_item'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>        
            <?php  $this->load->view('layout/item-quicklinks');   ?>

            
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <?php if(has_permission(VIEW, 'inventory', 'item')){ ?>
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_item_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('item'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
                       <?php } ?>
                       
                       <?php if(has_permission(ADD, 'inventory', 'item')){ ?> 
                            <?php if(isset($edit)){ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('item/add'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('item'); ?></a> </li>                          
                             <?php }else{ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_item"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('item'); ?></a> </li>                          
                             <?php } ?>
                        <?php } ?>                       
                            
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_item"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('item'); ?></a> </li>                          
                        <?php } ?> 
						 <li class="li-class-list">
                       <?php if($this->session->userdata('role_id') == SUPER_ADMIN || $this->session->userdata('role_id') == DISTRICT_ADMIN){  ?>                                 
                            <select  class="form-control col-md-7 col-xs-12" onchange="get_item_by_school(this.value);">
                                    <option value="<?php echo site_url('item/index'); ?>">--<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('school'); ?>--</option> 
                                <?php foreach($schools as $obj ){ ?>
                                    <option value="<?php echo site_url('item/index/'.$obj->id); ?>" <?php if(isset($filter_school_id) && $filter_school_id == $obj->id){ echo 'selected="selected"';} ?> > <?php echo $obj->school_name; ?></option>
                                <?php } ?>   
                            </select>
                        <?php } ?>  
                    </li> 
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_item_list" >
                            <div class="x_content">
                            <?php
           
           echo form_open_multipart(site_url('/item/index'), array('name' => 'student', 'id' => 'student', 'class' => 'form-horizontal form-label-left'), '');
           $class_name ="";
           $fee_type_name ="";
       ?>
                            <div class="col-md-3 col-sm-3 col-xs-12" >
                                <div class="form-group item">
                                    <div>Item Group </div>

                                        <select class="form-control col-md-7 col-xs-12" id="filter_group_id" name="group_id" style="width:auto;" >
                                        <option value="">All</option>

                                        <?php foreach($item_groups as $group) { 
                                            ?>
                                            <option value="<?php echo  $group->id  ?>" <?php echo isset($group_id) && $group_id == $group->id ? "selected='selected'" : "" ; ?> ><?php echo  $group->name  ?></option>
                                        <?php } ?>                                
                                        </select>
                                </div>
                             </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group item">
                                    <div>Item Category</div>

                                    <select name="category_id" class="form-control col-md-7 col-xs-12" id="category_id">
                                    <option value="">All</option>
                                    <?php foreach($item_categories as $item_category) {
                                        ?>
                                                <option value="<?php echo  $item_category->id  ?>" <?php echo isset($category_id) && $category_id == $item_category->id ? 'selected="selected"' : "" ; ?> ><?php echo  $item_category->name  ?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group"><br/>
                                     <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('find'); ?></button>
                                 </div>
                             </div>
                        </div>
                        
                        <?php echo form_close(); ?>

                                <?php 
                                
                                if($filter_school_id) { ?> 
                                    <a href="<?php echo site_url('/item/import_defualt/'.$filter_school_id) ?>" class="btn btn-sm" >Import Default</a>
                                <?php } ?>
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th rowspan="2"><?php echo $this->lang->line('sl_no'); ?></th>
										<?php if($this->session->userdata('role_id') == SUPER_ADMIN || $this->session->userdata('role_id') == DISTRICT_ADMIN){ ?>
										<th rowspan="2"><?php echo $this->lang->line('school'); ?></th>
										<?php } ?>
                                        <th rowspan="2"><?php echo $this->lang->line('item'); ?></th>  
                                        <th rowspan="2"><?php echo $this->lang->line('item_code'); ?></th>

										<th rowspan="2"><?php echo $this->lang->line('category'); ?></th>
										<th rowspan="2"><?php echo $this->lang->line('group'); ?></th>
										<!-- <th><?php echo $this->lang->line('unit'); ?></th> -->
                                      
                                        <th colspan="2">Opening Balance <?php echo $start_date." - ".$end_date  ?></th>
                                        <th colspan="4">Purchase During the Year</th>
                                        
                                        <th colspan="2">Total</th>
                                        <th colspan="2">Sale During the Year</th>
                                        <th colspan="2">Return During the Year</th>
                                        <th colspan="2">Current Balance</th>
                                        <th rowspan="2"><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                    <tr>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Quantity</th>
                                        <th >MRP</th>
                                        <th >Purchase Value</th>
                                        <th>Amount</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($items) && !empty($items)){ ?>
                                        <?php foreach($items as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
											<?php if($this->session->userdata('role_id') == SUPER_ADMIN || $this->session->userdata('role_id') == DISTRICT_ADMIN){ ?>
											<td><?php echo $obj['school_name']; ?></td>
											<?php } ?>
                                            <td><?php echo $obj['name']; ?></td>
                                            <td><?php echo $obj['item_code']; ?></td>

											<td><?php echo $obj['item_category']; ?></td>
											<td><?php echo $obj['group_name']; ?></td>
											<!-- <td><?php echo $obj['unit']; ?></td> -->

											
                                            <?php
                                                $obj['opening_count'] =  $obj['opening_count'] - $obj['opening_sale_count'] +  $obj['opening_returned'];
                                                $obj['opening_value'] =  $obj['opening_value'] - $obj['opening_sale_value'] +  $obj['opening_returned_value'];
                                                if ($obj['opening_count'] < 1) $obj['opening_count'] = 0;
                                                if ($obj['opening_value'] < 1) $obj['opening_value'] = 0;
                                            ?>
                                            <td><?php echo(float)$obj['opening_count']; ?></td>
                                            <td><?php echo(float)$obj['opening_value']; ?></td>

                                            <td><?php echo(float)$obj['purhcase_count_year']; ?></td>
                                            <td><?php echo $obj['mrp'] ; ?></td>
                                            <td><?php echo $obj['last_purchase_value'] ; ?></td>
                                            <td><?php echo (float)$obj['purhcase_value_year']; ?></td>

                                            <?php
                                                $iTotalCount =  $obj['opening_count'] + $obj['purhcase_count_year'];
                                                $iTotalValue =  $obj['opening_value'] + $obj['purhcase_value_year'];
                                                if ( $iTotalCount < 1)  $iTotalCount = 0;
                                                if ($iTotalValue < 1) $iTotalValue = 0;
                                            ?>
                                            <td><?php echo $iTotalCount; ?></td>
                                            <td><?php echo  $iTotalValue; ?></td>
                                           
                                            <td><?php echo (float)$obj['sale_count_year']; ?></td>
                                            <td><?php echo (float)$obj['sale_value_year']; ?></td>
                                            <td><?php echo (float)$obj['returned_year']; ?></td>
                                            <td><?php echo (float)$obj['returned_year_valu']; ?></td>
                                            <?php
                                                $iAvailable = $iTotalCount -  $obj['sale_count_year'] +  $obj['returned_year'];
                                                $iAvalilableValue =  $iTotalValue -  $obj['sale_value_year'] +  $obj['returned_year_valu'];
                                                if ( $iAvailable < 1)  $iAvailable = 0;
                                                if ($iAvalilableValue < 1) $iAvalilableValue = 0;
                                                $iAvalilableValue =   $obj['last_purchase_value'] * $iAvailable ;
                                            ?>
                                             <td><?php echo (float)$iAvailable; ?></td>
                                            <td><?php echo  (float)$iAvalilableValue; ?></td>
                                                                                  
                                            <td>            
                                            <a href="<?php echo site_url('../itemstock/?item_id='.$obj['id']); ?>" class="btn btn-info btn-xs">Purchases </a>
                                            <a href="<?php echo site_url('../issueitem/?item_id='.$obj['id']); ?>" class="btn btn-info btn-xs">Sales </a>
                                                <?php if(has_permission(EDIT, 'inventory', 'item')){ ?>
                                                    <a href="<?php echo site_url('item/edit/'.$obj['id']); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'inventory', 'item')){ ?>
                                                    <a href="<?php echo site_url('item/delete/'.$obj['id']); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Total</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>                                
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_item">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('item/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>           
							   <?php $this->load->view('layout/school_list_form'); ?>                                                                                              
                                <div class="item form-group">                        
                                    
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('name'); ?> <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="name"  id="name" value="<?php echo isset($post['name']) ?  $post['name'] : ''; ?>" placeholder="<?php echo $this->lang->line('name'); ?> "  type="text" autocomplete="off" required='required'>
                                            <div class="help-block"><?php echo form_error('name'); ?></div> 
                                        </div>
                                    </div>                                                                      
								
								 <div class="item form-group">                        
                                    
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('category'); ?> <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
                                    <select autofocus="" id="add_category_id" name="item_category_id" class="form-control" required='required'>
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($itemcategories as $cat) {
                                            ?>
                                            <option value="<?php echo $cat->id; ?>" <?php
                                            if(isset($_POST) && $_POST['item_category_id'] == $cat->id) {
                                                echo "selected=selected";
                                            }
                                            ?>><?php echo $cat->item_category; ?></option>
                                                    <?php
                                                }
                                                ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('item_category_id'); ?></span>
										</div>
                                    </div>                                                                      
								
								 <!-- <div class="item form-group">                        
                                    
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('unit'); ?> <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="unit"  id="unit" value="<?php echo isset($post['unit']) ?  $post['unit'] : ''; ?>" placeholder="<?php echo $this->lang->line('unit'); ?> "  type="text" autocomplete="off" required='required'>
                                            <div class="help-block"><?php echo form_error('unit'); ?></div> 
                                        </div> -->
                                    <!-- </div>       -->
                                <div class="item form-group">                        
                                    
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Measurement <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  name="unit"  id="unit" >
                                            <option  value="0">Pic(pices)</option>
                                            <option  value="1"> DZ (Dozen)</option>
                                            <option  value="2">Set (Sets)</option>
                                            <option  value="3">CP(copies)</option>
                                        </select>
                                    <!-- <input  class="form-control col-md-7 col-xs-12"  name="unit"  id="unit" value="<?php echo isset($post['unit']) ?  $post['unit'] : ''; ?>" placeholder="<?php echo $this->lang->line('unit'); ?> "  type="text" autocomplete="off" required='required'> -->
                                    <div class="help-block"><?php echo form_error('unit'); ?></div> 
                                    </div>
                                </div>               
                                <div class="item form-group">                        
                                    
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="item_code"><?php echo $this->lang->line('item_code'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  class="form-control col-md-7 col-xs-12"  name="item_code"  id="item_code" value="<?php echo isset($post['item_code']) ?  $post['item_code'] : ''; ?>" placeholder="<?php echo $this->lang->line('item_code'); ?> "  type="text" autocomplete="off" >
                                    <div class="help-block"><?php echo form_error('item_code'); ?></div> 
                                    </div>
                                </div>                                                                  
								<div class="item form-group">                        
                                    
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('purchase_price'); ?> <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="purchase_price"  id="purchase_price" value="<?php echo isset($post['purchase_price']) ?  $post['purchase_price'] : ''; ?>" placeholder="<?php echo $this->lang->line('purchase_price'); ?> "  type="text" autocomplete="off" required='required'>
                                            <div class="help-block"><?php echo form_error('purchase_price'); ?></div> 
                                        </div>
                                    </div>            
								<div class="item form-group">                        
                                    
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('description'); ?></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											<textarea name='description' class="form-control col-md-7 col-xs-12"><?php echo isset($post['description']) ?  $post['description'] : ''; ?></textarea>                                          
                                            <div class="help-block"><?php echo form_error('description'); ?></div> 
                                        </div>
                                    </div>                                                                      
								
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('item/index'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php  echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_item">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('item/edit/'.$item->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>   
							   <?php $this->load->view('layout/school_list_edit_form'); ?>                                 
                                <div class="item form-group">                        
                                    
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('name'); ?> <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="name"  id="name" value="<?php echo isset($item->name) ?  $item->name : ''; ?>" placeholder="<?php echo $this->lang->line('name'); ?> "  type="text" autocomplete="off" required='required'>
                                            <div class="help-block"><?php echo form_error('name'); ?></div> 
                                        </div>
                                    </div>                                                                      
								
								<div class="item form-group">                        
                                    
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('category'); ?> <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
                                    <select autofocus="" id="edit_category_id" name="item_category_id" class="form-control" required='required'>
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($itemcategories as $cat) {
                                            ?>
                                            <option value="<?php echo $cat->id; ?>" <?php
                                            if(isset($item) && $item->item_category_id == $cat->id) {
                                                echo "selected=selected";
                                            }
                                            ?>><?php echo $cat->item_category; ?></option>
                                                    <?php
                                                }
                                                ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('item_category_id'); ?></span>
										</div>
                                    </div>                                                                      
								
								 <!-- <div class="item form-group">                        
                                    
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('unit'); ?> <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="unit"  id="unit" value="<?php echo isset($item->unit) ?  $item->unit : ''; ?>" placeholder="<?php echo $this->lang->line('unit'); ?> "  type="text" autocomplete="off" required='required'>
                                            <div class="help-block"><?php echo form_error('unit'); ?></div> 
                                        </div>
                                    </div>      -->
                                    <div class="item form-group">                        
                                    
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Measurement <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  name="unit"  id="unit" >
                                        <option  value="">-- Select Measurement --</option>
                                            <option  value="0" <?php echo isset($item->unit) && $item->unit == 0 ?  "selected" : ''; ?>>Pic(pices)</option>
                                            <option  value="1" <?php echo isset($item->unit) && $item->unit == 1 ?  "selected" : ''; ?>> DZ (Dozen)</option>
                                            <option  value="2" <?php echo isset($item->unit) && $item->unit == 2 ?  "selected" : ''; ?>>Set (Sets)</option>
                                            <option  value="3" <?php echo isset($item->unit) && $item->unit == 3 ?  "selected" : ''; ?>>CP(copies)</option>
                                        </select>
                                    <!-- <input  class="form-control col-md-7 col-xs-12"  name="unit"  id="unit" value="<?php echo isset($post['unit']) ?  $post['unit'] : ''; ?>" placeholder="<?php echo $this->lang->line('unit'); ?> "  type="text" autocomplete="off" required='required'> -->
                                    <div class="help-block"><?php echo form_error('unit'); ?></div> 
                                    </div>
                                </div>                                                                        
                                    <div class="item form-group">                        
                                    
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="item_code"><?php echo $this->lang->line('item_code'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  class="form-control col-md-7 col-xs-12"  name="item_code"  id="item_code" value="<?php echo isset($item->item_code) ?  $item->item_code : ''; ?>" placeholder="<?php echo $this->lang->line('item_code'); ?> "  type="text" autocomplete="off" >
                                    <div class="help-block"><?php echo form_error('item_code'); ?></div> 
                                </div>
                                </div>       
								<div class="item form-group">                        
                                    
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('description'); ?></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											<textarea name='description' class="form-control col-md-7 col-xs-12"><?php echo isset($item->description) ?  $item->description : ''; ?></textarea>                                          
                                            <div class="help-block"><?php echo form_error('description'); ?></div> 
                                        </div>
                                    </div>                                                                      
                                  		
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($item) ? $item->id : '' ?>" name="id" />
                                        <a href="<?php echo site_url('item/index'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php  echo $this->lang->line('update'); ?></button>
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
    var filter_school_id = <?php echo isset($filter_school_id) && $filter_school_id ?  $filter_school_id : 0 ; ?>;
    var filter_category_id = <?php echo isset($category_id) && $category_id ?  $category_id : 0 ; ?>;
    var group_id = <?php echo isset($group_id) && $group_id ?  $group_id : 0 ; ?>;

    $(document).ready(function() {
          $('#datatable-responsive').DataTable( {
              dom: 'Bfrtip',
              iDisplayLength: 15,
              buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdfHtml5',
                  'pageLength',
                  'colvis'
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
  // Total over all pages
            <?php
            foreach ($aTotalCols as $iCol => $sName){
            ?>
                <?php  echo $sName ?> = api
                .column( <?php echo $iCol; ?>)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(2);;
                <?php  echo $sName."_page" ?> = api
                .column( <?php echo $iCol; ?>, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(2);;
                $( api.column( <?php echo $iCol; ?> ).footer() ).html(
                    <?php  echo $sName."_page" ?> +' ('+  <?php  echo $sName ?> +')'
                );
           <?php } ?>
            // Update footer
           
        },
               "columnDefs": [
                     {
			 			"targets": [3,4, 15, 16] ,
                         "visible": false,
			 		}
                    , {
			 			"targets": [1,2] ,
                         "searchable": true,
			 		} , {
			 			"targets": [0,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17, 18, 19] ,
                         "searchable": false,
			 		}
             ],
              search: true,              
              responsive: true
          });
        });
        
       $("#add").validate();  
       $("#edit").validate();  
	    function get_item_by_school(url){          
        if(url){
            window.location.href = url; 
        }
    } 
</script>
<script type="text/javascript">
     
    var edit = false;
         
    $("document").ready(function() {
        get_item_category(group_id)
		<?php if(isset($filter_school_id) && $filter_school_id>=0){ ?>		 
		 if($("#edit_school_id").length == 0) {			 
             $(".fn_school_id").trigger('change');			 
		 }
		 else{			 
			 $("#edit_school_id").trigger('change');	
		 }				
         <?php } ?>		         
    });
     
    <?php if(isset($item) && !empty($item)){ ?>
          edit = true; 
    <?php } ?>
     
    $('.fn_school_id').on('change', function(){
      
        var school_id = $(this).val();        
        var category_id = '';
       
        
        <?php if(isset($edit) && !empty($edit)){ ?>
            category_id =  '<?php echo $item->item_category_id; ?>';            
         <?php } ?> 
        
        if(!school_id){
           toastr.error('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('school'); ?>');
           return false;
        }
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_itemcategory_by_school'); ?>",
            data   : { school_id:school_id, category_id:category_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {  
                   if(edit){
                       $('#edit_category_id').html(response);   
                   }else{
                       $('#add_category_id').html(response);   
                   }                                                      
               }
            }
        });
    }); 
    $('#filter_group_id').on('change', function(){
        get_item_category( $(this).val())
    })
    function get_item_category(group_id){       
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_item_category_by_group'); ?>",
            data   : { school_id:filter_school_id, category_id : filter_category_id, group_id : group_id },               
            async  : false,
            success: function(response){                                                   
            if(response)
            { 
                $('#category_id').html(response); 
            }
            }
        });
} 
  </script>