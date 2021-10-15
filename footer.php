<br><br><br>

	
	
	

			<div class="footer-wrap pd-20 mb-20 card-box">
				Academia - By <a href="https://irealise.digital" target="_blank">iRealise</a>
			</div>
		</div>
	</div>

<div class="modal fade" id="changeannee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Séléctionner l'année academique</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
	  <form id="fupForm" name="form1" method="POST" action="serveur/selectannee.php">
			<div class="md-form mb-5">
			  Année academique
			  <select name="anneeacademique" class="form-control">
			 <?PHP
				$selannee=$db->prepare("SELECT * FROM t_annee ORDER BY id DESC");
				$selannee->execute();
				while($data=$selannee->fetch()){
			?>
				<option> <?php echo $data['designation']; ?> </option>
			<?php } ?>
			</SELECT>
			</div>


			  </div>
			  <div class="modal-footer d-flex justify-content-center">
				
				<input type="submit" name="save" class="btn btn-success" value="CHANGER" >
			  </div>
	  </form>
    </div>
  </div>
</div>











<div class="modal fade" id="changeimgetudiant" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Modifier image étudiant</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
		<form action="editimgetudiant.php" method="POST" enctype="multipart/form-data" >
			<div class="md-form mb-5">
			  
					<div class="input-group mb-3">
					  <img src="images/temp.png" class="img img-responsive" onclick="triggerClick()" id ="profilDisplay">
					  <br>
					  <input type="file"  onchange="displayImage(this)" name="profilImage" id="profilImage" style="display:none;"  >
					</div>
					
					<div class="input-group mb-3 text-center">
					  
					</div>
				
				
				<script>
					function triggerClick(){
						document.querySelector("#profilImage").click();
						
					}
					
					function displayImage(e){
						if(e.files[0]){
							var reader= new FileReader();
							reader.onload = function(e){
								document.querySelector("#profilDisplay").setAttribute('src', e.target.result);
							}
							reader.readAsDataURL(e.files[0]);
						}
					}
				</script>
	


			  </div>
			  <div class="modal-footer d-flex justify-content-center">
				
					 <input type="submit" value="Modifier Image" class="btn btn-success btn-block" name="Upload" > 
			  </div>
	  </form>
    </div>
  </div>
</div>




	<!-- js -->
	<script>
		$(document).ready(function(){
		  $("#myInput").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#myTable1 tr").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		  });
		});
		</script>


	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="vendors/scripts/dashboard3.js"></script>
	
	<script src="src/plugins/jquery-steps/jquery.steps.js"></script>
	<script src="vendors/scripts/steps-setting.js"></script>
	

	<!-- buttons for Export datatable -->
	<script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="src/plugins/datatables/js/pdfmake.min.js"></script>
	<script src="src/plugins/datatables/js/vfs_fonts.js"></script>
	
	
	<!-- Datatable Setting js 
	<script src="vendors/scripts/datatable-setting.js"></script>-->
</body>
</html>