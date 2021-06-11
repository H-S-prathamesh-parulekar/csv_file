<?php ?>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title>Songs CSV</title>
    <!-- Font Awesome -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tammudu+2:wght@400;800&family=Roboto&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link href=" https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">


    <style>
        .dataTables_wrapper {
            position: relative;
            clear: both;
            /* *zoom: 1; */
            zoom: 1;
            width: 100%;
        }

        body {
            /* background-image: url('<?php echo base_url(); ?>assets/img/6jpg; '); */
            background-image: linear-gradient(to bottom right, red, yellow);
        }


        table.dataTable thead .sorting:after,
        table.dataTable thead .sorting:before,
        table.dataTable thead .sorting_asc:after,
        table.dataTable thead .sorting_asc:before,
        table.dataTable thead .sorting_asc_disabled:after,
        table.dataTable thead .sorting_asc_disabled:before,
        table.dataTable thead .sorting_desc:after,
        table.dataTable thead .sorting_desc:before,
        table.dataTable thead .sorting_desc_disabled:after,
        table.dataTable thead .sorting_desc_disabled:before {
            bottom: .5em;
        }
    </style>

</head>


<body>
    <div class="container">
        <h1 style="font-family: 'Baloo Tammudu 2', cursive;font-size: 70px;margin-top: 20px;">Songs List</h1>


        <?php if (!empty($success_msg)) { ?>
            <div class="col-xs-12">
                <div class="alert alert-success"><?php echo $success_msg; ?></div>
            </div>
        <?php } ?>
        <?php if (!empty($error_msg)) { ?>
            <div class="col-xs-12">
                <div class="alert alert-danger"><?php echo $error_msg; ?></div>
            </div>
        <?php } ?>

        <div class="row">

            <div class="col-md-12 head">
                <div class="float-right">
                    <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Import</a>
                </div>
            </div>

            <div class="col-md-12" id="importFrm" style="display: none;">
                <form action="<?php echo base_url(); ?>Members/import" method="post" enctype="multipart/form-data">
                    <input type="file" name="file" />
                    <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
                </form>
            </div>
            <table id="dtOrderExample" class="table  table-bordered table-sm" cellspacing="0" width="100%">
                <thead class="table-dark">
                    <tr>
                        <th class="th-sm" style="display :none">Name
                        </th>
                        <th class="th-sm">Name
                        </th>
                        <th class="th-sm">Artist
                        </th>
                        <th class="th-sm">Duration
                        </th>


                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($members)) {
                        foreach ($members as $row) { ?>
                            <tr>
                                <td style="display :none"><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['Artist']; ?></td>
                                <td><?php echo $row['Duration']; ?></td>

                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="5">No member(s) found...</td>
                        </tr>
                    <?php } ?>
                </tbody>

                <tfoot>
                    <thead class="table-dark">
                        <tr>
                            <th style="display :none">Name
                            </th>
                            <th>Name
                            </th>
                            <th>Artist
                            </th>
                            <th>Duration
                            </th>


                        </tr>
                    </thead>
                </tfoot>
            </table>


        </div>
    </div>

    <script>
        function formToggle(ID) {
            var element = document.getElementById(ID);
            if (element.style.display === "none") {
                element.style.display = "block";
            } else {
                element.style.display = "none";
            }
        }

        $(document).ready(function() {
            $('#dtOrderExample').DataTable({
                "order": [
                    [3, "desc"]
                ]
            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script>


    <!-- JQuery -->
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>


</body>

</html>