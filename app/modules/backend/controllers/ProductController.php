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
use Webxucxich\Common\ParamsConst\Params;


class ProductController extends ControllerBase
{
    public function indexAction()
    {
        $keyword = "";
        $limit = 10;
        $page = 1;
        $categories = "";

        if (isset($_GET['keyword']))
            $keyword = $_GET['keyword'];
        if (isset($_GET['categories']))
            $categories = $_GET['categories'];
        if (isset($_GET['limit']))
            $limit = (int)$_GET['limit'];
        if (isset($_GET['page']))
            $page = (int)$_GET['page'];

        return $this->view->data = array("data" => Product::findAllPaging($keyword, null, $categories, $page, $limit),
            "categories" => ProductCategory::find()->toArray(true),
            "category" => $categories,
            "keyword" => $keyword,
            "limit" => $limit,
            "page" => $page);
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
        $product->is_show = isset($_POST["isShow"]) ? Params::ParamTrue : Params::ParamFalse;
        $product->is_hot = isset($_POST["isHot"]) ? Params::ParamTrue : Params::ParamFalse;
        $product->is_new = isset($_POST["isNew"]) ? Params::ParamTrue : Params::ParamFalse;

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
        $product->is_show = isset($_POST["isShow"]) ? Params::ParamTrue : Params::ParamFalse;
        $product->is_hot = isset($_POST["isHot"]) ? Params::ParamTrue : Params::ParamFalse;
        $product->is_new = isset($_POST["isNew"]) ? Params::ParamTrue : Params::ParamFalse;
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

    private function createdatafake()
    {
        require_once APP_PATH . '/faker/autoload.php';
        $faker = \Faker\Factory::create();
        $prices = array(0 => 10000, 1 => 20000, 2 => 30000, 3 => 40000, 4 => 50000);
        $categoryids = ProductCategory::find(['columns' => 'id'])->toArray();
        for ($i = 0; $i <= 100; $i++) {
            $product = new Product();
            $product->name = $faker->name;

            $categoryRandId = array_rand($categoryids);

            $product->id_product_category = $categoryids[$categoryRandId]['id'];
            $product->slug = \Phalcon\Tag::friendlyTitle($product->name, "-") . '-' . date('dmY');
            $product->description = $faker->text;
            $product->title_seo = $faker->name;
            $product->description_seo = $faker->name;
            $product->createddate = date('Y-m-d H:i:s');

            $_prices = array_rand($prices);

            $product->price = $prices[$_prices]; //$faker->unique()->randomDigit;
            //$product->image = '';
            //$product->more_image = '';
            //$product->position = '';
            $product->is_show = Params::ParamTrue;
            $product->is_hot = Params::ParamTrue;
            $product->is_new = Params::ParamTrue;
            $product->is_del = Params::ParamFalse;
            try {
                $product->save();
            } catch (Exception $e) {

            }
        }
    }
}