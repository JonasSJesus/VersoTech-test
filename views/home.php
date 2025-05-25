<?php require "includes/head.php";
/** @var Jonas\Domain\Model\User $users */?>

<body >
    <main class="container py-4">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h4 class=" mb-0">Gerenciamento de usuarios</h4>
                <a class="btn btn-primary" href="/insert-user">Inserir novo usuario</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover">
                    <thead>
                        <tr class="table-light">
                            <th scope="col" class="ps-3">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col" class="text-center">Cores</th>
                            <th scope="col" class="text-end pe-3">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($users) > 0): ?>
                            <?php foreach ($users as $user): ?>
                                <tr class="align-middle">
                                    <th scope="row" class="ps-3"><?= htmlspecialchars($user->getId()) ?></th>
                                    <td class="w-25"><?= htmlspecialchars($user->name) ?></td>
                                    <td class="w-25"><?= htmlspecialchars($user->email) ?></td>
                                    <td class="w-25 text-center">
                                    <?php foreach ($user->getColor() as $userColor): ?>
                                        <span class="badge bg-secondary"><?= $userColor ?? null; ?></span>
                                    <?php endforeach; ?>
                                    </td>
                                    <td class="text-end pe-3">
                                        <div class="btn-group">
                                            <a href="/update-user?id=<?= htmlspecialchars($user->getId()) ?>" class="btn btn-sm btn-outline-secondary" title="Edit user">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-btn"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#<?= htmlspecialchars($user->getId()) ?>"
                                                    title="Delete user">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="<?= htmlspecialchars($user->getId()) ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir usuario <?= $user->name; ?> ?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <a href="/delete-user?id=<?= htmlspecialchars($user->getId()) ?>" class="btn btn-danger">Excluir</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="bi bi-people fs-1 d-block mb-2"></i>
                                        No users found
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer pb-0">
                <p class="mb-2">Mostrando <?= count($users) ?> Usuarios</p>
            </div>
        </div>
    </main>

<?php include "includes/end-file.php" ?>