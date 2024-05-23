/*
      $output = '';
      $attendance = new Attendance();
      $rows = $attendance->findAll();
  
      if (count($rows) > 0) {
          $output .= '<table class="table" bordered="1">
              <tr>
                  <th>Name</th>
                  <th>Course & Section</th>
                  <th>Date</th>
                  <th>Time In</th>
              </tr>';
  
          $count = 1;
          foreach ($rows as $row) {
              $output .= '<tr>
                  <td>' . $row->studentName . '</td>
                  <td>' . $row->studentCS . '</td>
                  <td>' . $row->date . '</td>
                  <td>' . $row->timeIn . '</td>
              </tr>';
              $count++;
          }
          $output .= '</table>';
  
          // Create a new mPDF instance
          $mpdf = new Mpdf();
  
          // Write the HTML content to the PDF
          $mpdf->WriteHTML($output);
  
          // Output the PDF file
          $mpdf->Output('attendance_report.pdf', 'D');
      } 
      else {
     
      }
      */