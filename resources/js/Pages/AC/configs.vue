<template>
  <Head title="پیکربندی سایت"></Head>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>پیکربندی سایت</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item">تنظیمات سایت</li>
            <li class="breadcrumb-item active">پیکربندی</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Default box -->
  <div class="card">


    <div class="card-header">
      <h3 class="card-title"> مقادیر مورد نیاز و کارایی سایت</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <WaitButton :on-click="submit" :wait="inProcess" :disabled="inProcess" text="ثبت"/>
      </div>
    </div>
    <div class="card-body">
      <section class="m-2 bg-gray-light rounded p-1" v-for="config in configs" v-show="config.deleted !== true">


        <section class="row" v-if="config.type === 'boolean'">
          <section class="col-5">
            <p class="mb-0">{{ config.name }}</p>
            <p class="mb-0 text-sm text-black-50">نوع : منطقی</p>
            <p class="m1 text-sm text-black-50">کلید : {{ config.key }}</p>
          </section>
          <section class="col-6">
            <span class="m-3">مقدار   :  </span>
            <input class="form-control d-inline w-auto mx-2" type="checkbox" v-model="config.value"
                   @change="modifiedItem(config)">
            <span class="m-2 text-sm text-black-50"  >مقدار فعلی در دیتابیس : {{ config.originalValue }}</span>
          </section>
          <section class="col-1 text-left">
            <span class="fa fa-trash-o m-1 mt-2 text-black cursor-finger" title="حذف"
                  @click="deleteItem(config)"></span>
          </section>
        </section>


        <section class="row" v-if="config.type === 'string'">
          <section class="col-5">
            <p class="mb-0">{{ config.name }}</p>
            <p class="mb-0 text-sm text-black-50">نوع : متنی</p>
            <p class="m1 text-sm text-black-50">کلید : {{ config.key }}</p>
          </section>
          <section class="col-6">
            <span class="m-3">مقدار   :  </span>
            <textarea class="form-control mx-2" v-model="config.value" @change="modifiedItem(config)"></textarea>
            <span class="m-2 text-sm text-black-50"  >مقدار فعلی در دیتابیس : {{ config.originalValue }}</span>
          </section>
          <section class="col-1 text-left">
            <span class="fa fa-trash-o m-1 mt-2 text-black cursor-finger" title="حذف"
                  @click="deleteItem(config)"></span>
          </section>
        </section>


        <section class="row" v-if="config.type === 'float'">
          <section class="col-5">
            <p class="mb-0">{{ config.name }}</p>
            <p class="mb-0 text-sm text-black-50">نوع : عدد</p>
            <p class="m1 text-sm text-black-50">کلید : {{ config.key }}</p>
          </section>
          <section class="col-6">
            <span class="m-3">مقدار   :  </span>
            <input type="number" class="form-control mx-2" v-model="config.value" @change="modifiedItem(config)">
            <span class="m-2 text-sm text-black-50"  >مقدار فعلی در دیتابیس : {{ config.originalValue }}</span>
          </section>
          <section class="col-1 text-left">
            <span class="fa fa-trash-o m-1 mt-2 text-black cursor-finger" title="حذف"
                  @click="deleteItem(config)"></span>
          </section>
        </section>

        <section class="row" v-if="config.type === 'array'">
          <section class="col-5">
            <p class="mb-0">{{ config.name }}</p>
            <p class="mb-0 text-sm text-black-50">نوع : لیست</p>
            <p class="m1 text-sm text-black-50">کلید : {{ config.key }}</p>
          </section>
          <section class="col-6">
            <span class="m-3">مقادیر   :  </span>
            <section>
              <div class="input-group m-2" v-for="val in config.value">
                <div class="custom-file">
                  <input type="text" class="form-control" v-model="val.value" @change="modifiedItem(config)">
                </div>
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary fa fa-trash" type="button"
                          @click="deleteArrayItem(config , val)"></button>
                </div>
              </div>
              <button class="btn  btn-gradient-bg form-control btn fa fa-plus mx-2 " @click="addItem(config)"></button>
            </section>

            <span class="m-2 text-sm text-black-50" >مقدار فعلی در دیتابیس :
              <span v-for="v in config.originalValue"> {{ v.value }} , </span>
            </span>
          </section>
          <section class="col-1 text-left">
            <span class="fa fa-trash-o m-1 mt-2 text-black cursor-finger" title="حذف"
                  @click="deleteItem(config)"></span>
          </section>
        </section>

      </section>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <label class="mx-2"> نام : </label>
      <input type="text" class="form-control d-inline w-auto" maxlength="30" v-model="addForm.name">

      <label class="mx-2"> کلید : </label>
      <input type="text" class="form-control d-inline w-auto" maxlength="30" v-model="addForm.key">

      <label class="mx-2"> نوع : </label>
      <select class="custom-select d-inline w-auto ml-2" v-model="addForm.type">
        <option value="string">متن</option>
        <option value="float">عدد</option>
        <option value="boolean">منطقی</option>
        <option value="array">لیست</option>
      </select>
      <WaitButton :on-click="addConfig" :wait="inProcess" :disabled="inProcess" text="اضافه کردن"/>

      تقدیم با عشق به سید بالاخض کپچاییه
    </div>
    <!-- /.card-footer-->
  </div>
