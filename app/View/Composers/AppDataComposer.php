<?php

namespace App\View\Composers;

use Illuminate\View\View;

class AppDataComposer
{
    public function compose(View $view)
    {
        $title = config('gh-action-yaml-generator.data.title');
        $description = config('gh-action-yaml-generator.data.description');

        $view->with(compact('title', 'description'));
    }
}
