<form method="post" name="form-delete-collection" id="form-delete-collection" action="index.php" >

    <div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Delete Confirmation</h3>
        </div>
        <div class="modal-body">
            <input type="text" value="" id="pop-up-collection" name="collection" class="input-xlarge" required="required">

            <p class="error-text" id="pop-up-error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete collection ?</p>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            <button class="btn " id="button-create-collection"><i class="icon-save" ></i> Save</button>
            <button id="button-delete-collection" class="btn btn-danger" data-dismiss="modal">Delete</button>
        </div>
    </div>
    <input type="hidden" id="pop-up-load" name="load" value="" />
    <input type="hidden" name="db" id="pop-up-db" value="<?php echo $this->db; ?>" />
    <input type="hidden" id="pop-up-old_collection" name="old_collection" value="" />
</form> 



<script type="text/javascript">
    $(document).ready(function() {


        $("a[data-edit-collection]").click(function() {

            $("#pop-up-collection").val(decodeURIComponent($(this).attr("data-edit-collection")));
            $("#pop-up-old_collection").val($(this).attr("data-edit-collection"));
            $("#pop-up-load").val("Collection/RenameCollection");
            $('#button-delete-collection').hide();
            $('#button-create-collection').show();
            $("#pop-up-collection").show();
            $('#pop-up-error-text').hide();
            $("#myModalLabel").text('Edit Collection');

        });

        $("a[data-delete-collection]").click(function() {
            $("#pop-up-collection").val(decodeURIComponent($(this).attr("data-delete-collection")));
            $("#pop-up-load").val("Collection/DropCollection");
            $('#button-delete-collection').show();
            $('#button-create-collection').hide();
            $("#pop-up-collection").hide();
            $('#pop-up-error-text').show();
            $("#myModalLabel").text('Delete Collection');

        });
        $('#button-delete-collection').click(function() {

            $('#form-delete-collection').submit();
            return true;
        });

    });


</script>
