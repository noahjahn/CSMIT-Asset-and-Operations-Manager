<div class="container-fluid container-style">
    <div class="row">
        <div class="col">
            <table id="asset_types" class="table table-hover">
                <col width="65%">
                <col width="25%">
                <col width="5%">
                <col width="5%">
                <thead class="table-header">
                    <tr class="table-primary">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Rate</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="col">
            <table id="teams" class="table table-hover" style="table-layout: auto;">
                <col width="90%">
                <col width="5%">
                <col width="5%">
                <thead>
                    <tr class="table-primary">
                        <th>ID</th>
                        <th>Name</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table id="manufacturers" class="table table-hover" style="table-layout: auto;">
                <col width="90%">
                <col width="5%">
                <col width="5%">
                <thead>
                    <tr class="table-primary">
                        <th>ID</th>
                        <th>Name</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="col">
            <table id="models" class="table table-hover" style="table-layout: auto;">
                <col width="45%">
                <col width="45%">
                <col width="5%">
                <col width="5%">
                <thead>
                    <tr class="table-primary">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Manufacturer</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<?php $this->load->view('private/modals/asset_types/all'); ?>
<?php $this->load->view('private/modals/manufacturers/all'); ?>
<?php $this->load->view('private/modals/models/all'); ?>
<?php $this->load->view('private/modals/teams/all'); ?>
