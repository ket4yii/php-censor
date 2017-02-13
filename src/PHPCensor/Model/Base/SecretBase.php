<?php

/**
 * Secret base model for table: secret
 */

namespace PHPCensor\Model\Base;

use PHPCensor\Model;
use b8\Store\Factory;

/**
 * Secret Base Model
 */
class SecretBase extends Model
{
    /**
    * @var array
    */
    public static $sleepable = array();

    /**
    * @var string
    */
    protected $tableName = 'secret';

    /**
    * @var string
    */
    protected $modelName = 'Secret';

    /**
    * @var array
    */
    protected $data = array(
        'id' => null,
        'project_id' => null,
        'name' => null,
        'value' => null,
    );

    /**
    * @var array
    */
    protected $getters = array(
        // Direct property getters:
        'id' => 'getId',
        'project_id' => 'getProjectId',
        'name' => 'getName',
        'value' => 'getValue',

        // Foreign key getters:
        'Project' => 'getProject',
    );

    /**
    * @var array
    */
    protected $setters = array(
        // Direct property setters:
        'id' => 'setId',
        'project_id' => 'setProjectId',
        'name' => 'setName',
        'value' => 'setValue',

        // Foreign key setters:
        'Project' => 'setProject',
    );

    /**
    * @var array
    */
    public $columns = array(
        'id' => array(
            'type' => 'int',
            'length' => 11,
            'primary_key' => true,
            'auto_increment' => true,
            'default' => null,
        ),
        'project_id' => array(
            'type' => 'int',
            'length' => 11,
            'default' => null,
        ),
        'name' => array(
            'type' => 'varchar',
            'length' => 255,
            'default' => null,
        ),
        'value' => array(
            'type' => 'varchar',
            'length' => 255,
            'default' => null,
        ),
    );

    /**
    * @var array
    */
    public $indexes = array(
            'PRIMARY' => array('unique' => true, 'columns' => 'id'),
            'project_id' => array('columns' => 'project_id'),
    );

    /**
    * @var array
    */
    public $foreignKeys = array(
            'secret_ibfk_1' => array(
                'local_col' => 'project_id',
                'update' => 'CASCADE',
                'delete' => 'CASCADE',
                'table' => 'project',
                'col' => 'id'
                ),
    );

    /**
    * Get the value of Id / id.
    *
    * @return int
    */
    public function getId()
    {
        $rtn    = $this->data['id'];

        return $rtn;
    }

    /**
    * Get the value of ProjectId / project_id.
    *
    * @return int
    */
    public function getProjectId()
    {
        $rtn    = $this->data['project_id'];

        return $rtn;
    }

    /**
    * Get the value of Name / name.
    *
    * @return string
    */
    public function getName()
    {
        $rtn    = $this->data['name'];

        return $rtn;
    }

    /**
    * Get the value of Value / value.
    *
    * @return string
    */
    public function getValue()
    {
        $rtn    = $this->data['value'];

        return $rtn;
    }

    /**
    * Set the value of Id / id.
    *
    * Must not be null.
    * @param $value int
    */
    public function setId($value)
    {
        $this->_validateNotNull('Id', $value);
        $this->_validateInt('Id', $value);

        if ($this->data['id'] === $value) {
            return;
        }

        $this->data['id'] = $value;

        $this->_setModified('id');
    }

    /**
    * Set the value of ProjectId / project_id.
    *
    * Must not be null.
    * @param $value int
    */
    public function setProjectId($value)
    {
        $this->_validateNotNull('ProjectId', $value);
        $this->_validateInt('ProjectId', $value);

        if ($this->data['project_id'] === $value) {
            return;
        }

        $this->data['project_id'] = $value;

        $this->_setModified('project_id');
    }

    /**
    * Set the value of Name / name.
    *
    * Must not be null.
    * @param $value string
    */
    public function setName($value)
    {
        $this->_validateNotNull('Name', $value);
        $this->_validateString('Name', $value);

        if ($this->data['name'] === $value) {
            return;
        }

        $this->data['name'] = $value;

        $this->_setModified('name');
    }

    /**
    * Set the value of Value / value.
    *
    * Must not be null.
    * @param $value string
    */
    public function setValue($value)
    {
        $this->_validateNotNull('Value', $value);
        $this->_validateString('Value', $value);

        if ($this->data['value'] === $value) {
            return;
        }

        $this->data['value'] = $value;

        $this->_setModified('value');
    }

    /**
     * Get the Project model for this Secret by Id.
     *
     * @uses \PHPCensor\Store\ProjectStore::getById()
     * @uses \PHPCensor\Model\Project
     * @return \PHPCensor\Model\Project
     */
    public function getProject()
    {
        $key = $this->getProjectId();

        if (empty($key)) {
            return null;
        }

        $cacheKey   = 'Cache.Project.' . $key;
        $rtn        = $this->cache->get($cacheKey, null);

        if (empty($rtn)) {
            $rtn    = Factory::getStore('Project', 'PHPCensor')->getById($key);
            $this->cache->set($cacheKey, $rtn);
        }

        return $rtn;
    }

    /**
    * Set Project - Accepts an ID, an array representing a Project or a Project model.
    *
    * @param $value mixed
    */
    public function setProject($value)
    {
        // Is this an instance of Project?
        if ($value instanceof \PHPCensor\Model\Project) {
            return $this->setProjectObject($value);
        }

        // Is this an array representing a Project item?
        if (is_array($value) && !empty($value['id'])) {
            return $this->setProjectId($value['id']);
        }

        // Is this a scalar value representing the ID of this foreign key?
        return $this->setProjectId($value);
    }

    /**
    * Set Project - Accepts a Project model.
    * 
    * @param $value \PHPCensor\Model\Project
    */
    public function setProjectObject(\PHPCensor\Model\Project $value)
    {
        return $this->setProjectId($value->getId());
    }
}
