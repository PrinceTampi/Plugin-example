<?php

class Custom_Portal_Admin
{
    public function get_info(): array
    {
        // TODO: Batasi halaman ini dengan current_user_can('manage_options') di WordPress asli.
        return [
            'name' => 'Custom Portal',
            'status' => 'Active',
            'version' => '1.0.0',
            'site_url' => 'http://localhost:8000/',
            'shortcode' => '[custom_portal_home]',
        ];
    }
}