</template>

<script>
import ACLayout from "../../Shared/ACLayout";
import WaitButton from "../../Shared/Components/WaitButton";
import {Inertia} from "@inertiajs/inertia";

export default {
  name: "configs",
  layout: ACLayout,
  props: ["configs", 'errors'],
  components: {WaitButton},
  data() {
    return {
      modified: [],
      deleted: [],
      addForm: {
        name: "",
        key: "",
        type: "string"
      },
      inProcess: false,
    }
  },
  created() {
    this.convertArrayData()
  },
  methods: {
    submit() {
      this.inProcess = true
      let deleted = []
      let modified = []

      for (let modify of this.modified) {
        let data = { id : modify.id}
        if (modify.type === "array" && ! this.modified !== []){
          data.value = Object.values(modify.value)
        }
        else{
          data.value = modify.value
        }
        modified.push(data)
      }

      for (let del of this.deleted){
        deleted.push(del.id)
      }

      Inertia.post(this.route("ac.config.store"), {
        modified : modified,
        deleted : deleted
      }, {
        onError: err => {
          console.log(err)
          this.showTypedToast(Object.values(err) , "error", "bottom-right");
        },
        onSuccess: page => {
          this.toast("تغیرات جدید با موفقیت اعمال شد.", "success", "bottom-right")
          this.convertArrayData()
        },
        onFinish: v => {
          this.inProcess = false
        },
      })

    },
    addConfig() {
      if (this.addForm.name.trim() === "") {
        this.toast("نام را وارد کنید", "error", "bottom-right")
        return
      }
      if (this.addForm.key.trim() === "") {
        this.toast("کلید دسترسی را وارد کنید", "error", "bottom-right")
        return
      }

      this.inProgress = true;
      Inertia.post(this.route("ac.config.add"), {
        name: this.addForm.name.trim(),
        key: this.addForm.key.trim(),
        type: this.addForm.type
      }, {
        onError: err => {
          this.showTypedToast(Object.values(err), "error", "bottom-right");
        },
        onSuccess: page => {
          this.toast("کانفیگ جدید با موفقیت ثبت شد.", "success", "bottom-right")
          this.addForm.key = this.addForm.name = ""
          this.convertArrayData()
        },
        onFinish: v => {
          this.inProcess = false
        }
      })
    },
    addItem(config) {
      config.value.push({value: ""})
      this.modifiedItem(config)
    },
    deleteArrayItem(config, item) {
      if (window.confirm("از حذف مقدار '" + item.value + " ' مطمعین هستید؟")) {
        let index = config.value.indexOf(item)
        config.value.splice(index, 1)
        this.modifiedItem(config)
      }
    },
    deleteItem(config) {
      if (window.confirm("از حذف '" + config.name + " ' مطمعین هستید؟")) {
        if (this.deleted.indexOf(config) === -1) {
          this.deleted.push(config);
        }
        config.deleted = true
      }
    },
    modifiedItem(config) {
      if (this.modified.indexOf(config) === -1) {
        this.modified.push(config)
      }
    },
    convertArrayData(){
      for (let i = 0; i < this.configs.length; i++) {
        if (this.configs[i].type === "array") {
          let value = []
          for (let j = 0; j < this.configs[i].value.length; j++) {
            value.push({value: this.configs[i].value[j]})
          }
          this.configs[i].value = value
        }

        this.configs[i].originalValue = this.cloneObject(this.configs[i].value)
      }
    }
  }
}
</script>

<style scoped>
.cursor-finger {
  cursor: pointer;
}
</style>