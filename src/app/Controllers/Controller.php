<?php

namespace App\Controllers;

class Controller
{
    public function __construct()
    {
        // For POST method, check csrf token before perform child action
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $serverToken = $_SESSION['csrf'] ?? exit();
            $clientToken = $_POST['csrf'] ?? exit();
            if ($serverToken != $clientToken) exit();
        }
    }

    public function render(string $path, ?array $params = null, ?array $metas = null)
    {
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);

        if ($params) extract($params);

        require VIEW_ROOT . $path . '.php';
        $content = ob_get_clean();
        require VIEW_ROOT . 'layout.php';
    }

    private $csrfToken = null;

    public function csrf()
    {
        if (!isset($this->csrfToken)) {
            $this->csrfToken = md5(uniqid(rand(), true));
            $_SESSION['csrf'] = $this->csrfToken;
        }

        return  '<input type="hidden" name="csrf" value="' . $this->csrfToken . '" />';
    }
}
