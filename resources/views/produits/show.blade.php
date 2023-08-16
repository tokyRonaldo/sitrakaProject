<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-titre" id="modalTitre">produit name</h4>
		    <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  
	    </div>
        <div class="modal-body">
            <div class="row">
              hello{{$produit->id}}
            </div>
        </div>
        <div class="modal-footer">
            <!-- <button type="button" class="btn btn-primary no-print"
          aria-label="Print"
            onclick="$(this).closest('div.modal').printThis();">
          <i class="fa fa-print"></i> @lang( 'messages.print' )
        </button> -->
            <button type="button" class="btn btn-default no-print" data-dismiss="modal">close</button>
      </div>
    </div>

</div>
