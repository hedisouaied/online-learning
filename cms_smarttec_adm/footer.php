<!-- Select2 -->
<script src="assets/plugin/select2/js/select2.min.js"></script>
<!-- Multi Select -->
<script src="assets/plugin/multiselect/multiselect.min.js"></script>
<!-- Touch Spin -->
	<script src="assets/plugin/touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="assets/scripts/modernizr.min.js"></script>
<script src="assets/plugin/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="assets/plugin/nprogress/nprogress.js"></script>
<script src="assets/plugin/sweet-alert/sweetalert.min.js"></script>
<!-- Full Screen Plugin -->

<!-- Google Chart -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<!-- chart.js Chart -->
<script src="assets/plugin/chart/chartjs/Chart.bundle.min.js"></script>
<script src="assets/scripts/chart.chartjs.init.min.js"></script>

<!-- FullCalendar -->
<script src="assets/scripts/fullcalendar.init.js"></script>

<!-- Sparkline Chart -->
<script src="assets/plugin/chart/sparkline/jquery.sparkline.min.js"></script>
<script src="assets/scripts/chart.sparkline.init.min.js"></script>


<!-- Data Tables -->
<script src="assets/plugin/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="assets/plugin/datatables/media/js/dataTables.bootstrap.min.js"></script>
<script src="assets/plugin/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugin/datatables/extensions/Responsive/js/responsive.bootstrap.min.js"></script>
<script src="assets/scripts/datatables.demo.min.js"></script>
<!-- Remodal -->
<script src="assets/plugin/modal/remodal/remodal.min.js"></script>
<script src="assets/color-switcher/color-switcher.min.js"></script>

<!-- Maxlength -->
<script src="assets/plugin/maxlength/bootstrap-maxlength.min.js"></script>
<!-- Demo Scripts -->
<script src="assets/scripts/form.demo.min.js"></script>
<!-- Placed at the end of the document so the pages load faster -->
<script src="assets/plugin/waves/waves.min.js"></script>
<!-- Full Screen Plugin -->

<!-- Jquery UI -->
<script src="assets/plugin/jquery-ui/jquery.ui.touch-punch.min.js"></script>




<!-- Placed at the end of the document so the pages load faster -->



<!-- Full Screen Plugin -->
<script src="assets/plugin/fullscreen/jquery.fullscreen-min.js"></script>
<!-- Dropify -->
<script src="assets/plugin/dropify/js/dropify.min.js"></script>
<script src="assets/scripts/fileUpload.demo.min.js"></script>

<script>
	check_number = 2;
	$('.plus_rep').click(function() {

		var x = '<div><div class="form-group" > <label for = "exampleInputEmail1" > Réponse de la question </label> <input required type = "text" class = "form-control" id = "exampleInputEmail1" placeholder = "Entrer la réponse" name = "reponse[]" ></div><ul class = "list-inline" ><li ><div class = " success" ><input  type = "radio"  name = "checkk[' + check_number + ']" checked value = "1"  > <label  > Vrai </label> </div> <!--/.radio --> </li> <li ><div class = " danger" ><input type = "radio" value = "0" name = "checkk[' + check_number + ']"  > <label  > faux </label> </div> </li></ul><button title="Ajouter une autre réponse" type="button" class="plus_supp btn btn-danger btn-block"><i class="fa fa-minus"></i></button></div>';
		check_number = check_number + 1;
		$('#plus_radio').append(x);
	});

	$('#plus_radio').on('click', '.plus_supp', function() {

		$(this).parent('div').remove();
		check_number--;
	});
</script>
<script>
	check_number = 2;
	$('.plus_rep_live').click(function() {

		var x = '<div><div class="form-group" > <label for = "exampleInputEmail1" > Réponse de la question </label> <input required type = "text" class = "form-control" id = "exampleInputEmail1" placeholder = "Entrer la réponse" name = "reponse[]" ></div><ul class = "list-inline" ><li ><div class = " success" ><input  type = "radio"  name = "checkk[' + check_number + ']" checked value = "1"  > <label  > Vrai </label> </div> <!--/.radio --> </li> <li ><div class = " danger" ><input type = "radio" value = "0" name = "checkk[' + check_number + ']"  > <label  > faux </label> </div> </li></ul><button title="Ajouter une autre réponse" type="button" class="plus_supp btn btn-danger btn-block"><i class="fa fa-minus"></i></button></div>';
		check_number = check_number + 1;
		$('#plus_radio_live').append(x);
	});

	$('#plus_radio_live').on('click', '.plus_supp', function() {

		$(this).parent('div').remove();
		check_number--;
	});
</script>
<script>
	$('.plus_ww').click(function() {
		var x = '<div><label for="exampleInputEmail1">What you will learn</label><input required type="text" class="form-control" placeholder="entrez ce que l élève apprendra" name="whaty[]"><button title="Ajouter une autre réponse" type="button" class="plus_sw btn btn-danger btn-block"><i class="fa fa-minus"></i></button></div>';
		$('#whaty').append(x);
	});
	$('#whaty').on('click', '.plus_sw', function() {

		$(this).parent('div').remove();
	});
