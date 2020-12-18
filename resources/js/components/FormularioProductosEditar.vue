<template>
    <div>
        <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['fechaInicio']}">
            <label for="fechaInicio">Fecha inicio</label>
            <input id="fechaInicio" type="date" name="fechaInicio" class="form-control" :value="datos.fechaInicio" @change="moment()" required>
            <span v-if="errors['fechaInicio']" class="invalid-feedback d-block">
                <strong>{{ errors['fechaInicio'][0] }}</strong>
            </span>
        </div>
        <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['fechaFin']}">
            <label for="fechaFin">Fecha fin</label>
            <input id="fechaFin" type="date" name="fechaFin" class="form-control" :value="datos.fechaFin" @change="moment()" required>
            <span v-if="errors['fechaFin']" class="invalid-feedback d-block">
                <strong>{{ errors['fechaFin'][0] }}</strong>
            </span>
        </div>
        <div class="form-group form-group-custom required" v-bind:class="{'is-invalid' : errors['duracion']}">
            <label>Duración (meses)</label>
            <input type="text" name="duracion" class="form-control" id="diferenciaMes" :value="datos.duracion" readonly required>
            <span v-if="errors['duracion']" class="invalid-feedback d-block">
                <strong>{{ errors['duracion'][0] }}</strong>
            </span>
        </div>
    </div>
</template>

<script type="text/javascript">
export default {
    props: ['errors', 'datos'],
    methods: {
        moment: function () {
            var self = this;

            var fechaInicioValue = document.getElementById('fechaInicio').value;
            var fechaFinValue    = document.getElementById('fechaFin').value;

            var fecha1 = moment(fechaInicioValue, 'YYYY/MM/DD');
            var fecha2 = moment(fechaFinValue, 'YYYY/MM/DD');

            document.getElementById('diferenciaMes').value = fecha2.diff(fecha1, 'months');
        }
    },
}
</script>
