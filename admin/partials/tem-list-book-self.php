<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading">List Book Shelf</div>
            <div class="panel-body">

                <table id="book_lists_shelf" class="display" style="width:100%">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Shelf Name</th>
                            <th>Capacity</th>
                            <th>Shelf Location</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($book_shelf) > 0) {
                            foreach ($book_shelf as $index => $data) {

                        ?>
                                <tr>
                                    <td><?php echo $data->id; ?></td>
                                    <td><?php echo $data->shelf_name; ?></td>
                                    <td><?php echo $data->capacity; ?></td>
                                    <td><?php echo $data->shelf_location; ?></td>
                                    <td><?php 
                                   if($data->status == 1){
                                       echo "<button class='btn btn-success'>Active</button>";
                                   }else{
                                    echo "<button class='btn btn-danger'>Inactive</button>";
                                   }
                                    ?></td>
                                    <td><button class='btn btn-danger btn_delete_book_shelf' data-id="<?php echo $data->id;?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button></td>


                                </tr>
                        <?php
                            }
                        } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Shelf Name</th>
                            <th>Capacity</th>
                            <th>Shelf Location</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>