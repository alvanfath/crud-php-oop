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
                <h4>Change Password</h4>
                <a href="check_password.php?id=<?php echo $data['id'] ?>" class="btn btn-sm btn-secondary">Check Password</a>
            </div>
            <div class="card-body">
                <form method="post" action="#">
                    <input type="text" id="id" name="id" value="<?php echo $data['id']; ?>" hidden>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="current_password">Current Password :</label>
                            <input type="password" name="current_password" id="current_password" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="name">New Password :</label>
                            <input type="password" name="new_password" id="new_password" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" onclick="showPassword()">
                                <label class="form-check-label" for="flexSwitchCheckChecked">Show</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" onclick="changeHandler()" class="btn btn-sm btn-primary">Save</button>
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
        function showPassword() {
            var current = document.getElementById("current_password")
            var newPass = document.getElementById("new_password")
            if (current.type == "password" && newPass) {
                current.type = "text";
                newPass.type = "text";
            } else {
                current.type = "password";
                newPass.type = "password";
            }

        }

        function changeHandler() {
            var id = $('#id').val()
            var current = $('#current_password').val();
            var newPass = $('#new_password').val();
            var url = 'method.php?action=change_password';
            $.ajax({
                type: 'post',
                url: url,
                data: {
                    id: id,
                    current: current,
                    new_pass: newPass
                },
                cache: false,
                success: function(response) {
                    var result = JSON.parse(response)
                    if (result.status == 1) {
                        iziToast.success({
                            message: result.message,
                            position: 'topRight'
                        });
                        $('#current_password').val('');
                        $('#new_password').val('');
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