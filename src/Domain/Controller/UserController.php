<?php

namespace Jonas\Domain\Controller;

use Jonas\Core\TemplateEngine\Renderer;
use Jonas\Domain\Dao\UserDao;

class UserController
{
    use Renderer;

    private UserDao $userDao;

    public function __construct(UserDao $userDao)
    {
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
            "user" => $user
        ]);
    }

    public function store(): void
    {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) ?? null;

        if (!$name || !$email) {
            header("Location: /insert-user");
            return;
        }

        $this->userDao->add($name, $email);
    }

    public function update(): void
    {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) ?? null;
        $id = $_GET['id'];

        if (!$name || !$email) {
            header("Location: /update-user?id=" . $id);
            return;
        }

        $this->userDao->update($id, $name, $email);

        header("Location: /");
    }

    public function destroy()
    {
        $id = $_GET['id'];

        $this->userDao->delete($id);
    }

}