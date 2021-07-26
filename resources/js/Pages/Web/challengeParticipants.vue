<template xmlns="http://www.w3.org/1999/html">
  <Head>
    <title>شرکت در چالش</title>
  </Head>

  <section>
    <section class="row">
      <!-- Challenge award -->
      <div class="card col-12 mx-auto">
        <div class="card-content row">
          <div class="card-body col-12 text-center">
            <div class="row">
              <h3 class="col-6"><span class="fa fa-trophy"></span> 15000 تومان</h3>
              <h3 class="col-6">هزینه مشارکت : رایگان</h3>
            </div>
            <div class="text-left my-2">
              <div class="col-12">
                <div class="form-group">
                  <label for="name">نام پیشنهادی</label>
                  <input name="name" type="text" class="form-control" id="name">
                </div>
              </div>

              <div class="col-12">
                <div class="form-group">
                  <label for="description">توضیحات اضافی</label>
                  <textarea name="description" id="description" rows="5" class="form-control"></textarea>
                </div>
              </div>

              <div class="col-5">
                  <fieldset class="form-group">
                    <label for="picture">تلفظ نام</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="name_voice">
                      <label class="custom-file-label" name="extras" for="name_voice">انتخاب فایل صوتی تلفظ نام</label>
                    </div>
                  </fieldset>
              </div>

              <div class="col-3 mt-2">
                  <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" checked name="pay_type" id="bank_pay">
                    <label class="custom-control-label" for="bank_pay">پرداخت از طریق درگاه بانکی</label>
                  </div>
              </div>
              <div class="col-3 mt-2">
                  <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="pay_type" id="acc_pay">
                    <label class="custom-control-label" for="acc_pay">پرداخت از طریق اعتبار حساب</label>
                  </div>
              </div>


            </div>
            <div>
              <a class="btn btn-primary btn-block text-white">شرکت در چالش / پرداخت</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>
</template>

<script>
import appLayout from "../../Shared/appLayout";

export default {
  name: "challengeParticipants",
  layout: appLayout
}
</script>

<style scoped>

</style>