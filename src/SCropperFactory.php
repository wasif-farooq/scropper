<?php
/**
* An factory class to get cropper instance
*
* @category   image croppering
* @package    scropper
* @author     Wasif Farooq <wasif0332@gmail.com>
* @license    http://www.php.net/license/3_01.txt  PHP License 3.01
* @version    1.0
*/

class SCropperFactory
{
    /**
    * this can hold the defailt properties of image cropper
    * @var array
    */
    private $defaults;

    /**
    * @return void
    * @throws Exception
    */
    public function __construct()
    {
        if (!extension_loaded('gd')) throw new Exception('GD extension is not loaded');
    }

    /**
    * @param array $data the image cropping detials like src, width, height, x, y, target
    * @return SCropper
    * @throws Exceptions if requrired properties are empty
    */
    public function getCropper($data)
    {
        $this->defaults = array(
            'src' => '',
            'width' => '',
            'height' => '',
            'x' => 0,
            'y' => 0,
            'target' => '',
        );

        if (!is_array($data)) throw new Exception('crop details must be in array format');

        $details = array_merge($this->defaults, $data);

        // throws exception if src is empty
        if (empty($details['src'])) throw new Exception('src of image is empty');

        // throws exceptions if width is empty
        if (empty($details['width'])) throw new Exception('width to crop image is empty');

        // throws exception if height is empty
        if (empty($details['height'])) throw new Exception('height to crop image is empty');

        // if x position is empty the set to start coordinates
        if (empty($details['x'])) {
            $details['x'] = 0;
        }

        // if y position is empty the set to start coordinates
        if (empty($details['y'])) {
            $details['y'] = 0;
        }

        $extension = $this->getExtension($details['src']);
        $details['extension'] = $extension;

        // if target is empty the set source path with different image name
        if (empty($details['target'])) {
            $details['target'] = $this->getTarget($details['src']);
        }

        $handler = strtoupper($extension) . 'Handler';

        // if hander does not exists of that thype of image/file then throws excetion 
        if (!class_exists($handler)) {
            throw new Exception('no handler avaible to handle .' . $extension . ' files');
        }
        
        // return a instance of SCropper
        return new SCropper($details, new $handler());
    }

    /**
    * @param string @src the src path of origional image
    * @return string
    */
    private function getExtension($src)
    {
        $src = explode('.', $src);
        $extension = array_pop($src);
        $extension = trim($extension);
        $extension = strtolower($extension);
        return $extension;
    }

    /**
    * @param string $src the origional image source path
    * @return string
    */
    private function getTarget($src)
    {
        $name = explode(DIRECTORY_SEPARATOR, $src);
        $name = array_pop($name);
        $extension = $this->getExtension($src);
        $src = str_replace($name . '.' . $extension, '', $src);

        $name = str_replace('.'. $extension, '', $name);
        $name = $name . '-' . time() . '.' . $extension;
        return $src . $name;
    }
}