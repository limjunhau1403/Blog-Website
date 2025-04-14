<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Logo extends Component
{
    public $width;
    public $height;
    public $fontSize;
    public $viewBox;
    /**
     * Create a new component instance.
     */
    public function __construct($data)
    {
        $this->width = $data['width'];
        $this->height = $data['height'];
        $this->fontSize = $data['fontSize'];
        $this->viewBox = $data['viewBox'];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.logo');
    }
}
