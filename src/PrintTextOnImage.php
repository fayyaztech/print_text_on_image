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
                if ($this->data[$i]->textHorizontalCenter) {
                    $this->data[$i]->x = $this->textCenterImage($backgroundImage, $this->data[$i]);
                }
                imagettftext($backgroundImage, $this->data[$i]->fontSize, $this->data[$i]->angle, $this->data[$i]->x, $this->data[$i]->y, $this->data[$i]->color, $this->data[$i]->font_location, $this->data[$i]->textContent);
            } else {
                if (!file_exists($this->data[$i]->imagePath)) {
                    echo 'Provided Image ' . $this->data[$i]->imagePath . ' Not Found';
                    return 0;
                }

                $extOver = explode('.', $this->data[$i]->imagePath);
                if (end($extOver) == 'png') {
                    $src = imagecreatefrompng($this->data[$i]->imagePath);
                } else {
                    $src = imagecreatefromjpeg($this->data[$i]->imagePath);
                }
                $src = imagescale($src, $this->data[$i]->width, $this->data[$i]->height);
                imagecopymerge($backgroundImage, $src, $this->data[$i]->x, $this->data[$i]->y, 0, 0, $this->data[$i]->width, $this->data[$i]->height, $this->data[$i]->opacity);
            }
        }

        if ($this->imageOptions != 'debug') {
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

    private function textCenterImage($image, $fontData)
    {

        $bWH = getimagesize($this->backgroundImagePath);
        // Get image dimensions
        // $image_width = imagesx($image);
        // $image_height = imagesy($image);

        $image_width = $bWH[0];
        $image_height = $bWH[1];

        $text_bound = imageftbbox($fontData->fontSize, $fontData->angle, $fontData->font_location, $fontData->textContent);

        //Get the text upper, lower, left and right corner bounds
        $lower_left_x =  $text_bound[0];
        $lower_left_y =  $text_bound[1];
        $lower_right_x = $text_bound[2];
        $lower_right_y = $text_bound[3];
        $upper_right_x = $text_bound[4];
        $upper_right_y = $text_bound[5];
        $upper_left_x =  $text_bound[6];
        $upper_left_y =  $text_bound[7];


        //Get Text Width and text height
        $text_width =  $lower_right_x - $lower_left_x; //or  $upper_right_x - $upper_left_x
        $text_height = $lower_right_y - $upper_right_y; //or  $lower_left_y - $upper_left_y

        //Get the starting position for centering
        $start_x_offset = ($image_width - $text_width) / 2;
        $start_y_offset = ($image_height - $text_height) / 2;

        return $start_x_offset;
    }
}
