<?php
/**
 * Created by PhpStorm.
 * User: SONY
 * Date: 19-09-2016
 * Time: 10:31 PM
 */
namespace Webxucxich\Modules\Backend\Controllers;

use Webxucxich\Modules\Modeldb\Models\ProductCategory;
use Webxucxich\Modules\Modeldb\Models\Product;
use Webxucxich\Modules\Modeldb\Models\ProductTag;
use Webxucxich\Modules\Modeldb\Models\Tag;
use Webxucxich\Common\Library\UtilsSEO;

class ProductController extends ControllerBase
{
    public function indexAction()
    {
        return $this->view->data = Product::findAll();
    }

    public function newAction()
    {
        return $this->view->data = ProductCategory::find()->toArray(true);
    }

    public function editAction($id)
    {
        $product = Product::findFirstByid($id);
        return $this->view->data = array('categories' => ProductCategory::find()->toArray(true), 'product' => $product);
    }

    public function saveAction()
    {
        $product = Product::findFirstByid($this->request->getPost('id'));
        if (!$product) {
            $this->flashSession->error("Không tồn tại");
            return $this->response->redirect('/backend/product/index');
        }
        $product->name = $this->request->getPost("name");
        $product->id_product_category = $this->request->getPost("id_category");
        $product->description = $this->request->getPost("description");
        $product->title_seo = $this->request->getPost("title_seo");
        $product->description_seo = $this->request->getPost("description_seo");
        $product->updateddate = date('Y-m-d H:i:s');
        $product->price = (double)str_replace(',', '', $this->request->getPost("price"));
        $product->image = $this->request->getPost("imageavatar");
        $product->more_image = $this->request->getPost("moreimages");
        $product->position = $this->request->getPost("position");
        $product->is_show = isset($_POST["isShow"]) ? true : false;
        $product->is_hot = isset($_POST["isHot"]) ? true : false;
        $product->is_new = isset($_POST["isNew"]) ? true : false;

        try {
            if (!$product->save()) {
                foreach ($product->getMessages() as $message) {
                    $this->flash->error($message);
                }
                $this->dispatcher->forward(array(
                    'controller' => "product",
                    'action' => 'new'
                ));
            }
        } catch (Exception $e) {
            $this->flash->error(var_dump($e));
            $this->dispatcher->forward(array(
                'controller' => "product",
                'action' => 'new'
            ));
        }

        return $this->response->redirect('/backend/product/index');

    }

    public function createAction()
    {
        $product = new Product();
        $product->name = $this->request->getPost("name");
        $product->id_product_category = $this->request->getPost("id_category");
        $product->slug = UtilsSEO::CreateSlug($product->name) . '-' . date('dmY');
        $product->description = $this->request->getPost("description");
        $product->title_seo = $this->request->getPost("title_seo");
        $product->description_seo = $this->request->getPost("description_seo");
        $product->createddate = date('Y-m-d H:i:s');
        $product->price = (double)str_replace(',', '', $this->request->getPost("price"));
        $product->image = $this->request->getPost("imageavatar");
        $product->more_image = $this->request->getPost("moreimages");
        $product->position = $this->request->getPost("position");
        $product->is_show = isset($_POST["isShow"]) ? true : false;
        $product->is_hot = isset($_POST["isHot"]) ? true : false;
        $product->is_new = isset($_POST["isNew"]) ? true : false;
        $product->is_del = false;

        try {
            if (!$product->save()) {
                foreach ($product->getMessages() as $message) {
                    $this->flash->error($message);
                }
                $this->dispatcher->forward(array(
                    'controller' => "product",
                    'action' => 'new'
                ));
            }
        } catch (Exception $e) {
            $this->flash->error(var_dump($e));
            $this->dispatcher->forward(array(
                'controller' => "product",
                'action' => 'new'
            ));
        }

        return $this->response->redirect('/backend/product/index');
    }
}