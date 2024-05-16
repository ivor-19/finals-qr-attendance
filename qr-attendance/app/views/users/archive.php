<?php include PATH . "partials/header.php" ?>

<div class="con">
  <div class="wrapper">
      <div class="t">
          <div class="box-title d-flex justify-content-between align-items-center">
                <h2>Archive</h2>
                <div>
                  <a href="<?= ROOT ?>/users" class="btn btn-primary">Back</a>
                </div>

          </div>
          <hr>
          <div class = "contenttable">
              <table id="archiveTable">
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
                  <?php if ($archives != null) { ?>
                    
                    <?php foreach ($archives as $item) { ?>
                      <tr>
                        <td id="hiddenID"><?= $item->id ?></td>
                        <td id = "studentID"><?= $item->studentID ?></td>
                        <td id = "studentName"><?= $item->studentName ?></td>
                        <td id = "studentCS"><?= $item->studentCS ?></td>
                        <td class = "d-flex gap-2">
                          <form action="<?= ROOT ?>/users/retrieveUser/<?= $item->id ?>" method="post">   
                            <button type="submit" class="btn btn-primary btn-sm retrieveBtn">Retrieve</button>
                          </form>

                          <button type="button" class="deleteBtn" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal<?= $item->id ?>" data-userid="<?= $item->id ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                          </button>

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
                                  
                                  <form id="deleteForm" action = '<?= ROOT ?>/users/archiveDelete/<?= $item->id ?>' method="POST" style="display: inline;">
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
      var table = $('#archiveTable').DataTable();

      // Reverse the order of the rows
      table.order([0, 'desc']).draw();
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
    background-color: #634059;
    color: #fff;
}
table tbody tr:nth-of-type(even){
    background-color: #f0f0f0b6;
}

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