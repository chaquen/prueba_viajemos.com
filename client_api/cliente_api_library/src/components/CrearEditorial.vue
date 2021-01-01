<template>
  <div>
    <form>
        <div class="form-group">
            <label for="isbn">Nombre editorial</label>
            <input type="text" class="form-control" id="inpIsbn" placeholder="Ingrese el nombre de la editorial" v-model="form.nombre">   
        </div>
        <div class="form-group">
            <label for="title">Sede editorial</label>
            <input type="text" class="form-control" id="inpTitulo" placeholder="Ingrese la sede de la editorial" v-model="form.sede">   
        </div>       
        <button type="submit" class="btn btn-primary" v-on:click="crearEditorial($event)">Crear libro</button>
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
                    nombre:'',
                    sede:'',
                    
                },            
                msn: {
                    mensaje:[]
                }
            }
        },
    methods: 
        {
            crearEditorial: function(event) {
                event.preventDefault()
                axios
                .post('http://localhost:88/api/editorial',{
                    nombre:this.form.nombre,
                    sede:this.form.sede,                    
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