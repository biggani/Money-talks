<?php

/**
 * BaseBudgetMonth
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $budget_id
 * @property string $current
 * @property integer $month
 * @property integer $year
 * @property Budget $Budget
 * 
 * @method integer     getBudgetId()  Returns the current record's "budget_id" value
 * @method string      getCurrent()   Returns the current record's "current" value
 * @method integer     getMonth()     Returns the current record's "month" value
 * @method integer     getYear()      Returns the current record's "year" value
 * @method Budget      getBudget()    Returns the current record's "Budget" value
 * @method BudgetMonth setBudgetId()  Sets the current record's "budget_id" value
 * @method BudgetMonth setCurrent()   Sets the current record's "current" value
 * @method BudgetMonth setMonth()     Sets the current record's "month" value
 * @method BudgetMonth setYear()      Sets the current record's "year" value
 * @method BudgetMonth setBudget()    Sets the current record's "Budget" value
 * 
 * @package    moneytalks
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseBudgetMonth extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('budget_month');
        $this->hasColumn('budget_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('current', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('month', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('year', 'integer', null, array(
             'type' => 'integer',
             ));

        $this->option('type', 'InnoDB');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Budget', array(
             'local' => 'budget_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}