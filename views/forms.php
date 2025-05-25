<?php require "includes/head.php";
/** @var Jonas\Domain\Model\User $user */
?>

<body>
    <main class="container justify-content-center mt-3">
        <form method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input value="<?= $user?->email ?? null; ?>" name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nome</label>
                <input value="<?= $user?->name ?? null; ?>" name="name" type="text" class="form-control" id="exampleInputPassword1">
            </div>

            <h5>Selecione uma ou mais cores:</h5>

            <select class="form-select" aria-label="Default select example" name="colors[]" multiple>
                <option value="1" <?= isset($user?->getColor()[1]) ? "selected" : ""; ?>>Azul</option>
                <option value="2" <?= isset($user?->getColor()[2]) ? "selected" : ""; ?>>Vermelho</option>
                <option value="3" <?= isset($user?->getColor()[3]) ? "selected" : ""; ?>>Amarelo</option>
                <option value="4" <?= isset($user?->getColor()[4]) ? "selected" : ""; ?>>Verde</option>
            </select>
            <div class="form-text">Segure Ctrl para selecionar múltiplas cores.</div>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
            <a class="btn btn-secondary mt-3" href="/">Cancelar</a>
        </form>
    </main>

<?php include "includes/end-file.php" ?>