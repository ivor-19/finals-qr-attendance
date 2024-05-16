<?php include PATH . "partials/header.php" ?>

<!--Add Modal-->
<div class="modal fade" id="confirmAddModal" tabindex="-1" aria-labelledby="confirmAddModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-show="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmAddModalLabel">Add Student</h5>
        <button type="button" class="btn-close closeBtn" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body modalBody">
        <?php if (isset($_SESSION['error'])): ?>
          <!-- Error Message -->
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['error']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <form id="" action="<?= ROOT ?>/users/create"  method="POST" style="display: inline;">
            <div class="modalLabel">
                <label for="">Student ID</label>
                <input id = "txtID" name="studentID" type="text" class="form-control">
            </div>
            <div class="modalLabel">
                <label for="">Student Name</label>
                <input id = "txtName" name="studentName" type="text" class="form-control">
            </div>
            <div class="modalLabel">
                <label for="">Course & Section</label>
                <input id = "txtCS" name="studentCS" type="text" class="form-control">
            </div>
            <button type="button" class="btn btn-secondary form-control qrBtn">Generate QR Code</button>

            <div class="qr-con text-center" style="display: none;">
                <input type="hidden" class="form-control" id="qr" name="qr">
                <p>Take a pic with your qr code.</p>
                <img class="mb-4" src="" id="qrImg" alt="">
            </div>
            <div class="modal-footer modal-close" style="display: none;">
                <button type="button" class="btn btn-secondary closeBtn" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-dark">Add Student</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="con">
  <div class="wrapper">
      <div class="t">
          <div class="box-title d-flex justify-content-between align-items-center">
                <h2>List of Users</h2>
                <div>
                    <a href="<?= ROOT ?>/users/archive" class="btn btn-primary">Archive</a>
                    <!--<a href=/users/create" class="btn btn-primary">Add New</a>-->
                    <button type="button" class="btn btn-primary addBtn" data-bs-toggle="modal" data-bs-target="#confirmAddModal">Add New</button>
                </div>

          </div>
          <hr>
          <div class = "contenttable">
              <table class ="ttable"id="usersTable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Course & Section</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($users != null) { ?>
                    <?php foreach ($users as $item) { ?>
                      <tr>
                        <td id="hiddenID"><?= $item->id ?></td>
                        <td id = "studentID"><?= $item->studentID ?></td>
                        <td id = "studentName"><?= $item->studentName ?></td>
                        <td id = "studentCS"><?= $item->studentCS ?></td>
                        <td>
                          <button type="button" class="qrBtn" data-bs-toggle="modal" data-bs-target="#qrCodeModal<?= $item->id ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-qr-code"><rect width="5" height="5" x="3" y="3" rx="1"/><rect width="5" height="5" x="16" y="3" rx="1"/><rect width="5" height="5" x="3" y="16" rx="1"/><path d="M21 16h-3a2 2 0 0 0-2 2v3"/><path d="M21 21v.01"/><path d="M12 7v3a2 2 0 0 1-2 2H7"/><path d="M3 12h.01"/><path d="M12 3h.01"/><path d="M12 16v.01"/><path d="M16 12h1"/><path d="M21 12v.01"/><path d="M12 21v-1"/></svg>
                          </button>
                          <button type="button" class="editBtn" data-bs-toggle="modal" data-bs-target="#confirmEditModal<?= $item->id ?>" data-userid="<?= $item->id ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4Z"/></svg>
                          </button>
                          <button type="button" class="deleteBtn" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal<?= $item->id ?>" data-userid="<?= $item->id ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                          </button>

                          <!--QR Modal-->
                          <div class="modal fade" id="qrCodeModal<?= $item->id ?>" tabindex="-1" aria-labelledby="qrCodeModalLabel" aria-hidden="true" data-bs-backdrop="static">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><?= $item->studentName ?>'s QR Code</h5>
                                        <button type="button" class="btn-close closeBtn" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= $item->qr ?>" alt="" width="300">
                                    </div>
                                    <div class="modal-footer">

                                    </div>
                                </div>
                            </div>
                          </div>

                          <!--Edit Modal-->
                          <div class="modal fade" id="confirmEditModal<?= $item->id ?>" tabindex="-1" aria-labelledby="confirmEditModalLabel" aria-hidden="true" data-bs-backdrop="static">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="confirmEditModalLabel">Edit Student</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form id="editForm" action = '<?= ROOT ?>/users/edit/<?= $item->id ?>' method="POST" style="display: inline;">
                                  <div class="modal-body modalBody">
                                    <div class = "modalLabel">
                                      <label for = "studentID">Student ID</label>
                                        <input name="studentID" id = "studentID" type="text" value="<?= $item->studentID ?>" class="form-control">
                                    </div>
                                    <div class = "modalLabel">
                                      <label for = "studentName">Name</label>
                                        <input name="studentName" id = "studentName" type="text" value="<?= $item->studentName ?>" class="form-control">
                                    </div>
                                    <div class = "modalLabel">
                                      <label for = "studentCS">Course & Section</label>
                                        <input name="studentCS" id = "studentCS" type="text" value="<?= $item->studentCS ?>" class="form-control">
                                    </div>
                                  </div>
                                  <div class="modal-footer">                                     
                                    <button type="submit" class="btn btn-dark btn-sm">Edit</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>

                          <!--Delete Modal-->
                          <div class="modal fade" id="confirmDeleteModal<?= $item->id ?>" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true" data-bs-backdrop="static">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body modalBody">
                                  <div class = "modalLabel">
                                    <label for = "studentID">Student ID</label>
                                      <input name="studentID" id = "studentID" type="text" value="<?= $item->studentID ?>" class="form-control" disabled>
                                  </div>
                                  <div class = "modalLabel">
                                    <label for = "studentName">Name</label>
                                      <input name="studentName" id = "studentName" type="text" value="<?= $item->studentName ?>" class="form-control" disabled>
                                  </div>
                                  <div class = "modalLabel">
                                    <label for = "studentCS">Course & Section</label>
                                      <input name="studentCS" id = "studentCS" type="text" value="<?= $item->studentCS ?>" class="form-control" disabled>
                                  </div>
                                </div>
                                <div class="modal-footer">
                            
                                  <input type="hidden" name="userId" id="userId">
                                  
                                  <form id="deleteForm" action = '<?= ROOT ?>/users/delete123/<?= $item->id ?>' method="POST" style="display: inline;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    <?php } ?>
                  <?php } else { ?>
                    <tr>
                      <td colspan="3">
                        <h3>No record found.</h3>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
          </div>
          
      </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Data Table -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function() {
      // Initialize DataTable
      var table = $('#usersTable').DataTable();

      // Reverse the order of the rows
      table.order([0, 'desc']).draw();
    });
    $(document).ready(function(){
      // Show the modal
      $('#confirmAddModal').modal('show');
    });
  
  // Event listener for delete buttons
  /*
  document.querySelectorAll('.deleteBtn').forEach(button => {
    button.addEventListener('click', function() {
      const userId = this.getAttribute('data-userid');
      const row = this.closest('tr'); // Get the closest parent tr element
      const studentID = row.querySelector('#studentID').innerText;
      const studentName = row.querySelector('#studentName').innerText;
      const studentCS = row.querySelector('#studentCS').innerText;

      document.getElementById('userId').value = userId;
      document.getElementById('studID').value = studentID;
      document.getElementById('studName').value = studentName;
      document.getElementById('studCS').value = studentCS;
      
      document.getElementById('deleteForm').action = '<?= ROOT ?>/users/delete123/' + userId;
    });
  });
  */
  //For Closing/Resetting
  const closeBtn = document.querySelector('.closeBtn');
  closeBtn.addEventListener('click', function(){
      document.querySelector('.modal-close').style.display = 'none';
      document.querySelector('.qr-con').style.display = 'none';
      qrBtn.style.display = 'block';

      document.getElementById('txtID').value = '';
      document.getElementById('txtName').value = '';
      document.getElementById('txtCS').value = '';
  });
