<!DOCTYPE html>
<html lang="en">

<?php
require('view_admin_header.php');
?>
<script src='<?=base_url().'assets/js/d3.v3.min.js'?>'></script>

<!-- PNotify -->
<link rel="stylesheet" href='<?=base_url().'assets/css/pnotify.custom.css'?>' media="screen">
<script src='<?=base_url().'assets/js/pnotify.js'?>'></script>

<!-- style of the tree -->
<style>
  .node {
    cursor: pointer;
  }

  .node circle {
    fill: #fff;
    stroke: steelblue;
    stroke-width: 2px;
  }

  .node text {
    font: 10px sans-serif;
  }

  .link {
    fill: none;
    stroke: #ccc;
    stroke-width: 1.5px;
  }

  .progress-bar.animate {
    width: 100%;
  }

  path.link {
    fill: none;
    stroke: #9ecae1;
    stroke-width: 1.5px;
  }

  .node rect {
    cursor: pointer;
    fill: #fff;
    fill-opacity: .5;
    stroke: #3182bd;
    stroke-width: 1.5px;
  }

</style>


<script src='<?=base_url().'assets/js/bootstrap-toggle.min.js'?>'></script>
<link rel="stylesheet" href='<?=base_url().'assets/css/bootstrap-toggle.min.css'?>' media="screen">

            <!-- loading.... -->
            <div class="modal js-loading-bar">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">Tree Constructing...</div>
                        <div class="modal-body">
                            <div class="progress bg progress-striped active">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                        // Setup
                        this.$('.js-loading-bar').modal({
                          backdrop: 'static',
                          show: false
                        });

                        $(document).ready(function() {
                          var $modal = $('.js-loading-bar'),
                              $bar = $modal.find('.progress-bar');
                          
                          $modal.modal('show');
                          $bar.addClass('animate');

                          setTimeout(function() {
                            $bar.removeClass('animate');
                            $modal.modal('hide');
                          }, 3500);

                        });
                          setTimeout(function(){ 
                                      alertify.set({ delay: 2500 });
                                      alertify.success("Tree Construction Done!");
                          }, 3800);

            </script>


            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        View Knowledge Tree
                        <small>Tree help you to see clearly</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">View Knowledge Tree</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                  <?php
                  $location = base_url() . "json/" . $this->session->userdata('email') . ".json";
                  ?>
                  <input type="hidden" id="jsonfilelocation" value="<?php echo $location; ?>" />


                  <div class="box box-info">
                    <div class="box-header">

                      <div class="box-tools pull-left">
                        <input type="checkbox" id="view_choice" data-offstyle="success" data-onstyle="primary" checked>
                      </div>

                      <div class="box-tools pull-right">
                        <div class="label bg-aqua">Updated</div>
                      </div>
                    </div>
                    <div class="box-body">
                      <!-- Custom Tabs -->
                      <div class="nav-tabs-custom">
                        <div class="tab-content">

                          <div class="tab-pane active" id="tab_1">
                            <div class="row">
                              <div class="col-md-12" id="mytree"></div>
                              <div class="col-md-12" id="my_tree_knowledge_area"></div>
                            </div>
                          </div>

                          <div class="tab-pane" id="tab_2">
                            <div class="row">
                              <div class="col-md-6" id="mydirectory"></div>
                              <div class="col-md-6" id="place_for_knowledge"></div>
                            </div>
                          </div><!-- /.tab-pane -->

                        </div><!-- /.tab-content -->
                      </div><!-- nav-tabs-custom -->
                    </div><!-- /.box-body -->

                    <div class="box-footer" style="text-align: center;">
                      <code>End of the Tree</code>
                    </div><!-- /.box-footer-->
                  </div><!-- /.box -->



<?php
require('footer.php');
?>


                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->




