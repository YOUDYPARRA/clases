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
              <table class="table-fixed border-separate border ">
              <thead>
                <tr>
                  <th >#</th>
                  <th>Planeacion</th>
                  <th>Fecha</th>
                  <th>Observacion</th>
                  <th>Asignatura</th>
                  <th>Grupo</th>
                  <th>Profesor</th>
                  <th>Material</th>
                  <th>Estatus</th>
                  <th class="w-1/4"></th>
	            </tr>
              </thead>
              <tbody>
                <tr v-for="planeacion in planeaciones" :key="planeacion.id" class="bg-blue-200">
                  <td>{{ planeacion.id }}</td>
                  <td>{{ planeacion.nombre }}</td>
                  <td>{{ planeacion.fecha }}</td>
                  <td>{{ planeacion.observacion }}</td>
                  <td>{{ planeacion.asignatura }}</td>
                  <td>{{ planeacion.grupo }}</td>
                  <td>{{ planeacion.profesor }}</td>
                  <td>{{ planeacion.material }}</td>
                  <td>{{ planeacion.estatus }}</td>
                  <td>
                      <button @click="editar(planeacion)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Editar</button>
                      <button @click="eliminar(planeacion)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded my-3">Eliminar</button>
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
                        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Ver en sesion</label>
                        <input type="text" v-model="form.nombre" name="name" id="name" placeholder="Descripcion de lo que se verá en la sesion"  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        <div v-if="errors.nombre" class="text-red-500">{{ errors.nombre }}</div>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Material para la sesion</label>
                        <input type="text" v-model="form.material" name="name" id="name" placeholder="Descripcion de material que se va usar en la sesion"  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        <div v-if="errors.material" class="text-red-500">{{ errors.material }}</div>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Fecha</label>
                        <input type="date" v-model="form.fecha"  placeholder="Fecha en la que se va a ver"  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        <div v-if="errors.fecha" class="text-red-500">{{ errors.fecha }}</div>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Profesor</label>
                        <select v-model="form.id_profesor">
                          <option disabled value="">Seleccione . . .</option>
                          <option v-for="prof in profesores" v-bind:value="prof.id">{{prof.nombre}}</option>
                        </select>
                        <div v-if="errors.profesor" class="text-red-500">{{ errors.profesor }}</div>
                        <div v-if="errors.id_profesor" class="text-red-500">{{ errors.id_profesor }}</div>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Asignatura</label>
                        <select v-model="form.id_asignatura" ref="seleccionado">
                          <option disabled value="">Seleccione . . .</option>
                          <option  v-for="asig in asignaturas" :id="asig.asignatura" v-bind:value="asig.id">{{asig.asignatura}}</option>
                        </select>
                        {{seleccionado}}
                        <div v-if="errors.asignatura" class="text-red-500">{{ errors.asignatura }}</div>
                        <div v-if="errors.id_asignatura" class="text-red-500">{{ errors.id_asignatura }}</div>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Grupo</label>
                        <select v-model="form.id_grupo">
                          <option disabled value="">Seleccione . . .</option>
                          <option v-for="grup in grupos" v-bind:value="grup.id">{{grup.nombre}}</option>
                        </select>
                        <div v-if="errors.grupo" class="text-red-500">{{ errors.grupo }}</div>
                        <div v-if="errors.id_grupo" class="text-red-500">{{ errors.id_grupo }}</div>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Equipo</label>
                        <input type="text" v-model="form.equipo"  placeholder="Nombre del equipo"  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        <div v-if="errors.equipo" class="text-red-500">{{ errors.equipo }}</div>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Estado</label>
                        <select v-model="form.estatus">
                          <option disabled value="">Seleccione . . .</option>
                          <option v-for="est in estatus" v-bind:value="est.estado">{{est.estado}}</option>
                        </select>
                        <div v-if="errors.estatus" class="text-red-500">{{ errors.estatus }}</div>
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
        planeaciones:Array,
        asignaturas:Array,
        grupos:Array,
        profesores:Array,
        errors:Object,
        flash:null,
        seleccionado:null
    },
    data(){
        return{
                activo:'inline-block border border-blue rounded hover:border-grey-lighter text-blue hover:bg-grey-lighter py-1 px-3',
                desactivo:'inline-block border border-white rounded hover:border-grey-lighter text-blue hover:bg-grey-lighter py-1 px-3',
                estatus:[{estado:'PENDIENTE'},
                    {estado:'PLANEADO'},
                    {estado:'VISTO'}],
                form: this.$inertia.form({
                    nombre:'',
                    fecha:'',
                    observacion:'',
                    id_asignatura:'',
                    asignatura:'',
                    id_grupo:'',
                    grupo:'',
                    id_profesor:'',
                    profesor:'',
                    equipo:'',
                    material:'',
                    estatus:''
                }),
                enForm:false,
                listadoClass:'inline-block border border-blue rounded hover:border-grey-lighter text-blue hover:bg-grey-lighter py-1 px-3',
                crearClass:this.desactivo,
                enListado:true,
                enForm:false,
                editForm:false,
                url:'/planeaciones/',
        }
    },
    methods:{
        actualizar(){
            console.log('update');
            this.form.put(this.url+this.form.id,
            // this.$inertia.put(this.url+this.form.id,this.form,
            {
                onFinish: () => {}
            });

        },
        guardar(){
            this.form.post(this.url,{
                        onFinish: () => {}
                    });
        },
        editar(d){
            // this.form = Object.assign({}, d);
            this.form.id=d.id;
            this.form.nombre=d.nombre;
            this.form.fecha=d.fecha;
            this.form.observacion=d.observacion;
            this.form.id_asignatura=d.id_asignatura;
            // this.form.asignatura=d.asignatura;
            this.form.id_grupo=d.id_grupo;
            // this.form.grupo=d.grupo;
            this.form.id_profesor=d.id_profesor;
            // this.form.profesor=d.profesor;
            this.form.equipo=d.equipo;
            this.form.material=d.material;
            this.form.estatus=d.estatus;
            this.form.titulo='Editar Planeacion';
            this.form.descripcion='Editar los campos de plameacion';
            this.crearClass=this.activo;
            this.listadoClass=this.desactivo;
            this.enListado=false;
            this.enForm=true;
            this.editForm=true;
        },
        eliminar(d){
             if (!confirm('¿Eliminar Planeacion.? '+d.nombre)) return;
                    d._method = 'DELETE';
                    this.$inertia.post(
                    route("planeaciones.destroy", d.id),d
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
        this.form.titulo='Crear Planeacion';
        this.form.descripcion='Campos para planeacion';
        this.crearClass=this.activo;
        this.listadoClass=this.desactivo;
        this.enListado=false;
        this.enForm=true;
        this.editForm=false;
        // this.actv='inline-block border border-blue rounded hover:border-grey-lighter text-blue hover:bg-grey-lighter py-1 px-3';
      },
        clearForm(){
            this.form.nombre=null;
            this.form.fecha=null;
            this.form.observacion=null;
            this.form.id_asignatura=null;
            this.form.asignatura=null;
            this.form.id_grupo=null;
            this.form.grupo=null;
            this.form.id_profesor=null;
            this.form.profesor=null;
            this.form.equipo=null;
            this.form.material=null;
            this.form.estatus=null;
            this.flash.message=null;
      },
    },
    created() {
        // this.form.id_profesor=this.planeaciones[0].id_profesor;
    },
    components: {
      AppLayout,
  },
}
</script>
