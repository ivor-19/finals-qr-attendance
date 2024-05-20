<?php
date_default_timezone_set('Asia/Manila');

class Users extends Controller
{
  public function index()
  {
    if (!Auth::logged_in()) {
      redirect('login');
    }

    $x = new User();
    $rows = $x->findAll();

    $this->view('users/index', [
      'users' => $rows
    ]);
  }
  public function create()
  {
    $errors = [];
    $x = new User();

    if (count($_POST) > 0){
        if ($x->validate($_POST)){

            $x->insert($_POST);
            redirect('users');

        }else{
            $_SESSION['errors'] = $x->errors;
            redirect('users');
        }
        
    }
  }

  public function edit($id)
  {
    $x = new User();
    $arr['id'] = $id;
    $row = $x->first($arr);

    if (count($_POST) > 0) {

      $x->update($id, $_POST);

      redirect('users');
    }

    $this->view('users/edit', [
      'user' => $row
    ]);
  }

  public function delete123($id)
  {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          // Retrieve user data before deletion
          $x = new User();
          $user = $x->first(['id' => $id]);
          $timeIn = date("Y-m-d h:i:s A");
          // Check if user exists
          if ($user) {
              // Insert user data into the archive table
              $archive = new Archive();
              $archive->studentID = $user->studentID;
              $archive->studentName = $user->studentName;
              $archive->studentCS = $user->studentCS;
              $archive->qr = $user->qr;
              $archive->tikmeIN = $timeIn;

              /*meaning neto - yung data ni qr, malalagay both sa table column na qr and tikmeIN
                table column - $archive->qr

                $archive->qr = $user->qr;
                $archive->tikmeIN = $user->qr;
              */

              $archive->save();

              // Delete the user from the original table using custom Model's delete method
              $userModel = new User();
              $userModel->delete($id);
          }
  
          redirect('users');
      } else {
          // Handle other cases, such as displaying a confirmation page
      }
  }

  public function archive(){
    $x = new Archive();
    $rows = $x->findAll();

    $this->view('users/archive', [
      'archives' => $rows
    ]);
  }
  public function archiveDelete($id){
    $x = new Archive();
    $arr['id'] = $id;
    $row = $x->first($arr);

    if ($_SERVER["REQUEST_METHOD"] === "POST") { // Check if request method is POST

        $x->delete($id);

        redirect('users/archive');
        exit; // Add exit to prevent further execution
    }

    $this->view('users/archive', [
      'archives' => $row
    ]);
  }
  public function retrieveUser($id){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Retrieve user data before deletion
      $x = new Archive();
      $archive = $x->first(['id' => $id]);
      
      // Check if user exists
      if ($archive) {
          // Insert user data into the archive table
          $user = new User();
          $user->studentID = $archive->studentID;
          $user->studentName = $archive->studentName;
          $user->studentCS = $archive->studentCS;
          $user->qr = $archive->qr;
     

          /*meaning neto - yung data ni qr, malalagay both sa table column na qr and tikmeIN
            table column - $archive->qr

            $archive->qr = $user->qr;
            $archive->tikmeIN = $user->qr;
          */
          
          $user->save();

          
          $archiveModel = new Archive();
          $archiveModel->delete($id);
          
         
      }
      
      redirect('users/archive');
    } else {
      
    }
  }
}


 /*
      $deleted_row = $x->get($id);

      $x->delete($id);

      $userTable = new User();
*/

/*
public function create()
  {
    $x = new User();

    // Check if the studentID already exists
    $existingStudent = $x->where(['studentID' => $_POST['studentID']]);

    if ($existingStudent) {
        // If the studentID already exists, set the error message and indicate to show the modal
        $_SESSION['error'] = 'Student ID already exists.';
        $showModal = true;
        header("Location: users");
        exit();
    } else {
        // If validation passes and the studentID doesn't exist, insert the new user into the database
        $x->insert($_POST);
        $showModal = false;
        redirect('users');
    }

    // Pass the $showModal variable to the view
    
  }

  */