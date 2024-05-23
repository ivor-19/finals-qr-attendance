<?php
date_default_timezone_set('Asia/Manila');

class Home extends Controller {

    public function index() 
    {
        if (!Auth::logged_in()) {
            redirect('login');
        }

        $attendance = new Attendance();
        $rows = $attendance->findAll();

        $allotedDates = new Alloteddate();
        $date = $allotedDates->getDistinctDates('date');
        $currentDate = date("m-d-Y");
        $dateExists = $allotedDates->first(['date' => $currentDate]);

        if (!$dateExists) {
            $allotedDates->date = $currentDate;
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
            'date' => $date
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
        } 
        else {
            // Handle other cases
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
          $dateExists = $allotedDate->first(['date' => $currentDate]);
  
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
                  else {
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
      }
       /*
        $userExists = $user->first(['qr' => $qr_code]);


        if ($userExists) {
            $currentDate = date("m-d-Y");
            $dateExists = $allotedDate->first(['date' => $currentDate]);

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
  
  public function deleteAllAttendance() 
  {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $selectedDate = $_POST['selectedDate'];
          $attendance = new Attendance();
          $allotedDates = new Alloteddate();
          $currentDate = date('m-d-Y');

          if ($selectedDate !== 'All') {
              if ($selectedDate !== $currentDate) {
                  $attendance->deleteByDate($selectedDate);
                  $allotedDates->deleteByDate($selectedDate);
              } 
              else {
                  $attendance->deleteByDate($selectedDate);
                  $attendance->studentName = '-';
                  $attendance->studentCS = '-';
                  $attendance->date = $selectedDate;
                  $attendance->timeIn = '-';
                  $attendance->qr = '-';
                  $attendance->save();
              }

              redirect('home');
          } 
          else {
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

  public function exportExcel() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $selectedDate2 = $_POST['selectedDate2'];
            $output = '';
            $attendance = new Attendance();
            $allotedDates = new Alloteddate();
            $currentDate = date('m-d-Y');

            $rows = $attendance->findAll();

            if ($selectedDate2 !== 'All') {
                $filteredRows = array_filter($rows, function($row) use ($selectedDate2) {
                    return $row->date === $selectedDate2;
                });
            } else {
                $filteredRows = $rows;
            }

            if (count($filteredRows) > 0) {
                $output .= '<table class="table" bordered="1">
                    <tr>
                        <th>Name</th>
                        <th>Course & Section</th>
                        <th>Date</th>
                        <th>Time In</th>
                    </tr>';

                foreach ($filteredRows as $row) {
                    $output .= '<tr>
                        <td>' . $row->studentName . '</td>
                        <td>' . $row->studentCS . '</td>
                        <td>' . $row->date . '</td>
                        <td>' . $row->timeIn . '</td>
                    </tr>';
                }
                $output .= '</table>';

                $filename = ($selectedDate2 === 'All' ? 'student_attendance_all' : 'student_attendance_' . $selectedDate2) . '.xls';
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment; filename="' . $filename . '"');
                echo $output;
            } else {

                redirect('home');
            }
        }
        
    }

}