<script>  

  $(function() {
    $('#view_choice').bootstrapToggle({
      on: 'Tree',
      off: 'Directory',
      size: 'small'
    })
  })

  $(function() {
    $('#view_choice').change(function() {
      if($(this).prop('checked') == true){
        $("#tab_1").attr("class", "tab-pane active");
        $("#tab_2").attr("class", "tab-pane");
        $("#tab_selection1").attr("class", "active");
        $("#tab_selection2").attr("class", "");
      }else{
        $("#tab_1").attr("class", "tab-pane");
        $("#tab_2").attr("class", "tab-pane active");
        $("#tab_selection1").attr("class", "");
        $("#tab_selection2").attr("class", "active");
      }
    })
  })

  function build_tree(){
    var margin = {top: 20, right: 120, bottom: 20, left: 120};
      // width = 960 - margin.right - margin.left,   //960
      height = 600 - margin.top - margin.bottom;  //800
      
      var width = $('#mytree').width() - margin.right - margin.left - 40;
      //var width = document.getElementById('mytree').offsetWidth - margin.right - margin.left - 40;
      //var height = document.getElementById('mytree').offsetHeight;
      
      var i = 0,
      duration = 750,
      root;

      var tree = d3.layout.tree()
      .size([width, height]);

      var diagonal = d3.svg.diagonal()
      .projection(function(d) { return [d.x, d.y]; });    //control the horizontal or vertical of diagonal



      var svg = d3.select("#mytree").append("svg")
      .attr("width", width + margin.right + margin.left)
      .attr("height", height + margin.top + margin.bottom)
      .append("g")
      .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

      d3.json(document.getElementById("jsonfilelocation").value, function(flare) {
        root = flare;
        root.x0 = width / 2;
        root.y0 = 0;

        function collapse(d) {
          if (d.children) {
            d._children = d.children;
            d._children.forEach(collapse);
            d.children = null;
          }
        }

        root.children.forEach(collapse);
        update(root);
      });

  d3.select(self.frameElement).style("height", "800px");  //800px

  function update(source) {

    // Compute the new tree layout.
    var nodes = tree.nodes(root).reverse(),
    links = tree.links(nodes);

    // Normalize for fixed-depth.
    nodes.forEach(function(d) { d.y = d.depth * 100; });    //180

    // Update the nodes…
    var node = svg.selectAll("g.node")
    .data(nodes, function(d) { return d.id || (d.id = ++i); });

    // Enter any new nodes at the parent's previous position.
    var nodeEnter = node.enter().append("g")
    .attr("class", "node")
    .attr("transform", function(d) { return "translate(" + source.y0 + "," + source.x0 + ")"; })
    .on("click", click);

    nodeEnter.append("circle")
    .attr("r", 1e-6)
    .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });

    nodeEnter.append("text")
    .attr("x", function(d) { return d.children || d._children ? -20 : 20; })
    .attr("dy", ".35em")
    .attr("text-anchor", function(d) { return d.children || d._children ? "end" : "start"; })
    .style("fill-opacity", 1e-60)
    .each(function(d){
      if (d.cat_name != undefined) {
        var lines = wordwrap(d.cat_name)
        for (var i = 0; i < lines.length; i++) {
          d3.select(this).append("tspan")
          .attr("dy",13)
          .attr("x",function(d) { 
            return d.children1 || d._children1 ? -10 : -10; })
          .text(lines[i])
        }
      }
    });

    // Transition nodes to their new position.
    var nodeUpdate = node.transition()
    .duration(duration)
        .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; }); //control the nodes horizontal or vertical

        nodeUpdate.select("circle")
        .attr("r", 4.5)
        .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });

        nodeUpdate.select("text")
        .style("fill-opacity", 1);

    // Transition exiting nodes to the parent's new position.
    var nodeExit = node.exit().transition()
    .duration(duration)
    .attr("transform", function(d) { return "translate(" + source.y + "," + source.x + ")"; })
    .remove();

    nodeExit.select("circle")
    .attr("r", 1e-6);

    nodeExit.select("text")
    .style("fill-opacity", 1e-6);

    // Update the links…
    var link = svg.selectAll("path.link")
    .data(links, function(d) { return d.target.id; });

    // Enter any new links at the parent's previous position.
    link.enter().insert("path", "g")
    .attr("class", "link")
    .attr("d", function(d) {
      var o = {x: source.x0, y: source.y0};
      return diagonal({source: o, target: o});
    });

    // Transition links to their new position.
    link.transition()
    .duration(duration)
    .attr("d", diagonal);

    // Transition exiting nodes to the parent's new position.
    link.exit().transition()
    .duration(duration)
    .attr("d", function(d) {
      var o = {x: source.x, y: source.y};
      return diagonal({source: o, target: o});
    })
    .remove();

    // Stash the old positions for transition.
    nodes.forEach(function(d) {
      d.x0 = d.x;
      d.y0 = d.y;
    });

      // Toggle children on click.
      function click(d) {
        if (d.children) {
          d._children = d.children;
          d.children = null;
        } else {
          d.children = d._children;
          d._children = null;
        }
        update(d);

        //update the knowledge shown besides
        if(!d.children && !d._children){
          $.ajax({
            url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/get_knowledge_for_tree_by_cat/" + d.cat_name, //this is the submit URL
            type: 'POST', //or POST
            success: function(data){
              $('#my_tree_knowledge_area').html(data);
              click_to_add();
            }
          });

          //menu when click the tree node

        }

      }
    }
  }



  function wordwrap(text) {
    var lines=text.split(" ")
    return lines
  }





  function build_directory(){
    var margin = {top: 30, right: 20, bottom: 30, left: 20},
    width = 960 - margin.left - margin.right,
    barHeight = 20,
    barWidth = width * .2;

    var i = 0,
    duration = 400,
    root;

    var tree = d3.layout.tree()
    .nodeSize([0, 20]);

    var diagonal = d3.svg.diagonal()
    .projection(function(d) { return [d.y, d.x]; });

    var svg = d3.select("#mydirectory").append("svg")
      .attr("width", (width + margin.right + margin.left))
      .attr("height", height + margin.top + margin.bottom)
    .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");


    d3.json(document.getElementById("jsonfilelocation").value, function(error, flare) {
      flare.x0 = 0;
      flare.y0 = 0;
      update(root = flare);
    });

    function update(source) {

      // Compute the flattened node list. TODO use d3.layout.hierarchy.
      var nodes = tree.nodes(root);

      var height = Math.max(500, nodes.length * barHeight + margin.top + margin.bottom);

      d3.select("svg").transition()
      .duration(duration)
      .attr("height", height);

      d3.select(self.frameElement).transition()
      .duration(duration)
      .style("height", height + "px");

      // Compute the "layout".
      nodes.forEach(function(n, i) {
        n.x = i * barHeight;
      });

      // Update the nodes…
      var node = svg.selectAll("g.node")
      .data(nodes, function(d) { return d.id || (d.id = ++i); });

      var nodeEnter = node.enter().append("g")
      .attr("class", "node")
      .attr("transform", function(d) { return "translate(" + source.y0 + "," + source.x0 + ")"; })
      .style("opacity", 1e-6);

      // Enter any new nodes at the parent's previous position.
      nodeEnter.append("rect")
      .attr("y", -barHeight / 2)
      .attr("height", barHeight)
      .attr("width", barWidth)
      .style("fill", color)
      .on("click", click);

      nodeEnter.append("text")
      .attr("dy", 3.5)
      .attr("dx", 5.5)
      .text(function(d) { return d.cat_name; });

      // Transition nodes to their new position.
      nodeEnter.transition()
      .duration(duration)
      .attr("transform", function(d) { return "translate(" + d.y + "," + d.x + ")"; })
      .style("opacity", 1);

      node.transition()
      .duration(duration)
      .attr("transform", function(d) { return "translate(" + d.y + "," + d.x + ")"; })
      .style("opacity", 1)
      .select("rect")
      .style("fill", color);

      // Transition exiting nodes to the parent's new position.
      node.exit().transition()
      .duration(duration)
      .attr("transform", function(d) { return "translate(" + source.y + "," + source.x + ")"; })
      .style("opacity", 1e-6)
      .remove();

      // Update the links…
      var link = svg.selectAll("path.link")
      .data(tree.links(nodes), function(d) { return d.target.id; });

      // Enter any new links at the parent's previous position.
      link.enter().insert("path", "g")
      .attr("class", "link")
      .attr("d", function(d) {
        var o = {x: source.x0, y: source.y0};
        return diagonal({source: o, target: o});
      })
      .transition()
      .duration(duration)
      .attr("d", diagonal);

      // Transition links to their new position.
      link.transition()
      .duration(duration)
      .attr("d", diagonal);

      // Transition exiting nodes to the parent's new position.
      link.exit().transition()
      .duration(duration)
      .attr("d", function(d) {
        var o = {x: source.x, y: source.y};
        return diagonal({source: o, target: o});
      })
      .remove();

      // Stash the old positions for transition.
      nodes.forEach(function(d) {
        d.x0 = d.x;
        d.y0 = d.y;
      });
    }

    function click(d) {
      if (d.children) {
        d._children = d.children;
        d.children = null;
      } else {
        d.children = d._children;
        d._children = null;
      }
      update(d);

      //update the knowledge shown besides
      if(!d.children && !d._children){

        $.ajax({
          url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/get_knowledge_for_directory_by_cat/" + d.cat_name, //this is the submit URL
          type: 'POST', //or POST
          success: function(data){
            $('#place_for_knowledge').html(data);

          }
        });

        //menu when click the tree node

      }
    }

    function color(d) {
      return d._children ? "#3182bd" : d.children ? "#c6dbef" : "#fd8d3c";
    }

  }




  build_tree();
  build_directory();


  function click_to_add(){



new PNotify({
    title: 'What do you want?',
    text: 'Select an action.',
    icon: 'glyphicon glyphicon-question-sign',
    
    confirm: {
        confirm: true,
        buttons: [{
            text: 'New Knowledge',
            click: function(notice) {
              $('#create_new_knowledge_button').click();
            }
        }]
    },
    buttons: {
        closer: false,
        sticker: false
    },
    history: {
        history: false
    },
    sticker: false,
    delay: 8000
});


  }

  </script>



</body>

</html>