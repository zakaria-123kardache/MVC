<?php


class Controller {

    protected $viewPath ; 
    protected $mode; 


    public function __construct ()
    {
        $this-> viewPath = __DIR__."/../../resources/views";
        $modelName = str_replace('controller','',static::class);
        $modelName = strtolower($modelName);
    }

    protected function render($view, $data = [])
    {

        $file = __DIR__ . '/../../resources/views/' . str_replace('.', '/', $view) . '.php';
        if (file_exists($file)) {
            extract($data);
            include $file;
        }

    }
}