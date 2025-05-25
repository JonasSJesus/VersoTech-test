<?php

namespace Jonas\Domain\Controller;

use Jonas\Core\FlashMessages\Flash;
use Jonas\Core\TemplateEngine\Renderer;
use Jonas\Domain\Dao\UserDao;
use Jonas\Domain\Service\UserService;

class UserController
{
    use Renderer, Flash;

    private UserService $userService;
    private UserDao $userDao;

    public function __construct(UserService $userService, UserDao $userDao)
    {
        $this->userService = $userService;
        $this->userDao = $userDao;
    }

    public function index(): void
    {
        $data = $this->userDao->all();

        echo $this->render('home.php', [
            "users" => $data
        ]);
    }

    public function forms(): void
    {
        echo $this->render('forms.php');
    }

    public function editForm(): void
    {
        $id = $_GET['id'];
        $user = $this->userDao->getById($id);

        echo $this->render("forms.php", [
            "user" => $user[$id]
        ]);
    }

    public function store(): void
    {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) ?? null;
        $colors = $_POST['colors'];

        if (!$name || !$email) {
            $this->registerMessage('error', "Campos invalidos, tente novamente");
            header("Location: /insert-user");
            return;
        }

        if (!$this->userService->createUserWithColor($name, $email, $colors)) {
            $this->registerMessage('error', "Erro ao cadastrar o usuario");
            header("Location: /");

            return;
        }

        $this->registerMessage('success', "Usuario criado com sucesso!");
        header("Location: /");
    }

    public function update(): void
    {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) ?? null;
        $colors = $_POST['colors'] ?? null;
        $id = $_GET['id'];

        if (!$name || !$email) {
            $this->registerMessage('error', "Campos invalidos, tente novamente");
            header("Location: /update-user?id=" . $id);

            return;
        }

        if (!$this->userService->updateUser($name, $email, $colors, $id)) {
            $this->registerMessage('error', "Erro ao atualizar o usuario");
            header("Location: /");

            return;
        }

        $this->registerMessage('success', "Usuario atualizado.");
        header("Location: /");
    }

    public function destroy(): void
    {
        $id = $_GET['id'];

        if (!$this->userService->deleteUserAndLinks($id)) {
            $this->registerMessage('error', "Erro ao deletar o usuario");
            header("Location: /");

            return;
        }

        $this->registerMessage('success', "Usuario deletado do banco de dados.");
        header("Location: /");
    }

}