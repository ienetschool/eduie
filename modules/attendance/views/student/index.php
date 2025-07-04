<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-check-square-o"></i><small> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('attendance'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content quick-link">
                <span><?php echo $this->lang->line('quick_link'); ?>:</span>
                <?php if (has_permission(VIEW, 'attendance', 'student')) { ?>
                    <a href="<?php echo site_url('attendance/student'); ?>"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('attendance'); ?></a>
                <?php } ?>
                <?php if (has_permission(VIEW, 'attendance', 'teacher')) { ?>
                    | <a href="<?php echo site_url('attendance/teacher'); ?>"><?php echo $this->lang->line('teacher'); ?> <?php echo $this->lang->line('attendance'); ?></a>
                <?php } ?>
                <?php if (has_permission(VIEW, 'attendance', 'employee')) { ?>
                    | <a href="<?php echo site_url('attendance/employee'); ?>"><?php echo $this->lang->line('employee'); ?> <?php echo $this->lang->line('attendance'); ?></a>
                <?php } ?>
                <?php if (has_permission(VIEW, 'attendance', 'absentemail')) { ?>
                    | <a href="<?php echo site_url('attendance/absentemail/index'); ?>"><?php echo $this->lang->line('absent'); ?> <?php echo $this->lang->line('email'); ?></a>
                <?php } ?>
                <?php if (has_permission(VIEW, 'attendance', 'absentsms')) { ?>
                    | <a href="<?php echo site_url('attendance/absentsms/index'); ?>"><?php echo $this->lang->line('absent'); ?> <?php echo $this->lang->line('sms'); ?></a>
                <?php } ?>
            </div>

            <div class="x_content">
                <?php echo form_open_multipart(site_url('attendance/student/index'), array('name' => 'student', 'id' => 'student', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row">

                    <?php $this->load->view('layout/school_list_filter'); ?>

                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group">
                            <div><?php echo $this->lang->line('class'); ?> <span class="required">*</span></div>
                            <select class="form-control col-md-7 col-xs-12" name="class_id" id="class_id" required="required" onchange="get_section_by_class(this.value, '');">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                <?php if (isset($classes) && !empty($classes)) { ?>
                                    <?php foreach ($classes as $obj) { 
                                        $class_access = $this->session->userdata('role_id') == TEACHER && isset($teacher_classes) && !empty($teacher_classes) && in_array($obj->id,$teacher_classes) ? true : false;
                                        ?>
                                        <?php if ($this->session->userdata('role_id') == TEACHER && $this->session->userdata('profile_id') != $obj->teacher_id && !$class_access) {
                                            continue;
                                        }  ?>
                                        <option value="<?php echo $obj->id; ?>" <?php if (isset($class_id) && $class_id == $obj->id) {
                                                                                    echo 'selected="selected"';
                                                                                } ?>> <?php echo $obj->name; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                            <div class="help-block"><?php echo form_error('class_id'); ?></div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group">
                            <div><?php echo $this->lang->line('section'); ?> <span class="required">*</span></div>
                            <select class="form-control col-md-7 col-xs-12" name="section_id" id="section_id" required="required">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                            </select>
                            <div class="help-block"><?php echo form_error('section_id'); ?></div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="item form-group">
                            <div><?php echo $this->lang->line('date'); ?> <span class="required">*</span></div>
                            <input class="form-control col-md-7 col-xs-12" name="date" id="date" value="<?php if (isset($date)) {
                                                                                                            echo $date;
                                                                                                        } ?>" placeholder="<?php echo $this->lang->line('date'); ?>" required="required" type="text" autocomplete="off">
                            <div class="help-block"><?php echo form_error('date'); ?></div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group"><br />
                            <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('find'); ?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>

            <?php if (isset($date) && $date) { ?>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-4  col-sm-offset-4 layout-box">
                            <p>
                            <h4><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('attendance'); ?></h4>
                            <?php echo $this->lang->line('day'); ?> : <?php echo date('l', strtotime($date)); ?><br />
                            <?php echo $this->lang->line('date'); ?> : <?php echo date('jS F Y', strtotime($date)); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="x_content">
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('sl_no'); ?></th>
                            <th><?php echo $this->lang->line('admission_no'); ?></th>
                            <th><?php echo $this->lang->line('photo'); ?></th>
                            <th><?php echo $this->lang->line('name'); ?></th>
                            <th><?php echo $this->lang->line('email'); ?></th>
                            <th><?php echo $this->lang->line('phone'); ?></th>
                            <th><?php echo $this->lang->line('roll_no'); ?></th>
                            <th><input type="checkbox" value="P" name="present" id="fn_present" class="fn_all_attendnce" /> <?php echo $this->lang->line('present_all'); ?></th>
                            <th> <?php echo $this->lang->line('leave'); ?></th>
                            <th><input type="checkbox" value="A" name="absent" id="fn_absent" class="fn_all_attendnce" /> <?php echo $this->lang->line('absent_all'); ?></th>
                        </tr>
                    </thead>
                    <tbody id="fn_attendance">
                        
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>


<!-- bootstrap-datetimepicker -->
<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
<script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>

<!-- Super admin js START  -->
<script type="text/javascript">
    $("document").ready(function() {
        <?php if (isset($school_id) && !empty($school_id) && $this->session->userdata('role_id') != TEACHER) { ?>
            $(".fn_school_id").trigger('change');
        <?php } ?>
    });

    $('.fn_school_id').on('change', function() {

        var school_id = $(this).val();
        var class_id = '';

        <?php if (isset($school_id) && !empty($school_id)) { ?>
            class_id = '<?php echo $class_id; ?>';
        <?php } ?>

        if (!school_id) {
            toastr.error('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('school'); ?>');
            return false;
        }

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
                    $('#class_id').html(response);
                }
            }
        });
    });
