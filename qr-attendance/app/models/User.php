<?php

class User extends Model
{
  public function validate($data)
  {
      $this->errors = [];
      if (isset($data['studentID'])) {
          $existingStudent = $this->where(['studentID' => $data['studentID']]);
          if ($existingStudent) {
              $this->errors['studentID'] = 'Student ID already exists.';
          }
      }
      if (count($this->errors) == 0) {
        return true;
      }
      return false;
  }
  public function validateQR($data)
  {
      $this->errors = [];
      if (isset($data['qr'])) {
          $exists = $this->where(['qr' => $data['qr']])->exists();
          if (!$exists) {
              $this->errors['qr'] = 'Student Does Not Exist';
          }
      }
      if (count($this->errors) == 0) {
        return true;
      }
      return false;
  }
  public function save()
    {
        $data = [
            //this represents the table column name
            //'studentID' means variable na gagamitin
            //$this->studentID means yung table column name
            'studentID' => $this->studentID,
            'studentName' => $this->studentName,
            'studentCS' => $this->studentCS,
            'qr' => $this->qr,
            // Add more columns if necessary
        ];

        $this->insert($data);
    }
}