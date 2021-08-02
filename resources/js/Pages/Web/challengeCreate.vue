<template>
  <Head>
    <title>ثبت چالش جدید</title>
    <link rel="stylesheet" type="text/css" href="/theme/web/app-assets/css-rtl/plugins/forms/wizard.css">
  </Head>

  <!-- Section 1 -->
  <section id="number-tabs">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">چالش جدید خود را ثبت کنید</h4>
          </div>
          <div class="card-content">
            <div class="card-body">

                  <div class="row">
                    <div class="col-md-2 col-sm-12 d-flex justify-content-center align-items-center flex-column" >
                      <img :src="challenge.picture" alt="users avatar" class="users-avatar-shadow rounded" height="150" width="150" v-if="challenge && challenge.picture">
                      <img src="/theme/web/app-assets/images/portrait/small/avatar-s-18.jpg" alt="users avatar" class="users-avatar-shadow rounded" height="150" width="150" v-else>
                      <simple-input-file id="picture" v-model="picture" label="تصویر الحاقی" accept="image/*" name="picture"  :disabled="inProcess"/>
                    </div>

                    <div class="col-md-10 col-sm-12">

                      <div class="col-12">
                        <div class="form-group">
                          <label for="title">عنوان</label>
                          <input type="text" class="form-control" id="title" name="title" v-model="title"   :disabled="inProcess">
                        </div>
                        <p class="text-danger text-sm" v-text="errors.title" v-if="errors.title"></p>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="description">توضیحات </label>
                          <CkSimpleEditor></CkSimpleEditor>
                        </div>
                        <p class="text-danger text-sm" v-text="errors.description" v-if="errors.description"></p>
                      </div>

                    </div>


                    <section class="col-md-6 col-sm-12 row">
                      <div class="col-md-12 col-sm-12">
                        <label for="startDate"> تاریخ شروع : </label>
                        <date-picker id="startDate" class="col-md-6 col-sm-12" show-today min-date="today" v-model="startDate"  :disabled="inProcess"/>
                        <p class="text-danger text-sm" v-text="errors.startDate" v-if="errors.startDate"></p>
                      </div>

                      <div class="col-md-12 col-sm-12">
                        <label for="endDate"> تاریخ پایان : </label>
                        <date-picker id="endDate" class="col-md-6 col-sm-12" :min-date="startDate" v-model="endDate"  :disabled="inProcess"/>
                        <p class="text-danger text-sm" v-text="errors.endDate" v-if="errors.endDate"></p>
                      </div>
                    </section>

                    <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="budget">مبلغ جایزه</label>
                        <input type="number" class="form-control" id="budget" v-model="budget" :min="minBudget" :max="maxBudget" step="100"  :disabled="inProcess">
                        <div class="row mx-auto">
                          <span class="col-6 small text-muted">حداقل {{ minBudget }} تومان و حداکثر {{ maxBudget }} تومان</span>
                        </div>
                      </div>
                      <p class="text-danger text-sm" v-text="errors.budget" v-if="errors.budget"></p>
                    </div>



                    <div class="col-md-6 col-sm-12">
                      <label for="category">دسته بندی</label>
                      <fieldset class="form-group">
                        <select class="form-control" id="category" name="category" v-model="category" :disabled="inProcess">
                          <option v-for="category in challengeCategories" v-text="category" :value="category"></option>
                        </select>
                      </fieldset>
                      <p class="text-danger text-sm" v-text="errors.category" v-if="errors.category"></p>
                    </div>


                    <div class="col-md-3 col-sm-6 mt-2">
                      <div class="vs-checkbox-con vs-checkbox-primary">
                        <input type="checkbox" name="type" v-model="isCost">
                        <span class="vs-checkbox">
                            <span class="vs-checkbox--check">
                                <i class="vs-icon feather icon-check"></i>
                            </span>
                        </span>
                        <span class="">دارای هزینه ورودی به چالش</span>
                      </div>
                      <p class="text-danger text-sm" v-text="errors.isCost" v-if="errors.isCost"></p>
                    </div>

                    <div class="col-md-3 col-sm-6">
                      <div class="form-group" v-if="isCost">
                        <label for="payd_value">مبلغ ورودی</label>
                        <select class="custom-select" id="payd_value" v-model="costPrice"  :disabled="inProcess">
                          <option v-for="price in participantPrices" v-text="price" :value="price"></option>
                        </select>
                        <p class="text-danger text-sm" v-text="errors.costPrice" v-if="errors.costPrice"></p>
                      </div>
                    </div>



                    <div class="col-md-6 col-m-12">
                      <div class="col-12">
                        <fieldset class="form-group">
                          <label for="document">فایل های مستندات</label>
                          <div class="custom-file">
                            <simple-input-file  id="document" label="فایل مستندات" name="document" v-model="document"  :disabled="inProcess"/>
                          </div>
                        </fieldset>

                        <p class="text-danger text-sm" v-text="errors.document" v-if="errors.document"></p>
                      </div>
                    </div>

                    <div class="col-md-6 col-sm-12 mt-3">
                      <ul>
                        <li>در صورت انتخاب گزینه شرکت به صورت ورودی دار کارمزد دریافتی از شما نصف خواهد شد.</li>
                        <li>در صورت نهایی کردن چالش و پرداخت هزینه امکان ویرایش برای شما وجود ندارد.</li>
                        <li>بهتر است برای دریافت هرچه بیشتر کارایی حداقل ۱۰ روز فرصت برای شرکت کنندگان قرار دهید</li>
                        <li>تصویر چالش را به گونه ای انتخاب کنید که به انتخاب نام کمک کند.</li>
                        <li>در صورت نیاز در متن به صورت واضح تمامی موارد مورد توجه را بنویسید و بقیه را در مستندات اپلود کنید</li>
                      </ul>
                    </div>

                    <div class="col-12 h-auto">
                      <button class=" ml-2 btn btn-primary waves-effect waves-light" type="submit" :disabled="inProcess">ثبت نهایی و پرداخت</button>
                      <button class=" ml-2 btn btn-secondary waves-effect waves-light" @click="submit"  :disabled="inProcess">ذخیره پیش نویس</button>
                    </div>
                  </div>


            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End: Section 1 -->

