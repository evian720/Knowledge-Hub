<!DOCTYPE html>
<html lang="en">

<?php
require('header.php');
?>

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
                        <div class="box box-info">
                            <div class="box-header">
                                <h3 class="box-title"> <?php echo $knowledge_requested->knowledge_title; ?> </h3>
                                <div class="box-tools pull-right">
                                    <div class="label bg-aqua">Label</div>
                                </div>
                            </div>
                            <div class="box-body">
                                <p>
                                    <?php echo $knowledge_requested->knowledge_description; ?>
                                </p>
                            </div><!-- /.box-body -->
                            <hr>
                            <div class="box-body">
                                <?php
                                    foreach ($knowledge_item_requested as $knowledge_item) {
                                        echo '
                                            <div class="row">
                                                <div class="col-lg-8" col-lg-offset-2>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <input type="checkbox">
                                                        </span>

                                                        <div class="col-md-12">
                                                            <!-- Primary tile -->
                                                            <div class="box box-solid bg-light-blue" style="margin-bottom: 0;">
                                                                <div class="box-header">
                                                                    <h3 class="box-title">Primary Tile</h3>
                                                                </div>
                                                                <div class="box-body">
                                                                    Box class: <code>.box.box-solid.bg-light-blue</code>
                                                                    <p>
                                                                        amber, microbrewery abbey hydrometer, brewpub ale lauter tun saccharification oxidized barrel.
                                                                        berliner weisse wort chiller adjunct hydrometer alcohol aau!
                                                                        sour/acidic sour/acidic chocolate malt ipa ipa hydrometer.
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
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <code>.box-footer</code>
                            </div><!-- /.box-footer-->
                        </div><!-- /.box -->
                    </div><!-- /.col -->


                </section><!-- /.content -->

<?php
require('footer.php');
?>
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->




</body>

</html>