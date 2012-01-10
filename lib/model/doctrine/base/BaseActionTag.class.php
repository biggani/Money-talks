<?php

/**
 * BaseActionTag
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $action_id
 * @property integer $tag_id
 * @property Action $Action
 * @property Tag $Tag
 * 
 * @method integer   getActionId()  Returns the current record's "action_id" value
 * @method integer   getTagId()     Returns the current record's "tag_id" value
 * @method Action    getAction()    Returns the current record's "Action" value
 * @method Tag       getTag()       Returns the current record's "Tag" value
 * @method ActionTag setActionId()  Sets the current record's "action_id" value
 * @method ActionTag setTagId()     Sets the current record's "tag_id" value
 * @method ActionTag setAction()    Sets the current record's "Action" value
 * @method ActionTag setTag()       Sets the current record's "Tag" value
 * 
 * @package    moneytalks
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseActionTag extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('action_tag');
        $this->hasColumn('action_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('tag_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));

        $this->option('type', 'InnoDB');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Action', array(
             'local' => 'action_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Tag', array(
             'local' => 'tag_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}