
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Create Book Shelf

            <button class="btn btn-success pull-right" style="margin-top:-7px;" id="first_ajax_btn">First Ajax Request </button>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="javascript:void(0)" id="shelfForm">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="shelf_name">Enter Shelf Name:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="shelf_name" placeholder="Enter shelf name" name="shelf_name">
                        </div>
                        <div class="col-sm-5"></div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-2" for="capacity">Capacity:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="capacity" placeholder="Enter capacity" name="text_capacity">
                        </div>
                        <div class="col-sm-5"></div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="shelf_loc">Shelf Location:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="shelf_loc" placeholder="Enter shelf location" name="shelf_loc">
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="control-label col-sm-2" for="status">Status:</label>
                        <div class="col-sm-5">
                        <select class="form-control" id="status" name="status">
                        <option value="1">Active</option>
                        <option value="2">Inactive</option>
                        </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>