<?php

class Login extends Controller
{
  public function index()
  {
    $admin = new Admin();
    if (count($_POST) > 0) {
        $arr['adminEmail'] = $_POST['adminEmail'];
        $row = $admin->first($arr);

         /*with encryption
            if (password_verify($_POST['password'], $row->password)) {

                Auth::authenticate($row);
                redirect('home');
                } else {
                    $errors['errors'] = 'Email or Password is invalid';
                }
                } else {
                $errors['errors'] = 'Email or Password is invalid';
            }
        */
        if ($row) {
            if ($_POST['adminPassword'] == $row->adminPassword) {
                Auth::authenticate($row);
                redirect('home');
            } else {
                $_SESSION['errorEmailorPass'] = true;
            }
        } 
        else {
            $_SESSION['errorEmailorPass'] = true;
        }
    }

    $this->view('login');
  }
}