//For QR Code
    const qrBtn = document.querySelector('.qrBtn');

    function generateRandomCode(length) {
        const characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        let randomString = '';

        for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * characters.length);
            randomString += characters.charAt(randomIndex);
        }

        return randomString;
    }
    qrBtn.addEventListener('click', function(){
      const qrImg = document.getElementById('qrImg');

      let text = generateRandomCode(10);
      // Update the value of the hidden input
      document.getElementById('qr').value = text;

      if (text === "") {
          alert("Please enter text to generate a QR code.");
          return;
      } else {
          const apiUrl = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(text)}`;

          qrImg.src = apiUrl;
          // Show related elements
          document.querySelector('.modal-close').style.display = 'block';
          document.querySelector('.qr-con').style.display = 'block';
          qrBtn.style.display = 'none'; 
      }
    });
</script>
<style>
    *{
    font-family: "Karla", sans-serif;
}
.con{
    margin-top: 10px;
}
.wrapper{  
    margin: 0 auto;
    max-width: 90%;
    width: 100%;

}
.box-title{ 

    padding: 10px 0;
}

/*for table design*/
table{
    border-collapse: collapse;   
    font-size: 0.9em;
    width: 900px;
    margin-bottom: 100px;
}
thead{
    position: sticky;
    top: 0px;
    background-color: #272e44;
    color: #fff;
}

.ttable tbody tr:nth-of-type(even){
    background-color: #f4f4f4b6;
}
/*
.ttable tbody tr:hover{
    background-color: #f3f3f3;
}
*/
.t{
    border-bottom: 4px solid #272e44;
    background-color: white;
    box-shadow: 0px 10px 20px #d9d9d9;        
    border-radius: 15px;
    padding: 10px;
    min-height: 750px;
}
.contenttable{
    height: 630px;
    overflow-y: auto;
}



.outside-main{
    margin-top: 14px;
    height: 100%;
}
.inner-main{
    margin: 0 auto;
    max-width: 90%;
    width: 100%;
}



.content{
    padding: 30px 20px;
    height: 750px;
    display: grid;
    grid-template-columns: 1fr 600px;
   
}
.content-camera{
    background-color: rgba(24, 24, 24, 0.832);
    min-height: 100%;

}
.content-table{
    margin: 0px 20px;
}
.modalBody{
    padding: 10px;
}
.modalLabel{
    margin-bottom: 15px;
}
.modalLabel label{
    font-weight: 500;
}

/*Button*/
.qrBtn{
    background-color: rgb(23, 78, 216);
    height: 30px;
    width: 40px;
    border: none;
    border-radius: 5px;
}
.editBtn{
    background-color: rgb(68, 12, 197);
    height: 30px;
    width: 40px;
    border: none;
    border-radius: 5px;
}

.deleteBtn{
    background-color: crimson;
    height: 30px;
    width: 40px;
    border: none;
    border-radius: 5px;
}
</style>
<?php include PATH . "partials/footer.php" ?>