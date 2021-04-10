<?php
use app\core\Application;
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h3>My tickets</h3>
                </div>
                <div class="card-tools">
                    <a href="/ticketCreate" class="btn btn-success">Create new</a>
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

        var url = "/postJSON";
        var numberOfPage = 0;
        var numberOfRows = $("#numberOfRows").val();

        loadMoreDataTickets0( $("#tableBody"), $("#loadMoreBtn"), $("#progress"), url, numberOfPage, numberOfRows);
        numberOfPage++;

        $("#numberOfRows").change(function (){
            numberOfRows = $("#numberOfRows").val();
            numberOfPage = 0;
            $("#tableBody").empty();

            loadMoreDataTickets0($("#tableBody"), $("#loadMoreBtn"), $("#progress"), url, numberOfPage, numberOfRows);

            $("#loadMoreBtn").html("Load more");
            $("#loadMoreBtn").prop('disabled', false);
        });

        $("#loadMoreBtn").click(function (){
            loadMoreDataTickets0($("#tableBody"), $("#loadMoreBtn"), $("#progress"), url, numberOfPage, numberOfRows);

            numberOfPage++;
        });
    });
</script>

