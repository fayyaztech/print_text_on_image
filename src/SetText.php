<?php

namespace Fayyaztech\PrintTextOnImage;

class SetText
{
    /****
     * fontSize
     * font size will accept only number 
     * @var int
     */
    public $fontSize;

    /**
     * angle
     * by default ange is 0, if you want to rotate you can provide the angle degree
     * @var int
     */
    public $angle;
    /**
     * x
     * provide horizontal position of text on image $x except int depends on background image pixels
     * @var int
     */
    public $x;

    /**
     * y
     *provide vertical position of text on image $y except int depends on background image pixels
     * @var int
     */
    public $y;
    /**
     * color
     *
     * @var mixed
     */


    /**
     * color
     * this is only accept color of imagecolorallocate
     * @var imagecolorallocate
     */
    public $color;


    /**
     * font_location
     * font file path
     * @var String
     */
    public $font_location;

    /**
     * textContent
     * Text content to print on image
     * @var String
     */
    public $textContent;


    /**
     * Method __constructor
     *
     * @param String $textContent text you want to print on image
     * @param Int $fontSize font size of that text
     * @param Int $angle rotation of text
     * @param Int $x horizontal position of text
     * @param Int $y vertical position of text
     * @param $color $color color is black for now we will provide color option soon
     * @param String $font_location custom font if you want other wise default is arial
     *
     * @return void
     */
    public function __constructor(String $textContent, int $x, int $y, int $fontSize = 30, int $angle = 0,  String $font_location = '/src/font/Arial.ttf', $color = '')
    {
        $im = imagecreatetruecolor(400, 30);
        $black = imagecolorallocate($im, 0, 0, 0);
        $this->fontSize = $fontSize;
        $this->angle = $angle;
        $this->x = $x;
        $this->y = $y;
        $this->color = $black;
        $this->font_location = $font_location;
        $this->textContent = $textContent;
    }
}
