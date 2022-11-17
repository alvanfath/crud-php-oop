<?php
session_start();
include 'database.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crud oop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css" integrity="sha512-DIW4FkYTOxjCqRt7oS9BFO+nVOwDL4bzukDyDtMO7crjUZhwpyrWBFroq+IqRe6VnJkTpRAS6nhDvf0w+wHmxg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="min-vh-100 py-5 d-flex justify-content-center align-items-center home">
        <div class="card" style="width: 50rem; max-width: 40%">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4>Login</h4>
            </div>
            <div class="card-body">
                <form method="post" action="auth.php?action=login">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="email">Email :</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="password">Password :</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    </div>
                    <div class="d-flex gap-2">
                        <span>Dont have an account? <a href="#">Register</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            message();
        })

        function message() {
            <?php
            if (isset($_SESSION['failed'])) {
                $message = $_SESSION['failed'];
                unset($_SESSION['failed']);
            ?>
                var message = "<?php echo $message; ?>";
                iziToast.warning({
                    message: message,
                    position: 'topRight'
                });
            <?php } ?>
        }
    </script>
</body>

</html>