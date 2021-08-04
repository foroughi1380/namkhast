<template>
  <Head :title="myTitle"></Head>
  <section>
    <div class=" col-12">
      <div class="content-body content-detached content-right col-sm-12 col-md-9">

        <!-- background Overlay when sidebar is shown  starts-->
        <div class="shop-content-overlay font-weight-bold ">{{myTitle}} : </div>
        <!-- background Overlay when sidebar is shown  ends-->

        <!-- Ecommerce Search Bar Starts -->
        <section id="ecommerce-searchbar">
          <div class="row mt-1">
            <div class="col-sm-12">
              <fieldset class="form-group position-relative">
<!--                <input type="text" class="form-control search-product" id="iconLeft5" placeholder="جستجو ..." v-model="search[0].target" >-->
                <input type="text" class="form-control search-product" id="iconLeft5" placeholder="جستجو ..." v-model="query.search[0].target">
                <div class="form-control-position">
                  <i class="feather icon-search"></i>
                </div>
              </fieldset>
            </div>
          </div>
        </section>
        <!-- Ecommerce Search Bar Ends -->

        <ChallengeRow v-if="chs" v-for="ch in chs.data" :challenge="ch"/>

        <!-- Ecommerce Pagination Starts -->
        <Pginate :data="chs" :query="query"></Pginate> <!-- Ecommerce Pagination Ends -->

      </div>


      <div class="sidebar-detached sidebar-left col-sm-12 col-md-3">
        <div class="sidebar">
          <!-- Ecommerce Sidebar Starts -->
          <div class="sidebar-shop" id="ecommerce-sidebar-toggler">
            <div class="card">
              <div class="card-body">
                <!-- Filter -->
                <div class="brands">
                  <div class="brand-title mt-1 pb-1">
                    <h6 class="filter-title mb-0">دسته بندی ها</h6>
                  </div>
                  <div class="brand-list" id="brands">
                    <ul class="list-unstyled">


                      <li class="d-flex justify-content-between align-items-center py-25" v-for="category in category_set" @change="filter(category)">
                        <span class="vs-checkbox-con vs-checkbox-primary">
                            <input type="checkbox" value="false">
                            <span class="vs-checkbox">
                                <span class="vs-checkbox--check">
                                    <i class="vs-icon feather icon-check"></i>
                                </span>
                            </span>
                            <span v-text="category"></span>
                        </span>
                      </li>


                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Ecommerce Sidebar Ends -->

        </div>
      </div>
    </div>
  </section>
</template>

<script>
import appLayout from "../../Shared/appLayout";
import ChallengeRow from "../../Shared/Components/ChallengeRow";
import Pginate from "../../Shared/Components/Pginate";

export default {
  name: "myChallenge",
  layout: appLayout,
  props : {"chs" : [] , "myTitle": {
      type:String,
      default : "چالش های من"
    }, "category_set" : []},
  components:{ChallengeRow , Pginate},
  data(){
    return {
      query : {
        search : [
          {
            column : "title",
            target : ""
          }
        ],
        parsable : [
          {
            column : "category",
            queries: ""
          }
        ]
      },
      title : null,
      categoryFilter : []
    }
  },
  methods : {
    filter(category){

      if (this.categoryFilter.indexOf(category) !== -1){
        this.categoryFilter.splice(this.categoryFilter.indexOf(category) , 1)
      }else{
        this.categoryFilter.push(category)
      }

      let query = this.categoryFilter[0] ? this.categoryFilter[0] : ""
      for (let i = 1; i < this.categoryFilter.length; i++) {
        query += "," + this.categoryFilter[i]
      }

      this.query.parsable[0].queries = query;
    }
  }
}
</script>

<style scoped>

</style>