<!-- Main content -->

<div class="row">


    <input type="hidden" name="tag" value="add">
    <div class="col-md-8">
        <div class="box box-primary">

            <form action="" method="post" id="be-products-form">
                <div class="box-header">
                    <h3 class="box-title">Input Fields</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="be-input-product-title">Product Title</label>
                        <input type="text" name="title" class="form-control" id="be-input-product-title" placeholder="Enter New Product Title" value="<?php if ( isset($response) && $response['result'] == 0 && isset($_POST['title']) ) echo $_POST['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="be-input-product-category-id">Category</label>
                        <select name="category_id" id="be-input-product-category-id" class="form-control">
                            <?php
                            foreach ( $data['categories'] as $category ) {
                                echo '<option value="' . $category['id'] . '"';
                                if ( isset($response) && $response['result'] == 0 && isset($_POST['category_id']) ) {
                                    echo (($_POST['category_id'] == $category['id']) ? ' selected' : '');
                                }
                                echo '>' . $category['title'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="be-input-product-content">Content</label>
                        <textarea id="editor_content" name="content" rows="10" cols="40" placeholder="Enter Product Content"><?php if ( isset($response) && $response['result'] == 0 && isset($_POST['content']) ) echo $_POST['content']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="be-input-product-title">Product Information</label>
                        <ul class="tabs3">
                            <?php
                            foreach ( config_item('product_details') as $field => $field_title ) {
                                echo '
							<li><a href="#be-product-detail-tab-' . $field . '">' . $field_title . '</a></li>
							';
                            }
                            ?>
                        </ul>
                        <div class="tabs-content3 two">
                            <?php
                            foreach ( config_item('product_details') as $field => $field_title ) {
                                echo '
				<div id="be-product-detail-tab-' . $field . '" class="tabs-panel3">
                                <div class="box-body pad">
				<textarea id="editor_' . $field . '" name="' . $field . '" rows="10" cols="60" placeholder="Enter the Product Information for ' . $field_title . '">' . ((isset($response) && $response['result'] == 0 && isset($_POST[$field])) ? $_POST[$field] : '') . '</textarea>
                                </div>
                            </div>
							';
                            }
                            ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

                <input id="be-file-upload-count" name="be_file_upload_count" type="hidden" value="<?php
                if ( isset($response) && $response['result'] == 0 && isset($_POST['be_file_upload_count']) )
                    echo $_POST['be_file_upload_count'];
                else
                    echo 0;
                ?>">

                <input id="be-file-upload-name" name="be_file_upload_name" type="hidden" value="<?php
                if ( isset($response) && $response['result'] == 0 && isset($_POST['be_file_upload_name']) )
                    echo $_POST['be_file_upload_name'];
                else
                    echo '';
                ?>">

                <input id="be-file-upload-count-general" name="be_file_upload_count_general" type="hidden" value="<?php
                if ( isset($response) && $response['result'] == 0 && isset($_POST['be_file_upload_count_general']) )
                    echo $_POST['be_file_upload_count_general'];
                else
                    echo 0;
                ?>">

                <input type="hidden" name="tag" value="add">
                <input type="hidden" id="be-file-upload-max-limit" name="max_limit" value="10">

            </form>

        </div>
    </div>




    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Upload Files</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label>Upload Product Images *</label>
                    <form id="be-file-upload" method="post" action="<?php echo base_url(); ?>file_upload/" enctype="multipart/form-data">
                        <div id="drop">
                            Drop Here
                            <br>
                            <a>Browse</a>
                            <input type="file" name="upl" multiple />
                        </div>
                        <ul>
                            <!-- The file uploads will be shown here -->
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Products List</h3>
            </div>
            <div class="box-body table-responsive">
                <table id="be-products-list" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Product No.</th>
                            <th>Title</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ( $data['products'] as $item ) {
                            $i++;
                            echo '
                                        		<tr>
                                        			<td>' . $i . '</td>
                                        			<td>' . $item['title'] . '</td>
                                        			<td>' . $item['category_title'] . '</td>
                                        		</tr>
                                        		';
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Product No.</th>
                            <th>Title</th>
                            <th>Category</th>
                        </tr>
                    </tfoot>
                </table>
            </div><!-- /.box-body -->
        </div>
    </div>
</div>
</section><!-- /.content -->
</aside><!-- /.right-side -->
</div>