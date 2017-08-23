<?php 
/**
* An handler class of gif image
*
* @category   image croppering
* @package    scropper
* @author     Wasif Farooq <wasif0332@gmail.com>
* @license    http://www.php.net/license/3_01.txt  PHP License 3.01
* @version    1.0
*/

class GIFHandler extends Handler
{
    /**
    * this function checks if provided image is capable of cropping or not if not then throw exception
    * @return void
    * @throws Exception
    */
    public function setup()
    {
        if (!list($orgW, $orgH) = getimagesize($this->getSrc())) {
            throw new Exception('invalid image dimensions');
        }

        if ($this->getWidth() > (float) $orgW || $this->getHeight() > (float) $orgH) {
            throw new Exception('the provided crop size is greater than origional image size');
        }
    }

    /**
    * this function actually crop the image with giving dimensions and return newly created image image path
    * @return string
    */
    public function process()
    {
        // getting image data
        $img = imagecreatefromgif($this->getSrc());

        // create a new image
        $target = imagecreatetruecolor($this->getWidth(), $this->getHeight());

        // setting image alpha transparency
        imagecolortransparent($target, imagecolorallocatealpha($target, 0, 0, 0, 127));
        imagealphablending($target, false);
        imagesavealpha($target, true);

        // saving image to target place
        imagecopyresampled($target, $img, 0, 0, $this->getX(), $this->getY(), $this->getWidth(), $this->getHeight(), $this->getWidth(), $this->getHeight());
        imagegif($target, $this->getTarget());

        // return target path of cropped image
        return $this->getTarget();
    }
}