<template>
  <div id="app">
    
    <div id="nav">
     <router-link to="/">| Libros |</router-link> 
     <router-link to="/Editorial"> | Crear editorial |</router-link> 
     <router-link to="/CrearLibro"> | Crear libro |</router-link>
    </div>    
    <router-view />    
  </div>
</template>

<script>

export default {
  name: 'app',
  components: {
    
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
