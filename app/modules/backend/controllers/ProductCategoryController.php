<?php
namespace Webxucxich\Modules\Backend\Controllers;

use Webxucxich\Modules\Modeldb\Models\ProductCategory;
use Webxucxich\Common\Library\UtilsSEO;
use Webxucxich\Common\ParamsConst\Params;

class ProductCategoryController extends ControllerBase
{
    public function indexAction()
    {
        return $this->view->data = ProductCategory::find()->toArray(true);
    }

    public function newAction()
    {
        return $this->view->data = ProductCategory::find()->toArray(true);
    }

    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "productcategory",
                'action' => 'index'
            ));

        }

        $productcategory = new ProductCategory();
        $productcategory->name = $this->request->getPost("name");
        $productcategory->position = $this->request->getPost("position");
        $productcategory->title_seo = $this->request->getPost("title_seo");
        $productcategory->description_seo = $this->request->getPost("description_seo");
        $productcategory->pid = $this->request->getPost("pid");
        $productcategory->slug = UtilsSEO::CreateSlug($productcategory->name);
        $productcategory->is_show = Params::ParamTrue;
        $productcategory->is_home = Params::ParamTrue;

        if (!$productcategory->save()) {
            foreach ($productcategory->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "productcategory",
                'action' => 'new'
            ));

        }

        return $this->response->redirect('/backend/productcategory/index');
    }
}
