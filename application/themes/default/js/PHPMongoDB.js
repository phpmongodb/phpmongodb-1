/**
 * @author Nanhe Kumar <nanhe.kumar@gmail.com>
 * 
 */
function callAjax(url) {
    url = url + '&theme=false'
    $(document).ready(function() {

        $.get(url, function(data, status) {
            if (status == 'success') {
                $("#middle-content").html(data);
            }
        });

    })
}
//insert
var PMDI = {
    appendTR: function() {
        var trID = 'tr-indexes' + $('#tbl-fiedl-value tr').length;
        var tr = '<tr id="' + trID + '">';
        tr = tr + '<td><input type="text" class="input-xlarge" name="fields[]"></td>';
        tr = tr + '<td><textarea  rows="2" class="input-xlarge" name="values[]"></textarea></td>';
        tr = tr + '<td>';
        tr = tr + '&nbsp;<a href="javascript:void(0)" onclick="PMDI.appendTR();" class="icon-plus" title="Add">&nbsp;</a>&nbsp;';
        tr = tr + "<a href=\"javascript:void(0)\" onclick=\"PMDI.removeTR('" + trID + "');\" class=\"icon-minus\" title=\"Remove\">&nbsp;</a>";
        tr = tr + '</td>';
        tr = tr + '</tr>';
        $("#tbl-fiedl-value").append(tr);
        return false;
    },
    removeTR: function(trID) {
        $("table#tbl-fiedl-value tr#" + trID).remove();
        return false;
    }
}
//indexes
var PMDIN = {
    appendTR: function() {
        var trID = 'tr-indexes' + $('#tbl-create-indexes tr').length;
        var tr = '<tr id="' + trID + '">';
        tr = tr + '<td>&nbsp;</td>';
        tr = tr + '<td><input type="text" class="input-xlarge" name="fields[]"></td>';
        tr = tr + '<td>';
        tr = tr + '<select name="orders[]" style="width:auto;">';
        tr = tr + '<option value="1">ASC</option>';
        tr = tr + '<option value="-1">DESC</option>';
        tr = tr + '</select>';
        tr = tr + '</td>';
        tr = tr + '<td>';
        tr = tr + '&nbsp;<a href="javascript:void(0)" onclick="PMDIN.appendTR();" class="icon-plus" title="Add">&nbsp;</a>&nbsp;';
        tr = tr + "<a href=\"javascript:void(0)\" onclick=\"PMDIN.removeTR('" + trID + "');\" class=\"icon-minus\" title=\"Remove\">&nbsp;</a>";
        tr = tr + '</td>';
        tr = tr + '</tr>';
        $("#tbl-create-indexes").append(tr);
        return false;
    },
    removeTR: function(trID) {
        $("table#tbl-create-indexes tr#" + trID).remove();
        return false;
    },
    isCheck: function(t) {
        var checked = $(t).is(':checked');
        if (checked) {
            $('#drop_duplicates').show();
        } else {
            $('#drop_duplicates').hide();
        }
    },
}
//indexes
var PMDE = {
    init: function() {
        $("#custom_export").click(function() {
            $('#block_export_rows').slideDown();
            $('#block_export_output').slideDown();
            $('#block_export_data_dump_options').slideDown();
        });
        $("#quick_export").click(function() {
            $('#block_export_rows').slideUp();
            $('#block_export_output').slideUp();
            $('#block_export_data_dump_options').slideUp();
        });
        $("#dump_some_export").click(function() {
            $('#dump_some_row_export').show();
        });
        $("#dump_all_export").click(function() {
            $('#dump_some_row_export').hide();
        });
        $("#save_export").click(function() {
            $('#save_output_to_a_file').show();
        });
        $("#text_export").click(function() {
            $('#save_output_to_a_file').hide();
        });
    }
}
//record
var PMDR = {
    init: function() {
        $("#btn-insert").click(function() {
            $('#container-insert').slideDown();
            $('#btn-insert').addClass('btn active');
        });
        $("#add-field-value-row").click(function() {
            $("#tbl-fiedl-value").append('<tr><td><input type="text" class="input-xlarge" name="fields[]"></td><td><textarea  rows="2" class="input-xlarge" name="values[]"></textarea></td></tr>');
            $('#remove-field-value-row').show();
            return false;
        });
        $("#remove-field-value-row").click(function() {
            $('#tbl-fiedl-value tr:last').remove();
            var rowCount = $('#tbl-fiedl-value tr').length;
            if (rowCount === 2) {
                $('#remove-field-value-row').hide();
            }
            return false;
        });
        $("a[data-list-record]").click(function() {
            var tab = $(this).attr("data-list-record");
            $('#record-array').hide();
            $('#record-document').hide();
            $('#record-json').hide();
            $("#li-json").removeClass("active");
            $("#li-array").removeClass("active");
            $("#li-document").removeClass("active");
            if (tab === 'json') {
                $('#record-json').show();
                $("#li-json").addClass("active");
            } else if (tab === 'array') {
                $('#record-array').show();
                $("#li-array").addClass("active");
            } else if (tab === 'document') {
                $('#record-document').show();
                $("#li-document").addClass("active");
            }

        });
        //checkbox-remove select unselect checkbox
        $('#check-all').click(function(event) {  //on click
            if (this.checked) { // check select status
                $('.checkbox-remove').each(function() { //loop through each checkbox
                    this.checked = true;  //select all checkboxes with class "checkbox-remove"              
                });
            } else {
                $('.checkbox-remove').each(function() { //loop through each checkbox
                    this.checked = false; //deselect all checkboxes with class "checkbox-remove"                      
                });
            }
        });
        $("#delete-all").click(function() {
            var ids = [];
            $('input[class="checkbox-remove"]:checked').each(function() {
                ids.push(this.value);
                
            });
            if(ids.length!=0){
               
                var db=$( "#db-hidden" ).val();
                var collection=$("#collection-hidden" ).val();
                $.post("index.php?load=Collection/DeleteRecords&type=multiple&theme=false", {ids:ids,db:db,collection:collection}, function(response) {
                    if (response) {
                           //$("#middle-content").html(response);
                           location.reload();
                    }
                });
            }
        });
    }
}
var PMDS = {
    appendTR: function() {
        var trID = 'tr-indexes' + $('#tbl-search-col-val tr').length;
        var tr = '<tr id="' + trID + '">';
        tr = tr + '<td><select name="query[]" style="width: auto;"><option value="$and">AND</option><option value="$or">OR</option></select></td>';
        tr = tr + '<td><input type="text" class="input-xlarge" name="query[]"  placeholder="Enter Attribute"></td>';
        tr = tr + '<td>';
        tr = tr + '<select name="query[]" style="width: auto;">';
        tr = tr + '<option value="=">=</option>';
        tr = tr + '<option value="$gt">&gt;</option>';
        tr = tr + '<option value="$gte=">&gt;=</option>';
        tr = tr + '<option value="$lt">&lt;</option>';
        tr = tr + '<option value="$lte=">&lt;=</option>';
        tr = tr + '<option value="$ne">!=</option>';
        tr = tr + '</select>';
        tr = tr + '</td>';
        tr = tr + '<td><input type="text" class="input-xlarge" name="query[]" placeholder="Enter Value"></td>';
        tr = tr + '<td>';
        tr = tr + '&nbsp;<a href="javascript:void(0)" onclick="PMDS.appendTR();" class="icon-plus" title="Add">&nbsp;</a>&nbsp';
        tr = tr + "<a href=\"javascript:void(0)\" onclick=\"PMDS.removeTR('" + trID + "');\" class=\"icon-minus\" title=\"Remove\">&nbsp;</a>";
        tr = tr + '</td>';
        tr = tr + '</tr>';
        $("#tbl-search-col-val").append(tr);
        return false;
    },
    removeTR: function(trID) {
        $("table#tbl-search-col-val tr#" + trID).remove();
        return false;
    },
    appendOrderBy: function() {
        var trID = 'tr-indexes' + $('#tbl-order-by tr').length;
        var tr = '<tr id="' + trID + '">';
        tr = tr + '<td><input type="text" class="input-xlarge" name="order_by[]"  value="" placeholder="Enter Attribute"></td><td><select style="width: auto;" name="orders[]"><option value="1">ASC</option><option value="-1">DESC</option></select></td>';
        tr = tr + '<td>';
        tr = tr + '&nbsp;<a href="javascript:void(0)" onclick="PMDS.appendOrderBy();" class="icon-plus" title="Add">&nbsp</a>&nbsp;';
        tr = tr + "<a href=\"javascript:void(0)\" onclick=\"PMDS.removeOrderBy('" + trID + "');\" title=\"Remove\" class=\"icon-minus\">&nbsp;</a>";
        tr = tr + '</td>';
        tr = tr + '</tr>';
        $("#tbl-order-by").append(tr);
        return false;
    },
    removeOrderBy: function(trID) {
        $("table#tbl-order-by tr#" + trID).remove();
        return false;
    }
}    