<template>
  <Head>
    <title>پیگیری درخواست برداشت</title>
    <link rel="stylesheet" type="text/css" href="/theme/web/app-assets/vendors/css/tables/datatable/datatables.min.css">
  </Head>
  <!-- Zero configuration table -->
  <section id="basic-datatable">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">فهرست درخواست ها</h4>
          </div>
          <div class="card-content">
            <div class="card-body card-dashboard">
              <div class="table-responsive">
                <table class="table zero-configuration">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>مبلغ</th>
                    <th>وضعیت</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="wdRequest in wdRequests">
                    <td>{{ wdRequest.id}}</td>
                    <td>{{ wdRequest.price }} تومان</td>
                    <td>{{ wdRequest.status == 'payed' ? 'پرداخت شده' : 'در انتظار پرداخت' }}</td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import appLayout from "../../Shared/appLayout";

export default {
  name: "withrawTrack",
  layout: appLayout,
  props:{
    wdRequests :{}
  }
}
</script>

<style scoped>

</style>