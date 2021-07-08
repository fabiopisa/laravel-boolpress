<template>
  <div>
    <h1>Il mio Blog</h1>
    <div>

      <div 
      v-if="!loaded"
      class="loader">
        <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
      </div>

      <section v-if="loaded">
        <div 
        v-for="post in posts"
        :key="'p'+post.id"
        class="card mb-3">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h5 class="card-title">{{post.title}}</h5>
              <span class="badge badge-success custom-badge">{{post.category}}</span>
            </div>
            <i>{{formatDate(post.date)}}</i>
            <p class="card-text">{{post.content}}.</p>
            <a href="#" class="btn btn-primary">Vai</a>
          </div>
        </div>

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

export default {
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

/* loader */
.loader{
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  .lds-roller {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
  }
  .lds-roller div {
    animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
    transform-origin: 40px 40px;
  }
  .lds-roller div:after {
    content: " ";
    display: block;
    position: absolute;
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: lightseagreen;
    margin: -4px 0 0 -4px;
  }
  .lds-roller div:nth-child(1) {
    animation-delay: -0.036s;
  }
  .lds-roller div:nth-child(1):after {
    top: 63px;
    left: 63px;
  }
  .lds-roller div:nth-child(2) {
    animation-delay: -0.072s;
  }
  .lds-roller div:nth-child(2):after {
    top: 68px;
    left: 56px;
  }
  .lds-roller div:nth-child(3) {
    animation-delay: -0.108s;
  }
  .lds-roller div:nth-child(3):after {
    top: 71px;
    left: 48px;
  }
  .lds-roller div:nth-child(4) {
    animation-delay: -0.144s;
  }
  .lds-roller div:nth-child(4):after {
    top: 72px;
    left: 40px;
  }
  .lds-roller div:nth-child(5) {
    animation-delay: -0.18s;
  }
  .lds-roller div:nth-child(5):after {
    top: 71px;
    left: 32px;
  }
  .lds-roller div:nth-child(6) {
    animation-delay: -0.216s;
  }
  .lds-roller div:nth-child(6):after {
    top: 68px;
    left: 24px;
  }
  .lds-roller div:nth-child(7) {
    animation-delay: -0.252s;
  }
  .lds-roller div:nth-child(7):after {
    top: 63px;
    left: 17px;
  }
  .lds-roller div:nth-child(8) {
    animation-delay: -0.288s;
  }
  .lds-roller div:nth-child(8):after {
    top: 56px;
    left: 12px;
  }
  @keyframes lds-roller {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }
}
/* /loader end */

</style>