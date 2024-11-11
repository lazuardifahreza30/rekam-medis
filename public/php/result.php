<?php
class result {
  protected $connection, $query;
  function __construct($connection, $query) {
    $this->query = $query;
    $this->connection = $connection;
  }

  function fetchquery() {
    return mysqli_query($this->connection, $this->query);
  }

  function fetchassoc($isNumber = false) {
    $q = $this->fetchquery($this->query);

    $i = 1;
    $result = array();
    while ($row = mysqli_fetch_assoc($q)):
      if ($isNumber == true)
        $row['no'] = $i;

      $result[] = $row;

      $i++;
    endwhile;

    $this->result = $result;

    return $result;
  }

  function fetcharray() {
    $q = $this->fetchquery($this->query);

    return mysqli_fetch_array($q);
  }

  function fetchnum() {
    return mysqli_num_rows($this->fetchquery());
  }

  function fetchwithid() {
    $q = mysqli_query($this->connection, $this->query);
    $q = mysqli_query($this->connection, "SELECT LAST_INSERT_ID()");
    $id = 0;

    while($r = mysqli_fetch_array($q)):
      $id = $r[0];
    endwhile;

    return $id;
  }
}
?>
