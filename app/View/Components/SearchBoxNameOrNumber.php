<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchBoxNameOrNumber extends Component
{
    private string $route;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $route)
    {
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.search-box-name-or-number')
            ->with('route', $this->route);
    }
}
