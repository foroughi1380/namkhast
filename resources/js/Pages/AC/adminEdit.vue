<template>
  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">ویرایش ادمین '{{ admin.name }} {{ admin.family }}'</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
      <div class="card-body">
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">نام</label>
          <div class="col-sm-10">
            <input type="text" v-model="name" class="form-control" name="name" id="name" placeholder="نام خود را وارد کنید" >
          </div>
        </div>

        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">نام خانوادگی</label>
          <div class="col-sm-10">
            <input type="text" v-model="family" class="form-control" name="family" id="family" placeholder="نام خانوادگی خود را وارد کنید">
          </div>
        </div>

        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">شماره تلفن</label>
          <div class="col-sm-10">
            <input type="phone" v-model="phone" class="form-control" name="phone" id="phone" placeholder="شماره تماس خود را وارد کنید" >
          </div>
        </div>

        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">ایمیل</label>
          <div class="col-sm-10">
            <input type="email" v-model="email" class="form-control" name="email" id="email" placeholder="ایمیل را وارد کنید">
          </div>
        </div>
        <p class="text-danger " v-for="error in errors" v-text="error"></p>

      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button @click="submit" type="submit" class="btn btn-info">ویرایش</button>
        <button type="reset" class="btn btn-default float-left">پاک کردن</button>
      </div>
      <!-- /.card-footer -->
  </div>
</template>

<script>
import AcLayout from "../../Shared/ACLayout";
import {Inertia} from "@inertiajs/inertia";
import admins from "./admins";

export default {
  name: "adminEdit",
  layout: AcLayout,
  props:{
    admin:{},
    errors:{},
  },
  data(){
    return {
      name : "",
      family : "",
      phone: "",
      email: "",
      inProcess: false
    }
  },
  methods:{
    edit(){
      // this.inProcess = true;

      Inertia.put('/ac/admin/update/' + this.admin.id , {
        name:this.name,
        family:this.family,
        phone:this.phone,
        email:this.email,
      },{
        onSuccess : page=>{
          window.location.redirect('/ac/admin');
        },
        onFinish : visit =>{
          // this.inProcess = false;
        },
      })
    },
  }
}
</script>

<style scoped>

</style>