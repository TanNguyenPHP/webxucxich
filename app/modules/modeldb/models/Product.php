<?php
namespace Webxucxich\Modules\Modeldb\Models;
use Webxucxich\Common\ParamsConst\Params;
class Product extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=32, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(type="string", length=256, nullable=true)
     */
    public $name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $id_product_category;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    public $price;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    public $cost;

    /**
     *
     * @var string
     * @Column(type="string", length=256, nullable=true)
     */
    public $slug;

    /**
     *
     * @var string
     * @Column(type="string", length=256, nullable=true)
     */
    public $image;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $more_image;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $createdby;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $updatedby;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $updateddate;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $createddate;

    /**
     *
     * @var string
     * @Column(type="string", length=256, nullable=true)
     */
    public $description_seo;

    /**
     *
     * @var string
     * @Column(type="string", length=256, nullable=true)
     */
    public $title_seo;

    /**
     *
     * @var string
     * @Column(type="string", length=1024, nullable=true)
     */
    public $description;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=true)
     */
    public $is_home;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=true)
     */
    public $is_show;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=true)
     */
    public $is_del;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=true)
     */
    public $is_hot;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=true)
     */
    public $is_new;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=true)
     */
    public $is_stock;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $position;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'product';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Product[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    public static function findAll($keyword = '', $is_show = null, $id_product_category = "")
    {
        $queryBuilder = new \Phalcon\Mvc\Model\Query\Builder(self::buildparams($keyword, $is_show, $id_product_category));

        return $queryBuilder->getQuery()->execute();
    }

    public static function findAllPaging($keyword = "", $is_show = null, $id_product_category = "",$page = "", $limit="")
    {
        $queryBuilder = new \Phalcon\Mvc\Model\Query\Builder(self::buildparams($keyword, $is_show, $id_product_category));
        $paginator = new \Phalcon\Paginator\Adapter\QueryBuilder(array(
            "builder" => $queryBuilder,
            "limit" => (int)$limit,
            "page" => (int)$page
        ));
        return $paginator->getPaginate();
    }

    private static function buildparams($keyword = '', $is_show = null, $id_product_category = "", $slug = "")
    {
        $conditions = 'is_del = '. Params::ParamFalse;
        if ($keyword != '')
            $conditions = $conditions . " and name like '%$keyword%'";
        if ($is_show != null)
            $conditions = $conditions . " and is_show = '$is_show'";
        if ($id_product_category != '')
            $conditions = $conditions . " and id_product_category = '$id_product_category'";
        if ($slug != '')
            $conditions = $conditions . " and slug = '$slug'";
        return $params = array(
            'models' => array('Webxucxich\Modules\Modeldb\Models\Product'),
            'conditions' => $conditions,
            'order' => 'name'
            //'limit' => '100'
        );
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Product
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
