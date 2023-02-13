<!doctype html>
<html lang="en">

<?php
require_once __DIR__ . '/../template/header.php';
?>

<body class="d-flex flex-column">
<link rel="stylesheet" type="text/css" href="public/css/table.css">
<div id="page-content">
    <section class="py-5">

        <div class="container py-5">
            <h2>User list page</h2>
            <div class="col-2">
            <a href="logOut"><button type="button" class="btn btn-warning btn-block text-uppercase mb-2 rounded-pill shadow-sm">Log out</button></a>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title m-b-0">Table With Users</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">First name</th>
                                <th scope="col">Last name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Password</th>
                            </tr>
                            </thead>
                            <tbody class="customtable">
                            <?php
                            foreach ($usersList as $item){
                            ?>
                            <tr>
                                <td><?=$item['id']?></td>
                                <td><?=$item['first_name']?></td>
                                <td><?=$item['last_name']?></td>
                                <td><?=$item['email']?></td>
                                <td><?=$item['password']?></td>
                            </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<?php
require_once __DIR__ . '/../template/footer.php';
?>

</body>
</html>