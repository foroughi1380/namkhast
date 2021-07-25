<template>
<Head>
  <title>درخواست برداشت</title>
</Head>
  <form>
    <div class="row">
      <div class="col-10">
        <div class="media mb-2">
          <div class="media-body mt-50">
            <ul>
            <h5 class="media-heading"><li>حداقل میزان برداشت از حساب برابر با 50000 تومان میباشد.</li></h5>
            <h5 class="media-heading"><li>جهت برداشت حتما میبایست احراز هویت شده باشید.</li></h5>
            <h5 class="media-heading"><li>برای احراز هویت و ثبت شماره شبا از قسمت 'ویرایش پروفایل' استفاده کنید.</li></h5>
            <h5 class="media-heading"><li>شماره شبا ثبت شده حتما باید به نام خودتان باشد.</li></h5>
            </ul>
          </div>
        </div>

        <div class="form-group col-5">
          <div class="controls">
            <label> مبلغ درخواستی (تومان)</label>
            <input type="number" name="money" class="form-control col-11" placeholder="1000" step="1000" value="50000" min="50000">
          </div>
        </div>
      </div>
      <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
        <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">
          ثبت درخواست</button>
        <button type="reset" class="btn btn-outline-warning">پاک کردن</button>
      </div>
    </div>
  </form>
</template>

<script>
import appLayout from "../../Shared/appLayout";

export default {
  name: "withdraw",
  layout: appLayout
}
</script>

<style scoped>
</style>