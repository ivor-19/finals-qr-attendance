<?php

class Yesterday extends Controller
{
  public function index()
  {
    $x = new Attendyesterday();
    $rows = $x->findAll();

    $this->view('yesterday', [
      'attendances' => $rows
    ]);
  }
  public function yesterdayDelete($id)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {      
      $x = new Attendyesterday();
      $x->delete($id);
      redirect('home/yesterday');
    } else {
      // Handle other cases, such as displaying a confirmation page
    }
  }
}