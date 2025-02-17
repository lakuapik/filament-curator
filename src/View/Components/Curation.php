<?php

namespace Awcodes\Curator\View\Components;

use Awcodes\Curator\Facades\Curator;
use Closure;
use Awcodes\Curator\Models\Media;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Curation extends Component
{
    public array|null $curatedMedia = null;

    public function __construct(
        public int|Media|null $media,
        public string|null $curation = null,
    ) {
        if (! $media instanceof Media) {
            $this->media = Curator::getMediaModel()::where('id', $media)->first();
        }

        if ($this->media) {
            $this->curatedMedia = $this->media->getCuration($curation);
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|string|Closure
    {
        return function (array $data) {
            return 'curator::components.curation';
        };
    }
}
