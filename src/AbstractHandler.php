<?php

abstract class Handler
{
    /**
    * @type float
    */
    private $width;

    /**
    * @type float
    */
    private $height;

    /**
    * @type float
    */
    private $x;

    /**
    * @type float
    */
    private $y;

    /**
    * @type string
    */
    private $src;

    /**
    * @type string
    */
    private $target;

    /**
    * @type string
    */
    private $extension;

    /**
    * @return float
    */
    public function getWidth()
    {
        return $this->width;
    }

    /**
    * @param float $width set new width to crop
    * @return void
    */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
    * @return float
    */
    public function getHeight()
    {
        return $this->height;
    }

    /**
    * @param float $height set new height to crop
    * @return void
    */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
    * @return float
    */
    public function getX()
    {
        return $this->x;
    }

    /**
    * @param float $x set new x position to crop
    * @return void
    */
    public function setX($x)
    {
        $this->x = $x;
    }

    /**
    * @return float
    */
    public function getY()
    {
        return $this->y;
    }

    /**
    * @param float $y set new y position to crop
    * @return void
    */
    public function setY($y)
    {
        $this->y = $y;
    }

    /**
    * @return string
    */
    public function getSrc()
    {
        return $this->src;
    }

    /**
    * @param string $src set src of the image to crop
    * @return void
    */
    public function setSrc($src)
    {
        $this->src = $src;
    }

    /**
    * @return string
    */
    public function getTarget()
    {
        return $this->target;
    }

    /**
    * @param string $target set target image src to store cropped image
    * @return void
    */
    public function setTarget($target)
    {
        $this->target = $target;
    }

    /**
    * @return string
    */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
    * @param string $extension set extension of image
    * @return void
    */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    }

    public abstract function setup();

    public abstract function process();
}