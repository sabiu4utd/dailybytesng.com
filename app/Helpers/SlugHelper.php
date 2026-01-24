<?php

namespace App\Helpers;

class SlugHelper
{
    /**
     * Generate a URL-friendly slug from a string using underscores between words
     * 
     * @param string $text The text to convert to a slug
     * @return string The generated slug
     */
    public static function generate(string $text): string
    {
        // Convert to lowercase
        $slug = strtolower($text);
        
        // Replace spaces and special characters with underscores
        $slug = preg_replace('/[^\w]+/', '-', $slug);
        
        // Remove leading/trailing underscores
        $slug = trim($slug, '-');
        
        // Replace multiple consecutive underscores with a single underscore
        $slug = preg_replace('/_+/', '-', $slug);
        
        return $slug;
    }
}
