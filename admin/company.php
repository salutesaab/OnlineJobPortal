<?php
/*
 * File Name: company.php
 * By: Dipali
 * Date: 02/16/2018
 *
 */
 $isSession=0;

require_once('include/session.php');
//require_once("include/config.php");
require_once("include/function.php");

$browserTitle = "Manage Company";
$error="";
$successMsg="";
$sideBarActive=5;
?>
<!DOCTYPE html>
<html>
<head>
<?php include("partials/header.inc.php"); ?>
</head>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <?php include("partials/nav.inc.php");?>
            <?php include("partials/sidebar.inc.php");?>
               </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Manage Company</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <?php if (isset($_SESSION['success_message'])): ?>
                            <div class="alert alert-success fade in">
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                <?php echo $_SESSION['success_message']; unset($_SESSION['success_message']);?>
                            </div>
                           <?php endif ?>
                        <div id="messages"></div>
                        <div class="panel-heading">
                            Manage Company
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <div class="text-right" style="margin-bottom:10px;">
                            <a class="btn btn-primary " href="add-edit-company.php">Add Company</a>
                        </div>
                             <form role="form"  id="frm_company"  name="frm_company" method="POST" enctype="multipart/form-data">
                                   
                       <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Business Stream</th>
                                        <th class="text-center">Gallery</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Edit</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td>Business Stream</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                        //display data
                                        $sql = "SELECT `id`, `company_name`, `business_stream_id`, `company_website_url`,`is_active` FROM company WHERE is_removed='0' ";
                                        $result = mysqli_query($db,$sql);
                                        $count = mysqli_num_rows($result);
                                        $rowNo=1;
                                        if($count > 0) {
                                              while($content = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                                                $companyId = $content["id"];
                                                $companyName = $content["company_name"];
                                                $companyUrl= $content["company_website_url"];
                                                $businessStream=get_business($content["business_stream_id"]);
                                                $isActive = $content["is_active"];
                                                $class = ($rowNo%2==0)?"even":"odd";
                                                
                                                ?>
                                    <tr class="<?php echo $class?> gradeX" id="record_<?php echo $companyId?>">
                                        <td><a href="<?php echo $companyUrl?>" target="_blank"><?php echo $companyName;?></a></td>
                                        <td><?php echo $businessStream?></td>
                                        <td class="text-center"><a href="company-gallery.php?company_id=<?php echo $companyId?>" ><i class="fa fa-image fa-2x"></i></a></td>
                                        
                                        <td class="text-center">
                                            <button type="button" name="status" id="status_<?php echo $companyId?>" class=" status no-border" data-id="<?php echo $companyId ?>">
                                            <?php if($isActive==='1'){
                                                ?>
                                            <i class="fa fa-check-circle fa-2x green"></i>
                                            <?php
                                            }else{
                                                ?>
                                            <i class="fa fa-ban fa-2x red"></i>
                                            <?php
                                            }?>
                                            </button>
                                        </td>
                                        <td class="center text-center"><a href="add-edit-company.php?id=<?php echo $companyId;?>"><i class="fa fa-edit fa-2x"></i></a></td>
                                        <td class="center text-center"><button type="button" name="delete" class=" btn-danger delete no-border" id="<?php echo $companyId ?>"><i class="fa fa-trash fa-2x"></i></button></td>
                                    </tr>
                                    <?php
                                                $rowNo++;
                                              }

                                         }else{
                                             ?>
                                     <tr class="even gradeX">
                                        <td colspan="6">No records  found</td>
                                    </tr>
                                      <?php
                                         }
                                        ?>
                                     
                                </tbody>

                            </table>
                            <!-- /.table-responsive -->
                            <!-- /.table-responsive -->
                             </form>
                        </div>      <!-- /.panel-body -->
                    </div> <!-- /.panel-default -->
                </div><!-- /.col-lg-12 -->
                </div> <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include("partials/footer.inc.php");?>
    <!-- DataTables JavaScript -->
    <script src="public/javascript/datatables/js/jquery.dataTables.min.js"></script>
    <script src="public/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="public/datatables-responsive/dataTables.responsive.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true,
            stateSave: true,
            sPlaceHolder: "head:before",
            "aoColumns": [null,null,{ "bSortable": false },{ "bSortable": false },{ "bSortable": false },{ "bSortable": false }],
            initComplete: function () {
            this.api().columns([1]).every( function () {
                var column = this;
                var select = $('<select><option value="">All Business Streams</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
        });
        $("#dataTables-example_filter").css("text-align","right");
        $("#dataTables-example_paginate").css("text-align","right");
        $('#dataTables-example tfoot tr').insertAfter($('#dataTables-example thead tr'))

        //delete record
     $(document).on('click', '.delete', function(){
             var company_id = $(this).attr("id");
             var action = "delete_company";

         if(confirm("Are you sure you want to remove this record from database?"))
          {
              $.ajax({
                  url: 'include/action.php',
                  type: 'post',
                  data:{company_id:company_id, action:action},
                  success: function(data, status) {
                     $("#record_"+company_id).html("");
                     $('#messages').html("<div class='alert alert-success fade in'><a href='#' class='close' data-dismiss='alert'>&times;</a>Record deleted Successfully</div>");
                      //location.reload();
                  },
                  error: function(xhr, desc, err) {
                     $('#messages').html("<div class='alert alert-error fade in'><a href='#' class='close' data-dismiss='alert'>&times;</a>Error in record deletion.</div>");

                  }
                }); // end ajax call

          }else
          {
           return false;
          }
         });

         //change status
     $(document).on('click', '.status', function(){
             var company_id = $(this).attr("data-id");
             var action = "change_company_status";

         if(confirm("Are you sure you want to change status?"))
          {
              $.ajax({
                  url: 'include/action.php',
                  type: 'post',
                  data:{company_id:company_id, action:action},
                  success: function(data, status) {
                     $("#status_"+company_id).html(data);
                     $('#messages').html("<div class='alert alert-success fade in'><a href='#' class='close' data-dismiss='alert'>&times;</a>Status changed Successfully</div>");
                      //location.reload();
                  },
                  error: function(xhr, desc, err) {
                     $('#messages').html("<div class='alert alert-error fade in'><a href='#' class='close' data-dismiss='alert'>&times;</a>Error in status updation.</div>");

                  }
                }); // end ajax call

          }else
          {
           return false;
          }
         });
    });
    </script>

</body>
</html>