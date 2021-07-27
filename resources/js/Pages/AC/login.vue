<template>
  <Head title="ورود ادمین"></Head>
  <div class="login-box">
    <div class="login-logo">
      <a href="/"><b>ورود به سایت</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">فرم زیر را تکمیل کنید و ورود بزنید</p>

          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="ایمیل" v-model="email">
            <div class="input-group-append">
              <span class="fa fa-envelope input-group-text"></span>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" v-model="password" placeholder="رمز عبور">
            <div class="input-group-append">
              <span class="fa fa-lock input-group-text"></span>
            </div>
          </div>
        <p class="text-danger " v-for="error in errors" v-text="error"></p>

        <div class="row">
            <div class="col-8">
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button @click="login" type="submit" class="btn btn-primary btn-block btn-block">
                <span  v-if="!inProcess">ورود</span>
                <hollow-dots-spinner v-else
                   :animation-duration="1000"
                   :dot-size="10"
                   :dots-num="3"
                   color="#ffffff"
                />
              </button>
            </div>
            <!-- /.col -->
          </div>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
</template>

<script>
import {Inertia} from "@inertiajs/inertia";
import { HollowDotsSpinner } from 'epic-spinners'

export default {
  name: "login",
  components:{HollowDotsSpinner},
  data(){
    return {
      phone : "",
      code : "",
      token: "",
      inProcess: false
    }
  },
  props:{
    errors : {},
  },
  methods:{
    login(){
      this.inProcess = true;

      this.generateRecaptchaToken('login').then(token => {
        Inertia.post('/ac/login' , {
          email:this.email,
          password:this.password,
          token :token
        },{
          onSuccess : page=>{
            window.location.reload();
          },
          onFinish : visit =>{
            this.inProcess = false;
          },
        })
      })
    },
  }
}
</script>

<style scoped>

</style>