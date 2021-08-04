<template>
  <section id="ecommerce-pagination">
    <div class="row">
      <div class="col-sm-12">
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center mt-2">
            <li class="page-item prev-item"   v-if="data.prev_page_url"><a class="page-link" @click="prev" ></a></li>
            <li class="page-item active"><a class="page-link" v-text="data.current_page"></a></li>
            <li class="page-item next-item" v-if="data.next_page_url"><a class="page-link" @click="next"></a></li>
          </ul>
        </nav>
      </div>
    </div>
  </section>
</template>

<script>
import {Inertia} from "@inertiajs/inertia";

export default {
  name: "Pginate",
  props:['data', 'query'],
  data(){
    return {
    }
  },
  watch : {
    query: {
      handler(n, o) {
        console.log("detected")
        Inertia.get(this.data.first_page_url + this.getSearch() , {} , {preserveState : true})
      },
      deep: true
    },
  },
  methods :{
    getSearch(){
      if (this.query){
        //return axios.create({ url: '/user', baseUrl: 'https://my-api-server'}).getUri({params:this.query})
        return "&" + axios.getUri({
          url : "",
          params : this.query
        });
      }
      return ""
    },
    next(){
      Inertia.get(this.data.next_page_url + this.getSearch() , {} , {preserveState : true})
    },
    prev(){
      Inertia.get(this.data.prev_page_url + this.getSearch() , {} , {preserveState : true})
    }
  }
}
</script>

<style scoped>

</style>