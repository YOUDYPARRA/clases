<template>
<app-layout>
  <template #header>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      <ul class="list-reset flex">
      <li class="mr-3">
        <a @click="listado()" v-bind:class="listadoClass" href="#">Listado</a>
      </li>
      <li class="mr-3">
        <a @click="crear()" v-bind:class="crearClass" href="#">Crear</a>
      </li>
       <p class="text-base text-center text-red-400" >
                      {{$page.props.flash.message}}
        </p>
      
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
                  <th>Nombre</th>
                  <th>Grado</th>
                  <th>Letra</th>
                  <th>Ciclo</th>
                  <th>Turno</th>
                  <th>Observacion</th>
                  <th></th>
	            </tr>
              </thead>
              <tbody>
                <tr v-for="grupo in grupos" :key="grupo.id">
                  <td>
                          {{ grupo.id }}
                  </td>
                  <td>
                          {{ grupo.nombre }}
                  </td>
                  <td>
                          {{ grupo.grado }}
                  </td>
                  <td>{{ grupo.letra }}</td>
                  <td>{{ grupo.ciclo }}</td>
                  <td>{{ grupo.turno }}</td>
                  <td>{{ grupo.observacion }}</td>
                  <td>
                      <button @click="editar(grupo)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Editar</button>
                      <button @click="eliminar(grupo)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded my-3">Eliminar</button>
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
                        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Nombre</label>
                        <input type="text" v-model="form.nombre" name="name" id="name" placeholder="Nombre de grupo"  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        <div v-if="errors.nombre" class="text-red-500">{{ errors.nombre }}</div>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Grado</label>
                        <input type="text" v-model="form.grado"  placeholder="Grado"  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        <div v-if="errors.grado" class="text-red-500">{{ errors.grado }}</div>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Letra</label>
                        <input type="text" v-model="form.letra"  placeholder="Letra de grupo o subdivision"  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        <div v-if="errors.letra" class="text-red-500">{{ errors.letra }}</div>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Turno</label>
                        <input type="text" v-model="form.turno"  placeholder="Letra de grupo o subdivision"  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        <div v-if="errors.turno" class="text-red-500">{{ errors.turno }}</div>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Ciclo</label>
                        <input type="text" v-model="form.ciclo"  placeholder="año de curso escolar o periodo"  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        <div v-if="errors.ciclo" class="text-red-500">{{ errors.ciclo }}</div>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Equipo</label>
                        <input type="text" v-model="form.equipo"  placeholder="Nombre del equipo"  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        <div v-if="errors.equipo" class="text-red-500">{{ errors.equipo }}</div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="observaciones" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Obsevaciones</label>
                        <textarea rows="5" v-model="form.observacion" name="observaciones" placeholder="Tu observacion" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" ></textarea>
                        <div v-if="errors.observacion" class="text-red-500">{{ errors.observacion }}</div>
                    </div>
                    <div class="mb-6">
                      
                        <button type="buton" v-show="!editForm" @click="guardar(form)" class="w-full px-3 py-4 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none" :disabled="form.processing">Crear nuevo</button>
                        <button type="button" v-show="editForm" @click="actualizar(form)" class="w-full px-3 py-4 text-white bg-red-500 rounded-md focus:bg-indigo-600 focus:outline-none">Guardar cambios</button>
                    </div>
                   
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
        grupos:Array,
        errors:Object,
        flash:null,
        // message:null
    },
    data(){
        return{
                activo:'inline-block border border-blue rounded hover:border-grey-lighter text-blue hover:bg-grey-lighter py-1 px-3',
                desactivo:'inline-block border border-white rounded hover:border-grey-lighter text-blue hover:bg-grey-lighter py-1 px-3',
                form: this.$inertia.form({
                    nombre: '',
                    grado: '',
                    letra: '',
                    turno: '',
                    ciclo: '',
                    observacion: '',
                    equipo: '',
                }),
                enForm:false,
                listadoClass:this.activo,
                crearClass:this.desactivo,
                enListado:true,
                enForm:false,
                editForm:false,
                url:'/grupos/',
        }
    },
    methods:{
        actualizar(){
            this.form.put(this.url+this.form.id,
            // this.$inertia.put(this.url+this.form.id,this.form,
            {
                onFinish: () => {this.clearForm()}
            });

        },
        guardar(){
            this.form.post(this.url,{
                        onFinish: () => {this.clearForm()}
                    });

        },
        editar(d){
            // this.form = Object.assign({}, d);
            this.form.id=d.id;
            this.form.nombre=d.nombre;
            this.form.grado=d.grado;
            this.form.letra=d.letra;
            this.form.turno=d.turno;
            this.form.ciclo=d.ciclo;
            this.form.equipo=d.equipo;
            this.form.observacion=d.observacion;
            this.form.titulo='Editar Grupo';
            this.form.descripcion='Editar los campos del Grupo';
            this.crearClass=this.activo;
            this.listadoClass=this.desactivo;
            this.enListado=false;
            this.enForm=true;
            this.editForm=true;
        },
        eliminar(d){
             if (!confirm('¿Eliminar Grado? '+d.nombre)) return;
                    d._method = 'DELETE';
                    this.$inertia.post(
                    route("grupos.destroy", d.id),
                    d
                    );
        },
        listado(){
            this.listadoClass=this.activo;
            this.crearClass=this.desactivo;
            this.enListado=true;
            this.enForm=false;
            this.clearForm();
      },
        crear(){
          // if(t)
          this.clearForm();
        this.form.titulo='Crear Grupo';
        this.form.descripcion='Campos para crear Grupo';
        this.crearClass=this.activo;
        this.listadoClass=this.desactivo;
        this.enListado=false;
        this.enForm=true;
        this.editForm=false;
        // this.actv='inline-block border border-blue rounded hover:border-grey-lighter text-blue hover:bg-grey-lighter py-1 px-3';
      },
        clearForm(){
          this.form.nombre=null;
          this.form.id=null;
          this.form.grado=null;
          this.form.letra=null;
          this.form.turno=null;
          this.form.ciclo=null;
          this.form.equipo=null;
          this.form.observacion=null;
          this.flash.message=null;
      },
    },
    components: {
      AppLayout,
  },
}
</script>
