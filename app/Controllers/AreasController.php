<?php
namespace App\Controllers;

use Core\BaseController;
use Core\DataBase;
use App\Models\Area;
use Core\Container;

class AreasController extends BaseController 
{
    
    public function index ()
    {
        $this->setPageTitle("Areas");
        $model = Container::getModel("Area");
        $this->view->areas = $model->all();
        $this->renderView('areas/index', 'layout');
    
    }

    public function show($id) {
        $model = Container::getModel("Area");
        $this->view->area= $model->findById($id);
        $this->setPageTitle("{$this->view->areas->name}");
        $this->renderView('areas/show', 'layout');
    }

    public function create() 
    {
        $this->setPageTitle('New Area');
        $this->renderView('areas/create', 'layout');
    }

    public function store($request)
    {
        
        $model = Container::getModel("Area");
        var_dump($request);
        $this->view->areas=$model->create($request->post->name);
    }

    public function edit($id)
    {   
        $model = Container::getModel("Area");
        $this->view->area= $model->findById($id);
        $this->setPageTitle("Edite Area - {$this->view->area->name}");
        $this->renderView('areas/edit', 'layout');
    }

    public function update($id, $request) 
    {
        $model = Container::getModel("Area");
        $this->view->area=$model->update($id, $request->post->name);
        header("location:/area/{$id}/show");
    }

    public function delete ($id) 
    {
        $model = Container::getModel("Area");
        $this->view->area=$model->delete($id);
        $this->renderView('areas/index', 'layout');
    }


}

