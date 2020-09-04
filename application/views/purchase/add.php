<title><?=  $_title; ?> | <?= $this->config->config["projectTitle"] ?></title>
<form method="post" action=" <?= base_url('purchase/save')?>">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
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
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Date <span class="astrick">*</span></label>
                                        <input type="text" name="date" class="form-control form-control-sm datepicker" placeholder="Date" value="<?= date('d-m-Y'); ?>" autocomplete="off" readonly required>
                                        <small><?= form_error('date'); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Invoice No. <span class="astrick">*</span></label>
                                        <input type="text" name="inv" class="form-control form-control-sm" autocomplete="off" placeholder="Invoice No." value="" >
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Challan No. <span class="astrick">*</span></label>
                                        <input type="text" name="challan_no" class="form-control form-control-sm" autocomplete="off" placeholder="Challan No." value="" >
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Client <span class="astrick">*</span></label>
                                        <select class="form-control form-control-sm select2" onchange="_price();" id="client" name="client" required>
                                            <option value="">-- Select Client --</option>
                                            <?php foreach ($clients as $key => $client) { ?>
                                                <option value="<?= $client['id'] ?>" data-products="<?= $this->general_model->get_product_by_client($client['id']); ?>"><?= $client['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <small><?= form_error('client'); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <table class="table table-responsive table-bordered" id="product-table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Challan Qty</th>
                                                <th>Invoice Qty</th>
                                                <th>Rate</th>
                                                <th>Challan Amount</th>
                                                <th>Invoice Amount</th>
                                                <th>Tax</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="1">
                                                <td>
                                                    <select class="form-control form-control-sm select2" onchange="_prod_price('1');" name="product[]" id="product1" required>
                                                        <option value="">-- Select Product --</option>
                                                        <?php foreach ($products as $key => $product) { ?>
                                                            <option value="<?= $product['id'] ?>" data-tax="<?= $product['tax'] ?>"><?= $product['name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="challan[]" class="form-control form-control-sm numbers-decimal" value="0" placeholder="qty" onkeyup="_sale();" id="challanqty1" required>
                                                </td>
                                                <td>
                                                    <input type="text" name="invoice[]" class="form-control form-control-sm numbers-decimal" value="0" placeholder="qty" onkeyup="_sale();" id="invoiceqty1" required>
                                                </td>
                                                <td>
                                                    <input type="text" name="price[]" class="form-control form-control-sm numbers-decimal" value="0.00" placeholder="Price" onkeyup="_sale();" id="prodprice1" required>
                                                </td>
                                                <td>
                                                    <input type="text" name="chalan_price[]" class="form-control form-control-sm" value="0" placeholder="Challan Price" id="prodchalantotal1" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" name="invoice_price[]" class="form-control form-control-sm" value="0" placeholder="Invoice Price" id="prodinvoicetotal1" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" name="tax[]" class="form-control form-control-sm" value="0" placeholder="Tax" id="prodtax1" readonly>
                                                    <input type="hidden" name="" id="taxPer1">
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="7" class="text-right">
                                                    <button type="button" class="btn btn-sm btn-primary" id="btn-addrow">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger" id="btn-removerow">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="col-md-6 offset-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Challan Total<span class="astrick">*</span></label>
                                                <input type="text" name="challan_total" id="challan_total" class="form-control form-control-sm" autocomplete="off" placeholder="Challan Total" value="0" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Invoice Total<span class="astrick">*</span></label>
                                                <input type="text" name="invoice_total" id="invoice_total" class="form-control form-control-sm" autocomplete="off" placeholder="Invoice Total" value="0" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 offset-md-9">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Tax Total<span class="astrick">*</span></label>
                                                <input type="text" name="tax_total" id="tax_total" class="form-control form-control-sm" autocomplete="off" placeholder="Tax Total" value="0" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 offset-md-9">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Net Invoice Total<span class="astrick">*</span></label>
                                                <input type="text" name="net_invoice" id="net_invoice" class="form-control form-control-sm" autocomplete="off" placeholder="Net Invoice Total" value="0" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description<span class="astrick">*</span></label>
                                        <textarea name="description" class="form-control form-control-sm" rows="5" placeholder="Description..."></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a href="<?= base_url('purchase') ?>" class="btn btn-danger btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>


<script type="text/javascript">
    function _price() {
        var client = $("#client").val();
        if(client != ""){
            $('#product-table tbody').find('tr').each (function() {
                var id = $(this).attr('id');
                var product = $("#product"+id).val();
                if(product != ""){
                    json = $('#client option:selected').data('products');
                    $.each(json, function(index) {
                        if(json[index].product == product){
                            $("#prodprice"+id).val(json[index].price);
                        }
                    });
                    $("#taxPer"+id).val($("#product"+id+" option:selected").data('tax'));
                }
                else{
                    $("#prodprice"+id).val(0.00);
                    $("#taxPer"+id).val(0.00);
                }
            });
        }
        _sale();
    }

    function _prod_price(id) {
        var client = $("#client").val();
        if(client != ""){
            $('#product-table tbody').find('tr').each (function() {
                var product = $("#product"+id).val();
                if(product != ""){
                    json = $('#client option:selected').data('products');
                    $.each(json, function(index) {
                        if(json[index].product == product){
                            $("#prodprice"+id).val(json[index].price);
                        }
                    });
                    $("#taxPer"+id).val($("#product"+id+" option:selected").data('tax'));
                }
                else{
                    $("#prodprice"+id).val(0.00);
                    $("#taxPer"+id).val(0.00);
                }
            });
        }
        _sale();
    }

    function _sale() {
        var challan_total = 0;
        var invoice_total = 0;
        var tax_total = 0;
        $('#product-table tbody').find('tr').each (function() {
            var id = $(this).attr('id');
            var price = $("#prodprice"+id).val();
            var challan = $("#challanqty"+id).val();
            var invoice = $("#invoiceqty"+id).val();
            var taxPer = $("#taxPer"+id).val();
            if(price == ""){ price = 0; }else{ price = parseFloat(price); }
            if(challan == ""){ challan = 0; }else{ challan = parseFloat(challan); }
            if(invoice == ""){ invoice = 0; }else{ invoice = parseFloat(invoice); }
            if(taxPer == ""){ taxPer = 0; }else{ taxPer = parseFloat(taxPer); }
            var challan_price = (challan * price).toFixed(2);
            var invoice_price = (invoice * price).toFixed(2);
            var tax = ((invoice_price * taxPer) / 100).toFixed(2);

            $("#prodchalantotal"+id).val(challan_price);
            $("#prodinvoicetotal"+id).val(invoice_price);
            $("#prodtax"+id).val(tax);

            challan_total += parseFloat(challan_price);
            invoice_total += parseFloat(invoice_price);
            tax_total += parseFloat(tax);
        });

        $("#challan_total").val(challan_total);
        $("#invoice_total").val(invoice_total);
        $("#tax_total").val(tax_total);
        $("#net_invoice").val((invoice_total + tax_total).toFixed(2));
    }

    $(function(){
        $('#btn-addrow').click(function(){
            last_id = parseFloat($('#product-table > tbody > tr').last().attr('id')) + 1;
            tr_string = '<tr id="'+last_id+'">';
                tr_string += '<td>';
                    tr_string += '<select class="form-control form-control-sm select2" onchange="_prod_price('+last_id+');" name="product[]" id="product'+last_id+'" required>';
                        tr_string += '<option value="">-- Select Product --</option>';
                        <?php foreach ($products as $key => $product) { ?>
                            tr_string += '<option value="<?= $product['id'] ?>" data-tax="<?= $product['tax'] ?>"><?= $product['name'] ?></option>';
                        <?php } ?>
                    tr_string += '</select>';
                tr_string += '</td>';
                tr_string += '<td>';
                    tr_string += '<input type="text" name="challan[]" class="form-control form-control-sm numbers-decimal" value="0" placeholder="qty" onkeyup="_sale();" id="challanqty'+last_id+'" required>';
                tr_string += '</td>';
                tr_string += '<td>';
                    tr_string += '<input type="text" name="invoice[]" class="form-control form-control-sm numbers-decimal" value="0" placeholder="qty" onkeyup="_sale();" id="invoiceqty'+last_id+'" required>';
                tr_string += '</td>';
                tr_string += '<td>';
                    tr_string += '<input type="text" name="price[]" class="form-control form-control-sm numbers-decimal" value="0.00" placeholder="Price" onkeyup="_sale();" id="prodprice'+last_id+'" required>';
                tr_string += '</td>';
                tr_string += '<td>';
                    tr_string += '<input type="text" name="chalan_price[]" class="form-control form-control-sm" value="0" placeholder="Challan Price" id="prodchalantotal'+last_id+'" readonly>';
                tr_string += '</td>';
                tr_string += '<td>';
                    tr_string += '<input type="text" name="invoice_price[]" class="form-control form-control-sm" value="0" placeholder="Invoice Price" id="prodinvoicetotal'+last_id+'" readonly>';
                tr_string += '</td>';
                tr_string += '<td>';
                    tr_string += '<input type="text" name="tax[]" class="form-control form-control-sm" value="0" placeholder="Tax" id="prodtax'+last_id+'" readonly><input type="hidden" name="" id="taxPer'+last_id+'">';
                tr_string += '</td>';
            tr_string += '</tr>';
            $('#product-table tbody').append(tr_string);
            $('.select2').select2();
        });

        $('#btn-removerow').click(function(event) {
            if($('#product-table tbody tr').length > 1){
                $('#product-table tbody tr:last').remove();
                _sale();
            }
        });
    })
</script>
