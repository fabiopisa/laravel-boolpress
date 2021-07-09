<template>
  <div>

    <div v-if="!loaded">
      <Loader/>
    </div>

    <div
    v-else 
    class="card mb-3">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <h5 class="card-title">{{post.title}}</h5>
          <span 
          v-if="post.category"
          class="badge badge-success custom-badge">
            {{post.category.name}}
          </span>
        </div>
        <i>{{post.created_at}}</i>
        <p class="card-text">{{post.content}}.</p>
        <div>
          <i 
          class="badge badge-info badge-custom"
          v-for="tag in post.tags"
          :key="'t'+tag.id"
          >
            {{tag.name}}
          </i>
        </div>
        <router-link class="btn btn-primary" :to="{name:'blog'}">
          Back
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Loader from '../components/Loader.vue';
export default {
  
 name: 'PageDetail',
 components:{
   Loader,
 },
 data(){
   return{
     post:{},
     loaded:false
   }
 },
  mounted(){
    console.log(this.$route.params.slug);
    axios.get('http://127.0.0.1:8000/api/posts/' + this.$route.params.slug)
      .then(res =>{
        console.log(res.data);
        if(res.data.success){
          this.post=res.data.data;
        }else{
          //con questo comando reindirizzo verso la pagina errore 404
          this.$router.push({name:'error404'})
        }
        this.loaded = true;
      })
      .catch(err =>{
        console.log(err);
      })
  }
}

</script>

<style lang="scss" scoped>
.badge-custom{
  margin: 2rem 2rem 2rem 0;
}
.custom-badge{
  display: inline-block;
  height: 2rem;
  line-height: 2rem;
}
</style>