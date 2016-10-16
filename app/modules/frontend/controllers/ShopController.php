<?php
/**
 * Created by PhpStorm.
 * User: SONY
 * Date: 24-09-2016
 * Time: 1:55 PM
 */
namespace Webxucxich\Modules\Frontend\Controllers;

use Webxucxich\Modules\Modeldb\Models\Product;
use Webxucxich\Modules\Modeldb\Models\ProductCategory;

class ShopController extends ControllerBase
{

    public function indexAction($id)
    {
        $keywordproduct = "";
        $limitproduct = 16;
        $page = 1;
        $categories = "";
        $id_category = "";
        if (isset($_GET['keyword']))
            $keywordproduct = $_GET['keyword'];
        if (isset($_GET['categories']))
            $categories = $_GET['categories'];
        if (isset($_GET['limitproduct']))
            $limitproduct = (int)$_GET['limitproduct'];
        if (isset($_GET['page']))
            $page = (int)$_GET['page'];
        if (isset($id))
            $id_category = ProductCategory::findFirst("slug = '$id'")->id;

        $data = array("products" => Product::findAllPaging("", null, $id_category, $page, $limitproduct),
            "page" => $page,
            "limitproduct" => $limitproduct,
            "slug" => $id);

        return $this->view->data = $data;
    }

    public function detailAction()
    {

    }

}