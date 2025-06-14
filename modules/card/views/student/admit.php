<style>

@media print {
   
   .right_col {
     margin-left: 20px !important;
   }
 /******** ID CARD ********/
 .card-top{       
     background-color: #f1f1f1 !important;
     background-size: 100% 100% !important;
     -webkit-print-color-adjust: exact !important; 
     color-adjust: exact !important; 
 }    
 .card-bottom{       
     background-color: #f1f1f1 !important;       
     background-size: 100% 100% !important;
     -webkit-print-color-adjust: exact !important; 
     color-adjust: exact !important; 
 }
 
.even-card
  {
    page-break-after: always;
  }
 /******** ADMIT CARD ********/
 .admit-card-block{      
    padding:2px;
     border: 3px dashed lightgray;
     border-radius: 10px;
     margin: 20px 20px !important; 
     float: left;
     height : 500px !important;
 }  
 .admit-card-top{
     background-color: #f1f1f1 !important;    
     background-size: 100% 100% !important;
     -webkit-print-color-adjust: exact !important; 
     color-adjust: exact !important; 
 }

 .admit-card-bottom{        
     background-color: #f1f1f1 !important;       
     background-size: 100% 100% !important;
     -webkit-print-color-adjust: exact !important; 
     color-adjust: exact !important; 
 }
 
}

