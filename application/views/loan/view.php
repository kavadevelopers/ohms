<title><?=  $_title; ?> | <?= $this->config->config["projectTitle"] ?></title>
<form method="post" action=" <?= base_url('loans/save')?>">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title"><?=  $_title; ?></h3>    
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date <span class="astrick">*</span></label>
                                        <input type="text" name="date" class="form-control form-control-sm" placeholder="Date" value="<?= vd($data['date']) ?>" autocomplete="off" readonly required>
                                        <small><?= form_error('date'); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Loan No. <span class="astrick">*</span></label>
                                        <input type="text" name="loan" class="form-control form-control-sm" autocomplete="off" placeholder="Loan No." value="<?= $data['loan_no'] ?>" readonly>
                                        <small><?= form_error('loan'); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Bank<span class="astrick">*</span></label>
                                        <input type="text" name="bank" class="form-control form-control-sm" autocomplete="off" placeholder="Bank" value="<?= $data['bank'] ?>" readonly>
                                        <small><?= form_error('bank'); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Principle Amount<span class="astrick">*</span></label>
                                        <input type="text" name="principle_amount" class="form-control form-control-sm numbers-decimal" autocomplete="off" placeholder="Principle Amount" value="<?= $data['principle_amount'] ?>" readonly>
                                        <small><?= form_error('principle_amount'); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Interest Amount<span class="astrick">*</span></label>
                                        <input type="text" name="interest_amount" class="form-control form-control-sm numbers-decimal" autocomplete="off" placeholder="Interest Amount" value="<?= $data['interest_amount'] ?>" readonly>
                                        <small><?= form_error('interest_amount'); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>No of Installment<span class="astrick">*</span></label>
                                        <input type="text" name="no_of_installment" class="form-control form-control-sm numbers" autocomplete="off" placeholder="No of Installment" value="<?= $data['installments'] ?>" readonly>
                                        <small><?= form_error('no_of_installment'); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Interest per Year<span class="astrick">*</span></label>
                                        <input type="text" name="interest" class="form-control form-control-sm numbers-decimal" autocomplete="off" placeholder="Interest per Year" value="<?= $data['interest'] ?>" readonly>
                                        <small><?= form_error('interest'); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Type<span class="astrick">*</span></label>
                                        <select class="form-control form-control-sm" name="type" disabled>
                                            <option value="0" <?= $data['type'] == "0"?"selected":'' ?>>Normal</option>
                                            <option value="1" <?= $data['type'] == "1"?"selected":'' ?>>Home Loan Type</option>
                                        </select>
                                        <small><?= form_error('type'); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <textarea name="remarks" class="form-control form-control-sm" rows="3" placeholder="Remarks..." readonly><?= nl2br($data['remarks']) ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-sm">
                                        <tbody>
                                            <tr>
                                                <th class="text-center">sr no.</th>
                                                <th class="text-right">Installment Amount</th>
                                                <th class="text-right">Principle Amount</th>
                                            </tr>
                                            <?php 
                                                    $this->db->order_by('id','asc');
                                                    $ins = $this->db->get_where('loan_installment',['loan_id' => $data['id']])->result_array(); ?>
                                            <?php foreach ($ins as $key => $value) { ?>
                                                <tr>
                                                    <td class="text-center"><?= $key + 1 ?></td>
                                                    <td class="text-right"><?= $value['amount'] ?></td>
                                                    <td class="text-right"><?= $value['p_amount'] ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>