<template>
  <div class="container">
    <h3> Libros:</h3>
    
    <router-view />
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Titulo</th>
          <th scope="col">Sinopsis</th>
          <th scope="col">Editorial</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="libro in libros" v-bind:key="libro.id"> 
          <th scope="row">{{libro.id}}</th>
          <td>{{libro.titulo}}</td>
          <td>{{libro.sinopsis}}</td>
          <td>{{libro.editoriales_id}}</td>
        </tr>
      </tbody>
    </table> 
  </div> 
</template>


<script>
  import axios from 'axios';

  export default {
    name: 'Libros',
    data() {
      return {
        libros: null,
      };
    },
    created: function() {
      axios
        .get('http://localhost:88/api/libro')
        .then(res => {
          
          this.libros = res.data.data;
          console.log(res.data.data);
        })
    }
  }
</script>

<style>
  h3 {
    margin-bottom: 5%;
  }
</style>
