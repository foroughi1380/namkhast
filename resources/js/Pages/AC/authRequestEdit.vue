<template>
  <Head title="بررسی درخواست های احراز هویت"></Head>

  <div class="card ">
    <div class="card-header">
      <h4>درخواست احراز هویت کاربر '{{ user.name }} {{ user.family }}'</h4>
    </div>
    <div class="card-body text-center">
      <p>کاربر "{{ user.name }} {{ user.family }}" به شماره ملی "{{ authRequest.national_code }}" بعد از "{{ authRequest.try }}"
        بار تلاش ، اقدام به ارسال اطلاعات برای درخواست احراز هویت نموده است.</p>
      <img class="my-4" :href="authRequest.nc_picture" width="100" height="300" alt="تصویر کد ملی">

      <div class="col-6 mx-auto mt-2">
        <div class="form-group">
          <label>وضعیت بررسی</label>
          <select v-model="status" class="form-control">
            <option value="accept">تایید</option>
            <option value="reject">عدم تایید</option>
            <option value="block">مسدود</option>
          </select>
        </div>

        <div class="form-group">
          <label>توضیحات اضافی</label>
          <textarea v-model="description" class="form-control" rows="3" placeholder="وارد کردن اطلاعات ..."></textarea>
        </div>
      </div>
      <p class="text-danger " v-for="error in errors" v-text="error"></p>

    </div>

    <div class="card-footer">
      <WaitButton text="ویرایش" :wait="inProcess" :on-click="editInfo" :disabled="inProcess"/>
    </div>
  </div>
</template>

<script>
import ACLayout from "../../Shared/ACLayout";
import WaitButton from "../../Shared/Components/WaitButton";
import {Inertia} from "@inertiajs/inertia";

export default {
  name: "authRequestEdit",
  components:{WaitButton},
  layout: ACLayout,
  props: {
    authRequest: {},
    user: {},
    errors: {}
  },
  data() {
    return {
      status: "",
      description: "",
      inProcess: false
    }
  },
  created() {
    this.status = this.authRequest.status
    this.description = this.authRequest.description
  },
  methods: {
    editInfo() {
      this.generateRecaptchaToken('editAuthRequest').then(token => {

        this.inProcess = true;
        Inertia.put('/ac/auth-request/update/' + this.authRequest.id, {
          status: this.status,
          description: this.description,
          token:token,
        }, {
          onSuccess: page => {
            window.location.href = '/ac/auth-request'
          },
          onFinish: visit => {
            this.inProcess = false;
          }
        })
      });
    },
  }
}
</script>

<style scoped>

</style>