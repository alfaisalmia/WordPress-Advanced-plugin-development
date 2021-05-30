<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading">List Books</div>
            <div class="panel-body">

                <table id="book_lists" class="display" style="width:100%">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Shelf name</th>
                            <th>Publication</th>
                            <th>Description</th>
                            <th>Book Image</th>
                            <th>Book Cost</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($books_data) > 0) {
                            foreach ($books_data as $key => $value) {
                                # code...

                        ?>

                                <tr>
                                    <td><?php echo $value->id ?></td>
                                    <td><?php echo $value->name ?></td>
                                    <td><?php echo $value->shelf_name ?></td>
                                    <td><?php echo !empty($value->publication) ? $value->publication : "<i>No Publication</i>" ?></td>
                                    <td><?php echo substr($value->description, 0, 60) ?>...</td>
                                    <td>
                                        <?php
                                        if (!empty($value->book_image)) {
                                        ?>
                                            <img src="<?php echo $value->book_image; ?>" style="height:50px; width:50px;" />
                                        <?php
                                        } else {
                                            echo "<i>No image</i>";
                                        }
                                        ?>

                                    </td>
                                    <td><?php echo $value->amount ?></td>
                                    <td><?php echo $value->status == 1 ? "<span class='active'>Active</span>" : "<span class='inactive'>Inactive</span>" ?></td>
                                    <td>
                                        <button data-id="<?php echo $value->id ?>" class="btn_delete_book">Delete</button>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Publication</th>
                            <th>Description</th>
                            <th>Book Image</th>
                            <th>Book Cost</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>