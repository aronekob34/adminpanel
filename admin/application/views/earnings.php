	<!-- Main content -->
		<div id="be-edit-form-position"></div>
		
		<?php
		if(isset($data['edit_id']) && (!isset($response) || (isset($response) && $response['result'] != 1))) {
		?>
		<div class="row">
			
			<div class="col-md-12 col-xs-12">
			
			</div>
			
		</div><!-- /.row (main row) -->
		
		<?php } ?>
		<div class="row">
			<div class="col-md-12">
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title">Earnings List</h3>
				</div>
				<div class="box-body table-responsive">
                                    <table id="be-table-main" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Price</th>
                                                <th>Date</th>
                                                <th>Müvet</th>
                                                <th>Customer</th>
                                                <th>Müver</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$i = 0;
                                        	
                                        	foreach($data['earnings'] as $item) {
                                        		$i++;
                                        		
                                        		echo '
                                        		<tr>
                                        			<td>' . $i . '</td>
                                        			<td>$ ' . (number_format((float)$item['earning_price'], 2, '.', '')) . '</td>
                                        			<td>' . $item['earning_date'] . '</td>
                                        			<td>
                                        				<a target="_blank" href="' . base_url() . 'muvets/all/' . $item['earning_muvet_id'] . '" class="btn btn-info be-edit-btn" title="Detail">
                                        					<i class="fa fa-eye"></i>&nbsp;View Detail
                                        				</a>
                                        			</td>
                                        			<td>
                                        				<a target="_blank" href="' . base_url() . 'users/customers_edit/' . $item['earning_user_customer_id'] . '" class="" title="Click to View Detail">
                                        					' . $item['earning_customer']['user_full_name'] . '
                                        				</a>
                                        			</td>
                                        			<td>
                                        				<a target="_blank" href="' . base_url() . 'users/muvers_edit/' . $item['earning_user_muver_id'] . '" class="" title="Click to View Detail">
                                        					' . $item['earning_muver']['user_full_name'] . '
                                        				</a>
                                        			</td>
                                        		</tr>
                                        		';
                                        	}
                                        	?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No.</th>
                                                <th>Price</th>
                                                <th>Date</th>
                                                <th>Müvet</th>
                                                <th>Customer</th>
                                                <th>Müver</th>
                                            </tr>
                                        </tfoot>
                                    </table>
				</div><!-- /.box-body -->
			</div>
			</div>
		</div>
		<div class="modal fade be-remove-form-modal">
		    <div class="modal-dialog">
		    	<form role="form" action="<?php echo base_url() . $page; ?>" method="post" id="be-remove-form">
		        <div class="modal-content">
			        <!-- <div class="modal-header">
		                <h4>Result</h4>
		            </div> -->
		            <div class="modal-body">
		            	<h4>All the muÌˆvets handled by this user will be deleted, too.<br><br>
		            	Do you really confirm to remove this user?</h4>
		            </div>
		            <div class="modal-footer">
		            	<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
		                <button type="submit" class="btn btn-danger">Remove</button>
		            </div>
		        </div>
		        <input type="hidden" name="tag" value="remove">
		        <input type="hidden" name="remove_id" id="be-remove-id" value="0">
		        </form>
		    </div>
		</div>
	</section><!-- /.content -->
</aside><!-- /.right-side -->
</div>