</template>

<script>
import appLayout from "../../Shared/appLayout";
import DatePicker from "../../Shared/Components/datePicker";
import SimpleInputFile from "../../Shared/Components/SimpleInputFile";
import {Inertia} from "@inertiajs/inertia";
import CkSimpleEditor from "../../Shared/Components/CkSimpleEditor";

export default {
  name: "challengeCreate",
  components: {SimpleInputFile, DatePicker , CkSimpleEditor},
  layout: appLayout,
  props : ["participantPrices" , "challengeCategories" , 'errors' , 'maxBudget' , 'minBudget' , 'challenge'],
  data() {
    return {
      inProcess : false,
      isCost: false,
      startDate: null,
      endDate : null,
      title : "",
      description : "",
      budget : 5000,
      category : null,
      costPrice : null ,
      picture : null,
      document : null,
    }
  },
  created() {
    this.init()
  },
  methods:{
    init(){
      if (this.challenge){
        this.isCost = this.challenge.type === "nonfree"
        if (this.isCost){
          this.costPrice = this.challenge.cost;
        }
        this.startDate = this.challenge.started_at;
        this.endDate = this.challenge.expiration_at;
        this.title = this.challenge.title;
        this.description = this.challenge.description;
        this.category = this.challenge.category;
        this.budget = this.challenge.budget;
      }
    },
    submit(){
      if (this.formValidate()){
        this.inProcess = true;
        let opt = {
          onError : err=>{
            this.toast("لطفا مشکلات را برسی کنید" , "error")
          },
          onSuccess:page =>{
            this.toast("چالش شما یا موفقیت ذخیره شد.")
            this.init();
          },
          onFinish : a=>{
            this.inProcess = false;
          }
        }

        if (this.challenge){
          let data = this.generateData();
          data._method =  'put';

          Inertia.post(this.route("challenge.update" , this.challenge.id) , data , opt)
        }else {
          Inertia.post(this.route("challenge.store") , this.generateData() , opt)
        }



      }
    },
    formValidate(){
      let flag  = true;

      this.errors.title = undefined;
      if (this.title == null || this.title.trim() === "" ||  this.title.trim().length > 255 || this.title.trim().length < 5){
        this.errors.title = "موضوع باید حداقل ۵ و حداکثر ۲۵۵ کاراکتر باشد."
        flag = false
      }

      this.errors.description = undefined;
      if (this.description == null || this.description.trim() === "" ||  this.description.trim().length > 5000 || this.description.trim().length < 20){
        this.errors.description = "توضیحات باید حداقل ۲۰ و حداکثر ۵۰۰۰ کاراکتر باشد."
        flag = false
      }

      this.errors.budget = undefined;
      if (this.budget > this.maxBudget || this.budget < this.minBudget || this.budget % 100 !== 0){
        this.errors.budget = "مبلغ ورودی معتبر نیست مبلغ ورودی باید ۲ رقم سمت راست آن صفر باشد و کمترین و بیشترین را رعایت کرده باشید."
        flag = false
      }


      this.errors.startDate = undefined;
      if (! this.startDate){
        this.errors.startDate = "تاریخ صحیح نمیباشد"
        flag = false
      }


      this.errors.endDate = undefined;
      if (! this.endDate){
        this.errors.startDate = "تاریخ صحیح نمیباشد"
        flag = false
      }

      this.errors.costPrice = undefined;
      if (this.isCost && (this.costPrice == null || this.costPrice === "")){
        this.errors.costPrice = "لطفا مبلغ را انتخاب کنید."
        flag = false
      }

      this.errors.category = undefined;
      if (this.challengeCategories.indexOf(this.category) === -1){
        this.errors.category = "دسته بندی را انتخاب کنید"
        flag = false
      }

      return flag;
    },
    generateData(){
      let data = {}
      data.title = this.title.trim();
      data.description = this.description.trim();
      data.budget = this.budget;
      data.isCost = this.isCost;
      data.startDate = this.startDate;
      data.endDate = this.endDate;
      data.category = this.category;

      if (this.isCost){
        data.costPrice = this.costPrice
      }

      if (this.picture){
        data.picture = this.picture;
        // form.append("picture" , this.picture);
      }
      if (this.document){
        data.document = this.document;
        // form.append("document" , this.document)
      }

      // if (this.picture || this.document){
      //   let form = new FormData();
      //   for (let d in data){
      //     form.append(d , data[d]);
      //   }
      //
      //   if (this.picture){
      //     //data.picture = this.picture;
      //     form.append("picture" , this.picture);
      //   }
      //   if (this.document){
      //     //data.document = this.document;
      //     form.append("document" , this.document)
      //   }
      //   return form;
      // }


      return data;
    }
  }

}
</script>

<style scoped>

</style>