</script>



<script>
	$('.plus_ss').click(function() {
		var x = '<div class="form-group"><label for="exampleInputEmail1">Date de Séance</label><input required type="date" class="form-control" id="exampleInputEmail1" name="date[]"></div><div class="form-group"><label for="exampleInputEmail1">Heure de début</label><input required type="time" class="form-control" id="exampleInputEmail1" placeholder="Entrer la durée" name="heure_start[]"></div><div class="form-group"><label for="exampleInputEmail1">Heure de fin</label><input required type="time" class="form-control" id="exampleInputEmail1" placeholder="Entrer la durée" name="heure_end[]"></div><div style="display: none;"><label for="exampleInputEmail1">Document</label><input type="file" name="file[]" id="input-file-now" class="dropify" data-max-file-size="100M" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf" /></div><div style="display: none;" class="form-group"><label for="exampleInputEmail1">Video de la séance</label><input  type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer le lien" name="zoom[]"></div><hr style="border: 3px solid #00aeff;">';

		x = x + ' <script src="assets/sc';
		x = x + 'ripts/fileUpload.demo.min.js">';
		x = x + '<';

		x = x + '/scr';
		x = x + 'ip';

		x = x + 't';

		x = x + '>';

		$('#plus_ins').append(x);
	});
</script>

<script>
	$('.plus_yy').click(function() {
		<?php $i++; ?>
		var x = '<label for="exampleInputEmail1">Video</label><input required type = "file" name = "file<?php echo $i; ?>" onchange="uploadFile<?php echo $i; ?>()" id = "file<?php echo $i; ?>" class = "dropify" data-max-file-size="1000M" / ><progress id="progressBar<?php echo $i; ?>" value="0" max="100" style="width:300px;"></progress> <h3 id="status<?php echo $i; ?>"></h3> <p id="loaded_n_total<?php echo $i; ?>"></p><div class="form-group"><label for="exampleInputEmail1">Nom de lesson</label><input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer le lesson" name="title[]"></div><div class="form-group"><label for="exampleInputEmail1">Duration</label><input type="number" class="form-control" id="exampleInputEmail1" placeholder="Entrer la durée" name="duration[]"></div><label for="exampleInputEmail1">Document  (Option):</label><input type="file" name="file[]" id="input-file-now" class="dropify" data-max-file-size="100M" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf" />';


		x = x + ' <script>function _(el) {return document.getElementById(el);}	function uploadFile<?php echo $i; ?>() { var file = _("file<?php echo $i; ?>").files[0]; var formdata = new FormData();formdata.append("file<?php echo $i; ?>", file);var ajax = new XMLHttpRequest();ajax.upload.addEventListener("progress", progressHandler<?php echo $i; ?>, false);ajax.addEventListener("load", completeHandler<?php echo $i; ?>, false);ajax.addEventListener("error", errorHandler<?php echo $i; ?>, false);ajax.addEventListener("abort", abortHandler<?php echo $i; ?>, false);ajax.open("POST", "file_upload_parser.php?id=file<?php echo $i; ?>"); ajax.send(formdata); }function progressHandler<?php echo $i; ?>(event) { _("loaded_n_total<?php echo $i; ?>").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total; var percent = (event.loaded / event.total) * 100; _("progressBar<?php echo $i; ?>").value = Math.round(percent); _("status<?php echo $i; ?>").innerHTML = Math.round(percent) + "% uploaded... please wait"; }function completeHandler<?php echo $i; ?>(event) { _("status<?php echo $i; ?>").innerHTML = event.target.responseText; _("progressBar<?php echo $i; ?>").value = 0; } function errorHandler<?php echo $i; ?>(event) { _("status<?php echo $i; ?>").innerHTML = "Upload Failed"; } function abortHandler<?php echo $i; ?>(event) { _("status<?php echo $i; ?>").innerHTML = "Upload Aborted";}';
		x = x + '</scr';
		x = x + 'ipt>';

		x = x + ' <script src="assets/sc';
		x = x + 'ripts/fileUpload.demo.min.js">';
		x = x + '<';

		x = x + '/scr';
		x = x + 'ip';

		x = x + 't';

		x = x + '>';

		$('#plus_input').append(x);
	});
</script>



<script>
	$('.plus_hh').click(function() {

		$.ajax({

			url: "load_f.php",
			method: "POST",
			dataType: "text",
			success: function(data) {
				if (data != "") {
					$('#plus_in').append(data);
				}
			}

		});
	});
</script>

<script src="assets/color-switcher/color-switcher.min.js"></script>
<!-- Maxlength -->
<script src="assets/plugin/maxlength/bootstrap-maxlength.min.js"></script>
<!-- Demo Scripts -->
<script src="assets/scripts/form.demo.min.js"></script>


<!-- Form Wizard -->
<script src="assets/plugin/form-wizard/prettify.js"></script>
<script src="assets/plugin/form-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="assets/plugin/jquery-validation/jquery.validate.min.js"></script>
<script src="assets/scripts/form.wizard.init.min.js"></script>
<script src="assets/scripts/main.min.js"></script>


</body>

</html>
<?php
ob_end_flush();
?>