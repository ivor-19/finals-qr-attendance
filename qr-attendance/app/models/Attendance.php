<?php

class Attendance extends Model
{

  public function validate() {
    //firstname, lastname, email, password
  }
  public function save()
  {
      $data = [
          'studentName' => $this->studentName,
          'studentCS' => $this->studentCS,
          'date' => $this->date,
          'timeIn' => $this->timeIn,
          'qr' => $this->qr

      ];

      $this->insert($data);
  }
 
}