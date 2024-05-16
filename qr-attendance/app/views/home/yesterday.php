<?php include PATH . "partials/header.php" ?>

<div class = "outside-main">
    <?php if (isset($_SESSION['errors']) && is_array($_SESSION['errors'])): ?>
        <div id="addErrorMsg" class="alert alert-warning alert-dismissible fade show addErrorMsg" role="alert" style = "display:'block';">Student Does Not Exists.
            
            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['errors']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['errors1']) && is_array($_SESSION['errors1'])): ?>
        <div id="addErrorMsg" class="alert alert-warning alert-dismissible fade show addErrorMsg" role="alert" style = "display:'block';">Student attendance has already been recorded.
            
            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['errors1']); ?>
    <?php endif; ?>
   <div class="inner-main">
      <section class="content">
        <section class="content-camera">
          <h5 class="text-center">Scan your QR Code here for your attendance</h5>
          <div class="scanner-con">
              <video id="interactive" class="viewport">
          </div>

          <button class = "on-off-cam">Off Camera</button>
        </section>
        <section class="content-table">
            <section class = "sortBtns">
              <?php include PATH . "partials/sortBtn.php" ?>
            </section>
            <table class="table table-striped mt-3">
              <tr>
                <th>Name</th>
                <th>Course & Section</th>
                <th>Time In</th>
                <th>Action</th>
              </tr>
              <?php if ($attendances != null) { ?>
                <?php foreach ($attendances as $item) { ?>
                  <tr>
                  <?php if ($item->studentName === "-" && $item->studentCS === "-" && $item->timeIn === "-") { ?>
                      <td><?= $item->studentName ?></td>
                      <td><?= $item->studentCS ?></td>
                      <td><?= $item->timeIn ?></td>
                      <td>-</td> <!-- Displaying "-" instead of action button -->
                    

                      <div class="qr-detected-container" style="display: none;">
                        <form id = "attendance-form"action="<?= ROOT ?>/home/addAttendance/" method="POST">
                            <input type="hidden" id="detected-qr-code" name="qr_code"> 
                                                   
                        </form>
                      </div>
                  <?php } else { ?>
                      <td><?= $item->studentName ?></td>
                      <td><?= $item->studentCS ?></td>
                      <td><?= $item->timeIn ?></td>
                    <td>
                      <button type="button" class="deleteBtn" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal<?= $item->id ?>" data-userid="<?= $item->id ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                      </button>

                      <!--Delete Modal-->
                      <div class="modal fade" id="confirmDeleteModal<?= $item->id ?>" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Are you sure you want to delete this attendance?
                              <div class = "mt-2">
                                <label for = "studentName">Name</label>
                                  <input name="studentName" id = "studentName" type="text" value = "<?= $item->studentName ?>" class="form-control" disabled>
                              </div>
                              <div class = "mt-2">
                                <label for = "studentCS">Course & Section</label>
                                  <input name="studentCS" id = "studentCS" type="text" value = "<?= $item->studentCS ?>" class="form-control" disabled>
                              </div>
                              <div class = "mt-2">
                                <label for = "timeIn">Time In</label>
                                  <input name="timeIn" id = "timeIn" type="text" value = "<?= $item->timeIn ?>" class="form-control" disabled>
                              </div>
                            </div>
                            <div class="modal-footer">
                        
                              <input type="hidden" name="userId" id="userId">
                              
                              <form id="deleteForm" action = '<?= ROOT ?>/yesterday/yesterdayDelete/<?= $item->id ?>' method="POST" style="display: inline;">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="qr-detected-container" style="display: none;">
                        <form id = "attendance-form"action="<?= ROOT ?>/home/addAttendance/" method="POST">
                            <input type="hidden" id="detected-qr-code" name="qr_code"> 
                                                   
                        </form>
                      </div>
                    </td>
                    <?php }?>
                  </tr>
                  
                <?php } ?>
              <?php } else { ?>
                <tr>
                  <td colspan="3">
                    <h3>No record found.</h3>
                  </td>
                </tr>
              <?php } ?>
            </table>
        </section>
      </section>
   </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

<!-- instascan Js -->
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

<script>
    let scanner;
    let cameraOn = false;
    function startScanner() {
        scanner = new Instascan.Scanner({ video: document.getElementById('interactive') });

        scanner.addListener('scan', function (content) {
            document.getElementById("detected-qr-code").value = content;
            console.log(content);
            scanner.stop();
            //document.querySelector(".qr-detected-container").style.display = '';
            //document.querySelector(".scanner-con").style.display = 'none';
            

            document.getElementById("attendance-form").submit();

        });

        Instascan.Camera.getCameras()
            .then(function (cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                    cameraOn = true;
                } else {
                    console.error('No cameras found.');
                    alert('No cameras found.');
                }
            })
            .catch(function (err) {
                console.error('Camera access error:', err);
                alert('Camera access error: ' + err);
            });
    }


    document.addEventListener('DOMContentLoaded', startScanner);

    const onOff = document.querySelector('.on-off-cam');
    onOff.addEventListener('click', function(){
      if (onOff.textContent === 'Off Camera') {
        scanner.stop();
        cameraOn = false;
        onOff.textContent = 'On Camera';
       
      } else {
        startScanner();
        onOff.textContent = 'Off Camera';
        
      }
    });

    

</script>


<style>
.lastWeekBtn,
.yesterdayBtn,
.todayBtn{
    font-size: 14px;
    border: 0;
    border-radius: 5px;
    padding: 2px 8px;
    cursor: pointer;
    background-color: #F2EAFD;
    color: #9253C3;
}
.yesterdayBtn{
    background-color: #8200FF;
    color: #fff;
}
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



.content {
    padding: 30px 20px;
    height: 750px;
    display: grid;
    grid-template-columns: 1fr 600px;
}
.on-off-cam{
    margin: 5px 0;
    cursor: pointer;
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 15px;
}

.content-camera {
    border-radius: 12px;
    min-height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 12px;
    background-color: #d9d9d9;
}

.scanner-con {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.viewport{
    width: 100%;
    height: 100%;
    object-fit: cover;
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

.sortBtns{
    display: flex;
    justify-content: flex-end;
    gap: 8px;
}

@media (max-width: 1151px){
    .content{
        all: unset;
        display: grid;
        grid-template-rows: 1fr 40%;
        background-color: bisque;
        min-height: 100%;
        height: 750px;
    }
}
</style>
<?php include PATH . "partials/footer.php" ?>