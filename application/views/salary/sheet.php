<title><?=  $_title; ?> | <?= $this->config->config["projectTitle"] ?></title>
<section class="content-header">
    <div class="container-fluid">
         <div class="row">
            <div class="col-md-8">
              <div class="card card-info">
                    <div class="card-header">
                      <div class="row">
                        <div class="col-md-6">
                          <h3 class="card-title"><?= $_title ?></h3>  
                        </div>
                          <div class="col-md-6 text-right">
                            <a href="<?= base_url('salary/addmonth') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i> Add Month</a>
                          </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <table class="table table-bordered table-hover table-sm" id="sheet">
                            <thead>
                                <tr>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                           </thead>
                            <tbody>
                                <?php foreach ($days as $key => $day){ ?>
                                    <tr>
                                        <td class="text-center"><?= vd($day['date']) ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal<?= $key ?>">
                                              Edit
                                            </button>
                                        </td>
                                   </tr>
                                   <div class="modal fade  bd-example-modal-lg" id="modal<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <form method="post" action="<?= base_url('salary/attendance_save') ?>">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Attendance - <?= vd($day['date']) ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6" style="padding: 5px;">
                                                        <h5 class="text-center" style="margin-bottom: 20px;">Male</h5>  
                                                        <?php 
                                                            $this->db->order_by('sort','asc');
                                                            $males = $this->db->get_where('employees',['gender' => 'Male','df' => ''])->result_array(); ?>
                                                            <?php foreach ($males as $key => $male) { ?>
                                                                <?php $att = $this->db->get_where('salary',['emp_id' => $male['id'],'date' => $day['date']])->row_array(); ?>
                                                            <div class="row">
                                                                <div class="col-md-3 text-right">
                                                                    <?= $male['name'] ?>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="text" placeholder="From" name="from[]" value="<?= $att['from'] ?>" class="form-control form-control-sm ">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="text" placeholder="To" name="to[]" value="<?= $att['to'] ?>" class="form-control form-control-sm ">
                                                                </div>
                                                                <div class="col-md-12" style="padding: 10px;"></div>
                                                                </div>
                                    <input type="hidden" name="date[]" value="<?= $day['date'] ?>">
                                    <input type="hidden" name="empid[]" value="<?= $male['id'] ?>">
                                    <input type="hidden" name="perdayminus[]" value="<?= $male['free_minuts'] ?>">
                                  <?php } ?>
                                </div>

                                <div class="col-md-6" style="padding: 5px;">
                                  <h5 class="text-center" style="margin-bottom: 20px;">Female</h5>  
                                  <?php 
                                  $this->db->order_by('sort','asc');
                                  $males = $this->db->get_where('employees',['gender' => 'Female','df' => ''])->result_array(); ?>
                                  <?php foreach ($males as $key => $male) { ?>
                                    <?php $att = $this->db->get_where('salary',['emp_id' => $male['id'],'date' => $day['date']])->row_array(); ?>
                                    <div class="row">
                                      <div class="col-md-3 text-right">
                                        <?= $male['name'] ?>
                                      </div>
                                      <div class="col-md-3">
                                        <input type="text" placeholder="From (hh:mm)" name="from[]" value="<?= $att['from'] ?>" class="form-control form-control-sm ">
                                    </div>
                                        <div class="col-md-3">
                                        <input type="text" placeholder="To (hh:mm)" name="to[]" value="<?= $att['to'] ?>" class="form-control form-control-sm ">
                                      </div>
                                                                    <div class="col-md-12" style="padding: 10px;"></div>

                                    </div>
                                    <input type="hidden" name="date[]" value="<?= $day['date'] ?>">
                                    <input type="hidden" name="empid[]" value="<?= $male['id'] ?>">
                                    <input type="hidden" name="empid[]" value="<?= $male['id'] ?>">
                                    <input type="hidden" name="perdayminus[]" value="<?= $male['free_minuts'] ?>">
                                  <?php } ?>
                                </div>
                              </div>
                              

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                          </div>
                        </div>
                        </form>
                      </div>
                               <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
          </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(function(){
        $('#sheet').DataTable({
            order : [],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "columnDefs": [
                { 
                    "orderable": false, 
                    "targets": [1] 
                }
            ] 
        });
    });
</script>