$(document).ready(function() {


	var formRow = '<div class="row form-group"><div class="col-sm-4"><input class="form-control" name="names[]" type="text"></div><div class="col-sm-2"><input class="form-control" name="widths[]" type="number"></div><div class="col-sm-2"><input class="form-control" name="heights[]" type="number"></div><div class="col-sm-2"><select class="form-control" name="ratios[]"><option value="crop">Crop</option><option value="resize">Maintain Aspect Ratio</option></select></div><div class="col-sm-2"><span class="btn btn-danger delete-row-button">Delete Row</span></div></div>';

	// can add rows
    $( "#add-row-button" ).click( function() {
    	$('#new-row-area').append(formRow);

    	// can delete rows
    	$( '.delete-row-button' ).click( function() {
	    	var btn = $(this);
	    	btn.parent().parent().remove();
	    });

    });

});