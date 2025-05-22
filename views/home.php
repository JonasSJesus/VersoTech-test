<?php require "includes/head.php";
/** @var Jonas\Domain\Model\User $users */?>

<body>
    <main class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Color</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <th scope="row"><?= $user->id?></th>
                        <th><?= $user->name ?></th>
                        <th><?= $user->email ?></th>
                        <th>Blue</th>
                        <th>
                            <a href="/update-user?id=<?= $user->id?>"><i class="bi bi-pencil-fill"></i></a>
                            <a href="/delete-user?id=<?= $user->id?>"><i class="bi bi-trash"></i></a>
                        </th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

<?php include "includes/end-file.php" ?>