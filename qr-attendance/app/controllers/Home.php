<?php
date_default_timezone_set('Asia/Manila');

class Home extends Controller
{
  public function index()
  {

    $attendance = new Attendance();
    $rows = $attendance->findAll();

    $allotedDates = new Alloteddate();
    $dates = $allotedDates->getDistinctDates('dates');

    $currentDate = date("m-d-Y");
    $dateExists = $allotedDates->first(['dates' => $currentDate]);
    
    if(!$dateExists){
      $allotedDates->dates = $currentDate;
      $allotedDates->save();

      $attendance->studentName = '-';
      $attendance->studentCS = '-';
      $attendance->date = $currentDate;
      $attendance->timeIn = '-';
      $attendance->qr = '-';
      $attendance->save();
    }
    
    $this->view('home/index', [
        'attendances' => $rows,
        'dates' => $dates
    ]);
  }
  public function yesterday()
  {
    $x = new Attendyesterday();
    $rows = $x->findAll();

    $this->view('home/yesterday', [
      'attendances' => $rows
    ]);
  }

  public function attendanceDelete($id)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {      
      $x = new Attendance();
      $x->delete($id);
      redirect('home');
    } else {
      // Handle other cases, such as displaying a confirmation page
    }
  }
  public function addAttendance()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $qr_code = $_POST['qr_code'];
        $user = new User();
        $attendance = new Attendance();
        $allotedDate = new AllotedDate();

        $currentDate = date("m-d-Y");
        $dateExists = $allotedDate->first(['dates' => $currentDate]);

        if ($dateExists) {
          $userExists = $user->first(['qr' => $qr_code]);
          
          if ($userExists) {
              $attendanceExists = $attendance->first([
                  'qr' => $qr_code,
                  'date' => $currentDate
              ]);

              if (!$attendanceExists) {
                  $attendance->studentName = $userExists->studentName;
                  $attendance->studentCS = $userExists->studentCS;
                  $attendance->date = $currentDate;
                  $attendance->timeIn = date("h:i:s A");
                  $attendance->qr = $userExists->qr;
                  $attendance->save();
                  redirect('home');
              } 
              else{
                $_SESSION['errorsStudentRecorded'] = ['qr' => ''];
                redirect('home');
              }
          } 
          else {
            $_SESSION['errorsDoesNotExists'] = ['qr' => ''];
            redirect('home');
          }
        } 
        else {
          $_SESSION['errorsCreateNewDate'] = ['qr' => ''];
          redirect('home');
        }
        /*
        $userExists = $user->first(['qr' => $qr_code]);


        if ($userExists) {
            $currentDate = date("m-d-Y");
            $dateExists = $allotedDate->first(['dates' => $currentDate]);

            if ($dateExists) {
                $attendanceExists = $attendance->first([
                    'qr' => $qr_code,
                    'date' => $currentDate
                ]);

                if (!$attendanceExists) {
                    $attendance->studentName = $userExists->studentName;
                    $attendance->studentCS = $userExists->studentCS;
                    $attendance->date = $currentDate;
                    $attendance->timeIn = date("h:i:s A");
                    $attendance->qr = $userExists->qr;
                    $attendance->save();
                    redirect('home');
                } 
                else{
                  $_SESSION['errorsStudentRecorded'] = ['qr' => ''];
                  redirect('home');
                }
            } 
            else {
              $_SESSION['errorsCreateNewDate'] = ['qr' => ''];
              redirect('home');
            }
        } 
        else {
          $_SESSION['errorsDoesNotExists'] = ['qr' => ''];
          redirect('home');
        }
        */
    }
  }
  public function deleteAllAttendance(){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {      
      $selectedDate = $_POST['selectedDate'];
      $attendance = new Attendance();

      if($selectedDate !== 'All'){
        //deleting all row in that specific date
        
        $attendance->deleteByDate($selectedDate);

        $attendance->studentName = '-';
        $attendance->studentCS = '-';
        $attendance->date = $selectedDate;
        $attendance->timeIn = '-';
        $attendance->qr = '-';
        $attendance->save();
        redirect('home');
      }
      else{
        $attendance = new Attendance();
        $attendance->deleteAll();

        $attendance->studentName = '-';
        $attendance->studentCS = '-';
        $attendance->date = date('m-d-Y');
        $attendance->timeIn = '-';
        $attendance->qr = '-';
        $attendance->save();
        redirect('home');
      }
    }
  }
  /* Optional Button Create
  public function createNewDate(){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {     
      $allotedDate = new AllotedDate();
      $attendance = new Attendance();

      $currentDate = date("m-d-Y");
      $dateExists = $allotedDate->first(['dates' => $currentDate]);
      
      if(!$dateExists){
        $allotedDate->dates = $currentDate;
        $allotedDate->save();

        $attendance->studentName = '-';
        $attendance->studentCS = '-';
        $attendance->date = $currentDate;
        $attendance->timeIn = '-';
        $attendance->qr = '-';
        $attendance->save();

        redirect('home');
      }
      else{
        $_SESSION['errors2'] = ['dates' => ''];
        redirect('home');
      }
    }
  }
  */  
}
