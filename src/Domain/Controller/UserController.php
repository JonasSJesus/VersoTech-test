<?php

namespace Jonas\Domain\Controller;

use Jonas\Core\FlashMessages\Flash;
use Jonas\Core\TemplateEngine\Renderer;
use Jonas\Domain\Dao\UserDao;
use Jonas\Domain\Model\User;
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
            header("Location: /insert-user");
            return;
        }

        $this->userService->createUserWithColor($name, $email, $colors);

        $this->registerMessage("Usuario criado com sucesso!");

        header("Location: /");
    }

    public function update(): void
    {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) ?? null;
        $colors = $_POST['colors'] ?? null;
        $id = $_GET['id'];

        if (!$name || !$email) {
            header("Location: /update-user?id=" . $id);
            return;
        }

        $this->userService->updateUser($name, $email, $colors, $id);

        header("Location: /");
    }

    public function destroy()
    {
        $id = $_GET['id'];

        $this->userService->deleteUserAndLinks($id);

        header("Location: /");
    }

}