@media all { 

 .card_sign{
     max-height: 80%;
     margin-left: 6px;
     margin-right: 6px;
     margin-top: 3px;
 }
 .admit-card-block
  {
    page-break-before: always !important;
  }
  .admit-card-block {
    page-break-inside: avoid !important;
}
 .card-block{
     /*width: 400px;
     height: 225px;
     border: 1px dashed lightgray;
     border-radius: 10px;
     margin: 10px 20px;
     float: left;*/

     /*css_change*/
     /* width: 221px;
 height: 450px;
 border: 1px dashed lightgray;
 border-radius: 10px;
 margin: 10px 20px;
 float: left; */
 width: 220px;
 height: 410px;
 border: 1px dashed lightgray;
 border-radius: 10px;
 margin: 5px 6px;
 position: relative;
 float: left;
     }

 .card-top{
     /*height: 65px;
     width: 100%;
     background: #f1f1f1;
     border-radius: 10px 10px 0px 0px;
     background-size: 100% 100% !important;
     -webkit-print-color-adjust: exact !important; 
     color-adjust: exact !important; */
     /*css_change*/
        height: 80px;
     width: 100%;
     background: #f1f1f1;
     border-radius: 10px 10px 0px 0px;
     background-size: 100% 100% !important;
     -webkit-print-color-adjust: exact !important;
         color-adjust: exact !important;
 }
 .card-logo{
     width: 20%;
     float: left;
     text-align: left !important;
 }
 .card-logo img{
     padding: 1px 1px 1px 1px;        
     text-align: center;
     max-height: 65px;
     max-width: 65px;
 }
 .card-school{       
     /*float: left;   
     width: 318px;*/
     /*css_change*/
    float: left;
 width: 80%;
 padding: 4px
 }
 .card-school h2{
     font-size: 15px !important;
     padding: 0px 5px;
     font-weight: 500;
     text-align: center;
     vertical-align: middle;
     margin: 5px 0px 0px 0px;
 }
 .card-school p{
     text-align: center;
     font-size: 10px;
     padding: 0px;
     margin: 0px;
     line-height: 8px;
 }
 .std-id{
     /*width: 100%;
     text-align: center;        */
     /*css_change*/
     width: 100%;
     text-align: center;
     margin-bottom: 7px;
 }
 .std-id h3{
     padding: 0;
     margin: 0px;
 }
 .std-id span{ 
     font-size: 14px;
     font-weight: bold;
     background: lightblue;
     padding: 3px 20px;
     border-radius: 10px;
 }
 
 /* card middle */
 .card-photo{     
     width: 120px;
     float: left;
     text-align: center;
 }
 .card-photo img{
     /*width: 90px;
     height: 90px;
     margin: 0px 50px 20px 5px;
     text-align: center;
     border-radius: 10px;
     max-height: 110px;
     border: 1px solid #efefef;*/
     /*css_change*/
     width: 90px;
     height: 90px;
     margin: 5px 59px 4px 69px;
     text-align: center;
     border-radius: 10px;
     max-height: 110px;
     border: 1px solid #efefef;
 }
 .card-info{
     /*line-height: 15px;
     padding-top: 5px;
     float: left;*/
     /*css_change*/
     line-height: 22px;
     padding: 2px 0px 1px 5px;
     float: left;
     width: 100%;
         /* line-height: 22px;
         
         padding: 9px 0px 8px 2px;
         float: left;
         width: 217px; */
 /* background-color: yellow;*/
 }
 .card-info p{ 
     padding: 0px;
     margin: 0px;
 }
 .card-info p .card-title{
     /*text-align: left;
     font-size: 11px; 
     font-weight: bold;
     width: 90px;
     float: left;*/
     /*css_change*/
         font-size: 12px !important;
 /* width: 101px; */
 color: #040003 !important;
 font-weight: bold !important;;
 }
 .card-info p .card-value{
     /*text-align: left;
     font-size: 11px; 
     width: 180px;
     float: left;*/
     /*css_change*/
     text-align: right;
 font-size: 12px;
 width: 180px;
 /* float: left;*/
 }

 /* bottom*/
 .card-bottom{
     /*height: 22px;
     width: 100%;
     background-color: #f1f1f1;
     border-radius: 0px 0px 10px 10px;
     float: left;*/
     /*css_change*/
         /* height: 22px;
         width: 100%;
         background-color: #f1f1f1;
         border-radius: 0px 0px 10px 10px;
         float: left;
         margin-top: 12px; */
         height: 34px;
 width: 100%;
 background-color: #f1f1f1;
 border-radius: 0px 0px 10px 10px;
 float: left;
 margin-top: 5px;
 bottom: 0px;
 position: absolute;
 }
 .card-bottom p{
     text-align: center;
     font-size: 12px;
     margin: 0px;
     padding: 3px 30px;
 }
 
 
 /********************Admit card ********************************/
 .admit-card-block{
     width: 700px;
     min-height: 330px;
     border: 3px dashed lightgray;
     border-radius: 10px;
     margin: 10px 20px;
     padding-bottom : 5px;
     float: left;
 }  
 .admit-card-top{
    padding-top :10px;
     height: 110px;
     width: 100%;
     border-radius: 10px 10px 0px 0px;
     background-size: 100% 100% !important;
     -webkit-print-color-adjust: exact !important; 
     color-adjust: exact !important; 
 }

 .admit-card-logo{
     width: 25%;
     float: left;
     text-align: center;
 }
 .admit-card-logo img{
     padding: 10px 0px 5px 10px;        
     text-align: center;
     height: 95px;
     width: 100px;
 }

 .admit-card-school{       
     float: left;   
     width: 49%;
     text-align :center;
 }
 .admit-card-school h2{
     font-size: 30px;
     padding: 0px 10px;
     text-align: center;
     vertical-align: middle;
     margin: 10px 0px 0px 0px;
     color: #f1f1f1;
 }
 .admit-card-school p{
     text-align: center;
     font-size: 14px;
     padding: 0px;
     margin: 0px;
     line-height: 16px;
 }
.admit-card-details
{
    width: 100%;
     text-align: left;
     margin: 10px 0px;
   
}
 .caption-student
{
    font-weight : bold;
}
.admit-card-details table tr td
{
    border : 1px solid black;
}
 .admit-card{
     width: 100%;
     text-align: center;
     margin: 10px 0px;
   
 }
 .admit-card span{
     padding: 0;
     margin: 5px;
     font-size: 18px;
     font-weight: bold;
     background: lightblue;
     padding: 5px 20px;
     border-radius: 10px;
 }

 
 /* card middle */
 .admit-card-main{
     margin-bottom: 10px;
     float: left;
 }
 .admit-card-photo{  
     width: 150px;
     float: left;
     text-align: center;
 }
 .admit-card-photo img{
     width: 120px;        
     padding: 0px 8px 8px 8px;
     text-align: center;
     border-radius: 10px;
     max-height: 140px;
 }

 .admit-card-info{
     line-height: 16px;
     padding-top: 5px;
     float: left;
     width: 262px;
     border-right: 1px solid #969696;
 }
 .admit-card-info p{ 
     padding: 0px;
     margin: 0px;
 }
 .admit-card-info p .admit-card-title{
     text-align: left;
     font-size: 11px; 
     font-weight: bold;
     width: 90px;
     float: left;
 }
 .admit-card-info p .admit-card-value{
     text-align: left;
     font-size: 11px; 
     width: 170px;
     float: left;
 }
 
 .admit-card-subject{
     float: left;       
     width: 280px;      
     padding-left: 5px;
     min-height: 132px;
 }
 .admit-exam{
     font-size: 16px;
     text-align: left;
 }
 .subject-heading{
     font-size: 14ox;
     border-bottom: 1px solid lightgray;
 }
 .exam-subjects{
    padding-top: 5px; 
 }
 .exam-subjects ol{
     padding:0px;
     margin: 0px;
     float: left;
 }
 .exam-subjects ol li {
         float: left;
         font-size: 12px;
         margin-left: 20px;
         width: 40%;
         line-height: 14px;
         color: #3943cc;
 }

 /* bottom*/
 .admit-card-bottom{
     height: 25px;
     width: 100%;
     border-radius: 0px 0px 10px 10px;
     float: left;       
 }

 .admit-card-bottom p{
     text-align: center;
     font-size: 14px;
     margin: 0px;
     padding: 3px 30px;
 }
 .admit-card-logo {
    width: 15%;
    float: left;
    text-align: center;
}
h3, h3 {
    font-size: 10px;
}
.admit-card-school {
    float: left;
    width: 65%;
    text-align: center;
}
}
</style>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-barcode"></i><small> <?php echo $this->lang->line('generate'); ?> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('admit'); ?>  <?php echo $this->lang->line('card'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content quick-link no-print">
                <span><?php echo $this->lang->line('quick_link'); ?>:</span>
                
                <?php if(has_permission(VIEW, 'card', 'idsetting')){ ?>
                     <a href="<?php echo site_url('card/idsetting/index'); ?>"><?php echo $this->lang->line('id'); ?> <?php echo $this->lang->line('card'); ?> <?php echo $this->lang->line('setting'); ?></a>
                <?php } ?>    
                 <?php if(has_permission(VIEW, 'card', 'admitsetting')){ ?>
                      |  <a href="<?php echo site_url('card/admitsetting/index'); ?>"><?php echo $this->lang->line('admit'); ?> <?php echo $this->lang->line('card'); ?> <?php echo $this->lang->line('setting'); ?></a>
                <?php } ?>  
                      
                <?php if(has_permission(VIEW, 'card', 'schoolidsetting')){ ?>
                    <a href="<?php echo site_url('card/schoolidsetting/index'); ?>"><?php echo $this->lang->line('id'); ?> <?php echo $this->lang->line('card'); ?> <?php echo $this->lang->line('setting'); ?></a>
                <?php } ?>       
                <?php if(has_permission(VIEW, 'card', 'schooladmitsetting')){ ?>
                      | <a href="<?php echo site_url('card/schooladmitsetting/index'); ?>"><?php echo $this->lang->line('admit'); ?> <?php echo $this->lang->line('card'); ?> <?php echo $this->lang->line('setting'); ?></a>
                <?php } ?>

                <?php if(has_permission(VIEW, 'card', 'teacher')){ ?>
                    | <a href="<?php echo site_url('card/teacher/index'); ?>"><?php echo $this->lang->line('teacher'); ?> <?php echo $this->lang->line('id'); ?> <?php echo $this->lang->line('card'); ?></a>
                <?php } ?>
                <?php if(has_permission(VIEW, 'card', 'employee')){ ?>
                   | <a href="<?php echo site_url('card/employee/index'); ?>"><?php echo $this->lang->line('employee'); ?> <?php echo $this->lang->line('id'); ?> <?php echo $this->lang->line('card'); ?></a>
                <?php } ?>
                <?php if(has_permission(VIEW, 'card', 'student')){ ?>  
                   | <a href="<?php echo site_url('card/student/index'); ?>"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('id'); ?> <?php echo $this->lang->line('card'); ?></a>
                <?php } ?>  
                <?php if(has_permission(VIEW, 'card', 'admit')){ ?>  
                   | <a href="<?php echo site_url('card/admit/index'); ?>"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('admit'); ?> <?php echo $this->lang->line('card'); ?></a>
                <?php } ?>  
            </div>


            <div class="x_content no-print"> 
                <?php echo form_open_multipart(site_url('card/admit/index'), array('name' => 'generate', 'id' => 'generate', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row">
                    
                     <div class="col-md-10 col-sm-10 col-xs-12">  
                    <?php $this->load->view('layout/school_list_filter'); ?>

                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('exam'); ?>  <span class="required">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12" name="exam_id" id="exam_id"  required="required">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                <?php if(isset($exams) && !empty($exams)) { ?>
                                    <?php foreach ($exams as $obj) { ?>
                                    <option value="<?php echo $obj->id; ?>" <?php if(isset($exam_id) && $exam_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->title; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                            <div class="help-block"><?php echo form_error('exam_id'); ?></div>
                        </div>
                    </div>
                     <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('class'); ?> <span class="required">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12" name="class_id" id="class_id"  required="required" onchange="get_section_by_class(this.value, '');">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                <?php if(isset($classes) && !empty($classes)) { ?>
                                    <?php foreach ($classes as $obj) { ?>
                                    <option value="<?php echo $obj->id; ?>" <?php if(isset($class_id) && $class_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('class'); ?> <?php echo $obj->name; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                            <div class="help-block"><?php echo form_error('class_id'); ?></div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('section'); ?> <span class="required">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12" name="section_id" id="section_id" required="required" onchange="get_student_by_section(this.value, '');">                                
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                            </select>
                            <div class="help-block"><?php echo form_error('section_id'); ?></div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('student'); ?> <span class="required">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12"  name="student_id"  id="student_id" required="required">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                            </select>
                            <div class="help-block"><?php echo form_error('student_id'); ?></div>
                        </div>
                    </div>
                    </div>    
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group"><br/>
                            <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('generate'); ?></button>
                        </div>
                    </div>

                </div>
                <?php echo form_close(); ?>
            </div>

            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">                    
                    <ul  class="nav nav-tabs bordered no-print">                 
                        <li  class="active"><a href="#tab_student_list" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa fa-users"></i> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('list'); ?></a></li>                          
                    </ul>
                    <br/>
                    <div class="tab-content">
                        <div  class="tab-pane fade in active" id="tab_student_list">
                            <div class="x_content">
                                
                               <div class="row">
                                   
                                   <?php if(isset($cards) && !empty($cards)){ 
                                    $iCardCount =0;
                                    ?>
                                        <?php foreach($cards as $obj){
                                            $iCardCount++;
                                            $sCardClass = $iCardCount%2== 0 ? "even-card" : 'odd-card';
                                            $sNUmberInWords = numberToWords($obj->roll_no);
                                            ?>  

                                            <div class="admit-card-block <?php echo $sCardClass; ?>">
                                                <div class="admit-card-top">
                                                    <div class="admit-card-logo">
                                                        <?php  if(isset($admit_setting->school_logo) && $admit_setting->school_logo!= ''){ ?>
                                                           <img src="<?php echo UPLOAD_PATH; ?>/logo/<?php echo $admit_setting->school_logo; ?>" alt="" /> 
                                                        <?php }else if($school->logo){ ?>
                                                           <img src="<?php echo UPLOAD_PATH; ?>/logo/<?php echo $school->logo; ?>" alt="" /> 
                                                        <?php }else if($school->frontend_logo){ ?>
                                                           <img src="<?php echo UPLOAD_PATH; ?>/logo/<?php echo $school->frontend_logo; ?>" alt="" /> 
                                                        <?php }else{ ?>                                                        
                                                           <img src="<?php echo UPLOAD_PATH; ?>/logo/<?php echo $this->global_setting->brand_logo; ?>" alt=""  />
                                                        <?php } ?>                                                        
                                                    </div>
                                                    <div class="admit-card-school">
                                                        <h3><?php echo isset($admit_setting->school_name) ? $admit_setting->school_name : $school->school_name; ?></h2>
                                                        <p><?php echo isset($admit_setting->school_address) && $admit_setting->school_address != '' ? $admit_setting->school_address : $school->address;; ?></p>
                                                        <p><?php echo $this->lang->line('phone'); ?>: <?php echo isset($admit_setting->phone) && $admit_setting->phone != '' ? $admit_setting->phone : $school->phone;; ?></p>
                                                        <h4><?php if(isset($exam) && !empty($exam)){ echo $exam->title; } ?><h4>
                                                    </div>
                                                    <div class="admit-card-logo">
                                                        <?php  if($obj->photo != ''){ ?>
                                                        <img src="<?php echo UPLOAD_PATH; ?>/student-photo/<?php echo $obj->photo; ?>" alt="" /> 
                                                        <?php }else{ ?>
                                                        <img src="<?php echo IMG_URL; ?>/default-user.png" alt=""  /> 
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="admit-card">
                                                    <h3><span style="display: inline-block;"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('admit'); ?> <?php echo $this->lang->line('card'); ?></span></h3>
                                                </div>
                                                <div class="admit-card-details">  
                                                    <table style="width  :100%">
                                                    <tr>
                                                        <td class="caption-student" style="width :25%">Candidate Name</td>
                                                        <td style="width :25%"> <?php echo $obj->name; ?></td>
                                                        <td style="width :25%"  class="caption-student">Father Name</td>
                                                        <td style="width :25%"> <?php echo $obj->father_name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="caption-student">Roll No#</td>
                                                        <td> <?php echo $obj->roll_no; ?></td>
                                                        <td class="caption-student">Class</td>
                                                        <td><?php echo $obj->class_name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="caption-student">Roll No# In words</td>
                                                        <td> <?php echo $sNUmberInWords; ?></td>
                                                        <td class="caption-student">Date Of Birth</td>
                                                        <td><?php echo date($this->global_setting->date_format, strtotime($obj->dob)); ?></td>
                                                    </tr>
                                                    </table>
                                                </div>
                                                <div class="admit-card-details">    
                                                    <table style="width  :100%">
                                                    <tr>    
                                                        <th  colspan="6" class="caption" style="text-align:center">Exam Schedule</th>
                                                    </tr>  
                                                    <tr>    
                                                        <th style="width:5%" class="caption">Sr #</th>
                                                        <th  style="width:25%" class="caption">Exam Date & Time</th>
                                                        <th  style="width:15%"  class="caption">Subject</th>
                                                   
                                                        <th style="width:5%" class="caption">Sr #</th>
                                                        <th  style="width:25%" class="caption">Exam Date & Time</th>
                                                        <th  style="width:15%"  class="caption">Subject</th>
                                                    </tr>   
                                                    <?php if(isset($subjects) && !empty($subjects)){ ?>                                                             
                                                          
                                                        <?php 
                                                            $iCounter = 0;
                                                            foreach($subjects as $sub){
                                                                $iCounter++;
                                                                ?>  
                                                                <?php  if ($iCounter%2 != 0) { ?>
                                                            <tr>
                                                            <?php } ?> 
                                                            <td><?php echo $iCounter; ?></td>                                                             
                                                            <td><?php echo date($this->global_setting->date_format, strtotime($sub->exam_date))." - ".$sub->start_time." ". $sub->end_time; ?></td>   
                                                            <td><?php echo $sub->subject." ".($sub->optional ? "(Optional)" : ""); ?></td>

                                                            <?php  if ($iCounter%2 == 0) { ?>
                                                            </tr>
                                                            <?php } ?> 

                                                            <?php } ?> 
                                                            <?php  if ($iCounter%2 != 0) {  ?>
                                                                    <td></td>                                                             
                                                                    <td></td>   
                                                                    <td></td>
                                                                </tr>
                                                            <?php  } ?>
                                                    <?php } ?> 
                                                 


                                                    </table>                              
                                                   
                                                </div>
                                                <div class="admit-card-bottom">
                                                    <table style="width  :100%">
                                                    <tr>    
                                                        <td style="width:10%" class="caption-student">Note</td>
                                                        <td ></td>
                                                    </tr>   
                                                    </table>
                                                </div>
                                                <div class="admit-card-bottom">
                                                    <table style="width  :100%; margin-top : 10px;margin-bottom : 3px">
                                                    <tr>    
                                                        <td style="width:33%" class="caption-student"></td>
                                                        <td style="width:33%" class="caption-student"></td>
                                                        <td style="width:33%" class="caption-student">Principal</td>
                                                    </tr>   
                                                    </table>
                                                </div>
                                            </div>

                                       <?php } ?>
                                   <?php } ?>
                                    
                               </div>
                                
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="row no-print"></div>
            <div class="ln_solid no-print"></div>
            <div class="row no-print">
                <div class="col-xs-12 text-right">
                    <button class="btn btn-default " onclick="window.print();"><i class="fa fa-print"></i> <?php echo $this->lang->line('print'); ?></button>
                </div>
            </div>
            
        </div>
    </div>
</div>

<link href="./style.css" rel="stylesheet">
<?php $this->load->view('layout/card'); ?>   
<!-- Super admin js START  -->
<script type="text/javascript">

    $("document").ready(function () {
        <?php if (isset($school_id) && !empty($school_id)) { ?>
            $("#school_id").trigger('change');
        <?php } ?>
    });

    $('#school_id').on('change', function () {

        var school_id = $(this).val();  
        var exam_id = '';
        var class_id = '';
        
        <?php if(isset($school_id) && !empty($school_id)){ ?>
            exam_id =  '<?php echo $exam_id; ?>';     
            class_id =  '<?php echo $class_id; ?>';
         <?php } ?> 

        if (!school_id) {
            toastr.error('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('school'); ?>');
           return false;
        }
        
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_exam_by_school'); ?>",
            data   : { school_id:school_id, exam_id:exam_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               { 
                    $('#exam_id').html(response);  
                   get_class_by_school(school_id,class_id); 
               }
            }
        });
                
    });
    
    function get_class_by_school(school_id, class_id){       
         
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_class_by_school'); ?>",
            data   : { school_id:school_id, class_id:class_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                    $('#class_id').html(response); 
               }
            }
        }); 
   }  
    
    
    <?php if(isset($class_id) && isset($section_id)){ ?>
        get_section_by_class('<?php echo $class_id; ?>', '<?php echo $section_id; ?>');
    <?php } ?>
        
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
                  $('#section_id').html(response);
               }
            }
        }); 
    }
  

    <?php if(isset($class_id) && isset($section_id)){ ?>
        get_student_by_section('<?php echo $section_id; ?>', '<?php echo $student_id; ?>');
    <?php } ?>
    
    function get_student_by_section(section_id, student_id){       
        
        var school_id = $('#school_id').val();  
        if(!school_id){
           toastr.error('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('school'); ?>');
           return false;
        } 
           
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_student_by_section'); ?>",
            data   : {school_id:school_id, section_id: section_id, student_id: student_id, is_all:true},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#student_id').html(response);
               }
            }
        });         
    }
 
</script>
<!-- Super admin js end -->


<script type="text/javascript">
    $("#generate").validate();
</script> 
