<?php

class Archive extends Model
{
    protected $table = 'archives';

    public function get($id)
    {
        return $this->first(['id' => $id]);
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
            'tikmeIN' => $this->tikmeIN
            // Add more columns if necessary
        ];

        $this->insert($data);
    }
}