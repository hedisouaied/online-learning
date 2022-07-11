<?php
$output = '';

$output .= '<label for="exampleInputEmail1">Nom De Document</label><input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer le nom de document" name="name_d[]"></br><label for="exampleInputEmail1">Document</label><input type="file" name="item_img[]" required="" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf" id="input-file-now" class="dropify"><div class="form-group"><label for="exampleInputEmail1">Order</label> <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Entrer l' . "'" . 'ordre de document" name="order[]"></div> <div class="form-group">
<label for="exampleInputEmail1">Nombre de pages</label>

<input type="number" class="form-control" required id="exampleInputEmail1" placeholder="Entrer le nombre de pages de ce document" name="page[]">

</div>
<label for="exampleInputEmail1">Image de document</label>
<input accept="image/*" type="file" name="doc_img[]" id="input-file-now" class="dropify" /><script src="assets/scripts/fileUpload.demo.min.js"></script>';

echo $output;
