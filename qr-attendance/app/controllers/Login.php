<?php

class Login extends Controller
{
  public function index()
  {
    $admin = new Admin();
    if (count($_POST) > 0) {
        $arr['adminEmail'] = $_POST['adminEmail'];
        $adminPassword = $_POST['adminPassword'];
    
        // Check if email or password is empty
        if (empty($arr['adminEmail']) || empty($adminPassword)) {
            $_SESSION['errorBlank'] = true;
        } 
        else {
            $row = $admin->first($arr);
    
            /*with encryption
            if (password_verify($adminPassword, $row->password)) {
                Auth::authenticate($row);
                redirect('home');
            } else {
                $errors['errors'] = 'Email or Password is invalid';
            }
            */
    
            if ($row) {
                if ($adminPassword == $row->adminPassword) {
                    Auth::authenticate($row);
                    redirect('home');
                } else {
                    $_SESSION['errorEmailorPass'] = true;
                }
            } else {
                $_SESSION['errorEmailorPass'] = true;
            }
        }
    } 

    $this->view('login');
  }
}