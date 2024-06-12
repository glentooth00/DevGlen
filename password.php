<?php
// See the password_hash() example to see where this came from.
$hash = '$2y$10$9M/GLEjQHbHf7c7Tr2XkyewTpYFEUQOfJpvdm8xgpQDPoRSzjJVmO';

$valid='SAME PASSWORD';

$invalid= 'not the same';

if (password_verify('password', $hash)) { ?>
    password is <?= $valid; ?>
<?php }  else {
    echo $invalid;
}

?>

 <div class="col-md-5 align-items-center mt-3">
                <div class="row gx-2">
                  <label class="mb-2">入金方法dd</label>
                  <div class="d-flex flex-row">
                    <input class="mr-1 w-30 form-control paymentModalStart" name="payment_id1" id="payment1" data-deptRange="start" value="" type="text" placeholder="" autofocus required>
                    <input class="mr-1 w-50 form-control bg-light text-black" name="payment_name1" id="payment_name1" value="" type="text" placeholder="" readonly>

                    <span style="font-size:22px;" class="mr-1">
                      ~
                    </span>

                    <input class="mr-1 w-30 form-control paymentModalEnd" id="payment2" name="payment_id2" data-deptRange="start" value="" type="text" placeholder="" autofocus required>
                    <input class="mr-1 w-50 form-control bg-light text-black" name="payment_name2" id="payment_name2" value="" type="text" placeholder="" readonly>
                  </div>
                </div>
              </div>