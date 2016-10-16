<?php
namespace Webxucxich\Modules\Frontend\Controllers;

use Phalcon\Mvc\Controller;
use Webxucxich\Modules\Modeldb\Models\ProductCategory;
use Webxucxich\Modules\Modeldb\Models\Webconfig;
use Webxucxich\Common\ParamsConst\ParamSEO;

class ControllerBase extends Controller
{
    public function initialize()
    {
        $data = Webconfig::findFirst();//Language
        $this->tag->setTitle($data->title);
        self::setMetaDescription($data->meta);
        return $this->view->datamain = array('categories' => ProductCategory::find()->toArray(true));
    }

    protected function setMetaDescription($content)
    {
        ParamSEO::$meta_description = "$content";
    }
}
