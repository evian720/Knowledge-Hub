<!DOCTYPE html>
<html lang="en">

<?php
require('header.php');
?>
<!-- PNotify -->
<link rel="stylesheet" href='<?=base_url().'assets/css/pnotify.custom.css'?>' media="screen">
<script src='<?=base_url().'assets/js/pnotify.js'?>'></script>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Confirmation
                        <small>Please confirm the items you want.</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Confirmation</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="col-md-12">
                        <!-- Info box -->
                        <div class="box box-info" >
                            <div class="box-header">
                                <h3 class="box-title"> <?php echo $knowledge_requested->knowledge_title; ?> </h3>
                                <div class="box-tools pull-right">
                                    <div class="label bg-aqua">Label</div>
                                </div>
                            </div>
                            <div class="box-body" id="knowled_item_selection_area">
                                <p>
                                    <?php echo $knowledge_requested->knowledge_description; ?>
                                </p>
                            </div><!-- /.box-body -->
                            <hr>
                            <div class="box-body">
                                <form action="<?php echo base_url() . 'index.php/main/submit_knowledge_request_confirmation/';  ?>" method="POST">
                                <?php
                                    foreach ($knowledge_item_requested as $knowledge_item) {
                                        echo '
                                            <div class="row">
                                                <div class="col-lg-8" col-lg-offset-2>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <input type="checkbox" name="knowledge_item_selected[]" value=" ' . $knowledge_item->knowledge_item_id . ' " checked>
                                                        </span>

                                                        <div class="col-md-12">
                                                            <!-- Primary tile -->
                                                            <div class="box box-solid bg-light-blue" style="margin-bottom: 0;">
                                                                <div class="box-header">
                                                                    <h3 class="box-title">' . $knowledge_item->knowledge_item_title . '</h3>
                                                                </div>
                                                                <div class="box-body">
                                                                    <p>
                                                                        ' . $knowledge_item->knowledge_item_content . '
                                                                    </p>
                                                                </div><!-- /.box-body -->
                                                            </div><!-- /.box -->
                                                        </div><!-- /.col -->

                                                    </div><!-- /input-group -->
                                                </div><!-- /.col-lg-6 -->
                                            </div><!-- /.row -->
                                            <br>
                                        ';
                                    }

                                ?>
                                <input type="hidden" name="knowledge_request_id" value=" <?php echo $knowledge_requested->knowledge_request_id; ?> ">
                                <input type="submit" class="btn btn-primary" value="Submit">
                                </form>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <code> </code>
                            </div><!-- /.box-footer-->
                        </div><!-- /.box -->
                    </div><!-- /.col -->


                </section><!-- /.content -->

<?php
require('footer.php');
?>
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


<script type="text/javascript">
    $(document).ready(function(){
       show_stack_context('info');

    });

    function show_stack_context(type) {
        if (typeof stack_context === "undefined") stack_context = {
            "dir1": "down",
            "dir2": "left",
            "context": $("#knowled_item_selection_area")
        };
        var opts = {
            title: "Over Here",
            text: "Check me out. I'm in a different stack.",
            stack: stack_context,
            delay: 8000
        };
        switch (type) {
        case 'error':
            opts.title = "Oh No";
            opts.text = "Watch out for that water tower!";
            opts.type = "error";
            break;
        case 'info':
            opts.title = "Attention!";
            opts.text = "You may select the knowledge items you want!";
            opts.type = "info";
            break;
        case 'success':
            opts.title = "Good News Everyone";
            opts.text = "I've invented a device that bites shiny metal asses.";
            opts.type = "success";
            break;
        }
        new PNotify(opts);
    }


</script>


</body>

</html>