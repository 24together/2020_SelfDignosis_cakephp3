<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class MainController extends Controller
{
    public function index(){
        //set the other layout
        $this->viewBuilder()->setLayout('main');
    }
}
?>