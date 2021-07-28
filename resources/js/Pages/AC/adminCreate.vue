<template>
  <Head title="افزودن ادمین"></Head>
  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">ویرایش ادمین افزودن ادمین جدید</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <div class="card-body">
      <div class="form-group">
        <label for="name" class="col-sm-2 control-label">نام</label>
        <div class="col-sm-10">
          <input type="text" v-model="name" class="form-control" name="name" id="name" placeholder="نام را وارد کنید" >
        </div>
      </div>

      <div class="form-group">
        <label for="name" class="col-sm-2 control-label">نام خانوادگی</label>
        <div class="col-sm-10">
          <input type="text" v-model="family" class="form-control" name="family" id="family" placeholder="نام خانوادگی را وارد کنید" >
        </div>
      </div>

      <div class="form-group">
        <label for="name" class="col-sm-2 control-label">شماره تلفن</label>
        <div class="col-sm-10">
          <input type="number" v-model="phone" class="form-control" name="phone" id="phone" placeholder="شماره تماس را وارد کنید" >
        </div>
      </div>

      <div class="form-group">
        <label for="email" class="col-sm-2 control-label">ایمیل</label>
        <div class="col-sm-10">
          <input type="email" v-model="email" class="form-control" name="email" id="email" placeholder="ایمیل را وارد کنید">
        </div>
      </div>

      <div class="form-group">
        <label for="password" class="col-sm-2 control-label">کلمه عبور</label>
        <div class="col-sm-10">
          <input type="password" v-model="password" class="form-control" name="password" id="password" placeholder="کلمه عبور را وارد کنید">
        </div>
      </div>
      <p class="text-danger " v-for="error in errors" v-text="error"></p>

    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <button @click="createAdmin" type="submit" class="btn btn-info">
        <span  v-if="!inProcess">افزودن</span>
        <hollow-dots-spinner v-else
                             :animation-duration="1000"
                             :dot-size="10"
                             :dots-num="3"
                             color="#ffffff"
        />
      </button>
    </div>
    <!-- /.card-footer -->
  </div>
</template>

<script>
import AcLayout from "../../Shared/ACLayout";
import {Inertia} from "@inertiajs/inertia";
import {HollowDotsSpinner} from "epic-spinners";

export default {
  name: "adminCreate",
  layout: AcLayout,
  props:{
    errors:{},
  },
  data(){
    return {
      name: "",
      family: "",
      phone: "",
      email: "",
      password:"",
      inProcess: false
    }
  },
  components:{HollowDotsSpinner},
  methods:{
    createAdmin(){
      this.inProcess = true;
      Inertia.post('/ac/admin/store' , {
        name:this.name,
        family:this.family,
        phone:this.phone,
        email:this.email,
        password:this.password
      },{
        onSuccess: page =>{
          window.location.href = "/ac/admin";
        },
        onFinish: visit =>{
          this.inProcess = false;
        }
      })
    },
  }
}
</script>

<style scoped>

</style>