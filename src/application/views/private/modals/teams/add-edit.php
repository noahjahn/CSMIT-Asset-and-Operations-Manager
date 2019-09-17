<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom-modal.css" />

<div class="modal fade" id="add-edit-team" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-add-edit-team">Team</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body-add-edit-team">
                <form action="">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="name" class="form-control" id="name">
                    </div>
                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                    <div class="modal-footer">
                        <button id="modal-cancel-add-edit-team" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button id="modal-confirm-add-edit-team" type="submit" class="btn btn-primary" data-dismiss="modal">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
