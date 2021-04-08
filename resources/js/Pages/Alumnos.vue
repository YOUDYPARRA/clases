<template>
<app-layout>
  <template #header>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      <ul class="list-reset flex">
      <li class="mr-3">
        <a @click="listadoAlumnos()" v-bind:class="alumnoListadoClass" href="#">Listado de alumnos</a>
      </li>
      <li class="mr-3">
        <a @click="crearAlumnos()" v-bind:class="alumnoCrearClass" href="#">Crear alumno</a>
      </li>
      
    </ul>
      <div v-if="$page.props.permision_alumno.create">
        <button @click="openModalAlumno()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Crear Alumno</button>
      </div>      
    </h2>
    </template>
    <div class="py-12" v-if="enListadoAlumno">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <table>
              <thead>
                <tr>
                  <th>
                    #
                  </th>
                  <th>
                    Nombre
                  </th>
                  <th >
                    Apellido materno
                  </th>
                  <th >
                    Apellido paterno
                  </th>
                  <th >
                    Fecha nacimiento
                  </th>
                  <th>
                    Correo
                  </th>
                  <th >
                    Equipo
                  </th>
                  <th >
                    Observaciones
                  </th>
                  <th>Grupo</th>
	            </tr>
              </thead>
              <tbody>
                <tr v-for="alumno in alumnos" :key="alumno.id">
                  <td>
                          {{ alumno.id }}
                  </td>
                  <td>
                          {{ alumno.nombre }}
                  </td>
                  <td>
                          <div>{{ alumno.apellido_materno }}</div>
                  </td>
                <td>
                          {{ alumno.apellido_paterno }}
                </td>
                <td>
                          {{ alumno.fecha_nacimiento }}
                </td>
                <td>{{alumno.correo}}</td>
                <td>
                          {{ alumno.equipo }}
                </td>
                <td>
                          {{ alumno.observacion }}
                          {{ alumno.bandera }}
                </td>
                <td>{{alumno.grupo}}</td>
                  <td>
                      <button @click="openFormAlumno(alumno)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Editar</button>
                   
                  </td>
                  <td>
                    <button @click="eliminaAlumno(alumno)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded my-3">Eliminar</button>
                  </td>
                </tr>
              </tbody>
            </table>

            </div>
        </div>
    </div>
<div>
  <!--Inicia Form-->
