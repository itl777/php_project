<html>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>


<body>


  <!-- A按鈕 -->
  <button type="button" id="openModalA" class="btn btn-primary">
    打開 A 視窗
  </button>

  <!-- B按鈕 -->
  <button type="button" id="openModalB" class="btn btn-primary">
    打開 B 視窗
  </button>

  <!-- A視窗 -->
  <div class="modal fade" id="modalA" tabindex="-1" aria-labelledby="modalALabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalALabel">A 視窗</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>A 視窗內容</p>
          <!-- B按鈕 -->
          <button type="button" id="openModalBFromA" class="btn btn-primary">
            打開 B 視窗
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- B視窗 -->
  <div class="modal fade" id="modalB" tabindex="-1" aria-labelledby="modalBLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalBLabel">B 視窗</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>B 視窗內容</p>
        </div>
      </div>
    </div>
  </div>


  <!-- bootstrap script -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  <script>

    const modalA = new bootstrap.Modal(document.getElementById('modalA'));
    const modalB = new bootstrap.Modal(document.getElementById('modalB'));


    document.getElementById('openModalA').addEventListener('click', function() {
      modalA.show();
    });


    document.getElementById('openModalB').addEventListener('click', function() {
      modalB.show();
    });


    document.getElementById('openModalBFromA').addEventListener('click', function() {
      modalA.hide();
      modalB.show();
    });
  </script>


</body>


</html>