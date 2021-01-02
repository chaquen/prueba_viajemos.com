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
          <th scope="col">Autor</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="libro in libros" v-bind:key="libro.id"> 
          <th scope="row">{{libro.id}}</th>
          <td>{{libro.titulo}}</td>
          <td>{{libro.sinopsis}}</td>
          <td>{{libro.editorial}}</td>
          <td>{{libro.autor}}</td>
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
          
          let lib = res.data.data.map(function(d){
            console.log(d);
                if(d.titulo != undefined){
                    return {
                                id:d.id,
                                titulo:d.titulo,
                                sinopsis:d.sinopsis, 
                                editorial: d.editorial.nombre,
                                n_paginas:d.n_paginas,
                                ISBN:d.ISBN,
                                autor:d.autor.nombre+" "+d.autor.apellidos

                                                               
                            }                 
                }
            });
            this.libros = lib;          
        })
    }
  }
</script>

<style>
  h3 {
    margin-bottom: 5%;
  }
</style>
