<?php

namespace App\Repositories;

use DB;

class Upload extends BaseRepository
{
  public function batchCreate($table, $constraint, $fields, $values)
  {
    $values = array_chunk($values, 200)[0];
    // dd ($values);
    $table = $this->transTableName($table);
    $columns = $this->transHeader($fields);
    $updateSetter = $this->transUpdateFieldValue($fields);

    $this->transValues($values);

    $result = DB::select(
      "insert into $table $columns ".
      "values $values ".
      "on conflict (id)".
      "do update set description = excluded.description ".
      "returning id"
    );

    return array_pluck($result, 'id');
  }

  public function filterUnique()
  {

  }

  public function batchCreateIgnore()
  {

  }

  public function batchCreateOrUpdate()
  {

  }

  public function transTableName (&$name)
  {
    $name = explode('.', $name);
    $name = '"' . implode('"."', $name) . '"';

    return $name;
  }

  public function transHeader ($header)
  {
    return '("' . implode('","', $header) . '")';
  }

  public function transValues (&$values)
  {
    if (!is_array($values[0])) {
      $values = [$values];
    }

    foreach ($values as &$item) {
      $item = '(\'' . implode('\',\'', $item) . '\')';
    }

    $values = implode(', ', $values);
  }

  public function transUpdateFieldValue($fields)
  {
    return implode(',', array_map(function ($field) {
      return $field . ' = ' . 'EXCLUDED.' . $field;
    }, $fields));
  }
}
