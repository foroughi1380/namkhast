<template>
  <Head title="درخواست های برداشت"></Head>

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>درخواست های برداشت</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="#">امور مالی</a></li>
            <li class="breadcrumb-item active">لیست درخواست های برداشت</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">درخواست های برداشت</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered text-center">
        <tbody><tr>
          <th style="width: 10px">#</th>
          <th>شماره کاربری</th>
          <th>مبلغ</th>
          <th>وضعیت</th>
          <th>عملیات</th>
        </tr>
        <tr v-for="wdRequest in wdRequests">
          <td>1</td>
          <td>{{ wdRequest.user_id }}</td>
          <td>{{ wdRequest.price }}</td>
          <td>{{ wdRequest.status == 'pending'? 'پرداخت شده' : 'در انتظار پرداخت' }}</td>
          <td>
            <div class="row text-center ">
              <Link method="post" :href="'/ac/withdraw-request/change-status/' + wdRequest.id" class="btn mx-auto btn-warning col-4">تغییر وضعیت</Link>
              <Link :href="'/ac/withdraw-request/show/' + wdRequest.id" class="btn mx-auto btn-info col-4">جزئیات</Link>
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
  name: "withdrawRequest",
  layout: AcLayout,
  props:{
    wdRequests : {}
  }
}
</script>

<style scoped>

</style>