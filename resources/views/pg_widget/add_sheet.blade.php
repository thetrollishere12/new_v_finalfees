<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content modal-content-spreadsheet">
         <div class="modal-header">
            <h5 class="modal-title text-sm" id="exampleModalLabel">Create New Spreadsheet</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="form-group">
               <label for="message-text" class="col-form-label text-sm">New Spreadsheet Name:</label>
               <input class="form-control text-sm" autocomplete="off" maxlength="25" type="text" name="spreadsheet_name">
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="bg-red-500 text-white rounded py-2 px-6 text-sm" data-bs-dismiss="modal">Close</button>
            <button type="button" id="new_sheet" class="main-bg-c text-white rounded py-2 px-6 text-sm">Create</button>
         </div>
      </div>
   </div>
</div>
