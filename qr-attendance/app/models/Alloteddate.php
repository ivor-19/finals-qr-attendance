<?php

class Alloteddate extends Model
{
    public function save()
    {
        $data = [
            'dates' => $this->dates
        ];
        $this->insert($data);
    }
}
