<?php

namespace Tests\Unit\View\Composers;

use App\View\Composers\AppDataComposer;
use Illuminate\View\View;
use Tests\TestCase;

class AppDataComposerTest extends TestCase
{
    /** @test */
    public function can_pass_title_and_description_to_the_view()
    {
        /** @var \Illuminate\View\View $view */
        $view = $this->spy(View::class);

        (new AppDataComposer)->compose($view);

        $view->shouldHaveReceived('with')->with([
            'title' => !null,
            'description' => !null,
        ]);
    }
}
