<template>
  <Head>
    <title>ثبت چالش جدید</title>
    <link rel="stylesheet" type="text/css" href="/theme/web/app-assets/css-rtl/plugins/forms/wizard.css">
  </Head>

  <!-- Section 1 -->
  <section id="number-tabs">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">چالش جدید خود را ثبت کنید</h4>
          </div>
          <div class="card-content">
            <div class="card-body">
              <form action="#" class="number-tab-steps wizard-circle">

                <fieldset>
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="title">عنوان</label>
                        <input type="text" class="form-control" id="title" name="title">
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-group">
                        <label for="description">توضیحات </label>
                        <textarea name="shortDescription" id="description" rows="5" class="form-control"></textarea>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="budget">مبلغ جایزه</label>
                        <input type="number" class="form-control" id="budget">
                        <div class="row mx-auto">
                          <span class="col-6 small text-muted">حداقل 5000 تومان و حداکثر 100000 تومان</span>
                          <span class="col-6 small text-muted">10 درصد از مبلغ به سایت تعلق میگیرد</span>
                        </div>
                      </div>
                    </div>

                    <div class="col-3 mt-2">
                      <div class="vs-checkbox-con vs-checkbox-primary">
                        <input type="checkbox" name="type" @click="is_payd = !is_payd" value="false">
                        <span class="vs-checkbox">
                            <span class="vs-checkbox--check">
                                <i class="vs-icon feather icon-check"></i>
                            </span>
                        </span>
                        <span class="">شرکت پولی در چالش</span>
                      </div>
                    </div>

                    <div class="col-3">
                      <div class="form-group" v-if="is_payd">
                        <label for="payd_value">مبلغ ورودی</label>
                        <select class="custom-select" id="payd_value">
                          <option v-for="price in participantPrices" v-text="price" :value="price"></option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6 col-12">
                      <label for="category">دسته بندی</label>
                      <fieldset class="form-group">
                        <select class="form-control" id="category" name="category">
                          <option v-for="category in challengeCategories" v-text="category" :value="category"></option>
                        </select>
                      </fieldset>
                    </div>

                    <div class="col-3 mt-2">
                        <fieldset>
                          <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" checked name="pay_type" id="bank_pay">
                            <label class="custom-control-label" for="bank_pay">پرداخت از طریق درگاه بانکی</label>
                          </div>
                        </fieldset>
                    </div>
                    <div class="col-3 mt-2">
                        <fieldset>
                          <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="pay_type"  id="acc_pay">
                            <label class="custom-control-label" for="acc_pay">پرداخت از طریق اعتبار حساب</label>
                          </div>
                        </fieldset>
                    </div>
                    <div class="col-6">
                      <div class="col-12">
                        <fieldset class="form-group">
                          <label for="picture">تصویر الحاقی</label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="picture">
                            <label class="custom-file-label" name="extras" for="picture">انتخاب فایل</label>
                          </div>
                        </fieldset>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="col-12">
                        <fieldset class="form-group">
                          <label for="extras">فایل های مستندات</label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="extras" id="extras">
                            <label class="custom-file-label" for="extras">انتخاب فایل</label>
                          </div>
                        </fieldset>
                      </div>
                    </div>
                    <button class="mt-4 ml-2 btn btn-primary waves-effect waves-light" type="submit">ثبت نهایی و پرداخت</button>
                    <button class="mt-4 ml-2 btn btn-secondary waves-effect waves-light" type="submit">ذخیره پیش نویس</button>
                  </div>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End: Section 1 -->

</template>

<script>
import appLayout from "../../Shared/appLayout";

export default {
  name: "challengeCreate",
  layout: appLayout,
  props : ["participantPrices" , "challengeCategories"],
  data() {
    return {
      is_payd: false
    }
  }

}
</script>

<style scoped>

</style>