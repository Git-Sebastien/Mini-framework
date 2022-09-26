<?php 
namespace Core;


abstract class Controller{
    protected $params = [];
    protected $layout = 'default';

    public function render(string $filename,?array $params) {
        ob_start();
        $this->params = $params;
        require ROOT .'./views/'.$filename.'.php';
        $content = ob_get_clean();
        if($this->layout == false){
            echo $content;
        }
        else{
            require ROOT . 'views/layouts/'.$this->layout.'.php';
        }
    }

}