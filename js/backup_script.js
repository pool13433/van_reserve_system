function setLoadVanChair(van_id) {
    var arrayChairs = [];
    var arrayPlace = [];
    // Load Chairs
    $.get('../actionDb/van_chair.php?action=getChairsByVanId', {
        van_id: van_id,
    }, function (jsonChairs) {
        $.each(jsonChairs, function (index, objectChair) {
            arrayChairs.push(objectChair);
        });
        var chidrenChairs = parentChair.find('tr');
        $.each(chidrenChairs, function (indexY, object) {
            var chairs = $(object).find('div.hidden');
            $.each(chairs, function (indexX, chair) {
                var value = $(chair).val();
                //console.log('\n indexX ::==' + indexX + ' indexY ::==' + indexY);
                $.each(arrayChairs, function (index, chair_) {
                    if (chair_.vc_x == indexX && chair_.vc_y == indexY) {
                        //console.log('\n set chair_.v_status::==' + chair_.vc_cusid);
                        var element = '';
                        if (chair_.rs_status === null) {
                            element += '<label class="btn btn-primary btn-largn">';
                            element += '<input type="checkbox" name="' + chair_.vc_label + '" value="' + chair_.vc_id + '" onClick="addChairInCart()"> ' + chair_.vc_label;
                            element += '</label>';
                            $(chair).replaceWith(element);
                        } else {
                            $(chair).replaceWith('<button type="button" class="btn btn-danger">จองแล้ว</button>');
                        }
                    }
                });
                if (indexX > 0) {
                    $(chair).replaceWith('<button type="button" class="btn btn-default btn-lg"></button>');
                }
            });
        });
    }, 'json');
}