<?php
include '../database.php';
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
}
$db = new database();
$id = $_GET['id'];
if ($id != null) {
    $data = $db->getData($id);
} else {
    header('location:index.php');
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crud oop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css" integrity="sha512-DIW4FkYTOxjCqRt7oS9BFO+nVOwDL4bzukDyDtMO7crjUZhwpyrWBFroq+IqRe6VnJkTpRAS6nhDvf0w+wHmxg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        .home {
            background: linear-gradient(130deg, #fff 45%, #4e0685 45%);
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
</head>

<body>
    <div class="min-vh-100 py-5 d-flex justify-content-center align-items-center home">
        <div class="card" style="width: 50rem; max-width: 100%">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4>Check Password</h4>
                <a href="change_password.php?id=<?php echo $data['id'] ?>" class="btn btn-sm btn-secondary">Change Password</a>
            </div>
            <div class="card-body">
                <form method="post" action="#">
                    <input type="text" id="id" name="id" value="<?php echo $data['id']; ?>" hidden>
                    <div class="row">
                        <div class="col-md-12 mb-1">
                            <label for="name">check :</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" onclick="showPassword()">
                                <label class="form-check-label" for="flexSwitchCheckChecked">Show</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" onclick="checkHandler()" class="btn btn-sm btn-primary">Check</button>
                        <a href="index.php" class="btn btn-sm btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function showPassword(){
            var password = document.getElementById("password")
            if (password.type == "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }
        }

        function checkHandler() {
            var url = 'method.php?action=check_password';
            var id = $('#id').val();
            var password = $('#password').val();
            $.ajax({
                type: 'post',
                url: url,
                data: {
                    id: id,
                    password: password
                },
                cache: false,
                success: function(response) {
                    var result = JSON.parse(response)
                    if (result.status == 1) {
                        iziToast.success({
                            message: result.message,
                            position: 'topRight'
                        });
                    } else {
                        iziToast.warning({
                            message: result.message,
                            position: 'topRight'
                        });
                    }
                }
            })
        }
    </script>
</body>

</html>