<?php
/**
 * Created by PhpStorm.
 * User: SONY
 * Date: 19-09-2016
 * Time: 10:31 PM
 */
namespace Webxucxich\Modules\Backend\Controllers;
use Webxucxich\Modules\Modeldb\Models\ProductCategory;

class ProductController extends ControllerBase
{
    public function indexAction()
    {

    }
    public function newAction()
    {
        return $this->view->data = ProductCategory::find()->toArray(true);
    }
}