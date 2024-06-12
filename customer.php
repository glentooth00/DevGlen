<div class="col-md-2">
                                <label class="mb-2">請求先</label>
                                <div class="row gx-2">
                                    <div class="col-md-4">
                                        <input class="form-control customerModalStart searchOnEnter" name="customer_id"
                                            id="customer" value="" type="text" placeholder="" autofocus required>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control bg-light text-black" name="customer_name"
                                            id="customer_name" value="" type="text" placeholder="" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"
                                style="max-width: 10px; margin-left: 0px; margin-right: 0px; padding-left: 0px; padding-right: 0px; padding-top: 35px">
                                <label style="font-size: 22px">~</label>
                            </div>
                            <div class="col-md-2">
                                <label class="mb-2">&nbsp;</label>
                                <div class="row gx-2">
                                    <div class="col-md-4">
                                        <input class="form-control customerModalEnd searchOnEnter" name="customer2_id"
                                            id="customer2" value="" type="text" placeholder="" autofocus required>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control bg-light text-black" name="customer2_name"
                                            id="customer2_name" value="" type="text" placeholder="" readonly>
                                    </div>
                                </div>
                            </div>




$(document).on('keydown', '.searchOnEnter', function (e) {
    let $row = $(this).closest('tr'); // Get the closest table row
    
    if (e.which !== 13) {
        $row.off('blur');
    }

    if (e.which === 13) {
        e.preventDefault();

        let enteredValue = this.value;
        let elementId = this.id;
        let element = document.getElementById(elementId);
        let correspondingText = '';
        let correspondingCode = '';
        let element_name = '';
        let element_name_id;
        let hasValue = false;

        if (enteredValue != "") {
            let dataJson;

            if (Array.from(element.classList).some(className => className.includes('customer'))) {
                dataJson = customerArray;
                element_name_id = getElementId($(this), 'customer');

            }

            let key;
            for (let i = 0; i < dataJson.length; i++) {
                key = dataJson[i].customer_code;
                convertedKey = parseInt(key).toString();

                if (key === enteredValue || convertedKey === enteredValue) {
                    correspondingCode = dataJson[i]['customer_code'];
                    correspondingText = dataJson[i]['customer_name'];
                    hasValue = true;
                    break;
                }
            }
            element_name = document.getElementById(element_name_id);
            element.value = correspondingCode;
            element_name.value = correspondingText;

            if (hasValue) {
                $row.off('blur');
            }

        } else {
            $row.closest('.row').find('input.form-control').eq(1).val('');
        }

        if (!hasValue) {
            $row.on('blur', function () {
                var blurEl = $(this);
                setTimeout(function () {
                    blurEl.focus();
                }, 5);
            });
        }
    }
});

$(document).on('focus', '.form-control', function () {
    let $row = $(this).closest('tr');
    $row.find('.searchOnEnter').off('blur');
});

function getElementId(element, inputName) {
    return element.closest('.row').find('input[name^="' + inputName + '"].form-control').eq(1).attr('id');
}

                            