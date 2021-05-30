<?php wp_enqueue_media();?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Create Book</div>
            <div class="panel-body">

                <form class="form-horizontal" action="javascript:void(0)" id="create_book_form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="status">Choose your Book Shelf</label>
                        <div class="col-sm-5">
                            <select class="form-control" id="status" name="dd_bok_shelf" required>
                                <option value="0">Choose book Shelf</option>
                                <?php
                                if (count($book_shelf) > 0) {
                                    foreach ($book_shelf as $key => $value) {
                                ?>
                                        <option value="<?php echo $value->id ?>"><?php echo $value->shelf_name ?></option>
                                <?php
                                    }
                                }
                                ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Name:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="name" placeholder="Enter name" name="text_name" required>
                        </div>
                        <div class="col-sm-5"></div>
                    </div>


               <!--      <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email:</label>
                        <div class="col-sm-5">
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="text_email" required>
                        </div>
                        <div class="col-sm-5"></div>
                    </div> -->

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="publication">Publication:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="publication" placeholder="Enter publication" name="text_publication" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="description">Description:</label>
                        <div class="col-sm-5">
                            <textarea class="form-control" id="description" placeholder="Enter description" name="text_description" style="resize: none; height:10em" required></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="book_image">Book Image:</label>
                        <div class="col-sm-5">
                            <input type="button" class="form-control" id="text_image" name="text_image" value="Upload Image" required>
                            <img src="" style="height:80px; width:80px" id="book_image" />
                            <input type="hidden" name="book_cover_image" id="book_cover_image">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="book_cost">Book Cost:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="book_cost" placeholder="Enter book cost" name="text_book_cost" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="status">Status:</label>
                        <div class="col-sm-5">
                            <select class="form-control" id="status" name="status" required>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="sub_mit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>