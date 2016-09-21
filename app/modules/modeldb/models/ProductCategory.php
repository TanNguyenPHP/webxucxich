<?php
namespace Webxucxich\Modules\Modeldb\Models;
class ProductCategory extends \Phalcon\Mvc\Model
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
     * @var string
     * @Column(type="string", length=256, nullable=true)
     */
    public $slug;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    public $pid;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    public $path;

    /**
     *
     * @var string
     * @Column(type="string", length=256, nullable=true)
     */
    public $title_seo;

    /**
     *
     * @var string
     * @Column(type="string", length=256, nullable=true)
     */
    public $description_seo;

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
        return 'product_category';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductCategory[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductCategory
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
