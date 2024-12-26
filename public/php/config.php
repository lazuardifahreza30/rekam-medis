<?php
class config {
  private $data = array(), $acc = array();
  function connect() {
    return mysqli_connect("localhost", "root", "", "db_rekam_medis");
  }

  function exec($query) {
    return new result($this->connect(), $query);
  }

  function insertData($table, $data, $isId) {
    $query = "INSERT INTO ".$table;

    $columns = array();
    $values = array();

    foreach ($data as $key => $value):
      // code...
      $columns[] = $key;
      $values[] = "'".$value."'";
    endforeach;

    $query .= "(".implode(", ", $columns).") values(".implode(", ", $values).")";

    return $isId == true? $this->lastId($query) : $this->exec($query)->fetchquery();
  }

  function updateData($table, $data, $condition) {
    $query = "UPDATE ".$table;

    $i = 0;
    foreach ($data as $key => $value):
      // code...
      $query .= ($i == 0)? " SET " : ", ";
      $query .= $key." = '".$value."'";

      $i++;
    endforeach;

    if (isset($condition)):
      $i = 0;
      foreach ($condition as $key => $value):
        // code...
        $query .= ($i == 0)? " WHERE " : " AND ";
        $query .= $key." = '".$value."'";

        $i++;
      endforeach;
    endif;

    return $this->exec($query)->fetchquery();
  }

  function deleteData($table, $condition) {
    $query = "DELETE FROM ".$table;

    if (isset($condition)):
      // (function() use ($condition) {
        $i = 0;
        foreach ($condition as $key => $value):
          // code...
          $query .= ($i == 0)? " WHERE " : " AND ";
          $query .= $key." = '".$value."'";

          $i++;
        endforeach;
      // })();
    endif;

    return $this->exec($query)->fetchquery();
  }

  function selectData($table, $columns, $condition = array(), $join,
    $group_id, $pagination = array()) {
    $query = "SELECT ".implode(", ", $columns)." FROM ".$table;

    $i = 0;
    $type = "";
    $count = 0;
    $data = array();

    if ($join != "")
      $query .= $join;

    if (isset($condition) && count($condition) > 0):
      foreach ($condition as $key => $value):
        // code...
        if (isset($value['type'])):
          switch($value['type']):
            case 'freetext':
              $type = " LIKE '%".$value['value']."%'";
              break;
            case 'equal':
              $type = " = '".$value['value']."'";
              break;
            case 'not equal':
              $type = " != '".$value['value']."'";
              break;
          endswitch;
        endif;

        $query .= ($i == 0)? " WHERE " : $value['operator'];
        $query .= $key.$type." AND ";

        $i++;
      endforeach;

      $query = substr($query, 0, strlen($query) - 4);
    endif;

    if ($group_id != "")
      $query .= " GROUP BY $group_id ";

    if (isset($pagination['column_order']) && isset($pagination['dir_order']))
      $query .= " ORDER BY ".$pagination['column_order']." ".$pagination['dir_order'];

    if (isset($pagination['page']) && isset($pagination['limit']))
      $query .= " LIMIT ".$pagination['page'].", ".$pagination['limit'];

    $data = $this->exec($query)->fetchassoc();
    $count = count($data);

    // return $count > 1? $data : $data[0];
    return $data;
    // return $query;
  }

  function lastId($query) {
    return $this->exec($query)->fetchwithid();
  }

  function enkrip($val = "1") {
    $val = "$val";
    $arr = array(
      "a", "b", "c", "d", "e", "f", "g", "h",
      "i", "j", "k", "l", "m", "n", "o", "p",
      "q", "r", "s", "t", "u", "v", "w", "x",
      "y", "z", "0", "1", "2", "3", "4", "5",
      "6", "7", "8", "9", "10"
    );

    $arr_val = array();
    for ($i = 0; $i < strlen($val); $i++):
      for ($j = 0; $j < count($arr); $j++):
        if ($arr[$j] == $val[$i]) $arr_val[] = $j;
      endfor;
    endfor;

    $newVal = "";
    $val = "";
    for ($i = 0; $i < count($arr_val); $i++):
      for ($j = 0; $j < count($arr); $j++):
        if ($j == $arr_val[$i]):
          $val = $j > 25? $arr[$arr[($j + 7)]].ucfirst($arr[($arr[($j + 7)] + 9)]) : $arr[($j + 7)].ucfirst($arr[($j + 9)]);
          $newVal .= $val;

          $j = count($arr) + 1;
        endif;
      endfor;
    endfor;

    return $newVal;
  }

  function dekrip($val = "1") {
    $val = "$val";

    return $val;
  }

  function each($arr, $callback) {
    for ($i = 0; $i < count($arr); $i++)
      $callback($i, $arr[$i]);
  }

  function map($arr, $callback, $cc = array()) {
    for ($i = 0; $i < count($arr); $i++)
      $cc[] = $callback($arr[$i]);

    return $acc;
  }

  function cases($val, $attr, $arr, $acc = array()) {
    $this->data['val'] = $val;
    $this->data['attr'] = $attr;

    $this->each($arr, function($i, $item) {
      if ($item[$this->data['attr']] == $this->data['val'])
        $this->acc = $item['callback']($item);
    });

    return $this->acc;
  }

  function filter($arr, $type, $val, $attr, $callback) {
    $this->data['type'] = $type;
    $this->data['val'] = $val;
    $this->data['attr'] = $attr;

    $this->each($arr, function($i, $item) {
      if (($this->data['type'] == 'value' && $item == $this->data['val']) ||
          ($this->data['type'] == 'index' && $this->data['val'] == $i) ||
          ($this->data['type'] == 'object' && $item[$this->data['attr']] == $this->data['val']))
        $this->acc[] = cases(gettype($item), array(
          array('val' => 'number', 'callback' => function ($item) {
            return $item; }),
          array('val' => 'object', 'callback' => function ($item) {
            return $callback($item); })
        ));
    });

    return $this->acc;
  }

  function currency($val) {
    $new_val = '';
    $range = 5 - strlen($val);

    if ($range == 0)
      $range = 2;

    if (strlen($val) > 3 && strlen($val) < 7):
      $new_val = substr($val, 0, $range);
      $new_val .= '.';
      $new_val .= substr($val, $range, strlen($val));
    endif;

    return 'Rp '.$new_val;
  }
}
?>
