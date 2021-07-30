<template>
<Head>
  <title>درخواست برداشت</title>
</Head>
  <section v-if="isAuth == 'accept'">
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
            <IconInputText minlen="4" type="number" name="price" icon="icon-credit-card" placeholder="مبلغ درخواستی" label="مبلغ درخواستی (تومان)" :disabled="inProcess" v-model="price"></IconInputText>
          </div>
        </div>
        <p class="text-danger " v-for="error in errors" v-text="error"></p>
      </div>

      <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">

        <WaitButton text="ثبت درخواست" :wait="inProcess" :on-click="submitRequest" :disabled="inProcess"/>

        <button type="reset" class="btn btn-outline-warning ml-2">پاک کردن</button>
      </div>
    </div>
  </section>
  <section v-else>
    <div class="alert alert-danger" role="alert">
      <h4 class="alert-heading">احراز هویت</h4>
      <p class="mb-0">
        کاربر گرامی ، شما هنوز احراز هویت نشده اید.
        در صورتی که قبلا درخواست احراز هویت ارسال نکرده اید ، لطفا ارسال نمایید.
      </p>
    </div>
  </section>
</template>

<script>
import appLayout from "../../Shared/appLayout";
import WaitButton from "../../Shared/Components/WaitButton";
import IconInputText from "../../Shared/Components/IconInputText";
import {Inertia} from "@inertiajs/inertia";

export default {
  name: "withdraw",
  components : {WaitButton , IconInputText},
  layout: appLayout,
  props:{
    isAuth : false,
    errors: {}
  },
  data() {
    return {
      price: "",
      token: "",
      inProcess: false
    }
  },
  created() {
    this.price = 50000
  },
  methods:{
    submitRequest() {
      this.inProcess = true;

      if (this.price < 50000){
        this.errors.price = 'حداقل میزان برداشت برابر 50000 تومان میباشد'
        this.inProcess = false;
        return
      }
      this.generateRecaptchaToken('submitRequest').then(token => {

        Inertia.post('/withdraw/submit-request', {
          price: this.price,
          token:token,
        }, {
          onSuccess: page => {
            this.toast("درخواست شما با موفقیت ثبت شد." , "success")
          },
          onFinish: visit => {
            this.inProcess = false;
          }
        })
      });
    }
  }
}
</script>

<style scoped>
</style>