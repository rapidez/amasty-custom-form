<?php

namespace Rapidez\AmastyCustomForm\View\Components;

use Illuminate\View\Component;

class Form extends Component
{
    public $formId;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($formId = 0)
    {
        $this->formId = $formId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('amasty-custom-form::components.form');
    }
}
