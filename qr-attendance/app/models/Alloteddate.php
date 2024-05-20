<?php

class Alloteddate extends Model
{
    public function save()
    {
        $data = [
            'date' => $this->date
        ];
        $this->insert($data);
    }
}
