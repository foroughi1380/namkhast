<template>
  <Head title="ویرایش ادمین"></Head>
  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">ویرایش کاربر '{{ user.name }} {{ user.family }}'</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <div class="card-body">
      <div class="form-group">
        <label for="name" class="col-sm-2 control-label">نام</label>
        <div class="col-sm-10">
          <input type="text" v-model="name" class="form-control" name="name" id="name"
                 placeholder="نام خود را وارد کنید">
        </div>
      </div>

      <div class="form-group">
        <label for="name" class="col-sm-2 control-label">نام خانوادگی</label>
        <div class="col-sm-10">
          <input type="text" v-model="family" class="form-control" name="family" id="family"
                 placeholder="نام خانوادگی خود را وارد کنید">
        </div>
      </div>

      <div class="form-group">
        <label for="name" class="col-sm-2 control-label">شماره تلفن</label>
        <div class="col-sm-10">
          <input type="number" v-model="phone" class="form-control" name="phone" id="phone"
                 placeholder="شماره تماس خود را وارد کنید">
        </div>
      </div>

      <div class="form-group">
        <label for="iban" class="col-sm-2 control-label">شماره شبا</label>
        <div class="col-sm-10">
          <input type="number" v-model="iban" class="form-control" name="iban" id="iban"
                 placeholder="شماره شبا را وارد کنید">
        </div>
      </div>


      <p class="text-danger " v-for="error in errors" v-text="error"></p>

    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <WaitButton text="ویرایش" :wait="inProcess" :on-click="editInfo" :disabled="inProcess"/>

    </div>
    <!-- /.card-footer -->
  </div>
</template>


<script>
import AcLayout from "../../Shared/ACLayout";
import {Inertia} from "@inertiajs/inertia";
import WaitButton from "../../Shared/Components/WaitButton";
import SimpleInputFile from "../../Shared/Components/SimpleInputFile";

export default {
  name: "userEdit",
  components:{WaitButton , SimpleInputFile},
  layout: AcLayout,
  props: {
    user: {},
    errors: {},
  },
  data() {
    return {
      name: "",
      family: "",
      phone: "",
      iban: "",
      inProcess: false
    }
  },
  created() {
    this.name = this.user.name
    this.family = this.user.family
    this.phone = this.user.phone
    this.iban = this.user.iban
  },
  methods: {
    editInfo() {
      this.generateRecaptchaToken('editUser').then(token => {

        this.inProcess = true;
        Inertia.put('/ac/user/update/' + this.user.id, {
          name: this.name,
          family: this.family,
          phone: this.phone,
          iban: this.iban,
          token:token,
        }, {
          onSuccess: page => {
            window.location.href = '/ac/user'
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