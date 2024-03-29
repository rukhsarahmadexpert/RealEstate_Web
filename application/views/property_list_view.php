<!--MODAL DIALOG BOX FOR PAYMENT RECORD-->
<script type="text/javascript">
    jQuery(document).on("click", ".payment_record", function(){
    //$(document).ready(function(){
    //alert(this.id);
    var jss =this.id.split('payment_record');
    //alert(jss[1]);
    //var id = val;
        var data = jss[1];
        var baseURL = '<?php echo base_url(); ?>';
        var hitURL = baseURL + "purchase_order_get_payment_record_details";
        $.ajax({
            type : "POST",
            dataType : "json",
            url : hitURL,
            data : { data : data } 
            }).done(function(data){
                //alert(data);
                //window.open(data,'_blank');
                $('#vendor_name').val(data.vendor_name);
                $('#po_payment_record_po_id').val(data.purchase_order_id);
                $('#purchase_order_due_amt').val(data.purchase_order_due_amt);
                $('#purchase_order_bill_no').val(data.purchase_order_bill_no);
                $('#po_payment_record_total_amt').val(data.purchase_order_grand_total);
                $('#po_payment_record_paid_amt').val(data.purchase_order_paid_amt);
                $('#po_payment_record_due_amt').val(data.purchase_order_due_amt);
                //var data = JSON.parse(JSON.parse(json).data);
                //console.log(data);                 
            });
    $("#payment_record_form").submit(function(event){
        //alert('coming');
        submitForm();
        //alert('coming 222');
        //return false;
    });
});
</script>
<div id="contact-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Payment Record</h3>
            </div>
            <form id="payment_record_form" name="contact" role="form" method="post" action="<?php echo base_url().'purchase_order_add_payment_record'; ?>">
                <div class="modal-body">
                    <div class="row">               
                        <div class="col-md-12">
                            <label for="vendor_name">Vendor Name</label>
                            <input type="text" name="vendor_name" id="vendor_name" class="form-control" readonly>
                            <input type="hidden" name="po_payment_record_po_id" id="po_payment_record_po_id">
                            <input type="hidden" name="purchase_order_due_amt" id="purchase_order_due_amt">
                        </div>
                    </div> 
                    <div class="row">               
                        <div class="col-md-4">
                            <label for="po_payment_record_date">Date</label>
                            <input type="date" class="form-control required" id="po_payment_record_date" name="po_payment_record_date">
                        </div>
                        <div class="col-md-4">
                            <label for="purchase_order_bill_no">Invoice #</label>
                            <input type="text" name="purchase_order_bill_no" id="purchase_order_bill_no" readonly class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="po_payment_record_payment_no">Payment No#</label>
                            <input type="text" name="po_payment_record_payment_no" id="po_payment_record_payment_no" class="form-control">
                        </div>
                    </div>
                    <div class="row">               
                        <div class="col-md-4">
                            <label for="po_payment_record_type">Payment Type</label>
                            <select class="form-control required" id="po_payment_record_type" name="po_payment_record_type">
                            <option value="0">Select Type</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Cash">Cash</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="po_payment_record_cheque_no">Cheque #</label>
                            <input type="text" name="po_payment_record_cheque_no" id="po_payment_record_cheque_no" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="po_payment_record_bank">Bank</label>
                            <input type="text" name="po_payment_record_bank" id="po_payment_record_bank" class="form-control">
                        </div>
                    </div>
                    <div class="row">               
                       <div class="col-md-4">
                            <label for="po_payment_record_total_amt">Total Amount</label>
                            <input type="text" name="po_payment_record_total_amt" id="po_payment_record_total_amt" class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="po_payment_record_paid_amt">Paid Amount</label>
                            <input type="text" name="po_payment_record_paid_amt" id="po_payment_record_paid_amt" class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="po_payment_record_due_amt">Payment Amount</label>
                            <input type="text" name="po_payment_record_due_amt" id="po_payment_record_due_amt" class="form-control">
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-12">
                            <label for="po_payment_record_note">Notes</label>               
                            <textarea class="form-control" rows="3" id="po_payment_record_note" name="po_payment_record_note"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">                  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" value="save" class="btn btn-success" id="submit" >
                </div>
            </form>
        </div>
    </div>
</div>
<!--MODAL DIALOG BOX FOR PAYMENT RECORD-->

<div class="content-wrapper">
    <section class="content-header">
      <h1>
        <i class="fa fa-list-alt"></i> Property Unit Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <?php if(isset($this->session->userdata['myfinal']['property_listing']['p_add']) && $this->session->userdata['myfinal']['property_listing']['p_add']==1 || $this->session->userdata['role']==1) { ?>
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>add_new_property"><i class="fa fa-plus"></i> Add New</a>
                </div>

            </div>
            <?php } ?>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Property Unit List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>property_listing" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" />
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                        <th>Property Name</th>
                        <th>Type</th>
                        <th>Title</th>
                        <th>Size</th>
                        <th>Rent</th>
                        <th>Status</th>
                        <th>Created On</th>
                        <th>Updated On</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($servicesRecords))
                    {
                        foreach($servicesRecords as $record)
                        {
                    ?>
                    <tr>
                        <td><?php echo $record->building_name ?></td>
                        <td><?php echo $record->property_type_name ?></td>
                        <td><?php echo $record->property_title ?></td>
                        <td><?php echo $record->property_unit_size_name ?></td>
                        <td><?php echo $record->property_rent ?></td>
                        <td><?php echo $record->property_status ?></td>
                        <td><?php echo date("d-m-Y", strtotime($record->created_at)) ?></td>
                        <td><?php echo date("d-m-Y", strtotime($record->updated_at)) ?></td>
                        <td class="text-center">

                            <?php /*<a class="btn btn-sm btn-info payment_record" href="javascript:void(0)" value="<?php echo $record->property_id; ?>" id="<?php echo 'payment_record'.$record->property_id; ?>" title="Payment Record" data-toggle="modal" data-target="#contact-modal"><i class="fa fa-money"></i></a> */ ?>
                            
                            <?php if(isset($this->session->userdata['myfinal']['property_listing']['p_update']) && $this->session->userdata['myfinal']['property_listing']['p_update']==1 || $this->session->userdata['role']==1) { ?>
                            <a class="btn btn-sm btn-info" href="<?php echo base_url().'edit_property/'.$record->property_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                            <?php } ?>

                            <?php if(isset($this->session->userdata['myfinal']['property_listing']['p_delete']) && $this->session->userdata['myfinal']['property_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                            <a class="btn btn-sm btn-danger deleteServices" href="<?php echo base_url().'delete_property/'.$record->property_id; ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fa fa-trash"></i></a>
                            <?php } ?>

                        </td>
                    </tr>
                    <?php
                        }
                    }
                    else{ ?>
                        <td><?php echo "no recodrs found"; ?></td>
                    <?php
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "property_listing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#service_id").attr("action", baseURL + "property_listing/" + value);
            jQuery("#service_id").submit();
        });
    });
</script>
