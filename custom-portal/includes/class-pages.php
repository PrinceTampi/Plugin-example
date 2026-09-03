<?php

class Custom_Portal_Pages
{
    public function render(string $page, array $data = []): void
    {
        $allowed_pages = ['home', 'login', 'dashboard', 'admin'];
        $template = in_array($page, $allowed_pages, true) ? $page : 'home';

        if ($template === 'admin') {
            $data['admin_info'] = (new Custom_Portal_Admin())->get_info();
        }

        if ($template === 'dashboard' && !is_user_logged_in()) {
            header('Location: ?page=login');
            exit;
        }

        $data['page'] = $template;
        extract($data, EXTR_SKIP);
        require __DIR__ . '/../templates/' . $template . '.php';
    }
}