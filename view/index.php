<?php
session_start();
include '../database.php';
$db = new database();
$no = 1;
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crud oop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css" integrity="sha512-DIW4FkYTOxjCqRt7oS9BFO+nVOwDL4bzukDyDtMO7crjUZhwpyrWBFroq+IqRe6VnJkTpRAS6nhDvf0w+wHmxg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        .home {
            background: linear-gradient(130deg, #fff  45%, #4e0685 45%);
            height: 100%;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
</head>

<body>
    <div class="home">
        <div class="min-vh-100 py-5 d-flex justify-content-center align-items-center bg-light home">
            <div class="card" style="width: 50rem; max-width: 100%">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h4>Users table</h4>
                    <a href="create.php" class="btn btn-sm btn-primary">Create</a>
                </div>
                <div class="card-body">
                    <div id="alert">

                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover shadow-none" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $rows = $db->showData();
                                if ($rows) {
                                    foreach ($db->showData() as $item) {
                                ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $item['name']; ?></td>
                                            <td><?php echo $item['email'] ?></td>
                                            <td>
                                                <a href="edit.php?id=<?php echo $item['id'] ?>" class="btn btn-sm btn-warning me-1">Edit</a>
                                                <a href="method.php?action=delete&id=<?php echo $item['id'] ?>" onclick="return confirm('are you sure?')" class="btn btn-sm btn-danger me-1">Delete</a>
                                                <a href="check_password.php?id=<?php echo $item['id'] ?>" class="btn btn-sm btn-info">Check Password</a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            initiateDatatable();
            message();
        })

        function message() {
            <?php
            if (isset($_SESSION['success'])) {
                $message = $_SESSION['success'];
                unset($_SESSION['success']);
            ?>
                var message = "<?php echo $message; ?>";
                iziToast.success({
                    title: 'Success',
                    message: message,
                    position: 'topRight'
                });
            <?php } ?>
        }

        function initiateDatatable() {
            $('#datatable').DataTable();
        }
    </script>
</body>

</html>