<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $subjudul ?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="mt-2 mb-4">
            <a href="<?= base_url('guru/add') ?>" class="btn btn-sm bg-purple btn-flat"><i class="fa fa-plus"></i> Add Data</a>
            <button type="button" onclick="reload_ajax()" class="btn btn-sm btn-default btn-flat"><i class="fa fa-refresh"></i> Reload</button>
            <div class="pull-right">
                <button onclick="bulk_delete()" class="btn btn-sm btn-danger btn-flat" type="button"><i class="fa fa-trash"></i> Delete</button>
            </div>
        </div>
        <?= form_open('guru/delete', array('id' => 'bulk')) ?>
        <table id="guru" class="w-100 table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NIP</th>
                    <th>Nama Guru</th>
                    <th>Email</th>
                    <th>Mata Pelajaran</th>
                    <th class="text-center">Action</th>
                    <th class="text-center">
                        <input type="checkbox" class="select_all">
                    </th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <?= form_close() ?>
    </div>
</div>

<script src="<?= base_url() ?>assets/dist/js/app/master/guru/data.js"></script>