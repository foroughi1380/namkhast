<template>
  <Head title="جزئیات درخواست های احراز هویت"></Head>

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
            <li class="breadcrumb-item active">جزئیات درخواست برداشت</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="card ">
    <div class="card-header">
      <h4>درخواست برداشت کاربر '{{ user.name }} {{ user.family }}'</h4>
      <p class="my-3">کاربر '{{ user.name }} {{ user.family }}' به شماره ملی '{{ user.national_code }}' ، درخواست برداشت وجه به مبلغ '{{ wdRequest.price }}' به شماره شبا '{{ user.iban }}' ثبت نمود.</p>
      <Link href="/ac/withdraw-request" class="btn btn-info ">بازگشت</Link>
    </div>
    <div class="card-body text-center">

    </div>

    <div class="card-footer">
      <WaitButton text="ویرایش" :wait="inProcess" :on-click="editInfo" :disabled="inProcess"/>
    </div>
  </div>
</template>

<script>
import AcLayout from "../../Shared/ACLayout";

export default {
  name: "withdrawRequestDetail",
  layout: AcLayout,
  props:{
    wdRequest : {},
    user:{}
  }
}
</script>

<style scoped>

</style>