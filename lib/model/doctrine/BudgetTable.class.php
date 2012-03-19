<?php

/**
 * BudgetTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class BudgetTable extends Doctrine_Table
{

    /**
     * Returns an instance of this class.
     *
     * @return object BudgetTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Budget');
    }

    static public function fetchThisMonth($userId, $symmetricKey, $month, $year)
    {
        $q = Doctrine_Query::create()
            ->from('Budget b')
            ->leftJoin('b.Tags t')
            ->where('b.user_id = ?', $userId)
            ->andWhere('b.month = ?', $month)
            ->andWhere('b.year = ?', $year);

        $results = $q->execute();

        if ( ! count($results)) {
            return false;
        }

        $budgets = array();
        
        foreach($results as $result) {
            $tags = array();

            foreach($result->Tags as $tag) {
                $tags[] = $tag->name;
            }

            $budgets[] = array(
                'tags' => $tags,
                'amount' => $result->fetchAmount($symmetricKey),
                'current' => $result->fetchCurrent($symmetricKey)
            );
        }

        return $budgets;
    }

    static public function calculateUserBudgets($userId, $key)
    {
        $q = Doctrine_Query::create()
            ->from('Budget b')
            ->where('b.user_id = ?', $userId);

        $results = $q->execute();

        if ($results) {
            foreach ($results as $result) {
                $result->calculateCurrent($key);
            }
        }
    }

}
