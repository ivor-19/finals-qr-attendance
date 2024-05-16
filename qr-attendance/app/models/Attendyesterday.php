<?php

class Attendyesterday extends Model
{
  public function save()
  {
      $data = [
          'studentName' => $this->studentName,
          'studentCS' => $this->studentCS,
          'timeIn' => $this->timeIn,
          'qr' => $this->qr

      ];

      $this->insert($data);
  }
}