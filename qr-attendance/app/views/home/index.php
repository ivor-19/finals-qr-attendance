<?php include PATH . "partials/header.php" ?>
<head>
    <link rel="stylesheet" type="text/css" href="../css/attendance.css?v=<?php echo time(); ?>">
</head>

<div class="outside-main">
    <?php
    // Display error messages
    if (isset($_SESSION['errorsDoesNotExists']) && is_array($_SESSION['errorsDoesNotExists'])): ?>
        <div id="addErrorMsg" class="alert alert-warning alert-dismissible fade show addErrorMsg" role="alert" style="display:'block';">
            Student Does Not Exists.
            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['errorsDoesNotExists']);
    endif;

    if (isset($_SESSION['errorsStudentRecorded']) && is_array($_SESSION['errorsStudentRecorded'])): ?>
        <div id="addErrorMsg" class="alert alert-warning alert-dismissible fade show addErrorMsg" role="alert" style="display:'block';">
            Student attendance has already been recorded.
            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['errorsStudentRecorded']);
    endif;

    if (isset($_SESSION['errorsCreateNewDate']) && is_array($_SESSION['errorsCreateNewDate'])): ?>
        <div id="addErrorMsg" class="alert alert-warning alert-dismissible fade show addErrorMsg" role="alert" style="display:'block';">
            Current request is not available. Please add a new date.
            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['errorsCreateNewDate']);
    endif;

    if (isset($_SESSION['errors2']) && is_array($_SESSION['errors2'])): ?>
        <div id="addErrorMsg" class="alert alert-warning alert-dismissible fade show addErrorMsg" role="alert" style="display:'block';">
            Date has already been created.
            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['errors2']);
    endif; ?>

    <div class="inner-main">
        <section class="content">
            <section class="content-camera">
                <h5 class="text-center">Scan your QR Code here for your attendance</h5>
                <div class="scanner-con">
                    <video id="interactive" class="viewport"></video>
                </div>
                <button class="on-off-cam">Off Camera</button>
            </section>

            <section class="contenttable">
                <section class="conHead">
                    <section class="left">
                        <section>
                            <select class="form-select" id="dateSelect" onchange="filterTableByDate()">
                                <?php foreach ($date as $dates): ?>
                                    <option class="dateOption"><?= $dates->date ?></option>
                                <?php endforeach; ?>
                            </select>
                        </section>
                        <section>
                            <!-- Create A New Date (Optional)
                            <div class="createNewDate" style="display:none;">
                                <form id="createDateForm" action="<?= ROOT ?>/home/createNewDate" method="POST" style="display: inline;">
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-plus"><path d="M8 2v4" /><path d="M16 2v4" /><path d="M21 13V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h8" /><path d="M3 10h18" /><path d="M16 19h6" /><path d="M19 16v6" /></svg>
                                        <span>Create New</span>
                                    </button>
                                </form>
                            </div>
                            -->
                        </section>
                    </section>
                    <section class="right">
                        <div class="attendanceSearch">
                            <input class="txtSearch" id="txtSearch" type="text" placeholder="Search">
                        </div>
                    </section>
                </section>
                <section class="wrapTable">
                  <table class="ttable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Course &amp; Section</th>
                            <th>Date</th>
                            <th>Time In</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php if ($attendances != null) { ?>
                          <?php foreach ($attendances as $item) { ?>
                              <tr>
                                  <?php
                                    $currentDate = date('m-d-Y');
                                    $isNotCurrentDate = ($item->date != $currentDate);
                                  ?>
                                  <?php if ($item->studentName === "-" || $item->studentCS === "-" || $item->date === "-" || $item->timeIn === "-") { ?>
                                      <td class="dateDivider"><?= $item->studentName ?></td>
                                      <td class="dateDivider"><?= $item->studentCS ?></td>
                                      <td class="dateDivider"><?= $item->date ?></td>
                                      <td class="dateDivider"><?= $item->timeIn ?></td>
                                      <td class="dateDivider">-</td>

                                      <div class="qr-detected-container" style="display: none;">
                                          <form id="attendance-form" action="<?= ROOT ?>/home/addAttendance/" method="POST">
                                              <input type="hidden" id="detected-qr-code" name="qr_code">
                                          </form>
                                      </div>
                                  <?php } else { ?>
                                      <td class="studCol empty"><?= $item->studentName ?></td>
                                      <td><?= $item->studentCS ?></td>
                                      <td><?= $item->date ?></td>
                                      <td><?= $item->timeIn ?></td>
                                      <td>
                                          <?php if ($isNotCurrentDate) { ?>
                                              -
                                          <?php } else { ?>
                                              <button type="button" class="deleteBtn" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal<?= $item->id ?>" data-userid="<?= $item->id ?>">
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2">
                                                      <path d="M3 6h18" />
                                                      <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                      <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                                      <line x1="10" x2="10" y1="11" y2="17" />
                                                      <line x1="14" x2="14" y1="11" y2="17" />
                                                  </svg>
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
                                                              <div class="mt-2">
                                                                  <label for="studentName">Name</label>
                                                                  <input name="studentName" id="studentName" type="text" value="<?= $item->studentName ?>" class="form-control" disabled>
                                                              </div>
                                                              <div class="mt-2">
                                                                  <label for="studentCS">Course & Section</label>
                                                                  <input name="studentCS" id="studentCS" type="text" value="<?= $item->studentCS ?>" class="form-control" disabled>
                                                              </div>
                                                              <div class="mt-2">
                                                                  <label for="timeIn">Time In</label>
                                                                  <input name="timeIn" id="timeIn" type="text" value="<?= $item->timeIn ?>" class="form-control" disabled>
                                                              </div>
                                                          </div>
                                                          <div class="modal-footer">
                                                              <input type="hidden" name="userId" id="userId">

                                                              <form id="deleteForm" action='<?= ROOT ?>/home/attendanceDelete/<?= $item->id ?>' method="POST" style="display: inline;">
                                                                  <input type="hidden" name="_method" value="DELETE">
                                                                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                              </form>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>

                                              <div class="qr-detected-container" style="display: none;">
                                                  <form id="attendance-form" action="<?= ROOT ?>/home/addAttendance/" method="POST">
                                                      <input type="hidden" id="detected-qr-code" name="qr_code">
                                                  </form>
                                              </div>
                                          <?php } ?>
                                      </td>
                                  <?php } ?>
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
                </section>    
                <section class="fordeleteBtn">
                  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true" data-bs-backdrop="static">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body modalBody">
                                  <div class="modalLabel">
                                      <label for="lbldate">Date</label>
                                      <input name="inputDate" id="inputDate" type="text" value="" class="form-control" disabled>
                                  </div>
                              </div>
                              <div class="modal-footer">
                                  <form id="deleteAllForm" action="<?= ROOT ?>/home/deleteAllAttendance/" method="POST">
                                      <input type="hidden" name="selectedDate" id="selectedDate" value="">
                                      <button type="submit" class="btn btn-danger btn-sm mainDeleteAttendance">Delete</button>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
                    <button type="button" class="deleteAllBtn" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" style="width: 100%;">Delete All</button>
                </section>    
            </section>             
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
    const scannerContainer = document.querySelector('.scanner-con');

    onOff.addEventListener('click', function() {
        if (onOff.textContent === 'Off Camera') {
            scanner.stop();
            scannerContainer.removeChild(document.getElementById('interactive'));
            cameraOn = false;
            onOff.textContent = 'On Camera';
        } else {
            const video = document.createElement('video');
            video.id = 'interactive';
            video.className = 'viewport';
            scannerContainer.appendChild(video);
            startScanner();
            onOff.textContent = 'Off Camera';
        }
    });

    function filterTableByDate() {
        const deleteAllBtn = document.querySelector('.deleteAllBtn');
        const dateSelect = document.getElementById("dateSelect");
        let selectedDate = dateSelect.value;
        document.getElementById('selectedDate').value = dateSelect.value; //this is to get the specific date to delete
        document.getElementById('inputDate').value = dateSelect.value;

        if (!selectedDate) {
            dateSelect.selectedIndex = 0;
            selectedDate = dateSelect.options[0].value;
        }

        const tableRows = document.querySelectorAll(".ttable tbody tr");

        tableRows.forEach(row => {
            const dateCell = row.querySelector("td:nth-child(3)");
            const dateValue = dateCell ? dateCell.textContent.trim() : "";

            if (selectedDate === "All" || dateValue === selectedDate) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });

        if(selectedDate === "All"){
            deleteAllBtn.style.display = "none";
        }
        else{
            deleteAllBtn.style.display = "block";
        }
    }

    window.addEventListener('DOMContentLoaded', function() {
        filterTableByDate();
    });

    const txtSearch = document.getElementById('txtSearch');

    document.getElementById('txtSearch').addEventListener('input', function() {
        var input = document.getElementById('txtSearch').value.toLowerCase();
        var selectedDate = document.getElementById('dateSelect').value;
        var tableBody = document.querySelector('.ttable tbody');
        var rows = tableBody.getElementsByTagName('tr');

        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName('td');
            var dateCell = rows[i].querySelector("td:nth-child(3)");
            var dateValue = dateCell ? dateCell.textContent.trim() : "";
            var searchFound = false;

            if (selectedDate === "All" || dateValue === selectedDate) {
                for (var j = 0; j < cells.length; j++) {
                    if (cells[j].innerText.toLowerCase().includes(input)) {
                        searchFound = true;
                        break;
                    }
                }
            }

            if (searchFound) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    });
   
</script>


<style>
    .todayBtn{
        background-color: #8200FF;
        color: #fff;
    }
</style>
<?php include PATH . "partials/footer.php" ?>