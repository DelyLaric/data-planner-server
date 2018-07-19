<?php

namespace App\Services\Database;

class Operation
{
    protected $operationId;

    public function excute($userId, $namespace, $type, $comment, $commits)
    {
        $commits = isset($commits[0]) ? $commits : [$commits];

        Facades\Transaction::begin();

        $this->operationId = $this->insertOperation($userId, $namespace, $type, $comment);

        $results = [];

        foreach ($commits as $commit) {
            $result = $this->handleCommit($commit);
            if ($commit['type'] === 'search') $results[] = $result;
        }

        Facades\Transaction::commit();

        return $results;
    }

    public function create($userId, $namespace, $type, $commit, $table, $data)
    {
        $this->operationId = $this->insertOperation($userId, $namespace, $type, $comment);

        $this->handleCreate(['table' => $table, 'data' => $data]);
    }

    protected function insertOperation($userId, $namespace, $type, $comment)
    {
        return Facades\DB::insertOne('_log.operation', [
            'type' => $type,
            'namespace' => $namespace,
            'operatorId' => $userId,
            'comment' => $comment === null ? '{}' : json_encode($comment)
        ]);
    }

    protected function handleCreate($commit)
    {
        $table = $commit['table'];
        $data = $commit['data'];

        $ids = Facades\DB::insert($table, $data);
        Facades\Snapshot::create($this->operationId, $table, $ids);
    }

    protected function handleUpdate($commit)
    {
        $table = $commit['table'];
        $ids = $commit['id'];
        $data = $commit['data'];

        Facades\DB::update($table, $ids, $data);
        Facades\Snapshot::create($this->operationId, $table, $ids);
    }

    protected function handleDelete($commit)
    {
        $table = $commit['table'];
        $id = $commit['id'];
        Facades\DB::delete($table, $id);
        Facades\Snapshot::delete($table, $id);
    }

    protected function handleSearch($commit)
    {
        $table = $commit['table'];
        $id = $commit['id'];

        return Facades\DB::find($table, $id);
    }

    protected function handleCommit($commit)
    {
        switch ($commit['type']) {
            case 'create':
                return $this->handleCreate($commit);
            case 'update':
                return $this->handleUpdate($commit);
            case 'search':
                return $this->handleSearch($commit);
            case 'delete':
                return $this->handleDelete($commit);
        }
    }
}
