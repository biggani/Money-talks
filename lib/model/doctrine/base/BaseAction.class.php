<?php

/**
 * BaseAction
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $account_id
 * @property integer $user_id
 * @property string $name
 * @property date $date
 * @property string $deposit
 * @property string $withdrawal
 * @property string $balance
 * @property Account $Account
 * @property sfGuardUser $User
 * @property Doctrine_Collection $Tags
 * @property Doctrine_Collection $ActionTag
 * 
 * @method integer             getAccountId()  Returns the current record's "account_id" value
 * @method integer             getUserId()     Returns the current record's "user_id" value
 * @method string              getName()       Returns the current record's "name" value
 * @method date                getDate()       Returns the current record's "date" value
 * @method string              getDeposit()    Returns the current record's "deposit" value
 * @method string              getWithdrawal() Returns the current record's "withdrawal" value
 * @method string              getBalance()    Returns the current record's "balance" value
 * @method Account             getAccount()    Returns the current record's "Account" value
 * @method sfGuardUser         getUser()       Returns the current record's "User" value
 * @method Doctrine_Collection getTags()       Returns the current record's "Tags" collection
 * @method Doctrine_Collection getActionTag()  Returns the current record's "ActionTag" collection
 * @method Action              setAccountId()  Sets the current record's "account_id" value
 * @method Action              setUserId()     Sets the current record's "user_id" value
 * @method Action              setName()       Sets the current record's "name" value
 * @method Action              setDate()       Sets the current record's "date" value
 * @method Action              setDeposit()    Sets the current record's "deposit" value
 * @method Action              setWithdrawal() Sets the current record's "withdrawal" value
 * @method Action              setBalance()    Sets the current record's "balance" value
 * @method Action              setAccount()    Sets the current record's "Account" value
 * @method Action              setUser()       Sets the current record's "User" value
 * @method Action              setTags()       Sets the current record's "Tags" collection
 * @method Action              setActionTag()  Sets the current record's "ActionTag" collection
 * 
 * @package    moneytalks
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAction extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('action');
        $this->hasColumn('account_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('name', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('date', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
        $this->hasColumn('deposit', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('withdrawal', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('balance', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));

        $this->option('type', 'InnoDB');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Account', array(
             'local' => 'account_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Tag as Tags', array(
             'refClass' => 'ActionTag',
             'local' => 'action_id',
             'foreign' => 'tag_id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('ActionTag', array(
             'local' => 'id',
             'foreign' => 'action_id'));

        $softdelete0 = new Doctrine_Template_SoftDelete();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($softdelete0);
        $this->actAs($timestampable0);
    }
}