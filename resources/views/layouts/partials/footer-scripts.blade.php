<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('theme/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('theme/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('theme/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- AdminLTE -->
<script src="{{ asset('theme/dist/js/adminlte.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('theme/plugins/chart.js/Chart.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('theme/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('theme/dist/js/pages/dashboard3.js')}}"></script>
<script src="{{ asset('theme/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('theme/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('theme/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('theme/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('theme/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('theme/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('theme/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('theme/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('theme/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('theme/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
      placeholder: 'Select'
    })

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4',
      placeholder: 'Select'
    })
  })


  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  });

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = true;

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template");
  previewNode.id = "";
  var previewTemplate = previewNode.parentNode.innerHTML;
  previewNode.parentNode.removeChild(previewNode);

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  });

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
  });

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1";
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
  });

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0";
  });

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
  };
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true);
  };
  // DropzoneJS Demo Code End
  function printContent(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
<script>
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
    $('#example3').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('#example4').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('#example5').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  $(document).ready(function() {
    var max_fields = 8;
    var wrapper = $(".add_security");
    var add_button = $("#add_new_row");

    var x = 1;
    var counter = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            counter++;
            $(wrapper).append('<div class="row form-group"><div class="input-group col-6"><div class="input-group-prepend"><span class="input-group-text">'+ counter+'</span></div><input type="text" class="form-control" name="security_name[]" placeholder="Security name" autocomplete="off"></div><div class="col-3"><input type="text" class="form-control" name="security_value[]" placeholder="Estimated security value" autocomplete="off"></div><div class="input-group col-3"><div class="custom-file"><input type="file" name="security_attachment[]" class="form-control custom-file-input" id="exampleInputFile"><label class="custom-file-label" for="exampleInputFile">Upload security</label></div></div></div>'); //add input box
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })

    var max = 5;
    var wrapper_family = $(".add_security_family");
    var add_button_family = $("#add_new_row_family");

    var x = 1;
    var counter = 1;
    $(add_button_family).click(function(e) {
        e.preventDefault();
        if (x < max) {
            x++;
            counter++;
            $(wrapper_family).append('<div class="row form-group"><div class="input-group col-5"><div class="input-group-prepend"><span class="input-group-text">'+counter+'</span></div><input type="text" class="form-control" name="security_name[]" placeholder="Property name" autocomplete="off"></div><div class="col-2"><input type="text" class="form-control" name="security_number[]" placeholder="Quantity" autocomplete="off"></div><div class="col-2"><input type="text" class="form-control" name="security_value[]" placeholder="Estimated value" autocomplete="off"></div><div class="input-group col-3"><div class="custom-file"><input type="file" name="security_attachment[]" class="form-control custom-file-input" id="exampleInputFile"><label class="custom-file-label" for="exampleInputFile">Upload attachment</label></div></div></div>'); //add input box
        } else {
            alert('You Reached the limits')
        }
    });





    $('#id_client_with_group').change(function(){
      var content = $('#id_client_with_group option:selected').attr('label');
      $('#id_group').val(content);
      console.log(content);
    })
    $('#applicant_type').change(function(){
      var value = $('#applicant_type option:selected').val();
      if(value == "Business person"){
        $('#business_type').show();
      }else{
        $('#business_type').hide();
      }
    });  
    $('#btnChangePassword').click(function(){
      $('#formChangePassword').show();
      $('#formChangePhoto').hide();
       $('#infoPassword').hide();
    });
    $('#btnChangePhoto').click(function(){
      $('#formChangePhoto').show();
      $('#formChangePassword').hide();
    });

    $('#password2').blur(function(){
      var password1 = $('#password1').val();
      var password2 = $('#password2').val();
      if(password1 != password2){
        $('#infoPassword').show();
        $('#password1').focus();
      }
    });
    $('#btnShowFormAddGroupMemberRole').click(function(){
      $('#addGroupMemberRole').show();
       $('#btnShowFormAddGroupMemberRole').hide();
    });

});
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June','July','August','September','October','November','December'],
        datasets: [{
            label: 'Monthly Sales',
            data: [12, 19, 3, 5, 2, 3,7,1,6,3,4,18],
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>