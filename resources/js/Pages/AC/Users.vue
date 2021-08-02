<template>
  <Head title="کاربران"></Head>

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>لیست کاربران</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="#">کاربران</a></li>
            <li class="breadcrumb-item active">لیست کاربران</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">کاربران سیستم</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered text-center">
        <tbody>
        <tr>
          <th style="width: 10px">#</th>
          <th>نام</th>
          <th>نام خانوادگی</th>
          <th>شماره تماس</th>
          <th>شماره شبا</th>
          <th>تصویر</th>
          <th>وضعیت</th>
          <th>عملیات</th>
        </tr>
        <tr v-for="user in users">
          <td>1</td>
          <td>{{ user.name }}</td>
          <td>{{ user.family }}</td>
          <td>{{ user.phone }}</td>
          <td>{{ user.iban }}</td>
          <td><img :src="user.picture" width="50" height="50" alt="user avatar"></td>
          <td>{{ user.status == 'active'? 'فعال' : 'غیرفعال' }}</td>
          <td style="width: 180px">
            <div class="row text-white text-center mx-auto">
              <Link :href="'/ac/user/edit/' + user.id" class="btn btn-info m-1 col-5">ویرایش</Link>
              <Link method="delete" :href="'/ac/user/delete/' + user.id" class="btn btn-danger m-1 col-5">حذف</Link>
              <Link method="post" :href="'/ac/user/change-status/' + user.id" class="text-white  btn btn-warning m-1 btn-block">تغییر وضعیت</Link>
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
  name: "Users",
  layout: ACLayout,
  props:{
    users : {}
  }
}
</script>

<style scoped>

</style>