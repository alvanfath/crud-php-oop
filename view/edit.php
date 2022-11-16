<?php
include '../database.php';
$db = new database();
$id = $_GET['id'];
if ($id != null) {
    $data = $db->getData($id);
}else {
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
    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        .home {
            background: linear-gradient(130deg, #fff  45%, #4e0685 45%);
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
</head>

<body>
    <div class="min-vh-100 py-5 d-flex justify-content-center align-items-center home">
        <div class="card" style="width: 50rem; max-width: 100%">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4>Edit user</h4>
                <a href="index.php" class="btn btn-sm btn-secondary">Back</a>
            </div>
            <div class="card-body">
                <form method="post" action="method.php?action=update">
                    <input type="text" name="id" value="<?php echo $data['id']; ?>" hidden>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name">Name :</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo $data['name']; ?>">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="email">Email :</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php echo $data['email']; ?>">
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>