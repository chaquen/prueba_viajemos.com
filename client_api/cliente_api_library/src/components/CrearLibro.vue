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
            <!--<input type="text" class="form-control" id="inpEditorial" placeholder="Ingrese la editorial del libro" v-model="form.editorial">   -->
            <keep-alive>
                <select class="form-control" id="slcEditoriales"
                    v-model="form.editorial"      
                    :filterable="false"     
                    :options="editoriales"
                >
                <option v-for="editorial in editoriales" 
                :value="editorial.id"
                :key="editorial.id"            
                >
                    {{editorial.nombre}}
                </option>
                
                </select>
            </keep-alive>
        </div>
        <div class="form-group">
            <label for="title">autor del libro</label>
            <keep-alive>
                <select class="form-control" id="slcEditoriales"
                    v-model="form.autor"      
                    :filterable="false"     
                    :options="autores"
                >
                <option v-for="autor in autores" 
                :value="autor.id"
                :key="autor.id"            
                >
                    {{autor.nombre}}
                </option>
                
                </select>
            </keep-alive>
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
                editoriales:[], 
                autores:[], 
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
                    if(res.data.cod == 400 || res.data.cod == 500)
                    {
                        this.msn.mensaje=res.data.message;
                        this.msn.mensaje=res.data.error;
                        return false;
                    }else if(res.data.cod == 200)
                    {
                        this.msn.mensaje = res.data.message;
                    }
                }).catch(function(error){
                    this.msn.mensaje = error.error.data;
                })
            },            
            selectedOption: function(value){
                console.log("value : " + value);
            },
            getDataApi: function(){
                axios.get('http://localhost:88/api/editorial')
                .then(response => {
                    this.editoriales = response.data.data;
                    this.msn.mensaje = response.data.message;                                            
                }).catch(error => {
                    console.log(error);
                });
                axios.get('http://localhost:88/api/autor')
                .then(response => {
                    this.autores = response.data.data;
                    this.msn.mensaje = response.data.message;
                }).catch(error => {
                    console.log(error);
                });
            }
        }, 
    created(){
        this.getDataApi();
    }       
  }
</script>

<style>
  h3 {
    margin-bottom: 5%;
  }
</style>