<div class="flex items-center min-h-screen bg-gray-50 dark:bg-gray-900" v-if="isOpenFormAlumno">
    <div class="container mx-auto">
        <div class="max-w-md mx-auto my-10 bg-white p-5 rounded-md shadow-sm">
            <div class="text-center">
                <h1 class="my-3 text-3xl font-semibold text-gray-700 dark:text-gray-200">{{form.titulo}}</h1>
                <p class="text-gray-400 dark:text-gray-400">{{form.descripcion}}</p>
            </div>
            <div class="m-7">
                <form v-on:submit.prevent>

                    <div class="mb-6">
                        <label for="nombre" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Nombre(s)</label>
                        <input type="text" v-model="form.nombre" name="name" id="name" placeholder="Nombre" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        <div v-if="errors.nombre" class="text-red-500">{{ errors.nombre }}</div>
                    </div>
                    <div class="mb-6">
                        <label for="primerapellido" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Primer apellido</label>
                        <input type="text" v-model="form.apellido_paterno" name="phone" id="phone" placeholder="Primer apellido" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        <div v-if="errors.apellido_paterno" class="text-red-500">{{ errors.apellido_paterno }}</div>
                    </div>
                    <div class="mb-6">
                        <label for="primerapellido" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Segundo apellido</label>
                        <input type="text" v-model="form.apellido_materno" name="phone" id="phone" placeholder="Segundo apellido" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        <div v-if="errors.apellido_materno" class="text-red-500">{{ errors.apellido_materno }}</div>
                    </div>
                    <div class="mb-6">
                        <label for="email" class="text-sm text-gray-600 dark:text-gray-400">email</label>
                        <input type="email" v-model="form.correo" name="email" placeholder="you@company.com" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        <div v-if="errors.correo" class="text-red-500">{{ errors.correo }}</div>
                    </div>
                    <div class="mb-6">
                        <label for="fecha_nacimiento" class="text-sm text-gray-600 dark:text-gray-400">Fecha nacimiento</label>
                        <input type="date" v-model="form.fecha_nacimiento" name="email"  placeholder="dd-mm-aaaa" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        <div v-if="errors.fecha_nacimiento" class="text-red-500">{{ errors.fecha_nacimiento }}</div>
                    </div>
                    <div class="mb-6">
                        <label for="equipo" class="text-sm text-gray-600 dark:text-gray-400">Equipo</label>
                        <input type="text" v-model="form.equipo" name="equipo" placeholder="Escuela, instituto, Grupo" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        <div v-if="errors.equipo" class="text-red-500">{{ errors.equipo }}</div>
                    </div>
                    <div class="mb-6">
                        <label for="bandera" class="text-sm text-gray-600 dark:text-gray-400">Tipo usuario</label>
                        <select v-model="form.bandera">
                          <option disabled value="">Seleccione un rol</option>
                          <option v-for="band in banderas" v-bind:value="band.id">{{band.valor}}</option>
                        </select>
                  <span>Seleccionado: {{ form.bandera }}</span>
                        <div v-if="errors.bandera" class="text-red-500">{{ errors.bandera }}</div>
                    </div>
                    <div class="mb-6">
                        <label for="observaciones" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Obsevaciones</label>

                        <textarea rows="5" v-model="form.observacion" name="observaciones" placeholder="Tu observacion" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" required></textarea>
                        <div v-if="errors.observacion" class="text-red-500">{{ errors.observacion }}</div>
                    </div>
                    <div class="mb-6">
                        <button type="buton" v-show="!editFormAlumno" @click="saveAlumno(form)" class="w-full px-3 py-4 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none">Crear nuevo alumno</button>
                        <button type="button" v-show="editFormAlumno" @click="updateAlumno(form)" class="w-full px-3 py-4 text-white bg-red-500 rounded-md focus:bg-indigo-600 focus:outline-none">Guardar cambios en alumno</button>
                        
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
    props: {alumnos:Array,
    errors:Object
    },
  data(){
      return {
        activo:'inline-block border border-blue rounded hover:border-grey-lighter text-blue hover:bg-grey-lighter py-1 px-3',
        desactivo:'inline-block border border-white rounded hover:border-grey-lighter text-blue hover:bg-grey-lighter py-1 px-3',
          isOpenFormAlumno:false,
            form: {
                titulo: 'Crear Nuevo Alumno',
                descripcion: 'Campos requerido para crear un nuevo alumno.',
            },
            alumnoListadoClass:this.activo,
            alumnoCrearClass:this.desactivo,
            enListadoAlumno:true,
            enCrearAlumno:false,
            editFormAlumno:false,
            banderas:[
              {id:'Alumno',valor:'Alumno'},
              {id:'Maestro',valor:'Maestro'},
              {id:'Administrativo',valor:'Administrativo'},
              {id:'Tutor',valor:'Tutor'},
            ],
            rolSelected:null,
      }
  },
  methods:{
      openFormAlumno:function(d){
        this.crearAlumnos();
        // this.isOpenFormlAlumno=true;
        if(d){
          this.form = Object.assign({}, d);
          this.form.titulo='Editar  alumno';
          this.form.descripcion='Editar los campos del alumno';
          this.editFormAlumno=true;
        }else{
          this.form.titulo='Crear nuevo  alumno';
          this.form.descripcion='Campos requeridos para un nuevo alumno';
          this.editFormAlumno=false;
        }
      },
      editModalAlumno:function(alumno){
        //this.isOpenModalAlumno=true;
        //  this.editModalAlumno=true;         
          
      },
      // closeModalAlumno(){
      //     this.isOpenFormAlumno=false;
      //     this.enListadoAlumno=true;
      //     this.enCrearAlumno=false;
      //     this.alumnoListadoClass=this.activo;
      //     this.alumnoCrearClass=this.desactivo;
      //     this.reset();
      //     //this.errorReset();
      // },
      saveAlumno(d){
        this.$inertia.post('/alumnos/',d);
      },
      updateAlumno(d){
        //console.log(d);
        d.bandera='alumno';
        var x=d;
        this.$inertia.put('/alumnos/'+this.form.id,x);
      },
      eliminaAlumno(d){
          if (!confirm('¿Eliminar Alumno? '+d.nombre)) return;
        d._method = 'DELETE';
        this.$inertia.post(
          route("alumnos.destroy", d.id),
          d
        );

      },
      listadoAlumnos(){
        this.alumnoListadoClass=this.activo;
        this.alumnoCrearClass=this.desactivo;
        this.enListadoAlumno=true;
        this.enCrearAlumno=false;
        this.isOpenFormAlumno=false;
        this.reset();

      },
      crearAlumnos(){
        this.alumnoCrearClass=this.activo;
        this.alumnoListadoClass=this.desactivo;
        this.enListadoAlumno=false;
        this.enCrearAlumno=true;
        this.isOpenFormAlumno=true;
        // this.actv='inline-block border border-blue rounded hover:border-grey-lighter text-blue hover:bg-grey-lighter py-1 px-3';

      },
  
      // errorReset(){
        //   this.errors.nombre=null;
      //  this.errors.observacion=null;
      //  this.errors.correo=null;
      //  this.errors.apellido_paterno=null;
      //  this.errors.apellido_materno=null;
      //  this.errors.fecha_nacimiento=null;

      // },
      reset(){
        this.form={
          nombre:null,
            apellido_paterno:null,
            apellido_materno:null,
            id_grupo:null,
            fecha_nacimiento:null,
            equipo:null,
            observacion:null,
          };
      },
      computed:{
        // alumnoListadoClass:function(){
        //   return this.activo;
        // }
        // actv:function(){

        //   return this.btnActivo;
        // }
        
        
      }
  },
  components: {
      AppLayout,
  },
};
</script>
