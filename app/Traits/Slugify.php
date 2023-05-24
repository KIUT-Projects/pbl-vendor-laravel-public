<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Slugify
{

    /**
     * Check for the presence of a matching slug in the database
     * if found, increment the slug by 1
     *
     * @param string $value (e.g. a title)
     * @param string $key - the key to search against in the db.
     * @return string
     */
    public function slugify(string $value, string $key = 'title'): string {
        // create a slug from the value
        $slug = Str::slug($value);

        // update the slug as needed
        if (static::where('slug', $slug)->exists()) {
            $latest_slug = $this->where($key, $value)->latest('id')->value('slug');
            $slug = $this->incrementSlug($latest_slug);
        }


        return $slug;
    }
    /**
     * Add 1 to a slug
     *
     * @param string $slug the slug to increment
     * @return string modified slug
     */
    private function incrementSlug(string $slug): string {
        if (is_numeric($slug[-1])) {
            $slug = preg_replace_callback('/(\d+)$/', function ($matches) {
                return $matches[1] + 1;
            }, $slug);
            return $slug;
        }
        return "{$slug}";
    }

}