</script>
<!-- Super admin js end -->


<script type="text/javascript">
    var holidays = [<?php echo '"'.implode('","',  $holidays ).'"' ?>];
    datesForDisable = ["14-4-2021", "25-12-2021", "26-12-2021", "27-12-2021", "28-12-2021", "29-12-2021", "30-12-2021", "31-12-2021"];
    datesForDisable = datesForDisable.concat(holidays);
    $(document).ready(function() {
            var sch_id='<?php print $school_id; ?>';
			var cls_id = '<?php print $class_id; ?>';
            var section_id = '<?php print $section_id; ?>';
            var date = '<?php print $date; ?>';
          $('#datatable-responsive').DataTable( {
              dom: 'Bfrtip',
              'processing': true,
              "paging": false,
              "searching": false,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
          'url':'<?php echo site_url("attendance/student/get_list"); ?>',
		  'data': {'school_id': sch_id,class_id:cls_id,section_id:section_id,date:date}
      },
              buttons: [
            
                  
              ],
              responsive: true
          });
		  /*$('#add').validate({
				rules: { syllabus: { filesize: 1048576  }},
				messages: { syllabus: "File must be 1MB" }
			});*/
        });
        
    var today = new Date();
    $('#date').datepicker({
        format: 'dd-mm-yyyy',
        daysOfWeekDisabled: [0],
        datesDisabled: datesForDisable,
        endDate: today
    });

    <?php if (isset($class_id) && isset($section_id)) { ?>
        get_section_by_class('<?php echo $class_id; ?>', '<?php echo $section_id; ?>');
    <?php } ?>

    function get_section_by_class(class_id, section_id) {


        var school_id = $('#school_id').val();

        if (!school_id) {
            toastr.error('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('school'); ?>');
            return false;
        }

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('ajax/get_section_by_class'); ?>",
            data: {
                school_id: school_id,
                class_id: class_id,
                section_id: section_id
            },
            async: false,
            success: function(response) {
                if (response) {
                    $('#section_id').html(response);
                }
            }
        });
    }
    $(document).on('click','.fn_single_attendnce',function(e) {
    var _object_ =e.target;
    var status = $(_object_).prop('checked') ? $(_object_).val() : '';
    var student_id = $(_object_).prop('checked') ? $(_object_).attr('itemid') : '';
    var school_id = $('#school_id').val();
    var class_id = $('#class_id').val();
    var section_id = $('#section_id').val();
    var date = $('#date').val();
    var obj = $(_object_);
    var success = false;

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('attendance/student/update_single_attendance'); ?>",
        data: {
            school_id: school_id,
            status: status,
            student_id: student_id,
            class_id: class_id,
            section_id: section_id,
            date: date
        },
        async: false,
        success: function(response) {
            if (response == 'ay') {

                toastr.error('<?php echo $this->lang->line('set_academic_year_for_school'); ?>');
                $(obj).prop('checked', false);

            } else if (response == 1) {
                toastr.success('<?php echo $this->lang->line('update_success'); ?>');
                success=true;
            } else {
                toastr.error('<?php echo $this->lang->line('update_failed'); ?>');
               // $(obj).prop('checked', false);
            }
        }
    });
    return success;
});

    $(document).ready(function() {

        $('#fn_present').click(function() {

            if ($(this).prop('checked')) {
                $('input:checkbox').removeAttr('checked');
                $(this).prop('checked', true);
                $('.present').prop('checked', true);
            } else {
                $('.present').prop('checked', false);
            }
        });


        $('#fn_late').click(function() {

            if ($(this).prop('checked')) {
                $('input:checkbox').removeAttr('checked');
                $(this).prop('checked', true);
                $('.late').prop('checked', true);
            } else {
                $('.late').prop('checked', false);
            }
        });

        $('#fn_absent').click(function() {

            if ($(this).prop('checked')) {
                $('input:checkbox').removeAttr('checked');
                $(this).prop('checked', true);
                $('.absent').prop('checked', true);
            } else {
                $('.absent').prop('checked', false);
            }
        });


        

        $('.fn_all_attendnce').click(function() {

            var status = $(this).prop('checked') ? $(this).val() : '';
            var school_id = $('#school_id').val();
            var class_id = $('#class_id').val();
            var section_id = $('#section_id').val();
            var date = $('#date').val();
            var obj = $(this);

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('attendance/student/update_all_attendance'); ?>",
                data: {
                    school_id: school_id,
                    status: status,
                    class_id: class_id,
                    section_id: section_id,
                    date: date
                },
                async: false,
                success: function(response) {
                    if (response == 'ay') {

                        toastr.error('<?php echo $this->lang->line('set_academic_year_for_school'); ?>');
                        $('.fn_single_attendnce').prop('checked', false);
                        $(obj).prop('checked', false);

                    } else if (response == 1) {
                        toastr.success('<?php echo $this->lang->line('update_success'); ?>');
                    } else {
                        toastr.error('<?php echo $this->lang->line('update_failed'); ?>');
                        $('.fn_single_attendnce').prop('checked', false);
                        $(obj).prop('checked', false);
                    }
                }
            });

        });
    });
    $("#student").validate();
</script>