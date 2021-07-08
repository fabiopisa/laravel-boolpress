<template>
  <header class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
      <a class="navbar-brand" href="#">Boolpress</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <router-link class="nav-link" :to="{name:'home'}">Home</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{name:'about'}">Chi sono</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{name:'blog'}">Blog</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{name:'contacts'}">Contacts</router-link>
          </li>
          
        </ul>
        
      </div>
    </nav>
  </header>
</template>

<script>
export default {
  name: 'Header'
}
</script>

<style lang="scss" scoped>

</style>