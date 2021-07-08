<template>
  <section>
    <Header/>
    <main class="container">
      
      
      <!-- questo è un tag vue che riceeve tutti i componenti inniettati dal router -->
      <router-view></router-view>

    </main>
  </section>
</template>

<script>

import Header from './components/Header.vue'

export default {
  name:'App',

  components:{
    Header
  },
  data(){
    return{

    }
  },
  methods:{

  }
}
</script>

<style lang="scss">
@import '../sass/frontoffice/global';

</style>