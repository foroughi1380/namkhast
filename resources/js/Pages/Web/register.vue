<template>
  <div class="card bg-authentication rounded-0 mb-0">
    <div class="row m-0">
      <div class="col-lg-6 d-lg-block d-none text-center align-self-center pl-0 pr-3 py-0">
        <img src="/theme/web/app-assets/images/pages/register.jpg" alt="branding logo">
      </div>
      <div class="col-lg-6 col-12 p-0">
        <div class="card rounded-0 mb-0 p-2">
          <div class="card-header pt-50 pb-1">
            <div class="card-title">
              <h4 class="mb-0">افتتاح حساب</h4>
            </div>
          </div>
          <p class="px-2">لطفا تمامی اطلاعات خواسته شده را به دقت وارد کنید</p>
          <div class="card-content">
            <div class="card-body pt-0">
              <section>
                <IconInputText :disabled="inProcess" type="text" icon="icon-user" name="name" placeholder="نام خود را وارد کنید" label="نام" v-model="name"></IconInputText>
                <p class="text-danger " v-if="errors.name" v-text="errors.name"></p>

                <IconInputText :disabled="inProcess" type="text" icon="icon-user-x" name="family" placeholder="نام خانوادگی خود را وارد کنید." label="نام خانوادگی" v-model="family"></IconInputText>
                <p class="text-danger " v-if="errors.family" v-text="errors.family"></p>

                <IconInputText :disabled="inProcess" maxlen="11" type="number" icon="icon-phone" name="phone" placeholder="شماره تلفن خود را وارد کنید." label="تلفن همراه" v-model="phone"></IconInputText>
                <p class="text-danger " v-if="errors.phone" v-text="errors.phone"></p>


                <div class="form-group row" >
                  <div class="col-12">
                    <fieldset class="checkbox" >
                      <div class="vs-checkbox-con vs-checkbox-primary">
                        <input type="checkbox" v-model="term" :disabled="inProcess">
                        <span class="vs-checkbox">
                            <span class="vs-checkbox--check">
                                <i class="vs-icon feather icon-check"></i>
                            </span>
                        </span>
                        <span class=""> من تمامی شرایط و قوانین سایت را خوانده و قبول میکنم</span>
                      </div>
                    </fieldset>
                  </div>
                </div>
                <p class="text-danger " v-if="errors.term" v-text="errors.term"></p>

                <button class="btn btn-primary btn-full btn-block mb-50" @click="submit">
                  <span  v-if="! inProcess">ثبت نام</span>
                  <hollow-dots-spinner v-else
                                       :animation-duration="1000"
                                       :dot-size="10"
                                       :dots-num="3"
                                       color="#ffffff"
                                       class="mr-auto ml-auto"
                  />
                </button>
              </section>
            </div>

            <div class="login-footer">
              <div class="divider">
                <div class="divider-text">اگر حساب دارید</div>
              </div>
              <div class="footer-btn d-flex align-items-center justify-content-center pb-1">
                <a href="/" class="card-link mr-2 ml-2">بازگشت به صفحه اصلی</a>
                ویا
                <Link href="/login" class="card-link mr-2 ml-2">ورود</Link>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import IconInputText from "../../Shared/Components/IconInputText";
import { HollowDotsSpinner } from 'epic-spinners'
import { Inertia } from '@inertiajs/inertia'

export default {
  name: "register",
  components : {IconInputText , HollowDotsSpinner},
  props : {errors:{} , success : false},
  data(){
    return{
      name  : "",
      family: "",
      phone : "",
      inProcess : false,
      term : false
    }
  },
  methods:{
    submit(){
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

      this.errors.term = undefined;
      if (!this.term){
        this.errors.term = "شما باید قوانین را قبول کنید"
        flag = false
      }
      if (! flag) return;

      this.generateRecaptchaToken('register').then(token => {
        this.inProcess = true;
        Inertia.post('/register' , {
          phone:this.phone,
          name:this.name,
          family : this.family,
          token :token
        } , {
          onSuccess : page=>{
            console.log(page)
          },
          onFinish : visit =>{
            this.inProcess = false;
          },
        })
      }).catch(err=>{
        this.errors = {
          term : "خطا در حل کپچا در صورت برترف نشدن مشکل با بارگذاری مجدد صفحه با پشتیبانی تماس بگیرید."
        }
      })

    }
  }
}
</script>

<style scoped>

</style>