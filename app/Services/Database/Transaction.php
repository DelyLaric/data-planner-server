<?php

namespace App\Services\Database;

use DB;

class Transaction
{
    private $working = false;

    public function begin()
    {
        // transaction has been started
        if ($this->working) return;

        DB::beginTransaction();
        $this->working = true;
    }

    public function commit()
    {
        DB::commit();
        $this->working = false;
    }

    public function rollback()
    {
        DB::rollback();
        $this->working = false;
    }

    public function working()
    {
        return $this->working;
    }
}
