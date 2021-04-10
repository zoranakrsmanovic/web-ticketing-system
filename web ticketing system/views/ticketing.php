<?php
use app\core\Application;
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h3>Tickets</h3>
                </div>
            </div>
            <div class="card-header">
                <div class="card-title">
                    <select name="numberOfRows" id="numberOfRows">
                        <option value="10" selected="selected">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <div class="card-tools">
                        <input type="text" name="search" id="search" placeholder="Search....">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th class="border-top-0 text-center">Ticket title</th>
                                <th class="border-top-0 text-center">Content</th>
                                <th class="border-top-0 text-center">Date Created</th>
                                <th class="border-top-0 text-center">Date Updated</th>
                                <th class="border-top-0 text-center">Status</th>
                                <th class="border-top-0 text-center">Priority</th>
                                <th class="border-top-0 text-center">Solution</th>
                                <th class="border-top-0 text-center">Category</th>
                            </tr>
                            </thead>
                            <tbody id="tableBody"></tbody>
                            <tfoot>
                            <tr>
                                <td colspan="8">
                                    <button type="button" id="loadMoreBtn" class="btn btn-primary col-md-12">
                                        Load more &nbsp;
                                        <span class="spinner-border spinner-border-sm" id="progress" role="status" aria-hidden="true" style="display: none; !important;"></span>
                                    </button>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->

<script src="assets/dist/js/tickets.js"></script>

<script>
    $(document).ready(function (){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        <?php
        $success = Application::$app->session->getFlash('success');
        if ($success !== false)
        {
            echo "Toast.fire({
                            icon: 'success',
                            title: '$success'
                        });";
        }
        ?>

        var url = "/ticketingJSON";
        var numberOfPage = 0;
        var numberOfRows = $("#numberOfRows").val();
        var search = $("#search").val();

        loadMoreDataTickets( $("#tableBody"), $("#loadMoreBtn"), $("#progress"), url, numberOfPage, numberOfRows, search);
        numberOfPage++;

        $("#numberOfRows").change(function (){
            numberOfRows = $("#numberOfRows").val();
            numberOfPage = 0;
            $("#tableBody").empty();

            loadMoreDataTickets($("#tableBody"), $("#loadMoreBtn"), $("#progress"), url, numberOfPage, numberOfRows, search);

            $("#loadMoreBtn").html("Load more");
            $("#loadMoreBtn").prop('disabled', false);
        });

        $("#search").change(function (){
            search = $("#search").val();
            numberOfPage = 0;
            $("#tableBody").empty();

            loadMoreDataTickets($("#tableBody"), $("#loadMoreBtn"), $("#progress"), url, numberOfPage, numberOfRows, search);

            $("#loadMoreBtn").html("Load more");
            $("#loadMoreBtn").prop('disabled', false);
        });

        $("#loadMoreBtn").click(function (){
            loadMoreDataTickets($("#tableBody"), $("#loadMoreBtn"), $("#progress"), url, numberOfPage, numberOfRows, search);

            numberOfPage++;
        });
    });
</script>

