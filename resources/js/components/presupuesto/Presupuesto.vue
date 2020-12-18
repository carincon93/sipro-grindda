<template>
    <div>
        <div class="form-group" v-for="(presupuesto, index) in presupuestos">

            <p>{{ presupuesto.pregunta }}</p>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" :name="presupuesto.nombreRadio" :id="presupuesto.radioIdSi" value="si" v-model="presupuesto.checked" class="custom-control-input">
                <label class="custom-control-label" :for="presupuesto.radioIdSi">Si</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" :name="presupuesto.nombreRadio" :id="presupuesto.radioNo" value="no" v-model="presupuesto.checked" class="custom-control-input">
                <label class="custom-control-label" :for="presupuesto.radioNo">No</label>
            </div>

            <transition name="slide-fade">
                <div v-if="presupuesto.checked === 'si'" class="mt-5">
                    <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['valor.'+index]}">
                        <input type="hidden" name="nombreItem[]" :value="presupuesto.nombreItem" class="form-control">

                        <label :for="'valor'+presupuesto.id">Valor en $COP</label>
                        <input :id="'valor'+presupuesto.id" type="number" class="form-control" name="valor[]" autocomplete="off" min="0" max="99999999999" required>
                        <span v-if="errors['valor.'+index]" class="invalid-feedback d-block">
                            <strong>{{ errors['valor.'+index][0] }}</strong>
                        </span>
                    </div>

                    <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['descripcion.'+index]}">
                        <input type="hidden" name="tipoPresupuesto[]" :value="presupuesto.tipoPresupuesto" class="form-control">
                        <label :for="'descripcion'+presupuesto.id">Descripción</label>
                        <textarea :id="'descripcion'+presupuesto.id" name="descripcion[]" class="form-control" rows="8" cols="80" required></textarea>
                        <span v-if="errors['descripcion.'+index]" class="invalid-feedback d-block">
                            <strong>{{ errors['descripcion.'+index][0] }}</strong>
                        </span>
                    </div>

                    <div class="form-group form-group-custom" v-bind:class="{'is-invalid' : errors['archivo.'+index]}">
                        <label :for="'archivo'+presupuesto.id">Archivo PDF</label>
                        <p class="small">{{ presupuesto.descripcionArchivo }}</p>
                        <p class="small">Máximo: 800KB</p>
                        <input :id="'archivo'+presupuesto.id" type="file" name="archivo[]" class="form-control" accept="application/pdf">
                        <span v-if="errors['archivo.'+index]" class="invalid-feedback d-block">
                            <strong>{{ errors['archivo.'+index][0] }}</strong>
                        </span>
                    </div>
                </div>
            </transition>

        </div>
    </div>
</template>

