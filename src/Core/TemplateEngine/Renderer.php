<?php

namespace Jonas\Core\TemplateEngine;

trait Renderer
{
    private const string TEMPLATE_PATH = __DIR__ . "/../../../views/";

    public function render(string $templateName, array $data = []): false|string
    {
        extract($data);

        ob_start();
        require_once self::TEMPLATE_PATH . $templateName;
        return ob_get_clean();
    }
}