<template>
<Head>
  <title>ویرایش پروفایل</title>
  <link rel="stylesheet" type="text/css" href="/theme/web/app-assets/css-rtl/pages/app-user.css">
</Head>

  <section class="users-edit">
    <div class="card">
      <div class="card-content">
        <div class="card-body">
          <ul class="nav nav-tabs mb-3" role="tablist">
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                <i class="feather icon-user mr-25"></i><span class="d-none d-sm-block">مشخصات</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                <i class="feather icon-info mr-25"></i><span class="d-none d-sm-block">احراز هویت</span>
              </a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
              <!-- users edit media object start -->
              <div class="media mb-2">
                <a class="mr-2 my-25" href="#">
                  <img :src="user.picture" alt="users avatar" class="users-avatar-shadow rounded" height="90" width="90" v-if="user.picture">
                  <img src="/theme/web/app-assets/images/portrait/small/avatar-s-18.jpg" alt="users avatar" class="users-avatar-shadow rounded" height="90" width="90" v-else>
                </a>

                <div class="media-body mt-50">
                  <h3 class="media-heading">{{user.name}} {{ user.family }}</h3>

                  <SimpleInputFile :disabled="inProgress" accept="image/*" name="avatar" label="انتخواب عکس پروفایل"  v-model="avatar"/>
                  <p class="text-danger " v-if="errors.picture" v-text="errors.picture"></p>

                </div>
              </div>
              <!-- users edit media object ends -->


              <!-- users edit account form start -->
              <section>
                <div class="row">

                  <div class="col-12 col-sm-6">
                    <SimpleTextBox :disabled="inProgress" name="name" label="نام" maxlen="30" placeholder="نام خود را وارد کنید" v-model="name"/>
                    <p class="text-danger " v-if="errors.name" v-text="errors.name"></p>

                    <SimpleTextBox :disabled="inProgress" name="family" label="نام خانوادگی" maxlen="35" placeholder="نام خانوادگی خود را وارد کنید" v-model="family"/>
                    <p class="text-danger " v-if="errors.family" v-text="errors.family"></p>

                    <SimpleTextBox :disabled="inProgress" type="number" name="phone" label="شماره تلفن" maxlen="11" placeholder="نام خانوادگی خود را وارد کنید" v-model="phone" />
                    <p class="text-danger " v-if="errors.phone" v-text="errors.phone"></p>

                    <SimpleTextBox :disabled="inProgress" class="mb-0" type="number" name="iban" label="شماره شبا(بدون IR)" maxlen="24" placeholder="شماره شبای خود را بدون IR وارد کنید" v-model="iban" />
                    <span class="font-small-2" style="margin-top: -10px"> این شماره تنها برای واریز مورد استفاده قرار مگیرد و به کاربران نمایش داده نمیشود.</span>
                    <p class="text-danger " v-if="errors.iban" v-text="errors.iban"></p>

                  </div>

                  <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                    <WaitButton text="ثبت" :wait="inProgress" :on-click="updateProfile" :disabled="inProgress"/>
                  </div>

                </div>
              </section>
              <!-- users edit account form ends -->
            </div>
            <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">
              <!-- users edit Info form start -->
              <form novalidate>
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <div class="media mb-2">
                      <a class="mr-2 my-25" href="#">
                        <img src="/theme/web/app-assets/images/portrait/small/avatar-s-18.jpg" alt="nc_picture" class="users-avatar-shadow rounded" height="90" width="200">
                      </a>
                      <div class="media-body mt-50">
                        <h5 class="media-heading">لطفا جهت احراز هویت ، یک تصویر واضح از کارت ملی خود بارگذاری کنید.</h5>
                        <fieldset class="form-group col-12 mt-2">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="picture">
                            <label class="custom-file-label" name="picture" for="picture">انتخاب فایل</label>
                          </div>
                        </fieldset>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="controls">
                        <label>شماره شبا</label>
                        <input type="text" name="iban" class="form-control" placeholder="شماره شبا" value="">
                      </div>
                    </div>
                  </div>
                  <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">
                      ویرایش</button>
                    <button type="reset" class="btn btn-outline-warning">پاک کردن</button>
                  </div>
                </div>
              </form>
              <!-- users edit Info form ends -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import appLayout from "../../Shared/appLayout";
import SimpleTextBox from "../../Shared/Components/SimpleTextBox";
import SimpleInputFile from "../../Shared/Components/SimpleInputFile";
import WaitButton from "../../Shared/Components/WaitButton";
import { Inertia } from '@inertiajs/inertia'

export default {
  name: "profileEdit",
  layout: appLayout,
  components : {SimpleTextBox , SimpleInputFile , WaitButton},
  props : ['user','errors'],
  data(){
    return {
      avatar : null,
      name : this.user.name,
      family : this.user.family,
      phone: this.user.phone,
      iban : this.user.iban,
      inProgress : false,
    }
  },
  methods:{
    updateProfile(){
      let flag = true
      this.errors.name = undefined
      if (this.name.trim().length < 3 || this.name.trim().length > 30){
        this.errors.name = "نام باید بین ۳ تا ۳۰ کاراکتر باشد"
        flag = false
      }

      this.errors.family = undefined
      if (this.family.trim().length < 2 || this.family.trim().length > 35){
        this.errors.family = "نام خانوادگی باید بین ۲ تا ۳۵ کاراکتر باشد"
        flag = false
      }

      this.errors.phone = undefined;
      if (!this.checkPhoneIsValid(this.phone)){
        this.errors.phone = "شماره تلفن خود را صحیح وارد کنید مثل : 09123949383"
        flag = false
      }

      this.errors.iban = undefined;
      if (( this.iban !== "" && this.iban != null) &&  !/^(?=.{24}$)[0-9]*$/.test(this.iban)){
        this.errors.iban = "شماره شبا اشتباه است"
        flag = false
      }
      if (! flag) return;

      this.generateRecaptchaToken('profileupdate').then(value => {
        this.inProgress = true;
        let data = {
          token : value
        }
        if (this.avatar){
          data.picture = this.avatar;
        }
        if (this.name !== this.user.name){
          data.name = this.name;
        }
        if (this.family !== this.user.family){
          data.family = this.family;
        }
        if (this.phone !== this.user.phone){
          data.phone = this.phone;
        }
        if (this.iban !== this.user.iban){
          data.iban = this.iban;
        }

        Inertia.post('./edit', data , {
          onSuccess:page=>{
            this.toast("پروفایل شما با موفقیت به روز شد." , "success")
          },
          onFinish: valu=>{
            this.inProgress = false;
          }
        })
      });
    }
  }
}
</script>

<style scoped>

</style>