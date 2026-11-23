<?php

namespace App\Services;

class PageMeta
{
    /**
     * @return array{title: string, description: string, image: string, url: string, robots: string|null}
     */
    public static function for(string $page, bool $shared = false): array
    {
        /** @var array{route: string, title: string, description: string, image: string, shared_title?: string, shared_description?: string, robots?: string} $definition */
        $definition = config("seo.pages.{$page}");

        return [
            'title' => $shared && isset($definition['shared_title']) ? $definition['shared_title'] : $definition['title'],
            'description' => $shared && isset($definition['shared_description']) ? $definition['shared_description'] : $definition['description'],
            'image' => url($definition['image']),
            'url' => $page === 'missing' ? url()->current() : route($definition['route']),
            'robots' => $definition['robots'] ?? ($shared ? 'noindex, follow' : null),
        ];
    }
}
