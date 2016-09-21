<?php
namespace Webxucxich\Modules\Modeldb\Models;

class Webconfig extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=true)
     */
    public $title;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    public $meta;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    public $email;

    /**
     *
     * @var string
     * @Column(type="string", length=128, nullable=true)
     */
    public $address;

    /**
     *
     * @var string
     * @Column(type="string", length=24, nullable=true)
     */
    public $cellphone;

    /**
     *
     * @var string
     * @Column(type="string", length=128, nullable=true)
     */
    public $companyname;

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=32, nullable=false)
     */
    public $id_lang;

    /**
     *
     * @var string
     * @Column(type="string", length=24, nullable=true)
     */
    public $fax;

    /**
     *
     * @var string
     * @Column(type="string", length=256, nullable=true)
     */
    public $facebook;

    /**
     *
     * @var string
     * @Column(type="string", length=256, nullable=true)
     */
    public $google;

    /**
     *
     * @var string
     * @Column(type="string", length=256, nullable=true)
     */
    public $twitter;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'webconfig';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Webconfig[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Webconfig
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap()
    {
        return [
            'title' => 'title',
            'meta' => 'meta',
            'email' => 'email',
            'address' => 'address',
            'cellphone' => 'cellphone',
            'companyname' => 'companyname',
            'id_lang' => 'id_lang',
            'fax' => 'fax',
            'facebook' => 'facebook',
            'google' => 'google',
            'twitter' => 'twitter'
        ];
    }

}
