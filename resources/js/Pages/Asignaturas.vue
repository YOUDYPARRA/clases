<template>
<app-layout>
  <template #header>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      <ul class="list-reset flex">
      <li class="mr-3">
        <a @click="listado()" v-bind:class="listadoClass" href="#">Listado de asignaturas</a>
      </li>
      <li class="mr-3">
        <a @click="crear()" v-bind:class="crearClass" href="#">Crear asignatura</a>
      </li>
      
    </ul>
    </h2>
  </template>
  <div class="py-12" v-if="enListado">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <table border="1">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Asignatura</th>
                  <th>Observacion</th>
                  <th>Opciones</th>
	            </tr>
              </thead>
              <tbody>
                <tr v-for="asignatura in asignaturas" :key="asignatura.id">
                  <td>
                          {{ asignatura.id }}
                  </td>
                  <td>
                          {{ asignatura.asignatura }}
                  </td>
                  <td>
                          <div>{{ asignatura.observacion }}</div>
                  </td>
                  <td>
                      <button @click="editar(asignatura)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Editar</button>
                      <button @click="eliminar(asignatura)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded my-3">Eliminar</button>
                  </td>
                </tr>
              </tbody>
            </table>

            </div>
        </div>
    </div>
<div>
  <!--Inicia Form-->
<div class="flex items-center min-h-screen bg-gray-50 dark:bg-gray-900" v-if="enForm">
    <div class="container mx-auto">
        <div class="max-w-md mx-auto my-10 bg-white p-5 rounded-md shadow-sm">
            <div class="text-center">
                <h1 class="my-3 text-3xl font-semibold text-gray-700 dark:text-gray-200">{{form.titulo}}</h1>
                <p class="text-gray-400 dark:text-gray-400">{{form.descripcion}}</p>
            </div>
            <div class="m-7">
                <form v-on:submit.prevent>

                    <div class="mb-6">
                        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Asignatura</label>
                        <input type="text" v-model="form.asignatura" name="name" id="name" placeholder="Nombre de la asignatura"  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        <div v-if="errors.asignatura" class="text-red-500">{{ errors.asignatura }}</div>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Equipo</label>
                        <input type="text" v-model="form.equipo" name="phone" id="phone" placeholder="Primer apellido"  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        <div v-if="errors.equipo" class="text-red-500">{{ errors.equipo }}</div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="observaciones" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Obsevaciones</label>
                        <textarea rows="5" v-model="form.observacion" name="observaciones" placeholder="Tu observacion" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" ></textarea>
                        <div v-if="errors.observacion" class="text-red-500">{{ errors.observacion }}</div>
                    </div>
                    <div class="mb-6">
                        <button type="buton" v-show="!editForm" @click="guardar(form)" class="w-full px-3 py-4 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none">Crear nuevo</button>
                        <button type="button" v-show="editForm" @click="actualizar(form)" class="w-full px-3 py-4 text-white bg-red-500 rounded-md focus:bg-indigo-600 focus:outline-none">Guardar cambios en asignatura</button>
                        
                    </div>
                    <p class="text-base text-center text-gray-400" id="result">
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin Form-->
</div>

</app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import { computed } from '@vue/runtime-core';

export default {
    props:{
        asignaturas:Array,
        errors:Object
    },
    data(){
        return{
                activo:'inline-block border border-blue rounded hover:border-grey-lighter text-blue hover:bg-grey-lighter py-1 px-3',
                desactivo:'inline-block border border-white rounded hover:border-grey-lighter text-blue hover:bg-grey-lighter py-1 px-3',
                form: this.$inertia.form({
                    asignatura: '',
                    observacion: '',
                    data: '',
                    equipo: ''
                }),
                enForm:false,
                listadoClass:this.activo,
                crearClass:this.desactivo,
                enListado:true,
                enForm:false,
                editForm:false,
                url:'/asignaturas/',
        }
    },
    methods:{
        actualizar(){
            // this.form.put(this.url+this.form.id,
            this.$inertia.put(this.url+this.form.id,this.form,
            {
                onFinish: () => {this.reset(),this.listado()}
            });

        },
        guardar(){
            this.form.post(this.url,{
                        onFinish: () => {this.reset(),this.listado()}
                    });

        },
        editar(d){
            this.form = Object.assign({}, d);
            this.form.titulo='Editar asignatura';
            this.form.descripcion='Editar los campos del asignatura';
            this.crearClass=this.activo;
            this.listadoClass=this.desactivo;
            this.enListado=false;
            this.enForm=true;
            this.editForm=true;
        },
        eliminar(d){
             if (!confirm('¿Eliminar Asignatura? '+d.nombre)) return;
                    d._method = 'DELETE';
                    this.$inertia.post(
                    route("asignaturas.destroy", d.id),
                    d
                    );
        },
        listado(){
            this.listadoClass=this.activo;
            this.crearClass=this.desactivo;
            this.enListado=true;
            this.enForm=false;
            this.reset();
      },
        crear(){
        this.form.titulo='Crear asignatura';
        this.form.descripcion='Campos para crear asignatura';
        this.crearClass=this.activo;
        this.listadoClass=this.desactivo;
        this.enListado=false;
        this.enForm=true;
        // this.actv='inline-block border border-blue rounded hover:border-grey-lighter text-blue hover:bg-grey-lighter py-1 px-3';

      },
        reset(){
        this.form={
          asignatura:'',
            observacion: '',
            data: '',
            equipo: ''
          };
      },

    },
    created() {
        // console.log(this.asignaturas[1].asignatura);
        // this.form.asignatura=this.asignaturas[1].asignatura;
    },
    components: {
      AppLayout,
  },
}
</script>
