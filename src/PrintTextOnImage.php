<?php

namespace Fayyaztech\PrintTextOnImage;

class PrintTextOnImage
{
    private $backgroundImagePath;
    private $data;
    private $imageOptions;
    private $savePath;


    /**
     * Method generate
     *
     * @param String $backgroundImagePath background image file path | remote url not allow | jpeg and png support
     * @param Array $data data should be an array of SetText class
     * @param String $imageOptions download|preview|save
     * @param String $savePath if you choose option to save the provide local dir path path to save image
     * @return void
     */
    public function __construct($backgroundImagePath, array $data, $imageOptions = 'download', $savePath = "")
    {
        $this->backgroundImagePath = $backgroundImagePath;
        $this->data = $data;
        $this->imageOptions = $imageOptions;
        $this->savePath = $savePath;
    }

    /**
     * Method generate
     * function will generate the image with provided content
     * @return void
     */
    public function generate()
    {
        if (!file_exists($this->backgroundImagePath)) {
            echo 'background Image not found';
            return 0;
        }

        if ($this->data[0]->x == null || $this->data[0]->y == null) {
            echo 'Image position required';
            return 0;
        }

        $ext = explode('.', $this->backgroundImagePath);
        if (end($ext) == 'png') {
            $backgroundImage = imagecreatefrompng($this->backgroundImagePath);
        } else {
            $backgroundImage = imagecreatefromjpeg($this->backgroundImagePath);
        }
        for ($i = 0; $i < count($this->data); $i++) {
            $objectOf = explode("\\", get_class($this->data[$i]));
            if (end($objectOf) == 'ConfigText') {
                if (end($objectOf))

                    if (!file_exists($this->data[$i]->font_location)) {
                        echo 'font not found';
                        return 0;
                    }
                imagettftext($backgroundImage, $this->data[$i]->fontSize, $this->data[$i]->angle, $this->data[$i]->x, $this->data[$i]->y, $this->data[$i]->color, $this->data[$i]->font_location, $this->data[$i]->textContent);
            } else {
                if (!file_exists($this->data[$i]->imagePath)) {
                    echo 'image over not found';
                    return 0;
                }
                $src = imagecreatefrompng($this->data[$i]->imagePath);
                imagecopymerge($backgroundImage, $src, $this->data[$i]->x, $this->data[$i]->y, 0, 0, $this->data[$i]->width, $this->data[$i]->height, $this->data[$i]->opacity);
            }
        }

        if ($this->imageOptions == 'download') {
            header('content-type: image/png');
            header('Content-Disposition: attachment; filename="xyz.png"');
            imagepng($backgroundImage);
        } elseif ($this->imageOptions == 'save') {
            imagepng($backgroundImage, "./" . $this->savePath . "/" . str_replace(" ", "_", uniqid() . ".png")); //save image
        } else {
            header('content-type: image/png');
            imagepng($backgroundImage);
        }
        imagedestroy($backgroundImage);
    }
}
