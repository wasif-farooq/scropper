<?php

class SCropperFactory
{
    private $defaults;

    public function __construct()
    {
        parent::__construct();
        if (!extension_loaded('gd')) throw new Exception('GD extension is not loaded');
    }

    public function getCropper($data)
    {
        $this->defaults = array(
            'src' => '',
            'width' => '',
            'height' => '',
            'x' => '',
            'y' => '',
            'target' => '',
        );

        if (!is_array($data)) throw new Exception('crop details must be in array format');

        $details = array_merge($this->defaults, $data);

        if (empty($$details['src'])) throw new Exception('src of image is empty');
        if (empty($details['width'])) throw new Exception('width to crop image is empty');
        if (empty($details['height'])) throw new Exception('height to crop image is empty');
        if (empty($details['x'])) throw new Exception('x position to crop image is empty');
        if (empty($details['y'])) throw new Exception('y position to crop image is empty');

        $extension = $this->getExtension($details['src']);
        $details['extension'] = $extension;

        if (empty($details['target'])) {
            $details['target'] = $this->getTarget($details['src']);
        }

        $handler = strtoupper($extension) . 'Handler';
        if (!class_exists($handler)) {
            throw new Exception('no handler avaible to handle .' . $extension . ' files');
        }
        
        return new SCropper($details, new $handler());
    }

    private function getExtension($src)
    {
        $src = explode('.', $src);
        $extension = array_pop($src);
        $extension = trim($extension);
        $extension = strtolower($extension);
        return $extension;
    }

    private function getTarget($src)
    {
        $name = explode(DIRECTORY_SEPERATOR, $src);
        $name = array_pop($name);
        $extension = $this->getExtension($src);
        $src = str_replace($name . '.' . $extension, '', $src);

        $name = str_replace('.'. $extension, '', $name);
        $name = $name . '-' . time() . '.' . $extension;
        return $src . $name;
    }
}