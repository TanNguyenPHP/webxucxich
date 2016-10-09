<?php
namespace Webxucxich\Modules\Frontend\Controllers;

use Phalcon\Mvc\Controller;
use Webxucxich\Modules\Modeldb\Models\ProductCategory;

class ControllerBase extends Controller
{
    public function initialize()
    {
        //$data = Webconfig::findFirst("id_lang = '1'");//Language
        //$this->tag->setTitle($data->title);
        //self::setMetaDescription($data->meta);

        return $this->view->datamain = array('categories' => ProductCategory::find()->toArray(true));
    }
}
