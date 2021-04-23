<template>
    <app-layout>
        <template #header>

        </template>
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout';
import { computed } from '@vue/runtime-core';
export default({
    props: {
        grupo:Array
        
    },
    data(){
        return{

            form:this.$inertia.form({
                id_alumno:'',
            alumno:'',
            id_asignatura:'',
            asignatura:'',
            id_grupo:'',
            grupo:'',
            ciclo:'',
            observacion:'',
            data:'',
            equipo:'',
            id_profesor:'',
            profesor:'',
            bandera:'',
            id_planeacion:'',
            periodo:'',
            puntos:'',
            titulo:'',
            fecha:'',
            id_clase:'',
        })


        } 
    }
})
</script>
