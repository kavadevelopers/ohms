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
                                        <input type="text" name="date" class="form-control form-control-sm datepicker" placeholder="Date" value="<?= set_value('date',date('d-m-Y')) ?>" autocomplete="off" readonly required>
                                        <small><?= form_error('date'); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Loan No. <span class="astrick">*</span></label>
                                        <input type="text" name="loan" class="form-control form-control-sm" autocomplete="off" placeholder="Loan No." value="<?= set_value('loan') ?>" >
                                        <small><?= form_error('loan'); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Bank<span class="astrick">*</span></label>
                                        <input type="text" name="bank" class="form-control form-control-sm" autocomplete="off" placeholder="Bank" value="<?= set_value('bank') ?>" >
                                        <small><?= form_error('bank'); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Principle Amount<span class="astrick">*</span></label>
                                        <input type="text" name="principle_amount" class="form-control form-control-sm numbers-decimal" autocomplete="off" placeholder="Principle Amount" value="<?= set_value('principle_amount') ?>">
                                        <small><?= form_error('principle_amount'); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Interest Amount<span class="astrick">*</span></label>
                                        <input type="text" name="interest_amount" class="form-control form-control-sm numbers-decimal" autocomplete="off" placeholder="Interest Amount" value="<?= set_value('interest_amount') ?>">
                                        <small><?= form_error('interest_amount'); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>No of Installment<span class="astrick">*</span></label>
                                        <input type="text" name="no_of_installment" class="form-control form-control-sm numbers" autocomplete="off" placeholder="No of Installment" value="<?= set_value('no_of_installment') ?>">
                                        <small><?= form_error('no_of_installment'); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Interest per Year<span class="astrick">*</span></label>
                                        <input type="text" name="interest" class="form-control form-control-sm numbers-decimal" autocomplete="off" placeholder="Interest per Year" value="<?= set_value('interest') ?>">
                                        <small><?= form_error('interest'); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Type<span class="astrick">*</span></label>
                                        <select class="form-control form-control-sm" name="type">
                                            <option value="0" <?= set_value('type') == "0"?"selected":'' ?>>Normal</option>
                                            <option value="1" <?= set_value('type') == "1"?"selected":'' ?>>Home Loan Type</option>
                                        </select>
                                        <small><?= form_error('type'); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <textarea name="remarks" class="form-control form-control-sm" rows="3" placeholder="Remarks..."><?= set_value('remarks') ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a href="<?= base_url('loans') ?>" class="btn btn-danger btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>