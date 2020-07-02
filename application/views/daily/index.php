    <title><?=$this->config->config["projectTitle"]?> | <?php echo $_title; ?></title>

   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0 text-dark"><?= $_title ?></h1>
          		</div>
        	</div>
      	</div>
    </div>

    <section class="content">
        <div class="container-fluid">
             <div class="row">
                <div class="col-md-12">
                    <form method="post" action=" <?= base_url('daily/save')?>">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered table-sm dt">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Chalan/Invoice</th>
                                            <th class="text-center">Client</th>
                                            <th class="text-right">Amount</th>
                                            <th class="">Remarks</th>
                                            <th class="text-center">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-append">
                                        <tr id="tr1">
                                            <td>
                                                <input type="text" name="date[]" class="form-control form-control-sm datepicker text-center" placeholder="Date" value="<?= date('d-m-Y'); ?>" autocomplete="off" readonly required>
                                            </td>
                                            <td>
                                                <select class="form-control form-control-sm" name="type[]" onchange="which_clients(this.value,'1');" required>
                                                    <option value="">-- Select Type --</option>
                                                    <option value="1">Sale</option>
                                                    <option value="2">Purchase</option>
                                                    <option value="3">Expenses</option>
                                                    <option value="4">Salary</option>
                                                    <option value="5">Loan</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control form-control-sm" name="chl_inv[]" required>
                                                    <option value="1">Invoice</option>
                                                    <option value="2">Chalan</option>
                                                </select>
                                            </td>
                                            <td class="text-center" id="td1">
                                                <select class="form-control form-control-sm select2" name="client[]" style="display: none; max-width: 200px;" required>
                                                    <option value="">-- Select Client --</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="amount[]" class="form-control form-control-sm numbers-decimal text-right" value="" autocomplete="off" placeholder="Amount" required>
                                            </td>
                                            <td>
                                                <textarea class="form-control" name="remarks[]" placeholder="Remarks"></textarea>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="removeRow('1');">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7" class="text-right">
                                                <button type="button" class="btn btn-primary btn-sm" id="add-row">
                                                    Add Row
                                                </button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <script type="text/javascript">
        function which_clients (val,id) {
            if(val == 1){
               saleClient(id);
            }else if(val == 2){
                purchaseClient(id);
            }else if(val == 3){
                expenseClient(id);
            }else if(val == 4){
                salaryClient(id);
            }else if(val == 5){
                loanClient(id);
            }else{
                noClient(id);
            }
        }
    </script>

    <script type="text/javascript">
        rowCount = 1;
        function saleClient(id) {
            data = '<select class="form-control form-control-sm select2" name="client[]" style="max-width: 200px;" id="sale'+id+'" required>';
                data += '<option value="">-- Select Client --</option>'
                    data += '<?php foreach ($this->general_model->sale_clients() as $key => $client) { ?>'
                        data += '<option value="<?= $client['id'] ?>"><?= $client['name'] ?></option>';
                    data += '<?php } ?>';
            data += '</select>';
            $('#td'+id).html(data);
            $('#sale'+id).select2();
        }

        function purchaseClient(id) {
            data = '<select class="form-control form-control-sm select2" name="client[]" style="max-width: 200px;" id="purchase'+id+'" required>';
                data += '<option value="">-- Select Client --</option>';
                    data += '<?php foreach ($this->general_model->purchase_clients() as $key => $client) { ?>';
                        data += '<option value="<?= $client['id'] ?>" ><?= $client['name'] ?></option>';
                    data += '<?php } ?>';
            data += '</select>';
            $('#td'+id).html(data);
            $('#purchase'+id).select2();
        }

        function expenseClient (id) {
            data = '<select class="form-control form-control-sm select2" name="client[]" style="max-width: 200px;" id="purchase'+id+'" required>';
                data += '<option value="">-- Select Client --</option>';
                    data += '<?php foreach ($this->general_model->expense_clients() as $key => $client) { ?>';
                        data += '<option value="<?= $client['id'] ?>" ><?= $client['name'] ?></option>';
                    data += '<?php } ?>';
            data += '</select>';
            $('#td'+id).html(data);
            $('#purchase'+id).select2();
        }
        function salaryClient (id) {
            data = '<select class="form-control form-control-sm select2" name="client[]" style="max-width: 200px;" id="purchase'+id+'" required>';
                data += '<option value="">-- Select Client --</option>';
                    data += '<?php foreach ($this->general_model->get_employees() as $key => $client) { ?>';
                        data += '<option value="<?= $client['id'] ?>" ><?= $client['name'] ?></option>';
                    data += '<?php } ?>';
            data += '</select>';
            $('#td'+id).html(data);
            $('#purchase'+id).select2();
        }

        function loanClient (id) {
            data = '<select class="form-control form-control-sm select2" name="client[]" style="max-width: 200px;" id="purchase'+id+'" required>';
                data += '<option value="">-- Select Client --</option>';
                    data += '<?php foreach ($this->general_model->get_loans() as $key => $client) { ?>';
                        data += '<option value="<?= $client['id'] ?>" ><?= $client['loan_no'] ?> - <?= $client['bank'] ?></option>';
                    data += '<?php } ?>';
            data += '</select>';
            $('#td'+id).html(data);
            $('#purchase'+id).select2();   
        }

        function noClient(id) {
            data = '<select class="form-control form-control-sm select2" name="client[]" style="display: none; max-width: 200px;" id="noclient'+id+'" required>';
                data += '<option value="">-- Select Client --</option>';
            data += '</select>';
            $('#td'+id).html(data);
            $('#noclient'+id).select2();
        }



        function removeRow(id) {
            $('#tr'+id).remove();
        }

        $(function () {
            $('#add-row').click(function(){
                rowCount++;
                dy = '<tr id="tr'+rowCount+'">';
                    dy += '<td>';
                        dy += '<input type="text" name="date[]" class="form-control form-control-sm datepicker text-center" placeholder="Date" value="<?= date('d-m-Y'); ?>" autocomplete="off" readonly required>';
                    dy += '</td><td>';
                        dy += '<select class="form-control form-control-sm" name="type[]" onchange="which_clients(this.value,'+rowCount+');" required>';
                            dy += '<option value="">-- Select Type --</option>';
                            dy += '<option value="1">Sale</option>';
                            dy += '<option value="2">Purchase</option>';
                        dy += '</select>';
                    dy += '</td><td>';
                        dy += '<select class="form-control form-control-sm" name="chl_inv[]" required>';
                            dy += '<option value="1">Invoice</option>';
                            dy += '<option value="2">Chalan</option>';
                            dy += '<option value="3">Expenses</option>';
                            dy += '<option value="4">Salary</option>';
                            dy += '<option value="5">Loan</option>';
                        dy += '</select>';
                    dy += '</td><td class="text-center" id="td'+rowCount+'">';
                        dy += '<select class="form-control form-control-sm select2" name="client[]" id="noClient'+rowCount+'" style="display: none; max-width: 200px;" required>';
                            dy += '<option value="">-- Select Client --</option>';
                        dy += '</select>';
                    dy += '</td><td>';
                        dy += '<input type="text" name="amount[]" autocomplete="off" class="form-control form-control-sm numbers-decimal text-right" value="" placeholder="Amount" required>';
                    dy += '</td><td>';
                        dy += '<textarea class="form-control" name="remarks[]" placeholder="Remarks"></textarea>'
                    dy += '</td><td class="text-center">';
                        dy += '<button type="button" class="btn btn-danger btn-sm" onclick="removeRow('+rowCount+');">';
                            dy += '<i class="fa fa-times"></i>';
                        dy += '</button>';
                    dy +='</td>';
                dy += '</tr>';
                $('#tbody-append').append(dy);
                $('.datepicker').datepicker({
                    format: 'dd-mm-yyyy',
                    todayHighlight:'TRUE',
                    autoclose: true
                });
                $('#noClient'+rowCount).select2();
            });
        })
    </script>