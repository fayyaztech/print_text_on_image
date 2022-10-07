<?php

namespace Fayyaztech\PrintTextOnImage;

class ConfigImage
{
    public $imagePath;
    public $x;
    public $y;
    public $width;
    public $height;
    public $opacity;

    /**
     * Method __construct
     *
     * @param String $imagePath image file path
     * @param int $x horizontal place on background image
     * @param int $y vertical place on background image
     * @param int $width image width
     * @param int $height image height
     * @param int $opacity image opacity/visibility
     *
     * @return void
     */
    public function __construct(String $imagePath, int $x, int $y, int $width, int $height, int $opacity = 0)
    {
        $this->imagePath = $imagePath;
        $this->x = $x;
        $this->y = $y;
        $this->width = $width;
        $this->height = $height;
        $this->opacity = $opacity;
    }
}
