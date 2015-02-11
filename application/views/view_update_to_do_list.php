<?php
echo '<ul class="todo-list" id="new_to_do_list">';
foreach ($to_do_list as $row) {
    switch ($row->label) {
        case 'info':
            $label_text = 'Appoitment';
            break;

        case 'danger':
            $label_text = 'Deadline';
            break;

        case 'warning':
            $label_text = 'Meeting';
            break;

        case 'success':
            $label_text = 'Learning';
            break;

        case 'primary':
            $label_text = 'Personal';
            break;

        case 'default':
            $label_text = 'Others';
            break;
        
        default:
            $label_text = 'Others';
            break;
    }
    if ($row->status==1) {
        $class_done = ' class="done"';
    }else{
        $class_done = "";
    }
    echo '
    <li name="' . $row->to_do_list_id . '" ' . $class_done . ' >
        <!-- drag handle -->
        <span class="handle">
            <i class="fa fa-ellipsis-v"></i>
            <i class="fa fa-ellipsis-v"></i>
        </span>
        <!-- checkbox -->
        <input type="checkbox" value="" name=""/>
        <!-- todo text -->
        <span class="text">' . $row->content . '</span>
        <!-- Emphasis label -->
        <small class="label label-' . $row->label .  '"><i class="fa fa-clock-o"></i> ' . $label_text . '</small>
        <!-- General tools such as edit or delete-->
        <div class="tools">
            <i class="fa fa-edit"></i>
            <i class="fa fa-trash-o" onclick="delete_to_do(' . $row->to_do_list_id . ' )"></i>
        </div>
    </li>
    ';                                       
}
echo '</ul>';
?>

<!-- AdminLTE App -->
<script src='<?=base_url().'assets/js/adminLTEapp.js'?>'></script>