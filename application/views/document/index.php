<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
    <div class="row">
        <div class="col-lg-6">
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-file-upload"></i> UPLOAD</a>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#multiupload"><i class="fas fa-file-upload"></i> MULTI UPLOAD</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <table id="example" class="display responsive nowrap " style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">File Name</th>
                        <th scope="col">Description</th>
                        <!-- <th scope="col">File Uploader</th> -->
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($document->result() as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $m->file_name;  ?></td>
                            <td><?= $m->description;  ?></td>

                            <td>

                                <a href="<?php echo base_url() . 'document/delete/' . $m->id; ?>" class="badge badge-danger tombol-hapus"><i class="fa fa-fw fa-trash"></i> </a>
                                <a href="<?php echo base_url() . 'document/download_secure/' . $m->file_name; ?>" class="badge badge-info"><i class="fa fa-fw fa-download"></i> </a>
                                <a <?php if ($m->file_password != null) : ?> class="badge badge-warning" <?php else : ?> class="badge badge-secondary" <?php endif; ?> data-toggle="modal" <?php if ($m->file_password != null) : ?> data-target="#password<?= $m->id; ?>" <?php else : ?> data-target="" <?php endif; ?>><i class="fa fa-fw fa-key"> </i></a>
                                <a href="<?php echo base_url() . 'document/view/' . $m->file_name; ?>" class="badge badge-success"><i class="fa fa-fw fa-eye"> </i></a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload PDF</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= base_url('document/insert'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="upload" required>
                            <label class="custom-file-label" for="upload">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description" required></textarea>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" id="pw" name="pw">
                            <label for="pw" class="form-check-label">Protect file with password ?</label>
                        </div>
                    </div>
                    <div class="input-group" id="show_hide_password">
                        <input class="form-control" type="password" id="passwordfile" name="password" placeholder="Enter password" disabled>
                        <div class="input-group-addon">
                            <a href=""><i class="fa fa-fw fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" value="<?= $user['email'] ?>" name="uploader">
                    </div>
                    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-file-upload"></i> MULTI UPLOAD</a>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL MULTI UPLOAD -->
<div class="modal fade" id="multiupload" tabindex="-1" role="dialog" aria-labelledby="multiuploadLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="multiuploadLabel">Upload PDF</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= base_url('document/insert'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="upload[]" required>
                                    <label class="custom-file-label" for="upload">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input class="form-control" type="text" name="description" id="description" placeholder="Description">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group" id="show_hide_password">
                                <input class="form-control" type="password" id="passwordfile" name="password" placeholder="Enter password">
                                <div class="input-group-addon">
                                    <a href=""><i class="fa fa-fw fa-eye-slash" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                        </div> -->
                        <div class="table-responsive">
                            <form name="add_name" id="add_name">
                                <table class="table table-borderless" id="dynamic_field">
                                    <tr>
                                        <td>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input name_list" name="upload[]" required>
                                                <label class="custom-file-label" for="upload">Choose file</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input class="form-control name_list" type="text" name="description[]" id="description" placeholder="Description">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group" id="show_hide_password">
                                                <input class="form-control name_list" type="password" id="passwordfile" name="password[]" placeholder="Enter password">
                                                <div class="input-group-addon">
                                                    <a href=""><i class="fa fa-fw fa-eye-slash" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" id="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<?php foreach ($document->result() as $m) : ?>

    <div class="modal fade" id="password<?php echo $m->id; ?>" tabindex="-1" role="dialog" aria-labelledby="passwordLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordLabel">PDF Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group" id="show_hide_password">
                                <input class="form-control" type="password" value=<?= $m->file_password; ?>>
                                <div class="input-group-addon">
                                    <a href=""><i class="fa fa-fw fa-eye-slash" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>