var DATATABLE_LANGUAGE = {
    "lengthMenu": "เลือกแสดง _MENU_ แถวต่อหน้า",
    "info": "กำลังแสดงข้อมูล หน้า <label class='label label-info'>_PAGE_</label> จากทั้งหมด <label class='label label-info'>_PAGES_</label> หน้า",
    "infoEmpty": "-- แสดง 0 รายการ --",
    "infoFiltered": "(กรองจาก _MAX_ แถวทั้งหมด)",
    "emptyTable": "ไม่มีข้อมูลในตาราง",
    "infoPostFix": "",
    "infoThousands": ".",
    "loadingRecords": "กำลังโหลด ...",
    "processing": "กำลังประมวลผล...",
    "search": "ค้นหา...",
    "paginate": {
        "first": "หน้าแรก",
        "previous": "ก่อนหน้า",
        "next": "ต่อไป",
        "last": "หน้าสุดท้าย"
    },
    "aria": {
        "sortAscending": ": เปิดใช้งานในการจัดเรียงจากน้อยไปมากคอลัมน์",
        "sortDescending": ": เปิดใช้งานจะเรียงลำดับจากมากไปน้อยคอลัมน์"
    }
};
$(document).ready(function () {
    /*
     *  Load Data table
     */
    $('.dataTable').dataTable({
        "dom": "<'row'<'col-xs-6'l><'col-xs-6'f>r><'row'<'col-xs-12'P>>t<'row'<'col-xs-6'i><'col-xs-6'p>>",
        "language": DATATABLE_LANGUAGE,
    });
    $('.dataTables_filter input').addClass('form-control').attr('placeholder', 'ค้นหาข้อมูล...');
    $('.dataTables_length select').addClass('form-control');
    /*
     *  Load Data table
     */


    /*
     * form validate
     */


});
/*
 * https://github.com/vmichnowicz/jquery.formvalidate
 */
function validateAndPostForm(formid, url) {
    $.validate({
        onError: function () {
            alert('*** กรุณากรอกข้อมูล');
        },
        onSuccess: function () {
            alert('fffffff');
            //postForm(formid, url);
            return false;
        },
        onValidate: function ($f) {

            console.log('about to validate form ' + $f.attr('id'));
            var $callbackInput = $('#callback');
            if ($callbackInput.val() == 1) {
                return {
                    element: $callbackInput,
                    message: 'This validation was made in a callback'
                };
            }
        },
    });
}

function postForm(formid, url) {
    $.ajax({
        url: url,
        data: $('#' + formid).serialize(),
        type: 'post',
        dataType: 'json',
        success: function (data, textStatus, xhr) {
            alert(data.message);
            if (data.status) {
                redirectDelay(data.url);
            }
        },
        error: function (xhr, status, error) {
            //notifyShowing('top', 'error', '\n xhr ::==' + xhr + '\n status ::==' + status + '\n error ::==' + error);
            alert('top', 'error', '\n xhr ::==' + xhr + '\n status ::==' + status + '\n error ::==' + error);
        },
        statusCode: {
            404: function () {
                alert("page not found");
            }
        }
    }).done(function () {
        console.log('requrest http success');
    }).fail(function (jqXHR, textStatus) {
        alert("We could not subscribe you please try again or contact us if the problem persists (" + textStatus + ").");
    });
}

function logout(url) {
    var conf = confirm('ยืนยันการออกจากระบบ ใช่ [OK] || ไม่ใช่ [Cancle]');
    if (conf) {
        $.post(url, {}, function (data) {
            if (data.status) {
                redirectDelay(data.url, 1);
            }
        }, 'json');
        return true;
    }
    return false;
}


function delete_data(id, url) {
    var conf = confirm('ยืนยันการลบข้อมูล รหัส ' + id + 'ใช่[OK] || ไม่ใช่[CANCLE]');
    if (conf) {
        $.ajax({
            url: url,
            data: {id: id},
            type: 'post',
            dataType: 'json',
            success: function (data) {
                if (data.status) {
                    reloadDelay(1);
                }
            }
        });
        return true;
    }
    return false;
}
