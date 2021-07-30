<template>
  <Head title="ادمین ها"></Head>

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>ادمین ها</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="#">ادمین ها</a></li>
            <li class="breadcrumb-item active">لیست ادمین ها</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">ادمین های سیستم</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered">
        <tbody><tr>
          <th style="width: 10px">#</th>
          <th>نام</th>
          <th>نام خانوادگی</th>
          <th>شماره تماس</th>
          <th>ایمیل</th>
          <th>عملیات</th>
        </tr>
        <tr v-for="admin in admins">
          <td>1</td>
          <td>{{ admin.name }}</td>
          <td>{{ admin.family }}</td>
          <td>{{ admin.phone }}</td>
          <td>{{ admin.email }}</td>
          <td>
            <div class="row text-white text-center mx-auto">
              <Link :href="'/ac/admin/edit/' + admin.id" class="btn btn-info m-1 col-5">ویرایش</Link>
              <Link method="delete" :href="'/ac/admin/delete/' + admin.id" class="btn btn-danger m-1 col-5">حذف</Link>
            </div>
          </td>
        </tr>
        </tbody></table>
    </div>
  </div>
</template>

<script>
import AcLayout from "../../Shared/ACLayout";

export default {
  name: "admins",
  layout: AcLayout,
  props:{
    admins : {}
  }
}
</script>

<style scoped>

</style>