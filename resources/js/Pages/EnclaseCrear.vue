
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
                {{grupo}}
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="table-fixed border-separate border">
                        <thead>
                            <tr>
                            <th>Grupo/Ciclo</th>
                            <th>Alumno</th>
                            <th>Fecha</th>
                            <th>Título</th>
                            <th>Observacion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="clase in clases" :key="clase.id" class="bg-blue-200">
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import { computed } from '@vue/runtime-core';

export default {
    props:{
        grupo:Object,
        errors:Object,
    },
    data(){
        return{
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
            url:'/enclases/',
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