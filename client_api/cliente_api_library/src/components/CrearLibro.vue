<template>
  <div>
    <form>
        <div class="form-group">
            <label for="isbn">ISBN libro</label>
            <input type="text" class="form-control" id="inpIsbn" placeholder="Ingrese el ISBN del libro" v-model="form.ISBN">   
        </div>
        <div class="form-group">
            <label for="title">Titulo libro</label>
            <input type="text" class="form-control" id="inpTitulo" placeholder="Ingrese el titulo del libro" v-model="form.titulo">   
        </div>
        <div class="form-group">
            <label for="Sinopsis">Sinopsis libro</label>
             <textarea class="form-control" id="txtSinopsis" rows="3" v-model="form.sinopsis"></textarea>            
                 <small id="emailHelp" class="form-text text-muted">Ingrese una breve sinopsis del libro {{form.titulo}}.</small>
        </div>
        <div class="form-group">
            <label for="title">editorial libro</label>
            <input type="text" class="form-control" id="inpEditorial" placeholder="Ingrese la editorial del libro" v-model="form.editorial">   
        </div>
        <div class="form-group">
            <label for="title">autor del libro</label>
            <input type="text" class="form-control" id="inpAutor" placeholder="Ingrese el autor del libro" v-model="form.autor">   
        </div>
        <div class="form-group">
            <label for="title">número de páginas del libro</label>
            <input type="number" class="form-control" id="nmPages" placeholder="Ingrese el autor del libro" v-model="form.n_paginas">   
        </div>
        <button type="submit" class="btn btn-primary" v-on:click="crearLibro($event)">Crear libro</button>
    </form>
    <b-card class="mt-3" header="Form Data Result">
      <pre class="m-0">{{ form }}</pre>
      <pre class="m-0">{{ msn.mensaje }}</pre>
    </b-card>
  </div>
</template>


<script>
  import axios from 'axios';
  import 'bootstrap/dist/css/bootstrap.css'
  import 'bootstrap-vue/dist/bootstrap-vue.css'
  export default{
    data(){
            return {
                form: {
                    ISBN:'',
                    titulo:'',
                    sinopsis:'',
                    editorial:'',
                    autor:'',
                    n_paginas:0,
                },            
                msn: {
                    mensaje:[]
                }
            }
        },
    methods: 
        {
            crearLibro: function(event) {
                event.preventDefault()
                axios
                .post('http://localhost:88/api/libro',{
                    ISBN:this.form.ISBN,
                    titulo:this.form.titulo,
                    sinopsis:this.form.sinopsis,
                    editoriales_id:this.form.editorial,
                    autores_id:this.form.autor,
                    n_paginas:this.form.n_paginas,
                })
                .then(res => {                
                    //this.libros = res.data.data;
                    console.log(res.data);
                    if(res.data.cod == 400 || res.data.cod == 500)
                    {
                        alert("Ha ocurrido un error");
                        this.msn.mensaje = res.data.message;
                        return false;
                    }else if(res.data.cod == 200)
                    {
                        alert(res.data.message);
                    }
                }).catch(function(error){
                    console.log(error.error.data);
                })
            }
        }
  }
</script>

<style>
  h3 {
    margin-bottom: 5%;
  }
</style>