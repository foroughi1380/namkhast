<template>
  <Head title="درخواست های احراز هویت"></Head>

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>لیست درخواست های احراز هویت</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="#">درخواست های احراز هویت</a></li>
            <li class="breadcrumb-item active">لیست درخواست های احراز هویت</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">درخواست های احراز هویت</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered text-center">
        <tbody>
        <tr>
          <th style="width: 10px">#</th>
<!--          <th>نام و نام خانوادگی کاربر</th>-->
          <th>دفعات تلاش</th>
          <th>کد ملی</th>
          <th>وضعیت</th>
          <th>عملیات</th>
        </tr>
        <tr v-for="(authRequest , index) in authRequests">
          <td>{{index+1}}</td>
<!--          <td v-for="user in users">{{ authRequest.user_id == user.id ? user.name + ' ' + user.family : ''}}</td>-->
          <td>{{ authRequest.try }}</td>
          <td>{{ authRequest.national_code }}</td>

          <td class="text-success" v-if="authRequest.status == 'accept' ">تایید شده</td>
          <td class="text-info" v-if="authRequest.status == 'pending' ">در انتظار تایید</td>
          <td class="text-warning" v-if="authRequest.status == 'reject' ">رد شده</td>
          <td class="text-danger" v-if="authRequest.status == 'block' ">مسدود شده</td>

          <td style="width: 180px">
            <div class="row text-white text-center mx-auto">
              <Link :href="'/ac/auth-request/edit/' + authRequest.id" class="btn btn-info m-1 btn-block">بررسی</Link>
            </div>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
  <!-- /.card -->
</template>


<script>
import ACLayout from "../../Shared/ACLayout";

export default {
  name: "authRequests",
  layout: ACLayout,
  props:{
    authRequests : {},
    users: {}
  }
}
</script>

<style scoped>

</style>