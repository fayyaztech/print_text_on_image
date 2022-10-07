# Print text on Image

## About 
- Anyone can use this library for creating printed certificates and id card banners.
- simple and easy way to implement into your existing project 
- currently im not providing multiple color for text only black color available
- Im working on it it will be available soon


## sample code

- setContent is an array of classes Text and images
- so you can print multiple text and image on same background
- images like barcode and qr code
- PrintTextOnImagePrintTextOnImage will give you an option to preview | save | download image directly

### configImage params
```php
     * @param String $imagePath image file path
     * @param int $x horizontal place on background image
     * @param int $y vertical place on background image
     * @param int $width image width
     * @param int $height image height
     * @param int $opacity image opacity/visibility
```

### ConfigText
```php
     * @param String $textContent text you want to print on image
     * @param Int $fontSize font size of that text
     * @param Int $angle rotation of text
     * @param Int $x horizontal position of text
     * @param Int $y vertical position of text
     * @param $color $color color is black for now we will provide color option soon
     * @param String $font_location custom font if you want other wise default is arial
```


### PrintTextOnImagePrintTextOnImage
```php
 
     * @param String $backgroundImagePath background image file path | remote url not allow | jpeg and png support
     * @param Array $data data should be an array of ConfigText and ConfigImage class
     * @param String $imageOptions download|preview|save
     * @param String $savePath if you choose option to save the provide local dir path path to save image
     
```

### Check the code below

```php

<?php

require_once 'vendor/autoload.php';

use Fayyaztech\PrintTextOnImage\ConfigImage;
use Fayyaztech\PrintTextOnImage\ConfigText;
use Fayyaztech\PrintTextOnImage\PrintTextOnImage as PrintTextOnImagePrintTextOnImage;

$setContent = [
    new ConfigText('Text on image', 30, 60, 30),
    new ConfigText('this is 2nd text', 30, 100, 10),
    new ConfigImage('php.png', 150, 100, 60, 30, 70),
];


$test = new PrintTextOnImagePrintTextOnImage('./white.png', $setContent, 'preview');
$test->generate();
 ```
