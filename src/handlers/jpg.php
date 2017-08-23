<?php 

class JPGHandler extends Handler
{
    /**
    * this function checks if provided image is capable of cropping or not if not then throw exception
    * @return void
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
        $img = imagecreatefromjpeg($this->getSrc());
        $target = imagecreatetruecolor($this->getWidth(), $this->getHeight());
        imagecopyresampled($target, $img, 0, 0, $this->getX(), $this->getY(), $this->getWidth(), $this->getHeight(), $crpdWidth(), $crpdHeight());
        imagejpeg($target, $this->getTarget());
        return $this->getTarget();
    }
}