<?php
use System\Controller;

class mainController extends Controller
{

    public function show(array $params = [])
    {
        $this->render("index", $this->model($params['class'])->get($params));
    }

}
