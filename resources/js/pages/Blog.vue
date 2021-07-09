<template>
  <div>
    <h1>Il mio Blog</h1>
    <div>

      <div 
      v-if="!loaded"
      class="loader">
        <Loader/>
      </div>

      

      <section v-if="loaded">

        <Card
        v-for="post in posts"
        :key="'p'+post.id"
        :title="post.title"
        :category="post.category"
        :date="formatDate(post.date)"
        :content="post.content"
        :slug="post.slug"
        />

        <div>
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li 
              :class="{'disabled': pagination.current === 1}"
              class="page-item">
                <button 
                @click="getPosts(pagination.current -1)"
                class="page-link" href="#">&laquo;</button>
              </li>

              <li 
              v-for="i in pagination.last"
              :class="{'active': pagination.current === i}"
              :key="'i'+i"
              class="page-item">
                <button 
                @click="getPosts(i)"
                class="page-link">
                  {{i}}
                </button>
              </li>

              <li 
              :class="{'disabled': pagination.current === pagination.last}"
              class="page-item">
                <button 
                @click="getPosts(pagination.current + 1)"
                class="page-link" href="#">&raquo;</button>
              </li>
            </ul>
          </nav>
        </div>
      </section>

    </div>
  </div>
</template>

<script>

import axios from 'axios';
import Loader from '../components/Loader.vue';
import Card from '../components/Card.vue';

export default {
  components: {
     Loader,
     Card 
  },
  name: 'Blog',

  data(){
    return{
      posts:[],
      pagination:{},
      loaded: false
    }
  },
  
  methods:{
    getPosts(page = 1){
      axios.get('http://127.0.0.1:8000/api/posts',{
        params:{
          /* il primo page si riferisce è la key dell'url della pagina che vedo dove stampo l'array */
          /* il secondo page  si riferisce al parametro di getPosts*/
          page:page
        }
      })
        .then(res=>{
          this.loaded=false;
          console.log(res.data.data);
          this.posts = res.data.data;
          this.pagination ={
            current: res.data.current_page,
            last: res.data.last_page
          }
          this.loaded =true;
        })
        .catch(err=>{
          console.log(err);
        })
    },

    formatDate(date){
      let d = new Date(date);
      let dy = d.getDate();
      let m = d.getMonth() + 1;
      let y = d.getFullYear();

      if(dy < 10) dy = '0' + dy;
      if(m < 10) m = '0' + m;

      return `${dy}/${m}/${y}`;
    }
  },

  created(){
    this.getPosts();
  }
}
</script>

<style lang="scss" scoped>
.custom-badge{
  display: inline-block;
  height: 2rem;
  line-height: 2rem;
}

.loader{
  display: flex;
  justify-content: center;
  align-items: center;
  height: 30vh;
}


</style>