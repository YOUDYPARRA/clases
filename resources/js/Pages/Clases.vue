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
    </ul>
       
        <div class="m-7">
            <form v-on:submit.prevent>
                <input type="text" v-model="clase.buscar" @keyup="buscar()" placeholder="Buscar"  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
            </form>
        </div>
        <p class="text-base text-center text-red-400" >
                      {{$page.props.flash.message}}
        </p>
    </h2>
  </template>
  <div class="py-12" v-if="enListado">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <table class="table-fixed border-separate border">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Alumno</th>
                  <th>Grupo</th>
                  <th>Observacion</th>
                  <th></th>
	            </tr>
              </thead>
              <tbody>
                <tr v-for="clase in clases" :key="clase.id" class="bg-blue-200">
                  <td>
                          {{ clase.id }}
                  </td>
                  <td>
                          {{ clase.alumno }}
                  </td>
                  <td>
                      {{ clase.grupo }}
                          {{clase.asignatura}}
                      {{ clase.ciclo }}
                  </td>
                  
                  
                  <td>{{ clase.observacion }}</td>
                  <td>
                      <button @click="editar(clase)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Editar</button>
                      <button @click="eliminar(clase)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded my-3">Eliminar</button>
                      <inertia-link :href="route('enclases.create',clase)" class="ml-4 text-sm text-gray-700 underline">
                        Sesion nueva.
                        </inertia-link>
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
                        <select v-model="form.id_asignatura">
                          <option disabled value="">Seleccione . . .</option>
                          <option v-for="asg in asignaturas" v-bind:value="asg.id" :key="asg.id">{{asg.asignatura}}</option>
                        </select>
                        <div v-if="errors.id_asignatura" class="text-red-500">{{ errors.id_asignatura }}</div>
                        <div v-if="errors.asignatura" class="text-red-500">{{ errors.asignatura }}</div>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Grupo</label>
                        <select v-model="form.id_grupo">
                          <option disabled value="">Seleccione . . .</option>
                          <option v-for="gru in grupos" v-bind:value="gru.id" :key="gru.id">{{gru.nombre}} , {{gru.ciclo}}</option>
                        </select>
                        <div v-if="errors.id_grupo" class="text-red-500">{{ errors.id_grupo }}</div>
                        <div v-if="errors.grupo" class="text-red-500">{{ errors.grupo }}</div>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Equipo</label>
                        <input type="text" v-model="form.equipo"  placeholder="Nombre del equipo"  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        <div v-if="errors.equipo" class="text-red-500">{{ errors.equipo }}</div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="observaciones" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Obsevaciones</label>
                        <textarea rows="1" v-model="form.observacion" name="observaciones" placeholder="Tu observacion" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" ></textarea>
                        <div v-if="errors.observacion" class="text-red-500">{{ errors.observacion }}</div>
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Buscar alumnos</label>
                        <input type="text" v-model="bsc.nombre"  placeholder="Nombre del alumno" @keyup="bscAlumno()" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        <div v-if="errors.alumno" class="text-red-500">{{ errors.alumno }}</div>
                        <div v-if="errors.id_alumno" class="text-red-500">{{ errors.id_alumno }}</div>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Listado de alumnos</label>
                          <ul>
                            <li v-for="list in listAlumnos" :key="list.id">
                                {{ list.nombre }} {{ list.apellido_paterno }} {{ list.apellido_materno }} <label class="mb-2 text-sm text-gray-600 dark:text-gray-400" @click="selectAlumno(list)" >[Agregar]</label>
                            </li>
                        </ul>
                        <div v-if="errors.listAlumnos" class="text-red-500">{{ errors.listAlumnos }}</div>
                        <table>
                            <thead>
                                <tr>
                                <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(alumn, index) in alumnos" :key="alumn.id">
                                <td @click="quitaAlumno(index)">{{alumn.nombre}} {{alumn.apellido_paterno}} {{alumn.apellido_materno}} [Quitar]</td>
                                </tr>
                            </tbody>
                        </table>
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
        clases:Object,
        grupos:Object,
        asignaturas:Object,
        errors:Object,
        listAlumnos:Object,
        id_alumno:Object,
    },
    data(){
        return{
            activo:'inline-block border border-blue rounded hover:border-grey-lighter text-blue hover:bg-grey-lighter py-1 px-3',
            desactivo:'inline-block border border-white rounded hover:border-grey-lighter text-blue hover:bg-grey-lighter py-1 px-3',
            form: this.$inertia.form({
                titulo:'Crear',
                descripcion:'Asigne la clase, grupo y alumno.',
                id_alumno:[],
                id_asignatura:'',
                id_grupo:'',
                observacion:'',
                equipo:'',
                bandera:'CLASE',
                id_planeacion:'',
                periodo:'',
                puntos:'',
                titulo:'',
                fecha:'',
            }),
            bsc:{
                nombre:'',
            },
            clase:{
                buscar:'',
            },
            listadoClass:'inline-block border border-blue rounded hover:border-grey-lighter text-blue hover:bg-grey-lighter py-1 px-3',
            crearClass:this.desactivo,
            enListado:true,
            enForm:false,
            editForm:false,
            alumnos:[],
            url:'/clases/',
        }
    },
    methods:{
        bscAlumno(){
            // console.log(this.bsc.nombre.length);
            if(this.bsc.nombre.length>3){
                this.$inertia.visit('/alumnos/'+this.bsc.nombre+'?nombre='+this.bsc.nombre,{
                    only:['listAlumnos'],
                    preserveState: true,
                    preserveScroll:true,
                });
            }
        },
        quitaAlumno(index){
            this.alumnos.splice(index,1);


        },
        selectAlumno(slc){
            
            this.alumnos.push(slc);
        },
        guardar(){
            this.form.id_alumno=this.alumnos;
            this.form.post(this.url)
        },
        listado(){
            this.listadoClass=this.activo;
            this.crearClass=this.desactivo;
            this.enListado=true;
            this.enForm=false;
            this.clearForm();

        },
        buscar(){
            if(this.clase.buscar.length>4){
                console.log('Buscar');

                this.$inertia.visit(this.url+this.clase.buscar+'?buscar='+this.clase.buscar,{
                    only:['clases'],
                    preserveState: true,
                    preserveScroll:true,
                });
            }
            
        },
        crear(){
            this.clearForm();
        this.form.titulo='Crear asignatura';
        this.form.descripcion='Campos para crear asignatura';
        this.crearClass=this.activo;
        this.listadoClass=this.desactivo;
        this.enListado=false;
        this.enForm=true;
        this.editForm=false;

        },
        actualizar(){
            this.form.id_alumno=this.alumnos;
            this.form.put(this.url+this.form.id);
        },
        editar(edit){

            this.form.id=edit.id;
            this.form.id_alumno=edit.id_alumno;
            this.form.nombre=edit.id_alumno;
            this.form.id_asignatura=edit.id_asignatura;
            this.form.id_grupo=edit.id_grupo;
            this.form.observacion=edit.observacion;
            this.form.equipo=edit.equipo;
            this.form.id_planeacion=edit.id_planeacion;
            this.form.periodo=edit.periodo;
            this.form.puntos=edit.puntos;
            this.form.titulo=edit.titulo;
            this.form.fecha=edit.fecha;
            this.form.titulo='Edicion de clase';
            this.crearClass=this.activo;
            this.listadoClass=this.desactivo;
            this.enListado=false;
            this.enForm=true;
            this.editForm=true;
            
            this.bsc.nombre=this.form.id_alumno;
            this.$inertia.visit('/alumnos/'+this.bsc.nombre+'?nombre='+this.bsc.nombre,{
                    only:['id_alumno'],
                    preserveState: true,
                    preserveScroll:true,
                    onFinish: () => {
                        this.alumnos=[];
                        this.selectAlumno(this.id_alumno);
                        this.bsc.nombre=this.id_alumno.nombre
                        }
                });
        },
        eliminar(d){
            if(!confirm(' ¿Eliminar clase? '+d.asignatura+' para el alumno '+d.alumno))return;
            d._method='DELETE';
            this.$inertia.post(route("clases.destroy",d.id),d);

        },
        clearForm(){
        this.form.id_alumno=[];
        this.form.id_asignatura='';
        this.form.id_grupo='';
        this.form.id_planeacion='';
        this.form.observacion='';
        this.form.equipo='';
        this.form.bandera='CLASE';
        this.form.periodo='';
        this.form.puntos='';
        this.form.titulo='';
        this.form.fecha='';
    },

    },
    
    mounted() {
        // console.log('Cargado');
    },
     components:{
        AppLayout,
    }
}
</script>