<script>
    export default {
        props: ['errors', 'tipopresupuesto'],
        data: function () {
            return {
                presupuestos: [
                { id: 1, pregunta: '¿Aplica para servicios personales indirectos?', nombreRadio: 'personalIndirecto', radioIdSi: 'personalIndirectoSi', radioNo: 'personalIndirectoNo', checked: 'no', nombreItem: 'Servicios personales internos', tipoPresupuesto: 'SENNOVA', descripcionArchivo: 'Perfil de contratación de los prestadores de servicios (estudios, experiencia laboral y/o profesional, competencias certificadas), tiempo de contratación y salario mensual', },
                { id: 2, pregunta: '¿Aplica para otros servicios personales indirectos (Aprendices)?',  nombreRadio: 'personalIndirectoOtro', radioIdSi: 'personalIndirectoOtroSi', radioNo: 'personalIndirectoOtroNo', checked: 'no', nombreItem: 'Otros servicios personales indirectos (Aprendices)', tipoPresupuesto: 'SENNOVA', descripcionArchivo: 'Perfil de contratación de los aprendices previa consulta de disponibilidad con la oficina de contrato de aprendizaje (Prelación aprendices de semilleros del CPIC)', },
                { id: 3, pregunta: '¿Aplica para equipos de sistemas?',  nombreRadio: 'equiposSistemas', radioIdSi: 'equipoSistSi', radioNo: 'equipoSistNo', checked: 'no', nombreItem: 'Equipos de sistemas', tipoPresupuesto: 'SENNOVA', descripcionArchivo: 'Cotización de los equipos a comprar según fichas técnicas mínimas publicadas en CompromISO por la oficina de sistemas', },
                { id: 4, pregunta: '¿Aplica para software?',  nombreRadio: 'software', radioIdSi: 'softwareSi', radioNo: 'softwareNo', checked: 'no', nombreItem: 'Software', tipoPresupuesto: 'SENNOVA', descripcionArchivo: 'Cotización del software a comprar según fichas técnicas publicadas en CompromISO por la oficina de sistemas', },
                { id: 5, pregunta: '¿Aplica para maquinaria industrial?',  nombreRadio: 'maquinariaIndustrial', radioIdSi: 'maquinariaIndustrialSi', radioNo: 'maquinariaIndustrialNo', checked: 'no', nombreItem: 'Maquinaria industrial', tipoPresupuesto: 'SENNOVA', descripcionArchivo: 'Fichas técnicas y cotización de los equipos a cotizar', },
                { id: 6, pregunta: '¿Aplica para otras compras de equipos?',  nombreRadio: 'otrasComprasEquipos', radioIdSi: 'otrasComprasEquiposSi', radioNo: 'otrasComprasEquiposNo', checked: 'no', nombreItem: 'Otras compras de equipos', tipoPresupuesto: 'SENNOVA', descripcionArchivo: 'Fichas técnicas y cotización de los equipos a cotizar', },
                { id: 7, pregunta: '¿Aplica para materiales para formación personal?',  nombreRadio: 'materialesFormacionPersonal', radioIdSi: 'materialesFormacionPersonalSi', radioNo: 'materialesFormacionPersonalNo', checked: 'no', nombreItem: 'Materiales para formación personal', tipoPresupuesto: 'SENNOVA', descripcionArchivo: 'Fichas técnicas y cotización de los equipos a cotizar', },
                { id: 8, pregunta: '¿Aplica para mantenimiento de maquinaria, equipo, transporte y software?',  nombreRadio: 'mantenimientoEquipos', radioIdSi: 'mantenimientoMaqEqTrSoftSi', radioNo: 'mantenimientoMaqEqTrSoftNo', checked: 'no',  nombreItem: 'Mantenimiento de maquinaria, equipo, transporte y software', tipoPresupuesto: 'SENNOVA', descripcionArchivo: 'Fichas técnicas y cotización de los equipos a cotizar', },
                { id: 9, pregunta: '¿Aplica para otros gastos por impresos y publicaciones?',  nombreRadio: 'gastosImpresosPublicaciones', radioIdSi: 'gastosImpresosPublicacionesSi', radioNo: 'gastosImpresosPublicacionesNo', checked: 'no', nombreItem: 'Otros gastos por impresos y publicaciones', tipoPresupuesto: 'SENNOVA', descripcionArchivo: 'Fichas técnicas y cotización de los equipos a cotizar', },
                { id: 10, pregunta: '¿Aplica para arrendamientos de bienes inmuebles?',  nombreRadio: 'arrendamientosBienes', radioIdSi: 'arrendamientosBienesSi', radioNo: 'arrendamientosBienesNo', checked: 'no', nombreItem: 'Aprendamientos de bienes inmuebles', tipoPresupuesto: 'SENNOVA', descripcionArchivo: 'Fichas técnicas y cotización de los equipos a cotizar', },
                { id: 11, pregunta: '¿Aplica para viáticos y gastos de viaje al interior formación profesional?',  nombreRadio: 'viaticosInteriorFormacion', radioIdSi: 'viaticosInteriorFormacionSi', radioNo: 'viaticosInteriorFormacionNo', checked: 'no', nombreItem: 'Viaticos y gastos de viaje al interior formación profesional', tipoPresupuesto: 'SENNOVA', descripcionArchivo: 'Proyección y cronograma de viajes durante la ejecución del proyecto', },
                { id: 12, pregunta: '¿Aplica para gastos bienestar alumnos?',  nombreRadio: 'gastosBienestarAlumnos', radioIdSi: 'gastosBienestarAlumnosSi', radioNo: 'gastosBienestarAlumnosNo', checked: 'no', nombreItem: 'Gastos bienestar alumnos', tipoPresupuesto: 'SENNOVA', descripcionArchivo: 'Proyección y cronograma de viajes durante la ejecución del proyecto', },
                { id: 13, pregunta: '¿Aplica para adecuaciones y construcciones?',  nombreRadio: 'adecuacionesConstrucciones', radioIdSi: 'adecuacionesConstruccionesSi', radioNo: 'adecuacionesConstruccionesNo', checked: 'no', nombreItem: 'Adecuaciones y construcciones', tipoPresupuesto: 'SENNOVA', descripcionArchivo: 'Fichas técnicas y cotización de los equipos a cotizar', },
                { id: 14, pregunta: '¿Aplica para monitores?',  nombreRadio: 'monitores', radioIdSi: 'monitoresSi', radioNo: 'monitoresNo', checked: 'no', nombreItem: 'Monitores', tipoPresupuesto: 'SENNOVA', descripcionArchivo: 'Perfil de contratación de los aprendices previa consulta  de disponibilidad con el líder de semilleros del CPIC', },
                ],
            }
        }
    }
</script>
