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
            ->from('BudgetMonth m')
            ->leftJoin('m.Budget b')
            ->leftJoin('b.Tags t')
            ->where('b.user_id = ?', $userId)
            ->andWhere('m.month = ?', $month)
            ->andWhere('m.year = ?', $year)
            ->andWhere('b.deleted_at is null');

        $results = $q->execute();

        if ( ! count($results)) {
            return false;
        }

        $budgets = array();
        
        foreach($results as $result) {
            $tags = array();

            foreach($result->Budget->Tags as $tag) {
                $tags[] = $tag->name;
            }
            
            $amount = $result->Budget->fetchAmount($symmetricKey);
            $current = $result->fetchCurrent($symmetricKey);

            $diff = $amount - $current;

            $percentage = 100 * $current / $amount;

            if ($percentage >= 100) {
                $status = 'danger';
            } elseif ($percentage > 90) {
                $status = 'warning';
            } elseif ($percentage > 75) {
                $status = 'success';
            } else {
                $status = 'info';
            }

            $budgets[] = array(
                'id' => $result->Budget->id,
                'tags' => $tags,
                'amount' => $amount,
                'current' => $current,
                'diff' => $diff,
                'percentage' => $percentage,
                'status' => $status,
                'tags_combined' => $result->Budget->tags_combined
            );
        }

        return $budgets;
    }

    static public function calculateUserBudgets($userId, $key)
    {
        $q = Doctrine_Query::create()
            ->from('BudgetMonth m')
            ->leftJoin('m.Budget b')
            ->where('b.user_id = ?', $userId);

        $results = $q->execute();

        if ($results) {
            foreach ($results as $result) {
                $result->calculateCurrent($key);
            }
        }
    }

    static public function fetch($userId, $budgetId)
    {
        $q = Doctrine_Query::create()
            ->from('Budget b')
            ->where('b.user_id = ?', $userId)
            ->where('b.id = ?', $budgetId);

        return $q->fetchOne();
    }

    static public function checkMonths($userId, $key, $month, $year)
    {
        $user = sfGuardUserTable::getInstance()->findOneById($userId);

        if ($user) {
            foreach ($user->Budgets as $budget) {
                $hasThisMonthYear = false;

                foreach ($budget->Months as $m) {
                    if ($m->month == $month && $m->year == $year) {
                        $hasThisMonthYear = true;
                    }
                }

                if ( ! $hasThisMonthYear) {
                    $budgetMonth = new BudgetMonth();
                    $budgetMonth->budget_id = $budget->id;
                    $budgetMonth->month = $month;
                    $budgetMonth->year = $year;
                    $budgetMonth->calculateCurrent($key);
                }
            }
        }
    }

}
