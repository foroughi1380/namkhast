<template>
  <Layout>

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>صفحه خالی</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">خانه</a></li>
              <li class="breadcrumb-item active">صفحه خالی</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Default box -->
    <div class="card">



      <div class="card-header">
        <h3 class="card-title">عنوان</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="card-body">


        <Link href="users" class="nav-link">

          click me

        </Link>


        سلام شما در داشبورد هستید.
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        فوتر
      </div>
      <!-- /.card-footer-->
    </div>

  </Layout>
  <!-- /.card -->
</template>

<script>
import Layout from '../../Shared/ACLayout';
export default {
  name: "dashboard",
  components : {Layout}
}
</script>

<style scoped>

</style>