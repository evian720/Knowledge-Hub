<form id="user_access_form">
    <div class="row">
        <div class="col-md-12">
            <strong>Major</strong><br><br>     
            <?php
                foreach ($all_major as $key => $value) {
                    $counter = 0;
                    foreach ($user_access_rights as $row) {
                        if( $value->cat_name == $row->major ){
                            echo '
                                <div class="form-group"><input type="checkbox" name="access_rights[]" value="' . $value->cat_name . '" checked>' . $value->cat_name . '</div>
                            ';
                            $counter = 1;
                        }
                    }

                    if($counter == 0){
                        echo '
                                <div class="form-group"><input type="checkbox" name="access_rights[]" value="' . $value->cat_name . '">' . $value->cat_name . '</div>
                        ';
                    }
                }
            ?>
        </div>
    </div>

    <!-- for storing the user to modify -->
    <input type="hidden" id="modify_user_access_rights_target" name="user_name" value="<?php echo $email;?>" />    
</form>